<div class="mb-5 row">
    <div class="col-md-6">
        <label for="account_manager_id" class="required form-label fw-bold">Account Manager:</label>
        <select class="form-select" name="account_manager_id" id="account_manager_id" data-control="select2"
            data-placeholder="select account manager">
            <option value="" selected>Select Account Manager</option>
            @foreach ($accountManagers as $accountManager)
                <option value="{{ $accountManager->id }}" @selected(old('account_manager_id', $customerAccount->account_manager_id) == $accountManager->id)>
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
                <option value="{{ $paymentTerm->id }}" @selected(old('payment_term_id', $customerAccount->payment_term_id) == $paymentTerm->id)>
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
        <label for="currency_id" class="required form-label fw-bold">Billing Currency:</label>
        <select class="form-select" name="currency_id" id="currency_id" data-control="select2"
            data-placeholder="select billing currency">
            <option value="" selected>Select Billing Currency</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $customerAccount->currency_id) == $currency->id)>
                    {{ $currency->name }}
                </option>
            @endforeach
        </select>
        @error('currency_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="maximum_invoices" class="required form-label fw-bold">Maximum Invoices:</label>
        <input type="number" name="maximum_invoices" id="maximum_invoices" class="form-control"
            placeholder="enter maximum number of outstanding invoices the customer is allowed"
            value="{{ old('maximum_invoices', $customerAccount->maximum_invoices) }}">
        @error('maximum_invoices')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="credit_limit" class="required form-label fw-bold">Credit Limit:</label>
        <input type="number" step="any" name="credit_limit" id="credit_limit" class="form-control"
            placeholder="enter credit limit" value="{{ old('credit_limit', $customerAccount->credit_limit) }}">
        @error('credit_limit')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="opening_balance" class="required form-label fw-bold">Opening Balance:</label>
        <input type="number" step="any" name="opening_balance" id="opening_balance" class="form-control"
            placeholder="enter opening balance"
            value="{{ old('opening_balance', $customerAccount->opening_balance) }}">
        @error('opening_balance')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
