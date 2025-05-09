<?php
namespace Database\Seeders;

use App\Models\PaymentTerm;
use Illuminate\Database\Seeder;

class PaymentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentTerms = [
            ['name' => 'Cash', 'days' => 0],
            ['name' => '7 Days', 'days' => 7],
            ['name' => '14 Days', 'days' => 14],
            ['name' => '15 Days', 'days' => 15],
            ['name' => '21 Days', 'days' => 21],
            ['name' => '30 Days', 'days' => 30],
            ['name' => '45 Days', 'days' => 45],
            ['name' => '60 Days', 'days' => 60],
            ['name' => '90 Days', 'days' => 90],
            ['name' => '100 Days', 'days' => 100],
            ['name' => '120 Days', 'days' => 120],
        ];

        foreach ($paymentTerms as $paymentTerm) {
            PaymentTerm::create($paymentTerm);
        }
    }
}
