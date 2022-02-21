@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <form action="{{ route('admin.posts.edit', $post->id) }}" method="post" class="mt-3 mb-3">
        @csrf
        @method('GET')
        <button class="btn btn-primary" type="submit">Edit</button>
    </form>
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
