<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin-top: 200px;
        margin-left: 50%;
        transform: translateX(-50%);
    }
</style>
<body>
<form action="{{ url('/login') }}" method="post">
    @csrf
    <input type="email" name="email" placeholder="E-mail"/>
    <input type="password" name="password" placeholder="Password"/>
    <label>
        Remember:
        <input type="checkbox" name="remember">
    </label>
    <input type="submit">

    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</form>

</body>
</html>
