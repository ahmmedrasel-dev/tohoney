<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Welcome to tonmoy E-commerce')</title>
    <meta name="description" content="@yield('meta_desc', 'Meta Description Goes to Here')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Ajax Request Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/font-awesome.min.css') }}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/jquery-ui.css') }}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/metisMenu.min.css') }}">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/swiper.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/styles.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('front/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    @yield('header_css')
</head>

<body>
    <!--Start Preloader-->
    {{-- <div class="preloader-wrap">
        <div class="spinner"></div>
    </div> --}}
    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="#">
                            <input type="text" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                            <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li>
                                        @auth
                                            <a href="{{ route('dashboard') }}">{{ Str::words(Auth::user()->name, 1) }}</a>
                                            <li><a href="{{ route('myAccount') }}">My Account</a></li>
                                        @else
                                            <a href="{{ route('userLogin') }}">Register/Login</a>
                                        @endauth
                                    </li>
                                    <li><a href="{{ route('cart') }}">Cart</a></li>
                                    <li><a href="{{ route('checkout') }}">Checkout</a></li>
                                    <li><a href="{{ route('wishlist') }}">wishlist</a></li>
                                    @auth
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('login-form').submit();">
                                        <span>{{ __('Logout') }}</span>
                                        </a>
                                        <form action="{{ route('logout') }}" id="login-form" method="POST" style="display:none">
                                            @csrf
                                        </form>
                                    </li>
                                    @endauth

                                </ul>
                            </li>
                            {{-- <li>
                                @auth
                                    <a href="{{ route('frontend') }}">{{ Auth::user()->name }}</a>
                                @else
                                    <a href="{{ route('login') }}"> Login </a>
                                @endauth
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{ route("frontend") }}">
                        <img src="{{ asset('front/assets/images/logo.png') }}" alt="logo">
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="@yield('active_home')"><a href="{{ route('frontend') }}">Home</a></li>
                                <li class="@yield('active_about')"><a href="{{ route('about') }}">About</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li class="@yield('active_cart')"><a href="{{ route('cart') }}">Cart</a></li>
                                <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                <li>
                                    <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="{{ route('shop') }}">Shop Page</a></li>
                                        <li><a href="{{ route('cart') }}">Shopping cart</a></li>
                                        <li><a href="{{ route('cart') }}">Checkout</a></li>
                                    </ul>
                                </li>
                                <li class="@yield('active_blog')">
                                    <a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="{{ route('blogs') }}">blogs</a></li>
                                    </ul>
                                </li>
                                <li class="@yield('active_contact')"><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            @php
                               $wishlistTotal = App\Models\Wishlist::where('user_id', Auth::id())->count();
                            @endphp
                            <li>
                                <a href="{{ route('wishlist') }}"><i class="flaticon-like"></i> <span>{{ $wishlistTotal }}</span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{ cart()->count() }}</span></a>
                                @php
                                    $subTotal = 0;
                                @endphp

                                <style>
                                    .cart-wrap li a.ck_button {
                                        width: 100%;
                                        line-height: 35px;
                                        background: #fff;
                                        text-transform: uppercase;
                                        border: none;
                                        text-align: center;
                                        color: #333;
                                        margin-top: 25px;
                                    }

                                    .cart-wrap li a.ck_button:hover{
                                        background: red;
                                        color: #fff;
                                    }

                                </style>

                                <ul class="cart-wrap dropdown_style">
                                    @foreach (cart() as $carts)
                                        @php
                                            $cartValues = App\Models\ProductAttribute::with(['Color', 'Size', 'Product'])->where('product_id', $carts->product_id)->where('color_id', $carts->color_id)->where('size_id', $carts->size_id)->first();
                                        @endphp

                                        <li class="cart-items">
                                            <div class="cart-img">
                                                <img width="50px" src="{{ asset('images/'. $cartValues->Product->created_at->format('Y/m/').$cartValues->product_id ).'/'.$cartValues->Product->product_thumbnail }}" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <a href="{{ route('singleProduct', $carts->Product->slug ) }}">{{ $carts->Product->title }}</a>
                                                <span>QTY : {{ $carts->quantity }}</span>
                                                <p>${{ $cartValues->price }}</p>
                                                <a href="{{ route('cartDelet', $carts->id ) }}"><i class="fa fa-times"></i></a>

                                            </div>
                                        </li>
                                        @php
                                            $subTotal += $carts->quantity *  $cartValues->price;
                                        @endphp
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">${{ $subTotal }}</span></li>
                                    <li>
                                        <a class="ck_button" href="{{ route('cart') }}">Check Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{ route('frontend') }}">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('shop') }}">Shop Page</a></li>
                                        <li><a href="{{ route('cart') }}">Shopping cart</a></li>
                                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                    </ul>
                                </li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                    <ul aria-expanded="false">
                                      <li><a href="#">About Page</a></li>
                                      <li><a href="{{ route('cart') }}">Shopping cart</a></li>
                                      <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                      <li><a href="faq.html">FAQ</a></li>
                                    </ul>
                                </li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blogs</a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                                    </ul>
                                </li>
                                <li><a href="#l">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
    @yield('content')
    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="{{ route('frontend') }}">home</a></li>
                                    <li><a href="#">our story</a></li>
                                    <li><a href="#">feed shop</a></li>
                                    <li><a href="#">how to eat blog</a></li>
                                    <li><a href="#">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure righteous indignation and dislike</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                                <li><a href="#"><span>Email:</span> domain@gmail.com</a></li>
                                <li><a href="#"><span>Tel:</span> 0131234567</a></li>
                                <li><a href="#"><span>Adress:</span> 52 Web Bangale , Adress line2 , ip:3105</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © 2019 Tohoney All rights reserved.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('front/assets/js/vendor/jquery-2.2.4.min.js ') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('front/assets/js/bootstrap.min.js ') }}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('front/assets/js/owl.carousel.min.js ') }}"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('front/assets/js/scrollup.js ') }}"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{ asset('front/assets/js/isotope.pkgd.min.js ') }}"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{ asset('front/assets/js/imagesloaded.pkgd.min.js ') }}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('front/assets/js/jquery.zoom.min.js ') }}"></script>
    <!-- countdown.js -->
    <script src="{{ asset('front/assets/js/countdown.js ') }}"></script>
    <!-- swiper.min.js -->
    <script src="{{ asset('front/assets/js/swiper.min.js ') }}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('front/assets/js/metisMenu.min.js ') }}"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('front/assets/js/mailchimp.js ') }}"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('front/assets/js/jquery-ui.min.js ') }}"></script>
    <!-- main js -->
    <script src="{{ asset('front/assets/js/scripts.js ') }}"></script>
    {{-- Link For Sweet Alert --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @yield('footer_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (Session::has('message'));
        var type =  "{{ Session::get('alert-type', 'info') }}"
        switch(type){
                case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

                case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
        }
        @endif
    </script>
    @include('sweetalert::alert')
</body>
</html>
