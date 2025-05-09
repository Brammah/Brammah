<?php
namespace App\Http\Services;

use App\Models\ProductTracker;

class ProductTrackerService
{
    private static function getPreviousBalance(int $productId): float
    {
        return ProductTracker::where('product_id', $productId)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->value('closing_balance') ?? 0;
    }

    public static function trackOpeningBalances($storeInventory)
    {
        $previousBalance = self::getPreviousBalance($storeInventory->product_id);
        $quantityIn      = $storeInventory->quantity ?? 0;
        $quantityOut     = 0;
        $netAdjustment   = $quantityIn - $quantityOut;
        $newBalance      = $previousBalance + $netAdjustment;

        ProductTracker::create([
            'product_id'       => $storeInventory->product_id,
            'transaction_date' => now()->format('y-m-d'),
            'transaction_type' => 'Opening Stock',
            'quantity_in'      => $quantityIn,
            'quantity_out'     => $quantityOut,
            'opening_balance'  => $previousBalance,
            'closing_balance'  => $newBalance,
        ]);
    }

    public static function trackProductAdjustment($productAdjustment)
    {
        $previousBalance = self::getPreviousBalance($productAdjustment->product_id);
        $quantityIn      = $productAdjustment->adjusted_quantity > 0 ? $productAdjustment->adjusted_quantity : 0;
        $quantityOut     = $productAdjustment->adjusted_quantity < 0 ? abs($productAdjustment->adjusted_quantity) : 0;
        $netAdjustment   = $quantityIn - $quantityOut;
        $newBalance      = $previousBalance + $netAdjustment;

        ProductTracker::create([
            'product_id'            => $productAdjustment->product_id,
            'transaction_date'      => $productAdjustment->adjustment_date,
            'transaction_type'      => 'Product Adjustment',
            'product_adjustment_id' => $productAdjustment->id,
            'quantity_in'           => $quantityIn,
            'quantity_out'          => $quantityOut,
            'opening_balance'       => $previousBalance,
            'closing_balance'       => $newBalance,
        ]);
    }

    public static function trackRestockedProduct($restockProduct)
    {
        $restockProduct->load(['productRestock']);

        $previousBalance = self::getPreviousBalance($restockProduct->product_id);
        $quantityIn      = $restockProduct->restocked_quantity;
        $newBalance      = $previousBalance + $quantityIn;

        return ProductTracker::create([
            'product_id'         => $restockProduct->product_id,
            'transaction_type'   => 'Local Product Restock',
            'transaction_date'   => $restockProduct->productRestock->restock_date,
            'purchase_order_id'  => $restockProduct->productRestock->purchase_order_id,
            'product_restock_id' => $restockProduct->productRestock->id,
            'quantity_in'        => $quantityIn,
            'quantity_out'       => 0,
            'opening_balance'    => $previousBalance,
            'closing_balance'    => $newBalance,
        ]);
    }

    public static function trackProformaRestock($proformaRestockProduct)
    {
        $proformaRestockProduct->load(['proformaRestock']);

        $previousBalance = self::getPreviousBalance($proformaRestockProduct->product_id);
        $quantityIn      = $proformaRestockProduct->received_quantity;
        $newBalance      = $previousBalance + $quantityIn;

        return ProductTracker::create([
            'product_id'          => $proformaRestockProduct->product_id,
            'transaction_type'    => 'Import Product Restock',
            'proforma_restock_id' => $proformaRestockProduct->proforma_restock_id,
            'transaction_date'    => $proformaRestockProduct->proformaRestock->restock_date,
            'proforma_invoice_id' => $proformaRestockProduct->proformaRestock->proforma_invoice_id,
            'quantity_in'         => $quantityIn,
            'quantity_out'        => 0,
            'opening_balance'     => $previousBalance,
            'closing_balance'     => $newBalance,
        ]);
    }

    public static function trackMaterialRequest($materialRequestProduct)
    {
        $materialRequestProduct->load('materialRequest');

        $previousBalance = self::getPreviousBalance($materialRequestProduct->product_id);
        $quantityOut     = $materialRequestProduct->issued_quantity ?? $materialRequestProduct->sold_quantity ?? 0;
        $newBalance      = $previousBalance - $quantityOut;

        return ProductTracker::create([
            'product_id'                  => $materialRequestProduct->product_id,
            'transaction_type'            => 'Material Request',
            'material_request_product_id' => $materialRequestProduct->id,
            'material_request_id'         => $materialRequestProduct->material_request_id,
            'transaction_date'            => $materialRequestProduct->materialRequest->date,
            'quantity_in'                 => 0,
            'quantity_out'                => $quantityOut,
            'opening_balance'             => $previousBalance,
            'closing_balance'             => $newBalance,
        ]);
    }

    public static function trackMaterialReissue($materialReissue)
    {
        $materialReissue->load('materialRequest');

        $previousBalance = self::getPreviousBalance($materialReissue->product_id);
        $quantityOut     = $materialReissue->issued_quantity ?? $materialReissue->sold_quantity ?? 0;
        $newBalance      = $previousBalance - $quantityOut;

        return ProductTracker::create([
            'product_id'          => $materialReissue->product_id,
            'transaction_type'    => 'Material Reissue',
            'material_reissue_id' => $materialReissue->id,
            'material_request_id' => $materialReissue->material_request_id,
            'transaction_date'    => $materialReissue->materialRequest->date,
            'quantity_in'         => 0,
            'quantity_out'        => $quantityOut,
            'opening_balance'     => $previousBalance,
            'closing_balance'     => $newBalance,
        ]);
    }

    public static function getProcurementDetails($startDate = null, $endDate = null)
    {
        $productDetails = ProductTracker::with([
            'product',
            'purchaseOrder',
            'productRestock.supplier',
            'productRestock.purchaseOrder',
            'productRestock.restockProducts.product',
        ])
            ->where(function ($query) {
                $query->whereNotNull('purchase_order_id')
                    ->orWhereNotNull('product_restock_id');
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereHas('productRestock.purchaseOrder', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('lpo_date', [$startDate, $endDate]);
                });
            })
            ->get();

        $mappedData = $productDetails->flatMap(function ($tracker) {
            $transactionType = $tracker->transaction_type;
            $rows            = [];

            if ($transactionType == 'Local Product Restock') {
                foreach ($tracker->productRestock->restockProducts as $product) {
                    $rows[] = [
                        'lpo_date'       => optional($tracker->productRestock->purchaseOrder)->lpo_date ?? 'N/A',
                        'restock_number' => $tracker->productRestock->restock_code ?? 'N/A',
                        'product_name'   => $product->product->name ?? 'N/A',
                        'part_number'    => $product->product->part_number ?? 'N/A',
                        'supplier'       => optional($tracker->productRestock->supplier)->name ?? 'N/A',
                        'invoice_number' => $tracker->productRestock->supplier_document_number ?? 'N/A',
                        'invoice_date'   => optional($tracker->productRestock->purchaseOrder)->lpo_date ?? 'N/A',
                        'purchase_type'  => 'Local',
                        'buying_price'   => $product->buying_price ?? 0,
                        'quantity'       => $product->restocked_quantity ?? 0,
                    ];
                }
            }

            return $rows;
        });

        return $mappedData->uniqueStrict()->values();
    }
}
