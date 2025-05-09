<?php
namespace App\Http\Services;

use App\Models\JobReturnCharge;
use App\Models\JobReturnProduct;
use App\Models\Store;
use App\Models\StoreInventory;
use Illuminate\Support\Facades\DB;

class JobReturnService
{
    public function handle($jobReturn, $miscellaneousCharges, $jobCardProducts, $request)
    {
        if ($jobReturn->exists) {
            $this->createOrUpdateJobCardProducts($jobCardProducts, $jobReturn);
        }

        $this->createMiscellaneousCharges($miscellaneousCharges, $jobReturn);

        $this->saveReturnReasons($request, $jobReturn);

    }
    private function createOrUpdateJobCardProducts($jobCardProducts, $jobReturn)
    {
        $jobReturn->jobCard->update(['is_returned' => true]);

        if ($jobCardProducts->isNotEmpty()) {
            $jobCardProducts->each(function ($jobCardProduct) use ($jobReturn) {
                $existingJobReturnProduct = JobReturnProduct::where('job_return_id', $jobReturn->id)
                    ->where('product_id', $jobCardProduct['product_id'])
                    ->first();

                if ($existingJobReturnProduct) {
                    $existingJobReturnProduct->update([
                        'returned_quantity'  => $jobCardProduct['returned_quantity'],
                        'delivered_quantity' => $jobCardProduct['delivered_quantity'],
                    ]);
                    $this->updateStoreInventory($jobCardProduct['product_id'], $jobCardProduct['returned_quantity']);
                } else {
                    JobReturnProduct::create([
                        'job_return_id'      => $jobReturn->id,
                        'product_id'         => $jobCardProduct['product_id'],
                        'returned_quantity'  => $jobCardProduct['returned_quantity'],
                        'delivered_quantity' => $jobCardProduct['delivered_quantity'],
                    ]);
                    $this->updateStoreInventory($jobCardProduct['product_id'], $jobCardProduct['returned_quantity']);
                }
            });
        }

        $jobReturn->update(['is_approved' => 1]);
        $jobReturn->jobCard->update(['status' => 8]);
    }

    private function createMiscellaneousCharges($miscellaneousCharges, $jobReturn)
    {
        $miscellaneousCharges->each(function ($miscellaneousCharge) use ($jobReturn) {
            JobReturnCharge::create([
                'job_return_id'           => $jobReturn->id,
                'product_id'              => $miscellaneousCharge['product_id'],
                'miscellaneous_charge_id' => $miscellaneousCharge['miscellaneous_charge_id'],
                'price'                   => $miscellaneousCharge['price'],
                'quantity'                => $miscellaneousCharge['quantity'],
                'vat_amount'              => $miscellaneousCharge['vat_amount'],
                'total_amount'            => $miscellaneousCharge['total_amount'],
            ]);
        });
    }

    private function saveReturnReasons($request, $jobReturn)
    {
        if ($request->has('returnReasons')) {
            $jobReturn->exists
            ? $jobReturn->returnReasons()->sync($request->returnReasons)
            : $jobReturn->returnReasons()->attach($request->returnReasons);
        }
    }

    private function updateStoreInventory($productId, $quantity)
    {
        if ($quantity > 0) {
            StoreInventory::updateOrCreate(
                [
                    'store_id'   => Store::where('is_main', 1)->first()->id,
                    'product_id' => $productId,
                ],
                [
                    'quantity' => DB::raw('quantity + ' . $quantity),
                ]
            );
        }
    }
}
