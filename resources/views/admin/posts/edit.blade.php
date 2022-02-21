@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>Edit post</p>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}">
        </div>
        <select class="form-select" name="tag" aria-label="Select default tag">
            @foreach($tags as $tag)
                <option {{ $tag->id === $post->tags()->first()->id ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <textarea class="form-control mb-2 mt-2" aria-label="Content" name="content">{{ $post->content }}</textarea>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @if($errors->any())
        {{ $errors }}
    @endif
@endsection
