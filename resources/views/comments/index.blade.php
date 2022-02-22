@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    <a href="{{ route('blog.post', Route::current()->parameter('id')) }}" class="btn btn-primary mt-2 mb-2">Back to {{ $source }}</a>
    <a href="{{ route('blog.comments.create', ['post', Route::current()->parameter('id')]) }}" class="btn btn-primary mt-2 mb-2">New comment</a>
    <div class="row">
        <div class="col">
            @foreach($comments as $comment)
                <div class="alert alert-dark" role="alert">
                    {{ $comment->comment }}
                </div>
            @endforeach
        </div>
    </div>
@endsection
