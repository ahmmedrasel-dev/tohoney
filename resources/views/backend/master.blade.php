<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Tonmon Ecom-Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- C3 charts css -->
        <link href="{{ asset('assets/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css"  />

        <!-- Plugins css-->
        <link href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/switchery/switchery.min.css') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/metismenu.min.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css ') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('assets/js/modernizr.min.js ') }}"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{ route('frontend') }}" class="logo">
                        <span>
                            <img src="{{ asset('front/assets/images/logo.png') }}" alt="" height="40">
                        </span>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small> {{ Auth::user()->name ?? 'N/A' }}</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('login-form').submit();">

                                    <i class="zmdi zmdi-power"></i> <span>{{ __('Logout') }}</span>
                                </a>
                                <form action="{{ route('logout') }}" id="login-form" method="POST" style="display:none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            {{-- <li class="menu-title">Navigation</li> --}}

                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fi-air-play"></i><span class="badge badge-success pull-right"></span> <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-book"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ url('admin/category-list') }}">All Categories</a></li>
                                    <li><a href="{{ url('admin/category-trashlist') }}">Trash</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-lan"></i> <span>Sub-Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('SubCategoryView') }}">All Subcategories</a></li>
                                    <li><a href="{{ route('SubcategoryTrashlist') }}">Trash</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-heart-outline"></i> <span>Brand</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('brandView') }}">All Brands</a></li>
                                    <li><a href="{{ route('brandTrash') }}">Trash</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-product-hunt"></i> <span>Products</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('ProductView') }}">All Products</a></li>
                                    <li><a href="{{ route('ProductTrashlist') }}">Trash</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('orders') }}"><i class="fa fa-shopping-basket"></i><span>All Orders </span></a>
                            </li>

                            <li>
                                <a href="{{ route('coupon') }}"><i class="fa fa-percent"></i><span>All Coupons </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="icon-pin"></i> <span>Blogs</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('blog.index') }}">All Post</a></li>
                                    <li><a href="{{ route('blog.trash') }}">Trash</a></li>
                                </ul>
                            </li>

                            @role('admin')
                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-user-secret"></i> <span> User Management </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('roles') }}">Roles</a></li>
                                    <li><a href="{{ route('permission') }}">Permission</a></li>
                                    <li><a href="{{ route('rolesAndPermit') }}">Roll Assign Permit</a></li>
                                    <li><a href="{{ route('userRoles') }}">User Roles</a></li>
                                </ul>
                            </li>
                            @endrole

                            @php
                                $totalnew = App\Models\Contact::where('read_status', 1)->get()->count();
                            @endphp
                            <li>
                                <a href="javascript: void(0);"><i class="fi-mail @yield('msg-active')"></i><span> Email </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('message') }}">Inbox({{ $totalnew }})</a></li>
                                    <li><a href="{{ route('messageTrash') }}">Trash</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            @yield('content')


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

        <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript" src="{{ asset('assets/plugins/autocomplete/jquery.mockjax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/autocomplete/jquery.autocomplete.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/autocomplete/countries.js') }}"></script>

        <script type="text/javascript" src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>

         <!-- Jquery filer js -->
         <script src="{{ asset('assets/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

         <!-- Bootstrap fileupload js -->
         <script src="{{ asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
         <!-- page specific js -->
         <script src="{{ asset('assets/pages/jquery.fileuploads.init.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('assets/pages/jquery.dashboard.js ') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js ') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js ') }}"></script>
        <script>
            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>
        @include('sweetalert::alert')

        @yield('footer_js')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @yield('footer_js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (Session::has('message'));
            var type =  "{{ Session::get('alert-type', 'info') }}"
            switch(type){
                    case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                    case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                    case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
            }
            @endif
        </script>

    </body>
</html>
