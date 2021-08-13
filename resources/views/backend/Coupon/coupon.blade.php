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
                                <li class="breadcrumb-item"><a href="{{ url('admin/category-list') }}">Category-list</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add Category</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title text-center">Total Coupon({{ $count }})</h2>
                            {{-- Suceess Message --}}
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            {{-- Error Message --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form action="" method="POST">
                                @csrf
                                <label for="checkAll">Select All</label>
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>
                                            <label class="form-check-label mg-b-0">
                                                <input type="checkbox" id="checkAll"><span></span>
                                            </label>
                                        </th>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Min Amount</th>
                                        <th>Validity</th>
                                        {{-- <th>Created</th> --}}
                                        <th class="text-center" width="150">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $key => $item)

                                        <tr
                                        @if ( $item->ending_time < date('Y-m-d') )
                                        style=" color:red "
                                        @endif >
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll" name="coupon_id[]" value=""><span></span>
                                                </label>
                                            </td>
                                            <td scope="row">{{ $coupons->firstItem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->coupon_code }}</td>
                                            <td>{{ $item->discount_amount }}{{ $item->discount_type == 1 ? '$' : '%' }}</td>
                                            <td>{{ $item->min_amount }}</td>
                                            <td>{{ $item->ending_time }}</td>
                                            {{-- <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td> --}}
                                            <td class="text-center">
                                                @can('edit coupons')
                                                    <a href="{{ route('couponEdit', $item->id ) }}" class="btn btn-outline-primary rounded-5"><i class="fa fa-pencil-square"></i></a>
                                                @endcan
                                                @can('delete coupons')
                                                    <a href="{{ route('couponDelete', $item->id) }}" class="btn btn-outline-danger rounded-5"><i class="fa fa-trash"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $coupons }}
                                {{-- Pagination Button Show korbe --}}
                                <button class="btn btn-danger">Delete All</button>
                            </form>
                        </div>
                    </div>

                    @can('add coupons')
                        <div class="col-md-4">
                            <div class="card-box">
                                {{-- Success Message --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        <strong>{{ session('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <h4 class="m-t-0 header-title text-center">Create Coupon</h4>
                                <form role="form" action="{{ route('couponPost') }}" method="POST">
                                    @csrf
                                    {{-- Coupon Name --}}
                                    <div class="form-group">
                                        <label for="coupon_name">Coupon Name</label>
                                        <input type="text" name="coupon_name"
                                            class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name"
                                            placeholder="Ex: New Year 2020" value="{{ old('coupon_name') }}">
                                            {{-- Input error Message --}}
                                            @error('coupon_name')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>
                                    {{-- Coupon Code --}}
                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code</label>
                                        <input type="text" name="coupon_code"
                                            class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code"
                                            placeholder="Ex: newyear-20" value="{{ old('coupon_code') ?? Str::random(8) }}">
                                            {{-- Input error Message --}}
                                            @error('coupon_code')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>

                                    {{-- Start Time --}}
                                    <div class="form-group">
                                        <label for="starting_date">Starting date of Coupon</label>
                                        <input type="date" name="starting_date"
                                            class="form-control @error('starting_date') is-invalid @enderror" id="starting_date"
                                            placeholder="Ex: New Year 2020" value="{{ old('starting_date') }}">
                                            {{-- Input error Message --}}
                                            @error('starting_date')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>

                                    {{-- Start Time --}}
                                    <div class="form-group">
                                        <label for="ending_date">Ending date of Coupon</label>
                                        <input type="date" name="ending_date"
                                            class="form-control @error('ending_date') is-invalid @enderror" id="ending_date"
                                            placeholder="Ex: New Year 2020" value="{{ old('ending_date') }}">
                                            {{-- Input error Message --}}
                                            @error('ending_date')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>

                                    {{-- Discount Type --}}
                                    <div class="form-group">
                                        <label for="discount_type">Discount Type</label>
                                        <select class="form-control" name="discount_type" id="discount_type">
                                            <option value="" disabled selected>Select Discount Type</option>
                                            <option value="1">Fixed Amount($)</option>
                                            <option value="2">Percentage(%)</option>
                                        </select>
                                        {{-- Input error Message --}}
                                        @error('discount_type')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>{{ $message }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Discount Amount --}}
                                    <div class="form-group">
                                        <label for="discount_amount">Discount Amount</label>
                                        <input type="number" name="discount_amount"
                                            class="form-control @error('discount_amount') is-invalid @enderror" id="discount_amount"
                                            placeholder="Ex: 300" value="{{ old('discount_amount') }}">
                                            {{-- Input error Message --}}
                                            @error('discount_amount')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>

                                    {{-- Minium Amount --}}
                                    <div class="form-group">
                                        <label for="min_amount">Minium Amount</label>
                                        <input type="number" name="min_amount"
                                            class="form-control @error('min_amount') is-invalid @enderror" id="min_amount"
                                            placeholder="Ex: 300" value="{{ old('min_amount') }}">
                                            {{-- Input error Message --}}
                                            @error('min_amount')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-purple waves-effect waves-light">Save Coupon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan

                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2021 © rasel. - raselwebdev.com
        </footer>

    </div>
@endsection
