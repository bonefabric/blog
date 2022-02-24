@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p class="mt-3">ID: {{ $comment->id }}</p>
    <p>Comment: {{ $comment->comment }}</p>
    <p>Created at: {{ $comment->created_at ?? '???' }}</p>
    <p>Updated at: {{ $comment->updated_at ?? '???' }}</p>
@endsection
