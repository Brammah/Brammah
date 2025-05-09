@extends('layouts.app')

@section('title', 'Banks')

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="m-0 text-gray-900 fs-2 fw-bold">Banks</h1>
        <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                    <i class="text-gray-500 ki-outline ki-home fs-7"></i>
                </a>
            </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Credit Control</li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Banks </li>
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
                                <a href="{{ route('bank-account.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Bank Accounts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('receipt.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Receipts</span>
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
                <h3 class="mb-1 fw-bold">Banks</h3>
                <div class="mb-2 text-gray-400 ">List of Banks</div>
            </div>

            <div class="my-1 card-toolbar">
                @can('add bank')
                    <a href="{{ route('bank.create') }}" class="btn btn-primary btn-sm">New Bank</a>
                @endcan
            </div>
        </div>

        <div class="pt-0 card-body">
            <div class="table-responsive">
                <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                    id="banks-table">
                    <thead>
                        <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                            <th> #</th>
                            <th> Parent Bank</th>
                            <th> Name</th>
                            <th> Status</th>
                            <th> Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="deleteConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Deletion Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete this Bank?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_bank_delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bold hover-scale">Yes
                            Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const table = $('#banks-table').DataTable({
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
                    url: "{{ route('bank.index') }}",
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'parent',
                        name: 'parent'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
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

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const deleteForm = document.getElementById('form_bank_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                deleteForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
