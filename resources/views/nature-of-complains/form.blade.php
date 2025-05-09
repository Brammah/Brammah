<div class="mb-5 row">
    <div class="col-md-12">
        <label for="name" class="required form-label fw-bold">Nature Of Complain:</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter nature of complain"
            value="{{ old('name', $natureOfComplain->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
