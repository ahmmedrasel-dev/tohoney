@extends('Frontend.frontend-master')
@section('title')
    {{ __('Tonmoy-register') }}
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
                            <li><a href="{{ route('frontend') }}">Home</a></li>
                            <li><span>Register</span></li>
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
            <form action="{{ route('createUser') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                        <div class="account-form form-style">

                            <p class="text-danger">@error('name') {{ $message }}@enderror</p>
                            <label for="name">Full Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Rasel Ahmmed">

                            <p class="text-danger">@error('email') {{ $message }}@enderror</p>
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="jonh@gmail.com">

                            <p class="text-danger">@error('password') {{ $message }}@enderror</p>
                            <label for="password">Password *</label>
                            <input type="Password" name="password" id="password" placeholder="Enter your password">

                            <p class="text-danger">@error('phone') {{ $message }}@enderror</p>
                            <label for="phone">Phone Number *</label>
                            <input type="tell" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+880 1676176820">

                            <button type="submit">Register</button>
                            <div class="text-center">
                                <a href="{{ route('userLogin') }}">Or Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
