@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="mt-4">Category: {{ $category->name }}
            <a href="{{ url("/category/{$category->id}/edit") }}" class="btn btn-link"><i class="fas fa-edit"></i></a>
        </h2>
        <p class="lead">{{ $category->description }}</p>

        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete Category</button>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12 js-posts-section">
        <h3 class="mt-4">Posts:</h3>

        @if(count($category->posts))

            <div class="list-group">

                @foreach($category->posts as $post)
                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="{{ url('/post', $post) }}">
                                <h5 class="mb-1">{{ $post->name }}</h5>
                            </a>
                            <a href="{{ url("/post/{$post->id}/edit") }}" class="btn btn-link"><i class="far fa-edit"></i></a>
                        </div>
                        <p class="mb-1">
                            {{ str_limit($post->content, 300, '...') }}
                            <a href="{{ url("/post/{$post->id}") }}">Read more</a>
                        </p>

                    </div>
                @endforeach

            </div>
        @else
            <p>No posts in this category</p>
        @endif

    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-6 js-comments-section">
        <h4 class="mt-4">Comments</h4>

        @component('comment.add')
            <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}">
        @endcomponent

        <div class="mt-4 js-comments-block">
            @foreach($category->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p>
                            <strong>{{ $comment->author }}</strong>
                        </p>
                        <div class="clearfix"></div>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @if(!count($category->comments))
            <p class="js-no-comments">No comments yet</p>
        @endif

    </div>
</div>

@endsection
