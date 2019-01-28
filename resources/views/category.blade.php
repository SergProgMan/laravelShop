@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('_sidebar', ['current_category' => $category])
        </div>
        <div class="col-md-9">
          @include('_products_list')
        </div>
    </div>
</div>
@endsection