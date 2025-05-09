<div class="mb-5 row">
    <div class="col-md-6">
        <label for="supplier_code" class="required form-label fw-bold">Code:</label>
        <input type="text" placeholder="supplier code" id="supplier_code" name="supplier_code"
            class="border-gray-300 form-control form-control-solid"
            value="{{ old('supplier_code', $supplier->supplier_code) }}" readonly>
    </div>
    <div class="col-md-6">
        <label for="type" class="required form-label fw-bold">Type:</label>
        <select class="form-control form-select  @error('type') is-invalid @enderror" data-control="select2"
            data-placeholder="select supplier type" name="type" id="type">
            <option></option>
            @foreach ($supplierTypes as $supplierType)
                <option value="{{ $supplierType }}" @selected(old('type', $supplier->type) == $supplierType)>
                    {{ strtoupper($supplierType) }}
                </option>
            @endforeach
        </select>
        @error('type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="country_id" class="required form-label fw-bold">Country:</label>
        <select class="form-control form-select  @error('country_id') is-invalid @enderror" data-control="select2"
            data-placeholder="select supplier's country" name="country_id" id="country_id">
            <option></option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @selected(old('country_id', $supplier->country_id) == $country->id)>
                    {{ strtoupper($country->name) }}
                </option>
            @endforeach
        </select>
        @error('type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name:</label>
        <input type="text" placeholder="enter supplier name" name="name" class="form-control"
            value="{{ old('name', $supplier->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="phone" class="required form-label fw-bold">Phone:</label>
        <input type="text" placeholder="enter supplier phone" name="phone" id="phone" class="form-control"
            value="{{ old('phone', $supplier->phone) }}">
        @error('phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label fw-bold">Email:</label>
        <input type="email" placeholder="enter email" name="email" class="form-control"
            value="{{ old('email', $supplier->email) }}">
        @error('email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="kra_pin" class="form-label fw-bold">KRA Pin:</label>
        <input type="text" placeholder="enter kra pin" name="kra_pin" class="form-control"
            value="{{ old('kra_pin', $supplier->kra_pin) }}">
        @error('kra_pin')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="address" class="form-label fw-bold">Address:</label>
        <input type="text" placeholder="enter supplier address" name="address" class="form-control"
            value="{{ old('address', $supplier->address) }}">
        @error('address')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="status" class="required form-label fw-bold">Status:</label>
            <select class="form-select" name="status" id="status" data-control="select2"
                data-placeholder="select status">
                <option value="" selected>Select Status</option>
                <option value="1" @selected(old('status', $supplier->status) == '1')>Active</option>
                <option value="0" @selected(old('status', $supplier->status) == '0')>Inactive</option>
            </select>
            @error('status')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <label for="description" class="required form-label fw-bold">Description:</label>
        <input type="text" placeholder="enter brief description i.e. suppliers of XYZ" name="description"
            class="form-control" value="{{ old('description', $supplier->description) }}">
        @error('description')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
