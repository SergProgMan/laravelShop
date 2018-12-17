@extends('backOffice.layouts.backOffice')

@section('content')



@foreach($categories as $category)
<li>{{ $category->name }} </li>
@endforeach


@endsection