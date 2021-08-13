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
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Deshboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2021 © rasel. - raselwebdev.com
        </footer>

    </div>
@endsection
