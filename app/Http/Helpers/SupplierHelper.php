<?php
namespace App\Http\Helpers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;

class SupplierHelper
{
    public static function getSupplierNumber()
    {
        $lastSupplierNumber = Supplier::query()
            ->selectRaw("CAST(SUBSTRING_INDEX(supplier_code, '-', -1) AS UNSIGNED) as num")
            ->orderByDesc('num')
            ->value('num') ?? 0;

        $nextSupplierNumber = $lastSupplierNumber + 1;

        return sprintf("SUPPLIER-%03d", $nextSupplierNumber);
    }

    public static function getOutstandingBalance(Supplier $supplier)
    {
        $finalBalance = 0;

        $openingBalance = Supplier::where('id', $supplier->id)
            ->selectRaw('SUM(opening_balance) as balance')
            ->value('balance');
        $finalBalance += $openingBalance ?? 0;

        $invoiceBalance = PurchaseOrder::where('supplier_id', $supplier->id)
            ->selectRaw('SUM(outstanding_balance) as balance')
            ->value('balance');
        $finalBalance += $invoiceBalance ?? 0;

        return round($finalBalance, 2);
    }
}
