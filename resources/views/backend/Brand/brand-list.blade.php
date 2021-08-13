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
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Deshboard</a></li>
                                <li class="breadcrumb-item"><a>Brand-list</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title text-center">Total Brand({{ $totalBrand }})</h2>
                            <div class="text-center">
                                <a href="{{ url('admin/brand-add') }}" class="btn btn-outline-primary mb-3"> <i class="fi-plus"></i> Add Brand</a>
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

                            <form action="{{ route('brandPost') }}" method="POST">
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
                                        <th>Brand Name</th>
                                        <th>Total Product</th>
                                        <th>Slug</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brand as $key => $item)
                                        <tr>
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll" name="cat_id[]" value="{{ $item->id }}"><span></span>
                                                </label>
                                            </td>
                                            <td scope="row">{{ $brand->firstitem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $item->brand_name }}</td>
                                            <td>{{ $item->Product->count() }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td>{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('brandEdit', $item->id) }}" class="btn btn-outline-primary rounded-5">Edit</a>
                                                <a href="{{ route('brandTrash', $item->id) }}" class="btn btn-outline-danger rounded-5">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $brand }} --}}
                                {{-- Pagination Button Show korbe --}}
                                <button class="btn btn-danger">Delete All</button>
                            </form>
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
