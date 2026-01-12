<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
</head>
<body>
    <div class="admin-login-page">
        <div class="form">
            <h1 class="form-title">Admin Login</h1>
            <div class="thumbnail"><img src="{{ asset('admin/images/manager.png') }}" /></div>
            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif
            <form class="login-form" action="{{ route('admin.login') }}" method="post">
                @csrf
                <input type="text" placeholder="Username or Email" name="username" value="{{ old('username') }}" required autofocus />
                <input type="password" placeholder="Password" name="password" required />
                <input type="submit" name="submit" value="Login" />
            </form>
        </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('admin/js/index.js') }}"></script>
</body>
</html>

