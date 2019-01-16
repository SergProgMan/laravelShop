<?php
    $categories = App\Category::all();
?>

<div class="container">
    <div class="row">
      <div class="col-lg-3">
        <h1 class="my-4">Categories</h1>
        <div class="list-group">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category) }}" class="list-group-item">{{ $category->name }}</a>
        @endforeach
        </div>
      </div>
    </div>
</div>