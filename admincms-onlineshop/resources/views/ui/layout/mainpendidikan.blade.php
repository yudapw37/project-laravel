<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('images/icons/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{asset('images/icons/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/icons/favicon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/icons/favicon-114x114.png')}}">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/animate.css/animate.css')}}>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/jquery-lightbox/css/lightbox.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/owl-carousel/owl-carousel/owl.carousel.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/owl-carousel/owl-carousel/owl.theme.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/jquery-circliful/css/jquery.circliful.css')}}">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="{{asset('home/assets/css/themes/green.css')}}" id="theme-change" class="style-change color-change">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom" class="frontend-one-page">
    <!--BEGIN PAGE LOADER-->
    <!-- <div id="page-loader"><img src="http://swlabs.co/images/icon/preloader.gif" alt="" />
    </div> -->
    <!--END PAGE LOADER-->
    <!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN CONTENT-->

    @yield('body')

    <footer>
        <div class="container">
            <p class="text-center">Cemara IT Salatiga</p>
        </div>
    </footer>
    <!--END CONTENT-->
    <script src="{{asset('/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('/js/jquery-ui.js')}}"></script>
    <!--loading bootstrap js-->
    <script src="{{asset('/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js')}}"></script>
    <script src="{{asset('/js/html5shiv.js')}}"></script>
    <script src="{{asset('/js/respond.min.js')}}"></script>
    <script src="{{asset('/vendors/isotope/dist/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('/vendors/jquery.hoverdir.js')}}"></script>
    <script src="{{asset('/vendors/modernizr.custom.97074.js')}}"></script>
    <script src="{{asset('/vendors/jquery-lightbox/js/lightbox.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu6tm60TzeUo9rWpLnrQ7mrFn4JPMVje4&amp;sensor=false"></script>
    <script src="{{asset('/vendors/owl-carousel/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/vendors/jquery-circliful/js/jquery.circliful.min.js')}}"></script>
    <!--Loading script for each page-->
    <script src="{{asset('home/assets/plugins/jquery-backstretch/jquery.backstretch.min.js')}}"></script>
    <script src="{{asset('home/assets/js/one-page_slider.js')}}"></script>
    <!--CORE JAVASCRIPT-->
    <script src="{{asset('home/assets/js/jquery-text-effect.js')}}"></script>
    <script src="{{asset('/js/frontend-one-page.js')}}"></script>
</body>

</html>
