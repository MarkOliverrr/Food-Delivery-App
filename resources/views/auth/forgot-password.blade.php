@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div style="min-height: 100vh; padding: 100px 0; background: url('{{ asset('images/img/pimg.jpg') }}') center center / cover no-repeat fixed;">
    <div class="pen-title"></div>
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form">
            <h2>Forgot Password</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Enter your email address and we'll send you a password reset code.</p>
            
            @if(session('status'))
                <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                    {{ session('status') }}
                </div>
            @endif
            
            @if($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <input type="email" placeholder="Enter your email address" name="email" value="{{ old('email') }}" required autofocus />
                <input type="submit" id="buttn" name="submit" value="Send Reset Code" />
            </form>
        </div>
        <div class="cta">
            <a href="{{ route('login') }}" style="color:#5c4ac7;">Back to Login</a>
        </div>
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

