@extends('backOffice.layouts.backOffice')

@section('content')

<div class="col-md-8 col-md-offset-2">

<table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
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

@endsection