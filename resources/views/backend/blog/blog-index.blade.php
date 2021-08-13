
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a>Blogs</a></li>
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
                                <h2 class="m-t-0 header-title">All Blogs Post</h2>
                            </div>
                            <div class="text-right">
                                @can('blog add')
                                    <a href="{{ route('blog.create') }}" class="btn btn-primary mb-3"> <i class="fa fa-plus-square"></i> Create New Post</a>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Shot Description</th>
                                        <th>Featured</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th width="200" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $item)
                                        <tr>
                                            <td scope="row">{{ $blogs->firstitem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ Str::words($item->title, 10) }}</td>
                                            <td><a href="{{ route('categoryBlogs', $item->category_id) }}">{{ $item->Category->category_name }}</a></td>
                                            <td>{!! Str::words($item->short_description, 20) !!}</td>
                                            <td>
                                                <div class="switchery-demo">
                                                    <input type="checkbox" @if ( $item->feature_post == 2 ) checked @endif data-plugin="switchery" data-color="#039cfd" data-size="small" data-feature_post="{{ $item->feature_post }}" value="{{ $item->id }}" id="feature_post{{ $item->id }}" class="feature_post{{ $item->id }}"/>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="switchery-demo">
                                                    <input type="checkbox" @if ( $item->status == 1 ) checked @endif data-plugin="switchery" data-color="#039cfd" data-size="small" data-status="{{ $item->status }}" value="{{ $item->id }}" id="status{{ $item->id }}" class="status{{ $item->id }}"/>
                                                </div>
                                            </td>
                                            <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">

                                                <form action="{{ route('blog.destroy', $item->id) }}" method="post">
                                                    @can('blog edit')
                                                        <a href="{{ route('blog.edit', $item->id) }}" class="btn btn-outline-primary rounded-5"><i class="fa fa-pencil-square"></i></a>
                                                    @endcan

                                                    @can('blog delete')
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-outline-danger rounded-5">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                </form>

                                                {{-- @can('view product') --}}
                                                    <a href="{{ route('blogDetails', $item->slug) }}" class="btn btn-outline-success rounded-5"><i class="fa fa-eye"></i></a>
                                                {{-- @endcan --}}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $blogs }}
                            {{-- Pagination Button Show korbe --}}
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
       @foreach( $blogs as $item )
            $('#status{{ $item->id }}').change(function(){
                let blog_id = $(this).val();
                let status_id = $(this).attr('data-status');
                // alert(status_id);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('blog-status') }}/" + blog_id +'/' +status_id,
                });
            });

            $('#feature_post{{ $item->id }}').change(function(){
                let blog_id = $(this).val();
                let feature_post = $(this).attr('data-feature_post');
                // alert(status_id);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('blog-feature') }}/" + blog_id +'/' +feature_post,
                });
            });
       @endforeach
    </script>
@endsection
