@extends('layouts.app')

@section('title', 'Agents')

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="m-0 text-gray-900 fs-2 fw-bold">Agents</h1>
        <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
                <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                    <i class="text-gray-500 ki-outline ki-home fs-7"></i>
                </a>
            </li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Card Management</li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Agent Management</li>
            <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
            <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Agents</li>
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
                                <a href="{{ route('quotation.index') }}" class="text-dark fw-bold fw-semibold fs-6 me-2"
                                    target="_blank">
                                    <span>Quotations</span>
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
    <div class="shadow-sm card">
        <div class="mt-5 card-header">
            <div class="card-title flex-column">
                <h3 class="mb-1 fw-bold">Agents</h3>
                <div class="mb-2 text-gray-400 ">List of Agents</div>
            </div>

            <div class="my-1 card-toolbar">
                @can('add agent')
                    <a href="{{ route('agent.create') }}" class="btn btn-primary btn-sm">New Agent</a>
                @endcan
            </div>
        </div>

        <div class="pt-0 card-body">
            <div class="table-responsive">
                <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                    id="agents-table">
                    <thead>
                        <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                            <th> #</th>
                            {{-- <th> Parent Agent</th> --}}
                            <th> Type</th>
                            <th> Code</th>
                            <th> Name</th>
                            <th> Payment Type</th>
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
                    <p>Are you sure you want to delete this Agent?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_agent_delete">
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
            const table = $('#agents-table').DataTable({
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
                    url: "{{ route('agent.index') }}",
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
                                extend: "excelHtml5",
                                text: '<li><span><i class="la la-file-excel-o text-dark"></i></span>&nbsp;<span>Excel Export</span></li>',
                                action: function(e, dt, node, config) {
                                    const url = "{{ route('agents.excel-export') }}";
                                    window.location = url;
                                },
                            },
                            {
                                extend: "pdfHtml5",
                                text: '<li><span><i class="la la-file-pdf-o text-dark"></i></span>&nbsp;<span>PDF Export</span></li>',
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
                    // {
                    //     data: 'parent',
                    //     name: 'parent'
                    // },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'agent_code',
                        name: 'agent_code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
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
            const deleteForm = document.getElementById('form_agent_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                deleteForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
