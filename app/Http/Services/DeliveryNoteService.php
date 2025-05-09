<?php

namespace App\Http\Services;

use App\Models\DeliveryNoteProduct;
use App\Models\QuotationProduct;

class DeliveryNoteService
{
    const STATUS_COMPLETED = 4;
    const STATUS_PARTIAL_DELIVERY = 3; // Example status for partial delivery
    const QUOTATION_STATUS_FULLY_DELIVERED = 2;
    const QUOTATION_STATUS_PARTIALLY_DELIVERED = 1;

    public function handle($deliveryNote, $validatedDeliveryNoteProducts)
    {
        $deliveryNote->load(['jobCard', 'jobInspection', 'quotation']);

        $deliveryNote->update([
            'bill_to_customer_id' => $deliveryNote->quotation->bill_to_customer_id ?? $deliveryNote->sale->bill_to_customer_id ?? null,
        ]);

        if ($validatedDeliveryNoteProducts->isNotEmpty()) {
            $this->createDeliveryNoteProducts($validatedDeliveryNoteProducts, $deliveryNote);
        }

        $this->updateQuotationProductsAndStatus($deliveryNote, $validatedDeliveryNoteProducts);

        if ($deliveryNote->jobCard && $deliveryNote->jobInspection) {
            $this->updateJobcardAndJobInspectionStatuses($deliveryNote);
        }
    }

    private function createDeliveryNoteProducts($validatedDeliveryNoteProducts, $deliveryNote)
    {
        $validatedDeliveryNoteProducts->each(function ($product) use ($deliveryNote) {
            DeliveryNoteProduct::create([
                'delivery_note_id' => $deliveryNote->id,
                'product_id' => $product['product_id'],
                'delivered_quantity' => $product['quantity_to_deliver'],
            ]);
        });
    }

    private function updateQuotationProductsAndStatus($deliveryNote, $validatedDeliveryNoteProducts)
    {
        $allFullyDelivered = true;

        foreach ($validatedDeliveryNoteProducts as $deliveryProduct) {
            $quotationProduct = QuotationProduct::where('quotation_id', $deliveryNote->quotation_id)
                ->where('product_id', $deliveryProduct['product_id'])
                ->first();

            if ($quotationProduct) {
                $quotationProduct->delivered_quantity += $deliveryProduct['quantity_to_deliver'];
                $quotationProduct->save();

                if ($quotationProduct->delivered_quantity < $quotationProduct->quoted_quantity && $quotationProduct->delivered_quantity > 0) {
                    $allFullyDelivered = false;
                }
            }
        }

        if ($deliveryNote->quotation_id !== null) {
            if ($allFullyDelivered) {
                $deliveryNote->quotation->update(['status' => self::QUOTATION_STATUS_FULLY_DELIVERED]);
            } else {
                $deliveryNote->quotation->update(['status' => self::QUOTATION_STATUS_PARTIALLY_DELIVERED]);
            }

        }
    }

    private function updateJobcardAndJobInspectionStatuses($deliveryNote)
    {
        if ($deliveryNote->job_inspection_id !== null || $deliveryNote->job_card_id !== null) {
            $deliveryNote->jobInspection->update(['status' => self::STATUS_COMPLETED]);
            $deliveryNote->jobCard->update(['status' => self::STATUS_COMPLETED]);
        }
    }
}