@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>
        <a href="{{ route('admin.tags.edit', $tag->id) }}">Edit</a>
    </p>
    <p>ID: {{ $tag->id }}</p>
    <p>Name: {{ $tag->name }}</p>
    <p>Created at: {{ $tag->created_at ?? '???' }}</p>
    <p>Updated at: {{ $tag->updated_at ?? '???' }}</p>
@endsection
