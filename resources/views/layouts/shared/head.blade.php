<head>
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    
    <link rel="canonical" href="{{URL::current()}}" />
    
    <meta name="description" content="" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{env('APP_NAME')}}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:url" content="{{URL::current()}}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('facebook_meta')

    <link rel="shortcut icon" href="{{ Helper::assets('assets/images/favicon.ico') }}">
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ Helper::assets('assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Helper::assets('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Helper::assets('assets/images/favicon-16x16.png') }}"> --}}

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet" type="text/css">

    @yield('css')

    <script type="text/javascript">
        (function () {
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        })();
    </script>

    <!-- App css -->
    <link href="{{ Helper::assets('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Helper::assets('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Helper::assets('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>