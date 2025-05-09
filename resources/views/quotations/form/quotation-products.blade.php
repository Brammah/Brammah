<div class="mb-5 row">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-4">
                <label for="brand_id" class="required form-label fw-bold">
                    Brand:
                </label>
                <select class="form-control form-select @error('brand_id') is-invalid @enderror" data-control="select2"
                    data-placeholder="select brand" id="brand_id">
                    <option></option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @selected(old('brand_id', $quotation->brand_id) == $brand->id)>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="col-md-5">
                <label for="brand_product_id" class="required form-label fw-bold">Product:</label>
                <select class="form-control form-select @error('brand_product_id') is-invalid @enderror"
                    data-control="select2" data-placeholder="select product" id="brand_product_id">
                    <option></option>
                </select>
                @error('brand_product_id')
                    <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="available_quantity" class="text-muted"></small>
            </div>
            <div class="col-md-3">
                <label for="quote_quantity" class="required form-label fw-bold">Quote Qty:</label>
                <input type="number" step="any" id="quote_quantity"
                    class="mb-2 form-control @error('quote_quantity') is-invalid @enderror" placeholder="quote qty"
                    value="{{ old('quote_quantity') }}">
                @error('quote_quantity')
                    <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-5">
                <label for="issue_quantity" class="required form-label fw-bold">Issue Qty:</label>
                <input type="number" step="any" id="issue_quantity"
                    class="mb-2 form-control @error('issue_quantity') is-invalid @enderror" placeholder="issue qty"
                    value="{{ old('issue_quantity') }}">
                @error('issue_quantity')
                    <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="col-md-5">
                <label for="selling_price" class="required form-label fw-bold">Selling Price:</label>
                <input type="number" step="any" id="selling_price"
                    class="mb-2 form-control @error('selling_price') is-invalid @enderror" placeholder="selling price"
                    value="{{ old('price') }}">
                @error('selling_price')
                    <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="priceRange" class="text-muted"></small>
            </div>

            <div class="mt-3 col-md-2">
                <button type="button" class="mt-6 btn btn-sm btn-info" id="btn_add_product">
                    <i class="mb-1 fa-solid fa-cart-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="my-10 separator separator-dashed border-primary"></div>
<div id="quotation_products" class="border rounded gy-2 fs-6"></div>
<div class="my-10 separator separator-dashed border-primary"></div>
