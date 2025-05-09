{{-- <div class="mb-5 row">
    <div class="col-md-6">
        <label for="branch_id" class="form-label fw-bold">Branch:</label>
        <select class="form-select" name="branch_id" id="branch_id" data-control="select2" data-placeholder="select branch">
            <option value="" selected>Select Branch</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @selected(old('branch_id', $branch->branch_id) == $branch->id)>
                    {{ $branch->name }}
                </option>
            @endforeach
        </select>
        @error('branch_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div> --}}

<div class="mb-5 row">
    <div class="col-md-12">
        <label for="name" class="required form-label fw-bold">Make</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter vehicle make"
            value="{{ old('name', $vehicleMake->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
