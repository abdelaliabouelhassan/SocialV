<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
{{--        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}

        <!-- Styles -->
        <link rel="shortcut icon" href="{{asset("images/favicon.ico")}}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
        <!-- Typography CSS -->
        <link rel="stylesheet" href="{{asset("css/typography.css")}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset("css/style.css")}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset("css/responsive.css")}}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

{{--        @livewireStyles--}}

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body class="sidebar-main-active right-column-fixed">
{{--        <div class="min-h-screen bg-gray-100">--}}
{{--            @livewire('navigation-dropdown')--}}

            <!-- Page Heading -->
{{--            <header class="bg-white shadow">--}}
{{--                <div  class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

            <!-- Page Content -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
            <main  id="app">
{{--                @yield("content")--}}
{{--                {{ $slot }}--}}
                <socialv></socialv>
            </main>
{{--        </div>--}}

        @stack('modals')

{{--        @livewireScripts--}}

        <script src="{{asset("js/jquery.min.js")}}"></script>
        <script src="{{asset("js/popper.min.js")}}"></script>
        <script src="{{asset("js/bootstrap.min.js")}}"></script>
        <!-- Appear JavaScript -->
        <script src="{{asset("js/jquery.appear.js")}}"></script>
        <!-- Countdown JavaScript -->
        <script src="{{asset("js/countdown.min.js")}}"></script>
        <!-- Counterup JavaScript -->
        <script src="{{asset("js/waypoints.min.js")}}"></script>
        <script src="{{asset("js/jquery.counterup.min.js")}}"></script>
        <!-- Wow JavaScript -->
        <script src="{{asset("js/wow.min.js")}}"></script>
        <!-- Apexcharts JavaScript -->
        <script src="{{asset("js/apexcharts.js")}}"></script>
        <!-- lottie JavaScript -->
        <script src="{{asset("js/lottie.js")}}"></script>
        <!-- Slick JavaScript -->
        <script src="{{asset("js/slick.min.js")}}"></script>
        <!-- Select2 JavaScript -->
        <script src="{{asset("js/select2.min.js")}}"></script>
        <!-- Owl Carousel JavaScript -->
        <script src="{{asset("js/owl.carousel.min.js")}}"></script>
        <!-- Magnific Popup JavaScript -->
        <script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
        <!-- Smooth Scrollbar JavaScript -->
        <script src="{{asset("js/smooth-scrollbar.js")}}"></script>
        <!-- Chart Custom JavaScript -->
        <script src="{{asset("js/chart-custom.js")}}"></script>
        <!-- Custom JavaScript -->
        <script src="{{asset("js/custom.js")}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
