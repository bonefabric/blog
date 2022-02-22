@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    <p class="fw-bold pt-2">Add comment to {{ $source }}</p>
    <form action="{{ route('blog.comments.store', ['source' => $source, 'id' => $id]) }}" method="post">
        @csrf
        <textarea class="form-control mb-2 mt-2" aria-label="Comment" name="comment"></textarea>
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
