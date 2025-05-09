<div class="mb-5 row">
    <div class="col-md-6" id="mapToStaffContainer">
        <div class="fv-row fv-plugins-icon-container">
            <label for="create_as_user" class="required form-label fw-bold">Map to Staff:</label>
            <select class="form-select" name="create_as_user" id="create_as_user" data-control="select2"
                data-placeholder="select choice">
                <option value="" selected>Select choice</option>
                <option value="1" @selected(old('create_as_user', $agent->create_as_user) == '1')>Yes</option>
                <option value="0" @selected(old('create_as_user', $agent->create_as_user) == '0')>No</option>
            </select>
            @error('create_as_user')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 d-none" id="staffContainer">
        <label for="user_id" class="form-label fw-bold">Staff:</label>
        <select class="form-select" name="user_id" id="user_id" data-control="select2"
            data-placeholder="select staff">
            <option value="" selected>Select Staff</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id', $agent->user_id) == $user->id)>
                    {{ strtoupper($user->full_name) }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6" id="agentCodeContainer">
        <label class="required form-label">Agent Code</label>
        <div class="fw-bold fs-3">
            <input type="text" class="mb-2 border-gray-300 form-control form-control-solid" placeholder="agent code"
                name="agent_code" id="agent_code" value="{{ old('agent_code', $agent->agent_code) }}" readonly>
        </div>
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="enter agent name"
            value="{{ old('name', $agent->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="phone" class="required form-label fw-bold">Phone</label>
        <input type="phone" name="phone" id="phone" class="form-control" placeholder="enter agent phone"
            value="{{ old('phone', $agent->phone) }}">
        @error('phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="type" class="required form-label fw-bold">Agent Type:</label>
            <select class="form-select" name="type" id="type" data-control="select2"
                data-placeholder="select type">
                <option value="" selected>Select Type</option>
                <option value="individual" @selected(old('type', $agent->type) == 'individual')>
                    Individual
                </option>
                <option value="business" @selected(old('type', $agent->type) == 'business')>
                    Business
                </option>
            </select>
            @error('type')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="status" class="required form-label fw-bold">Status:</label>
            <select class="form-select" name="status" id="status" data-control="select2"
                data-placeholder="select status">
                <option value="" selected>Select Status</option>
                <option value="1" @selected(old('status', $agent->status) == '1')>Active</option>
                <option value="0" @selected(old('status', $agent->status) == '0')>Inactive</option>
            </select>
            @error('status')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 row d-none" id="businessDetails">
    <div class="col-md-4">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="enter agent email"
            value="{{ old('email', $agent->email) }}">
        @error('email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="address" class="form-label fw-bold">Address</label>
        <input type="text" name="address" id="address" class="form-control" placeholder="enter agent address"
            value="{{ old('address', $agent->address) }}">
        @error('address')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="kra_pin" class="form-label fw-bold">KRA Pin</label>
        <input type="text" name="kra_pin" id="kra_pin" class="form-control" placeholder="enter agent kra pin"
            value="{{ old('kra_pin', $agent->kra_pin) }}">
        @error('kra_pin')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <div class="fv-row fv-plugins-icon-container">
            <label for="payment_type" class="required form-label fw-bold">Payment Type:</label>
            <select class="form-select" name="payment_type" id="payment_type" data-control="select2"
                data-placeholder="select payment type">
                <option value="" selected>Select Payment Type</option>
                <option value="flat-fee" @selected(old('payment_type', $agent->payment_type) == 'flat-fee')>
                    Flat Fee
                </option>
                <option value="percentage" @selected(old('payment_type', $agent->payment_type) == 'percentage')>
                    Percentage
                </option>
            </select>
            @error('payment_type')
                <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6" id="percentageValue">
        <label for="percentage_value" class="required form-label fw-bold">Percentage Value</label>
        <input type="number" name="percentage_value" id="percentage_value" class="form-control"
            placeholder="enter percentage value" value="{{ old('percentage_value', $agent->percentage_value) }}">
        @error('percentage_value')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6 d-none" id="flatFee">
        <label for="flat_fee_amount" class="required form-label fw-bold">Flat Fee Amount</label>
        <input type="number" step="any" name="flat_fee_amount" id="flat_fee_amount" class="form-control"
            placeholder="enter flat fee value" value="{{ old('flat_fee_amount', $agent->flat_fee_amount) }}">
        @error('flat_fee_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="target_amount" class="required form-label fw-bold">Target Amount</label>
        <input type="number" step="any" name="target_amount" id="target_amount" class="form-control"
            placeholder="enter target amount, exclusive VAT"
            value="{{ old('target_amount', $agent->target_amount) }}">
        @error('target_amount')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
