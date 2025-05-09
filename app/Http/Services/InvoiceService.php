<?php

namespace App\Http\Services;

use App\Models\InvoiceProduct;
use Carbon\Carbon;

class InvoiceService
{
    public function handle($invoice, $validatedInvoiceProducts)
    {
        $invoice->load(['jobCard', 'jobInspection', 'currency', 'customer', 'deliveryNote', 'paymentTerm']);

        $invoice->update([
            'bill_to_customer_id' => $invoice->quotation->bill_to_customer_id ?? $invoice->sale->bill_to_customer_id ?? null,
            'outstanding_balance' => $invoice->invoice_amount_inclusive_vat,
            'due_date' => Carbon::parse($invoice->date)->addDays((int) ($invoice->paymentTerm->days ?? 0)),
        ]);

        if ($validatedInvoiceProducts->isNotEmpty()) {
            $this->createInvoiceProducts($validatedInvoiceProducts, $invoice);
        }

        if ($invoice->quotation_id !== null && $invoice->is_warranted == 1 && $invoice->jobCard) {
            $this->updateJobCardWarranty($invoice);
        }

        if ($invoice->quotation_id !== null && $invoice->jobCard && $invoice->jobInspection) {
            $this->updateJobCardAndJobInspectionStatuses($invoice);
        }
    }

    private function createInvoiceProducts($validatedInvoiceProducts, $invoice)
    {
        $validatedInvoiceProducts->each(function ($inspectionProduct) use ($invoice) {
            InvoiceProduct::create([
                'invoice_id' => $invoice->id,
                'type' => $inspectionProduct['type'],
                'product_id' => $inspectionProduct['product_id'],
                'quoted_quantity' => $inspectionProduct['quoted_quantity'],
                'invoiced_quantity' => $inspectionProduct['invoiced_quantity'],
                'selling_price' => $inspectionProduct['selling_price'],
                'vat_amount' => $inspectionProduct['vat_amount'],
                'total_amount' => $inspectionProduct['total_amount'],
            ]);
        });
    }

    private function updateJobCardWarranty($invoice)
    {
        $warrantyEndDate = Carbon::parse($invoice->warranty_start_date)->addDays((int) $invoice->warranty_duration);

        $invoice->jobCard->update([
            'warranty_start_date' => $invoice->warranty_start_date,
            'warranty_duration' => $invoice->warranty_duration,
            'warranty_end_date' => $warrantyEndDate,
            'warranty_status' => 'active',
        ]);
    }

    private function updateJobCardAndJobInspectionStatuses($invoice)
    {
        $invoice->jobInspection->update(['status' => 6]);
        $invoice->jobCard->update(['status' => 8]);
    }
}