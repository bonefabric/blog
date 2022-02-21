@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <form action="{{ route('admin.tags.create') }}" method="post" class="mt-3 mb-3">
        @csrf
        @method('GET')
        <button class="btn btn-primary" type="submit">Create new</button>
    </form>
    @foreach($tags as $tag)
        <div class="alert alert-primary">
            <div class="d-flex justify-content-between">
                <div class="fw-bold">
                    <span>{{ $tag->deleted_at ? ' [DELETED]' : '' }}</span>
                    <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a>
                </div>
                <div class="d-flex">
                    @if($tag->deleted_at)
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" class="me-3">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="permanently" value="1">
                            <button class="btn btn-primary" type="submit">Delete permanently</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" class="me-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary"
                                type="submit">{{ $tag->deleted_at ? 'Restore' : 'Delete' }}</button>
                    </form>
                    <form action="{{ route('admin.tags.edit', $tag->id) }}" method="post">
                        @csrf
                        @method('GET')
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
