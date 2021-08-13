@extends('Frontend.frontend-master')
@section('title')
    {{ __('Tonmoy-login') }}
@endsection
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Account</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><span>Login</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <!-- checkout-area start -->
        <div class="account-area ptb-100">
            <div class="container">
                {{-- Validation Message --}}

                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                        <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                        <form method="POST" action="{{ route('loginCheck') }}">
                            @csrf
                            <div class="account-form form-style">
                                <label for="email">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="jonh@domainname.com">
                                <label for="password">Password *</label>
                                <input type="Password" id="password" name="password" placeholder="Enter your password">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input id="remember" type="checkbox" name="remember">
                                        <label for="remember">{{ __('Save Password') }}</label>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <a href="#">Forget Your Password?</a>
                                    </div>
                                </div>
                                <button type="submit">SIGN IN</button>
                                <div class="text-center">
                                    <a href="{{ route('userRegister') }}">Or Creat an Account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
@endsection
