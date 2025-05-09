<?php

namespace App\Http\Helpers;

use App\Models\MaterialRequest;
use App\Models\MaterialRequestProduct;
use App\Models\QuotationProduct;

class MaterialRequestHelper
{
    public static function shouldShowGetMore(MaterialRequest $materialRequest)
    {
        $showGetMore = false;

        if ($materialRequest->approval_type === 'partial') {
            if (in_array($materialRequest->type, ['quotation', 'cash-sale-quotation'])) {
                $quotationProducts = QuotationProduct::where('quotation_id', $materialRequest->quotation_id)->get();
                $materialRequestProducts = MaterialRequestProduct::where('material_request_id', $materialRequest->id)->get();

                $showGetMore = $quotationProducts->every(function ($quotationProduct) use ($materialRequestProducts) {
                    $materialRequestProduct = $materialRequestProducts->firstWhere('product_id', $quotationProduct->product_id);

                    if ($materialRequestProduct) {
                        return $materialRequestProduct->issued_quantity === $quotationProduct->issue_quantity;
                    }

                    return false;
                });
            } elseif ($materialRequest->type === 'sale') {
                $showGetMore = $materialRequest->materialRequestProducts->every(function ($product) {
                    return $product->issued_quantity === $product->sold_quantity;
                });
            }
        }

        return $showGetMore;
    }
}
