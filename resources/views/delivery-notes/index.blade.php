@extends('layouts.app')

@section('title', 'Delivery Notes')

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="m-0 text-gray-900 fs-2 fw-bold">Delivery Notes</h1>
        <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                    <i class="text-gray-500 ki-outline ki-home fs-7"></i>
                </a>
            </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Material & Dispatch Management</li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Delivery Notes</li>
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
                    <div class="text-gray-900 fs-5 fw-bold">Material & Dispatch</div>
                </div>

                <div class="border-gray-200 separator"></div>

                <div class="flex-col px-4 py-2 d-flex">
                    <div class="mb-3">
                        <ul>
                            <li>
                                <a href="{{ route('material-request.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Material Requests</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('invoice.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Invoices</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('gatepass.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Gatepass</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('return-reason.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Return Reasons</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('job-return.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Job Returns</span>
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
    <div class="mb-5 card mb-xxl-8 ">
        <div class="pb-0 rounded ">
            <ul
                class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bold card-body border-end border-primary border-3">
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 active" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#job-card-dnotes">Quotation with Job Cards Delivery Notes</a>
                </li>

                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#cash-dnotes">Counter Sale & Direct Quotations Delivery Notes</a>
                </li>

                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#job-return-dnotes">Job Return Delivery Notes</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="job-card-dnotes" role="tabpanel">
            <div class="shadow-sm card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Delivery Notes for Quotations with Job Cards</h3>
                        <div class="mb-2 text-gray-400 ">List of Delivery Notes for Quotations with Job Cards</div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add delivery note')
                            <a href="{{ route('quotation-delivery-note.create') }}" class="btn btn-primary btn-sm">
                                New Quotation DNote
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="pt-0 card-body ">
                    <div class="table-responsive">
                        <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                            id="quotations-dnotes-table">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>DNote Number</th>
                                    <th>Customer</th>
                                    <th>Customer LPO</th>
                                    <th>Job Card</th>
                                    <th>Inspection</th>
                                    <th>Quotation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="cash-dnotes" role="tabpanel">
            <div class="shadow-sm card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Delivery Notes for Cash Sale Quotations or Counter Sales</h3>
                        <div class="mb-2 text-gray-400 ">List of Delivery Notes for Cash Sale Quotations or Counter Sales
                        </div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add delivery note')
                            <a href="{{ route('sale-delivery-note.create') }}" class="btn btn-primary btn-sm">
                                New Cash Sale DNote
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="pt-0 card-body ">
                    <div class="table-responsive">
                        <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                            id="cash-sales-dnotes-table">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>DNote Number</th>
                                    <th>Customer</th>
                                    <th>Customer LPO</th>
                                    <th>Sale</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="job-return-dnotes" role="tabpanel">
            <div class="shadow-sm card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Delivery Notes</h3>
                        <div class="mb-2 text-gray-400 ">List of Job Return Delivery Notes</div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add delivery note')
                            <a href="{{ route('job-return-delivery-note.create') }}" class="btn btn-primary btn-sm">
                                New Job Return DNote
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="pt-0 card-body ">
                    <div class="table-responsive">
                        <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                            id="job-returns-dnotes-table">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>DNote Number</th>
                                    <th>Customer</th>
                                    <th>Customer LPO</th>
                                    <th>Job Card</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="approveConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Approve Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>Approving this Material Request will decrement the Stock Levels of the products in this request.</p>
                    <p>Are you sure you want to approve this Material Request?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_materal_request_approve">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success font-weight-bold hover-scale">Yes
                            Approve</button>
                    </form>
                </div>
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
                    <p>Deleting this Delivery Note also deletes all its related information.</p>
                    <p>Are you sure you want to delete this Delivery Note?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_material_request_delete">
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
            const quotationsDnoteTable = $('#quotations-dnotes-table').DataTable({
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
                    url: "{{ route('delivery-notes.quotation') }}",
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'delivery_note_number',
                        name: 'delivery_note_number'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'customer_lpo_number',
                        name: 'customer_lpo_number'
                    },
                    {
                        data: 'jobCard',
                        name: 'jobCard'
                    },
                    {
                        data: 'jobInspection',
                        name: 'jobInspection'
                    },
                    {
                        data: 'quotation',
                        name: 'quotation'
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

            const cashSalesDnoteTable = $('#cash-sales-dnotes-table').DataTable({
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
                    url: "{{ route('delivery-notes.sale') }}",
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'delivery_note_number',
                        name: 'delivery_note_number'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'customer_lpo_number',
                        name: 'customer_lpo_number'
                    },
                    {
                        data: 'sale',
                        name: 'sale'
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

            const jobReturnsDnoteTable = $('#job-returns-dnotes-table').DataTable({
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
                    url: "{{ route('delivery-notes.job-return') }}",
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'delivery_note_number',
                        name: 'delivery_note_number'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'customer_lpo_number',
                        name: 'customer_lpo_number'
                    },
                    {
                        data: 'jobCard',
                        name: 'jobCard'
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

            quotationsDnoteTable.on('draw', function() {
                KTMenu.createInstances();
            });

            cashSalesDnoteTable.on('draw', function() {
                KTMenu.createInstances();
            });

            jobReturnsDnoteTable.on('draw', function() {
                KTMenu.createInstances();
            });

            const approveConfirmationModal = document.getElementById('approveConfirmationModal')
            const approveForm = document.getElementById('form_materal_request_approve')
            approveConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                approveForm.setAttribute('action', url)
            });

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const deleteForm = document.getElementById('form_material_request_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                deleteForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
