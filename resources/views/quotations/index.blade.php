@extends('layouts.app')

@section('title', 'Quotations')

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="m-0 text-gray-900 fs-2 fw-bold">Quotations</h1>
        <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                    <i class="text-gray-500 ki-outline ki-home fs-7"></i>
                </a>
            </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Card Management</li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Quotations</li>
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
                    <div class="text-gray-900 fs-5 fw-bold">Job Card Modules</div>
                </div>

                <div class="border-gray-200 separator"></div>

                <div class="flex-col px-4 py-2 d-flex">
                    <div class="mb-3">
                        <ul>
                            <li>
                                <a href="{{ route('miscellaneous-charge.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Miscellaneous Charges</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Agents</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent-earning.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Agent Earnings</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('job-card.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Job Cards</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('job-inspection.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Job Inspections</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('terms-and-condition.index') }}"
                                    class="text-dark fw-bold fw-semibold fs-6 me-2" target="_blank">
                                    <span>Terms & Conditions</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sale.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Counter Sales</span>
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
                        role="tab" href="#jobcard-quotations">Job Card Quotations</a>
                </li>

                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#cash-quotations">Cash Sale Quotations</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="jobcard-quotations" role="tabpanel">
            <div class="shadow-sm card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Job Card Quotations</h3>
                        <div class="mb-2 text-gray-400 ">List of Job Card Quotations</div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add quotation')
                            <a href="{{ route('quotation.create') }}" class="btn btn-primary btn-sm">
                                New Quotation
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="pt-0 card-body ">
                    <div class="table-responsive">
                        <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                            id="jobcard-quotations-table">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th> #</th>
                                    <th>Date</th>
                                    <th>Quote Number</th>
                                    <th>Customer</th>
                                    <th>Job Card</th>
                                    <th>Inspection</th>
                                    <th>Currency</th>
                                    <th>Total Cost</th>
                                    <th>Approval Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="cash-quotations" role="tabpanel">
            <div class="shadow-sm card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Cash Sale Quotations</h3>
                        <div class="mb-2 text-gray-400 ">List of Cash Sale Quotations</div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add quotation')
                            <a href="{{ route('quotation.create') }}" class="btn btn-primary btn-sm">
                                New Quotation
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="pt-0 card-body ">
                    <div class="table-responsive">
                        <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                            id="cash-quotations-table">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th> #</th>
                                    <th>Date</th>
                                    <th>Quote Number</th>
                                    <th>Customer</th>
                                    <th>Currency</th>
                                    <th>Total Cost</th>
                                    <th>Approval Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="costApproveConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Cost Approval Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <p>This Quotation needs cost approval for it has failed to meet the minimum requirements for it to be
                        fully approved</p>
                    <p>Given the above, you can contact the Customer and agree on the way forward.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="GET" id="form_quotation_conditionally_approve" class="d-inline">
                        <button type="submit" class="btn btn-sm btn-success font-weight-bold hover-scale">
                            Conditionally Approve
                        </button>
                    </form>
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
                    <p>Are you sure you want to approve this Quotation?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_quotation_approve" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success font-weight-bold hover-scale">
                            Yes Approve
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="rejectConfirmationModal">
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
                    <p>Are you sure you want to reject this Quotation?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_quotation_reject">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bold hover-scale">
                            Yes Reject
                        </button>
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
                    <p>Deleting this Quotation also deletes all its related information.</p>
                    <p>Are you sure you want to delete this Quotation?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_quotation_delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bold hover-scale">Yes
                            Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="reviseConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Revision Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>Revising this Quotation also revises all its related information.</p>
                    <p>Are you sure you want to revise this Quotation?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_quotation_revise">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bold hover-scale">
                            Yes Revise
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const currentCustomerQuotations = $('#jobcard-quotations-table').DataTable({
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
                    url: "{{ route('quotations.jobcard') }}",
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
                        data: 'quotation_number',
                        name: 'quotation_number'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
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
                        data: 'currency',
                        name: 'currency'
                    },
                    {
                        data: 'quotation_amount_inclusive_vat',
                        name: 'quotation_amount_inclusive_vat'
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved'
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
                "createdRow": function(row, data, dataIndex) {
                    if (data.is_low_stock) {
                        $(row).addClass('highlight-low-stock');
                    }
                }
            });
            const newCustomerQuotationTable = $('#cash-quotations-table').DataTable({
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
                    url: "{{ route('quotations.cash') }}",
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
                        data: 'quotation_number',
                        name: 'quotation_number'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'currency',
                        name: 'currency'
                    },
                    {
                        data: 'quotation_amount_inclusive_vat',
                        name: 'quotation_amount_inclusive_vat'
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved'
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
                "createdRow": function(row, data, dataIndex) {
                    if (data.is_low_stock) {
                        $(row).addClass('highlight-low-stock');
                    }
                }
            });

            currentCustomerQuotations.on('draw', function() {
                KTMenu.createInstances();
            });

            newCustomerQuotationTable.on('draw', function() {
                KTMenu.createInstances();
            });

            const approveConfirmationModal = document.getElementById('approveConfirmationModal');
            const approveForm = document.getElementById('form_quotation_approve');

            approveConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const approvalUrl = button.getAttribute('data-bs-url');
                approveForm.setAttribute('action', approvalUrl);
            });

            // const approveConfirmationModal = document.getElementById('approveConfirmationModal');
            // const approveForm = document.getElementById('form_quotation_approve');
            // const billingDetailsButton = document.getElementById('billingDetailsButton');

            // approveConfirmationModal.addEventListener('show.bs.modal', function(event) {
            //     const button = event.relatedTarget;
            //     const approvalUrl = button.getAttribute('data-bs-url');
            //     const billingUrl = button.getAttribute('data-bs-billing-url');

            //     approveForm.setAttribute('action', approvalUrl);
            //     billingDetailsButton.setAttribute('href', billingUrl);
            // });

            const costApproveConfirmationModal = document.getElementById('costApproveConfirmationModal');
            const costApproveForm = document.getElementById('form_quotation_conditionally_approve');

            costApproveConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const costApprovalUrl = button.getAttribute('data-bs-url');

                costApproveForm.setAttribute('action', costApprovalUrl);
            });


            const rejectConfirmationModal = document.getElementById('rejectConfirmationModal')
            const rejectForm = document.getElementById('form_quotation_reject')
            rejectConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                rejectForm.setAttribute('action', url)
            });

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const deleteForm = document.getElementById('form_quotation_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                deleteForm.setAttribute('action', url)
            });

            const reviseConfirmationModal = document.getElementById('reviseConfirmationModal')
            const reviseForm = document.getElementById('form_quotation_revise')
            reviseConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                reviseForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
