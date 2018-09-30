@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="mt-4">Categories <a href="{{ url('/category/create') }}" class="btn btn-link"><i class="fas fa-plus"></i></a></h2>

        <div class="list-group">

            @foreach($categories as $category)
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="{{ url('/category', $category) }}">
                            <h5 class="mb-1">{{ $category->name }}</h5>
                        </a>
                        <a href="{{ url("/category/{$category->id}/edit") }}" class="btn btn-link"><i class="far fa-edit"></i></a>
                    </div>
                    <p class="mb-1">{{ $category->description }}</p>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
