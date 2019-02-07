@extends('layouts.backOffice')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Control panel</div>

                <div class="panel-body">
                    @include ('_session_status')

                    <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th>Order full name</th>
                            <th>User email</th>
                            <th>User full name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ optional($order->user)->email }}</td>
                            <td>{{ optional($order->user)->full_name }}</td>
                            <td>{{ $order->status_string }}</td>
                            <td>
                            <a 
                                class="btn btn-default btn-warning"
                                href="{{ route('backOffice.orders.show', [$order->id]) }}"> 
                                Show
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection