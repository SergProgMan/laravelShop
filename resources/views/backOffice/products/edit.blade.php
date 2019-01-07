@extends('backOffice.layouts.backOffice')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Product</div>

                <div class="panel-body">

                    @include ('backOffice._session_status')
                    @include ('backOffice._errors_list')

                    <form class="form-horizontal" method="POST" action="{{ route('backOffice.products.update', $product) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        @include ('backOffice.products._form')

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
