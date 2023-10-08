@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image_url }}" alt="Product Image" class="img-fluid rounded" />
        </div>
        <div class="col-md-6">
            <h2 class="display-4">{{ $product->title }}</h2>
            <h5 class="text-muted">ID: {{ $product->id }}</h5>
            <p class="lead">Description: {{ $product->description }}</p>

            @if ($category)
            <p class="lead">Category : <a href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a></p>
            @else
            <p class="lead">No category available</p>
            @endif

            <p class="text-success h3 font-weight-bold">
                Price: {{ $product->price }}
            </p>
        </div>
    </div>
</div>
<style>
    a {
        text-decoration: none;
    }
</style>
@endsection