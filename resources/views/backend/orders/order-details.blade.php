@extends('backend.master')
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Dashboard</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('orders') }}">Orders</a></li>
                            <li class="breadcrumb-item"><a href="#">Order Details</a></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="order clearfix">
                            <h4>Order Information</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Order Date</td>
                                            <td>{{ $orders->created_at->format('M d, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-10 col-sm-10">
                                                        <select id="order-status" class="form-control custom-select-black"
                                                            data-id="1715">
                                                            <option value="1" @if ($orders->billing->productStatus == 1 )selected @endif>Processing</option>
                                                            <option value="2"@if ($orders->billing->productStatus == 2 )selected @endif>Shipped</option>
                                                            <option value="3"@if ($orders->billing->productStatus == 3 )selected @endif>Deliverd</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>{{ $orders->billing->paymentMethod }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="account-information">
                            <h4>Account Information</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>{{ $orders->billing->fullName }}</td>
                                        </tr>
                                        <tr>
                                            <td>Customer Email</td>
                                            <td>{{ $orders->billing->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Customer Phone</td>
                                            <td>{{ $orders->billing->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                            <h3 class="section-title">Address Information</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Billing Address</h4>
                                        <p>
                                            {{ $orders->billing->address ?? '' }} <br> {{ $orders->billing->Upazilas->name ?? '' }}, {{ $orders->billing->City->name ?? '' }} - {{ $orders->billing->postCode }}
                                            <br>{{ $orders->billing->Country->name }}
                                        </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="shipping-address">
                                        <h4>Shipping Address</h4>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h3 class="section-title">Items Ordered</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="">{{ $orders->product->title }}</a>
                                            <br>
                                            <span>
                                                Color:
                                                <span>
                                                    {{ $orders->color->color_name }}
                                                </span>
                                            </span>
                                            <span>
                                                Size:
                                                <span>
                                                    {{ $orders->size->size }}
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            ${{ $orders->product_price }}
                                        </td>
                                        <td>{{ $orders->product_quantity }}</td>
                                        <td>
                                            ${{  $orders->product_price * $orders->product_quantity }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-right">${{ $orders->product_price * $orders->product_quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td>Delivery Chrage</td>
                                        <td class="text-right">Free</td>
                                    </tr>
                                    <tr>
                                        <td>Coupon</td>
                                        <td class="text-right">{{ $orders->billing->coupon ?? 'NA' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="text-right">${{ $orders->billing->total_amount - $orders->billing->coupon }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2021 © rasel. - raselwebdev.com
    </footer>

</div>
@endsection
