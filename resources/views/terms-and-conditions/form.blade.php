<div class="mb-5 row">
    <div class="col-md-6">
        <label class="required form-label fw-bold" for="date">Name:</label>
        <input type="text" name="name" class="mb-2 form-control" placeholder="enter terms & condition name"
            id="name" value="{{ old('name', $termsAndCondition->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-12">
        <label for="conditions" class="required form-label fw-bold">Conditions:</label>
        <textarea class="form-control @error('conditions') is-invalid @enderror" placeholder="enter terms and conditions"
            name="conditions" id="conditions" cols="30" rows="4">{{ old('conditions', $termsAndCondition->conditions) }}</textarea>
        @error('conditions')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
