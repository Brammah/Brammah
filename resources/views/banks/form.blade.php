<div class="mb-5 row">
    <div class="col-md-6">
        <label for="parent_id" class="form-label fw-bold">Parent Bank:</label>
        <select class="form-select" name="parent_id" id="parent_id" data-control="select2"
            data-placeholder="select parent bank">
            <option value="" selected>Select Parent Bank</option>
            @foreach ($parentBanks as $parentBank)
                <option value="{{ $parentBank->id }}" @selected(old('parent_id', $bank->parent_id) == $parentBank->id)>
                    {{ $parentBank->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter bank name"
            value="{{ old('name', $bank->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="status" class="required form-label">Status</label>
        <div>
            <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="1" id="status" name="status"
                    @checked(old('status', $bank->status) == '1') />
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>

            <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
                <input class="form-check-input" type="radio" value="0" id="status" name="status"
                    @checked(old('status', $bank->status) == '0') />
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
