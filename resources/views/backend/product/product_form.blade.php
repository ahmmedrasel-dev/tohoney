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
                            <h4 class="m-t-0 m-b-30 header-title text-center">Add Product</h4>
                            <div class="text-center">
                                <a href="{{ route('ProductView') }}" class="btn btn-outline-primary"> <i
                                        class="fi-menu"></i> View Product</a>
                            </div>
                            <form role="form" action="{{ route('ProductPost') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- Product Title --}}
                                <div class="form-group">
                                    <label for="title">Add Product Name:</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="Ex: T-shirt" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Product Permalink --}}
                                <div class="form-group">
                                    <label for="slug">Add Product Parmalink:</label>
                                    <input type="text" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror" id="slug"slug
                                        placeholder="Ex: t-shir" value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Product Category  --}}
                                <div class="form-group">
                                    <label for="cateogryName">Product Category Name:</label>
                                    <select name="cateogryName" id="cateogryName" class="form-control @error('cateogryName') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($ProductCategory as $item)
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

                                {{-- Product Sub-Category  --}}
                                <div class="form-group">
                                    <label for="subcategory">Product Sub-Category Name:</label>
                                    <select name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror">
                                    </select>
                                    @error('subcategory')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Product Brand  --}}
                                <div class="form-group">
                                    <label for="BrandName">Product Brand Name:</label>
                                    <select name="BrandName" id="BrandName" class="form-control @error('BrandName') is-invalid @enderror">
                                        {{-- <option value="">Select Product Brand</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('BrandName')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Product Variation According to Color, Size, Price, Quantity --}}
                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                    <div class="row">
                                        {{-- Product Color --}}
                                        <div class="col-3">
                                            <label for="field" class="font-weight-bold">Color</label>
                                            <select name="color[]" id="color" class="form-control @error('color') is-invalid @enderror">
                                                <option value="" disabled selected>Select Color</option>
                                               @foreach ($color as $item)
                                                <option value="{{ $item->id }}">{{ ucwords($item->color_name) }}</option>
                                               @endforeach
                                            </select>
                                            @error('color')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Product Size --}}
                                        <div class="col-3">
                                            <label for="size" class="font-weight-bold">Size</label>
                                            <select class="form-control" name="size[]" id="size">
                                                <option value="" disabled selected>Select Size</option>
                                               @foreach ($size as $item)
                                                <option value="{{ $item->id }}">{{ $item->size }}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                        {{-- Product Quantity --}}
                                        <div class="col-3">
                                            <label for="quantity" class="font-weight-bold">Quantity</label>
                                            <input type="text" id="field" class="form-control" name="quantity[]" />
                                        </div>
                                        {{-- Product Price --}}
                                        <div class="col-3">
                                            <label for="productPrice" class="font-weight-bold">Price</label>
                                            <input type="text" name="productPrice[]"
                                        class="form-control @error('productPrice') is-invalid @enderror" id="productPrice"
                                        placeholder="Ex: 500">
                                        @error('productPrice')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>{{ $message }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Add Remove Button to Muliple Variation Product --}}
                                <div class="clearfix form-group mt-4">
                                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus"></i> Add</button>
                                    <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus"></i> Remove</button>
                                </div>
                                {{-- Product Default Price --}}
                                <div class="form-group">
                                    <label for="defaultPrice">Default Product Price:</label>
                                    <input type="text" name="defaultPrice"
                                        class="form-control @error('defaultPrice') is-invalid @enderror" id="defaultPrice"
                                        placeholder="Ex: 500" value="{{ old('defaultPrice') }}">
                                    @error('defaultPrice')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Product Thumbnail --}}
                                <div class="form-group">
                                    <label for="thumbnail" class="form-control-label">Add Product Thumbnail:</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                                    @error('thumbnail')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div id="thumbnail_preview"></div>
                                {{-- Product Gallery --}}
                                <div class="form-group">
                                    <label for="thumbnail" class="form-control-label">Add Product Images:</label>
                                    <input  multiple type="file" name="productImage[]" id="productImage" class="form-control @error('productImage') is-invalid @enderror" onchange="preview_image()">
                                    @error('productImage')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div id="image_preview"></div>
                                {{-- Product Summary  --}}
                                <div class="form-group">
                                    <label for="productSummary">Add Product Sumamry:</label>
                                    <textarea name="productSummary" class="form-control @error('productSummary') is-invalid @enderror" id="my-editor2">{{ old('productSummary') }}</textarea>
                                    @error('productSummary')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Product Description  --}}
                                <div class="form-group">
                                    <label for="my-editor">Add Product Description:</label>
                                    <textarea name="productDesc" class="form-control @error('productDesc') is-invalid @enderror" id="my-editor">{{ old('productDesc') }}</textarea>
                                    @error('productDesc')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Form Button  --}}
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
    // Slug
    $('#title').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
    // Subcategory Show under Category.
    $('#cateogryName').change(function(){
        let category_id = $(this).val();
        if(category_id){
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/get-subcate') }}/" + category_id,
                success: function(data){
                    if(data){
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="">Select Sub-Category</option>');
                        $.each(data, function(key, value){
                            $('#subcategory').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                        })
                    }else{
                        $('#subcategory').empty();
                    }
                }
            })
        }else{
            $('#subcategory').empty();
        }
    })

    // Brand Show Under Category.
    $('#cateogryName').change(function(){
        let category_id = $(this).val();
        if(category_id){
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/get-brand') }}/"+ category_id,
                success: function(data){
                    if(data){
                        $('#BrandName').empty();
                        $('#BrandName').append('<option value="">Select Product Brand</option>');
                        $.each(data, function(key, value){
                            $('#BrandName').append('<option value="'+value.id+'">'+value.brand_name+'</option>');
                        })
                    }else{
                        $('#BrandName').empty();
                    }
                }
            })
        }
    })

    // Multiple images preview in browser
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

        $('#productImage').on('change', function() {
            imagesPreview(this, 'div#image_preview');
        });
    });
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

        $('#thumbnail').on('change', function() {
            imagesPreview(this, 'div#thumbnail_preview');
        });
    });

    // Add Remove field.
    var buttonAdd = $("#add-button");
    var buttonRemove = $("#remove-button");
    var className = ".dynamic-field";
    var count = 0;
    var field = "";
    var maxFields = 5;

    function totalFields() {
        return $(className).length;
    }

    function addNewField() {
        count = totalFields() + 1;
        field = $("#dynamic-field-1").clone();
        field.attr("id", "dynamic-field-" + count);
        field.children("label").text("Field " + count);
        field.find("input").val("");
        $(className + ":last").after($(field));
    }

    function removeLastField() {
        if (totalFields() > 1) {
        $(className + ":last").remove();
        }
    }

    function enableButtonRemove() {
        if (totalFields() === 2) {
        buttonRemove.removeAttr("disabled");
        buttonRemove.addClass("shadow-sm");
        }
    }

    function disableButtonRemove() {
        if (totalFields() === 1) {
        buttonRemove.attr("disabled", "disabled");
        buttonRemove.removeClass("shadow-sm");
        }
    }

    function disableButtonAdd() {
        if (totalFields() === maxFields) {
        buttonAdd.attr("disabled", "disabled");
        buttonAdd.removeClass("shadow-sm");
        }
    }

    function enableButtonAdd() {
        if (totalFields() === (maxFields - 1)) {
        buttonAdd.removeAttr("disabled");
        buttonAdd.addClass("shadow-sm");
        }
    }

    buttonAdd.click(function() {
        addNewField();
        enableButtonRemove();
        disableButtonAdd();
    });

    buttonRemove.click(function() {
        removeLastField();
        disableButtonRemove();
        enableButtonAdd();
    });
</script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

    CKEDITOR.replace('my-editor', options);
    CKEDITOR.replace('my-editor2', options);
</script>
@endsection
