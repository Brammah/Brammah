<?php

namespace App\Http\Helpers;

use App\Models\CustomerEngagement;
use App\Models\FollowupPlanner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FollowupPlannerHelper
{

    public static function getFollowupPlannerDetails()
    {
        $startDate = Carbon::now()->startOfWeek()->toDateString();
        $endDate = Carbon::now()->endOfWeek()->toDateString();

        $collectorNames = self::getCollectorNames();
        $totalOutstandingForWeek = self::calculateTotalOutstandingForWeek($startDate, $endDate);

        $dailyCollections = self::getDailyCollections($startDate, $endDate);

        $results = self::getFollowupPlannerData($startDate, $endDate, $collectorNames, $totalOutstandingForWeek, $dailyCollections);
        $grandTotal = self::calculateGrandTotal($results, $totalOutstandingForWeek);

        array_push($results, $grandTotal);

        // dd($results);
        return $results;
    }

    private static function getCollectorNames()
    {
        return User::whereIn('id', function ($query) {
            $query->select('collector_id')
                ->from('followup_planners')
                ->groupBy('collector_id');
        })->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'id');
    }

    private static function calculateTotalOutstandingForWeek($startDate, $endDate)
    {
        return FollowupPlanner::whereBetween('followup_planners.date', [$startDate, $endDate])
            ->join('followup_planner_details', 'followup_planners.id', '=', 'followup_planner_details.followup_planner_id')
            ->join('invoices', 'followup_planner_details.invoice_id', '=', 'invoices.id')
            ->groupBy('followup_planners.collector_id')
            ->sum(DB::raw('invoices.outstanding_balance'));
    }

    private static function getDailyCollections($startDate, $endDate)
    {
        $engagements = CustomerEngagement::with(['followupPlanner', 'customerEngagementDetails.invoice'])
            ->whereBetween('engagement_date', [$startDate, $endDate])
            ->whereHas('followupPlanner', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->get()
            ->groupBy('collector_id');

        $dailyCollections = [];

        foreach ($engagements as $collectorId => $engagementGroup) {
            foreach ($engagementGroup as $engagement) {
                foreach ($engagement->customerEngagementDetails as $detail) {
                    $invoice = $detail->invoice;
                    if ($invoice && $invoice->outstanding_balance > 0) {
                        // Assuming `engagement_date` is the date we want to use
                        $date = Carbon::parse($engagement->engagement_date)->format('Y-m-d');
                        $netOutstanding = $invoice->outstanding_balance - ($invoice->pdc_amount ?? 0);

                        if (!isset($dailyCollections[$date])) {
                            $dailyCollections[$date] = [];
                        }

                        if (!isset($dailyCollections[$date][$collectorId])) {
                            $dailyCollections[$date][$collectorId] = 0;
                        }

                        $dailyCollections[$date][$collectorId] += $netOutstanding;
                    }
                }
            }
        }

        return $dailyCollections;
    }

    private static function getFollowupPlannerData($startDate, $endDate, $collectorNames, $totalOutstandingForWeek, $dailyCollections)
    {
        return FollowupPlanner::with(['followupPlannerDetails.invoice'])
            ->whereBetween('date', [$startDate, $endDate])
            ->get()
            ->groupBy('collector_id')
            ->map(function ($collectorGroup, $collectorId) use ($collectorNames, $totalOutstandingForWeek, $dailyCollections) {
                return self::aggregateCollectorData($collectorGroup, $collectorNames, $totalOutstandingForWeek, $dailyCollections[$collectorId] ?? []);
            })
            ->filter()
            ->values()
            ->toArray();
    }

    private static function aggregateCollectorData($collectorGroup, $collectorNames, $totalOutstandingForWeek, $dailyCollections)
    {
        $collectorData = [
            'total_invoices' => 0,
            'total_pdc_amount' => 0,
            'total_invoice_amount' => 0,
            'total_net_outstanding' => 0,
            'total_collected_amount' => 0,
            'total_outstanding_balance' => 0,
            'daily_outstanding_balance' => [],
            'daily_followup_ratio' => [],
            'collector_full_name' => $collectorNames[$collectorGroup->first()->collector_id] ?? 'Unknown',
        ];

        // Array to store cumulative daily collections
        $cumulativeOutstanding = [];
        $cumulativeCollections = [];

        foreach ($collectorGroup as $followupPlanner) {
            foreach ($followupPlanner->followupPlannerDetails as $detail) {
                $invoice = $detail->invoice;
                if ($invoice && $invoice->outstanding_balance > 0) {
                    $date = Carbon::parse($detail->date)->format('Y-m-d');
                    $netOutstanding = $invoice->outstanding_balance - ($invoice->pdc_amount ?? 0);

                    $collectorData['daily_outstanding_balance'][$date] = ($collectorData['daily_outstanding_balance'][$date] ?? 0) + $netOutstanding;
                    $collectorData['total_pdc_amount'] += $invoice->pdc_amount ?? 0;
                    $collectorData['total_collected_amount'] += $detail->collected_amount ?? 0;
                    $collectorData['total_invoice_amount'] += $invoice->invoice_amount ?? 0;
                    $collectorData['total_outstanding_balance'] += $invoice->outstanding_balance ?? 0;
                    $collectorData['total_net_outstanding'] += $netOutstanding;
                    $collectorData['total_invoices']++;

                    // Calculate cumulative outstanding balance for each day
                    if (!isset($cumulativeOutstanding[$date])) {
                        $cumulativeOutstanding[$date] = 0;
                    }
                    $cumulativeOutstanding[$date] += $netOutstanding;

                    // Calculate cumulative collections for each day
                    if (!isset($cumulativeCollections[$date])) {
                        $cumulativeCollections[$date] = 0;
                    }
                    $cumulativeCollections[$date] += ($dailyCollections[$date][$followupPlanner->collector_id] ?? 0);
                }
            }
        }

        // Calculate followup_ratio for each day
        foreach ($cumulativeOutstanding as $date => $outstanding) {
            $cumulativeCollections[$date] += $outstanding; // Add outstanding to collections for that day
            $collectorData['daily_followup_ratio'][$date] = ($totalOutstandingForWeek / $cumulativeCollections[$date]) ?: 0;
        }

        if ($collectorData['total_outstanding_balance'] > 0) {
            return $collectorData;
        }
    }

    private static function calculateGrandTotal($results, $totalOutstandingForWeek)
    {
        $grandTotal = [
            'total_invoices' => 0,
            'total_pdc_amount' => 0,
            'total_invoice_amount' => 0,
            'total_net_outstanding' => 0,
            'total_collected_amount' => 0,
            'total_outstanding_balance' => 0,
            'daily_outstanding_balance' => [],
            'daily_followup_ratio' => [],
            'collector_full_name' => 'Grand Total',
        ];

        // Array to store cumulative daily collections
        $cumulativeCollections = [];

        foreach ($results as $result) {
            $grandTotal['total_invoices'] += $result['total_invoices'];
            $grandTotal['total_pdc_amount'] += $result['total_pdc_amount'];
            $grandTotal['total_invoice_amount'] += $result['total_invoice_amount'];
            $grandTotal['total_net_outstanding'] += $result['total_net_outstanding'];
            $grandTotal['total_collected_amount'] += $result['total_collected_amount'];
            $grandTotal['total_outstanding_balance'] += $result['total_outstanding_balance'];

            foreach ($result['daily_outstanding_balance'] as $date => $outstanding) {
                $grandTotal['daily_outstanding_balance'][$date] = ($grandTotal['daily_outstanding_balance'][$date] ?? 0) + $outstanding;
            }

            foreach ($result['daily_followup_ratio'] as $date => $followupRatio) {
                if (!isset($grandTotal['daily_followup_ratio'][$date])) {
                    $grandTotal['daily_followup_ratio'][$date] = 0;
                }
                $grandTotal['daily_followup_ratio'][$date] += $followupRatio;
            }
        }

        // Calculate the sum of daily_followup_ratio
        $sumFollowupRatio = array_sum($grandTotal['daily_followup_ratio']);
        $grandTotal['sum_followup_ratio'] = ($totalOutstandingForWeek == 0) ? 0 : ($sumFollowupRatio / $totalOutstandingForWeek);

        return $grandTotal;
    }
}
