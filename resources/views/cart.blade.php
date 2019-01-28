@extends('layouts.menu')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Quanity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total price</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->products as $product)
                    <tr>
                        <td>{{ $product->realProduct()->name }}</td>
                        <td>
                            <input class="cart-quantity-input" type="number" value="{{ $product->quantity }}"></td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->getTotalPrice() }}</td>
                        <td><button class="btn btn-xs btn-danger">X</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 cart-totals">
            <span>Total products: {{ $cart->getCartProductsCount() }}</span>
            <br>
            <strong>Total price: {{ $cart->getTotalPrice() }}</strong>
        </div>
    </div>
</div>

@endsection