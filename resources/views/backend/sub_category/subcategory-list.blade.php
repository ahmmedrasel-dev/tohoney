
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
                                <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
                                <li class="breadcrumb-item"><a>Subcategory-list</a></li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title float-left">Total Category({{ $subcategory_count }})</h2>
                            <div class="text-right">
                                @can('add subcategory')
                                    <a href="{{ route('SubCategoryAdd') }}" class="btn btn-outline-primary mb-3"> <i class="fi-plus"></i> Add Subcategory</a>
                                @endcan
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

                            <form action="{{ route('SubCategorySelectedDelete') }}" method="POST">
                                @csrf
                                <label class="display-block" for="checkAll">Select All</label>
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>
                                            <label class="form-check-label mg-b-0">
                                                <input type="checkbox" id="checkAll"><span></span>
                                            </label>
                                        </th>
                                        <th>Sl</th>
                                        <th>Subcategory Name</th>
                                        <th>Slug</th>
                                        <th>Category Name</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategory as $key => $item)
                                        <tr>
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll" name="subcat_id[]" value="{{ $item->id }}"><span></span>
                                                </label>
                                            </td>
                                            <td scope="row">{{ $subcategory->firstitem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $item->subcategory_name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->Category->category_name }}</td>
                                            <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td>{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">
                                                @can('edit subcategory')
                                                    <a href="{{ url('admin/subcategory-edit') }}/{{ $item->id }}" class="btn btn-outline-primary rounded-5">Edit</a>
                                                @endcan
                                                @can('delete subcategory')
                                                    <a href="{{ url('admin/subcategory-delete') }}/{{ $item->id }}" class="btn btn-outline-danger rounded-5">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $subcategory }}
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
