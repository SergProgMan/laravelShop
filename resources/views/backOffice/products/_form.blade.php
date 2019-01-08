<div class="form-group">
    <label for="category_name">Category</label>
    <input type="text" 
        class="form-control"
        id="category_name"
        class="form-control"
        placeholder="Enter category name"
        autocomplete="off">
</div>
<input id="category_id" 
    type="hidden" 
    name="category_id" 
    data-search-end-point="{{ route('backOffice.categories.index') }}">

<div class="form-group">
    <label for="name" class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        <input id="name" 
            type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', optional($product ?? null)->name) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="price" class="col-md-4 control-label">Price</label>
    <div class="col-md-6">
        <input id="price" 
            type="text" 
            class="form-control" 
            name="price" 
            value="{{ old('price', optional($product ?? null)->price) }}" required>
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