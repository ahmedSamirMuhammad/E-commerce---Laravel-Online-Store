@extends('layouts.app')

@section('content')

<a type="submit" class="btn btn-danger mb-5" href="{{ route( 'products.create' ) }}">Insert new product</a>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($products as $product)
    <div class="col">
        <div class="card shadow h-100">
            <img class="card-img-top" alt="Product Thumbnail" src="{{ $product->image_url }}" />
            <div class="card-body">
                <h5 class="card-title text-primary"> {{ $product->title }} </h5>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-primary my-3" href="{{ route('products.show', ['id' => $product->id]) }}">
                        View Details
                    </a>
                    <a class="btn btn-secondary my-3" href="{{ route('products.edit', ['id' => $product->id]) }}">
                        Edit
                    </a>
                    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger my-3" type="submit">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-4') }}
</div>

<style>
    img {
        height: 250px;
    }
</style>

@endsection