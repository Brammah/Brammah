<div class="mb-5 row">
    <div class="col-md-6">
        <label for="symbol" class="required form-label fw-bold">Symbol:</label>
        <input type="text" name="symbol" id="symbol" class="form-control" placeholder="enter currency symbol"
            value="{{ old('symbol', $currency->symbol) }}">
        @error('symbol')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="enter currency name"
            value="{{ old('name', $currency->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="code" class="required form-label fw-bold">Code:</label>
        <input type="text" name="code" id="code" class="form-control" placeholder="enter currency code"
            value="{{ old('code', $currency->code) }}">
        @error('code')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
