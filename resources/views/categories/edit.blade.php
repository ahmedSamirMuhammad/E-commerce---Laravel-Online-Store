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
                    <h1 class="lead">Edit category data</h1>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route ( 'categories.update' , $category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="mb-3 row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" required maxlength="50" class="form-control" id="name" name="name"
                                    value="{{ $category->name }}">
                            </div>
                            <div class="col">
                                <label for="logo">Logo</label>
                                <input type="file" required maxlength="50" class="form-control" id="logo" name="logo">
                                @if ($category->logo)
                                <div class="mt-3">
                                    <img src="{{ asset('assets/images/' . $category->logo) }}" alt="Existing logo"
                                        width="100">
                                </div>
                                @else
                                <span></span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 btn-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection