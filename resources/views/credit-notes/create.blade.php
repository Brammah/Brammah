@extends('layouts.app')

@section('title', 'Create Credit Note')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Credit Notes</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Credit Control</li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('credit-note.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Create Credit Note</li>
    </ul>
@endsection

@section('main-content')
    <div class="content flex-column-fluid" id="kt_content">
        <form class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
            action="{{ route('credit-note.store') }}" method="post" id="credit-note-form">
            @csrf
            @include('credit-notes.form')
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const creditNoteAmountInput = $('#credit_note_amount');
            const totalVatAmountInput = $('#vat_amount');
            const totalCreditNoteAmount = $('#credit_note_amount_inclusive_vat');
            const customerSelectInput = $('#customer_id');
            const invoiceSelectInput = $('#invoice_id');
            const creditNoteForm = $('#credit-note-form');
            const submitButton = $('#submit_btn');
            const creditNoteDate = $('#date');

            const customers = @json($customers);
            const vatPercentage = @json($vatPercentage);

            const url = '{{ route('credit-note.get-number') }}'
            $.get(url, function(data) {
                $('#credit_note_number').val(data.credit_note_number)
            });

            let invoices = [];

            creditNoteDate.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            initializeUniqueSelect2('customer_id', 'select customer', ['customer-name', 'customer-phone']);

            customerSelectInput.change(function() {
                populateInvoices();
            });

            function populateInvoices() {
                const customerId = customerSelectInput.val();

                invoiceSelectInput.html('<option>Loading...</option>');

                $.ajax({
                    url: '{{ route('credit-note.create') }}',
                    type: 'GET',
                    data: {
                        type: 'invoices',
                        customerId
                    },
                    dataType: 'json',
                    success: function({
                        invoices: fetchedInvoices
                    }) {
                        invoices = fetchedInvoices;
                        invoiceSelectInput.empty();
                        invoiceSelectInput.append(`<option value="" selected>select invoice</option>`);
                        invoices.forEach(invoice => {
                            const invoiceTemplate =
                                `<option value="${invoice.id}">${invoice.invoice_number}</option>`;
                            invoiceSelectInput.append(invoiceTemplate);
                        });
                    },
                    error: function() {
                        invoiceSelectInput.html('<option>Error loading invoices</option>');
                    }
                });
            }

            invoiceSelectInput.change(function() {
                const selectedInvoiceId = parseInt($(this).val());
                const selectedInvoice = invoices.find(invoice => invoice.id === selectedInvoiceId);

                if (selectedInvoice) {

                    console.log(selectedInvoice);

                    $('#bill_to_customer_id').val(selectedInvoice.bill_to_customer_id);
                    $('#currency_id').val(selectedInvoice.currency_id);
                    $('#terms_and_condition_id').val(selectedInvoice.terms_and_condition_id);

                    const data = selectedInvoice.invoice_products.map(invoiceProduct => ({
                        type: invoiceProduct.type,
                        product_id: invoiceProduct.product_id,
                        miscellaneous_charge_id: invoiceProduct.miscellaneous_charge_id,
                        product_name: invoiceProduct.product.name,
                        part_number: invoiceProduct.product.part_number,
                        returned_quantity: invoiceProduct.returned_quantity,
                        invoiced_quantity: invoiceProduct.invoiced_quantity,
                        selling_price: invoiceProduct.selling_price,
                        vat_amount: invoiceProduct.vat_amount,
                        total_amount: invoiceProduct.total_amount,
                    }));

                    invoiceTable.replaceData(data);
                }
            });

            const invoiceTable = new Tabulator("#invoice_products", {
                data: [],
                renderHorizontal: "virtual",
                rowHeight: 50,
                selectable: true,
                layout: "fitColumns",
                columns: [{
                        formatter: "rowSelection",
                        titleFormatter: "rowSelection",
                        align: "center",
                        width: 30,
                        headerSort: false
                    },
                    {
                        title: "Type",
                        field: "type",
                        headerSort: false
                    },
                    {
                        title: "Product Id",
                        field: "product_id",
                        visible: false
                    },
                    {
                        title: "Product Id",
                        field: "miscellaneous_charge_id",
                        visible: false
                    },
                    {
                        title: "Product",
                        field: "product_name",
                        minWidth: 300,
                        headerSort: false,
                        formatter: function(cell) {
                            const productName = cell.getValue();
                            const partNumber = cell.getRow().getData().part_number;
                            return `
                                <div style="font-size: 1em;">${productName}</div>
                                <div style="font-size: 0.8em; color: #777;">Part No: ${partNumber}</div>`;
                        }
                    },
                    {
                        title: "<div>Invoiced<br>Quantity",
                        field: "invoiced_quantity",
                        minWidth: 80,
                        headerSort: false,
                        formatter: cell => formatNumberWithCommas(cell.getValue())
                    },
                    {
                        title: "<div>Returned<br>Quantity",
                        field: "returned_quantity",
                        minWidth: 80,
                        headerSort: false,
                        editor: "input",
                        editorParams: {
                            placeholder: "enter qty"
                        },
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        formatter: cell => formatNumberWithCommas(cell.getValue())
                    },
                    {
                        title: "Rate",
                        field: "selling_price",
                        minWidth: 80,
                        headerSort: false,
                        formatter: cell => formatNumberWithCommas(cell.getValue())
                    },
                    {
                        title: "Total",
                        field: "total_amount",
                        minWidth: 80,
                        headerSort: false,
                        formatter: cell => formatNumberWithCommas(cell.getValue())
                    },
                    {
                        title: "Total VAT",
                        field: "vat_amount",
                        minWidth: 80,
                        headerSort: false,
                        formatter: cell => formatNumberWithCommas(cell.getValue())
                    },
                ],
                layout: "fitColumns"
            });

            function updateInputFields() {
                let creditNoteAmount = 0;
                let vatAmount = 0;
                let totalAmount = 0;

                const selectedRows = invoiceTable.getSelectedRows();

                selectedRows.forEach(function(row) {
                    const rowData = row.getData();

                    const returnedQuantity = parseFloat(rowData.returned_quantity) || 0;
                    const sellingPrice = parseFloat(rowData.selling_price) || 0;

                    const rowTotalAmount = returnedQuantity * sellingPrice;
                    const calculatedVat = vatPercentage / 100;
                    const rowVatAmount = rowTotalAmount * calculatedVat;

                    creditNoteAmount += rowTotalAmount;
                    vatAmount += rowVatAmount;
                    totalAmount += rowTotalAmount + rowVatAmount;
                });

                creditNoteAmountInput.val(creditNoteAmount.toFixed(2));
                totalVatAmountInput.val(vatAmount.toFixed(2));
                totalCreditNoteAmount.val(totalAmount.toFixed(2));
            }

            invoiceTable.on("rowSelectionChanged", function() {
                updateInputFields();
            });

            invoiceTable.on("cellEdited", function(cell) {
                if (cell.getColumn().getField() === 'returned_quantity') {
                    const rowData = cell.getRow().getData();

                    const returnedQuantity = parseFloat(rowData.returned_quantity) || 0;
                    const invoicedQuantity = parseFloat(rowData.invoiced_quantity) || 0;

                    if (returnedQuantity > invoicedQuantity) {
                        toastr.error("Returned quantity cannot exceed invoiced quantity.");
                        rowData.returned_quantity = invoicedQuantity;
                        cell.getRow().update(rowData);
                    }

                    const sellingPrice = parseFloat(rowData.selling_price) || 0;
                    const totalAmount = rowData.returned_quantity * sellingPrice;
                    const calculatedVat = vatPercentage / 100;
                    const vatAmount = totalAmount * calculatedVat;

                    rowData.total_amount = totalAmount;
                    rowData.vat_amount = vatAmount;

                    cell.getRow().update(rowData);

                    updateInputFields();
                }
            });

            function formatNumberWithCommas(value) {
                return value ? parseFloat(value).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) : "0.00";
            }

            function showError(field, message) {
                if (field) {
                    field.addClass('is-invalid');
                    field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
                }
                toastr.error(message);
            }

            const validateForm = () => {
                const requiredFields = [{
                        id: invoiceSelectInput,
                        name: 'Invoice'
                    },
                    {
                        id: customerSelectInput,
                        name: 'Customer'
                    },
                ];

                let isFormValid = true;

                requiredFields.forEach(({
                    id,
                    name
                }) => {
                    if (!id.val()) {
                        showError(id, `${name} is required.`);
                        isFormValid = false;
                    }
                });

                const allRows = invoiceTable.getData();
                const selectedRows = invoiceTable.getSelectedData();

                if (!allRows.length) {
                    showError(null, 'Please select at least one product.');
                    isFormValid = false;
                }

                const rowsWithReturnedQuantity = allRows.filter(row => parseFloat(row.returned_quantity) > 0);
                const selectedRowsWithReturnedQuantity = selectedRows.filter(row => parseFloat(row
                    .returned_quantity) > 0);

                if (rowsWithReturnedQuantity.length > selectedRowsWithReturnedQuantity.length) {
                    showError(null, 'All rows with returned quantity greater than 0 must be selected.');
                    isFormValid = false;
                }

                return isFormValid;
            };

            const appendHiddenField = (name, value) => {
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name
                    })
                    .val(value)
                    .appendTo(creditNoteForm);
            };

            creditNoteForm.submit(function(e) {
                e.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                if (validateForm()) {
                    const selectedRows = invoiceTable.getSelectedData().filter(
                        row => parseFloat(row.returned_quantity) > 0
                    );

                    if (selectedRows.length) {
                        appendHiddenField('invoice_products', JSON.stringify(selectedRows));
                    }

                    this.submit();
                } else {
                    submitButton.attr('disabled', false);
                }
            });
        });
    </script>
@endsection
