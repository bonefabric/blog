@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    <p class="fw-bold pt-2">{{ $post->name }}</p>
    <p>{{ $post->content }}</p>
@endsection
