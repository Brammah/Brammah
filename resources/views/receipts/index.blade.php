@extends('layouts.app')

@section('title', 'Receipts')

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="m-0 text-gray-900 fs-2 fw-bold">Receipts</h1>
        <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                    <i class="text-gray-500 ki-outline ki-home fs-7"></i>
                </a>
            </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Credit Control </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Receipts </li>
        </ul>
    </div>

    <div class="py-2 d-flex align-items-center">
        <div>
            <a href="#" class="border btn btn-sm btn-flex btn-light-success border-success btn-active-primary fw-bold"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                Quick Actions
            </a>

            <div class="menu menu-sub menu-sub-dropdown w-150px w-md-200px" data-kt-menu="true">
                <div class="px-4 py-2">
                    <div class="text-gray-900 fs-5 fw-bold">Credit Control Modules</div>
                </div>

                <div class="border-gray-200 separator"></div>

                <div class="flex-col px-4 py-2 d-flex">
                    <div class="mb-3">
                        <ul>
                            <li>
                                <a href="{{ route('credit-note.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Credit Notes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account-category.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Account Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Accounts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('payment-method.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Payment Methods</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('payment-term.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Payment Terms</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('currency.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Currencies</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bank.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Banks</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bank-account.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Bank Accounts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('supplier-payment.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Supplier Payments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="mt-5 card-header">
            <div class="card-title flex-column">
                <h3 class="mb-1 fw-bold">Receipts</h3>
                <div class="mb-2 text-gray-400 ">List of Receipts</div>
            </div>

            <div class="my-1 card-toolbar">
                @can('add receipt')
                    <a href="{{ route('receipt.create') }}" class="btn btn-primary btn-sm">New Receipt</a>
                @endcan
            </div>
        </div>

        <div class="pt-0 card-body ">
            <div class="table-responsive">
                <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                    id="receipts-table">
                    <thead>
                        <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                            <th> </th>
                            <th> Date</th>
                            <th> Customer</th>
                            <th> Payment <br /> Method</th>
                            <th> Payment <br /> Reference</th>
                            <th> Bank <br /> Account</th>
                            <th> Total <br /> Paid</th>
                            <th> Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const table = $('#receipts-table').DataTable({
                processing: true,
                serverSide: true,
                dom: "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-content-start my-4'f>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'B>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                ajax: {
                    url: "{{ route('receipt.index') }}",
                    type: "GET"
                },
                buttons: [{
                        extend: "pageLength",
                        titleAttr: "Record Count",
                        className: "btn-light-pri",
                    },
                    {
                        extend: "collection",
                        text: '<span><i class="la la-download"></i> Data Export</span>',
                        titleAttr: "Record Export",
                        className: "btn-light-pri",
                        buttons: [{
                                extend: "csvHtml5",
                                text: '<li><span><i class="la la-file-text-o"></i></span>&nbsp;<span>CSV Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "excelHtml5",
                                text: '<li><span><i class="la la-file-excel-o"></i></span>&nbsp;<span>Excel Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "pdfHtml5",
                                text: '<li><span><i class="la la-file-pdf-o"></i></span>&nbsp;<span>PDF Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "copyHtml5",
                                text: '<li><span><i class="la la-copy"></i></span>&nbsp;<span>Copy Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "print",
                                text: '<li><span><i class="la la-print"></i></span>&nbsp;<span>Print Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                        ],
                    },
                ],
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: 'payment_date',
                        name: 'payment_date'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'paymentMethod',
                        name: 'paymentMethod'
                    },
                    {
                        data: 'payment_reference',
                        name: 'payment_reference'
                    },
                    {
                        data: 'bankAccount',
                        name: 'bankAccount'
                    },
                    {
                        data: 'total_paid_amount',
                        name: 'total_paid_amount'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                "columnDefs": [{
                    defaultContent: "-",
                    targets: "_all"
                }],
            });

            table.on('draw', function() {
                KTMenu.createInstances();
            });

            function format(data) {
                let html = `<div id="filteredInvoices_${data.id}"></div>`;
                return html;
            }

            // Clamped Query
            table.on('click', 'td.dt-control', function(e) {
                let tr = e.target.closest('tr');
                let row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                } else {
                    row.child(format(row.data())).show();
                    let receiptId = row.data().id;

                    $.ajax({
                        url: `/receiptInvoices/${receiptId}`,
                        method: 'GET',
                        success: function(response) {
                            $('#filteredInvoices_' + receiptId).html(response.html);
                            $('#receipt-invoices').DataTable();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
