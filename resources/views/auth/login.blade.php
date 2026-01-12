@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="min-height: 100vh; padding: 100px 0; background: url('{{ asset('images/img/pimg.jpg') }}') center center / cover no-repeat fixed;">
    <div class="pen-title"></div>
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form">
            <h2>Login to your account</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus />
                <input type="password" placeholder="Password" name="password" required />
                <input type="submit" id="buttn" name="submit" value="Login" />
            </form>
        </div>
        @unless(request()->is('admin/*'))
        <div class="cta">Not registered? <a href="{{ route('register') }}" style="color:#5c4ac7;">Create an account</a></div>
        @endunless
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<style type="text/css">
#buttn {
    color: #fff;
    background-color: #5c4ac7;
}
</style>
@endpush
@endsection

