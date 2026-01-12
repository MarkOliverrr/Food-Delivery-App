@extends('layouts.app')

@section('title', 'Registration')

@section('content')
<div style="background-image: url('{{ asset('images/img/pimg.jpg') }}'); min-height: 100vh;">
    <div class="page-wrapper">
        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul style="margin:0; padding-left:18px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="username">User-Name</label>
                                            <input class="form-control" type="text" name="username" id="username" value="{{ old('username') }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="firstname">First Name</label>
                                            <input class="form-control" type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="lastname">Last Name</label>
                                            <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="phone">Phone number</label>
                                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password_confirmation">Confirm password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="address">Delivery Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p><input type="submit" value="Register" name="submit" class="btn theme-btn"></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

