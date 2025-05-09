<div class="mb-5 row">
    <div class="col-md-6">
        <label for="vehicle_make_id" class="form-label fw-bold">Vehicle Make:</label>
        <select class="form-select" name="vehicle_make_id" id="vehicle_make_id" data-control="select2"
            data-placeholder="select vehicle make">
            <option value="" selected>Select Vehicle Make</option>
            @foreach ($vehicleMakes as $branch)
                <option value="{{ $branch->id }}" @selected(old('vehicle_make_id', $vehicleModel->vehicle_make_id) == $branch->id)>
                    {{ $branch->name }}
                </option>
            @endforeach
        </select>
        @error('vehicle_make_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Model</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter vehicle model"
            value="{{ old('name', $vehicleModel->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
