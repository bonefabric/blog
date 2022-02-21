@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>
        <a href="{{ route('admin.posts.create') }}">Create new</a>
    </p>
    @foreach($posts as $post)
        <div class="alert alert-primary">
            <div class="d-flex justify-content-between">
                <div class="fw-bold">
                    <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->name }}</a>
                </div>
                <div>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
