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
                                <li class="breadcrumb-item"><a>Category-list</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="float-left">
                                <h2 class="m-t-0 header-title text-center">Total Category({{ $category_count }})</h2>
                            </div>
                            <div class="text-right">
                                @can('add category')
                                    <a href="{{ url('admin/category-add') }}" class="btn btn-primary mb-3"> <i class="fa fa-plus-square"></i> Add Category</a>
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

                            <form action="{{ route('CategorySelectedDelete') }}" method="POST">
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
                                        <th>Category Name</th>
                                        <th>Total Product</th>
                                        <th>Slug</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $key => $item)
                                        <tr>
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    @if ($item->id != 1)
                                                    <input type="checkbox" id="checkAll" name="cat_id[]" value="{{ $item->id }}"><span></span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td scope="row">{{ $category->firstitem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $item->category_name }}</td>
                                            <td>{{ $item->Product->count() }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td>{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">
                                                @if ($item->id == 1)
                                                <button class="btn btn-danger" disabled >Not Allow</button>
                                                @else
                                                    @can('edit category')
                                                        <a href="{{ url('admin/category-edit') }}/{{ $item->id }}" class="btn btn-outline-primary rounded-5"><i class="fa fa-pencil-square"></i></a>
                                                    @endcan
                                                    @can('Delete Category')
                                                        <a href="{{ url('admin/category-delete') }}/{{ $item->id }}" class="btn btn-outline-danger rounded-5"><i class="fa fa-trash"></i></a>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $category }}
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
