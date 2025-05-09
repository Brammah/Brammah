<?php

namespace App\Http\Actions;

use App\Models\Currency;

class CustomerAccountAction
{
    public function handle($customerAccount)
    {
        $billingCurrency = Currency::where('id', $customerAccount->currency_id)->first();

        $customerAccount->customer->update([
            'billing_currency' => $billingCurrency->code,
            'credit_limit' => $customerAccount->credit_limit,
            'opening_balance' => $customerAccount->opening_balance,
            'payment_term_id' => $customerAccount->payment_term_id,
            'account_manager_id' => $customerAccount->account_manager_id,
        ]);

    }
}