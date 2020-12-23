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

    @yield('styles')
</head>

<body>
    <div class="container h-p100 mt-100">
        @yield('content')
        {{-- {{ $slot }} --}}
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

    @yield('scripts')

</body>

</html>
