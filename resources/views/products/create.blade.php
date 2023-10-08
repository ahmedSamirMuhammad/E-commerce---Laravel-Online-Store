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
                    <h1 class="lead">create product data</h1>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route ( 'products.store' ) }}">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col">
                                <label>Title</label>
                                <input type="text" required maxlength="50" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="email_addr">price</label>
                                <input type="text" required maxlength="50" class="form-control" id="price" name="price">
                            </div>
                            <div class="col">
                                <label for="image_url">Image URL</label>
                                <input type="text" required maxlength="50" class="form-control" id="image_url"
                                    name="image_url">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                <option selected disabled value="">Choose the category</option>

                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 btn-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection