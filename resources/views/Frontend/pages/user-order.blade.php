@extends('Frontend.frontend-master')
@section('content')

<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="{{ route('myAccount') }}">My Account</a></li>
                        <li><span>User Order Details</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->

<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Information</h4>
                    </div>
                    <div class="card-body">
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
                                                    <span class="badge badge-info">
                                                        @if ($orders->billing->productStatus == 1)     Processing
                                                        @elseif ($orders->billing->productStatus == 2)
                                                            Shipped
                                                        @else
                                                            Delivered
                                                        @endif
                                                    </span>
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
                <div class="card">
                    <div class="card-header">
                        <h4>Account Information</h4>
                    </div>
                    <div class="card-body">
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
            <div class="col-md-12 mt-5">
                <div class="card">
                        <div class="card-header">
                            <h4>Address Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Billing Address</h4>
                                    <p>
                                        {{ $orders->billing->address ?? '' }} <br> {{ $orders->billing->Upazilas->name ?? '' }}, {{ $orders->billing->City->name ?? '' }} - {{ $orders->billing->postCode }}
                                        <br>{{ $orders->billing->Country->name }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Items Ordered</h3>
                    </div>
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
    </div>
</div>


@endsection
