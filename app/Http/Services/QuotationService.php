<?php
namespace App\Http\Services;

use App\Http\Helpers\CustomerHelper;
use App\Mail\BelowMarginQuotationMail;
use App\Mail\RestockRequiredForQuotedMaterialsMail;
use App\Models\Agent;
use App\Models\AgentEarning;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Product;
use App\Models\QuotationCharge;
use App\Models\QuotationProduct;
use App\Models\StoreInventory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QuotationService
{
    public function handle($quotation, $validatedQuotationProducts, $validatedMiscellaneousCharges, $request)
    {
        $quotation->load(['jobCard.agent', 'jobInspection', 'currency', 'customer', 'creator']);

        if ($validatedQuotationProducts->isNotEmpty()) {
            $this->createQuotationProducts($validatedQuotationProducts, $quotation);

            $hasZeroIssueQuantity = $validatedQuotationProducts->contains(function ($product) {
                return $product['quoted_quantity'] > 0 && $product['issue_quantity'] == 0;
            });

            $hasZeroQuoteAndIssueQuantity = $validatedQuotationProducts->contains(function ($product) {
                return $product['quoted_quantity'] == 0 && $product['issue_quantity'] == 0;
            });

            $hasLowPriceProduct = $quotation->quotationProducts->contains(function ($product) {
                return $product->selling_price < $product->system_selling_price;
            });

            if ($hasZeroIssueQuantity) {
                $quotation->update(['status' => 2]);
            }

            if ($hasZeroQuoteAndIssueQuantity) {
                $quotation->update(['is_testing' => 1]);
            }

            if ($hasLowPriceProduct) {
                $this->sendLowPriceEmail($quotation);
            }
        }

        if ($validatedMiscellaneousCharges->isNotEmpty()) {
            $this->createQuotationCharges($validatedMiscellaneousCharges, $quotation);
        }

        if ($quotation->is_referral == true && $quotation->agent_id !== null) {
            $this->recordAgentEarnings($quotation);
        }

        if ($quotation->jobCard && $quotation->jobInspection) {
            $this->updateJobCardAndJobInspectionStatuses($quotation);
        }

        if ($quotation->quotation_type == 'new-customer-quotation') {
            $this->createNewCustomerAndUpdateQuotationCustomer($quotation, $request);
        }

        $this->createAccountManager($quotation);

        if ($quotation->customer && $quotation->customer->account_type == 'credit') {
            $this->validateCostApprovalStatus($quotation);
        }

        $this->notifyUsersOfLowStock($quotation);
    }

    private function createNewCustomerAndUpdateQuotationCustomer($quotation, $request)
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

        $quotation->update(['customer_id' => $customer->id]);

        if ($quotation->account_manager_id !== null) {
            $customer->update(['account_manager_id' => $quotation->account_manager_id]);
        }
    }

    private function createQuotationProducts($validatedQuotationProducts, $quotation)
    {
        $productIds = $validatedQuotationProducts->pluck('product_id')->toArray();
        $products   = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $validatedQuotationProducts->each(function ($inspectionProduct) use ($quotation, $products) {

            $product            = $products[$inspectionProduct['product_id']] ?? null;
            $systemSellingPrice = $product ? $product->selling_price : 0;

            QuotationProduct::create([
                'quotation_id'         => $quotation->id,
                'product_id'           => $inspectionProduct['product_id'],
                'quoted_quantity'      => $inspectionProduct['quoted_quantity'],
                'issue_quantity'       => $inspectionProduct['issue_quantity'],
                'selling_price'        => $inspectionProduct['selling_price'],
                'system_selling_price' => $systemSellingPrice,
                'vat_amount'           => $inspectionProduct['vat_amount'],
                'total_amount'         => $inspectionProduct['total_amount'],
            ]);
        });
    }

    private function sendLowPriceEmail($quotation)
    {
        if ($quotation->creator) {
            defer(function () use ($quotation) {
                $creatorEmail = $quotation->creator->email;
                Mail::to($creatorEmail)->queue(new BelowMarginQuotationMail($quotation));
            });
        } else {
            Log::error("Quotation creator is null for quotation ID: " . $quotation->id);
        }
    }

    private function createQuotationCharges($validatedMiscellaneousCharges, $quotation)
    {
        $validatedMiscellaneousCharges->each(function ($inspectionCharge) use ($quotation) {
            QuotationCharge::create([
                'quotation_id'            => $quotation->id,
                'product_id'              => $inspectionCharge['product_id'],
                'miscellaneous_charge_id' => $inspectionCharge['miscellaneous_charge_id'],
                'price'                   => $inspectionCharge['price'],
                'quantity'                => $inspectionCharge['quantity'],
                'vat_amount'              => $inspectionCharge['vat_amount'],
                'total_amount'            => $inspectionCharge['total_amount'],
            ]);
        });
    }

    private function createAccountManager($quotation)
    {
        if ($quotation->account_manager_id !== null && $quotation->customer) {
            $quotation->customer->update(['account_manager_id' => $quotation->account_manager_id]);
        }
    }

    private function recordAgentEarnings($quotation)
    {
        $agent = Agent::whereId($quotation->agent_id)->first();

        $earnedAmount = $agent->payment_type == 'percentage'
        ? ($quotation->agent_earning / 100) * $quotation->quotation_amount
        : $quotation->agent_earning;

        $vatRate     = 0.16;
        $vatAmount   = $earnedAmount * $vatRate;
        $totalAmount = $earnedAmount + $vatAmount;

        AgentEarning::create([
            'quotation_id'        => $quotation->id,
            'agent_id'            => $quotation->agent_id,
            'earning_date'        => $quotation->date,
            'payment_type'        => $agent->payment_type,
            'vat_amount'          => $vatAmount,
            'earned_amount'       => $earnedAmount,
            'total_amount'        => $totalAmount,
            'outstanding_balance' => $earnedAmount,
        ]);
    }

    private function updateJobCardAndJobInspectionStatuses($quotation)
    {
        $quotation->jobInspection->update(['status' => 2]);
        $quotation->jobCard->update(['status' => 2]);

        if ($quotation->is_testing == true) {
            $quotation->jobCard->update(['is_testing' => true]);
        }
    }

    private function notifyUsersOfLowStock($quotation)
    {
        $quotationProductIds = $quotation->quotationProducts->pluck('product_id')->toArray();
        $issuedQuantities    = $quotation->quotationProducts()->get(['product_id', 'issue_quantity'])->toArray();

        $storeInventories = StoreInventory::whereIn('product_id', $quotationProductIds)
            ->get(['product_id', 'quantity'])
            ->keyBy('product_id')
            ->toArray();

        $emailsToNotify = [];

        foreach ($issuedQuantities as $quoted) {
            $productId      = $quoted['product_id'];
            $quotedQuantity = $quoted['issue_quantity'];

            if (isset($storeInventories[$productId]) && $quotedQuantity > $storeInventories[$productId]['quantity']) {
                $emailsToNotify[] = $quotation->creator->email;
                $emailsToNotify[] = $quotation->customer->accountManager->email ?? 'jani@easyfuelinjectors.com';
            }
        }

        $emailsToNotify = array_unique($emailsToNotify);

        if (! empty($emailsToNotify)) {
            $this->sendRestockEmail($emailsToNotify, $issuedQuantities, $quotation, $storeInventories);
        }
    }

    private function sendRestockEmail($emailsToNotify, $issuedQuantities, $quotation, $storeInventories)
    {
        foreach ($emailsToNotify as $email) {
            try {
                $quotationCreatorEmail = $quotation->creator->email;
                $accountManagerEmail   = $email;

                Mail::to($accountManagerEmail)
                    ->cc($quotationCreatorEmail)
                    ->queue(new RestockRequiredForQuotedMaterialsMail($quotation, $issuedQuantities, $storeInventories));
            } catch (\Exception $e) {
                Log::error("Failed to send restock email to {$accountManagerEmail}: " . $e->getMessage());
            }
        }
    }

    private function validateCostApprovalStatus($quotation)
    {
        $isApproved = $this->validateCustomerQuotationCostApproval($quotation);

        $quotation->update([
            'is_cost_approved' => $isApproved ? 0 : 1,
        ]);

        // $quotation->customer->update(['status' => 2]);
    }

    private function validateCustomerQuotationCostApproval($quotation)
    {
        $customerAccount = CustomerAccount::where('customer_id', $quotation->customer_id)->where('status', 1)->first();

        $customer                = $quotation->customer;
        $customerCreditLimit     = $customer->credit_limit ?? 0;
        $totalAllowedOverdueDays = $customer->paymentTerm->days ?? 0;
        $maximumAllowedInvoices  = $customerAccount->maximum_invoices ?? 0;
        $totalOutstandingBalance = CustomerHelper::getOutstandingBalance($customer);
        $customerPendingInvoices = $customer->invoices()
            ->where('outstanding_balance', '>', 0)
            ->where('overdue_days', '>', $totalAllowedOverdueDays)
            ->count();
        $hasOverdueInvoices = $customer->invoices()
            ->where('outstanding_balance', '>', 0)
            ->where('overdue_days', '>', $totalAllowedOverdueDays)
            ->exists();

        $failsApproval = $totalOutstandingBalance > $customerCreditLimit || $maximumAllowedInvoices < $customerPendingInvoices || $hasOverdueInvoices;

        return ! $failsApproval;
    }
}
