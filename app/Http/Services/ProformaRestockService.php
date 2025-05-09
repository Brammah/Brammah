<?php

namespace App\Http\Services;

use App\Models\ProformaInvoiceProduct;
use App\Models\ProformaRestockProduct;

class ProformaRestockService
{
    public function handle($proformaRestock, $restockedProformaInvoiceProducts)
    {
        $proformaRestock->load(['supplier', 'proformaRestockProducts' => ['product:id,name']]);

        $proformaInvoice = $proformaRestock->proformaInvoice;

        $this->handleRestockedProducts($proformaRestock, $restockedProformaInvoiceProducts);
        $this->updateProformaInvoiceDetails($proformaRestock, $proformaInvoice);
        // $this->updateRestockedStatus($proformaRestock, $proformaInvoice);
        $this->updateDeliveredQuantities($proformaRestock, $proformaInvoice);
    }

    public function handleRestockedProducts($proformaRestock, $restockedProformaInvoiceProducts)
    {
        if ($restockedProformaInvoiceProducts->isNotEmpty()) {
            $products = $restockedProformaInvoiceProducts->map(function ($product) use ($proformaRestock) {
                return [
                    'proforma_restock_id' => $proformaRestock->id,
                    'product_id' => $product->product_id,
                    'requested_quantity' => $product->requested_quantity,
                    'received_quantity' => $product->received_quantity,
                    'foreign_currency_rate' => $product->foreign_currency_rate,
                    'foreign_currency_value' => $product->foreign_currency_value,
                    'local_currency_value' => $product->local_currency_value,
                    'average_value' => $product->average_value,
                    'freight_charges_per_product_foreign_currency' => $product->freight_charges_per_product_foreign_currency,
                    'freight_charges_per_product_local_currency' => $product->freight_charges_per_product_local_currency,
                    'freight_charges_per_piece' => $product->freight_charges_per_piece,
                    'clearing_charges_per_product_local_currency' => $product->clearing_charges_per_product_local_currency,
                    'clearing_charges_per_piece' => $product->clearing_charges_per_piece,
                    'cost_per_piece' => $product->cost_per_piece,
                    'status' => $product->status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            ProformaRestockProduct::insert($products);
        }
    }

    private function updateProformaInvoiceDetails($proformaRestock, $proformaInvoice)
    {
        $proformaInvoice->update([
            'invoice_number' => $proformaRestock->invoice_number,
            'clearing_charges' => $proformaInvoice->clearing_charges + $proformaRestock->clearing_charges,
            'outstanding_balance' => $proformaInvoice->outstanding_balance + $proformaRestock->restocked_amount,
            'freight_and_clearing_charges' => $proformaInvoice->freight_charges + $proformaRestock->clearing_charges + $proformaRestock->freight_charges,
        ]);
    }

    private function updateRestockedStatus($proformaRestock, $proformaInvoice)
    {
        $proformaInvoiceProductIds = ProformaInvoiceProduct::where('proforma_invoice_id', $proformaInvoice->id)->pluck('id');

        $restockedProductIds = ProformaRestockProduct::whereIn('product_id', $proformaInvoiceProductIds)->pluck('product_id');

        ProformaInvoiceProduct::whereIn('product_id', $restockedProductIds)->update(['is_restocked' => true]);

        $restockedProducts = ProformaRestockProduct::whereIn('product_id', $proformaInvoiceProductIds)->get();

        foreach ($restockedProducts as $restockedProduct) {
            ProformaInvoiceProduct::where('product_id', $restockedProduct->product_id)
                ->where('proforma_invoice_id', $proformaInvoice->id)
                ->update(['status' => $restockedProduct->status]);
        }
    }

    // private function updateDeliveryStatus($proformaInvoice): void
    // {
    //     $totalOrderedProductsCount = ProformaInvoiceProduct::where('proforma_invoice_id', $proformaInvoice->id)->sum('requested_quantity');
    //     $totalDeliveredProductsCount = ProformaInvoiceProduct::where('proforma_invoice_id', $proformaInvoice->id)->sum('received_quantity');

    //     if ($totalOrderedProductsCount == $totalDeliveredProductsCount) {
    //         $proformaInvoice->update(['is_delivered' => 2]);
    //     } else {
    //         $proformaInvoice->update(['is_delivered' => 1]);
    //     }
    // }

    private function updateDeliveredQuantities($proformaRestock, $proformaInvoice)
    {
        $proformaInvoiceProducts = ProformaInvoiceProduct::where('proforma_invoice_id', $proformaInvoice->id)->get();

        $restockedProducts = ProformaRestockProduct::whereIn('product_id', $proformaInvoiceProducts->pluck('product_id'))
            ->where('proforma_restock_id', $proformaRestock->id)
            ->get();

        foreach ($proformaInvoiceProducts as $proformaInvoiceProduct) {
            $restockedProduct = $restockedProducts->firstWhere('product_id', $proformaInvoiceProduct->product_id);

            if ($restockedProduct) {
                $newDeliveredQuantity = $proformaInvoiceProduct->received_quantity + $restockedProduct->received_quantity;
                $finalDeliveredQuantity = min($newDeliveredQuantity, $proformaInvoiceProduct->requested_quantity);

                $proformaInvoiceProduct->update([
                    'received_quantity' => $finalDeliveredQuantity,
                ]);
            }
        }
    }
}