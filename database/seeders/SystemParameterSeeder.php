<?php
namespace Database\Seeders;

use App\Models\SystemParameter;
use Illuminate\Database\Seeder;

class SystemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            ["key" => "company name", "value" => "Bramanjo Enterprises"],
            ["key" => "emails", "value" => "info@bramanjo.com"],
            ["key" => "phone numbers", "value" => "+254711249293"],
            ["key" => "address", "value" => "P.O.Box 1208-00515"],
            ["key" => "website", "value" => "www.bramanjo.com"],
            ["key" => "street", "value" => "Koinange Street"],
            ["key" => "location", "value" => "Nairobi Uptown"],
            ["key" => "city", "value" => "Nairobi, Kenya"],
            ["key" => "kra pin number", "value" => "P00000000H"],
            ["key" => "paybill number", "value" => "123456"],
            ["key" => "vat number", "value" => "123456789"],
            ["key" => "nhif number", "value" => "987654321"],
            ["key" => "nssf number", "value" => "321654987"],
            ["key" => "license number", "value" => "4062469"],
            ["key" => "vat (%)", "value" => "16"],
            ["key" => "withholding tax (2%)", "value" => "2"],
            ["key" => "withholding tax (5%)", "value" => "5"],
            ["key" => "normal sales price (%)", "value" => "30"],
            ["key" => "minimum sales price (%)", "value" => "10"],
            ["key" => "hidden expenses on imports (%)", "value" => "5"],
        ];

        foreach ($parameters as $parameter) {
            SystemParameter::create($parameter);
        }
    }
}
