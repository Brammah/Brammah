<?php
namespace App\Http\Services;

use App\Mail\CreditCustomerRegisteredMail;
use App\Mail\NewCustomerAccountManagerMail;
use App\Models\CustomerContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CustomerService
{
    public static function handle($request, $customer, $customerContacts, $customerAccountData)
    {
        if ($customerContacts->isNotEmpty()) {
            self::createCustomerContacts($customer, $customerContacts);
        }

        DB::transaction(function () use ($customerAccountData, $customer): void {
            self::createAndUpdateCustomerAccountDetails($customerAccountData, $customer);
            self::notifyAdminOfNewCreditCustomer($customer);
        });
    }

    public static function notifyAdminOfNewCreditCustomer($customer)
    {
        if ($customer->account_type == 'credit') {
            defer(function () use ($customer) {
                Mail::to(['jani@easyfuelinjectors.com'])->send(new CreditCustomerRegisteredMail($customer));
            });
        }
    }

    public static function createCustomerContacts($customer, $customerContacts)
    {
        $customerContacts->each(function ($contact) use ($customer) {
            CustomerContact::create([
                'customer_id' => $customer->id,
                'name'        => $contact['contact_name'],
                'email'       => $contact['contact_email'],
                'phone'       => $contact['contact_phone'],
            ]);
        });
    }

    public static function createAndUpdateCustomerAccountDetails($customerAccountData, $customer)
    {
        if ($customer->customerAccounts()->exists()) {
            $customer->customerAccounts()->where('status', 1)->update(['status' => 0]);
        }

        $customerAccount = $customer->customerAccounts()->create($customerAccountData + ['status' => 1]);
        self::updateCustomerAccountData($customerAccount, $customer);
        self::notifyNewAccountManagers($customerAccount);
    }

    public static function notifyNewAccountManagers($customerAccount)
    {
        defer(function () use ($customerAccount) {
            $customerAccount->load(['accountManager', 'customer']);
            Mail::to($customerAccount->accountManager)->queue(new NewCustomerAccountManagerMail($customerAccount));
        });
    }

    public static function updateCustomerAccountData($customerAccount, $customer)
    {
        $customerAccount->customer->update([
            'payment_term_id'     => $customerAccount->payment_term_id,
            'account_manager_id'  => $customerAccount->account_manager_id,
            'billing_currency'    => $customerAccount->currency->code,
            'opening_balance'     => $customerAccount->opening_balance,
            'credit_limit'        => $customerAccount->credit_limit,
            'transacting_account' => true,
            'outstanding_balance' => $customer->outstanding_balance + $customerAccount->opening_balance,
        ]);
    }
}
