@extends('Frontend.frontend-master')
@section('title')
    {{ __('Shopping wishlist Page') }}
@endsection
@section('wishlist-active')
    active
@endsection
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Wishlist</h2>
                            <ul>
                                <li><a href="{{ route('frontend') }}">Home</a></li>
                                <li><span>Wishlist</span></li>
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
        <!-- cart-area end -->
@endsection
@section('footer_js')
        <script>
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

            //  Data At to card from Wishlist Using Ajax.
            // $('.mybutton').on('click',function(e){
            //     let product_Id = $(this).data('product_id');
            //     let color_id = $('#color'+product_Id).val();
            //     let size_id = $('#size' +product_Id).val();
            //     let quantity = $('#quantity' +product_Id).val();
            //     // alert(quantity);

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     $.ajax({
            //         url: "{{ url('wishlist-add-to-cart') }}",
            //         method: "POST",
            //         data: {
            //             product_id: product_Id,
            //             color_id: color_id,
            //             size_id: size_id,
            //             quantity: quantity,
            //         },

            //         datType: 'json',
            //         success:function(data){
            //             const Toast = Swal.mixin({
            //             toast: true,
            //             position: 'top-end',
            //             showConfirmButton: false,
            //             timer: 3000,
            //             timerProgressBar: true,
            //             didOpen: (toast) => {
            //                 toast.addEventListener('mouseenter', Swal.stopTimer)
            //                 toast.addEventListener('mouseleave', Swal.resumeTimer)
            //             }
            //             })

            //             if($.isEmptyObject(data.error)){
            //                 Toast.fire({
            //                     icon: 'success',
            //                     title: data.success
            //                 })
            //             }else{
            //                 Toast.fire({
            //                     icon: 'error',
            //                     title: data.error
            //                 })
            //             }
            //         }

            //     });

            // });

        </script>
@endsection
