<?php
namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'code' => '001',
                'name' => 'Head Office',
            ],
            [
                'code' => '002',
                'name' => 'Branch',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
