@extends('templates.main')

@section('header')
    @include('templates.header')
@endsection

@section('body')
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <form action="{{ url('/register') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password">
                </div>
                <div class="mb-3">
                    <label for="inputPasswordConfirmation" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
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
