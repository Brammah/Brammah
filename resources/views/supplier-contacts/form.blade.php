<div class="mb-5 row">
    <div class="col-md-6">
        <label for="supplier_id" class="form-label fw-bold">Supplier:</label>
        <select class="form-select" name="supplier_id" id="supplier_id" data-control="select2"
            data-placeholder="select supplier">
            <option value="" selected>select supplier</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" @selected(old('supplier_id', $supplierContact->supplier_id) == $supplier->id)>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="enter name"
            value="{{ old('name', $supplierContact->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="email" class="required form-label fw-bold">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="enter email"
            value="{{ old('email', $supplierContact->email) }}">
        @error('email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="required form-label fw-bold">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="enter phone"
            value="{{ old('phone', $supplierContact->phone) }}">
        @error('phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
