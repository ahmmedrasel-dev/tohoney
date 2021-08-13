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
                                <li class="breadcrumb-item"><a>Orders-list</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- end row -->
                <div class="row mb-1">
                        <div class="col-md-6">
                            <form action="{{ route('downloadFile') }}" method="get">
                                <input type="date" name="start" id="start" value="{{ $startDate ?? old('start') }}">
                                <input type="date" name="end" id="end" value="{{ $endDate ?? old('end') }}">

                                <input class="btn btn-primary rounded-5" type="submit" value="PDF" name="pdf">
                                <input class="btn btn-primary rounded-5" type="submit" value="Excel" name="excel">
                            </form>
                        </div>
 
                        <div class="col-md-6 text-right">
                            <form action="{{ route('orderSearch') }}" method="get">
                                <input type="date" name="start" id="start" value="{{ $startDate ?? old('start') }}">
                                <input type="date" name="end" id="end" value="{{ $endDate ?? old('end') }}">

                                <input class="btn btn-primary rounded-5" type="submit" value="Search">
                            </form>
                        </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="text-left">
                                <h2 class="m-t-0 header-title">Total Orders({{ $total }})</h2>
                            </div>

                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form action="{{ route('CategorySelectedDelete') }}" method="POST">
                                @csrf
                                <label for="checkAll">Select All</label>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll"><span></span>
                                                </label>
                                            </th>
                                            <th>Sl</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Ammout</th>
                                            <th>Payment</th>
                                            <th>Pay Status</th>
                                            <th>Create</th>
                                            @can('order view')
                                                <th width="50" class="text-center">Action</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $item)
                                            <tr>
                                                <td class="valign-center">
                                                    <label class="form-check-label mg-b-0">
                                                        <input type="checkbox" id="checkAll" name="subcat_id[]" value="{{ $item->id }}"><span></span>
                                                    </label>
                                                </td>
                                                <td scope="row">{{ $orders->firstitem() + $key }}</td>
                                                {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                                <td>{{ $item->product->title }}</td>
                                                <td>{{ $item->product_quantity }}</td>
                                                <td>{{ $item->billing->total_amount ?? 'unpaid' }}</td>
                                                <td>{{ $item->billing->paymentMethod }}</td>
                                                <td>
                                                    @if ($item->billing->paymentStatus == 1)
                                                        panding
                                                    @else
                                                        paid
                                                    @endif
                                                </td>

                                                <td>{{ $item->updated_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                                <td class="text-center">
                                                    @can('order view')
                                                        <a href="{{ route('ordersView', $item->id ) }}" class="btn btn-outline-success rounded-5"><i class="fa fa-eye"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $orders->links()  }}
                                    {{-- Pagination Button Show korbe --}}
                                </div>
                                <button class="btn btn-danger">Delete All</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2021 © rasel. - raselweb.com
        </footer>

    </div>
@endsection
