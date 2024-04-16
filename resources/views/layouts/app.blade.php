<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistema RECISA - @yield('title')</title>
    <link rel="icon" href="{{ url('public/assets/img/escudo.png') }}">
    <!--Diseño-->
    <link rel="stylesheet" href="{{ url('public/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ url('public/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/Footer-Basic-icons.css') }}">
    @stack('css')
</head>

<body id="page-top" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
    <div id="wrapper">
        @include('layouts.navigation-menu')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('layouts.navigation-header')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ url('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/assets/js/theme.js') }}"></script>
    <!--JS tablas-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>           
    @stack('js')
</body>

</html>
