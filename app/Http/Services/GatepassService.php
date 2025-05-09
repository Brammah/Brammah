<?php

namespace App\Http\Services;

use App\Models\GatepassDetail;
use App\Models\GatepassProduct;
use Illuminate\Support\Facades\Auth;

class GatepassService
{
    public function handle($gatepass, $gatepassProducts, $gatepassDetails)
    {
        if ($gatepass->exists) {
            $this->createOrUpdateGatepassProducts($gatepassProducts, $gatepass);
        }
        $this->createGatepassDetails($gatepassDetails, $gatepass);
    }
    private function createOrUpdateGatepassProducts($gatepassProducts, $gatepass)
    {
        if ($gatepassProducts->isNotEmpty()) {
            $gatepassProducts->each(function ($gatepassProduct) use ($gatepass) {
                $existingGatepassProduct = GatepassProduct::where('gatepass_id', $gatepass->id)
                    ->where('product_id', $gatepassProduct['product_id'])
                    ->first();

                if ($existingGatepassProduct) {
                    $existingGatepassProduct->update([
                        'delivered_quantity' => $gatepassProduct['delivered_quantity'],
                        'repaired_quantity' => $gatepassProduct['repaired_quantity'],
                        'returned_quantity' => $gatepassProduct['delivered_quantity'] - $gatepassProduct['repaired_quantity'],
                    ]);
                } else {
                    GatepassProduct::create([
                        'gatepass_id' => $gatepass->id,
                        'product_id' => $gatepassProduct['product_id'],
                        'delivered_quantity' => $gatepassProduct['delivered_quantity'],
                        'repaired_quantity' => $gatepassProduct['repaired_quantity'],
                        'returned_quantity' => $gatepassProduct['delivered_quantity'] - $gatepassProduct['repaired_quantity'],
                        'serial_number' => $gatepassProduct['serial_number'],
                        'approved_by' => Auth::id(),
                        'is_approved' => 1,
                        'status' => 1,
                    ]);
                }
            });
        }

        if ($gatepass->job_card_id !== null) {
            $gatepass->jobCard->update(['status' => 7]);
        }
    }

    private function createGatepassDetails($gatepassDetails, $gatepass)
    {
        $gatepassDetails->each(function ($gatepassDetail) use ($gatepass) {
            GatepassDetail::create([
                'gatepass_id' => $gatepass->id,
                'product_id' => $gatepassDetail['product_id'],
                'quoted_quantity' => $gatepassDetail['quoted_quantity'],
            ]);
        });
    }
}