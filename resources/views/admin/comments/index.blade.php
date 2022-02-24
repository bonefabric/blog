@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <div class="mt-3">
        @foreach($comments as $comment)
            <div class="alert alert-primary">
                <div class="d-flex justify-content-between">
                    <div class="fw-bold">
                        <span>{{ $comment->reviewed ? ' [REVIEWED]' : '' }}</span>
                        <a href="{{ route('admin.comments.show', $comment->id) }}">{{ $comment->comment }}</a>
                    </div>
                    <div class="d-flex">
                        @if($comment->deleted_at)
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post" class="me-3">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="permanently" value="1">
                                <button class="btn btn-primary" type="submit">Delete permanently</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post" class="me-3">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-primary"
                                    type="submit">{{ $comment->deleted_at ? 'Restore' : 'Delete' }}</button>
                        </form>
                        @if(!$comment->reviewed)
                            <form action="{{ route('admin.comments.review', $comment->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-primary" type="submit">Review</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
