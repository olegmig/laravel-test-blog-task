@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12 js-posts-section">
        <h2 class="mt-4">Posts <a href="{{ url('/post/create') }}" class="btn btn-link"><i class="fas fa-plus"></i></a></h2>

        <div class="list-group">

            @foreach($posts as $post)
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="{{ url('/post', $post) }}">
                            <h5 class="mb-1">{{ $post->name }}</h5>
                        </a>
                        <a href="{{ url("/post/{$post->id}/edit") }}" class="btn btn-link"><i class="far fa-edit"></i></a>
                    </div>
                    <p class="lead">Category:
                        @if($post->category)
                            <a href="{{ url("/category/{$post->category->id}") }}"><span class="badge badge-secondary">{{ $post->category->name ?? $post->category->id }}</span></a>
                        @else
                            -
                        @endif
                    </p>
                    <p class="mb-1">
                        {{ str_limit($post->content, 300, '...') }}
                        <a href="{{ url("/post/{$post->id}") }}">Read more</a>
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
