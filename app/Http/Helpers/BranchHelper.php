<?php

namespace App\Http\Helpers;

use App\Models\Branch;

class BranchHelper
{
    public static function over120DaysDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 120)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }
    public static function over90DaysDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 90)
                ->where('overdue_days', '<=', 120)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });

    }
    public static function over60DaysDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 60)
                ->where('overdue_days', '<=', 90)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function over30DaysDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 30)
                ->where('overdue_days', '<=', 60)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function under30DaysDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 0)
                ->where('overdue_days', '<=', 30)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function totalDivisionWiseOutstandingBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }
    public static function groupSummaryBalances()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw(
                'branch_id,
                    SUM(outstanding_balance - pdc_amount) as total_net_outstanding,
                    SUM(outstanding_balance) as total_outstanding_balance,
                    SUM(invoice_amount) as total_invoice_amount,
                    SUM(pdc_amount) as total_pdc_amount'
            )
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_pdc_amount' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_pdc_amount,
                    'total_invoice_amount' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_invoice_amount,
                    'total_net_outstanding' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_net_outstanding,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function over120DaysPDCAmounts()
    {
        $over120DaysPDCAmounts = Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(pdc_amount) as total_pdc_amount')
                ->where('overdue_days', '>=', 0)
                ->where('overdue_days', '>', 120)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_pdc_amount' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_pdc_amount,
                ];
            });

        return $over120DaysPDCAmounts;
    }
    public static function over90DaysPDCAmounts()
    {
        $over90DaysPDCAmounts = Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 90)
                ->where('overdue_days', '<=', 120)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });

        return $over90DaysPDCAmounts;
    }
    public static function over60DaysPDCAmounts()
    {
        $over60DaysPDCAmounts = Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 60)
                ->where('overdue_days', '<=', 90)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
        return $over60DaysPDCAmounts;
    }

    public static function over30DaysPDCAmounts()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 30)
                ->where('overdue_days', '<=', 60)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function under30DaysPDCAmounts()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->where('overdue_days', '>', 0)
                ->where('overdue_days', '<=', 30)
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }

    public static function totalPDCAmounts()
    {
        return Branch::debtCollection()->with(['invoices' => function ($query) {
            $query->selectRaw('branch_id, SUM(outstanding_balance) as total_outstanding_balance')
                ->groupBy('branch_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'branch_name' => $branch->name,
                    'total_outstanding_balance' => $branch->invoices->isEmpty() ? 0 : $branch->invoices->first()->total_outstanding_balance,
                ];
            });
    }
}
