<?php

namespace App\Http\Services;

use App\Models\Store;
use App\Models\StoreInventory;
use Illuminate\Support\Facades\DB;

class StoreInventoryService
{
    public static function approveStoreTransfer($storeTransfer)
    {
        DB::transaction(function () use ($storeTransfer) {
            $issuingStoreEntry = StoreInventory::where('store_id', $storeTransfer->issuing_store_id)
                ->where('product_id', $storeTransfer->product_id)
                ->lockForUpdate()
                ->first();

            if ($issuingStoreEntry) {
                $issuingStoreEntry->decrement('quantity', $storeTransfer->approved_quantity);
            }

            StoreInventory::updateOrCreate(
                [
                    'store_id' => $storeTransfer->receiving_store_id,
                    'product_id' => $storeTransfer->product_id,
                ],
                [
                    'quantity' => DB::raw('quantity + ' . $storeTransfer->approved_quantity),
                ]
            );
        });
    }

    public static function incrementProductQuantity($restockedProduct)
    {
        DB::transaction(function () use ($restockedProduct) {
            StoreInventory::updateOrCreate(
                [
                    'store_id' => Store::where('is_main', 1)->first()->id,
                    'product_id' => $restockedProduct->product_id,
                ],
                [
                    'quantity' => DB::raw('quantity + ' . $restockedProduct->restocked_quantity),
                ]
            );
        });
    }

    public static function decrementProductQuantity($product)
    {
        DB::transaction(function () use ($product) {
            StoreInventory::updateOrCreate(
                [
                    'store_id' => $product->store_id,
                    'product_id' => $product->product_id,
                ],
                [
                    'quantity' => DB::raw('quantity - ' . $product->quantity),
                ]
            );
        });
    }

    // public static function recordOrderItemsFromProductOrder($productOrderItems, $order)
    // {
    //     return DB::transaction(function () use ($productOrderItems, $order) {
    //         $totalQuantityToDeduct = 0;

    //         foreach ($productOrderItems as $productOrder) {
    //             $totalQuantityToDeduct += $productOrder->quantity;
    //         }

    //         if ($totalQuantityToDeduct > 0) {
    //             $storesInventory = StoreInventory::whereIn('product_id', $productOrderItems->pluck('product_id')->toArray())
    //                 ->orderBy('quantity', 'desc')
    //                 ->get();

    //             foreach ($storesInventory as $storeInventory) {
    //                 foreach ($productOrderItems as $productOrder) {
    //                     if ($storeInventory->product_id == $productOrder->product_id && $storeInventory->quantity > 0) {
    //                         $quantityToDeduct = min($storeInventory->quantity, $productOrder->quantity, $totalQuantityToDeduct);

    //                         if ($quantityToDeduct > 0) {
    //                             OrderItem::create([
    //                                 'order_id' => $order->id,
    //                                 'store_id' => $storeInventory->store_id,
    //                                 'product_id' => $storeInventory->product_id,
    //                                 'quantity' => $quantityToDeduct,
    //                                 'selling_price' => $productOrder->selling_price,
    //                                 'vat_amount' => $productOrder->vat_amount,
    //                                 'total_amount' => $productOrder->total_amount,
    //                             ]);

    //                             $storeInventory->decrement('quantity', $quantityToDeduct);
    //                             $totalQuantityToDeduct -= $quantityToDeduct;
    //                         }

    //                         // If we've deducted enough for this product, move to the next productOrder
    //                         if ($totalQuantityToDeduct <= 0) {
    //                             break;
    //                         }
    //                     }
    //                 }
    //             }
    //         }

    //         $order->update([
    //             'status' => $order->order_type !== 'credit' ? 1 : 2,
    //             'balance' => $order->cost,
    //         ]);
    //     });
    // }
}