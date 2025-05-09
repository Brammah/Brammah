<div class="mb-5 row">
    <div class="col-md-6">
        <label for="parent_id" class="form-label fw-bold">Parent Branch:</label>
        <select class="form-select" name="parent_id" id="parent_id" data-control="select2"
            data-placeholder="select parent branch">
            <option value="" selected>Select Parent Branch</option>
            @foreach ($parentBranches as $parentBranch)
                <option value="{{ $parentBranch->id }}" @selected(old('parent_id', $branch->parent_id) == $parentBranch->id)>
                    {{ $parentBranch->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="mb-5 row">
    <div class="col-md-6">
        <label for="name" class="required form-label fw-bold">Name</label>
        <input type="name" name="name" id="name" class="form-control" placeholder="enter branch name"
            value="{{ old('name', $branch->name) }}">
        @error('name')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="code" class="required form-label fw-bold">Code</label>
        <input type="code" name="code" id="code" class="form-control" placeholder="enter branch code"
            value="{{ old('code', $branch->code) }}">
        @error('code')
            <span class="fv-plugins-message-container invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
