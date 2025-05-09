<?php

namespace App\Http\Helpers;

use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Invoice;
use App\Models\Quotation;

class CustomerHelper
{
    public static function getCustomerNumber()
    {
        $lastCustomerNumber = Customer::selectRaw('CAST(SUBSTRING(customer_number, 7) AS UNSIGNED) as num')
            ->orderByDesc('num')
            ->value('num') ?? 0;

        $currentCustomerNumber = $lastCustomerNumber + 1;

        $customerNumber = 'CSTMR-' . str_pad($currentCustomerNumber++, 5, '0', STR_PAD_LEFT);

        return $customerNumber;
    }

    public static function getOutstandingBalance(Customer $customer)
    {
        $finalBalance = 0;

        $openingBalance = Customer::where('id', $customer->id)
            ->selectRaw('SUM(opening_balance) as balance')
            ->value('balance');
        $finalBalance += $openingBalance ?? 0;

        $invoiceBalance = Invoice::where('customer_id', $customer->id)
            ->selectRaw('SUM(outstanding_balance) as balance')
            ->value('balance');
        $finalBalance += $invoiceBalance ?? 0;

        return round($finalBalance, 2);
    }

    public static function validateCustomerQuotationCostApproval($quotation)
    {
        $customerAccount = CustomerAccount::where('customer_id', $quotation->customer_id)->where('status', 1)->first();

        $customer = $quotation->customer;
        $customerCreditLimit = $customer->credit_limit ?? 0;
        $totalAllowedOverdueDays = $customer->paymentTerm->days ?? 0;
        $maximumAllowedInvoices = $customerAccount->maximum_invoices ?? 0;
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

        return !$failsApproval; // Returns true if approved, false otherwise
    }

    public function saveQuotation(Quotation $quotation)
    {
        $isApproved = self::validateCustomerQuotationCostApproval($quotation);

        $quotation->update([
            'is_cost_approved' => $isApproved ? 0 : 1,
        ]);
    }

}