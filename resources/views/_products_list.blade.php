<div class="row products-list">
    @foreach($category->products as $product)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ Storage::url($product->imagePath) }}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title"><a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->name }}</a></h5>
                <p class="card-text">{{ $product->short_description }}</p>
                <p class="card-text">{{ $product->price."$" }}</p>
                <a href="#" class="btn btn-primary btn-add-to-cart" 
                            data-product-id="{{ $product->id }}">Add to cart</a>
                </div>
            </div>
        </div>
    @endforeach
</div>