<div class="form-group">
    <label for="name" class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        <input id="name" 
            type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', optional($category ?? null)->name) }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-4 control-label">Description</label>
    <div class="col-md-6">        
        <textarea
            id="description"
            name="description"
            class="form-control"
            required>{{ old('description', optional($category?? null)->description) }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="icon">Icon</label>
        <input type="file"
            name="icon"
            class="form-control"
            id="icon">
</div>