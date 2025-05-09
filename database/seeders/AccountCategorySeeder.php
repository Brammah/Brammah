<?php

namespace Database\Seeders;

use App\Models\AccountCategory;
use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountCategories = [
            'ASSETS',
            'LIABILITIES',
            'EQUITY',
            'REVENUE',
            'EXPENSES',
        ];

        foreach ($accountCategories as $accountCategory) {
            AccountCategory::create(['name' => $accountCategory]);
        }
    }
}