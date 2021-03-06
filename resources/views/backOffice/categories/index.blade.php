@extends('layouts.backOffice')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category control</div>

                <div class="panel-body">

                    @include ('_session_status')

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Icon</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @isset($category->iconPath)
                                        <img src="{{ Storage::url($category->iconPath) }}" width="50">
                                    @endisset
                                </td>
                                <td> 
                                    
                                    <form method="Post" action="{{ route('backOffice.categories.destroy', $category)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                    
                                        <a class="btn btn-default btn-warning"
                                            href="{{ route('backOffice.categories.edit', $category)}}">Edit</a>
                                            
                                        <button type="submit" class="btn  btn-default btn-danger">Delete</button>
                                    </form>              
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
