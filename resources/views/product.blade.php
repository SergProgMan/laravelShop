@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('_sidebar');
        </div>
        <div class="col-md-9">
            <div class="card">
                <img class="card-img-top" src="{{ Storage::url($product->imagePath) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->name }}</a></h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">{{ $product->price."$" }}</p>
                    <a href="#" class="btn btn-primary">Buy</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection