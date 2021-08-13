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

                    <div class="col-md-8 m-auto">
                        <div class="card-box">
                            <h4 class="m-t-0 m-b-30 header-title text-center">Add Category</h4>
                            <div class="text-center">
                                <a href="{{ url('admin/category-list') }}" class="btn btn-outline-primary"> <i
                                        class="fi-menu"></i> View Category</a>
                            </div>
                            <form role="form" action="{{ url('admin/category-post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category_name">Add Category Name</label>
                                    <input type="text" name="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror" id="category_name"
                                        placeholder="Ex: Web Design" value="{{ old('category_name') }}">
                                </div>
                                @error('category_name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
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
