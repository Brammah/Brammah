@use('Carbon\Carbon')
@use('Illuminate\Support\Number')
@use('App\Http\Helpers\InvoiceHelper')

<!doctype html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .w-quarter {
            width: 25%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .margin-bottom {
            margin-bottom: 4px;
        }

        .footer {
            font-size: 10px;
            padding: 1rem;
            text-align: left;
            position: fixed;
            bottom: 0;
        }

        .notice {
            font-size: 8.5px;
            padding: 1rem;
            text-align: left;
            position: fixed;
            bottom: 100px;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 8px;
        }

        table.products tr {
            background-color: #166dbe;
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
            text-align: left;
        }

        table.products tfoot {
            color: #ffffff;
            padding: 0.5rem;
            text-align: left;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding-left: 8px;
            padding-bottom: 4px;
            font-size: 8.75px;
        }

        .table-warning {
            background-color: #ffc107 !important;
        }

        .total {
            text-align: right;
            margin-top: 12px;
            margin-bottom: 12px;
            font-size: 10px;
        }

        .text-items {
            padding: 1px;
            font-size: 10px;
        }

        .system-info {
            padding: 1px;
            font-size: 12px;
            text-align: right;
        }

        .recipient-info {
            padding: 1px;
            font-size: 11px;
            text-align: left;
        }

        .standard-font {
            font-size: 0.875rem;
            margin-top: 4px;
            font-family: "Roboto";
        }

        .content-wrapper {
            flex: 1;
        }
    </style>

    <body>
        <table class="w-full">
            <tr>
                <td class="w-half" style="text-align: left;">
                    <h2>OUTSTANDING INVOICES</h2>
                </td>
                <td class="w-half" style="text-align: right;">
                    <img src="{{ public_path('assets/media/logos/logo.png') }}" alt="{{ config('app.name') }}"
                        width="65" />
                </td>
            </tr>
        </table>

        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div class="system-info" style="text-align: left;">
                        <b>Customer Name:</b> {{ $data['customerName'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Account Number:</b> {{ $data['customerNumber'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Reminder Date:</b> {{ $data['reminderDate'] }}
                    </div>
                </td>
                <td class="w-half">
                    <div>
                        <table>
                            <td class="w-half">
                                <div class="system-info"><b>APEX STEEL LIMITED</b></div>
                                <div class="system-info">collections@apex-steel.com</div>
                                <div class="system-info">P.O Box 18441-00500 Nairobi, Kenya</div>
                                <div class="system-info">27-29 Funzi Road, Off Enterprise Road, Industrial Area</div>
                            </td>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <hr />
        <table class="w-full">
            <tr style="margin-top:36px">
                <td class="w-half">
                    <div>
                        <table>
                            <td class="w-half">
                                <div class="recipient-info"><b>OUTSTANDING INVOICES SUMMARY.</b></div>
                                <div class="recipient-info">
                                    @foreach ($data['branchBalances'] as $branchName => $balance)
                                        <div style="margin-left: 4px;">
                                            @php
                                                $branchInvoices = $data['invoices']->filter(function ($invoice) use (
                                                    $branchName,
                                                ) {
                                                    return optional($invoice->branch)->name === $branchName;
                                                });

                                                $branchTotalBalance = $branchInvoices->sum('outstanding_balance');
                                            @endphp
                                            <strong>{{ $branchName }}:</strong> KES
                                            {{ number_format($branchTotalBalance, 2) }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </table>
                    </div>
                </td>
                {{-- <td class="w-half">
                    <div>
                        <table>
                            <td class="w-half">
                                <div class="recipient-info" style="text-align: right;"><b>Sales Representative:</b>
                                    {{ $data['salesRep'] }}</div>
                                <div class="recipient-info" style="text-align: right;"><b>Collector:</b>
                                    {{ $data['collector'] }}</div>
                            </td>
                        </table>
                    </div>
                </td> --}}
            </tr>
        </table>

        <div class="content-wrapper">
            <div class="margin-top">
                <div class="recipient-info margin-bottom"><b>OUTSTANDING INVOICES</b></div>

                @foreach ($data['branchBalances'] as $branchName => $branchBalance)
                    <div class="recipient-info margin-bottom"><b>{{ $branchName }}</b>
                        @php
                            $branchCollector =
                                $data['invoices']->where('branch.name', $branchName)->first()->collector->full_name ??
                                '-';
                            $branchSalesRep =
                                $data['invoices']->where('branch.name', $branchName)->first()->salesRepresentative
                                    ->name ?? '-';
                        @endphp
                        <div class="margin-bottom">
                            <b>Collector:</b> {{ $branchCollector }},
                            <span> <b>Sales Rep:</b> {{ $branchSalesRep }}</span>
                        </div>
                    </div>
                    <table class="products margin-bottom">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>Invoice Date</th>
                                <th>Due Date</th>
                                <th>Last PDC Date</th>
                                <th>Payment Terms</th>
                                <th>Overdue Days</th>
                                <th>Invoice Amount</th>
                                <th>PDC Amount</th>
                                <th>Outstanding Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['invoices']->where('branch.name', $branchName) as $index => $invoice)
                                @php
                                    $overdueDays = $invoice->overdue_days;
                                    $highlightClass = $overdueDays > 0 ? 'table-warning' : '';
                                @endphp

                                <tr class="items {{ $highlightClass }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>
                                        {{ Carbon::parse($invoice->invoice_date)->format('d/M/Y') }}
                                    </td>
                                    <td>
                                        {{ Carbon::parse($invoice->invoice_due_date)->format('d/M/Y') }}
                                    </td>
                                    <td>{{ $invoice->last_pdc_date ?? '-' }}</td>
                                    <td>{{ $invoice->payment_terms ?? '-' }}</td>
                                    <td>{{ $invoice->overdue_days }}</td>
                                    <td style="text-align: right;">
                                        {{ number_format($invoice->invoice_amount, 2) }}
                                    </td>
                                    <td style="text-align: right;">
                                        {{ number_format($invoice->pdc_amount, 2) }}
                                    </td>
                                    <td style="text-align: right;">
                                        {{ number_format($invoice->outstanding_balance, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7"><b>Branch Total</b></td>
                                <td style="text-align: right;">
                                    {{ number_format($branchBalance['branchTotalInvoiceAmount'], 2) }}
                                </td>
                                <td style="text-align: right;">
                                    {{ number_format($branchBalance['branchTotalPdcAmount'], 2) }}</td>
                                <td style="text-align: right;">
                                    {{ number_format($branchBalance['branchTotalOutstandingBalance'], 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endforeach
            </div>


            <div class="total">
                <b>Grand Total: KES {{ number_format($data['invoices']->sum('outstanding_balance'), 2) }} </b> <br />
                ({{ $data['totalOutstandingBalanceToWords'] }})
            </div>

            <div class="notice">
                <table class="w-full margin-top">
                    <tr>
                        <div class="text-items">
                            <b>Declaration</b>
                            <p>
                                If you encounter any discrepancies in the data or have any questions or require further
                                assistance, please don't hesitate to reach out to the Sales Representative or the
                                Collector
                                as indicated above.
                            </p>

                            <p>
                                We appreciate your ongoing support!
                            </p>
                        </div>
                    </tr>
                </table>
            </div>

            <div class="footer margin-top">
                <div>&copy; Apex Steel Limited</div>
            </div>
        </div>
    </body>

</html>
