@extends('admin.templates.main')

@section('header')
    @include('admin.templates.header')
@endsection

@section('body')
    <table class="table table-primary table-hover mt-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Banned</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->banned ? 'yes' : 'no' }}</td>
                <td>
                    <form action="{{ route('admin.users.ban', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ban" value="{{ $user->banned }}">
                        <button class="btn btn-primary" type="submit">{{ $user->banned ? 'Unban' : 'Ban' }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
