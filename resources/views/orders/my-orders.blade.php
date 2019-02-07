@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My orders</div>

                <div class="panel-body">
                    @foreach ($orders as $order)
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>Full name</td>
                                <td>{{ $order->full_name }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <td>Products</td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $orderProduct)
                                            <tr>
                                                <td>{{ $orderProduct->product->name }}</td>
                                                <td>{{ $orderProduct->quantity }}</td>
                                                <td>{{ $orderProduct->price }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection