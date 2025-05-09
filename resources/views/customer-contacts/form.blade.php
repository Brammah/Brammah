<div class="mb-5 row">
    <div class="col-md-6">
        <label for="customer_id" class="form-label fw-bold">Customer:</label>
        <select class="form-select" name="customer_id" id="customer_id" data-control="select2"
            data-placeholder="select customer">
            <option value="" selected>select customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $customerContact->customer_id) == $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="enter name"
            value="{{ old('name', $customerContact->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="email" class="required form-label fw-bold">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="enter email"
            value="{{ old('email', $customerContact->email) }}">
        @error('email')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="required form-label fw-bold">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="enter phone"
            value="{{ old('phone', $customerContact->phone) }}">
        @error('phone')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
