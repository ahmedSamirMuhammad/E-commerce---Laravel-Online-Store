@extends('layouts.app')

@section('content')

<a type="submit" class="btn btn-danger mb-5" href="{{ route( 'categories.create' ) }}">Insert new category</a>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($categories as $category)
    <div class="col">
        <div class="card shadow h-100">
            <img class="card-img-top img-fluid" alt="category Thumbnail" src="{{ asset('assets/images/'.$category['logo']) }}" />
            <div class="card-body">
                <h5 class="card-title text-primary"> {{ $category->title }} </h5>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-primary my-3" href="{{ route('categories.show', ['category' => $category->id]) }}">
                        View Details
                    </a>
                    <a class="btn btn-secondary my-3" href="{{ route('categories.edit', ['category' => $category->id]) }}">
                        Edit
                    </a>
                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
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
    {{ $categories->links('pagination::bootstrap-4') }}
</div>

<style>
    img {
        height: 250px;
    }
</style>

@endsection