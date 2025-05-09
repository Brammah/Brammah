<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BranchSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            CountySeeder::class,
            BankSeeder::class,
            SystemParameterSeeder::class,
            PaymentTermSeeder::class,
            PaymentMethodSeeder::class,
            UnitOfMeasureSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            StoreSeeder::class,
            // SupplierSeeder::class,
            CurrencySeeder::class,
            ProductSeeder::class,
            VehicleMakeSeeder::class,
            VehicleTypeSeeder::class,
            DriverSeeder::class,
        ]);
    }
}
