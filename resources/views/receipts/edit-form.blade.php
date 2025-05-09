<div class="mb-5 row">
    <div class="col-md-6">
        <label for="bank_account_id" class="required form-label fw-bold">Bank Account:</label>
        <select class="form-control form-select @error('bank_account_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select bank account" name="bank_account_id" id="bank_account_id">
            <option></option>
            @foreach ($bankAccounts as $bankAccount)
                <option value="{{ $bankAccount->id }}" data-account-name="{{ $bankAccount->account_name }}"
                    data-account-number="{{ $bankAccount->account_number }}" @selected(old('bank_account_id', $receipt->bank_account_id) == $bankAccount->id)>
                    {{ $bankAccount->account_name }}
                </option>
            @endforeach
        </select>
        @error('bank_account_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="payment_date">Date:</label>
        <input type="date" name="payment_date" class="mb-2 border-gray-300 form-control form-control-solid"
            placeholder="select date" id="payment_date" value="{{ old('payment_date', $receipt->payment_date) }}"
            readonly>
        @error('payment_date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="customer_name" class="required form-label fw-bold">Customer:</label>
        <input type="text" name="customer_name" id="customer_name"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="total paid amount"
            value="{{ old('customer_name', $receipt->customer->customer_name) }}" readonly>
        @error('customer_name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="total_paid_amount" class="required form-label fw-bold">Total Paid Amount:</label>
        <input type="number" step="any" name="total_paid_amount" id="total_paid_amount"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="total paid amount"
            value="{{ old('total_paid_amount', $receipt->total_paid_amount) }}" readonly>
        @error('total_paid_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="payment_method" class="required form-label fw-bold">Payment Method:</label>
        <input type="text" name="payment_method" id="payment_method"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="total paid amount"
            value="{{ old('payment_method', $receipt->paymentMethod->name) }}" readonly>
        @error('payment_method')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="change_amount" class="required form-label fw-bold">Change Amount:</label>
        <input type="number" step="any" name="change_amount" id="change_amount"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="change amount"
            value="{{ old('change_amount', $receipt->change_amount) }}" readonly>
        @error('change_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

@if (
    $receipt->payment_method_id === 1 ||
        $receipt->payment_method_id === 4 ||
        $receipt->payment_method_id === 6 ||
        $receipt->payment_method_id === 7)
    <div class="mb-5 row">
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="cash_payment_reference">Cash Payment Reference:</label>
            <input type="text" name="cash_payment_reference"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter cash payment reference" id="cash_payment_reference"
                value="{{ old('cash_payment_reference', $receipt->cash_payment_reference) }}">
            @error('cash_payment_reference')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="cash_amount">Cash Amount:</label>
            <input type="number" step="any" name="cash_amount"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly placeholder="enter cash amount"
                id="cash_amount" value="{{ old('cash_amount', $receipt->cash_amount) }}">
            @error('cash_amount')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endif

@if ($receipt->payment_method_id === 9)
    <div class="mb-5 row">
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="cash_deposit_payment_reference">Cash Deposit Payment
                Reference:</label>
            <input type="text" name="cash_deposit_payment_reference"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter cash payment reference" id="cash_deposit_payment_reference"
                value="{{ old('cash_deposit_payment_reference', $receipt->cash_deposit_payment_reference) }}">
            @error('cash_deposit_payment_reference')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="cash_deposit_amount">Cash Deposit Amount:</label>
            <input type="number" step="any" name="cash_deposit_amount"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter cash deposit amount" id="cash_deposit_amount"
                value="{{ old('cash_deposit_amount', $receipt->cash_deposit_amount) }}">
            @error('cash_deposit_amount')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endif

@if ($receipt->payment_method_id === 2 || $receipt->payment_method_id === 4 || $receipt->payment_method_id === 8)
    <div class="mb-5 row">
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="mpesa_payment_reference">MPESA Payment Reference:</label>
            <input type="text" name="mpesa_payment_reference"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter mpesa payment reference" id="mpesa_payment_reference"
                value="{{ old('mpesa_payment_reference', $receipt->mpesa_payment_reference) }}">
            @error('mpesa_payment_reference')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="mpesa_amount">MPESA Amount:</label>
            <input type="number" step="any" name="mpesa_amount"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly placeholder="enter mpesa amount"
                id="mpesa_amount" value="{{ old('mpesa_amount', $receipt->mpesa_amount) }}">
            @error('mpesa_amount')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endif

@if ($receipt->payment_method_id === 5 || $receipt->payment_method_id === 7 || $receipt->payment_method_id === 8)
    <div class="mb-5 row">
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="bank_transfer_reference">Bank Transfer Reference:</label>
            <input type="text" name="bank_transfer_reference"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter bank payment reference" id="bank_transfer_reference"
                value="{{ old('bank_transfer_reference', $receipt->bank_transfer_reference) }}">
            @error('bank_transfer_reference')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="required form-label fw-bold" for="bank_transfer_amount">Bank Transfer Amount:</label>
            <input type="number" step="any" name="bank_transfer_amount"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter bank transfer amount" id="bank_transfer_amount"
                value="{{ old('bank_transfer_amount', $receipt->bank_transfer_amount) }}">
            @error('bank_transfer_amount')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endif

@if ($receipt->payment_method_id === 3 || $receipt->payment_method_id === 6)
    <div class="mb-5 row">
        @if ($receipt->cheque_type === 'post-dated-cheque')
            <div class="col-md-3">
                <label class="required form-label fw-bold" for="cheque_type">Cheque Type:</label>
                <input type="text" step="any" name="cheque_type"
                    class="mb-2 border-gray-300 form-control form-control-solid" readonly
                    placeholder="enter cheque number" id="cheque_type"
                    value="{{ old('cheque_type', $receipt->cheque_type) }}">
                @error('cheque_type')
                    <span
                        class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        @elseif ($receipt->cheque_type === 'current')
            <div class="col-md-3">
                <label class="required form-label fw-bold" for="cheque_type">Cheque Type:</label>
                <input type="text" step="any" name="cheque_type"
                    class="mb-2 border-gray-300 form-control form-control-solid" readonly
                    placeholder="enter cheque number" id="cheque_type"
                    value="{{ old('cheque_type', $receipt->cheque_type) }}">
                @error('cheque_type')
                    <span
                        class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        @endif
        <div class="col-md-3">
            <label class="required form-label fw-bold" for="cheque_maturity_date">Maturity Date:</label>
            <input type="date" name="cheque_maturity_date"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly placeholder="select date"
                id="cheque_maturity_date" value="{{ old('cheque_maturity_date', $receipt->cheque_maturity_date) }}">
            @error('cheque_maturity_date')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="required form-label fw-bold" for="cheque_number">Cheque Number:</label>
            <input type="text" step="any" name="cheque_number"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter cheque number" id="cheque_number"
                value="{{ old('cheque_number', $receipt->cheque_number) }}">
            @error('cheque_number')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="required form-label fw-bold" for="cheque_amount">Cheque Amount:</label>
            <input type="number" step="any" name="cheque_amount"
                class="mb-2 border-gray-300 form-control form-control-solid" readonly
                placeholder="enter cheque amount" id="cheque_amount"
                value="{{ old('cheque_amount', $receipt->cheque_amount) }}">
            @error('cheque_amount')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endif

<div class="my-10 separator separator-dashed border-primary"></div>

<div id="receipt_invoices" class="border rounded gy-2 fs-6"></div>
