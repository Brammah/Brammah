<?php
namespace App\Http\Services;

use App\Models\PurchaseOrderProduct;
use App\Models\RestockProduct;
use Illuminate\Support\Facades\DB;

class ProductRestockService
{
    public function handle($productRestock): void
    {
        $purchaseOrder = $productRestock->purchaseOrder;

        DB::transaction(function () use ($productRestock, $purchaseOrder) {
            $this->updateRestockedStatus($productRestock, $purchaseOrder);
            $this->updateDeliveryStatus($purchaseOrder);
            $this->updateDeliveredQuantities($productRestock, $purchaseOrder);
        });
    }

    private function updateRestockedStatus($productRestock, $purchaseOrder): void
    {
        $productRestock->load(['supplier', 'restockProducts' => ['product:id,name']]);

        $purchaseOrderProductIds = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->pluck('id');

        $restockedProductIds = RestockProduct::whereIn('product_id', $purchaseOrderProductIds)->pluck('product_id');

        PurchaseOrderProduct::whereIn('product_id', $restockedProductIds)->update(['is_restocked' => true]);

        $restockedProducts = RestockProduct::whereIn('product_id', $purchaseOrderProductIds)->get();

        foreach ($restockedProducts as $restockedProduct) {
            PurchaseOrderProduct::where('product_id', $restockedProduct->product_id)
                ->where('purchase_order_id', $purchaseOrder->id)
                ->update(['status' => $restockedProduct->status]);
        }
    }

    private function updateDeliveryStatus($purchaseOrder): void
    {
        $totals = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)
            ->selectRaw('COALESCE(SUM(ordered_quantity), 0) as total_ordered, COALESCE(SUM(delivered_quantity), 0) as total_delivered')
            ->first();

        $isDelivered = ($totals->total_ordered > 0 && $totals->total_ordered == $totals->total_delivered) ? 2 : 1;

        $purchaseOrder->update(['is_delivered' => $isDelivered]);
    }

    private function updateDeliveredQuantities($productRestock, $purchaseOrder): void
    {
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $purchaseOrder->id)->get();

        $restockedProducts = RestockProduct::whereIn('product_id', $purchaseOrderProducts->pluck('product_id'))
            ->where('product_restock_id', $productRestock->id)
            ->get();

        foreach ($purchaseOrderProducts as $purchaseOrderProduct) {
            $restockedProduct = $restockedProducts->firstWhere('product_id', $purchaseOrderProduct->product_id);

            if ($restockedProduct) {
                $newDeliveredQuantity   = $purchaseOrderProduct->delivered_quantity + $restockedProduct->restocked_quantity;
                $finalDeliveredQuantity = min($newDeliveredQuantity, $purchaseOrderProduct->ordered_quantity);

                $purchaseOrderProduct->update([
                    'delivered_quantity' => $finalDeliveredQuantity,
                ]);
            }
        }
    }
}