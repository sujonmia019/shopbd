<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/moltran/layouts/blue-vertical/index-dark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Jul 2020 21:08:11 GMT -->

<head>
    <meta charset="utf-8" />
    <title>
        Dashboard | Moltran - Responsive Bootstrap 4 Admin Dashboard
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('public/backend/css/bootstrap-dark.min.css') }}" rel="stylesheet"
        type="text/css" id="bootstrap-stylesheet" />
     
    {{-- datatabel css  --}}
    <link href="{{ asset('public/backend/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('public/backend/css/toastr.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('public/backend/css/icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/css/starlight.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/css/app-dark.min.css') }}" rel="stylesheet"
        type="text/css" id="app-stylesheet" />

</head>

<body>
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">


                    <li class="dropdown notification-list d-none d-md-inline-block">
                        <a href="#" id="btn-fullscreen" class="nav-link waves-effect waves-light">
                            <i class="mdi mdi-crop-free noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="font-16 m-0">
                                    <span class="float-right">
                                        <a href="#" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div class="slimscroll noti-scroll">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon">
                                        <i class="fa fa-user-plus text-info"></i>
                                    </div>
                                    <p class="notify-details">New user registered
                                        <small class="noti-time">You have 10 unread messages</small>
                                    </p>
                                </a>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-item notify-all">
                                See all notifications
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"
                            data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('public/backend/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <a href="{{ route('admin.profile.index') }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-face-profile"></i>
                                <span>Profile</span>
                            </a>
                            
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-settings"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('admin.password') }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-key"></i>
                                <span>Change Password</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-power-settings"></i>
                                <span>Logout</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>

                        </div>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{{ asset('public/backend/images/logo-dark.png') }}" alt=""
                                height="16">
                            <!-- <span class="logo-lg-text-dark">Moltran</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">M</span> -->
                            <img src="{{ asset('public/backend/images/logo-sm.png') }}" alt=""
                                height="25">
                        </span>
                    </a>

                    <a href="index.html" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('public/backend/images/logo-light.png') }}"
                                alt="" height="16">
                            <!-- <span class="logo-lg-text-dark">Moltran</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">M</span> -->
                            <img src="{{ asset('public/backend/images/logo-sm.png') }}" alt=""
                                height="25">
                        </span>
                    </a>
                </div>

                <!-- LOGO -->


                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.layouts.sideber')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">


                        <!-- end row -->

                        @yield('content')



                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


        <!-- Vendor js -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="{{ asset('public/backend/js/vendor.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <script src="{{ asset('public/backend/libs/moment/moment.min.js') }}"></script>
        <script src="{{ asset('public/backend/libs/jquery-scrollto/jquery.scrollTo.min.js') }}">
        </script>
        <script src="{{ asset('public/backend/js/pages/sweet-alerts.min.js') }}">
        </script>

        <!-- Chat app -->
        <script src="{{ asset('public/backend/js/pages/jquery.chat.js') }}"></script>

        <!-- Todo app -->
        <script src="{{ asset('public/backend/js/pages/jquery.todo.js') }}"></script>

        <!-- flot chart -->
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.time.js') }}">
        </script>
        <script
            src="{{ asset('public/backend/libs/flot-charts/jquery.flot.tooltip.min.js') }}">
        </script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.resize.js') }}">
        </script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.pie.js') }}">
        </script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.selection.js') }}">
        </script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.stack.js') }}">
        </script>
        <script src="{{ asset('public/backend/libs/flot-charts/jquery.flot.crosshair.js') }}">
        </script>
        {{-- datatable js  --}}
        <script src="{{ asset('public/backend/js/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/backend/js/datatable/dataTables.bootstrap4.min.js') }}" }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <!-- Dashboard init JS -->
        <script src="{{ asset('public/backend/js/pages/dashboard.init.js') }}"></script>
        <script rel="stylesheet" href="{{ asset('public/backend/js/pages/toastr.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('public/backend/js/app.min.js') }}"></script>

        <script>
            $(function($){

                @if(Session::has('message'))
                    var type = "{{ Session::get('alert-type', 'info') }}";
                    switch(type){
                        case 'info':
                            toastr.info("{{ Session::get('message') }}");
                            break;

                        case 'warning':
                            toastr.warning("{{ Session::get('message') }}");
                            break;

                        case 'success':
                            toastr.success("{{ Session::get('message') }}");
                            break;

                        case 'error':
                            toastr.error("{{ Session::get('message') }}");
                            break;
                    }
                @endif
        
                $('#userTable').DataTable();

                
            })(jQuery);

        </script>
        @stack('swetalertjs')

</body>


<!-- Mirrored from coderthemes.com/moltran/layouts/blue-vertical/index-dark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Jul 2020 21:08:36 GMT -->

</html>
