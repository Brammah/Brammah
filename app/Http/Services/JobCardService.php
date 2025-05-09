<?php
namespace App\Http\Services;

use App\Http\Helpers\CustomerHelper;
use App\Models\Customer;
use App\Models\CustomerDriver;
use App\Models\JobCardProduct;

class JobCardService
{
    public function handle($jobCard, $jobCardProducts, $request, $validatedJobCardData)
    {
        $this->saveJobCardProducts($jobCard, $jobCardProducts);

        if ($jobCard->exists()) {
            $this->updateJobCardProducts($jobCard, $jobCardProducts);
        }

        if ($request->customer_type == 'new') {
            $this->createOrUpdateJobCardCustomer($request, $jobCard);
        }

        if ($request->customer_type !== 'new' && $jobCard->customer) {
            $this->bindDriverToCustomer($request, $jobCard->customer);
        }

        $this->saveNatureOfComplains($request, $jobCard);
    }

    private function saveJobCardProducts($jobCard, $jobCardProducts)
    {
        if ($jobCardProducts->isNotEmpty()) {
            $jobCardProducts->each(function ($jobCardProduct) use ($jobCard) {
                JobCardProduct::updateOrCreate(
                    [
                        'job_card_id'        => $jobCard->id,
                        'product_id'         => $jobCardProduct['product_id'],
                        'serial_number'      => $jobCardProduct['serial_number'],
                        'delivered_quantity' => $jobCardProduct['delivered_quantity'],
                        'quantity_to_repair' => $jobCardProduct['quantity_to_repair'],
                    ]
                );
            });
        }
    }
    private function updateJobCardProducts($jobCard, $jobCardProducts)
    {
        JobCardProduct::where('job_card_id', $jobCard->id)->delete();

        if ($jobCardProducts->isNotEmpty()) {
            $jobCardProducts->each(function ($jobCardProduct) use ($jobCard) {
                JobCardProduct::create(
                    [
                        'job_card_id'        => $jobCard->id,
                        'product_id'         => $jobCardProduct['product_id'],
                        'serial_number'      => $jobCardProduct['serial_number'],
                        'delivered_quantity' => $jobCardProduct['delivered_quantity'],
                        'quantity_to_repair' => $jobCardProduct['quantity_to_repair'],
                    ]
                );
            });
        }
    }

    private function saveNatureOfComplains($request, $jobCard)
    {
        if ($request->has('natureOfComplains')) {
            $jobCard->exists
            ? $jobCard->natureOfComplains()->sync($request->natureOfComplains)
            : $jobCard->natureOfComplains()->attach($request->natureOfComplains);
        }
    }

    private function createOrUpdateJobCardCustomer($request, $jobCard)
    {
        $customerData = $request->validate([
            'name'         => ['required', 'string'],
            'email'        => ['nullable', 'email'],
            'phone'        => ['required', 'string'],
            'address'      => ['nullable', 'string'],
            'kra_pin'      => ['nullable', 'string'],
            'company_name' => ['nullable', 'string'],
        ]);

        $driverData = $request->validate([
            'driver_name'  => ['required_with:driver_phone', 'string'],
            'driver_phone' => ['required_with:driver_name', 'string'],
        ]);

        // $customer = Customer::updateOrCreate(
        //     ['email' => $customerData['email']],
        //     $customerData + ['account_type' => 'cash', 'customer_number' => CustomerHelper::getCustomerNumber()]
        // );
        $customer = Customer::create($customerData + ['account_type' => 'cash', 'customer_number' => CustomerHelper::getCustomerNumber()]);

        $jobCard->update(['customer_id' => $customer->id]);

        if ($driverData) {
            CustomerDriver::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                    'phone'       => $driverData['driver_phone'],
                ],
                [
                    'name' => $driverData['driver_name'],
                ]
            );
        }
    }

    private function bindDriverToCustomer($request, $customer)
    {
        $driverData = $request->validate([
            'driver_name'  => ['required_with:driver_phone', 'string'],
            'driver_phone' => ['required_with:driver_name', 'string'],
        ]);

        if ($driverData) {
            CustomerDriver::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                    'phone'       => $driverData['driver_phone'],
                ],
                [
                    'name' => $driverData['driver_name'],
                ]
            );
        }
    }
}