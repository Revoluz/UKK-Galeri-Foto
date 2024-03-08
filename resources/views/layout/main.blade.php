<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/shape-logo.png') }}">
    <title>.IMG</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/bs-5/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" />
    <!-- head -->
    @yield('head')
</head>

<body class=" row bg-gallery-yellow w-100 container-fluid align-items-center flex-column mx-0 px-0 min-vh-100">
    <!-- nav user -->
    @include('component.user.nav')
    <!-- gallery container -->
    <!-- content -->
    @yield('content')
    <!-- bottom nav -->
    @auth
    @include('component.user.bottom-nav')
    @endauth
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/bs-5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <!-- alert component -->
    @include('component.alert')
    <!-- plugins -->
    @yield('plugins')
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
</body>

</html>
