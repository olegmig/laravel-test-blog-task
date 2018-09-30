@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="mt-4">Editing post: {{ $post->name }}</h2>

        <form action="{{ url('/post', $post) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ optional($post->category)->id === $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="name">Name*:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}" max="255" required>
            </div>
            <div class="form-group">
                <label for="content">Content*:</label>
                <textarea class="form-control" name="content" id="content" rows="5" required>{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-default btn-primary">Update</button>
        </form>
        <br>
        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete Post</button>
        </form>
        <br>
    </div>
</div>

@endsection
