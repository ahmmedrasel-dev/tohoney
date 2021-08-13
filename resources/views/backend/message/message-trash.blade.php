@extends('backend.master')
@section('msg-active')
    active
@endsection
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
                                <li class="breadcrumb-item"><a>Message-list</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="text-left">
                                <h2 class="m-t-0 header-title">Total Message</h2>
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
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        @can('order view')
                                            <th width="120" class="text-center">Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messageTrashList as $key => $item)
                                        <tr>
                                            <td scope="row">{{ $messageTrashList->firstitem() + $key }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ Str::limit($item->message, 100 ) }}</td>
                                            <td>{{ $item->created_at->format('M d') }}</td>
                                            <td>
                                                <a href="{{ route('messageDestroy', $item->id) }}" class="btn btn-outline-danger rounded-5"><i class="fa fa-trash"></i></a>
                                                <a href="{{ route('messageRestore', $item->id) }}" class="btn btn-outline-success rounded-5"><i class="mdi mdi-recycle"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $messageTrashList->links()  }}
                                {{-- Pagination Button Show korbe --}}
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2021 © rasel. - raselweb.com
        </footer>

    </div>
@endsection
