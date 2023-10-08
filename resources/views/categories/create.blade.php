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
                    <h1 class="lead">Create category data</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route ( 'categories.store' ) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="id">ID</label>
                                <input type="text" required class="form-control" id="id" name="id">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" required maxlength="50" class="form-control" id="name" name="name">
                            </div>
                            <div class="col">
                                <label for="logo">Logo</label>
                                <input type="file" required maxlength="50" class="form-control" id="logo" name="logo">
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