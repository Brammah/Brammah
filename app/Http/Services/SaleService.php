<?php
namespace App\Http\Services;

use App\Http\Helpers\CustomerHelper;
use App\Mail\BelowMarginSaleMail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleProduct;
use id;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SaleService
{
    public function handle($sale, $validatedSaleProducts, $request)
    {
        $sale->load([
            'currency',
            'customer',
            'quotation' => [
                'jobCard',
                'jobInspection',
            ],
        ]);

        if ($validatedSaleProducts->isNotEmpty()) {
            $this->createSaleProducts($validatedSaleProducts, $sale);

            $hasLowPriceProduct = $sale->saleProducts->contains(function ($product) {
                return $product->selling_price < $product->system_selling_price;
            });

            if ($hasLowPriceProduct) {
                $this->sendLowPriceEmail($sale);
            }
        }

        if ($sale->sale_type == 'new-customer-sales') {
            $this->createNewCustomerAndUpdateSaleCustomer($sale, $request);
        }

        $this->createAccountManager($sale);

    }
    private function createAccountManager($sale)
    {
        if ($sale->account_manager_id !== null && $sale->customer) {
            $sale->customer->update(['account_manager_id' => $sale->account_manager_id]);
        }
    }

    private function createNewCustomerAndUpdateSaleCustomer($sale, $request)
    {
        $customerData = $request->validate([
            'name'         => ['required', 'string'],
            'email'        => ['nullable', 'string'],
            'phone'        => ['required', 'string'],
            'address'      => ['nullable', 'string'],
            'kra_pin'      => ['nullable', 'string'],
            'company_name' => ['nullable', 'string'],
        ]);

        $customer = Customer::create($customerData + ['account_type' => 'cash', 'customer_number' => CustomerHelper::getCustomerNumber()]);

        $sale->update(['customer_id' => $customer->id]);
    }

    private function createSaleProducts($validatedSaleProducts, $sale)
    {
        $productIds = $validatedSaleProducts->pluck('product_id')->toArray();
        $products   = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $validatedSaleProducts->each(function ($saleProduct) use ($sale, $products) {

            $product            = $products[$saleProduct['product_id']] ?? null;
            $systemSellingPrice = $product ? $product->selling_price : 0;

            SaleProduct::create([
                'sale_id'              => $sale->id,
                'product_id'           => $saleProduct['product_id'],
                'sale_quantity'        => $saleProduct['sale_quantity'],
                'selling_price'        => $saleProduct['selling_price'],
                'system_selling_price' => $systemSellingPrice,
                'vat_amount'           => $saleProduct['vat_amount'],
                'total_amount'         => $saleProduct['total_amount'],
            ]);
        });
    }

    private function sendLowPriceEmail($sale)
    {
        if ($sale->creator) {
            defer(function () use ($sale) {
                $creatorEmail = $sale->creator->email;
                Mail::to($creatorEmail)->queue(new BelowMarginSaleMail($sale));
            });
        } else {
            Log::error("Sale creator is null for sale ID: " . $sale->sale_number);
        }
    }
}