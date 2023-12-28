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
    <link href="{{ url('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/f7e5c3263d.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/admin/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    @yield('heads')
    @livewireStyles
</head>

<body class="g-sidenav-show bg-gray-200">

    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.components.navbar')

        <!-- Content -->
        @yield('content')
    </main>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/plugins/chartjs.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/admin/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    
    @livewireScripts

    @yield('scripts')

    <script type="text/javascript">
        // closing any modal dynamically
        Livewire.on('cancel', modal => {
            if (typeof modal === "string" || modal.length === 0 || modal === null) return;
            let myModalEl = document.getElementById(modal);
            let instance = bootstrap.Modal.getInstance(myModalEl)
            instance.hide();
        });
    </script>
</body>

</html>
