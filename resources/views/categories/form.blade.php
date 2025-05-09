<div class="mb-5 row">
    <div class="col-md-6">
        <label for="category_type" class="required form-label fw-bold">Category Type:</label>
        <select class="form-select" name="category_type" id="category_type" data-control="select2"
            data-placeholder="select category type">
            <option value="" selected>Select Category Type</option>
            @foreach ($categoryTypes as $categoryType)
                <option value="{{ $categoryType }}" @selected(old('category_type', $category->category_type) == $categoryType)>
                    {{ strtoupper($categoryType) }}
                </option>
            @endforeach
        </select>
        @error('category_type')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="enter category name"
            value="{{ old('name', $category->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="parent_id" class="form-label fw-bold">Parent Category:</label>
        <select class="form-select" name="parent_id" id="parent_id" data-control="select2"
            data-placeholder="select parent category">
            <option value="" selected>Select Parent Category</option>
            @foreach ($parentCategories as $category)
                <option value="{{ $category->id }}" @selected(old('parent_id', $category->parent_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
