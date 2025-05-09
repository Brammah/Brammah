<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="customer_type" class="required form-label">Customer Type:</label>
            <select class="form-control form-select  @error('customer_type') is-invalid @enderror" data-control="select2"
                data-placeholder="select customer type" name="customer_type" id="customer_type">
                <option></option>
                @foreach ($customerTypes as $customerType)
                    <option value="{{ $customerType }}" @selected(old('customer_type', $customer->customer_type))>
                        {{ strtoupper($customerType) }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="customer_number" class="form-label required">Customer Number:</label>
            <input type="text" placeholder="customer code" id="customer_number" name="customer_number"
                class="form-control form-control-solid" value="{{ old('customer_number', $customer->customer_number) }}"
                readonly>
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="account_type" class="required form-label">Account Type:</label>
            <select class="form-control form-select  @error('account_type') is-invalid @enderror" data-control="select2"
                data-placeholder="select account type" name="account_type" id="account_type">
                <option></option>
                @foreach ($accountTypes as $accountType)
                    <option value="{{ $accountType }}" @selected(old('account_type', $customer->account_type))>
                        {{ strtoupper($accountType) }}
                    </option>
                @endforeach
            </select>
            @error('account_type')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="name" class="form-label required">Customer Name:</label>
            <input type="text" placeholder="enter customer name" name="name" class="form-control"
                value="{{ old('name', $customer->name) }}">
            @error('name')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="phone" class="form-label required">Customer Phone:</label>
            <input type="text" placeholder="enter customer phone, 254712345678" name="phone" class="form-control"
                value="{{ old('phone', $customer->phone) }}">
            @error('phone')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="address" class="form-label">Customer Address:</label>
            <input type="text" placeholder="enter customer address, 1234 - 00123, Nairobi" name="address"
                class="form-control" value="{{ old('address', $customer->address) }}">
            @error('address')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="credit_limit" class="form-label">Credit Limit:</label>
            <input type="number" step="any" placeholder="enter credit limit" name="credit_limit" id="credit_limit"
                class="form-control" value="{{ old('credit_limit', $customer->credit_limit) }}">
            @error('credit_limit')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="payment_term_id" class="form-label">Payment Term:</label>
            <select class="form-control form-select  @error('payment_term_id') is-invalid @enderror"
                data-control="select2" data-placeholder="select payment terms" name="payment_term_id"
                id="payment_term_id">
                <option></option>
                @foreach ($paymentTerms as $paymentTerm)
                    <option value="{{ $paymentTerm->id }}" @selected(old('payment_term_id', $customer->payment_term_id) == $paymentTerm->id)>
                        {{ strtoupper($paymentTerm->name) }}
                    </option>
                @endforeach
            </select>
            @error('payment_term_id')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="kra_pin" class="form-label">KRA Pin:</label>
            <input type="text" placeholder="enter kra pin" name="kra_pin" class="form-control"
                value="{{ old('kra_pin', $customer->kra_pin) }}">
            @error('kra_pin')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="email" class="form-label">Email:</label>
            <input type="email" placeholder="enter email" name="email" class="form-control"
                value="{{ old('email', $customer->email) }}">
            @error('email')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="status" class="required form-label fw-bold">Status:</label>
            <select class="form-select" name="status" id="status" data-control="select2"
                data-placeholder="select status">
                <option value="" selected>Select Status</option>
                <option value="1" @selected(old('status', $customer->status) == '1')>Active</option>
                <option value="0" @selected(old('status', $customer->status) == '0')>Inactive</option>
            </select>
            @error('status')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="create_contact" class="required form-label">Create Other Contact:</label>
            <select class="form-select" name="create_contact" id="create_contact" data-control="select2"
                data-placeholder="create another contact">
                <option value="" selected>create contact</option>
                <option value="1" @selected(old('create_contact', $customer->create_contact) == '1')>Yes</option>
                <option value="0" @selected(old('create_contact', $customer->create_contact) == '0')>No</option>
            </select>
            @error('create_contact')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="my-10 separator separator-dashed border-primary d-none"></div>
<div class="mb-4 row d-none" id="contactInformation">
    <div class="col-md-3">
        <label for="contact_name" class="required form-label fw-bold">Contact Person Name:</label>
        <input type="text" id="contact_name" class="mb-2 form-control" placeholder="enter name"
            value="{{ old('contact_name') }}">
        @error('contact_name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="contact_phone" class="required form-label fw-bold">Contact Person Phone:</label>
        <input type="text" id="contact_phone" class="mb-2 form-control" placeholder="enter phone"
            value="{{ old('contact_phone') }}">
        @error('contact_phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="contact_email" class="required form-label fw-bold">Contact Person Email:</label>
        <input type="text" id="contact_email" class="mb-2 form-control" placeholder="enter email"
            value="{{ old('contact_email') }}">
        @error('contact_email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3 align-self-center">
        <button type="button" class="mt-6 btn btn-sm btn-info" id="btn_add_contact">
            Add Contact
        </button>
    </div>
</div>

@if (Route::is('customer.create'))
    <div class="my-10 separator separator-dashed border-primary d-none"></div>
    <div id="customer_contacts"
        class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-5"></div>
@endif
