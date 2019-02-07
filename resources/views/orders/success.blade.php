@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            Thanks for your order!
            <br>
            <a class="btn btn-success" href="{{ $paymentUrl }}">Pay online</a>
        </div>
    </div>
</div>
@endsection