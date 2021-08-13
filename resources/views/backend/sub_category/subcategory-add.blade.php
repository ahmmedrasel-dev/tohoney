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
                                <li class="breadcrumb-item"><a href="#">Add Subcategory</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-md-8 m-auto">
                        <div class="card-box">
                            <h4 class="m-t-0 m-b-30 header-title text-center">Add Subcategory</h4>
                            <div class="text-center">
                                <a href="{{ route('SubCategoryView') }}" class="btn btn-outline-primary"> <i
                                        class="fi-menu"></i> View Subcategory</a>
                            </div>
                            <form role="form" action="{{ route('SubCategoryPost') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="subcategory_name">Add Subcategory Name:</label>
                                    <input type="text" name="subcategory_name"
                                        class="form-control @error('subcategory_name') is-invalid @enderror" id="category_name"
                                        placeholder="Ex: Web Design" value="{{ old('subcategory_name') }}">
                                    @error('subcategory_name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cateogryName">Add Category Name:</label>
                                    <select name="cateogryName" id="cateogryName" class="form-control @error('cateogryName') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categoryName as $item)
                                            <option value="{{ $item->id }}">{{ ucwords($item->category_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('cateogryName')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                </div>
                            </form>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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
