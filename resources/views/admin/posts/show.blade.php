@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>
        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
    </p>
    <p>ID: {{ $post->id }}</p>
    <p>Name: {{ $post->name }}</p>
    <p>Created at: {{ $post->created_at ?? '???' }}</p>
    <p>Updated at: {{ $post->updated_at ?? '???' }}</p>
    <p>Content: {{ $post->content }}</p>
    <p>Tags:</p>
    @foreach($post->tags as $tag)
        <p class="ms-4">{{ $tag->name }}</p>
    @endforeach
@endsection
