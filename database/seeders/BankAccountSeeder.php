<?php
namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bankAccounts = [
            [
                'bank_id'        => 9,
                'account_id'     => 9,
                'account_name'   => 'EASY FUELS INJECTORS',
                'account_number' => '01148497260100',
            ],
            [
                'bank_id'        => 23,
                'account_id'     => 9,
                'account_name'   => 'I&M MPESA',
                'account_number' => '02901206261210',
            ],
            [
                'bank_id'        => 12,
                'account_id'     => 9,
                'account_name'   => 'DIAMOND TRUST BANK',
                'account_number' => '0186276001',
            ],
        ];

        foreach ($bankAccounts as $bankAccount) {
            BankAccount::create($bankAccount);
        }
    }
}
