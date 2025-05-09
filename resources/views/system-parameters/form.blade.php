<div class="mb-5 row">
    <div class="col-md-6">
        <label for="key" class="form-label required">Key:</label>
        <input type="text" id="key" name="key"
            class="form-control {{ Route::is('system-parameter.edit') ? 'form-control-solid border-gray-300' : '' }} @error('key') is-invalid @enderror"
            value="{{ old('key', $systemParameter->key) }}" placeholder="enter system setting key"
            {{ Route::is('system-parameter.edit') ? 'readonly' : '' }}>
        @error('key')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong> </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="value" class="form-label required">Value:</label>
        <input type="text" id="value" name="value" class="form-control @error('value') is-invalid @enderror"
            placeholder="Enter system setting value" value="{{ old('value', $systemParameter->value) }}">
        @error('value')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong> </span>
        @enderror
    </div>
</div>
