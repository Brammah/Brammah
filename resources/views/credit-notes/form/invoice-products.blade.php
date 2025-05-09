<div class="mb-5 row">
    <div class="col-md-6">
        <label for="customer_id" class="required form-label fw-bold"> Customers:</label>
        <select class="form-select" name="customer_id" id="customer_id" data-control="select2"
            data-placeholder="select customer">
            <option value="" selected>Select Customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" data-customer-phone="{{ $customer->phone ?? '-' }}"
                    data-customer-name="{{ $customer->name ?? ($customer->company_name ?? '-') }}"
                    @selected(old('customer_id', $creditNote->customer_id) == $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="invoice_id" class="required form-label fw-bold">Invoices:</label>
        <select class="form-select" name="invoice_id" id="invoice_id" data-control="select2"
            data-placeholder="select invoice">
            <option></option>
        </select>
        @error('invoice_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="my-10 separator separator-dashed border-primary"></div>
<div id="invoice_products" class="border rounded gy-2 fs-6"></div>
<div class="my-10 separator separator-dashed border-primary"></div>

<input type="hidden" name="bill_to_customer_id" id="bill_to_customer_id">
<input type="hidden" name="currency_id" id="currency_id">
<input type="hidden" name="terms_and_condition_id" id="terms_and_condition_id">
