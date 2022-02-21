@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <form action="{{ route('admin.posts.create') }}" method="post" class="mt-3 mb-3">
        @csrf
        @method('GET')
        <button class="btn btn-primary" type="submit">Create new</button>
    </form>
    @foreach($posts as $post)
        <div class="alert alert-primary">
            <div class="d-flex justify-content-between">
                <div class="fw-bold">
                    <span>{{ $post->deleted_at ? ' [DELETED]' : '' }}</span>&nbsp;
                    <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->name }}</a>
                </div>
                <div class="d-flex">
                    @if($post->deleted_at)
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="me-3">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="permanently" value="1">
                            <button class="btn btn-primary" type="submit">Delete permanently</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="me-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary"
                                type="submit">{{ $post->deleted_at ? 'Restore' : 'Delete' }}</button>
                    </form>
                    <form action="{{ route('admin.posts.edit', $post->id) }}" method="post">
                        @csrf
                        @method('GET')
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
