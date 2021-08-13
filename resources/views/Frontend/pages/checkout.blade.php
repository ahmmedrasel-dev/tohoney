@extends('Frontend.frontend-master')
@section('header_css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <style>
        .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
        border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
        }
    </style>
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <form class="payment-form" action="{{ route('checkPost') }}" method="POST" id="payment-form">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details</h3>
                            {{-- Billing Address --}}
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="fullName">Full Name *</label>
                                    <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}" placeholder="Ex: Alex Roy">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="companyName">Company Name </label>
                                    <input type="text" id="companyName" name="companyName" value="{{ old('companyName') }}" placeholder="Al-Fakher Co lt.">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="phone">Phone Number *</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+880 1676176820">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@yourdomain.com">
                                </div>
                                <div class="col-12">
                                    <label for="address">Your Address *</label>
                                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="123, King Abdulaziz Road,">
                                </div>
                                <div class="col-12">
                                    <label for="country">Country *</label>
                                    <select name="country" id="country">
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ( $countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="state">Division/Country *</label>
                                    <select name="state" id="state">

                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="city">Town/City *</label>
                                    <select name="city" id="city">

                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="upazilas">Upazilas *</label>
                                    <select name="upazilas" id="upazilas">

                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <label for="postCode">Postcode/ZIP </label>
                                    <input type="text" id="postCode" name="postCode" value="{{ old('postCode') }}" placeholder="Ex: 1209">
                                </div>
                            </div>

                            <input id="toggle2" value="1" name="diffShipping" type="checkbox">
                            <label class="fontsize" for="toggle2">Ship to a different address?</label>
                            {{-- Shipping Address --}}
                            <div class="row" id="open2">
                                <div class="col-12">
                                    <label for="S_fullName">Full Name *</label>
                                    <input type="text" id="S_fullName" name="S_fullName" value="{{ old('S_fullName') }}" placeholder="Ex: Alex Roy">
                                </div>
                                <div class="col-12">
                                    <label for="S_companyName">Company Name </label>
                                    <input type="text" id="S_companyName" name="S_companyName" placeholder="Al-Fakher Co lt.">
                                </div>
                                <div class="col-12">
                                    <label for="S_phone">Phone Number *</label>
                                    <input type="text" id="S_phone" name="S_phone" placeholder="+880 1676176820">
                                </div>
                                <div class="col-12">
                                    <label for="S_email">Email Address *</label>
                                    <input type="email" id="S_email" name="S_email" placeholder="example@yourdomain.com">
                                </div>
                                <div class="col-12">
                                    <label for="S_address">Your Address *</label>
                                    <input type="text" id="S_address" name="S_address" placeholder="123, King Abdulaziz Road,">
                                </div>
                                {{-- Shipping Country --}}
                                <div class="col-12">
                                    <label for="S_country">Country *</label>
                                    <select name="S_country" id="S_country">
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ( $countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Shipping Division --}}
                                <div class="col-12">
                                    <label for="S_state">Division/Country *</label>
                                    <select name="S_state" id="S_state">

                                    </select>
                                </div>
                                {{-- Shipping City/Town --}}
                                <div class="col-12">
                                    <label for="S_city">Town/City *</label>
                                    <select name="S_city" id="S_city">

                                    </select>
                                </div>
                                {{-- Shipping Upazilas --}}
                                <div class="col-12">
                                    <label for="S_upazilas">Upazilas *</label>
                                    <select name="S_upazilas" id="S_upazilas">

                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="S_postCode">Postcode/ZIP </label>
                                    <input type="text" id="S_postCode" name="S_postCode" placeholder="Ex: 1209">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                                @php
                                    $total = 0;
                                @endphp
                            <ul class="total-cost">
                                @foreach ($cart as $item)
                                    @php
                                        $cartValues = App\Models\ProductAttribute::where('product_id', $item->product_id)->where('color_id', $item->color_id)->where('size_id', $item->size_id)->first();
                                    @endphp
                                    <li>{{ $item->Product->title }} <span class="pull-right">${{ $cartValues->price }}</span></li>
                                    @php
                                        $total += ($cartValues->price * $item->quantity)
                                    @endphp
                                @endforeach

                                <li>Subtotal <span class="pull-right"><strong>${{ $total }}</strong></span></li>
                                <li>Shipping <span class="pull-right">Free</span></li>
                                <li>Discount<span class="pull-right">
                                    @if ( $coupons == '')
                                        {{ 'N/A' }}
                                    @elseif ($coupons->discount_type == 2)
                                        %{{ $coupons->discount_amount }}.00
                                    @else
                                        ${{ $coupons->discount_amount }}.00
                                    @endif
                                    </span></li>
                                <li>Total
                                    <span class="pull-right">
                                    @if ($coupons == '')
                                        {{ $total }}
                                    @elseif ($coupons->discount_type == 1)
                                        ${{ $total - $coupons->discount_amount }}
                                    @else
                                        ${{ $total - $total * ($coupons->discount_amount / 100) }}
                                    @endif
                            </span></li>
                            </ul>
                            <ul class="payment-method">
                                {{-- Pyament Method Message --}}
                                @if (session('payment'))
                                    <div class="alert alert-danger">
                                        <span>{{ session('payment') }}</span>
                                    </div>
                                @endif
                                <li>
                                    <input id="bank" name="payment" value="bank" type="radio">
                                    <label for="bank">Direct Bank Transfer</label>
                                </li>
                                <li>
                                    <input id="paypal" name="payment" value="paypal" type="radio">
                                    <label for="paypal">Paypal</label>
                                </li>
                                <li>
                                    <input id="card" name="payment" value="card" type="radio">
                                    <label for="card">Credit Card</label>

                                    <!-- Stripe Elements Placeholder -->
                                    <div id="card-element">

                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </li>
                                <li>
                                    <input id="delivery" name="payment" value="cash" type="radio">
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button>Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection

@section('footer_js')
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//js.stripe.com/v3/"></script>
<script>
    // Billing Country
    $('#country').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-state-list')}}/"+countryID,
                success:function(res){
                if(res){
                    $("#state").empty();
                    $("#state").append('<option>Select State</option>');
                    $.each(res,function(key,value){
                        $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }else{
                    $("#state").empty();
                }
                }
            });
        }else{
            $("#state").empty();
            $("#city").empty();
        }
        });
        // Billing Divisions
        $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-city-list')}}/"+stateID,
                success:function(res){
                    if(res){
                        $("#city").empty();
                        $("#city").append('<option>Select City</option>');
                        $.each(res,function(key,value){
                            $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }else{
                        $("#city").empty();
                    }
                }
            });
        }else{
            $("#city").empty();
        }
    });
    // Billing Upazilas
    $('#city').on('change', function(){
        var upazilasId = $(this).val();
        if(upazilasId){
            $.ajax({
                type: "GET",
                url: "{{ url('api/get-upzilas-list') }}/"+upazilasId,
                success:function(res){
                    if(res){
                        $("#upazilas").empty();
                        $("#upazilas").append('<option>Select Upazilas</option>');
                        $.each(res,function(key,value){
                            $("#upazilas").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }else{
                        $("#upazilas").empty();
                    }
                }

            })
        }
    })

    // Shipping Country
    $('#S_country').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-state-list')}}/"+countryID,
                success:function(res){
                if(res){
                    $("#S_state").empty();
                    $("#S_state").append('<option>Select State</option>');
                    $.each(res,function(key,value){
                        $("#S_state").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }else{
                    $("#S_state").empty();
                }
                }
            });
        }else{
            $("#S_state").empty();
            $("#S_city").empty();
        }
        });
        // Billing Divisions
        $('#S_state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-city-list')}}/"+stateID,
                success:function(res){
                    if(res){
                        $("#S_city").empty();
                        $("#S_city").append('<option>Select City</option>');
                        $.each(res,function(key,value){
                            $("#S_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }else{
                        $("#S_city").empty();
                    }
                }
            });
        }else{
            $("#S_city").empty();
        }
    });
    // Billing Upazilas
    $('#S_city').on('change', function(){
        var upazilasId = $(this).val();
        if(upazilasId){
            $.ajax({
                type: "GET",
                url: "{{ url('api/get-upzilas-list') }}/"+upazilasId,
                success:function(res){
                    if(res){
                        $("#S_upazilas").empty();
                        $("#S_upazilas").append('<option>Select Upazilas</option>');
                        $.each(res,function(key,value){
                            $("#S_upazilas").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }else{
                        $("#S_upazilas").empty();
                    }
                }

            })
        }else{
            $("#S_upazilas").empty();
        }
    })
    // Search In Selection / Option
    $(document).ready(function() {
        $('#country, #state, #city, #upazilas').select2();
    });
</script>

<script>

    $(document).ready(function(){
        $('#card-element').hide();

        $('#paypal').on('click', function(){
            $('#card-element').hide();
            $('.payment-form').attr('id', '');
        })
        $('#delivery').on('click', function(){
            $('#card-element').hide();
            $('.payment-form').attr('id', '');
        })
        $('#bank').on('click', function(){
            $('#card-element').hide();
            $('.payment-form').attr('id', '');
        })

        $('#card').on('click', function(){
            $('#card-element').show();
            $('.payment-form').attr('id', 'payment-form');
        })
        var stripe = Stripe('pk_test_gNmSPMkID5FDD1S1722nurGV00henwP7zh');
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    })

</script>
@endsection
