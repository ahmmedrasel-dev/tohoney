    @extends('frontend.frontend-master')
    @section('active_home')
        active
    @endsection
    @section('header_css')
        <style>
            .star-ratings-css {
                unicode-bidi: bidi-override;
                color: #a4a4a4;
                font-size: 20px;
                height: 25px;
                width: 100px;
                margin: 0 auto;
                position: relative;
                padding: 0;
                text-shadow: 0px 1px 0 #a2a2a2;
            }
            .star-ratings-css-top {
                color: #f71919;
                padding: 0;
                position: absolute;
                z-index: 1;
                display: block;
                top: 0;
                left: 0;
                overflow: hidden;
            }
            .star-ratings-css-bottom {
                padding: 0;
                display: block;
                z-index: 0;
            }
            .star-ratings-sprite {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                font-size: 0;
                height: 21px;
                line-height: 0;
                overflow: hidden;
                text-indent: -999em;
                width: 110px;
                margin: 0 auto;
            }
            .star-ratings-sprite-rating {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                background-position: 0 100%;
                float: left;
                height: 21px;
                display: block;
            }
        </style>
    @endsection
    @section('content')
        <!-- slider-area start -->
        <div class="slider-area">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide overlay">
                        <div class="single-slider slide-inner slide-inner1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-lg-9 col-12">
                                        <div class="slider-content">
                                            <div class="slider-shape">
                                                <h2 data-swiper-parallax="-500">Amazing Pure Nature Hohey</h2>
                                                <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                                <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner slide-inner7">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-lg-9 col-12">
                                        <div class="slider-content">
                                            <div class="slider-shape">
                                                <h2 data-swiper-parallax="-500">Amazing Pure Nature Coconut Oil</h2>
                                                <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                                <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner slide-inner8">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-lg-9 col-12">
                                        <div class="slider-content">
                                            <div class="slider-shape">
                                                <h2 data-swiper-parallax="-500">Amazing Pure Nut Oil</h2>
                                                <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                                <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- slider-area end -->
        <!-- featured-area start -->
        <div class="featured-area featured-area2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="featured-active2 owl-carousel next-prev-style">
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('front/assets/images/featured/6.jpg') }}" alt="">
                                    <div class="featured-content">
                                        <a href="shop.html">Pure Honey</a>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('front/assets/images/featured/7.jpg') }}" alt="">
                                    <div class="featured-content">
                                        <a href="shop.html">Mustard Oil</a>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('front/assets/images/featured/8.jpg') }}" alt="">
                                    <div class="featured-content">
                                        <a href="shop.html">Olive Oil</a>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('front/assets/images/featured/6.jpg') }}" alt="">
                                    <div class="featured-content">
                                        <a href="shop.html">Pure Honey</a>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('front/assets/images/featured/8.jpg') }}" alt="">
                                    <div class="featured-content">
                                        <a href="shop.html">Olive Oil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- featured-area end -->
        <!-- start count-down-section -->
        <div class="count-down-area count-down-area-sub">
            <section class="count-down-section section-padding parallax" data-speed="7">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 text-center">
                            <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                        </div>
                        <div class="col-12 col-lg-12 text-center">
                            <div class="count-down-clock text-center">
                                <div id="clock">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </section>
        </div>
        <!-- end count-down-section -->
        <!-- product-area start -->
        <div class="product-area product-area-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Best Selling Producs</h2>
                            <img src="{{ asset('front/assets/images/section-title.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <ul class="row">

                    @foreach ( $bestSellings as  $item)
                        @php
                            $review = App\Models\ProductReview::with('product')->where('product_id', $item->product_id)->get();
                        @endphp

                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                            <div class="product-wrap">
                                <div class="product-img">
                                    <span>Sale</span>
                                    <img src="{{ asset('images/'.$item->product->created_at->format('Y/m/').$item->product->id.'/'.$item->product->product_thumbnail) }}" alt="{{ $item->product->title }}">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <ul>
                                                <li><a href="{{ route('singleProduct', $item->product->slug ) }}"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#" class="wishlist_id" data-productid="{{ $item->product->id }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{ route('singleProduct', $item->product->slug ) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('singleProduct', $item->product->slug ) }}">{{ $item->product->title }}</a></h3>
                                    <p class="pull-left">${{ $item->product->product_price }}</p>
                                    <ul class="pull-right d-flex">
                                        <li class="star-ratings-sprite">
                                            <span style="width:@if ($review ->count() > 0) {{ $review->sum('ratting') / $review->count() * 20 }}@endif%" class="star-ratings-sprite-rating"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- product-area end -->
        <!-- product-area start -->
        <div class="product-area">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>{{ __('Our Latest Product') }}</h2>
                            <img src="{{ asset('front/assets/images/section-title.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <ul class="row">
                    @foreach ($latest_products as $latest_product)

                        @php
                            $review = App\Models\ProductReview::with('product')->where('product_id', $latest_product->id)->get();
                        @endphp

                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                            <div class="product-wrap">
                                <div class="product-img">
                                    <span>Sale</span>
                                    <img src="{{ asset('images/'.$latest_product->created_at->format('Y/m/').$latest_product->id.'/'.$latest_product->product_thumbnail) }}" alt="{{ $latest_product->title }}">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <ul>
                                                <li><a href="{{ route('singleProduct', $latest_product->slug ) }}"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#" class="wishlist_id" data-productid="{{ $latest_product->id }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{ route('singleProduct', $latest_product->slug ) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('singleProduct', $latest_product->slug ) }}">{{ $latest_product->title }}</a></h3>
                                    <p class="pull-left">${{ $latest_product->product_price }}</p>
                                    <ul class="pull-right d-flex">
                                        <li class="star-ratings-sprite">
                                            <span style="width:@if ($review ->count() > 0) {{ $review->sum('ratting') / $review->count() * 20 }}@endif%" class="star-ratings-sprite-rating"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- product-area end -->
        <!-- testmonial-area start -->
        <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="test-title text-center">
                            <h2>What Our client Says</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-12">
                        <div class="testmonial-active owl-carousel">
                            <div class="test-items test-items2">
                                <div class="test-content">
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                    <h2>Elizabeth Ayna</h2>
                                    <p>CEO of Woman Fedaration</p>
                                </div>
                                <div class="test-img2">
                                    <img src="assets/images/test/1.png" alt="">
                                </div>
                            </div>
                            <div class="test-items test-items2">
                                <div class="test-content">
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                    <h2>Elizabeth Ayna</h2>
                                    <p>CEO of Woman Fedaration</p>
                                </div>
                                <div class="test-img2">
                                    <img src="assets/images/test/1.png" alt="">
                                </div>
                            </div>
                            <div class="test-items test-items2">
                                <div class="test-content">
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                    <h2>Elizabeth Ayna</h2>
                                    <p>CEO of Woman Fedaration</p>
                                </div>
                                <div class="test-img2">
                                    <img src="assets/images/test/1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testmonial-area end -->
    @endsection
    @section('footer_js')
        <script>
            /*-----------------------
            cart-plus-minus-button
            -------------------------*/
            $(".qtybutton").on("click", function() {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find("input").val(newVal);
            });

            // Wishlist Ajax Resquest
            $('.wishlist_id').on('click',function(e){
                let productId = $(this).attr('data-productid');
                // alert(productId);
                $.ajax({
                    type: "GET",
                    url: "{{ url('add-product-wishlist') }}/"+productId,
                    datType: 'json',
                    success:function(data){
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        if($.isEmptyObject(data.error)){
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            })
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            })
                        }
                    }
                })
                e.preventDefault();
            })
        </script>
    @endsection

