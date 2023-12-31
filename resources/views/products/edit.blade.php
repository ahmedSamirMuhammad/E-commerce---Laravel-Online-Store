@extends('layouts.app')

@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="lead">Edit product data</h1>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="title">Title</label>
                                <input type="text" required maxlength="50" class="form-control" id="title" name="title"
                                    value="{{ $product->title }}">
                                @error('title')
                                <div class="text-danger mt-2">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="price">Price</label>
                                <input type="text" required maxlength="50" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                <div class="text-danger mt-2">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="image_url">Image URL</label>
                                <input type="text" required maxlength="50" class="form-control" id="image_url"
                                    name="image_url" value="{{ $product->image_url }}">
                                @error('image_url')
                                <div class="text-danger mt-2">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="5">{{ $product->description }}</textarea>
                            @error('description')
                            <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option selected disabled value="">Choose the category</option>

                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id ==$product->category_id ?
                                    "selected" : "" }} >{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                            <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary px-4 btn-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection