@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <form action="{{ route('admin.tags.edit', $tag->id) }}" method="post" class="mt-3 mb-3">
        @csrf
        @method('GET')
        <button class="btn btn-primary" type="submit">Edit</button>
    </form>
    <p>ID: {{ $tag->id }}</p>
    <p>Name: {{ $tag->name }}</p>
    <p>Created at: {{ $tag->created_at ?? '???' }}</p>
    <p>Updated at: {{ $tag->updated_at ?? '???' }}</p>
@endsection
