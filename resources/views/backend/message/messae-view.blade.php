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
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box m-t-20">
                        <h5 class="m-t-0"><b>Subject: {{ $messages->subject }}</b></h5>
                        <hr>

                        <div class="media m-b-30 ">
                            <div class="media-body">
                                <span class="media-meta pull-right"><strong>{{ $messages->created_at->format('Y/m/d - h:i A') }}</strong></span>
                                <h3 class="text-primary m-0">{{ $messages->name }}</h3>
                                <strong class="text-muted">From: {{ $messages->email }}</strong>
                            </div>
                        </div>
                        <!-- media -->
                        <p>{{ $messages->message }}</p>
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
