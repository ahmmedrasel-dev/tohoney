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
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item"><a>Blog Add</a></li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="m-t-0 m-b-10 header-title text-center">Blog Post Create</h4>
                            <hr>

                            <form class="form-horizontal" role="form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="title" class="col-2 col-form-label">Post Title</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="add title">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-2 col-form-label">slug</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="add slug">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cateogryName" class="col-2 col-form-label">Select Category</label>
                                    <div class="col-10">
                                        <select class="form-control select2" name="category_id" id="cateogryName">
                                            <option>Select Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="subcategory" class="col-2 col-form-label">Select Sub Category</label>
                                    <div class="col-10">
                                        <select class="form-control select2" name="subcat_id" id="subcategory">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Thumbnail Upload</label>
                                    <div class="col-4">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div>
                                                <button type="button" class="btn btn-secondary btn-file">
                                                    <input type="file" class="btn-secondary" name="thumbnail"
                                                        id="thumbnail" />
                                                </button>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"
                                                style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        </div>
                                    </div>

                                    <label class="col-2 col-form-label">Feature Image Upload</label>
                                    <div class="col-4">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div>
                                                <button type="button" class="btn btn-secondary btn-file">
                                                    <input type="file" class="btn-secondary" id="feature_image" name="feature_image" />
                                                </button>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"
                                                style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="my-editor" class="col-2 col-form-label">Description</label>
                                    <div class="col-10">
                                        <textarea class="from-control" name="short_description" id="my-editor"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="keyword" class="col-2 col-form-label">Keywords</label>
                                    <div class="col-10">
                                        <div class="m-b-0">
                                            <select multiple data-role="tagsinput" name="tags[]"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 row">
                                    <div class="offset-2 col-10">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Post
                                            Save</button>
                                    </div>
                                </div>
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
@section('footer_js')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('my-editor', options);

        // Slug
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
        });

        // Subcategory Show under Category.
        $('#cateogryName').change(function() {
            let category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/get-subcate') }}/" + category_id,
                    success: function(data) {
                        if (data) {
                            $('#subcategory').empty();
                            $('#subcategory').append('<option value="">Select Sub-Category</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + value.id + '">' +
                                    value.subcategory_name + '</option>');
                            })
                        } else {
                            $('#subcategory').empty();
                        }
                    }
                })
            } else {
                $('#subcategory').empty();
            }
        })

    </script>
@endsection
