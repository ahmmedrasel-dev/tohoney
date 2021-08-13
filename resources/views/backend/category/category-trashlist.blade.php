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
                                <li class="breadcrumb-item"><a href="{{ url('category-list') }}">Category</a></li>
                                <li class="breadcrumb-item"><a>Category Trashed</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title text-center">Total Trashed ({{ $Category_count }})</h2>

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

                            <form action="{{ route('CatSelectDeleteRestore') }}" method="POST">
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
                                        <th>Slug</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($CategoryTrashlist as $key => $item)
                                        <tr>
                                            <th>
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll" name="trash_cat_id[]" value="{{ $item->id }}"><span></span>
                                                </label>
                                            </th>
                                            <th scope="row">{{ $CategoryTrashlist->firstitem() + $key }}</th>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $item->category_name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->created_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td>{{ $item->updated_at != null ? $item->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('CategoryRestore', $item->id ) }}" class="btn btn-outline-primary rounded-5">Restore</a>
                                                <a href="{{ route('CategoryPermanentDelete', $item->id ) }}" class="btn btn-outline-danger rounded-5">Permanent Delete</a>
                                            </td>
                                        @empty
                                            <td class="text-center" colspan="10">
                                                <strong>No Data Available</strong>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $CategoryTrashlist }}
                                {{-- Pagination Button Show korbe --}}
                                <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                                <input type="submit" value="Restore" name="restore" class="btn btn-success">
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
