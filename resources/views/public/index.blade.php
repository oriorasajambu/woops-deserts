<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/public/img/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/public/img/logo.png') }}">

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{ url('assets/public/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/public/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/f7e5c3263d.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/public/css/material-kit.css?v=3.0.4') }}" rel="stylesheet" />
    @yield('heads')

    @livewireStyles
</head>

<body class="index-page bg-gray-200">

    <!-- Navbar -->
    @livewire('navbar.dashboard-navbar')
    <!-- End Navbar -->

    @yield('content')

    @include('public.components.footer')

    <!--   Core JS Files   -->
    <script src="{{ url('assets/public/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/public/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/public/js/plugins/perfect-scrollbar.min.js') }}"></script>

    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="{{ url('assets/public/js/plugins/countup.min.js') }}"></script>
    <script src="{{ url('assets/public/js/plugins/choices.min.js') }}"></script>

    <script src="{{ url('assets/public/js/plugins/prism.min.js') }}"></script>
    <script src="{{ url('assets/public/js/plugins/highlight.min.js') }}"></script>

    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="{{ url('assets/public/js/plugins/rellax.min.js') }}"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="{{ url('assets/public/js/plugins/tilt.min.js') }}"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="{{ url('assets/public/js/plugins/choices.min.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script src="{{ url('assets/public/js/material-kit.min.js?v=3.0.4') }}" type="text/javascript"></script>

    @yield('scripts')

    @livewireScripts
</body>

</html>
