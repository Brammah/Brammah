<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name:</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter payment term"
            value="{{ old('name', $paymentTerm->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="days" class="required form-label fw-bold">Days:</label>
        <input type="number" name="days" id="days" class="form-control" placeholder="enter number of days"
            value="{{ old('days', $paymentTerm->days) }}">
        @error('days')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
