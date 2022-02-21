@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p class="fw-bold pt-2">Edit post</p>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}">
        </div>
        <div>
            <span>Tags:</span>
            @foreach($tags as $tag)
                <label for="{{ 'checkbox_tag_' . $tag->id }}" class="form-label ms-2">{{ $tag->name }}</label>
                <input class="form-check-input" type="checkbox" id="{{ 'checkbox_tag_' . $tag->id }}"
                       name="{{ 'tag_' . $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
            @endforeach
        </div>
        <textarea class="form-control mb-2 mt-2" aria-label="Content" name="content">{{ $post->content }}</textarea>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @if($errors->any())
        <div class="row mt-5">
            <div class="col-8 offset-2">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
