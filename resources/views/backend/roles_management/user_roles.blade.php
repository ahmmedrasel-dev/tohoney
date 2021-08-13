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
                            <li class="breadcrumb-item"><a>Roles</a></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-box">
                        <h2 class="m-t-0 header-title">Total Roles</h2>

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
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="120">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1  }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <ul>
                                                @foreach ( $item->getRoleNames() as $role)
                                                    <li>{{  $role }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-outline-primary rounded-5"><i class="fa fa-pencil-square"></i></a>
                                            <a href="" class="btn btn-outline-danger rounded-5"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-box">
                        <h2 class="m-t-0 header-title">Add Roles Name</h2>
                        <form action="{{ route('userAssignRoles') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label" for="user_id">User Email</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value disabled>Select User Email</option>
                                    @foreach ($users as $user )
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="from-group">
                                <div class="form-control-label">Select Roles</div>
                                @foreach ( $roles as $role )
                                    <label for="permission{{ $role->id }}"><input type="checkbox" name="permission_name[]" id="permission{{ $role->id }}" value="{{ $role->name }}"> {{ Str::title($role->name) }}</label>
                                @endforeach
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save Roles</button>
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
