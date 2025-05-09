<div class="mb-5 flex-lg-row-auto w-lg-300px me-5 me-lg-5">
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Credit Note</h2>
            </div>
        </div>

        <div class="pt-0 card-body">
            <div class="gap-5 d-flex flex-column">
                <div class="fv-row fv-plugins-icon-container">
                    <label class="required form-label fw-bold" for="date">Date:</label>
                    <input type="date" name="date" class="mb-2 form-control" placeholder="select invoice date"
                        id="date" value="{{ old('date') }}">
                    @error('date')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="fv-row">
                    <label class="required form-label">Credit Note Number</label>
                    <div class="fw-bold fs-3">
                        <input type="text" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="credit note number" name="credit_note_number" id="credit_note_number"
                            value="{{ old('credit_note_number') }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label class="required form-label">Credit Note Amount (Exclsv VAT)</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="credit note amount" name="credit_note_amount" id="credit_note_amount"
                            value="{{ old('credit_note_amount') }}" readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="vat_amount" class="required form-label">VAT Amount</label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="total vat" name="vat_amount" id="vat_amount" value="{{ old('vat_amount') }}"
                            readonly>
                    </div>
                </div>
                <div class="fv-row fv-plugins-icon-container">
                    <label for="credit_note_amount_inclusive_vat" class="required form-label">
                        Credit Note Amount (Inclsv VAT)
                    </label>
                    <div class="fw-bold fs-3">
                        <input type="number" class="mb-2 border-gray-300 form-control form-control-solid"
                            placeholder="total credit note amount" name="credit_note_amount_inclusive_vat"
                            id="credit_note_amount_inclusive_vat" value="{{ old('credit_note_amount_inclusive_vat') }}"
                            readonly>
                    </div>
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
                            aria-selected="true" role="tab" href="#invoice-products">
                            Products & Charges
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
                <div class="tab-pane fade show active" id="invoice-products" role="tabpanel">
                    <div class="mt-5">
                        @include('credit-notes.form.invoice-products')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
