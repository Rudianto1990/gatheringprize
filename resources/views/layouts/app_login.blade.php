<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titles')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('css')
</head>


    <body class="login-page">

        @yield('content')

        <!-- CORE PLUGIN JS -->
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{asset('plugins/node-waves/waves.js')}}"></script>
        <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

        <!--THIS PAGE LEVEL JS-->
        <script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
        <script src="{{asset('js/pages/examples/login.js')}}"></script>

        <!-- LAYOUT JS -->
        <script src="{{asset('js/demo.js')}}"></script>

        @yield('scripts')
    </body>
</html>
