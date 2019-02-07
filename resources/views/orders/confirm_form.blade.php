@extends('layouts.app')

<?php 
$full_name = optional(optional($user)->profile)->full_name;
$street = optional(optional($user)->profile)->street;
$city = optional(optional($user)->profile)->city;
$phone = optional(optional($user)->profile)->phone;
?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('_errors_list')
        </div>
        <div class="col-md-6">
            <form action="{{ route('order.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                        <label for="full_name">Full name</label>
                        <input type="text" 
                            name="full_name" 
                            class="form-control" 
                            id="full_name" 
                            placeholder="Enter your full name"
                            value="{{ old('full_name', $full_name) }}">
                </div>

                <div class="form-group">
                    <label for="np_city">Enter city name</label>
                    <input type="text" 
                        name="np_city" 
                        class="form-control" 
                        id="np_city" 
                        value="" data-callback-url="{{ route('np.search_city') }}">
                </div>

                <div class="form-group">
                        <label for="np_warehouse">Choose warehouse from dropdown</label>
                        <select 
                        class="form-control" 
                        id="np_warehouse" 
                        name="np_warehouse"
                        data-callback-url="{{ route('np.search_warehouse') }}"></select>
                </div>

                <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" 
                            name="phone" 
                            class="form-control" 
                            id="phone" 
                            placeholder="Enter your phone"
                            value="{{ old('phone', $phone) }}">
                </div>

                <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea 
                            class="form-control" 
                            id="comment" 
                            name="comment" 
                            rows="5">{{ old('comment') }}</textarea>
                </div>

                <button class="btn btn-info" type="submit">Confirm order</button>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total price</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cart->products as $pr)
                <tr data-product-id="{{ $pr->productId }}">
                    <td>{{ $pr->realProduct()->name }}</td>
                    <td>{{ $pr->quantity }}</td>
                    <td>{{ $pr->price }}</td>
                    <td>{{ $pr->getTotalPrice() }}</td>
                </tr>
                @endforeach 
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 cart-totals">
            <span>Total products:</span> <span class="cart-totals-count">{{ $cart->getCartProductsCount() }}</span>
            <br>
            <strong>Total price:</strong> <strong class="cart-totals-price">{{ $cart->getTotalPrice() }}</strong>
    </div>
</div>
@endsection