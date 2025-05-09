<div class="mb-5 row">
    <div class="col-md-6">
        <label for="account_id" class="required form-label">Account:</label>
        <select class="form-control form-select @error('account_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select expense account" name="account_id" id="account_id">
            <option></option>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}"
                    {{ old('account_id', $expenseCategory->account_id) === $account->id ? 'selected' : '' }}>
                    {{ $account->name }}
                </option>
            @endforeach
        </select>
        @error('account_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="required form-label">Expense Category</label>
        <input type="text" name="name" id="name" class="mb-2 form-control"
            placeholder="enter expense category" value="{{ old('name', $expenseCategory->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
