@extends('layouts.menu')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table cart-table">
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
                    <tr data-product-id="{{ $product->productId }}">
                        <td>{{ $product->realProduct()->name }}</td>
                        <td>
                            <input class="cart-quantity-input" type="number" value="{{ $product->quantity }}"></td>
                        <td>{{ $product->price }}</td>
                        <td class="cart-total-product-price">{{ $product->getTotalPrice() }}</td>
                        <td><button class="btn btn-xs btn-danger cart-product-remove">X</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 cart-totals">
            <span>Total products:</span ><span class="cart-totals-count"> {{ $cart->getCartProductsCount() }}</span>
            <br>
            <strong>Total price:</strong><strong class="cart-totals-price"> {{ $cart->getTotalPrice() }}</strong>
            <br>
            <a href="{{ route('order.create') }}">Checkout</a>
        </div>
    </div>
</div>

@endsection