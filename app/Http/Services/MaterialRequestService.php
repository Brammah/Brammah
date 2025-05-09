<?php
namespace App\Http\Services;

use App\Models\MaterialRequestProduct;
use App\Models\Product;

class MaterialRequestService
{
    public function handle($materialRequest, $validatedMaterialRequestProducts)
    {
        if ($validatedMaterialRequestProducts->isNotEmpty()) {
            $this->processMaterialRequestProducts($validatedMaterialRequestProducts, $materialRequest);
        }
    }

    private function processMaterialRequestProducts($validatedMaterialRequestProducts, $materialRequest)
    {
        $validatedMaterialRequestProducts->each(function ($materialRequestProduct) use ($materialRequest) {

            $product = Product::find($materialRequestProduct['product_id']);

            MaterialRequestProduct::create([
                'material_request_id' => $materialRequest->id,
                'product_id'          => $materialRequestProduct['product_id'],
                'issued_quantity'     => $materialRequestProduct['issue_quantity'] ?? 0,
                'cost_price'          => $product->cost_price,
                'total_amount'        => $product->cost_price * ($materialRequestProduct['issue_quantity'] ?? 0),

            ]);
        });
    }

}
