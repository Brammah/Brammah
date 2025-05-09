<?php
namespace Database\Seeders;

use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\SupplierHelper;
use App\Models\PaymentTerm;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $paymentTerms = PaymentTerm::pluck('id', 'days')->toArray();

            SimpleExcelReader::create(storage_path('data/Suppliers.xlsx'), 'xlsx')
                ->getRows()
                ->map(function (array $row) use ($paymentTerms) {
                    return [
                        'supplier_code'   => SupplierHelper::getSupplierNumber(),
                        'payment_term_id' => $paymentTerms[$row['Terms']] ?? null,
                        'parent_id'       => $paymentTerms[$row['ParentId']] ?? null,
                        'country_id'      => 113,
                        'type'            => 'local',
                        'name'            => trim($row['Name']),
                        'kra_pin'         => empty($row['Pin']) ? null : trim($row['Pin']),
                        'email'           => empty($row['Email']) ? null : trim($row['Email']),
                        'phone'           => empty($row['Phone']) ? null : GlobalHelper::formatPhoneNumber($row['Phone']),
                        'address'         => '-',
                    ];
                })
                ->each(function (array $data) {
                    Supplier::create($data);
                });
        });
    }
}
