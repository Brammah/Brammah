@use('Carbon\Carbon')

<div class="table-responsive">
    <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
        id="customer-invoices">
        <thead class="text-uppercase">
            <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                <th> #</th>
                <th>Inv Date</th>
                <th>Due Date</th>
                <th>Invoice Number</th>
                <th>Invoice Term</th>
                <th>Currency</th>
                <th>Invoice Amount Inclsv</th>
                <th>Outstanding Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ Carbon::parse($invoice->date)->format('d/M/Y') }}</td>
                    <td>{{ Carbon::parse($invoice->due_date)->format('d/M/Y') }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->paymentTerm->name ?? '-' }}</td>
                    <td>{{ $invoice->currency->code }}</td>
                    <td>{{ number_format($invoice->invoice_amount_inclusive_vat, 2) }}</td>
                    <td>{{ number_format($invoice->outstanding_balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="6"><b>Totals</b></td>
            <td><b>{{ number_format($invoices->sum('invoice_amount_inclusive_vat'), 2) }}</b></td>
            <td><b>{{ number_format($invoices->sum('outstanding_balance'), 2) }}</b></td>
        </tfoot>
    </table>
</div>
