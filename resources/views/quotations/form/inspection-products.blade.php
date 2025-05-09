<input type="hidden" name="customer_id" id="customer_id">
<input type="hidden" name="job_card_id" id="job_card_id">
<div class="mb-5 row">
    <div class="col-md-6">
        <label for="quotation_type" class="required form-label fw-bold">
            Quotation Type:
        </label>
        <select class="form-select" name="quotation_type" id="quotation_type" data-control="select2"
            data-placeholder="select quotation type">
            <option value="" selected>Select Quotation Type</option>
            {{-- <option value="inspection" @selected(old('quotation_type', $quotation->quotation_type) == 'inspection')>
                Quotation from Job Card
            </option> --}}
            <option value="new-customer-quotation" @selected(old('quotation_type', $quotation->quotation_type) == 'new-customer-quotation')>
                First Time Walk-In Customer
            </option>
            <option value="sales" @selected(old('quotation_type', $quotation->quotation_type) == 'sales')>
                Customer with Account at BMJ
            </option>
        </select>
        @error('quotation_type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6" id="jobInspectionsContainer">
        <label for="job_inspection_id" class="required form-label fw-bold"> Job Inspections:</label>
        <select class="form-select" name="job_inspection_id" id="job_inspection_id" data-control="select2"
            data-placeholder="select job Inspection">
            <option value="" selected>Select Job Inspection</option>
            @foreach ($jobInspections as $jobInspection)
                <option value="{{ $jobInspection->id }}"
                    data-customer="{{ $jobInspection->customer->company_name ?? $jobInspection->customer->name }}"
                    data-inspection-number="{{ $jobInspection->inspection_number }}"
                    data-jobcard="{{ $jobInspection->jobCard->jobcard_number }}" @selected(old('job_inspection_id', $quotation->job_inspection_id) == $jobInspection->id)>
                    {{ $jobInspection->inspection_number }}
                </option>
            @endforeach
        </select>
        @error('job_inspection_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6 d-none" id="saleCustomersContainer">
        <label for="sale_customer_id" class="required form-label fw-bold"> Customers:</label>
        <select class="form-select" name="sale_customer_id" id="sale_customer_id" data-control="select2"
            data-placeholder="select customer">
            <option value="" selected>Select Customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" data-customer-phone="{{ $customer->phone ?? '-' }}"
                    data-customer-name="{{ $customer->name ?? ($customer->company_name ?? '-') }}"
                    @selected(old('sale_customer_id', $quotation->sale_customer_id) == $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('sale_customer_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6" id="isTestingContainer">
        <label for="is_testing" class="required form-label fw-bold">
            Is this a Testing Job:
        </label>
        <select class="form-select" name="is_testing" id="is_testing" data-control="select2"
            data-placeholder="select choice">
            <option value="" selected>Select Choice</option>
            <option value="1" @selected(old('is_testing', $quotation->is_testing) == '1')>Yes</option>
            <option value="0" @selected(old('is_testing', $quotation->is_testing) == '0')>No</option>
        </select>
        @error('is_miscellaneous_charged')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6" id="isMiscellaneousChargedContainer">
        <label for="is_miscellaneous_charged" class="required form-label fw-bold">
            Include Miscellaneous Charges:
        </label>
        <select class="form-select" name="is_miscellaneous_charged" id="is_miscellaneous_charged" data-control="select2"
            data-placeholder="select choice">
            <option value="" selected>Select Choice</option>
            <option value="1" @selected(old('is_miscellaneous_charged', $quotation->is_miscellaneous_charged) == '1')>Yes</option>
            <option value="0" @selected(old('is_miscellaneous_charged', $quotation->is_miscellaneous_charged) == '0')>No</option>
        </select>
        @error('is_miscellaneous_charged')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="mb-5 row d-none" id="newCustomerContainer">
    <div class="mb-5 row">
        <div class="col-md-4">
            <label for="name" class="form-label fw-bold"> Name:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="enter customer name" value="{{ old('name') }}">
            @error('name')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="phone" class="form-label fw-bold"> Phone:</label>
            <input type="text" name="phone" id="phone"
                class="form-control @error('phone') is-invalid @enderror" placeholder="enter customer phone"
                value="{{ old('phone') }}">
            @error('phone')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label fw-bold">Email:</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="enter customer email"
                value="{{ old('email') }}">
            @error('email')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="mb-5 row">
        <div class="col-md-4">
            <label for="company_name" class="form-label fw-bold"> Company Name:</label>
            <input type="text" step="any" name="company_name" id="company_name"
                class="form-control @error('company_name') is-invalid @enderror" placeholder="enter company name"
                value="{{ old('company_name') }}">
            @error('company_name')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="address" class="form-label fw-bold"> Address:</label>
            <input type="text" name="address" id="address"
                class="form-control @error('address') is-invalid @enderror" placeholder="enter company address"
                value="{{ old('address') }}">
            @error('address')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="kra_pin" class="form-label fw-bold">KRA Pin:</label>
            <input type="text" name="kra_pin" id="kra_pin"
                class="form-control @error('kra_pin') is-invalid @enderror" placeholder="enter customer kra pin"
                value="{{ old('kra_pin') }}">
            @error('kra_pin')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>
<div class="my-10 separator separator-dashed border-primary"></div>
<div class="mb-5 card d-none" id="jobInspectionAccordion">
    <div class="card-body my-n4">
        <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
            <div class="accordion-header d-flex collapsed" data-bs-toggle="collapse"
                data-bs-target="#job_inspection_products_accordion">
                <span class="accordion-icon">
                    <i class="my-2 fa-solid fa-arrow-right text-dark fs-4 fw-bolder"></i>
                </span>
                <h3 class="my-2 fs-4 fw-semibold ms-4">Job Inspection Products</h3>
            </div>

            <div id="job_inspection_products_accordion" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_2">
                <div id="inspection_products" class="border rounded gy-2 fs-6"></div>
            </div>
        </div>
    </div>
</div>

<div class="mb-5 row" id="openingChargesContainer">
    <div class="col-md-6">
        <label class="required form-label">Opening Charges</label>
        <div class="fw-bold fs-3">
            <input type="text" class="mb-2 border-gray-300 form-control form-control-solid"
                placeholder="opening charges applicable" name="opening_charges_applicable"
                id="opening_charges_applicable" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <label class="required form-label">Opening Charges</label>
        <div class="fw-bold fs-3">
            <input type="number" step="any" class="form-control" placeholder="enter opening charges"
                name="opening_charges" id="opening_charges" value="{{ old('opening_charges') }}">
        </div>
    </div>
</div>
<div class="my-10 separator separator-dashed border-primary"></div>

<div class="mb-5 row d-none" id="charges_container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label for="product_id" class="required form-label fw-bold">Product:</label>
                    <select class="form-control form-select @error('product_id') is-invalid @enderror"
                        data-control="select2" data-placeholder="select product" id="product_id">
                        <option></option>
                    </select>
                    @error('product_id')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="product_quantity" class="required form-label fw-bold">Qty:</label>
                    <input type="number" step="any" id="product_quantity" class="mb-2 form-control"
                        placeholder="enter quantity" value="{{ old('product_quantity') }}">
                    @error('product_quantity')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <label for="miscellaneous_charge_id" class="required form-label fw-bold">
                        Charges:
                    </label>
                    <select class="form-control form-select @error('miscellaneous_charge_id') is-invalid @enderror"
                        data-control="select2" data-placeholder="select charge" id="miscellaneous_charge_id">
                        <option></option>
                        @foreach ($miscellaneousCharges as $miscellaneousCharge)
                            <option value="{{ $miscellaneousCharge->id }}" @selected(old('miscellaneous_charge_id', $quotation->miscellaneous_charge_id) == $miscellaneousCharge->id)>
                                {{ $miscellaneousCharge->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('miscellaneous_charge_id')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-md-5">
                    <label for="price" class="required form-label fw-bold">Price:</label>
                    <input type="number" step="any" id="price" class="mb-2 form-control"
                        placeholder="enter price" value="{{ old('price') }}">
                    @error('price')
                        <span
                            class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mt-3 col-md-2">
                    <button type="button" class="mt-6 btn btn-sm btn-info" id="btn_add_charge">
                        <i class="mb-1 fa-solid fa-cash-register"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="my-10 separator separator-dashed border-primary"></div>
    <div id="miscellaneous_charges" class="border rounded gy-2 fs-6"></div>
</div>
