@extends('layouts.app')

@section('title', 'Edit Receipt')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Receipts</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Credit Control</li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('receipt.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Edit Receipt</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Edit Receipt</h2>
            </div>
        </div>

        <form action="{{ route('receipt.update', $receipt) }}" class="form" method="post" accept-charset="utf-8">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @include('receipts.edit-form')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12" style="text-align:center">
                        <button type="submit" class="me-2 btn btn-primary btn-sm hover-scale">Submit</button>
                        <button type="reset" class="btn btn-secondary btn-sm hover-scale"
                            onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('js')
    <script>
        $(function() {
            const receipt = @json($receipt);

            initializeUniqueSelect2('bank_account_id', 'select bank account', ['account-name', 'account-number']);

            const data = receipt.invoices.map((invoice, index) => {
                return {
                    index: index + 1,
                    invoice_id: invoice.id,
                    invoice_number: invoice.invoice_number,
                    currency: invoice.currency?.name || 'N/A',
                    date: invoice.date,
                    due_date: invoice.due_date,
                    payment_terms: invoice.payment_term.name,
                    overdue_days: invoice.overdue_days || 0,
                    invoice_amount_inclusive_vat: invoice.invoice_amount_inclusive_vat,
                    outstanding_balance: invoice.outstanding_balance,
                    allocated_amount: invoice.pivot.allocated_amount, // Access pivot data here
                };
            });

            const table = new Tabulator("#receipt_invoices", {
                data,
                rowHeight: 40,
                layout: "fitColumns",
                renderHorizontal: "virtual",
                columns: [{
                        title: "Invoice Id",
                        field: "invoice_id",
                        visible: false
                    },
                    {
                        title: "INV No",
                        field: "invoice_number",
                        headerSort: false
                    },
                    {
                        title: "Currency",
                        field: "currency",
                        headerSort: false
                    },
                    {
                        title: "Date",
                        field: "date",
                        headerSort: false
                    },
                    {
                        title: "Due Date",
                        field: "due_date",
                        headerSort: false
                    },
                    {
                        title: "Terms",
                        field: "payment_terms",
                        headerSort: false
                    },
                    {
                        title: "Overdue Days",
                        field: "overdue_days",
                        headerSort: false
                    },
                    {
                        title: "Invoice Amount",
                        field: "invoice_amount_inclusive_vat",
                        headerSort: false,
                        formatter: cell => parseFloat(cell.getValue()).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })
                    },
                    {
                        title: "Outstanding Balance",
                        field: "outstanding_balance",
                        headerSort: false,
                        formatter: cell => parseFloat(cell.getValue()).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })
                    },
                    {
                        title: "Allocated Amount",
                        field: "allocated_amount",
                        headerSort: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        width: 150,
                    }
                ]
            });
        });
    </script>
@endsection
