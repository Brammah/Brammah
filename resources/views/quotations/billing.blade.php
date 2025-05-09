@extends('layouts.app')

@section('title', 'Confirm Billing Details')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Quotations</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('quotation.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Confirm Billing Details</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Confirm Billing Details</h2>
            </div>
        </div>

        <form action="{{ route('quotation.store-billing', $quotation) }}" class="form" method="post"
            accept-charset="utf-8" id="billing-form">
            @csrf
            <div class="card-body">
                @include('quotations.billing-form')
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

    <!-- Modal -->
    <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Submission Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit the billing details? </p>
                    <ul>
                        <li>If you <b>Confirm</b>, the quotation will be billed to the selected
                            customer,
                        </li>
                        <li>
                            and the quotation will go through the necessary approval checks.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm hover-scale btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm hover-scale btn-success" id="confirmSubmitBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function() {
            const billingForm = $('#billing-form');
            const billToCustomerSelect = $('#bill_to_customer_id');
            const kraPinInput = $('#kra-pin-input');
            const confirmSubmitModal = new bootstrap.Modal($('#confirmSubmitModal')[0]);
            const submitButton = $('#submit-btn');

            billToCustomerSelect.on('change', function() {
                const selectedCustomerId = $(this).val();
                const selectedCustomer = @json($relatedCustomers).find(customer => customer.id ==
                    selectedCustomerId);

                if (selectedCustomer && (!selectedCustomer.kra_pin || selectedCustomer.kra_pin === null)) {
                    kraPinInput.removeClass('d-none');
                } else {
                    kraPinInput.addClass('d-none');
                }
            });

            const initialSelectedCustomerId = billToCustomerSelect.val();
            if (initialSelectedCustomerId) {
                const initialSelectedCustomer = @json($relatedCustomers).find(customer => customer.id ==
                    initialSelectedCustomerId);
                if (initialSelectedCustomer && (!initialSelectedCustomer.kra_pin || initialSelectedCustomer
                        .kra_pin === null)) {
                    kraPinInput.removeClass('d-none');
                }
            }

            function addError(field, message) {
                if (field.next('.invalid-feedback').length === 0) {
                    field.addClass('is-invalid');
                    field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
                }
            }

            function showError(field, message) {
                toastr.error(message);
                if (field) addError(field, message);
            }

            function validateField(field, message) {
                if (!field.val().trim()) {
                    showError(field, message);
                    return false;
                }
                return true;
            }

            billingForm.on('submit', function(e) {
                e.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                let isValid = true;

                const requiredFields = [{
                    id: '#bill_to_customer_id',
                    name: 'Bill To Customer'
                }];

                requiredFields.forEach(({
                    id,
                    name
                }) => {
                    if (!validateField($(id), `${name} is required.`)) {
                        isValid = false;
                    }
                });

                const billToCustomerId = billToCustomerSelect.val();
                const selectedCustomer = @json($relatedCustomers).find(customer => customer.id ==
                    billToCustomerId);
                const kraPinInputField = $('#kra_pin');

                if (selectedCustomer && !selectedCustomer.kra_pin && kraPinInputField && kraPinInputField
                    .val().trim() === '') {
                    isValid = false;
                    addError(kraPinInputField, 'KRA Pin is required for the selected customer.');
                } else {
                    kraPinInputField.removeClass('is-invalid');
                }

                if (isValid) {
                    confirmSubmitModal.show();
                }
                submitButton.attr('disabled', false);
            });

            $('#confirmSubmitBtn').on('click', function() {
                billingForm[0].submit();
                confirmSubmitModal.hide();
            });
        });
    </script>
@endsection
