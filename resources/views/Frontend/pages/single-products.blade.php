@extends('frontend.frontend-master')
@section('title'){{ $singleProducts->title }}@endsection
@section('meta_desc'){{ Str::limit($singleProducts->summary, '160') }}@endsection
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
        <!-- single-product-area start-->
        <div class="single-product-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-single-img">
                            <div class="product-active owl-carousel">
                                <div class="item">
                                    <img src="{{ asset('images/'.$singleProducts->created_at->format('Y/m/').$singleProducts->id.'/'.$singleProducts->product_thumbnail) }}" alt="{{ $singleProducts->title }}">
                                </div>
                                @foreach ($singleProducts->ProductGallery as $proGalActive)
                                    <div class="item">
                                        <img src="{{ asset('images/product-gallery/'.$proGalActive->created_at->format('Y/m/').$proGalActive->product_id.'/'.$proGalActive->image_name) }}" alt="{{ $singleProducts->title }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-thumbnil-active  owl-carousel">
                                <div class="item">
                                    <img src="{{ asset('images/'.$singleProducts->created_at->format('Y/m/').$singleProducts->id.'/'.$singleProducts->product_thumbnail) }}" alt="{{ $singleProducts->title }}">
                                </div>
                                @foreach ($singleProducts->ProductGallery as $proThumbActive)
                                    <div class="item">
                                        <img src="{{ asset('images/product-gallery/'.$proThumbActive->created_at->format('Y/m/').$proThumbActive->product_id.'/'.$proThumbActive->image_name) }}" alt="{{ $singleProducts->title }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-single-content">
                            <h3>{{ $singleProducts->title }}</h3>
                            <div class="rating-wrap fix">
                                <span class="pull-left priceOfSize"><span>Product Price: </span>${{ $singleProducts->product_price }}</span>
                                <ul class="rating pull-right">
                                    <li class="star-ratings-sprite">
                                        <span style="width: @if ($reviews->count() > 0) {{ $reviews->sum('ratting') / $reviews->count() * 20 }}@endif%" class="star-ratings-sprite-rating"></span>
                                    </li>
                                    <li>(@if ($reviews->count() > 0) {{ $reviews->sum('ratting') / $reviews->count() }}@else{{ 'No' }}@endif)</li>
                                </ul>
                            </div>
                            <p>{{ $singleProducts->summary }}</p>

                            <form action="{{ route('productCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $singleProducts->id }}">
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li><a href="#">{{ $singleProducts->category->category_name }}</a></li>
                                </ul>

                                {{-- Product Color Variation --}}
                                <div class="form-group">
                                    <label for="color">Select Color: </label>
                                    <select class="form-control color_id" name="color" id="color">
                                        <option value="">Select Color</option>
                                        @foreach ( $groupByColor as $data)
                                        <option data-product="{{ $data[0]->product_id }}" value="{{ $data[0]->color_id }}">{{ $data[0]->Color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Product Size Variation --}}
                                <div class="form-group">
                                    <label for="size">Product Size:</label>
                                    <select name="size" id="size" class="form-control @error('size') is-invalid @enderror">
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

                                {{-- Total Abailable Quantity --}}
                                <div class="available-quantity">
                                        <span class="availableQuantity text-success">{{ 'Total Available Quanity: '.$singleProducts->ProductAttribute->sum('quantity') }}</span>
                                </div>

                                <ul class="input-style mt-3">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" name="quantity" value="1" />
                                        <div class="dec qtybutton qtyMinus">-</div>
                                        <div class="inc qtybutton qtyPlus">+</div>
                                    </li>
                                    <li><button type="submit" class="btn btn-success ml-4">Add to Cart</button></li>
                                </ul>
                            </form>

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
                <div class="row mt-60">
                    <div class="col-12">
                        <div class="single-product-menu">
                            <ul class="nav">
                                <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                                <li><a data-toggle="tab" href="#tag">Faq</a></li>
                                <li><a data-toggle="tab" href="#review">Review</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="description">
                                <div class="description-wrap">
                                    <p>{{ $singleProducts->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tag">
                                <div class="faq-wrap" id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingfour">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                        </div>
                                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingfive">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                        </div>
                                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="review">
                                <div class="review-wrap">
                                    <ul>
                                        @forelse ( $reviews as $review )
                                            <li class="review-items">
                                                <div class="review-img">
                                                    <img src="assets/images/comment/1.png" alt="">
                                                </div>
                                                <div class="review-content">
                                                    <h3><a href="#">{{ $review->name }}</a></h3>
                                                    <span>{{ $review->created_at }}</span>
                                                    <p>{{ $review->review }}</p>
                                                    <ul class="rating pull-right">
                                                        <li class="star-ratings-sprite">
                                                            <span style="width:{{ $review->ratting * 20 }}%" class="star-ratings-sprite-rating"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        @empty
                                            <h3>The Product has no review Available.</h3>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="add-review">
                                    @auth()
                                        @if ($rattings > 0 )
                                            <h3>You Already submited review and rattings.</h3>
                                        @else
                                            <form action="{{ route('productReview') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $singleProducts->id }}">
                                                <h4>Add A Review</h4>

                                                <div class="ratting-wrap">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>task</th>
                                                                <th>1 Star</th>
                                                                <th>2 Star</th>
                                                                <th>3 Star</th>
                                                                <th>4 Star</th>
                                                                <th>5 Star</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>How Many Stars?</td>
                                                                <td>
                                                                    <input type="radio" value="1" name="ratting" />
                                                                </td>
                                                                <td>
                                                                    <input type="radio" value="2" name="ratting" />
                                                                </td>
                                                                <td>
                                                                    <input type="radio" value="3" name="ratting" />
                                                                </td>
                                                                <td>
                                                                    <input type="radio" value="4" name="ratting" />
                                                                </td>
                                                                <td>
                                                                    <input type="radio" value="5" name="ratting" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <h4>Name:</h4>
                                                        <input type="text" name="review_provider_name" value="{{ Auth::user()->name }}" />
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <h4>Email:</h4>
                                                        <input type="email" name="review_provider_email" value="{{ Auth::user()->email }}" />
                                                    </div>
                                                    <div class="col-12">
                                                        <h4>Your Review:</h4>
                                                        <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn-style">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{ route('productReview') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $singleProducts->id }}">
                                            <h4>Add A Review</h4>

                                            <div class="ratting-wrap">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>task</th>
                                                            <th>1 Star</th>
                                                            <th>2 Star</th>
                                                            <th>3 Star</th>
                                                            <th>4 Star</th>
                                                            <th>5 Star</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>How Many Stars?</td>
                                                            <td>
                                                                <input type="radio" value="1" name="ratting" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" value="2" name="ratting" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" value="3" name="ratting" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" value="4" name="ratting" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" value="5" name="ratting" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <h4>Name:</h4>
                                                    <input type="text" name="review_provider_name" placeholder="Your name here..." />
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <h4>Email:</h4>
                                                    <input type="email" name="review_provider_email" placeholder="Your Email here..." />
                                                </div>
                                                <div class="col-12">
                                                    <h4>Your Review:</h4>
                                                    <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn-style">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single-product-area end-->
        <!-- featured-product-area start -->
        <div class="featured-product-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-left">
                            <h2>Related Product</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ( $relatedProduct as $product )
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="featured-product-wrap">
                                <div class="featured-product-img">
                                    <img src="{{ asset('images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->product_thumbnail) }}" alt="">
                                </div>
                                <div class="featured-product-content">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3><a href="{{ route('singleProduct', $product->slug ) }}">{{ $product->title }}</a></h3>
                                            <p>${{ $product->product_price }}</p>
                                        </div>
                                        <div class="col-5 text-right">
                                            <ul>
                                                <li><a href="{{ route('singleProduct', $product->slug ) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                <li><a href="#" class="wishlist_id" data-productid="{{ $product->id }}"><i class="fa fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- featured-product-area end -->
@endsection
@section('footer_js')
        <script>
            // Show The Size According to Product color and Size.
            $('.color_id').change(function(){
                let colorId = $(this).val();
                let productId = $(this).find(':selected').attr('data-product');
                $.ajax({
                    type: "GET",
                    url: "{{ url('get-product-size') }}/"+ colorId + "/" + productId,
                    success:function(result){
                        if(result){
                            $('#size').html('<option value="">Select Size</option>');
                            $("#size").append(result);
                            $('#size').change(function(){
                                let dataPrice = $(this).find(':selected').attr('data-price');
                                let dataQyantity = $(this).find(':selected').attr('data-quantity');
                                // alert(dataPrice);
                                $(".priceOfSize").html('$' + dataPrice);
                                $(".availableQuantity").html('Total Available Quanity: ' + dataQyantity);
                            })
                        }else{
                            $('#size').empty();
                        }
                    }
                })
            })

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

