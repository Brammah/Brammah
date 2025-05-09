@extends('layouts.app')

@section('title', 'Create Delivery Note')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Delivery Notes</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Sales Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('delivery-note.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Create Delivery Note</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Delivery Note</h2>
            </div>
        </div>

        <form action="{{ route('delivery-note.store') }}" class="form" method="post" accept-charset="utf-8"
            id="delivery-note-form">
            @csrf
            <div class="card-body">
                @include('delivery-notes.form')
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
            const costInput = $('#cost');
            const priceInput = $('#price');
            const deliveryNoteDate = $('#date');
            const submitButton = $('#submit_btn');
            const quotationSelectInput = $('#quotation_id');
            const deliveryTypeSelectInput = $('#delivery_type');
            const deliveryNoteForm = $('#delivery-note-form');
            const addedCharges = {};
            const quotations = @json($quotations);
            $('#type').on('change', function() {
                const selectedType = $(this).val();
                const url = '{{ route('delivery-note.get-delivery-note-number') }}?type=' + selectedType;

                $.get(url, function(data) {
                    $('#delivery_note_number').val(data.delivery_note_number);
                }).fail(function() {
                    alert('Error fetching delivery note number');
                });
            });
            deliveryNoteDate.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            initializeUniqueSelect2('quotation_id', 'select quotation', [
                'quotation-number',
                'customer',
                'jobcard-number',
                'inspection-number',
            ]);

            quotationSelectInput.on('change', function() {
                const quotation = quotations.find(quotation => quotation.id == parseInt($(
                    this).val()));

                if (quotation) {
                    $('#customer_id').val(quotation.customer_id);
                    $('#job_card_id').val(quotation.job_card?.id || '');
                    $('#job_inspection_id').val(quotation.job_inspection?.id || '');
                } else {
                    $('#customer_id').val('');
                    $('#job_card_id').val('');
                    $('#job_inspection_id').val('');
                }
            });

            const quotationTable = new Tabulator("#delivery_note_products", {
                renderHorizontal: "virtual",
                rowHeight: 50,
                selectable: true,
                columns: [{
                        formatter: "rowSelection",
                        titleFormatter: "rowSelection",
                        align: "center",
                        width: 30,
                        headerSort: false
                    },
                    {
                        title: "Product Id",
                        field: "product_id",
                        visible: false,
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
                        title: "Quoted Quantity",
                        field: "quoted_quantity",
                        headerSort: false,
                    },
                    // {
                    //     title: "Delivered Quantity",
                    //     field: "delivered_quantity",
                    //     headerSort: false,
                    // },
                    {
                        title: "Quantity to Deliver",
                        field: "quantity_to_deliver",
                        editor: "input",
                        cellEdited: calculateRow,
                        editorParams: {
                            elementAttributes: {
                                type: "number",
                                min: "0",
                            },
                        }
                    },
                ],
                layout: "fitColumns",
            });

            function calculateRow(cell) {
                let data = cell.getRow().getData();

                let quantityToDeliver = parseFloat(data.quantity_to_deliver) || 0;
                let deliveredQuantity = parseFloat(data.delivered_quantity) || 0;
                let quotedQuantity = parseFloat(data.quoted_quantity) || 0;
                let remainingQuantity = quotedQuantity - deliveredQuantity;

                if (quantityToDeliver > quotedQuantity) {
                    toastr.error(
                        `Quantity to deliver (${quantityToDeliver}) cannot exceed the quoted quantity (${quotedQuantity})!`
                    );
                    cell.setValue(Math.min(quotedQuantity, quantityToDeliver));
                } else if (quantityToDeliver !== quotedQuantity) {
                    toastr.error(
                        `Quantity to deliver (${quantityToDeliver}) must match the quoted quantity (${quotedQuantity})!`
                    );
                    cell.setValue(Math.min(quotedQuantity, quantityToDeliver));
                }
                // else if (quantityToDeliver > remainingQuantity) {
                //     toastr.error(
                //         `Quantity to deliver (${quantityToDeliver}) cannot exceed the remaining quantity (${remainingQuantity})!`
                //     );
                //     cell.setValue(Math.min(remainingQuantity, quantityToDeliver));
                // }
            }

            quotationSelectInput.change(function() {
                const quotation = quotations.find(quotation => quotation.id == parseInt($(this).val()));

                if (quotation) {
                    quotationTable.setData([]);

                    let data = [];

                    if (quotation.job_card && quotation.job_card.job_card_products.length > 0) {
                        data = quotation.job_card.job_card_products.map(jobCardProduct => {
                            return {
                                product_id: jobCardProduct.product_id,
                                product_name: jobCardProduct.product.name,
                                part_number: jobCardProduct.product.part_number,
                                quoted_quantity: jobCardProduct.quantity_to_repair,
                                quantity_to_deliver: jobCardProduct.quantity_to_repair,
                            };
                        });
                    } else {
                        data = quotation.quotation_products.map(quotationProduct => {
                            return {
                                product_id: quotationProduct.product_id,
                                product_name: quotationProduct.product.name,
                                part_number: quotationProduct.product.part_number,
                                quoted_quantity: quotationProduct.quoted_quantity,
                                quantity_to_deliver: quotationProduct.quoted_quantity,
                            };
                        });
                    }

                    quotationTable.setData(data);

                    if (data.length > 10) {
                        quotationTable.setHeight(400);
                    }
                }
            });

            const validatePrice = function(cell, value) {
                return Number(value) >= 0;
            }

            function addError(field, message) {
                field.addClass('is-invalid');
                field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
            }

            deliveryNoteForm.submit(function(e) {
                e.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                const requiredFields = [{
                        id: '#type',
                        name: 'Delivery Note Type'
                    },
                    {
                        id: '#delivery_note_number',
                        name: 'Delivery Note Number'
                    },
                    {
                        id: '#date',
                        name: 'Date'
                    },
                    {
                        id: '#customer_lpo_number',
                        name: 'Customer LPO Number'
                    },
                    {
                        id: '#collector_information',
                        name: 'Collector Information'
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

                let valid = true;
                let invalidProducts = [];
                const allRows = quotationTable.getRows();

                for (const row of allRows) {
                    const productData = row.getData();

                    if (parseInt(productData.quantity_to_deliver) <= 0) {
                        invalidProducts.push(productData.product_name);
                    }

                    if (parseInt(productData.quantity_to_deliver) > 0 && !row.isSelected()) {
                        toastr.info(
                            `Product ${productData.product_name} has an delivered quantity greater than 0 but is not selected. Please select the item to submit.`
                        );
                        valid = false;
                        submitButton.attr('disabled', false);
                        return false;
                    }
                }

                if (invalidProducts.length > 0) {
                    const productList = invalidProducts.join(', ');
                    const errorMessage = invalidProducts.length === 1 ?
                        `Product ${productList} must have an delivered quantity greater than 0.` :
                        `Products ${productList} must have quantities to deliver greater than 0.`;

                    toastr.error(errorMessage);
                    valid = false;
                    submitButton.attr('disabled', false);
                    return false;
                }

                const selectedDeliveryNoteData = quotationTable.getSelectedData();
                if (selectedDeliveryNoteData.length > 0) {
                    const deliveryNoteProducts = JSON.stringify(selectedDeliveryNoteData);
                    const hiddenDeliveryNoteProducts = $(
                        '<input type="hidden" name="delivery_note_products"/>');
                    hiddenDeliveryNoteProducts.val(deliveryNoteProducts);
                    $(this).append(hiddenDeliveryNoteProducts);
                } else {
                    valid = false;
                    toastr.error('Please select at least one product to deliver.');
                }

                if (valid) {
                    this.submit();
                } else {
                    submitButton.attr('disabled', false);
                }
            });

        });
    </script>
@endsection
