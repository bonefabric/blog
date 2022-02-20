@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>Edit tag</p>
    <form action="{{ route('admin.tags.update', $tag->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @if($errors->any())
        {{ $errors }}
    @endif
@endsection
