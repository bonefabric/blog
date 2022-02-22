@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                @foreach($post->tags->all() as $tag)
                    <span class="bg-dark p-1 rounded text-white">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->name }}</h5>
                <a href="{{ route('blog.post', $post->id) }}" class="btn btn-primary">Read</a>
                <a href="{{ route('blog.comments', ['post', $post->id]) }}"
                   class="btn btn-primary">Comments{{ $post->comments_count ? ' (' . $post->comments_count . ')' : '' }}</a>
            </div>
        </div>
    @endforeach
@endsection
