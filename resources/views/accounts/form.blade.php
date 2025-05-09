<div class="mb-5 row">
    <div class="col-md-6">
        <label for="account_category_id" class="required form-label">Account Category:</label>
        <select class="form-control form-select @error('account_category_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select account category" name="account_category_id" id="account_category_id">
            <option></option>
            @foreach ($accountCategories as $accountCategory)
                <option value="{{ $accountCategory->id }}"
                    {{ old('account_category_id', $account->account_category_id) === $accountCategory->id ? 'selected' : '' }}>
                    {{ $accountCategory->name }}
                </option>
            @endforeach
        </select>
        @error('account_category_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="parent_id" class="form-label">Parent Account:</label>
        <select class="form-control form-select @error('parent_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select parent account" name="parent_id" id="parent_id">
            <option></option>
            @foreach ($parentAccounts as $parentAccount)
                <option value="{{ $parentAccount->id }}"
                    {{ old('parent_id', $account->parent_id) === $parentAccount->id ? 'selected' : '' }}>
                    {{ $parentAccount->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label">Account Name</label>
        <input type="text" name="name" id="name" class="mb-2 form-control" placeholder="enter account name"
            value="{{ old('name', $account->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="code" class="required form-label">Account Code</label>
        <input type="text" name="code" id="code" class="mb-2 form-control" placeholder="enter account code"
            value="{{ old('code', $account->code) }}">
        @error('code')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="transacting_status" class="required form-label">Transacting Status</label>
        <div>
            <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="1" id="transacting_status"
                    name="transacting_status" @checked(old('transacting_status', $account->transacting_status) == '1') />
                <label class="form-check-label" for="transacting_status">
                    Yes
                </label>
            </div>

            <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="0" id="transacting_status"
                    name="transacting_status" @checked(old('transacting_status', $account->transacting_status) == '0') />
                <label class="form-check-label" for="transacting_status">
                    No
                </label>
            </div>
        </div>
        @error('transacting_status')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="status" class="required form-label">Status</label>
        <div>
            <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="1" id="status" name="status"
                    @checked(old('status', $account->status) == '1') />
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>

            <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="0" id="status" name="status"
                    @checked(old('status', $account->status) == '0') />
                <label class="form-check-label" for="status">
                    Inactive
                </label>
            </div>
        </div>
        @error('status')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong> </span>
        @enderror
    </div>
</div>
