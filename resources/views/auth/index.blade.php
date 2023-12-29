<!DOCTYPE html>
<html lang="en">
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
<body>
    <!-- Navbar -->
    @livewire('navbar.dashboard-navbar')
    <!-- End Navbar -->
    <div class="page-header align-items-start min-vh-100" 
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" 
        loading="lazy">
        @yield('content')
    </div>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/public/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/public/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/public/js/plugins/perfect-scrollbar.min.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script src="{{ url('assets/public/js/material-kit.min.js?v=3.0.4') }}" type="text/javascript"></script>

    @yield('scripts')

    @livewireScripts
</body>
</html>