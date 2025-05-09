@extends('layouts.app')

@section('title', 'Below Cost Remarks - Quote')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Quotations</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Card Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('quotation.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Quotation Low Cost Remarks</li>
    </ul>
@endsection

@section('main-content')
    <div class="content flex-column-fluid" id="kt_content">
        <form class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
            action="{{ route('low-cost-quotation-remarks.store', $quotation) }}" method="post" id="below-cost-form">
            @csrf
            <div class="mb-5 flex-lg-row-auto w-lg-300px me-5 me-lg-5">
                <div class="card card-flush">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Add Remarks</h2>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="gap-5 d-flex flex-column">
                            <div class="fv-row fv-plugins-icon-container">
                                <label class="required form-label fw-bold" for="date">Date:</label>
                                <input type="date" name="date" id="date"
                                    class="mb-2 form-control @error('date') is-invalid @enderror"
                                    placeholder="select job return date" value="{{ old('date', $belowCostRemark->date) }}">
                            </div>

                            <div class="fv-row fv-plugins-icon-container">
                                <label for="quotation_number" class="required form-label fw-bold">Quotation Number:</label>
                                <input type="text"
                                    class="mb-2 border-gray-300 form-control form-control-solid @error('quotation_number') is-invalid @enderror"
                                    placeholder="quotation number"
                                    value="{{ old('quotation_number', $quotation->quotation_number) }}" readonly>
                                <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
                            </div>

                            <div class="fv-row fv-plugins-icon-container">
                                <label for="ideal_quotation_amount_inclusive_vat" class="required form-label fw-bold">
                                    Ideal Quotation Amount (Inclsv):
                                </label>
                                <input type="number" step="any" name="ideal_quotation_amount_inclusive_vat"
                                    id="ideal_quotation_amount_inclusive_vat"
                                    class="mb-2 border-gray-300 form-control form-control-solid @error('ideal_quotation_amount_inclusive_vat') is-invalid @enderror"
                                    placeholder="ideal quote amount inclsv"
                                    value="{{ old('ideal_quotation_amount_inclusive_vat', $belowCostRemark->ideal_quotation_amount_inclusive_vat) }}"
                                    readonly>
                                @error('ideal_quotation_amount_inclusive_vat')
                                    <span
                                        class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="fv-row fv-plugins-icon-container">
                                <label for="quoted_quotation_amount_inclusive_vat" class="required form-label fw-bold">
                                    Quoted Amount (Inclsv):
                                </label>
                                <input type="number" step="any" name="quoted_quotation_amount_inclusive_vat"
                                    id="quoted_quotation_amount_inclusive_vat"
                                    class="mb-2 border-gray-300 form-control form-control-solid @error('quoted_quotation_amount_inclusive_vat') is-invalid @enderror"
                                    placeholder="quoted amount inclsv"
                                    value="{{ old('quoted_quotation_amount_inclusive_vat', $belowCostRemark->quoted_quotation_amount_inclusive_vat) }}"
                                    readonly>
                                @error('quoted_quotation_amount_inclusive_vat')
                                    <span
                                        class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="fv-row fv-plugins-icon-container">
                                <label for="price_difference" class="required form-label fw-bold">
                                    Price Difference:
                                </label>
                                <input type="number" step="any" name="price_difference" id="price_difference"
                                    class="mb-2 border-gray-300 form-control form-control-solid @error('price_difference') is-invalid @enderror"
                                    placeholder="price difference"
                                    value="{{ old('price_difference', $belowCostRemark->price_difference) }}" readonly>
                                @error('price_difference')
                                    <span
                                        class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="py-4 shadow-sm card">
                    <div class="card-header border-bottom">
                        <div class="card-title">
                            <ul class="border-transparent nav nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                                <li class="m-2 nav-item">
                                    <a class="py-2 nav-link text-active-primary ms-0 me-5 active" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" href="#quoted-products">
                                        Quoted Products
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-toolbar">
                            <div class="col-lg-12" style="text-align:center">
                                <button type="submit" class="me-2 btn btn-primary btn-sm hover-scale">Submit</button>
                                <button type="reset" class="btn btn-secondary btn-sm hover-scale"
                                    onclick="window.history.go(-1); return false;">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="quoted-products" role="tabpanel">
                                <div class="mt-5">
                                    <div id="quoted_products" class="border rounded gy-2 fs-6"></div>
                                    <div class="my-10 separator separator-dashed border-primary"></div>
                                    <div class="mb-5 row">
                                        <div class="col-md-12">
                                            <label for="remarks" class="required form-label fw-bold">Remarks:</label>
                                            <textarea class="form-control @error('remarks') is-invalid @enderror" placeholder="enter your remarks" name="remarks"
                                                id="remarks" cols="30" rows="4">{{ old('remarks', $belowCostRemark->remarks) }}</textarea>
                                            @error('remarks')
                                                <span
                                                    class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        $(function() {
            const remarksDate = $('#date');
            const submitButton = $('#submit_btn');
            const belowCostForm = $('#below-cost-form');
            const idealQuotationAmountInput = $('#ideal_quotation_amount_inclusive_vat');
            const quotedQuotationAmountInput = $('#quoted_quotation_amount_inclusive_vat');
            const priceDifferenceInput = $('#price_difference');

            const quotation = @json($quotation);
            const vatPercentage = @json($vatPercentage);

            remarksDate.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            const data = quotation.quotation_products.map((quotationProduct, index) => {
                const idealVAT = quotationProduct.quoted_quantity * quotationProduct.system_selling_price *
                    (vatPercentage / 100);
                const quotedVAT = quotationProduct.quoted_quantity * quotationProduct.selling_price *
                    (vatPercentage / 100);
                const systemSellingPrice = (quotationProduct.quoted_quantity * quotationProduct
                    .system_selling_price) + idealVAT;
                const sellingPrice = (quotationProduct.quoted_quantity * quotationProduct.selling_price) +
                    quotedVAT;
                const deviation = (systemSellingPrice - sellingPrice) || 0;

                return {
                    index: index + 1,
                    quotation_id: quotationProduct.quotation_id,
                    brand_name: quotationProduct.product?.brand?.name || 'N/A',
                    product_name: quotationProduct.product.name,
                    part_number: quotationProduct.product.part_number,
                    system_selling_price: systemSellingPrice,
                    selling_price: sellingPrice,
                    quoted_quantity: quotationProduct.quoted_quantity,
                    ideal_vat: idealVAT,
                    quoted_vat: quotedVAT,
                    deviation: deviation,
                };
            });

            const quotationProductsTable = new Tabulator("#quoted_products", {
                data,
                renderHorizontal: "virtual",
                rowHeight: 50,
                columns: [{
                        title: "Brand",
                        field: "brand_name",
                        width: 120,
                        headerSort: false
                    },
                    {
                        title: "Product",
                        field: "product_name",
                        headerSort: false,
                        width: 250,
                        formatter: function(cell) {
                            const productName = cell.getValue();
                            const partNumber = cell.getRow().getData().part_number;
                            return `
                            <div style="font-size: 1em;">${productName}</div>
                            <div style="font-size: 0.8em; color: #777;">Part No: ${partNumber}</div>`;
                        }
                    },
                    {
                        title: "Quoted<br/>Qty",
                        field: "quoted_quantity",
                        headerSort: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                    },
                    {
                        title: "System<br/>Price",
                        field: "system_selling_price",
                        headerSort: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        bottomCalc: "sum",
                        bottomCalcFormatter: "money",
                        bottomCalcFormatterParams: {
                            precision: 2
                        },
                    },
                    {
                        title: "Ideal<br/>VAT",
                        field: "ideal_vat",
                        headerSort: false,
                        visible: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        bottomCalc: "sum",
                        bottomCalcFormatter: "money",
                        bottomCalcFormatterParams: {
                            precision: 2
                        },
                    },
                    {
                        title: "Selling<br/>Price",
                        field: "selling_price",
                        headerSort: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        bottomCalc: "sum",
                        bottomCalcFormatter: "money",
                        bottomCalcFormatterParams: {
                            precision: 2
                        },
                    },
                    {
                        title: "Quoted<br/>VAT",
                        field: "quoted_vat",
                        headerSort: false,
                        visible: false,
                        formatter: "money",
                        formatterParams: {
                            precision: 2
                        },
                        bottomCalc: "sum",
                        bottomCalcFormatter: "money",
                        bottomCalcFormatterParams: {
                            precision: 2
                        },
                    },
                    {
                        title: "Deviation",
                        field: "deviation",
                        formatter: "money",
                        headerSort: false,
                        formatterParams: {
                            precision: 2
                        },
                        bottomCalc: "sum",
                        bottomCalcFormatter: "money",
                        bottomCalcFormatterParams: {
                            precision: 2
                        },
                    },
                ],
                layout: "fitColumns",
            });

            quotationProductsTable.on("tableBuilt", function() {
                updateQuotationAmounts();
            });

            function updateQuotationAmounts() {
                let systemSellingPriceSum = 0;
                let sellingPriceSum = 0;

                quotationProductsTable.getData().forEach(row => {
                    systemSellingPriceSum += parseFloat(row.system_selling_price || 0);
                    sellingPriceSum += parseFloat(row.selling_price || 0);
                });

                const priceDifference = systemSellingPriceSum - sellingPriceSum;

                idealQuotationAmountInput.val(systemSellingPriceSum.toFixed(2));
                quotedQuotationAmountInput.val(sellingPriceSum.toFixed(2));
                priceDifferenceInput.val(priceDifference.toFixed(2));
            }

            function addError(field, message) {
                field.addClass('is-invalid');
                field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
            }

            belowCostForm.submit(function(e) {
                e.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                const requiredFields = [{
                        id: '#remarks',
                        name: 'Remarks'
                    },
                    {
                        id: '#ideal_quotation_amount_inclusive_vat',
                        name: 'Ideal Quotation Amount'
                    },
                    {
                        id: '#quoted_quotation_amount_inclusive_vat',
                        name: 'Quoted Amount'
                    },
                    {
                        id: '#price_difference',
                        name: 'Price Difference'
                    },
                    {
                        id: '#date',
                        name: 'Date'
                    },
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

                if (allFieldsValid) {
                    this.submit();
                } else {
                    submitButton.attr('disabled', false);
                }
            });
        });
    </script>
@endsection
