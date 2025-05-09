<div class="mb-5 row">
    <div class="col-md-6">
        <label for="vehicle_make_id" class="form-label fw-bold">Make:</label>
        <select class="form-select" name="vehicle_make_id" id="vehicle_make_id" data-control="select2"
            data-placeholder="select vehicle make">
            <option value="" selected>Select Vehicle Make</option>
            @foreach ($vehicleMakes as $vehicleMake)
                <option value="{{ $vehicleMake->id }}" @selected(old('vehicle_make_id', $vehicle->vehicle_make_id) == $vehicleMake->id)>
                    {{ $vehicleMake->name }}
                </option>
            @endforeach
        </select>
        @error('vehicle_make_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="vehicle_model_id" class="form-label fw-bold">Model:</label>
        <select class="form-select" name="vehicle_model_id" id="vehicle_model_id" data-control="select2"
            data-placeholder="select vehicle model">
            <option value="" selected>Select Vehicle Model</option>
            @foreach ($vehicleModels as $vehicleModel)
                <option value="{{ $vehicleModel->id }}" @selected(old('vehicle_model_id', $vehicle->vehicle_model_id) == $vehicleModel->id)>
                    {{ $vehicleModel->name }}
                </option>
            @endforeach
        </select>
        @error('vehicle_model_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="registration_number" class="required form-label fw-bold">Registration Number:</label>
        <input type="text" name="registration_number" id="registration_number" class="form-control"
            placeholder="enter registration number"
            value="{{ old('registration_number', $vehicle->registration_number) }}">
        @error('registration_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="chassis_number" class="required form-label fw-bold">Chassis Number:</label>
        <input type="text" name="chassis_number" id="chassis_number" class="form-control"
            placeholder="enter chassis number" value="{{ old('chassis_number', $vehicle->chassis_number) }}">
        @error('chassis_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="engine_number" class="required form-label fw-bold">Engine Number:</label>
        <input type="text" name="engine_number" id="engine_number" class="form-control"
            placeholder="enter engine number" value="{{ old('engine_number', $vehicle->engine_number) }}">
        @error('engine_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="chassis_number" class="required form-label fw-bold">Chassis Number:</label>
        <input type="text" name="chassis_number" id="chassis_number" class="form-control"
            placeholder="enter registration number" value="{{ old('chassis_number', $vehicle->chassis_number) }}">
        @error('chassis_number')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
