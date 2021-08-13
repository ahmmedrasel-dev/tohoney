@extends('Frontend.frontend-master')
@section('title')
{{ __('Shopping Cart Page') }}
@endsection
@section('active_cart')
    active
@endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="{{ route('frontend') }}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('cartUpdate') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="product">Color</th>
                                    <th class="product">Size</th>
                                    <th class="ptice px-3">Price</th>
                                    <th class="quantity px-3">Quantity</th>
                                    <th class="total px-3">Total</th>
                                    <th class="remove px-3">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $item)
                                    @php
                                        $cartValues = App\Models\ProductAttribute::where('product_id', $item->product_id)->where('color_id', $item->color_id)->where('size_id', $item->size_id)->first();
                                    @endphp
                                        <input type="hidden" name="cart_id[]" value="{{ $item->id }}" />
                                        <tr>
                                            <td class="images"><img src="{{ asset('images/'. $item->Product->created_at->format('Y/m/').$item->product_id ).'/'.$item->Product->product_thumbnail }}" alt=""></td>
                                            
                                            {{-- Cart Product Tile --}}
                                            <td class="product"><a href="{{ route('singleProduct', $item->Product->slug ) }}">{{ $item->Product->title }}</a></td>

                                            {{-- Cart Seleted Color --}}
                                            <td class="color">@isset($item->Color) {{
                                            $item->Color->color_name }} @else Not Yet @endisset</td>

                                            {{-- Cart Seleted Size --}}
                                            <td class="color">@isset($item->Size){{  $item->Size->size }}@else Not Yet @endisset </td>

                                            {{-- Cart Price --}}
                                            <td class="ptice unitePrice{{ $item->id }}" data-unitPrice{{ $item->id }}="{{ $cartValues->price }}">${{ $cartValues->price }}</td>

                                            {{-- Cart Quantity --}}
                                            <td class="quantity cart-plus-minus">
                                                <input type="text" class="uniteQty{{ $item->id }}" name="quantity[]" value="{{ $item->quantity }}" />
                                                <div class="dec qtybutton qtyMinus{{ $item->id  }}">-</div>
                                                <div class="inc qtybutton qtyPlus{{ $item->id }}">+</div>
                                            </td>

                                            {{-- Single Product Total Price accourding to quantity --}}
                                            <td class="total">$<span class="selectAll totalUnitPrice{{ $item->id }}">{{ $cartValues->price * $item->quantity }}</span></td>

                                            <td class="remove px-3"><a href="{{ route('cartDelet', $item->id ) }}"><i class="fa fa-times"></i></a></td>

                                            {{-- Sub Total Calculation Code --}}
                                            @php
                                                $total += ($cartValues->price * $item->quantity)
                                            @endphp
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{ route('shop') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>

                                    {{-- Apply Coupon Button Style --}}
                                    <style>
                                        .cupon-wrap span {
                                            width: 150px;
                                            line-height: 45px;
                                            position: absolute;
                                            right: 0;
                                            top: 0;
                                            background: #ef4836;
                                            color: #fff;
                                            text-transform: uppercase;
                                            border: none;
                                            text-align: center;
                                            cursor: pointer;
                                        }
                                    </style>

                                    <div class="cupon-wrap">
                                        <input type="text" id="coupon" name="coupon" value="{{ $coupon ?? old('coupon') }}" placeholder="Cupon Code">
                                        <span id="coupon_code">Apply Cupon</span>
                                    </div>
                                    {{-- Alart Message For Coupon --}}
                                    @if (session('message'))
                                        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                            <strong>{{ session('message') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal</span><span class="subtotalPrice">${{ $total }}.00</span></li>
                                        @isset($discountType)
                                            <li>
                                                @if ($minAmount <= $total)
                                                    <span class="pull-left">Discount({{ $discountType == 1 ? '$': '%' }})</span>
                                                    <span class="subtotalPrice">{{ $discountType == 1 ? '$': '%' }}{{ $discountAmount ?? '' }}.00</span></li>
                                                @else
                                                {{-- Minimum Amount Order Jodi na theke tahole nicher Part Show korbe --}}
                                                <span class="pull-left">For Coupon Need </span>
                                                <span class="subtotalPrice">${{ $minAmount - $total }}.00</span></li>
                                                @endif
                                        @endisset
                                        <li>
                                            <span class="pull-left"> Total </span>
                                            {{-- Discount Type Persentage Or Ammount --}}
                                            @if ($discountType == 1)
                                            {{-- Order Amount Minimum Amount er basi hole Discount Apply hobe Fiexd Price a. --}}
                                                @if ($minAmount <= $total)
                                                    ${{ $total - $discountAmount }}
                                                @else
                                                    ${{ $total }}
                                                @endif
                                            @else
                                                {{-- Order Amount Minimum Amount er basi hole Discount Apply hobe Percentage a . --}}
                                                @if ($minAmount <= $total)
                                                ${{ $total - $total * ($discountAmount / 100) }}
                                                @else
                                                ${{ $total }}
                                                @endif
                                            @endif
                                        </li>
                                    </ul>
                                    <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection
@section('footer_js')
    <script>

        $('.alert-dismissible').fadeOut(5000);
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

        //Cart Plus-minus Instant Calculation
        @foreach ( $carts as $item )
            // Cart Minus Instant Calculation.
            $('.qtyMinus{{ $item->id  }}').click(function(){
                let uniteQty = $('.uniteQty{{ $item->id }}').val();
                let unitePrice = $('.unitePrice{{ $item->id }}').attr('data-unitPrice{{ $item->id }}');
                $('.totalUnitPrice{{ $item->id }}').html(uniteQty*unitePrice);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('cart/update/ajax') }}",
                    method: 'POST',
                    data: {
                        id: '{{ $item->id }}',
                        qty: uniteQty,
                    }
                });

                let data = document.querySelectorAll('.selectAll');
                // Sub Total Calculation Instant JS CODE
                let arryData = Array.from(data);
                let sumData = 0;
                // looping arryData
                arryData.map(item=>{
                    sumData += parseInt(item.innerHTML);
                    $('.subtotalPrice').html('$'+sumData);
                })

            })
            // Cart Plus Instant Calculation.
            $('.qtyPlus{{ $item->id  }}').click(function(){
                let uniteQty = $('.uniteQty{{ $item->id }}').val();
                let unitePrice = $('.unitePrice{{ $item->id }}').attr('data-unitPrice{{ $item->id }}');

                $('.totalUnitPrice{{ $item->id }}').html(uniteQty*unitePrice);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('cart/update/ajax') }}",
                    method: 'POST',
                    data: {
                        id: '{{ $item->id }}',
                        qty: uniteQty,
                    }
                });

                // Sub Total Calculation Instant JS CODE
                let data = document.querySelectorAll('.selectAll');
                let arryData = Array.from(data);
                let sumData = 0;
                // looping arryData
                arryData.map(item=>{
                    sumData += parseInt(item.innerHTML);
                    $('.subtotalPrice').html('$'+sumData);
                })
            })

        @endforeach

        // Coupon Code
        $('#coupon_code').click(function(){
            let coupon = $('#coupon').val();
            // Akhane window.location.href dia javascript a url slug ta pathano hoichy. aita ke javascript a redirect bola hoye thake..
            window.location.href = "{{ url('cart') }}/"+ coupon;
        })

    </script>
@endsection
