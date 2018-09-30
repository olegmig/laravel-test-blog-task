@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="mt-4">Post: {{ $post->name }} <a href="{{ url("/post/{$post->id}/edit") }}" class="btn btn-link"><i class="fas fa-edit"></i></a></h2>
        <p class="lead">Category:
            @if($post->category)
                <a href="{{ url("/category/{$post->category->id}") }}"><span class="badge badge-secondary">{{ $post->category->name ?? $post->category->id }}</span></a>
            @else
                -
            @endif
        </p>
        <p class="justify-content-center">{{ $post->content }}</p>
        <p>
            @if ($post->file)
                <span>File:</span> <a href="{{ asset('storage' . $post->file) }}" download>Download</a>
            @endif
        </p>
        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete Post</button>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-6 js-comments-section">
        <h4 class="mt-4">Comments</h4>

        @component('comment.add')
            <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
        @endcomponent

        <div class="mt-4 js-comments-block">
            @foreach($post->comments as $comment)
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

        @if(!count($post->comments))
            <p class="js-no-comments">No comments yet</p>
        @endif

    </div>
</div>

@endsection
