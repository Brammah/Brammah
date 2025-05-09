<div class="mb-5 row">
    <div class="col-md-6">
        <label for="expense_category_id" class="required form-label">Expense Category:</label>
        <select class="form-control form-select @error('expense_category_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select Expense Category" name="expense_category_id" id="expense_category_id">
            <option></option>
            @foreach ($expenseCategories as $expenseCategory)
                <option value="{{ $expenseCategory->id }}" @selected(old('expense_category_id', $expense->expense_category_id) == $expenseCategory->id)>
                    {{ $expenseCategory->name }}
                </option>
            @endforeach
        </select>
        @error('expense_category_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="source_account_id" class="form-label">Source Account:</label>
        <select class="form-control form-select @error('source_account_id') is-invalid @enderror" id="source_account_id"
            name="source_account_id" id="source_account_id" data-control="select2"
            data-placeholder="select source account">
            <option></option>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}" @selected(old('source_account_id', $expense->source_account_id) == $account->id)>
                    {{ $account->code }} - {{ $account->name }}
                </option>
            @endforeach
        </select>
        @error('source_account_id')
            <span class="fv-plugins-message-container invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="date" class="required form-label">Date</label>
        <input type="date" name="date" id="date" class="mb-2 form-control" placeholder="select date"
            value="{{ old('date', $expense->date) }}">
        @error('date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="transaction_method" class="required form-label">Transaction Method:</label>
        <select class="form-control form-select @error('transaction_method') is-invalid @enderror"
            data-control="select2" data-placeholder="Select Transaction Method" name="transaction_method"
            id="transaction_method">
            <option></option>
            @foreach ($transactionMethods as $transactionMethod)
                <option value="{{ $transactionMethod }}"
                    {{ (old('transaction_method') ?? $transactionMethod) === $expense->transaction_method ? 'selected' : '' }}>
                    {{ strtoupper($transactionMethod) }}
                </option>
            @endforeach
        </select>
        @error('client_type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="amount" class="required form-label">Amount</label>
        <input type="number" step="any" name="amount" id="amount" class="mb-2 form-control"
            placeholder="enter amount" value="{{ old('amount', $expense->amount) }}">
        @error('amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="transaction_reference" class="required form-label">Transaction Reference</label>
        <input type="text" name="transaction_reference" id="transaction_reference" class="mb-2 form-control"
            placeholder="enter transaction reference"
            value="{{ old('transaction_reference', $expense->transaction_reference) }}">
        @error('transaction_reference')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="required form-label">Description:</label>
        <textarea class="mb-2 form-control" placeholder="brief description" name="description">{{ old('description', $expense->description) }}</textarea>
        @error('description')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
