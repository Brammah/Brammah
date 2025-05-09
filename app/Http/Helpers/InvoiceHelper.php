<?php

namespace App\Http\Helpers;

use App\Http\Services\CustomerService;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\SalesRepresentative;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoiceHelper
{
    public static function calculateHighlightClass(Model $invoice, string $todayDate = 'd-m-Y')
    {
        $nextFollowupDate = $invoice->next_followup_date
        ? Carbon::parse($invoice->next_followup_date)->format($todayDate)
        : '-';

        $highlightClass = $nextFollowupDate == Carbon::today()->format($todayDate)
        ? 'table-warning'
        : '';

        return [
            'nextFollowupDate' => $nextFollowupDate,
            'highlightClass' => $highlightClass,
        ];
    }

    public static function updateInvoiceData($invoiceData)
    {
        foreach ($invoiceData as $invoiceInfo) {
            $salesRep = SalesRepresentative::firstOrCreate(['name' => $invoiceInfo['SALESREP']]);
            $salesRepId = $salesRep->id;
            $branch = Branch::where('code', '=', $invoiceInfo['ORG_ID'])->first();
            $branchId = $branch ? $branch->id : null;
            $collector = User::where('full_name', '=', $invoiceInfo['COLLECTOR'])->first();
            $collectorId = $collector ? $collector->id : 9;
            $customer = Customer::query()
                ->where('branch_id', '=', $branchId)
                ->where('account_number', '=', $invoiceInfo['ACCOUNT_NUMBER'])
                ->first();

            if (!$customer) {
                CustomerService::createNewInvoiceCustomer($salesRepId, $branchId, $invoiceInfo);
                $newCustomer = Customer::query()
                    ->where('branch_id', '=', $branchId)
                    ->where('account_number', '=', $invoiceInfo['ACCOUNT_NUMBER'])
                    ->first();

                $customerId = $newCustomer ? $newCustomer->id : null;
                $branchId = $newCustomer ? $newCustomer->branch_id : $branchId;
            } else {
                $customerId = $customer->id;
                $branchId = $customer->branch_id;
            }

            Invoice::updateOrCreate(
                [
                    'invoice_number' => $invoiceInfo['TRX_NUMBER'],
                ],
                [
                    'customer_id' => $customerId,
                    'branch_id' => $branchId,
                    'sales_representative_id' => $salesRepId,
                    'currency' => $invoiceInfo['CURRENCY'],
                    'invoice_date' => Carbon::parse($invoiceInfo['TRX_DATE'])->format('Y-m-d'),
                    'invoice_due_date' => Carbon::parse($invoiceInfo['DUE_DATE'])->format('Y-m-d'),
                    'invoice_amount' => $invoiceInfo['INVOICE_AMOUNT'],
                    'original_amount_due' => $invoiceInfo['AMOUNT_DUE_ORIGINAL'],
                    'payment_terms' => empty($invoiceInfo['TERMS']) ? null : $invoiceInfo['TERMS'],
                    'outstanding_balance' => $invoiceInfo['AMOUNT_DUE_ORIGINAL'],
                    'overdue_days' => $invoiceInfo['DUE_AGE_BY_INVOICE'],
                    'pdc_amount' => $invoiceInfo['PDC_AMT'],
                    'transaction_type' => $invoiceInfo['TRX_TYPE'],
                    'status' => $invoiceInfo['STATUS'],
                    'collector_id' => $collectorId,
                    'last_pdc_date' => empty($invoiceInfo['LAST_PDC_DATE']) ? null : Carbon::parse($invoiceInfo['LAST_PDC_DATE'])->format('Y-m-d'),
                ]
            );
        }
    }
}
