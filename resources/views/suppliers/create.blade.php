@extends('layouts.app')

@section('title', 'Create Supplier')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Suppliers</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Suppliers & Customers </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('supplier.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Create Supplier</li>
    </ul>
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Supplier</h2>
            </div>
        </div>

        <form action="{{ route('supplier.store') }}" class="form" method="post" accept-charset="utf-8"
            id="supplier-form">
            @csrf
            <div class="card-body">
                @include('suppliers.form')
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
            const url = '{{ route('supplier.get-code') }}';
            $.get(url, function(data) {
                $('#supplier_code').val(data.supplier_code);
            });

            const createContactSelectInput = $('#create_contact');
            const contactNameInput = $('#contact_name');
            const contactEmailInput = $('#contact_email');
            const contactPhoneInput = $('#contact_phone');
            const supplierForm = $('#supplier-form');
            const submitButton = $('#submit_btn');
            const addContactButton = $('#btn_add_contact');
            const contactDetailsContainer = $('#contactInformation');
            let contactTable;

            createContactSelectInput.on('change', function() {
                const contactDetail = $(this).val();

                if (contactDetail == '1') {
                    contactDetailsContainer.removeClass('d-none');
                    $('#supplier_contacts').removeClass('d-none');
                    $('.separator').removeClass('d-none');

                    if (!contactTable) {
                        contactTable = new Tabulator("#supplier_contacts", {
                            renderHorizontal: "virtual",
                            columns: [{
                                    title: "Name",
                                    field: "contact_name",
                                    headerSort: false
                                },
                                {
                                    title: "Phone",
                                    field: "contact_phone",
                                    headerSort: false
                                },
                                {
                                    title: "Email",
                                    field: "contact_email",
                                    headerSort: false
                                },
                                {
                                    title: "Action",
                                    field: "action",
                                    formatter: "buttonCross",
                                    headerSort: false,
                                    cellClick: function(e, cell) {
                                        if (confirm(
                                                'Are you sure you want to delete this entry?'
                                            )) {
                                            cell.getRow().delete();
                                        }
                                    }
                                }
                            ],
                            layout: "fitColumns",
                        });
                    }

                    addContactButton.click(function() {
                        const contactName = contactNameInput.val().trim();
                        const contactEmail = contactEmailInput.val().trim();
                        const contactPhone = contactPhoneInput.val().trim();

                        if (!contactName && !contactEmail && !contactPhone) {
                            toastr.error('Please fill out all contact details.');
                        } else {
                            contactTable.addData([{
                                contact_name: contactName,
                                contact_phone: contactPhone,
                                contact_email: contactEmail
                            }]);
                            contactNameInput.val('');
                            contactEmailInput.val('');
                            contactPhoneInput.val('');
                        }
                    });

                    function addError(field, message) {
                        field.addClass('is-invalid');
                        field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
                    }

                    supplierForm.submit(function(e) {
                        e.preventDefault();
                        submitButton.attr('disabled', true);

                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');

                        const requiredFields = [{
                                id: '#name',
                                name: 'Supplier Name'
                            },
                            {
                                id: '#country_id',
                                name: 'Country'
                            },
                            {
                                id: '#supplier_code',
                                name: 'Supplier Code'
                            },
                            {
                                id: '#type',
                                name: 'Supplier Type'
                            },
                            {
                                id: '#description',
                                name: 'Description'
                            },
                            {
                                id: '#phone',
                                name: 'Phone'
                            },
                            {
                                id: '#status',
                                name: 'Status'
                            }
                        ];

                        let allFieldsValid = true;
                        requiredFields.forEach(field => {
                            const fieldValue = $(field.id).val();
                            if (!fieldValue) {
                                toastr.error(`${field.name} is required.`);
                                addError($(field.id), `${field.name} is required.`);
                                allFieldsValid = false;
                            }
                        });

                        if (!allFieldsValid) {
                            submitButton.attr('disabled', false);
                            return;
                        }

                        if (createContactSelectInput.val() === '1' && contactTable
                            .getDataCount() === 0) {
                            toastr.error('Please add at least one contact.');
                            submitButton.removeAttr('disabled');
                            return false;
                        }

                        if (contactTable.getDataCount() > 0) {
                            const supplierContacts = JSON.stringify(contactTable.getData());
                            $('<input type="hidden" name="customer_contacts"/>').val(
                                supplierContacts).appendTo(customerForm);
                        }

                        this.submit();
                    });
                } else {
                    contactDetailsContainer.addClass('d-none');
                    $('#supplier_contacts').addClass('d-none');
                    $('.separator').addClass('d-none');

                    if (contactTable) {
                        contactTable.clearData();
                    }
                }
            });
        });
    </script>
@endsection
