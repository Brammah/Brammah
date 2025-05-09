<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            SimpleExcelReader::create(storage_path('data/Accounts.xlsx'), 'xlsx')
                ->getRows()
                ->each(function (array $rowProperties) {
                    $accountCategoryId = AccountCategory::where('name', '=', $rowProperties['Category'])->first()->id ?? 113;
                    $parentId = Account::where('name', '=', $rowProperties['Parent'])->first()->id ?? null;

                    Account::create(
                        [
                            'account_category_id' => empty($accountCategoryId) ? null : $accountCategoryId,
                            'parent_id' => empty($parentId) ? null : $parentId,
                            'name' => $rowProperties['Name'],
                            'code' => empty($rowProperties['Code']) ? null : $rowProperties['Code'],
                            'transacting_status' => $rowProperties['Transacting'],
                            'status' => 1,
                        ]);
                });
        });

    }
}