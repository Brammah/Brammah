<div class="mb-5 row">
    <div class="col-md-12">
        <label for="name" class="required form-label fw-bold">Name:</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter payment method"
            value="{{ old('name', $paymentMethod->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
