<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\Transaction;

class AccountService
{
    public static function getAccountBalance(Account $account)
    {
        // DEBIT BALANCE (ASSETS, EXPENSES)
        // CREDIT BALANCE (LIABILITIES, REVENUE, EQUITY)
        $finalBalance = 0;

        if (count($account->descendants)) {
            foreach ($account->descendants as $acc) {
                switch ($account->accountCategory->name) {
                    case "ASSETS":
                    case "EXPENSES":
                        $finalBalance += Transaction::where('account_id', $acc->id)
                            ->selectRaw('SUM(debit-credit) as balance')
                            ->first()
                            ->balance;
                        break;
                    case "LIABILITIES":
                    case "REVENUE":
                    case "EQUITY":
                        $finalBalance += Transaction::where('account_id', $acc->id)
                            ->selectRaw('SUM(credit-debit) as balance')
                            ->first()
                            ->balance;
                        break;
                }
            }
        } else {
            switch ($account->accountCategory->name) {
                case "ASSETS":
                case "EXPENSES":
                    $finalBalance = Transaction::where('account_id', $account->id)
                        ->selectRaw('SUM(debit-credit) as balance')
                        ->first()
                        ->balance;
                    break;
                case "LIABILITIES":
                case "REVENUE":
                case "EQUITY":
                    $finalBalance = Transaction::where('account_id', $account->id)
                        ->selectRaw('SUM(credit-debit) as balance')
                        ->first()
                        ->balance;
                    break;
            }
        }

        $finalBalance = round($finalBalance, 2);

        return $finalBalance;
    }
}