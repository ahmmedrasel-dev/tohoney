@extends('Frontend.frontend-master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>My Account</h2>
                        <ul>
                            <li><a href="{{ route('frontend') }}">Home</a></li>
                            <li><span>My Account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->

    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-user"></i> Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-order-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-shopping-cart"></i> My Orders</a>
                          </li>

                        <li class="nav-item">
                          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"> Wishlist</a>
                        </li>
                    </ul>
                    <hr>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-order-tab">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5>My Orders</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless my-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Date</th>
                                                    <th>Order Status</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ( $orders as  $key => $item )
                                                <tr>
                                                    <td>{{ $orders->firstitem() + $key }}</td>
                                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            @if ($item->billing->productStatus == 1)     Processing
                                                            @elseif ($item->billing->productStatus == 2)
                                                                Shipped
                                                            @else
                                                                Delivered
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>${{ $item->billing->total_amount }} </td>
                                                    <td><a href="{{ route('userOrder', $item->id) }}" class="btn btn-view"><i class="fa fa-eye"></i>View</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5>My Profile</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label-control" for="name">Name</label>
                                                    <input class="form-control" type="text" name="name" id="name" value="{{ Auth::user()->name }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label-control" for="password">Old Password</label>
                                                    <input class="form-control" type="password" name="password" id="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label-control" for="email">Email</label>
                                                    <input class="form-control" type="email" name="email" id="name" value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label-control" for="newPassword">New Password</label>
                                                    <input class="form-control" type="password" name="newPassword" id="newPassword">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-primary" type="submit">Save Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <table class="table-responsive cart-wrap">
                                        <thead>
                                            <tr>
                                                <th class="images">Image</th>
                                                <th>Product</th>
                                                <th class="product">Color</th>
                                                <th class="product">Size</th>
                                                <th>Stock Qty</th>
                                                <th class="ptice">Price</th>
                                                <th class="ptice">Add Qyt</th>
                                                <th class="addcart">Add to Cart</th>
                                                <th class="ptice px-2">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $wishlist as $item )
                                                <tr>
                                                    <td class="images"><img src="{{ asset('images/'. $item->Product->created_at->format('Y/m/').$item->product_id ).'/'.$item->Product->product_thumbnail }}" alt=""></td>
                                                    <td class="product"><a href="{{ route('singleProduct', $item->Product->slug) }}">{{ $item->product->title }}</a></td>

                                                    @php
                                                        $product = App\models\Product::where('slug', $item->Product->slug)->first();
                                                        $productAttri =  App\models\ProductAttribute::where('product_id', $item->product_id )->get();
                                                        $collect = collect($productAttri);
                                                        $groupby = $collect->groupBy('color_id');
                                                    @endphp
                                                    <form action="{{ route('wishlistToCart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="productid" value="{{ $item->product_id }}">
                                                        <input type="hidden" name="wishlistid" value="{{ $item->id }}">
                                                        <td class="ptice">
                                                            <div class="form-group">
                                                                <label for="color">Select Color: </label>
                                                                <select class="form-control color_id" name="color" id="color{{ $item->product_id }}">
                                                                    <option value>Select Color</option>
                                                                    @foreach ( $groupby as $data)
                                                                        <option  data-product="{{ $data[0]->product_id }}" value="{{ $data[0]->color_id }}">{{ Str::ucfirst($data[0]->Color->color_name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td class="size">
                                                            <div class="form-group">
                                                                <label for="size">Product Size:</label>
                                                                <select name="size" id="size{{ $item->product_id }}" class="form-control @error('size') is-invalid @enderror">
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

                                                        </td>
                                                        <td class="ptice availableQuantity{{ $item->product_id }}">{{ $productAttri->sum('quantity') }}</td>

                                                        <td class="ptice priceOfSize{{ $item->product_id }}">{{ $item->product->product_price }}</td>

                                                        <td class="quantity cart-plus-minus">
                                                                <input id="quantity{{ $item->product_id }}" type="text" name="quantity" value="1" />
                                                                <div class="dec qtybutton qtyMinus">-</div>
                                                                <div class="inc qtybutton qtyPlus">+</div>
                                                        </td>

                                                        <td><button type="submit" class="btn btn-primary" >Add to Cart</button></td>
                                                        {{-- <td class="addcart"><button class="btn btn-primary mybutton" id="mybutton{{ $item->product_id }}" type="submit" data-product_Id="{{ $item->product_id }}">Add to Cart</button></td> --}}
                                                        <td><a href="{{ route('wishlistDelete', $item->id) }}"><i class="fa fa-trash"></i></a></td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>
        $('.nav li').click(function(){
            $('.nav li').removeClass('active');
            $(this).addClass('active');
        });

        // Show The Size According to Product color and Size.
        $('.color_id').change(function(){
                let colorId = $(this).val();
                let productId = $(this).find(':selected').attr('data-product');
                $.ajax({
                    type: "GET",
                    url: "{{ url('get-product-size-2') }}/"+ colorId + "/" + productId,
                    success:function(result){
                        if(result){
                            $('#size'+productId).html('<option value="">Select Size</option>');
                            $('#size'+productId).append(result);
                            $('#size'+productId).change(function(){
                                let dataPrice = $(this).find(':selected').attr('data-price');
                                let dataQyantity = $(this).find(':selected').attr('data-quantity');
                                // alert(dataPrice);
                                $(".priceOfSize"+productId).html('$' + dataPrice);
                                $(".availableQuantity"+productId).html(dataQyantity);
                            })
                        }else{
                            $('#size'+productId).empty();
                        }
                    }
                })
            });

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

    </script>
@endsection
