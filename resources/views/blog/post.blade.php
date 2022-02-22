@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    <a href="{{ route('blog.comments', ['post',  $post->id]) }}"
       class="btn btn-primary mt-2 mb-2">Comments{{ $comments_count ? ' (' . $comments_count . ')' : '' }}</a>
    <p class="fw-bold pt-2">{{ $post->name }}</p>
    <p>{{ $post->content }}</p>
@endsection
