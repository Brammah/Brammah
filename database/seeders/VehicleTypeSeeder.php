<?php
namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleTypes = [
            'Commercial',
            'Generator',
            'Forklift',
            'Saloon',
        ];

        foreach ($vehicleTypes as $vehicleType) {
            VehicleType::create(['name' => $vehicleType]);
        }
    }
}
