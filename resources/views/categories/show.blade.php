@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('assets/images/'.$category['logo']) }}" alt="Category Image" class="img-fluid rounded" />
        </div>
        <div class="col-md-6">
            <h2 class="display-4">{{ $category->name }}</h2>
            <p class="text-success h3 font-weight-bold">
                ID: {{ $category->id }}
            </p>
            <p class="text-success h3 font-weight-bold">
                Products :
            <ul class="list-unstyled">
                @foreach ($products as $product)
                <li><a href="{{ route('products.show', ['id' => $product->id]) }}" class="fs-4 px-3 text-decoration-none">{{ $product->title }}</a></li>
                @endforeach
            </ul>
            </p>
        </div>
    </div>
</div>

@endsection