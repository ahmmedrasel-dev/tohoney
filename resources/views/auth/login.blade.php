@extends('auth.master')
@section('title')
{{ __('Login tonmoy E-commerce') }}
@endsection
@section('content')
<div class="account-box">
    <div class="account-logo-box">
        <h2 class="text-uppercase text-center">
            <a href="index.html" class="text-success">
                <span><img src="" alt="Tonmmoy Ecom" height="30"></span>
            </a>
        </h2>
        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
        <p class="m-b-0">Login to your account</p>
    </div>
    <div class="account-content">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group m-b-20 row">
                <div class="col-12">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="john@deo.com" value="{{ old('email') }}" autofocus>
                </div>
            </div>

            <div class="form-group row m-b-20">
                <div class="col-12">
                    <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                </div>
            </div>

            <div class="form-group row m-b-20">
                <div class="col-12">

                    <div class="checkbox checkbox-success">
                        <input id="remember" type="checkbox" name="remember">
                        <label for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group row text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                </div>
            </div>

        </form>

        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                        <i class="fa fa-facebook"></i>
                    </button>
                    <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                        <i class="fa fa-google"></i>
                    </button>
                    <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                        <i class="fa fa-twitter"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row m-t-50">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-dark m-l-5"><b>Sign Up</b></a></p>
            </div>
        </div>

    </div>
</div>
@endsection
