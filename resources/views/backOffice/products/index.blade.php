@extends('layouts.backOffice')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product control</div>
                    <div class="panel-body">
                        
                        @include ('_session_status')
                        
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Category</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ optional($product->category)->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @isset($product->imagePath)
                                            <img src="{{Storage::url($product->imagePath) }}" width="50">
                                        @endisset
                                    </td>
                                    <td> 
                                        
                                        <form method="Post" action="{{ route('backOffice.products.destroy', $product)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <a class="btn btn-default btn-warning"
                                                href="{{ route('backOffice.products.edit', $product)}}">Edit</a>
                                                
                                            <button type="submit" class="btn  btn-default btn-danger">Delete</button>
                                        </form>              
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    