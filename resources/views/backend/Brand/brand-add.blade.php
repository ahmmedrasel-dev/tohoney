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
                            <li class="breadcrumb-item"><a href="{{ route('brandView') }}">Brand-list</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Add Brand</a></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-md-8 m-auto">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title text-center">Add Brand</h4>
                        <div class="text-center">
                            <a href="{{ route('brandView') }}" class="btn btn-outline-primary">View Brand</a>
                        </div>
                        <form role="form" action="{{ route('brandPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Brand Name --}}
                            <div class="form-group">
                                <label for="brand_name">Add Brand Name</label>
                                <input type="text" name="brand_name"
                                    class="form-control @error('brand_name') is-invalid @enderror" id="brand_name"
                                    placeholder="Ex: Apple" value="{{ old('brand_name') }}">

                                @error('brand_name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            {{-- Brand Category --}}
                            <div class="form-group">
                                <label for="category_id">Add Category Name:</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categoryName as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->category_name) }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>

                            {{-- Brand Logo --}}
                            <div class="form-group">
                                <label for="brand_logo" class="form-control-label">Add Brand Logo:</label>
                                <input type="file" name="brand_logo" id="brand_logo" class="form-control @error('brand_logo') is-invalid @enderror">
                                @error('brand_logo')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            <div id="brand_logo_preview" style="width: 50px"></div>
                            {{-- Submit Button --}}
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
@section('footer_js')
    <script>
        // Single Image Preview.
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="150" class="mr-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#brand_logo').on('change', function() {
                imagesPreview(this, 'div#brand_logo_preview');
            });
        });
    </script>
@endsection
