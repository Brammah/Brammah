{{-- <div class="mb-5 row">
    <div class="col-md-6">
        <label for="parent_id" class="form-label fw-bold">Parent Bank Account:</label>
        <select class="form-select" name="parent_id" id="parent_id" data-control="select2"
            data-placeholder="select parent bank account">
            <option value="" selected>Select Parent Bank Account</option>
            @foreach ($parentBankAccounts as $parentBankAccount)
                <option value="{{ $parentBankAccount->id }}" @selected(old('parent_id', $bankAccount->parent_id) == $parentBankAccount->id)>
                    {{ $parentBankAccount->account_name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div> --}}
<div class="mb-5 row">
    <div class="col-md-6">
        <label for="bank_id" class="form-label fw-bold">Bank:</label>
        <select class="form-select" name="bank_id" id="bank_id" data-control="select2" data-placeholder="select bank">
            <option value="" selected>Select Bank</option>
            @foreach ($banks as $bank)
                <option value="{{ $bank->id }}" @selected(old('bank_id', $bankAccount->bank_id) == $bank->id)>
                    {{ $bank->name }}
                </option>
            @endforeach
        </select>
        @error('bank_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="account_id" class="form-label fw-bold">Account:</label>
        <select class="form-select" name="account_id" id="account_id" data-control="select2"
            data-placeholder="select account">
            <option value="" selected>Select Account</option>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}" data-name="{{ $account->name }}" data-code="{{ $account->code }}"
                    @selected(old('account_id', $bankAccount->account_id) == $account->id)>
                    {{ $account->name }}
                </option>
            @endforeach
        </select>
        @error('account_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="account_name" class="required form-label fw-bold">Account Name</label>
        <input type="text" name="account_name" id="account_name" class="form-control"
            placeholder="enter bank account name" value="{{ old('account_name', $bankAccount->account_name) }}">
        @error('account_name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="account_number" class="required form-label fw-bold">Account Number</label>
        <input type="text" name="account_number" id="account_number" class="form-control"
            placeholder="enter bank account number" value="{{ old('account_number', $bankAccount->account_number) }}">
        @error('account_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
