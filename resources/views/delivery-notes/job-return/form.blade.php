<input type="hidden" name="customer_id" id="customer_id">
<input type="hidden" name="job_card_id" id="job_card_id">
<div class="mb-5 row">
    <div class="col-md-6">
        <label for="type" class="required form-label fw-bold">Delivery Note Type:</label>
        <select class="form-control form-select @error('type') is-invalid @enderror" data-control="select2"
            data-placeholder="select delivery note type" name="type" id="type">
            <option></option>
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(old('type', $deliveryNote->type) == $type)>
                    {{ strtoupper($type) }}
                </option>
            @endforeach
        </select>
        @error('types')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label">Delivery Note Number</label>
        <div class="fw-bold fs-3">
            <input type="text" class="mb-2 border-gray-300 form-control form-control-solid"
                placeholder="delivery note number" name="delivery_note_number" id="delivery_note_number"
                value="{{ old('delivery_note_number', $deliveryNote->delivery_note_number) }}" readonly>
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="job_return_id" class="required form-label fw-bold"> Job Return:</label>
        <select class="form-select" name="job_return_id" id="job_return_id" data-control="select2"
            data-placeholder="select job return">
            <option value="" selected>Select Job Return</option>
            @foreach ($jobReturns as $jobReturn)
                <option value="{{ $jobReturn->id }}" data-customer="{{ $jobReturn->customer->customer_name }}"
                    data-jobcard-number="{{ $jobReturn->jobCard->jobcard_number }}"
                    data-job-return-number=" {{ $jobReturn->job_return_number }}" @selected(old('job_return_id', $deliveryNote->job_return_id) == $jobReturn->id)>
                    {{ $jobReturn->job_return_number }}
                </option>
            @endforeach
        </select>
        @error('job_return_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="date">Date:</label>
        <input type="date" name="date" class="mb-2 form-control" placeholder="select date" id="date"
            value="{{ old('date', $deliveryNote->date) }}">
        @error('date')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="customer_lpo_number">Customer LPO Number:</label>
        <input type="text" name="customer_lpo_number" class="mb-2 form-control"
            placeholder="enter customer lpo number" id="customer_lpo_number"
            value="{{ old('customer_lpo_number', $deliveryNote->customer_lpo_number) }}">
        @error('customer_lpo_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="collector_information">Collector Information:</label>
        <input type="text" name="collector_information" class="mb-2 form-control"
            placeholder="enter collector information: John Doe, KAA 111A" id="collector_information"
            value="{{ old('collector_information', $deliveryNote->collector_information) }}">
        @error('collector_information')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="my-10 separator separator-dashed border-primary"></div>
<div class="mb-5 row">
    <div id="delivery_note_products" class="border rounded gy-2 fs-6"></div>
</div>
