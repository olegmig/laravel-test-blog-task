@extends('app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="mt-4">Add new category</h2>

        <form action="{{ url('/category') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="" max="255">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" value="">
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

            <button type="submit" class="btn btn-default btn-primary">Create</button>
        </form>
    </div>
</div>

@endsection
