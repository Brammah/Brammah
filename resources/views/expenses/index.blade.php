@extends('layouts.app')

@section('title', 'Expenses')

@section('header')
    <h1 class="mb-0 text-gray-900 d-flex flex-column fw-bold fs-3">Expenses</h1>
    <ul class="pt-1 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Expense Management</li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="text-gray-900 breadcrumb-item">Expenses</li>
    </ul>
@endsection

@section('main-content')
    <div class="mb-3 card">
        <div class="card-body my-n4">
            <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                <div class="accordion-header d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#expense_filters">
                    <span class="accordion-icon">
                        <i class="my-2 fa-solid fa-arrow-right text-dark fs-4 fw-bolder"></i>
                    </span>
                    <h3 class="my-2 fs-4 fw-semibold ms-4">Filters</h3>
                </div>

                <div id="expense_filters" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_2">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-select form-select-sm" data-control="select2"
                                data-placeholder="select expense category" name="expense_category_id"
                                id="expense_category_id">
                                <option></option>
                                <option value="0" selected>All</option>
                                @foreach ($expenseCategories as $expenseCategory)
                                    <option value="{{ $expenseCategory->id }}">
                                        {{ $expenseCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="date" name="start_date" id="start_date" class="form-control form-control-sm"
                                value="{{ old('start_date') }}" placeholder="select start date" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @error('start_date')
                                <span
                                    class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <input type="date" name="end_date" id="end_date" placeholder="select end date"
                                class="form-control form-control-sm" value="{{ old('end_date') }}">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @error('end_date')
                                <span
                                    class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <a href="#" class="btn btn-secondary btn-sm btn-flex btn-center btn-active-light-primary"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
                                data-kt-menu="true">
                                <div class="px-3 menu-item">
                                    <span id="btnGetExpenses" class="px-3 menu-link text-dark">Submit</span>
                                </div>
                                <div class="px-3 menu-item">
                                    <span type="reset" class="px-3 menu-link text-dark" id="btnReset">Reset</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow-sm card">
        <div class="mt-3 card-header">
            <div class="card-title flex-column">
                <h3 class="mb-1 fw-bold">Expenses</h3>
                <div class="mb-2 text-gray-400 ">List of Expenses</div>
            </div>

            <div class="my-1 card-toolbar">
                <a href="{{ route('expense.create') }}" class="btn btn-primary btn-sm me-5">
                    New Expense
                </a>
            </div>
        </div>

        <div class="pt-0 card-body">
            <div class="table-responsive">
                <table class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                    id="expenses-list">
                    <thead>
                        <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                            <th> #</th>
                            <th> Date</th>
                            <th> Expense Category</th>
                            <th> Description</th>
                            <th> Status</th>
                            <th> Amount(KES)</th>
                            <th> Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
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
                    <p>Are you sure you want to delete this Expense?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_expense_delete">
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
            const btnReset = $('#btnReset');
            const endDateInput = $('#end_date');
            const startDateInput = $('#start_date');
            const btnGetExpenses = $('#btnGetExpenses');
            const expenseCategorySelectInput = $('#expense_category_id');

            startDateInput.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->startOfMonth()->format('Y-m-d'))
            });

            endDateInput.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            initializeDatatable();

            btnGetExpenses.on('click', function() {
                initializeDatatable();
            });

            btnReset.on('click', function() {
                $('#expense_category_id').val('');
                $('#start_date').val('');
                $('#end_date').val('');

                location.reload();
            });

            function initializeDatatable() {
                if ($.fn.DataTable.isDataTable("#expenses-list")) {
                    $('#expenses-list').DataTable().clear().destroy();
                }

                let table = $('#expenses-list').DataTable({
                    processing: true,
                    serverSide: true,
                    dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start my-2'f>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'B>" +
                        ">" +
                        "<'table-responsive'tr>" +
                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">",
                    ajax: {
                        url: "{{ route('get-expenses') }}",
                        type: "GET",
                        data: function(d) {
                            d.start_date = startDateInput.val();
                            d.end_date = endDateInput.val();
                            d.expense_category_id = expenseCategorySelectInput.val();
                        }
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
                            data: 'expense_category',
                            name: 'expense_category'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
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
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api();

                        $.ajax({
                            url: "{{ route('expenses.get-totals') }}",
                            method: 'GET',
                            data: {
                                start_date: startDateInput.val(),
                                end_date: endDateInput.val(),
                                expense_category_id: expenseCategorySelectInput.val(),
                            },
                            success: function(data) {
                                $(api.column(0).footer()).html('<b>Totals:</b>');
                                $(api.column(5).footer()).html('<b>' + data
                                    .totalExpenseAmount + '</b>');
                            },
                            error: function(error) {
                                toastr.error('Error fetching total aggregates:', error);
                            }
                        });
                    },
                });

                table.on('draw', function() {
                    KTMenu.createInstances();
                });
            }

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const deleteForm = document.getElementById('form_expense_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                console.log(url)
                deleteForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
