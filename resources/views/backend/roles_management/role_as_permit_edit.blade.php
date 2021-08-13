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
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item"><a>Roles Assign Permission Edit</a></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-6 col-offset-3">
                    <div class="card-box">
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

                        <h2 class="m-t-0 header-title">Add Roles Name</h2>
                        <form action="{{ route('rollAsPermission') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label" for="role">Roles Name</label>
                                <select class="form-control" name="role_id" id="role">
                                    <option value>Select Roles Name</option>
                                    @foreach ( $roles as $item )
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="from-group">
                                <div class="form-control-label">Select Permission</div>
                                @foreach ( $permissions as $permission )
                                    <label for="permission{{ $permission->id }}"><input type="checkbox" name="permission_name[]" id="permission{{ $permission->id }}" value="{{ $permission->name }}"> {{ Str::title($permission->name) }}</label>
                                @endforeach
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Roles</button>
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
