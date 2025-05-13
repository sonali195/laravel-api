<!DOCTYPE html>
<html lang="en" translate="no">
 
@include('layouts.shared.head')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@php
$user = null;
if(Auth::guard('web')->check()) {
    $user = Auth::guard('web')->user();
}
$mobile = in_array(Route::currentRouteName(), ['app.terms-conditions', 'app.privacy-policy', 'app.about-us']) ? true : false; 
@endphp

<body class="pb-0 left-side-menu-dark no-sidebar">
    @if(!$mobile)
    <!-- Pre-loader -->
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
    @endif

    <div id="wrapper">
        @if(!$mobile && !in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset']))
            @include('layouts.shared.nav', ['user' => $user])
        @endif

        @if(in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset' ]))
            @yield('content')
        @else
            <!-- ========== Left Sidebar Start ========== -->
            {{-- @include('layouts.shared.sidebar') --}}

            <div class="content-page py-3 mb-5">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>

            @if(!$mobile)
                @include('layouts.shared.footer')
            @endif
        @endif
    </div>

    @if(!$mobile)
        @include('layouts.shared.footer-script', ['notificationjs' => true])
        @include('layouts.shared.toast-message')
    @endif
</body>
</html>
