@extends('frontend.frontend-master')
@section('title')
{{ __('Shop Page') }}
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
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{ route('frontend') }}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($categories as $catItems)
                                <li class="mb-2">
                                    <a data-toggle="tab" href="#chair{{ $catItems->id }}">{{ $catItems->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($products as $productsItem)
                            @php
                                $review = App\Models\ProductReview::with('product')->where('product_id', $productsItem->id)->get();
                            @endphp
                            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <span>Sale</span>
                                        <img src="{{ asset('images/'.$productsItem->created_at->format('Y/m/').$productsItem->id.'/'.$productsItem->product_thumbnail ) }}" alt="{{ $productsItem->title }}">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                <ul>
                                                    <li><a href="{{ route('singleProduct', $productsItem->slug ) }}"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" class="wishlist_id" data-productid="{{ $productsItem->id }}"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{ route('singleProduct', $productsItem->slug ) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('singleProduct', $productsItem->slug ) }}">{{ Str::limit($productsItem->title, 24) }}</a></h3>
                                        <p class="pull-left">${{ $productsItem->product_price }}</p>
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
                @foreach ($categories as $catItems)
                    <div class="tab-pane" id="chair{{ $catItems->id }}">
                        <ul class="row">
                            @foreach ($catItems->Product as $pitem)
                                @php
                                    $review = App\Models\ProductReview::with('product')->where('product_id', $pitem->id)->get();
                                @endphp
                                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <div class="product-wrap">
                                        <div class="product-img">
                                            <span>Sale</span>
                                            <img src="{{ asset('images/'.$pitem->created_at->format('Y/m/').$pitem->id.'/'.$pitem->product_thumbnail ) }}" alt="{{ $pitem->title }}">
                                            <div class="product-icon flex-style">
                                                <ul>
                                                    <li><a href="{{ route('singleProduct', $pitem->slug ) }}"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" class="wishlist_id" data-productid="{{ $pitem->id }}"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{ route('singleProduct', $pitem->slug ) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{ route('singleProduct', $pitem->slug) }}">{{ Str::limit($productsItem->title, 24) }}</a></h3>
                                            <p class="pull-left">${{ $pitem->product_price }}</p>
                                            <ul class="pull-right d-flex">
                                                <li class="star-ratings-sprite">
                                                    <span style="width:@if ($review ->count() > 0) {{ $review->sum('ratting') / $review->count() * 20 }}@endif%" class="star-ratings-sprite-rating"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <!-- Modal area start -->
                                {{-- <div class="modal fade" id="exampleModalCenter{{ $pitem->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-body d-flex">
                                                <div class="product-single-img w-50">
                                                    <img src="{{ asset('images/'.$pitem->created_at->format('Y/m/').$pitem->id.'/'.$pitem->product_thumbnail) }}" alt="{{ $pitem->title }}">
                                                </div>
                                                <div class="product-single-content w-50">
                                            <h3>{{ $pitem->title }}</h3>
                                                    <div class="rating-wrap fix">
                                                        <span class="pull-left priceOfSize">${{ $pitem->product_price }}</span>
                                                        <ul class="rating pull-right">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li>(05 Customar Review)</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $pitem->summary }}</p>

                                                    <form action="{{ route('singleProduct', $pitem->slug ) }}" method="get">
                                                        @csrf
                                                        <input type="text" name="product_id" value="{{ $pitem->id }}">
                                                        Color Group By Color_id
                                                        <ul class="color">
                                                            @php
                                                                $productAttri = App\Models\ProductAttribute::with(['Color'])->where('product_id', $pitem->id)->get();
                                                                $collect = collect($productAttri);
                                                                $groupByColor = $collect->groupBy('color_id');
                                                            @endphp
                                                        </ul>

                                                        Product Color Variation
                                                        <div class="form-group">
                                                            <label for="color">Select Color: </label>
                                                            <select class="form-control" name="color" id="color">
                                                                <option value="">Select Color</option>
                                                                @foreach ( $groupByColor as $data)
                                                                <option data-product="{{ $data[0]->product_id }}" value="{{ $data[0]->color_id }}">{{ $data[0]->Color->color_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                         Product Size Variation
                                                        <div class="form-group">
                                                            <label for="size">Product Size:</label>
                                                            <select name="size" id="size" class="form-control size @error('size') is-invalid @enderror">
                                                            </select>
                                                            @error('size')
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <ul class="availablequantity">
                                                            <li>
                                                                <span class="availableQuantity text-success">{{ 'Total Available Quanity: '.$pitem->ProductAttribute->sum('quantity') }}</span>
                                                            </li>
                                                        </ul>

                                                        <ul class="input-style">
                                                            <li class="quantity cart-plus-minus">
                                                                <input type="text" name="quantity" value="1" />
                                                                <div class="dec qtybutton qtyMinus">-</div>
                                                                <div class="inc qtybutton qtyPlus">+</div>
                                                            </li>
                                                            <li><input class="btn btn-danger" type="submit" value="Add to Cart"></li>
                                                        </ul>

                                                    </form>
                                                    <ul class="cetagory">
                                                        <li>Categories:</li>
                                                        <li><a href="#">{{ $pitem->Category->category_name }}</a></li>
                                                        <li><a href="#">{{ $pitem->SubCategory->subcategory_name ?? '' }}</a></li>
                                                    </ul>
                                                    <ul class="socil-icon">
                                                        <li>Share :</li>
                                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- Modal area start -->
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
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
