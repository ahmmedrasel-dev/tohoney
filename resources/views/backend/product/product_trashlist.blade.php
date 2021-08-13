
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
                                <li class="breadcrumb-item"><a href="#">Product</a></li>
                                <li class="breadcrumb-item"><a>Product Trash-list</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title text-center">Product Trashlist({{ $prouctCount }})</h2>
                            <div class="text-center">
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
                                            <th>Product Title</th>
                                            <th>Slug</th>
                                            <th>Category Name</th>
                                            <th>Subcategory Name</th>
                                            {{-- <th>Product Summary</th>
                                            <th>Product Description</th> --}}
                                            <th>Product price</th>
                                            <th>Product Thumbnail</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product_trashlist as $key => $item)
                                            <tr>
                                                <td class="valign-center">
                                                    <label class="form-check-label mg-b-0">
                                                        <input type="checkbox" id="checkAll" name="subcat_id[]" value="{{ $item->id }}"><span></span>
                                                    </label>
                                                </td>
                                                <td scope="row">{{ $product_trashlist->firstitem() + $key }}</td>
                                                {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>{{ $item->Category->category_name }}</td>
                                                <td>{{ $item->SubCategory->subcategory_name }}</td>
                                                {{-- <td>{{ $item->summary }}</td>
                                                <td>{{ $item->description }}</td> --}}
                                                <td>{{ $item->price }}</td>
                                                <td><img width="100px" src="{{ asset('images/'.$item->created_at->format('Y/m/').$item->id.'/'.$item->product_thumbnail) }}" alt=""></td>
                                                <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                                <td>{{ $item->updated_at != null ? $item->updated_at->diffForHumans() : 'N/A' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('ProductRestore', $item->id) }}" class="btn btn-outline-primary rounded-5">Restore</a>
                                                    <a href="{{ route('ProductPerDelete', $item->id) }}" class="btn btn-outline-danger rounded-5">Permanent Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $product_trashlist }}
                                {{-- Pagination Button Show korbe --}}
                                <div class="text-left">
                                    <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                                    <input type="submit" value="Restore" name="restore" class="btn btn-success">
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
