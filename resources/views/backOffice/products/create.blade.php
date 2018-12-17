@extends('backOffice.layouts.backOffice')

@section('content')
    <h1 class="title col-md-8 col-md-offset-2">Create a New Product</h1>
    
    <form method="POST" action="{{ route ('products.index') }}">
        {{ csrf_field() }}

        <div class="field col-md-8 col-md-offset-2">
            <label for="name">Product name</label>
            <div class="control">
                <input 
                    type="text"
                    class="input {{ $errors->has('name') ? 'is-danger' : '' }}"
                    name="name"
                    value="{{ old('name') }}"    
                    required>
            </div>
        </div>

        <div class="field col-md-8 col-md-offset-2">
            <label for="description">Description</label>
            <div class="control">
                <textarea
                    name="description"
                    class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}"
                    required
                >
                    {{ old('description') }}
                </textarea>
            </div>
        </div>

        <div class="field col-md-8 col-md-offset-2">
            <label for="price">Price</label>
            <div class="control">
                <input
                    type="text"
                    class="input {{ $errors->has('price') ? 'is-danger' : '' }}"
                    name="price"
                    value="{{ old('price') }}"
                    required>
            </div>
        </div>

        <div class="field col-md-8 col-md-offset-2">
            <div class="control">
                <button type="submit" class="button is-link">Create Product</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>    
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection