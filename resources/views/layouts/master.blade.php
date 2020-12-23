<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') | {{ config('app.name', 'BC PUFF') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="https://www.upwork.com/freelancers/~018229318f5dcae047">

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">

    <style>
        .navbar {
            background-color: transparent !important;
        }

        .navbar .nav-link {
            color: #ffffff !important;
        }

        .search-input {
            background: none !important;
            border: 1px solid #ffffff !important;
            border-radius: unset;
        }

        .br-none {
            border-right: none !important;
        }

        .bl-none {
            border-left: none !important;
        }

        .main-footer a {
            display: inline;
        }
    </style>

    @yield('styles')

    <!--Braintree -->
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>

    <!-- Paypal -->
    <script src="{{ 'https://www.paypal.com/sdk/js?client-id=' . env('PAYPAL_CLIENT_ID') }}"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <div class="logo">
                <b><i>
                        <h1>BC PUFF</h1>
                    </i></b>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">CONTACT</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('faqs') }}">FAQS</a>
                </li> --}}

                <li class="btn-group nav-item d-lg-inline-flex d-none">
                    <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded full-screen"
                        title="Full Screen">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>

                @auth
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                        title="User" aria-expanded="true">
                        <i class="ti-user"></i>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('orders') }}">ORDERS</a>
                            @if(Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('admin.index') }}">ADMIN</a>
                            <a class="dropdown-item" href="{{ route('admin.products.create') }}">ADD PRODUCT</a>

                            <div class="dropdown-divider"></div>
                            @endif


                            <!-- LOGOUT FORM -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <!-- /LOGOUT FORM -->

                            <a class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                href="#"><i class="ti-lock text-muted mr-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                @endauth

                @guest
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                        title="User" aria-expanded="true">
                        <i class="ti-user"></i>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('login') }}">LOGIN</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('register') }}">REGISTER</a>
                        </li>
                    </ul>
                </li>
                @endguest

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        {{-- <img src="/img/cart.png" width="30px" height="30px"> --}}
                        @if (count((array) session('cart')) > 0)
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="badge badge-pill badge-danger">
                            {{ count((array) session('cart')) }}
                        </span>
                        @endif
                    </a>
                </li>
            </ul>

            <li class="nav-item btn-group d-lg-inline-flex d-none">
                <div class="app-menu">
                    <div class="search-bx mx-5">
                        <form action="{{ route('search') }}" method="GET">
                            @csrf

                            <div class="input-group">
                                <input type="search" name="query" class="search-input br-none form-control"
                                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <div class="search-input bl-none input-group-append">
                                    <button class="btn" type="submit" id="button-addon3"><i
                                            class="ti-search text-light"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </div>
    </nav>

    <div class="wrapper">
        <div class="content-wrapper">
            @yield('content')

            <footer class="main-footer">
                <div class="pull-right d-none d-sm-inline-block">
                    <ul
                        class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">FAQ</a>
                        </li>
                    </ul>
                </div>
                © {{ date('Y') }} <a href="https://www.bcpuff.com/">BCPUFF STORE</a>. All Rights Reserved.
            </footer>
        </div>
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/jquery.peity/jquery.peity.js') }}"></script>

    <!-- Florence Admin App -->
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>


    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('includes.modals')

    <!----------js for toggle menu----------->

    {{-- <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px")
                {
                    MenuItems.style.maxHeight = "200px";
                }
            else
                {
                    MenuItems.style.maxHeight = "0px";
                }
        }
    </script> --}}

    @yield('scripts')

</body>

</html>