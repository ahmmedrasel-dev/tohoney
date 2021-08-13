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
                                <li class="breadcrumb-item"><a href="#">Edit Category</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-md-8 m-auto">
                        <div class="card-box">
                            <h4 class="m-t-0 m-b-30 header-title text-center">Edit Category</h4>
                            <form role="form" action="{{ url('admin/category-update') }}" method="POST">
                                @csrf
                                {{-- @csrf holo akta token hidden input dia pass korbe jate user authentik hoy achara data pass hobe na. sob somoy @csrf use korte hobe form a  --}}
                                <input type="hidden" name="cat_id" value="{{ $category->id }}">
                                {{-- cat_id ti amra request method dia find kore data update korbo --}}
                                <div class="form-group">
                                    <label for="category_name">Edit Category Name</label>
                                    <input type="text" name="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror" id="category_name"
                                        placeholder="Ex: Web Design" value="{{ $category->category_name ?? old('category_name') }}">
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
                                    <button type="submit" class="btn btn-purple waves-effect waves-light">Update</button>
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
