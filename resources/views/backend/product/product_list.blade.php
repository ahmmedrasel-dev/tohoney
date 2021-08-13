
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
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a>Products</a></li>
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
                                <h2 class="m-t-0 header-title">Total Product({{ $prouctCount }})</h2>
                            </div>
                            <div class="text-right">
                                @can('add product')
                                    <a href="{{ route('ProductAdd') }}" class="btn btn-primary mb-3"> <i class="fa fa-plus-square"></i> Add Product</a>
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
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll"><span></span>
                                                </label>
                                            </th>
                                            <th>Sl</th>
                                            <th>Title</th>
                                            {{-- <th>Slug</th> --}}
                                            {{-- <th>Product Brand</th> --}}
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Color</th>
                                            <th>Price</th>
                                            <th>Thumbnail</th>
                                            {{-- <th>Gallery</th> --}}
                                            <th>Updated</th>
                                            <th width="225" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productList as $key => $item)
                                            <tr>
                                                <td class="valign-center">
                                                    <label class="form-check-label mg-b-0">
                                                        <input type="checkbox" id="checkAll" name="subcat_id[]" value="{{ $item->id }}"><span></span>
                                                    </label>
                                                </td>
                                                <td scope="row">{{ $productList->firstitem() + $key }}</td>
                                                {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                                <td>{{ Str::limit($item->title, 15) }}</td>
                                                <td>{{ $item->Category->category_name }}</td>
                                                <td>{{ $item->SubCategory->subcategory_name ?? '' }}</td>
                                                <td>
                                                    @foreach ( $item->ProductAttribute as $productAttri )
                                                        {{ $productAttri->color->color_name }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->product_price }}</td>
                                                <td><a href="{{ asset('images/'.$item->created_at->format('Y/m/').$item->id.'/'.$item->product_thumbnail) }}" download ><img width="50px" src="{{ asset('images/'.$item->created_at->format('Y/m/').$item->id.'/'.$item->product_thumbnail) }}" alt=""></a></td>

                                                {{-- <td>
                                                    @foreach ($item->ProductGallery as $pGallary)
                                                        <img width="70px" class="p-1" src="{{ asset('images/product-gallery/'.$pGallary->created_at->format('Y/m/').$pGallary->product_id.'/'.$pGallary->image_name) }}" alt="{{ $pGallary->image_name }}">
                                                    @endforeach
                                                </td> --}}

                                                <td>{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A' }}</td>
                                                <td class="text-center">
                                                    @can('edit product')
                                                        <a href="{{ route('ProductEdit', $item->id) }}" class="btn btn-outline-primary rounded-5"><i class="fa fa-pencil-square"></i></a>
                                                    @endcan

                                                    @can('delete product')
                                                        <a href="{{ route('ProductDelete', $item->id) }}" class="btn btn-outline-danger rounded-5"><i class="fa fa-trash"></i></a>
                                                    @endcan

                                                    @can('view product')
                                                        <a href="{{ route('singleProduct', $item->slug) }}" class="btn btn-outline-success rounded-5"><i class="fa fa-eye"></i></a>
                                                    @endcan

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $productList }}
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
