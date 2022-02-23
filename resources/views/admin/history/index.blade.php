@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <p class="fw-bold pt-2">History</p>
    <table class="table table-primary table-hover mt-3">
        <thead>
        <tr>
            <th scope="col">Note</th>
            <th scope="col">Author</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr>
                <td>{{ $note->note }}</td>
                <td>{{ $note->user ? $note->user->name : '' }}</td>
                <td>{{ $note->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
