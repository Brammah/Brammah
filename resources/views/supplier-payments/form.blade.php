<input type="hidden" name="payment_type" value="purchase-order">
<div class="mb-5 row">
    <div class="col-md-6">
        <label for="total_paid_amount" class="required form-label fw-bold">Total Paid Amount:</label>
        <input type="number" step="any" name="total_paid_amount" id="total_paid_amount"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="total paid amount"
            value="{{ old('total_paid_amount', $supplierPayment->total_paid_amount) }}" readonly>
        @error('total_paid_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="change_amount" class="required form-label fw-bold">Change Amount:</label>
        <input type="number" step="any" name="change_amount" id="change_amount"
            class="mb-2 border-gray-300 form-control form-control-solid" placeholder="change amount"
            value="{{ old('change_amount', $supplierPayment->change_amount) }}" readonly>
        @error('change_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    {{-- <div class="col-md-6">
        <label for="payment_type" class="required form-label fw-bold">Payment Type:</label>
        <select class="form-control form-select @error('payment_type') is-invalid @enderror" data-control="select2"
            data-placeholder="select payment type" name="payment_type" id="payment_type">
            <option></option>
            @foreach ($paymentTypes as $paymentType)
                <option value="{{ $paymentType }}" @selected(old('payment_type', $supplierPayment->payment_type) == $paymentType)>
                    {{ strtoupper($paymentType) }}
                </option>
            @endforeach
        </select>
        @error('payment_type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div> --}}
    <div class="col-md-6">
        <label for="bank_account_id" class="required form-label fw-bold">Bank Account:</label>
        <select class="form-control form-select @error('bank_account_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select bank account" name="bank_account_id" id="bank_account_id">
            <option></option>
            @foreach ($bankAccounts as $bankAccount)
                <option value="{{ $bankAccount->id }}" data-account-name="{{ $bankAccount->account_name }}"
                    data-account-number="{{ $bankAccount->account_number }}" @selected(old('bank_account_id', $supplierPayment->bank_account_id) == $bankAccount->id)>
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
        <input type="date" name="payment_date" class="mb-2 form-control" placeholder="select date" id="payment_date"
            value="{{ old('payment_date', $supplierPayment->payment_date) }}">
        @error('payment_date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="supplier_id" class="required form-label fw-bold">Supplier:</label>
        <select class="form-control form-select @error('supplier_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select supplier" name="supplier_id" id="supplier_id">
            <option></option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}"
                    data-phone="{{ $supplier->phone }}" @selected(old('supplier_id', $supplierPayment->supplier_id) == $supplier->id)>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="payment_method" class="required form-label fw-bold">Payment Method:</label>
        <select class="form-control form-select @error('payment_method_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select payment method" name="payment_method_id" id="payment_method_id">
            <option></option>
            @foreach ($paymentMethods as $paymentMethod)
                <option value="{{ $paymentMethod->id }}" @selected(old('payment_method_id', $supplierPayment->payment_method_id) === $paymentMethod->id)>
                    {{ strtoupper($paymentMethod->name) }}
                </option>
            @endforeach
        </select>

        @error('payment_method_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row d-none" id="cashPaymentContainer">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="cash_payment_reference">Cash Payment Reference:</label>
        <input type="text" name="cash_payment_reference" class="mb-2 form-control"
            placeholder="enter cash payment reference" id="cash_payment_reference"
            value="{{ old('cash_payment_reference', $supplierPayment->cash_payment_reference) }}">
        @error('cash_payment_reference')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="cash_amount">Cash Amount:</label>
        <input type="number" step="any" name="cash_amount" class="mb-2 form-control"
            placeholder="enter cash amount" id="cash_amount"
            value="{{ old('cash_amount', $supplierPayment->cash_amount) }}">
        @error('cash_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row d-none" id="cashDepositPaymentContainer">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="cash_deposit_payment_reference">Cash Deposit Payment
            Reference:</label>
        <input type="text" name="cash_deposit_payment_reference" class="mb-2 form-control"
            placeholder="enter cash payment reference" id="cash_deposit_payment_reference"
            value="{{ old('cash_deposit_payment_reference', $supplierPayment->cash_deposit_payment_reference) }}">
        @error('cash_deposit_payment_reference')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="cash_deposit_amount">Cash Deposit Amount:</label>
        <input type="number" step="any" name="cash_deposit_amount" class="mb-2 form-control"
            placeholder="enter cash deposit amount" id="cash_deposit_amount"
            value="{{ old('cash_deposit_amount', $supplierPayment->cash_deposit_amount) }}">
        @error('cash_deposit_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row d-none" id="mpesaPaymentContainer">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="mpesa_payment_reference">MPESA Payment Reference:</label>
        <input type="text" name="mpesa_payment_reference" class="mb-2 form-control"
            placeholder="enter mpesa payment reference" id="mpesa_payment_reference"
            value="{{ old('mpesa_payment_reference', $supplierPayment->mpesa_payment_reference) }}">
        @error('mpesa_payment_reference')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="mpesa_amount">MPESA Amount:</label>
        <input type="number" step="any" name="mpesa_amount" class="mb-2 form-control"
            placeholder="enter mpesa amount" id="mpesa_amount"
            value="{{ old('mpesa_amount', $supplierPayment->mpesa_amount) }}">
        @error('mpesa_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row d-none" id="bankTransferPaymentContainer">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="bank_transfer_reference">Bank Transfer Reference:</label>
        <input type="text" name="bank_transfer_reference" class="mb-2 form-control"
            placeholder="enter bank payment reference" id="bank_transfer_reference"
            value="{{ old('bank_transfer_reference', $supplierPayment->bank_transfer_reference) }}">
        @error('bank_transfer_reference')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="bank_transfer_amount">Bank Transfer Amount:</label>
        <input type="number" step="any" name="bank_transfer_amount" class="mb-2 form-control"
            placeholder="enter bank transfer amount" id="bank_transfer_amount"
            value="{{ old('bank_transfer_amount', $supplierPayment->bank_transfer_amount) }}">
        @error('bank_transfer_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row d-none" id="chequePaymentContainer">
    <div class="col-md-3">
        <label for="cheque_type" class="required form-label fw-bold">Cheque Type:</label>
        <select class="form-control form-select @error('cheque_type') is-invalid @enderror" data-control="select2"
            data-placeholder="select cheque type" name="cheque_type" id="cheque_type">
            <option></option>
            <option value="post-dated-cheque" @selected(old('cheque_type', $supplierPayment->cheque_type) == 'post-dated-cheque')>
                Post Dated Cheque
            </option>
            <option value="current" @selected(old('cheque_type', $supplierPayment->cheque_type) == 'current')>
                Current Cheque
            </option>
        </select>
        @error('cheque_type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="required form-label fw-bold" for="cheque_maturity_date">Maturity Date:</label>
        <input type="date" name="cheque_maturity_date" class="mb-2 form-control" placeholder="select date"
            id="cheque_maturity_date"
            value="{{ old('cheque_maturity_date', $supplierPayment->cheque_maturity_date) }}">
        @error('cheque_maturity_date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="required form-label fw-bold" for="cheque_number">Cheque Number:</label>
        <input type="text" step="any" name="cheque_number" class="mb-2 form-control"
            placeholder="enter cheque number" id="cheque_number"
            value="{{ old('cheque_number', $supplierPayment->cheque_number) }}">
        @error('cheque_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="required form-label fw-bold" for="cheque_amount">Cheque Amount:</label>
        <input type="number" step="any" name="cheque_amount" class="mb-2 form-control"
            placeholder="enter cheque amount" id="cheque_amount"
            value="{{ old('cheque_amount', $supplierPayment->cheque_amount) }}">
        @error('cheque_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="my-10 separator separator-dashed border-primary"></div>

<div id="purchase_orders" class="border rounded gy-2 fs-6"></div>
{{-- <div id="proforma_invoices" class="border rounded gy-2 fs-6"></div> --}}
