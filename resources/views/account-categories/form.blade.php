<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label">Account Category:</label>
        <input type="text" name="name" id="name" class="mb-2 form-control" placeholder="enter account category"
            value="{{ old('name', $accountCategory->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="status" class="required form-label">Status</label>
        <div>
            <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="1" id="status" name="status"
                    @checked(old('status', $accountCategory->status) == '1') />
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>

            <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="0" id="status" name="status"
                    @checked(old('status', $accountCategory->status) == '0') />
                <label class="form-check-label" for="status">
                    Inactive
                </label>
            </div>
        </div>
        @error('status')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong> </span>
        @enderror
    </div>
</div>
