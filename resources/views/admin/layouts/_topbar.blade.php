<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header border-right">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        <a class="navbar-brand" href="index-2.html">
            <!-- Logo icon -->
            <b class="logo-icon">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="{{ asset('assets/assets/images/logos/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                <!-- Light Logo icon -->
                <img src="{{ asset('assets/assets/images/logos/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
            </b>

            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="{{ asset('assets/assets/images/logos/logo-text.png') }}" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                             <img src="{{ asset('assets/assets/images/logos/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                        </span>
        </a>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-left mr-auto">
            <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-18"></i></a></li>
            <!-- ============================================================== -->
            <!-- Messages -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-18 mdi mdi-gmail"></i>
                    <div class="notify">
                        <span class="heartbit"></span>
                        <span class="point"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" aria-labelledby="2">

                </div>
            </li>
            <!-- ============================================================== -->
            <!-- Comment -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-check-circle font-18"></i>
                    <div class="notify">
                        <span class="heartbit"></span>
                        <span class="point"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                    <span class="with-arrow"><span class="bg-primary"></span></span>
                </div>
            </li>

            <!-- ============================================================== -->
            <!-- End mega menu -->
            <!-- ============================================================== -->
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                    <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="36">--}}
                    <span class="ml-2 font-medium">{{ Auth::user()->name }}</span><span class="fas fa-angle-down ml-2"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                    <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
{{--                        <div class=""><img src="../../assets/images/users/1.jpg" alt="user" class="rounded" width="80"></div>--}}
                        <div class="ml-2">
{{--                            <h4 class="mb-0">{{ Auth::user()->name }}</h4>--}}
                            <h4 class="mb-0">Abc</h4>
                            <p class=" mb-0 text-muted">abc@gmail.com</p>
{{--                            <p class=" mb-0 text-muted">{{ Auth::user()->email }}</p>--}}
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                        </div>
                    </div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user mr-1 ml-1"></i>View Profile</a>
                    <a class="btn btn-default btn-flat" href="{{ route('password.change') }}" class="btn btn-default btn-flat"><i class="ti-lock mr-1 ml-1"></i>Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
        </ul>
    </div>

</nav>
