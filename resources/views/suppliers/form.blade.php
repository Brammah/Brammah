<div class="mb-5 row">
    <div class="col-md-6">
        <label for="supplier_code" class="required form-label fw-bold">Code:</label>
        <input type="text" placeholder="supplier code" id="supplier_code" name="supplier_code"
            class="border-gray-300 form-control form-control-solid"
            value="{{ old('supplier_code', $supplier->supplier_code) }}" readonly>
    </div>
</div>

<div class="mb-5 row">
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
        @error('country_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name:</label>
        <input type="text" placeholder="enter supplier name" name="name" id="name"
            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $supplier->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="phone" class="required form-label fw-bold">Phone:</label>
        <input type="text" placeholder="enter supplier phone" name="phone" id="phone"
            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $supplier->phone) }}">
        @error('phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="email" class="form-label fw-bold">Email:</label>
        <input type="email" placeholder="enter email" name="email" id="email"
            class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $supplier->email) }}">
        @error('email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="kra_pin" class="form-label fw-bold">KRA Pin:</label>
        <input type="text" placeholder="enter kra pin" name="kra_pin" id="kra_pin"
            class="form-control @error('kra_pin') is-invalid @enderror"
            value="{{ old('kra_pin', $supplier->kra_pin) }}">
        @error('kra_pin')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="address" class="form-label fw-bold">Address:</label>
        <input type="text" placeholder="enter supplier address" name="address"
            class="form-control @error('address') is-invalid @enderror"
            value="{{ old('address', $supplier->address) }}">
        @error('address')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="description" class="required form-label fw-bold">Description:</label>
        <input type="text" placeholder="enter brief description i.e. suppliers of XYZ" name="description"
            class="form-control @error('description') is-invalid @enderror" id="description"
            value="{{ old('description', $supplier->description) }}">
        @error('description')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="status" class="required form-label fw-bold">Status:</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status"
                data-control="select2" data-placeholder="select status">
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
        <div class="fv-row fv-plugins-icon-container">
            <label for="create_contact" class="required form-label">Create Other Contact:</label>
            <select class="form-select @error('create_contact') is-invalid @enderror" name="create_contact"
                id="create_contact" data-control="select2" data-placeholder="create another contact">
                <option value="" selected>create contact</option>
                <option value="1" @selected(old('create_contact', $supplier->create_contact) == '1')>Yes</option>
                <option value="0" @selected(old('create_contact', $supplier->create_contact) == '0')>No</option>
            </select>
            @error('create_contact')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="my-10 separator separator-dashed border-primary d-none"></div>
<div class="mb-4 row d-none" id="contactInformation">
    <div class="col-md-3">
        <label for="contact_name" class="required form-label fw-bold">Contact Person Name:</label>
        <input type="text" id="contact_name" class="mb-2 form-control" placeholder="enter name"
            value="{{ old('contact_name') }}">
        @error('contact_name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="contact_phone" class="required form-label fw-bold">Contact Person Phone:</label>
        <input type="text" id="contact_phone" class="mb-2 form-control" placeholder="enter phone"
            value="{{ old('contact_phone') }}">
        @error('contact_phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="contact_email" class="required form-label fw-bold">Contact Person Email:</label>
        <input type="text" id="contact_email" class="mb-2 form-control" placeholder="enter email"
            value="{{ old('contact_email') }}">
        @error('contact_email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-3 align-self-center">
        <button type="button" class="mt-6 btn btn-sm btn-info" id="btn_add_contact">
            Add Contact
        </button>
    </div>
</div>

@if (Route::is('supplier.create'))
    <div class="my-10 separator separator-dashed border-primary d-none"></div>
    <div id="supplier_contacts" class="border rounded gy-2 fs-6"></div>
@endif
