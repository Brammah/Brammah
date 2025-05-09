<div class="mb-5 flex-lg-row-auto w-lg-300px me-5 me-lg-5">
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Quotation</h2>
            </div>
        </div>

        <div class="pt-0 card-body">
            <div class="gap-5 d-flex flex-column">
                <div class="fv-row fv-plugins-icon-container">
                    <label class="required form-label fw-bold" for="date">Date:</label>
                    <input type="date" name="date" class="mb-2 form-control" placeholder="select quotation date"
                        id="date" value="{{ old('date', $quotation->date) }}">
                    @error('date')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="currency_id" class="required form-label fw-bold"> Currency:</label>
                    <select class="form-select" name="currency_id" id="currency_id" data-control="select2"
                        data-placeholder="select currency">
                        <option value="" selected>Select Currency</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" @selected(old('currency_id', $quotation->currency_id) == $currency->id)>
                                {{ $currency->name }} - {{ $currency->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('currency_id')
                        <span class="fv-plugins-message-container invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="fv-row">
                    <label class="required form-label">Quotation Number</label>
                    <div class="fw-bold fs-3">
                        <input type="text" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="quotation number" name="quotation_number" id="quotation_number"
                            value="{{ old('quotation_number', $quotation->quotation_number) }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label class="required form-label">Quote Amount (Exclsv VAT)</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="quotation amount" name="quotation_amount" id="quotation_amount"
                            value="{{ old('quotation_amount', $quotation->quotation_amount) }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="vat_amount" class="required form-label">VAT Amount</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="total vat" name="vat_amount" id="vat_amount"
                            value="{{ old('vat_amount', $quotation->vat_amount) }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="discount_amount" class="required form-label">Total Discount</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="total discount" name="discount_amount" id="discount_amount" value="0.00"
                            value="{{ old('discount_amount', $quotation->discount_amount) }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="quotation_amount_inclusive_vat" class="required form-label">Quote Amount (Inclsv
                        VAT)</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="quotation amount inclsv vat" name="quotation_amount_inclusive_vat"
                            id="quotation_amount_inclusive_vat"
                            value="{{ old('quotation_amount_inclusive_vat', $quotation->quotation_amount_inclusive_vat) }}"
                            readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
    <div class="py-4 shadow-sm card">
        <div class="my-2 ms-10"> <span class="text-dark fw-bold" id="customer_name"></span></div>
        <div class="card-header border-bottom">
            <div class="card-title">
                <ul class="border-transparent nav nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                    <li class="m-2 nav-item">
                        <a class="py-2 nav-link text-active-primary ms-0 me-5 active" data-bs-toggle="tab"
                            aria-selected="true" role="tab" href="#inspection-products">
                            Inspections & Charges
                        </a>
                    </li>
                    <li class="m-2 nav-item">
                        <a class="py-2 nav-link text-active-primary ms-0 me-5" data-bs-toggle="tab" aria-selected="true"
                            role="tab" href="#quotation-sales">
                            Quotation Sale Items
                        </a>
                    </li>
                    <li class="m-2 nav-item">
                        <a class="py-2 nav-link text-active-primary ms-0 me-5" data-bs-toggle="tab" aria-selected="true"
                            role="tab" href="#warranty-and-discounts">
                            Warranty & Discounts
                        </a>
                    </li>
                    <li class="m-2 nav-item">
                        <a class="py-2 nav-link text-dark ms-0 me-5">
                            <span class="text-dark" id="customer_name"></span>
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
                <div class="tab-pane fade show active" id="inspection-products" role="tabpanel">
                    <div class="mt-5">
                        @include('quotations.form.inspection-products')
                    </div>
                </div>

                <div class="tab-pane fade" id="quotation-sales" role="tabpanel">
                    <div class="mt-5">
                        @include('quotations.form.quotation-products')
                    </div>
                </div>

                <div class="tab-pane fade" id="warranty-and-discounts" role="tabpanel">
                    <div class="mt-5">
                        @include('quotations.form.warranty-and-discounts')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
