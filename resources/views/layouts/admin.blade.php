<!DOCTYPE html>
<html lang="en" translate="no">

@include('layouts.admin.admin-head')

<body class="left-sidebar">
    <div id="preloader">
        <div class="loader">
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--text"></div>
        </div>
    </div>
    <!-- End Preloader-->
    <div id="wrapper">
        @include('layouts.admin.admin-nav', ['menuIcon' => true])

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="sidebar-content">
                <!--- Sidemenu -->
                <div id="sidebar-menu" class="slimscroll-menu">
                    @include('layouts.admin.admin-menu')
                </div>
                <!-- End Sidebar -->
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('breadcrumb')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('rightconent')
    @include('layouts.admin.admin-footer-script', ['notificationjs' => false])
    @include('layouts.shared.toast-message')
</body>
</html>
