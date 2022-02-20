@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>
        <a href="{{ route('admin.tags.create') }}">Create new</a>
    </p>
    @foreach($tags as $tag)
        <div class="alert alert-primary">
            <div class="d-flex justify-content-between">
                <div class="fw-bold">
                    <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a>
                </div>
                <div>
                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <a href="{{ route('admin.tags.edit', $tag->id) }}">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
