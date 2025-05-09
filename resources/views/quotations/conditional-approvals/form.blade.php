<div class="mb-5 row">
    <div class="col-md-6">
        <label for="quotation_number" class="required form-label fw-bold">Quotation Number</label>
        <input type="text" id="quotation_number" class="mb-2 border-gray-300 form-control form-control-solid"
            placeholder="quotation number" value="{{ old('quotation_number', $quotation->quotation_number) }}">
        <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
        @error('quotation_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="customer_name" class="required form-label fw-bold">Customer Name</label>
        <input type="text" id="customer_name" class="mb-2 border-gray-300 form-control form-control-solid"
            placeholder="enter customer name" value="{{ old('customer_name', $quotation->customer->customer_name) }}">
        <input type="hidden" name="customer_id" value="{{ $quotation->customer_id }}">
        @error('customer_name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="proposed_payment_date">Date:</label>
        <input type="date" name="proposed_payment_date" class="mb-2 form-control"
            placeholder="select proposed payment date" id="proposed_payment_date"
            value="{{ old('proposed_payment_date', $conditionalApproval->proposed_payment_date) }}">
        @error('proposed_payment_date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="contact_person" class="required form-label fw-bold">Contact Person</label>
        <input type="text" name="contact_person" id="contact_person" class="form-control"
            placeholder="enter contact person name"
            value="{{ old('contact_person', $conditionalApproval->contact_person) }}">
        @error('contact_person')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label for="remarks" class="required form-label fw-bold">Remarks:</label>
        <textarea id="remarks" name="remarks" class="form-control" rows="2" placeholder="enter the remarks"></textarea>
        @error('remarks')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
