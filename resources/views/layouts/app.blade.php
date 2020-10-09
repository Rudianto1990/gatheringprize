<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Gathering Prize | @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon">

    <!--REQUIRED PLUGIN CSS-->
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/spinkit/spinkit.css')}}" rel="stylesheet">

    <!-- THIS PAGE CSS -->
    @yield('styles')

    <!--REQUIRED THEME CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="{{asset('css/layout.css')}}" rel="stylesheet">
    <link href="{{asset('css/themes/main_theme.css')}}" rel="stylesheet" />
</head>

<body class="theme-indigo light layout-fixed">
<div class="wrapper">
    <!-- top navbar-->
    <header class="topnavbar-wrapper">
        <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
                <a href="{{ url('/') }}" class="navbar-brand has__center--horizontal" style="position: relative; flex-direction: column;">
                    <div class="brand-logo" style="position: absolute;">
                        <img src="{{asset('images/ipc_logo2.png')}}" width="90px" height="40px" alt="Admin Logo" class="img-responsive">
                    </div>
                    <div class="brand-logo-collapsed" style="position:absolute;">
                       <img src="{{asset('images/imageedit_6_7372213263.png')}}" width="50px" height="50px" alt="Admin Logo" class="img-responsive">
                    </div>
                </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
                <!-- START Left navbar-->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" data-trigger-resize="" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="material-icons">menu</em>
                        </a>
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                            <em class="material-icons">menu</em>
                        </a>
                    </li>
                </ul>
                <!-- END Left navbar-->
                <!-- START Right Navbar-->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Task -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Task -->
                </ul>
                <!-- #END# Right Navbar-->
            </div>
            <!-- #END# Nav wrapper-->
        </nav>
        <!-- END Top Navbar-->
    </header>
    <!-- sidebar-->
    @include('layouts.sidebar')

    <!-- Main section-->
        @yield('section')
    <!-- FOOTER-->
    <footer>
        <span>&copy; 2019 - HAPPY PRIZE By <a href="#" target="_blank"><b class="col-blue">PANITIA IPC GATHERING CABANG TANJUNG PRIOK - GOES TO BALI</b></a></span>
    </footer>
</div>
    <!-- CORE PLUGIN JS -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/vue.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/modernizr/modernizr.custom.js')}}"></script>
    <script src="{{asset('plugins/screenfull/dist/screenfull.js')}}"></script>
    <script src="{{asset('plugins/jQuery-Storage-API/jquery.storageapi.js')}}"></script>
    <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('plugins/node-waves/waves.js')}}"></script>
    
    <!-- LAYOUT JS -->
    <script src="{{asset('js/demo.js')}}"></script>
    <script src="{{asset('js/layout.js')}}"></script>

    <!-- THIS PAGE LEVEL JS -->
    @yield('script')

</body>

</html>