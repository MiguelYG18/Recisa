<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> RECISA| @yield('title')</title>
    <link rel="icon" href="{{ asset('assets/img/escudo.png') }}">
    <!--Anderson-->
        <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome5-overrides.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Billing-Table-with-Add-Row--Fixed-Header-Feature.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Data-Table-styles.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Data-Table.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Footer-Basic-icons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/FORM.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Ludens-Users---25-After-Register.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Pretty-Registration-Form-.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Register-form.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Responsive-Form-Contact-Form-Clean.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Responsive-Form.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Table-With-Search-search-table.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/Table-With-Search.css')}}">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--Anderson-->

    <!--Menu Bar-->
        <link rel="stylesheet" href="{{asset('assets/css/menu_bar.css')}}">
        <script src="https://kit.fontawesome.com/4f34cfe44c.js" crossorigin="anonymous"></script>
    <!--Menu Bar-->

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
    <!--Anderson-->
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

        <script src="{{asset('assets/js/Billing-Table-with-Add-Row--Fixed-Header-Feature.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script src="{{asset('assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-1.js')}}"></script>

        <script src="{{asset('assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.js')}}"></script>
        <script src="{{asset('assets/js/Table-With-Search.js')}}"></script>

        <script src="{{asset('assets/js/theme.js')}}"></script>    
    <!--Anderson-->

    <!--JS bar-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/menu_bar.js')}}"></script>
    <!--JS bar--> 
    <!--JS tablas-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <!--JS tablas-->      
    @stack('js')
</body>

</html>
