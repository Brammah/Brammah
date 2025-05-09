@extends('layouts.app')

@section('title', 'Pay Supplier')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Supplier Payments</h1>
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
            <a href="{{ route('supplier-payment.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Pay Supplier</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Pay Supplier</h2>
            </div>
        </div>

        <form action="{{ route('supplier-payment.store') }}" class="form" method="post" accept-charset="utf-8"
            id="supplier-payment-form">
            @csrf
            <div class="card-body">
                @include('supplier-payments.form')
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
            const supplierPaymentForm = $('#supplier-payment-form');
            const submitButton = $('#submit_btn');

            const paymentDate = $('#payment_date');
            const chequeMaturityDate = $('#cheque_maturity_date');

            const chequeNumberInput = $('#cheque_number');
            const chequeTypeSelectInput = $('#cheque_type');
            const bankAccountSelectInput = $('#bank_account_id');
            const cashPaymentReferenceInput = $('#cash_payment_reference');
            const mpesaPaymentReferenceInput = $('#mpesa_payment_reference');
            const bankTransferReferenceInput = $('#bank_transfer_reference');
            const cashDepositPaymentReferenceInput = $('#cash_deposit_payment_reference');
            const paymentTypeSelectInput = $('#payment_type');

            const cashAmountInput = $('#cash_amount');
            const mpesaAmountInput = $('#mpesa_amount');
            const chequeAmountInput = $('#cheque_amount');
            const changeAmountInput = $('#change_amount');
            const totalPaidAmountInput = $('#total_paid_amount');
            const cashDepositAmountInput = $('#cash_deposit_amount');
            const bankTransferAmountInput = $('#bank_transfer_amount');

            const supplierSelectInput = $('#supplier_id');
            const paymentMethodSelectInput = $('#payment_method_id');
            const cashPaymentContainer = $('#cashPaymentContainer');
            const mpesaPaymentContainer = $('#mpesaPaymentContainer');
            const chequePaymentContainer = $('#chequePaymentContainer');
            const cashDepositPaymentContainer = $('#cashDepositPaymentContainer');
            const bankTransferPaymentContainer = $('#bankTransferPaymentContainer');

            const suppliers = @json($suppliers);
            const paymentMethods = @json($paymentMethods);
            const supplierPayments = @json($supplierPayments);

            paymentDate.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            chequeMaturityDate.flatpickr({
                dateFormat: "Y-m-d",
            });

            initializeUniqueSelect2('bank_account_id', 'select bank account', ['account-name', 'account-number']);
            initializeUniqueSelect2('supplier_id', 'select supplier', ['name', 'phone']);

            paymentMethodSelectInput.on('change', function() {
                const selectedValue = paymentMethods.find(paymentMethod => paymentMethod.id === parseInt($(
                    this).val()));

                function clearInputs(container) {
                    container.find('input').val('');
                }

                cashPaymentContainer.addClass('d-none');
                clearInputs(cashPaymentContainer);

                mpesaPaymentContainer.addClass('d-none');
                clearInputs(mpesaPaymentContainer);

                chequePaymentContainer.addClass('d-none');
                clearInputs(chequePaymentContainer);

                bankTransferPaymentContainer.addClass('d-none');
                clearInputs(bankTransferPaymentContainer);

                cashDepositPaymentContainer.addClass('d-none');
                clearInputs(cashDepositPaymentContainer);

                totalPaidAmountInput.val('0');

                if (!selectedValue) return;

                switch (selectedValue.id.toString()) {
                    case '1': // Cash
                        cashPaymentContainer.removeClass('d-none');
                        break;
                    case '2': // MPESA
                        mpesaPaymentContainer.removeClass('d-none');
                        break;
                    case '3': // Cheque
                        chequePaymentContainer.removeClass('d-none');
                        break;
                    case '4': // Cash & MPESA
                        cashPaymentContainer.removeClass('d-none');
                        mpesaPaymentContainer.removeClass('d-none');
                        break;
                    case '5': // Bank Transfer
                        bankTransferPaymentContainer.removeClass('d-none');
                        break;
                    case '6': // Cash & Cheque
                        cashPaymentContainer.removeClass('d-none');
                        chequePaymentContainer.removeClass('d-none');
                        break;
                    case '7': // Cash & Bank Transfer
                        cashPaymentContainer.removeClass('d-none');
                        bankTransferPaymentContainer.removeClass('d-none');
                        break;
                    case '8': // Bank Transfer & MPESA
                        bankTransferPaymentContainer.removeClass('d-none');
                        mpesaPaymentContainer.removeClass('d-none');
                        break;
                    case '9': // Cash Deposit
                        cashDepositPaymentContainer.removeClass('d-none');
                        break;
                }
            });

            paymentMethodSelectInput.on('change', function() {
                const selectedPaymentMethodId = $(this).val();
                const cashPaymentMethods = [1, 4, 6, 7];

                if (cashPaymentMethods.includes(parseInt(selectedPaymentMethodId))) {
                    const url = '{{ route('receipt.get-cash-reference-number') }}?payment_method_id=' +
                        selectedPaymentMethodId;

                    $.get(url, function(data) {
                        $('#cash_payment_reference').val(data
                            .cashReferenceNumber);
                    }).fail(function() {
                        alert('Error fetching cash transaction reference number');
                    });
                } else {
                    $('#cash_payment_reference').val('');
                }
            });

            function updateTotalPaidAmount() {
                const cashAmount = parseFloat(cashAmountInput.val()) || 0;
                const mpesaAmount = parseFloat(mpesaAmountInput.val()) || 0;
                const chequeAmount = parseFloat(chequeAmountInput.val()) || 0;
                const cashDepositAmount = parseFloat(cashDepositAmountInput.val()) || 0;
                const bankTransferAmount = parseFloat(bankTransferAmountInput.val()) || 0;

                const totalPaidAmount = cashAmount + mpesaAmount + chequeAmount + bankTransferAmount +
                    cashDepositAmount;
                totalPaidAmountInput.val(totalPaidAmount.toFixed(2));

                allocateAmountsToInvoices(totalPaidAmount);
            }

            function allocateAmountsToInvoices(totalPaidAmount) {
                totalPaidAmount = parseFloat(totalPaidAmount) || 0;
                const invoices = table.getData().sort((a, b) => b.outstanding_balance - a.outstanding_balance);

                const rowsByInvoiceId = Object.fromEntries(
                    table.getRows().map(row => [row.getData().invoice_id, row])
                );

                let totalOutstandingBalance = 0;

                invoices.forEach(invoice => {
                    let allocatedAmount = 0;

                    const outstandingBalance = parseFloat(invoice.outstanding_balance) || 0;
                    totalOutstandingBalance += outstandingBalance;

                    if (totalPaidAmount > 0) {
                        if (totalPaidAmount >= outstandingBalance) {
                            allocatedAmount = outstandingBalance;
                            totalPaidAmount -= outstandingBalance;
                        } else {
                            allocatedAmount = totalPaidAmount;
                            totalPaidAmount = 0;
                        }
                    }

                    allocatedAmount = parseFloat(allocatedAmount) || 0;

                    const row = rowsByInvoiceId[invoice.invoice_id];
                    if (row) {
                        row.getCell("allocated_amount").setValue(allocatedAmount.toFixed(2));
                    }
                });

                const changeAmount = Math.max(totalPaidAmount, 0);

                changeAmountInput.val(changeAmount.toFixed(2));
            }

            [cashAmountInput, mpesaAmountInput, chequeAmountInput, bankTransferAmountInput, cashDepositAmountInput]
            .forEach(input => {
                input.on('keyup', updateTotalPaidAmount);
            });


            const table = new Tabulator("#purchase_orders", {
                renderHorizontal: "virtual",
                rowHeight: 40,
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
                        title: "LPO Id",
                        field: "purchase_order_id",
                        visible: false
                    },
                    {
                        title: "Lpo Number",
                        field: "lpo_number",
                        headerSort: false
                    },
                    {
                        title: "Invoice Number",
                        field: "supplier_document_number",
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
                        editor: "input",
                        editorParams: {
                            placeholder: "Enter amount"
                        },
                        headerSort: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        width: 150,
                        cellEditing: cell => cell.getElement().querySelector("input")?.classList.remove(
                            "is-invalid"),
                        cellEdited: cell => {
                            const data = cell.getRow().getData();
                            const allocatedAmount = parseFloat(cell.getValue());
                            const outstandingBalance = parseFloat(data.outstanding_balance);
                            const input = cell.getElement().querySelector("input");

                            if (isNaN(allocatedAmount) || allocatedAmount < 0 || allocatedAmount >
                                outstandingBalance) {
                                toastr.error(
                                    'Allocated amount must be less than or equal to Outstanding Balance'
                                );
                                input?.classList.add("is-invalid");
                                cell.getRow().getElement().style.backgroundColor = "#f8d7da";
                            } else {
                                input?.classList.remove("is-invalid");
                                cell.getRow().getElement().style.backgroundColor = "";
                            }
                        }
                    }
                ]
            });

            supplierSelectInput.on('change', function() {
                const supplier = suppliers.find(supplier => supplier.id === parseInt($(this).val()));
                const paymentType = paymentTypeSelectInput.val();

                if (supplier) {
                    table.setData([]);
                    const data = supplier.purchase_orders.map(purchaseOrder => ({
                        purchase_order_id: purchaseOrder.id,
                        lpo_number: purchaseOrder.lpo_number,
                        supplier_document_number: purchaseOrder.supplier_document_number,
                        currency: purchaseOrder.currency.code,
                        date: purchaseOrder.lpo_date,
                        due_date: purchaseOrder.due_date,
                        outstanding_balance: purchaseOrder.outstanding_balance,
                        allocated_amount: 0,
                    }));

                    table.setData(data);

                    if (data.length > 10) {
                        table.setHeight(400);
                    } else {
                        table.setHeight(null);
                    }
                }
            });

            function calculateRow(cell) {
                let data = cell.getRow().getData();
                let allocatedAmount = parseFloat(cell.getValue());
                let outstandingBalance = parseFloat(data.outstanding_balance);

                if (allocatedAmount > outstandingBalance) {
                    alert("Allocated amount cannot exceed the outstanding balance.");
                    cell.setValue(outstandingBalance);
                    return;
                }
                updateTotalAllocatedAmount();
            }

            function updateTotalAllocatedAmount() {
                let totalAllocated = 0;

                table.getRows().forEach(row => {
                    let rowData = row.getData();
                    totalAllocated += parseFloat(rowData.restocked_quantity || 0);
                });

                console.log("Total Allocated Amount:", totalAllocated);
            }

            function addError(field, message) {
                field.addClass('is-invalid');
                field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
            }

            supplierPaymentForm.submit(function(event) {
                event.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                let isFormValid = true;

                function showError(field, message) {
                    toastr.error(message);
                    if (field) addError(field, message);
                    isFormValid = false;
                }

                function validateField(field, message) {
                    if (!field.val().trim()) showError(field, message);
                }

                // Validate select fields
                const selectFields = [{
                        field: supplierSelectInput,
                        message: 'Please select a supplier.'
                    },
                    {
                        field: bankAccountSelectInput,
                        message: 'Please select a bank account.'
                    }
                ];

                selectFields.forEach(({
                    field,
                    message
                }) => validateField(field, message));

                const fieldsToValidate = [{
                        field: 'cheque_number',
                        input: chequeNumberInput,
                        message: 'This cheque number already exists.'
                    },
                    {
                        field: 'mpesa_payment_reference',
                        input: mpesaPaymentReferenceInput,
                        message: 'This MPESA payment reference already exists.'
                    },
                    {
                        field: 'bank_transfer_reference',
                        input: bankTransferReferenceInput,
                        message: 'This bank transfer reference already exists.'
                    },
                    {
                        field: 'cash_deposit_payment_reference',
                        input: cashDepositPaymentReferenceInput,
                        message: 'This cash deposit receipt number already exists.'
                    }
                ];

                fieldsToValidate.forEach(({
                    field,
                    input,
                    message
                }) => {
                    const isDuplicate = supplierPayments.some(supplierPayment => supplierPayment[
                            field] === input.val()
                        .trim());
                    if (isDuplicate) {
                        addError(input, message);
                        toastr.error(message);
                        isFormValid = false;
                    }
                });

                // Validate payment-specific fields based on the payment method
                const paymentMethod = paymentMethodSelectInput.val();
                let paymentSpecificFields = [];

                switch (paymentMethod.toString()) {
                    case '1': // Cash
                        paymentSpecificFields = [{
                                field: cashAmountInput,
                                message: 'Cash Amount is required for Cash Payments.'
                            },
                            {
                                field: cashPaymentReferenceInput,
                                message: 'Cash Reference is required for Cash Payments.'
                            }
                        ];
                        break;

                    case '2': // MPESA
                        paymentSpecificFields = [{
                                field: mpesaAmountInput,
                                message: 'MPESA Amount is required for MPESA Payments.'
                            },
                            {
                                field: mpesaPaymentReferenceInput,
                                message: 'MPESA Reference is required for MPESA Payments.'
                            }
                        ];
                        break;

                    case '3': // Cheque
                        paymentSpecificFields = [{
                                field: chequeAmountInput,
                                message: 'Cheque Amount is required for Cheque Payments.'
                            },
                            {
                                field: chequeNumberInput,
                                message: 'Cheque Number is required for Cheque Payments.'
                            },
                            {
                                field: chequeMaturityDate,
                                message: 'Cheque Maturity Date is required.'
                            },
                            {
                                field: chequeTypeSelectInput,
                                message: 'Cheque Type is required.'
                            }
                        ];
                        break;

                    case '4': // Cash & MPESA
                        paymentSpecificFields = [{
                                field: cashAmountInput,
                                message: 'Cash Amount is required for Cash & MPESA Payments.'
                            },
                            {
                                field: cashPaymentReferenceInput,
                                message: 'Cash Reference is required for Cash & MPESA Payments.'
                            },
                            {
                                field: mpesaAmountInput,
                                message: 'MPESA Amount is required for Cash & MPESA Payments.'
                            },
                            {
                                field: mpesaPaymentReferenceInput,
                                message: 'MPESA Reference is required for Cash & MPESA Payments.'
                            }
                        ];
                        break;

                    case '5': // Bank Transfer
                        paymentSpecificFields = [{
                                field: bankTransferAmountInput,
                                message: 'Bank Transfer Amount is required.'
                            },
                            {
                                field: bankTransferReferenceInput,
                                message: 'Bank Transfer Reference is required.'
                            }
                        ];
                        break;

                    case '6': // Bank Transfer
                        paymentSpecificFields = [{
                                field: cashAmountInput,
                                message: 'Cash Amount is required for Cash & MPESA Payments.'
                            },
                            {
                                field: cashPaymentReferenceInput,
                                message: 'Cash Reference is required for Cash & MPESA Payments.'
                            },
                            {
                                field: chequeAmountInput,
                                message: 'Cheque Amount is required for Cheque Payments.'
                            },
                            {
                                field: chequeNumberInput,
                                message: 'Cheque Number is required for Cheque Payments.'
                            },
                            {
                                field: chequeMaturityDate,
                                message: 'Cheque Maturity Date is required.'
                            },
                            {
                                field: chequeTypeSelectInput,
                                message: 'Cheque Type is required.'
                            }
                        ];
                        break;

                    case '7': // Bank Transfer
                        paymentSpecificFields = [{
                                field: cashAmountInput,
                                message: 'Cash Amount is required for Cash & MPESA Payments.'
                            },
                            {
                                field: cashPaymentReferenceInput,
                                message: 'Cash Reference is required for Cash & MPESA Payments.'
                            },
                            {
                                field: bankTransferAmountInput,
                                message: 'Bank Transfer Amount is required.'
                            },
                            {
                                field: bankTransferReferenceInput,
                                message: 'Bank Transfer Reference is required.'
                            }
                        ];
                        break;

                    case '8': // Bank Transfer
                        paymentSpecificFields = [{
                                field: bankTransferAmountInput,
                                message: 'Bank Transfer Amount is required.'
                            },
                            {
                                field: bankTransferReferenceInput,
                                message: 'Bank Transfer Reference is required.'
                            },
                            {
                                field: mpesaAmountInput,
                                message: 'MPESA Amount is required for MPESA Payments.'
                            },
                            {
                                field: mpesaPaymentReferenceInput,
                                message: 'MPESA Reference is required for MPESA Payments.'
                            }
                        ];
                        break;
                    case '9': // Cash Deposit
                        paymentSpecificFields = [{
                                field: cashDepositAmountInput,
                                message: 'Cash Deposit Amount is required.'
                            },
                            {
                                field: cashDepositPaymentReferenceInput,
                                message: 'Cash Deposit Receipt Number is required.'
                            }
                        ];
                        break;

                        // Add other cases for combined payment methods here

                    default:
                        showError(paymentMethodSelectInput, 'Payment Method is required.');
                }

                // Validate all payment-specific fields
                paymentSpecificFields.forEach(({
                    field,
                    message
                }) => validateField(field, message));

                // Validate selected invoices
                const paidInvoices = table.getSelectedData();
                if (!paidInvoices.length) {
                    toastr.error('Select at least one invoice to proceed.');
                    isFormValid = false;
                }

                if (!isFormValid) {
                    submitButton.attr('disabled', false);
                    return false;
                }

                // Prepare form data
                const receiptInvoices = JSON.stringify(paidInvoices);
                $(this).find("input[name='purchase_orders']").remove();

                const hidden = $('<input type="hidden" name="purchase_orders"/>').val(receiptInvoices);
                $(this).append(hidden);

                this.submit();
            });
        });
    </script>
@endsection
