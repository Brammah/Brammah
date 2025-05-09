<?php

namespace App\Http\Services;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\CustomerEngagementDetail;
use App\Models\CustomerStatement;
use App\Models\FollowupPlannerDetail;
use App\Models\Invoice;
use App\Models\SalesRepresentative;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QueryInvoiceAPIService
{
    public static function makeGetHttpRequest()
    {
        DB::transaction(function () {
            $perPage = 1000;
            $response = Http::retry(3, 100)->timeout(120)->get(config('debtcollection.outstanding_invoices_debt_collection_api_url'))->json();
            $arrayData = json_decode($response, true);
            $chunkedData = array_chunk($arrayData, $perPage);

            foreach ($chunkedData as $chunk) {
                self::processChunk($chunk, );
            }
        });
    }

    private static function processChunk($chunk)
    {
        $unmatchedCustomers = [];

        foreach ($chunk as $invoiceData) {
            $salesRep = SalesRepresentative::firstOrCreate(['name' => $invoiceData['SALESREP']]);
            $salesRepId = $salesRep->id;
            $branch = Branch::where('code', '=', $invoiceData['ORG_ID'])->first();
            $branchId = $branch ? $branch->id : null;
            $collector = User::where('full_name', '=', $invoiceData['COLLECTOR'])->first();
            $collectorId = $collector ? $collector->id : 9;
            $customer = Customer::query()
                ->where('branch_id', '=', $branchId)
                ->where('account_number', '=', $invoiceData['ACCOUNT_NUMBER'])
                ->lockForUpdate()
                ->first();

            if ($customer) {
                $customerId = $customer->id;
            } else {
                $unmatchedCustomers[] = [
                    'account_number' => $invoiceData['ACCOUNT_NUMBER'],
                    'org_id' => $invoiceData['ORG_ID'],
                ];
                continue;
            }

            Invoice::updateOrCreate(
                [
                    'invoice_number' => $invoiceData['TRX_NUMBER'],
                ],
                [
                    'customer_id' => $customerId,
                    'branch_id' => $branchId ?? $customer->branch_id,
                    'sales_representative_id' => $salesRepId,
                    'currency' => $invoiceData['CURRENCY'],
                    'invoice_date' => Carbon::parse($invoiceData['TRX_DATE'])->format('Y-m-d'),
                    'invoice_due_date' => Carbon::parse($invoiceData['DUE_DATE'])->format('Y-m-d'),
                    'invoice_amount' => $invoiceData['INVOICE_AMOUNT'],
                    'original_amount_due' => $invoiceData['AMOUNT_DUE_ORIGINAL'],
                    'payment_terms' => empty($invoiceData['TERMS']) ? null : $invoiceData['TERMS'],
                    'outstanding_balance' => $invoiceData['AMOUNT_DUE_ORIGINAL'],
                    'overdue_days' => $invoiceData['DUE_AGE_BY_INVOICE'],
                    'pdc_amount' => $invoiceData['PDC_AMT'],
                    'transaction_type' => $invoiceData['TRX_TYPE'],
                    'status' => $invoiceData['STATUS'],
                    'collector_id' => $collectorId,
                    'last_pdc_date' => empty($invoiceData['LAST_PDC_DATE']) ? null : Carbon::parse($invoiceData['LAST_PDC_DATE'])->format('Y-m-d'),
                ]
            );
        }

        if (!empty($unmatchedCustomers)) {
            CustomerService::createNewCustomerAndInvoiceRecords($unmatchedCustomers, $chunk);

            $logMessage = 'Unmatched Customers:';
            foreach ($unmatchedCustomers as $customer) {
                $logMessage .= "\nAccount Number: {$customer['account_number']}, ORG_ID: {$customer['org_id']}";
            }
            Log::channel('nullcustomers')->info($logMessage);
        }
    }

    public static function deleteClosedInvoices()
    {
        $invoices = Invoice::where('status', '=', 'CL')->get();

        $invoices->each(function ($invoice) {
            CustomerEngagementDetail::where('invoice_id', $invoice->id)->delete();
            FollowupPlannerDetail::where('invoice_id', $invoice->id)->delete();
            CustomerStatement::where('invoice_id', $invoice->id)->delete();
            $invoice->delete();
        });

        $count = $invoices->count();

        Log::channel('deletedinvoices')->info("Deleted $count closed invoices.");
    }
}
