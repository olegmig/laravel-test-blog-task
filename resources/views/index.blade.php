@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="mt-4">
                <a href="{{ url('/category') }}">Categories</a>
            </h2>
            <h2 class="mt-4">
                <a href="{{ url('/post') }}">Posts</a>
            </h2>
        </div>
    </div>

@endsection
