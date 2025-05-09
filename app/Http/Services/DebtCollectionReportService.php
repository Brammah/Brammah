<?php

namespace App\Http\Services;

use App\Http\Helpers\CustomerHelper;
use App\Http\Helpers\MailerConfigurationHelper;
use App\Models\DebtCollectionReport;
use App\Notifications\EmailCollectionPlanReportNotification;
use App\Notifications\EmailCollectionReportNotification;
use App\Notifications\EmailWeeklyCollectionsReportNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class DebtCollectionReportService
{
    public static function sendDailyDebtCollectionReports()
    {
        DB::transaction(function () {
            $debtCollectionReport = DebtCollectionReport::where('report_type', 'daily')
                ->whereHas('directors')
                ->first();

            if ($debtCollectionReport) {
                $directors = $debtCollectionReport->directors;

                if ($directors->isEmpty()) {
                    return;
                }

                $directorEmails = $directors->pluck('email')->toArray();

                $yesterday = Carbon::yesterday();

                if ($yesterday->isSunday()) {
                    return;
                }

                $followupDate = $yesterday->format('Y-m-d');

                $pdf = CustomerHelper::getCollectionReports($followupDate);

                if ($pdf) {
                    $toEmails = [];
                    $ccEmails = [];

                    foreach ($directorEmails as $email) {
                        if (in_array($email, [
                            'k.nathwani@apex-steel.com',
                            'd.patel@apex-steel.com',
                            's.darji@apex-steel.com',
                        ])) {
                            $ccEmails[] = $email;
                        } else {
                            $toEmails[] = $email;
                        }
                    }
                    $mailerConfig = MailerConfigurationHelper::getO365MailerConfig();

                    Notification::route('mail', $toEmails)
                        ->route('cc', $ccEmails)
                        ->notify(new EmailCollectionReportNotification($pdf, $mailerConfig));
                } else {
                    return;
                }
            }
        });
    }
    public static function sendWeeklyDebtCollectionReports()
    {
        DB::transaction(function () {

            $debtCollectionReport = DebtCollectionReport::where('report_type', 'weekly')
                ->whereHas('directors')
                ->first();

            if ($debtCollectionReport) {
                $directors = $debtCollectionReport->directors;

                if ($directors->isEmpty()) {
                    return;
                }

                $directorEmails = $directors->pluck('email')->toArray();

                $startOfWeek = now()->startOfWeek()->format('Y-m-d');
                $endOfWeek = now()->endOfWeek()->format('Y-m-d');
                $followupDate = $startOfWeek . '/' . $endOfWeek;

                $pdf = CustomerHelper::getCollectionReports($followupDate);

                if ($pdf) {
                    $toEmails = [];
                    $ccEmails = [];

                    foreach ($directorEmails as $email) {
                        if (in_array($email, [
                            'k.nathwani@apex-steel.com',
                            'n.nathwani@apex-steel.com',
                            'd.patel@apex-steel.com',
                            's.darji@apex-steel.com',
                        ])) {
                            $ccEmails[] = $email;
                        } else {
                            $toEmails[] = $email;
                        }
                    }
                    $mailerConfig = MailerConfigurationHelper::getO365MailerConfig();

                    Notification::route('mail', $toEmails)
                        ->route('cc', $ccEmails)
                        ->notify(new EmailWeeklyCollectionsReportNotification($pdf, $mailerConfig));
                } else {
                    return;
                }
            }
        });
    }
    public static function sendTomorrowDebtCollectionReports()
    {
        DB::transaction(function () {

            $debtCollectionReport = DebtCollectionReport::where('report_type', 'tomorrow')
                ->whereHas('directors')
                ->first();

            if ($debtCollectionReport) {
                $directors = $debtCollectionReport->directors;

                if ($directors->isEmpty()) {
                    return;
                }

                $directorEmails = $directors->pluck('email')->toArray();

                switch ($debtCollectionReport->report_type) {
                    case 'daily':
                        $followupDate = now()->format('Y-m-d');
                        break;
                    case 'weekly':
                        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
                        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
                        $followupDate = $startOfWeek . '/' . $endOfWeek;
                        break;
                    default:
                        return;
                }

                $pdf = CustomerHelper::getCollectionReports($followupDate);

                if ($pdf) {
                    $mailerConfig = MailerConfigurationHelper::getO365MailerConfig();

                    Notification::route('mail', $directorEmails)->notify(new EmailCollectionReportNotification($pdf, $mailerConfig));
                } else {
                    return;
                }
            }
        });
    }

    public static function sendCollectionsPlanReports()
    {
        DB::transaction(function () {
            try {
                $debtCollectionReport = DebtCollectionReport::where('report_type', 'daily')
                    ->whereHas('directors')
                    ->first();

                if (!$debtCollectionReport || $debtCollectionReport->directors->isEmpty()) {
                    return;
                }

                $directorEmails = $debtCollectionReport->directors->pluck('email')->toArray();
                $pdf = CustomerHelper::getCollectionPlans();

                if (!$pdf) {
                    return;
                }

                $toEmails = [];
                $ccEmails = [];
                $ccList = [
                    'k.nathwani@apex-steel.com',
                    'n.nathwani@apex-steel.com',
                    'd.patel@apex-steel.com',
                    's.darji@apex-steel.com',
                ];

                foreach ($directorEmails as $email) {
                    if (in_array($email, $ccList)) {
                        $ccEmails[] = $email;
                    } else {
                        $toEmails[] = $email;
                    }
                }

                $mailerConfig = MailerConfigurationHelper::getO365MailerConfig();

                Notification::route('mail', $toEmails)
                    ->route('cc', $ccEmails)
                    ->notify(new EmailCollectionPlanReportNotification($pdf, $mailerConfig));

            } catch (\Exception $e) {
                $recipients = [
                    's.darji@apex-steel.com',
                    'b.ochieng@apex-steel.com',
                ];

                $subject = 'Weekly Debt Collection Plan Report Error';
                $message = 'Failed to send collection plan reports: ' . $e->getMessage();
                $mailerConfig = MailerConfigurationHelper::getO365MailerConfig();

                Log::error($message);

                Mail::mailer($mailerConfig['mailer'])->raw($message, function ($mail) use ($recipients, $subject, $mailerConfig) {
                    $mail->to($recipients)
                        ->subject($subject)
                        ->from($mailerConfig['from_address']);
                });
            }
        });
    }
}
