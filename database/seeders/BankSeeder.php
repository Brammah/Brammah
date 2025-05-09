<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            'ABC Bank',
            'Absa Bank Kenya',
            'Access Bank Kenya',
            'Bank of Africa',
            'Bank of Baroda',
            'Bank of India',
            'Citibank',
            'Consolidated Bank of Kenya',
            'Cooperative Bank of Kenya',
            'Credit Bank',
            'Development Bank of Kenya',
            'Diamond Trust Bank',
            'Dubai Islamic Bank',
            'Ecobank Kenya',
            'Equity Bank Kenya',
            'Family Bank',
            'First Community Bank',
            'Guaranty Trust Bank Kenya',
            'Guardian Bank',
            'Gulf African Bank',
            'Habib Bank AG Zurich',
            'Housing Finance Company of Kenya',
            'I&M Bank',
            'Imperial Bank Kenya',
            'Kingdom Bank Limited',
            'Kenya Commercial Bank',
            'Mayfair Bank',
            'Middle East Bank Kenya',
            'National Bank of Kenya',
            'NCBA Bank Kenya',
            'Paramount Universal Bank',
            'Prime Bank',
            'SBM Bank Kenya',
            'Sidian Bank',
            'Spire Bank',
            'Stanbic Holdings Plc',
            'Standard Chartered Kenya',
            'United Bank for Africa',
            'Victoria Commercial Bank',
        ];

        foreach ($banks as $bank) {
            Bank::create(['name' => $bank]);
        }
    }
}