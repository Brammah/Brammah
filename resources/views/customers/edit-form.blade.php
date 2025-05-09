<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="customer_number" class="form-label required">Customer Number:</label>
            <input type="text" placeholder="customer code" id="customer_number" name="customer_number"
                class="border-gray-300 fmb-2 form-control form-control-solid"
                value="{{ old('customer_number', $customer->customer_number) }}" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="is_withholding_agent" class="required form-label">Is Withholding Agent:</label>
            <select class="form-select @error('is_withholding_agent') is-invalid @enderror" name="is_withholding_agent"
                id="is_withholding_agent" data-control="select2" data-placeholder="select option">
                <option value="" selected>select option</option>
                <option value="1" @selected(old('is_withholding_agent', $customer->is_withholding_agent) == '1')>Yes</option>
                <option value="0" @selected(old('is_withholding_agent', $customer->is_withholding_agent) == '0')>No</option>
            </select>
            @error('is_withholding_agent')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="parent_id" class="form-label">Parent Customer:</label>
            <select class="form-control form-select @error('parent_id') is-invalid @enderror" data-control="select2"
                data-placeholder="select parent customer" name="parent_id" id="parent_id">
                <option></option>
                @foreach ($parentCustomers as $parentCustomer)
                    <option value="{{ $parentCustomer->id }}"
                        data-customer-name="{{ $parentCustomer->company_name ?? $parentCustomer->name }}"
                        data-customer-phone="{{ $parentCustomer->phone }}" @selected(old('parent_id', $customer->parent_id) == $parentCustomer->id)>
                        {{ strtoupper($parentCustomer->company_name ?? $parentCustomer->name) }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="customer_type" class="required form-label">Customer Type:</label>
            <select class="form-control form-select  @error('customer_type') is-invalid @enderror"
                data-control="select2" data-placeholder="select customer type" name="customer_type" id="customer_type">
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
</div>

<div class="mb-5 row">
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
            <label for="company_name" class="form-label required">Company Name:</label>
            <input type="text" placeholder="enter customer's company name or use customer's name" name="company_name"
                class="form-control" value="{{ old('company_name', $customer->company_name) }}">
            @error('company_name')
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
        <label for="account_manager_id" class="required form-label fw-bold">Account Manager:</label>
        <select class="form-select" name="account_manager_id" id="account_manager_id" data-control="select2"
            data-placeholder="select account manager">
            <option value="" selected>Select Account Manager</option>
            @foreach ($accountManagers as $accountManager)
                <option value="{{ $accountManager->id }}" @selected(old('account_manager_id', $customer->account_manager_id) == $accountManager->id)>
                    {{ $accountManager->full_name }}
                </option>
            @endforeach
        </select>
        @error('account_manager_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="payment_term_id" class="required form-label fw-bold">Payment Term:</label>
        <select class="form-select" name="payment_term_id" id="payment_term_id" data-control="select2"
            data-placeholder="select payment term">
            <option value="" selected>Select Payment Term</option>
            @foreach ($paymentTerms as $paymentTerm)
                <option value="{{ $paymentTerm->id }}" @selected(old('payment_term_id', $customer->payment_term_id) == $paymentTerm->id)>
                    {{ $paymentTerm->name }}
                </option>
            @endforeach
        </select>
        @error('payment_term_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="billing_currency" class="required form-label fw-bold">Billing Currency:</label>
        <select class="form-select" name="billing_currency" id="billing_currency" data-control="select2"
            data-placeholder="select billing currency">
            <option value="" selected>Select Billing Currency</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->code }}" @selected(old('billing_currency', $customer->billing_currency) == $currency->id)>
                    {{ $currency->code }}
                </option>
            @endforeach
        </select>
        @error('billing_currency')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="maximum_invoices" class="required form-label fw-bold">Maximum Invoices:</label>
        <input type="number" name="maximum_invoices" id="maximum_invoices" class="form-control"
            placeholder="enter maximum number of outstanding invoices the customer is allowed"
            value="{{ old('maximum_invoices', $customer->maximum_invoices) }}">
        @error('maximum_invoices')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="credit_limit" class="required form-label fw-bold">Credit Limit:</label>
        <input type="number" step="any" name="credit_limit" id="credit_limit" class="form-control"
            placeholder="enter credit limit" value="{{ old('credit_limit', $customer->credit_limit) }}">
        @error('credit_limit')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="opening_balance" class="required form-label fw-bold">Opening Balance:</label>
        <input type="number" step="any" name="opening_balance" id="opening_balance" class="form-control"
            placeholder="enter opening balance" value="{{ old('opening_balance', $customer->opening_balance) }}">
        @error('opening_balance')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
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
            <label for="address" class="form-label">Customer Address:</label>
            <input type="text" placeholder="enter customer address, 1234 - 00123, Nairobi" name="address"
                class="form-control" value="{{ old('address', $customer->address) }}">
            @error('address')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>
