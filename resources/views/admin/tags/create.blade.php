@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p>Create new tag</p>
    <form action="{{ route('admin.tags.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    {{ $errors }}
@endsection
