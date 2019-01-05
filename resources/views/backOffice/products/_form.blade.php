<div class="form-group">
    <label for="category_id">Category</label>
    <select id="category_id"
            class="form-control"
            name="category_id">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" > {{ $category->name }} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name" class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', optional($product ?? null)->name) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="price" class="col-md-4 control-label">Price</label>
    <div class="col-md-6">
        <input id="price" type="text" class="form-control" name="price" value="{{ old('price', optional($product ?? null)->price) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-4 control-label">Description</label>
    <div class="col-md-6">        
        <textarea
            id="description"
            name="description"
            class="form-control textarea"
            required>{{ old('description', optional($product ?? null)->description) }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="image" class="col-md-4 control-label">Image</label>
        <input type="file"
            name="image"
            class="form-control"
            id="image">
</div>