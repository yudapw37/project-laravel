<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <meta http-equiv="csrf-token" content="{{ csrf_token() }}" />

    <meta name="_token" content="{{csrf_token()}}" />

    <meta http-equiv="Cache-Control" content="no-store" />

    <meta name="keywords" content="jual rumah, sewa rumah, rumah idaman" />

    <meta name="author" content="cemara it solution" />

    <meta name="Description" content="Heppy Properti">

    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicons/site.webmanifest')}}">

    <!-- plugin scripts -->


    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">




    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vegas.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/nouislider.pips.css')}}">
    <link rel="stylesheet" href="{{asset('css/agrikol_iconl.css')}}">

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

</head>

<body>

    <div class="preloader">
        <img src="{{asset('/images/loader.png')}}" class="preloader__image" alt="">
    </div><!-- /.preloader -->
    <div class="page-wrapper">
        <div class="site_header__header_three_wrap">
            <div class="topbar-three" >
                <div class="container-box" style="background:#00000040">
                    <div class="topbar_three_content clearfix">
                        <div class="logo-box-three float-left">
                            <a href="index3.html" class="main-nag__logo">
                                <img src="{{asset('/images/resources/Logo_happy-property.png')}}" class="imgBan" alt="">
                            </a>
                        </div>

                        <div class="topbar_three_nav_box float-left">
                            <nav class="header-navigation stricky clearfix">
                                <div class="container">
                                  <div class="main_nav_header_three_content clearfix">
                                      <div class="mobile_menu_icon_three">
                                          <a href="#" class="side-menu__toggler">
                                              <i class="fa fa-bars"></i>
                                          </a>
                                      </div>
                                      <div class="main-nav__main-navigation three float-left">
                                          <ul class="main-nav__navigation-box">
                                              <li class="dropdown">
                                                  <a href="index3.html">Home</a>
                                              </li>
                                              <!--  -->
                                              <li class="dropdown">
                                                  <a href="projects.html">About</a>
                                                  <ul>
                                                      <li><a href="about.html">About Us</a></li>
                                                      <li><a href="farmers.html">Our Team</a></li>
                                                  </ul><!-- /.sub-menu -->
                                              </li>
                                              <li class="dropdown">
                                                  <a href="#">Our Product</a>
                                                  <ul>
                                                      <li><a href="product.html">Loan</a></li>
                                                      <li><a href="product.html">Sell</a></li>
                                                  </ul><!-- /.sub-menu -->
                                              </li>
                                              <!-- <li class="dropdown">
                                                  <a href="#">News</a>
                                                  <ul>
                                                      <li><a href="news.html">News</a></li>
                                                      <li><a href="news_detail.html">News Details</a></li>
                                                  </ul>
                                              </li> -->
                                              <li>
                                                  <a href="contact.html">Contact</a>
                                              </li>
                                          </ul>
                                      </div>

                                      <div class="main_nav_right_three float-right">
                                          <div class="icon_search_box hidden-lg hidden-md">
                                              <a href="#" class="main-nav__search search-popup__toggler"><i
                                                      class="icon-magnifying-glass"></i></a>
                                          </div>
                                          <div class="icon_cart_box">
                                              <a href="cart.html">
                                                  <span class="icon-shopping-cart"></span>
                                              </a>
                                          </div>
                                      </div>

                                  </div>
                                </div>
                            </nav>
                        </div>

                        <div class="topbar_three_right_box">
                            <div class="topbar-one__social home-four">
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                            </div>
                        </div>

                    </div>
                    <div class="conSearch">
                      <!-- <div style="padding: 10px 25px;background: #ffa600;border-radius:55px;"> -->
                        <table style="width:100%">
                        <tr>
                          <td style="width:100%">
                            <div class="input-group">
                              <input type="text" placeholder="cari . . . " class="form-control" name="" value="">
                              <div class="input-group-append hidden-lg hidden-md">
                                <button class="btn btn-base btnFilter" type="button" style="border-left: 1px solid #606060"> <span class="fa fa-cog"></span> </button>
                              </div>
                              <!-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2"> -->
                              <div class="input-group-append hidden-lg hidden-md">
                                <button class="btn btn-base" type="button" id="btnCari" style="border-left: 1px solid #606060"> <span class="fa fa-search"></span> </button>
                              </div>
                            </div>
                          </td>
                          <td class="hidden-sm hidden-xs">
                            <select class="custom-select" style="width:auto" name="">
                              <option value="" selected disabled>KOTA</option>
                              <option value="">Salatiga</option>
                              <option value="">Semarang</option>
                              <option value="">Kab Semarang</option>
                              <option value="">Kota jakarta Selatan</option>
                            </select>
                          </td>
                          <td class="hidden-sm hidden-xs">
                            <select class="custom-select" style="width:auto" disabled name="">
                              <option value="" selected disabled>AREA</option>
                              <option value="">Kota jakarta Selatan</option>

                            </select>
                          </td>
                          <td class="hidden-sm hidden-xs">
                            <button class="btn btn-base" type="button" style="width:80px;" id="button-addon2"> <span class="fa fa-search"> Cari</span> </button>
                          </td>
                        </tr>
                      </table>
                      <!-- </div> -->
                    </div>
                    <div class="conFilter" style="width:100%;display:none;padding:10px 25px 20px;">
                      <select class="custom-select" name="">
                        <option value="" selected disabled>KOTA</option>
                        <option value="">Salatiga</option>
                        <option value="">Semarang</option>
                        <option value="">Kab Semarang</option>
                        <option value="">Kota jakarta Selatan</option>
                      </select>
                      <select class="custom-select mt-2" disabled name="">
                        <option value="" selected disabled>AREA</option>
                        <option value="">Kota jakarta Selatan</option>

                      </select>
                    </div>
                </div>
            </div>
        </div>


    @yield('body')


        <footer class="site-footer">
            <div class="site-footer_farm_image"><img src="assets/images/resources/site-footer-farm.png"
                    alt="Farm Image"></div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="footer-widget__column footer-widget__about wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget__title">
                                <h3>About</h3>
                            </div>
                            <div class="footer-widget_about_text">
                                <p>Lorem ipsum dolor sit amet, adipiscing elit. Nulla placerat posuere dui. Pellentesque
                                    venenatis sem non lacus ac auctor.</p>
                            </div>
                            <form>
                                <div class="footer_input-box">
                                    <input type="Email" placeholder="Email Address">
                                    <button type="submit" class="button"><i class="fa fa-check"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer-widget__column footer-widget__link wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__title">
                                <h3>Explore</h3>
                            </div>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="service.html">Services</a></li>
                                <li><a href="projects.html">Our Projects</a></li>
                                <li><a href="farmers.html">Meet the Farmers</a></li>
                                <li><a href="news.html">Latest News</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget__column footer-widget__news wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__title">
                                <h3>News</h3>
                            </div>
                            <ul class="footer-widget__news list-unstyled">
                                <li>
                                    <div class="footer-widget__news_image">
                                        <img src="assets/images/resources/footer-1-img-1.jpg" alt="">
                                    </div>
                                    <div class="footer-widget__news_text">
                                        <p><a href="news_detail.html"> Learn 10 Best Tips for New Formers</a></p>
                                    </div>
                                    <div class="footer-widget__news_date_box">
                                        <p>30 Oct, 2019</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__news_image">
                                        <img src="assets/images/resources/footer-1-img-2.jpg" alt="">
                                    </div>
                                    <div class="footer-widget__news_text">
                                        <p><a href="news_detail.html">Farmer Sentiment Darkens Hopes Fade</a></p>
                                    </div>
                                    <div class="footer-widget__news_date_box">
                                        <p>30 Oct, 2019</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget__column footer-widget__contact wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget__title">
                                <h3>Contact</h3>
                            </div>
                            <div class="footer-widget_contact">
                                <p>66 Broklyn Street, New Town<br>DC 5752, New Yrok</p>
                                <a href="mailto:needhelp@agrikol.com">needhelp@agrikol.com</a><br>
                                <a href="tel:666-888-0000">666 888 0000</a>
                                <div class="site-footer__social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="site-footer_bottom">
            <div class="container">
                <div class="site-footer_bottom_copyright">
                    <p>@ All copyright 2020, <a href="#">Layerdrops.com</a></p>
                </div>
                <div class="site-footer_bottom_menu">
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>


    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <div class="side-menu__block">


        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">

                <a href="#" class="side-menu__toggler side-menu__close-btn"><img
                        src="{{asset('/images/shapes/close-1-1.png')}}" alt=""></a>
            </div><!-- /.side-menu__top -->


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
            <div class="side-menu__content">
                <p><a href="mailto:needhelp@tripo.com">needhelp@agrikol.com</a> <br> <a href="tel:888-999-0000">888 999
                        0000</a></p>
                <div class="side-menu__social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div><!-- /.side-menu__content -->
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->



    <div class="search-popup">
        <div class="search-popup__overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.search-popup__overlay -->
        <div class="search-popup__inner">
            <form action="#" class="search-popup__form">
                <input type="text" name="search" placeholder="Type here to Search....">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- /.search-popup__inner -->
    </div><!-- /.search-popup -->


    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/js/waypoints.min.js')}}"></script>
    <script src="{{asset('/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('/js/wow.js')}}"></script>
    <script src="{{asset('/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('/js/swiper.min.js')}}"></script>
    <script src="{{asset('/js/typed-2.0.11.js')}}"></script>
    <script src="{{asset('/js/vegas.min.js')}}"></script>
    <script src="{{asset('/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('/js/countdown.min.js')}}"></script>
    <script src="{{asset('/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('/js/nouislider.min.js')}}"></script>
    <script src="{{asset('/js/isotope.js')}}"></script>
    <script src="{{asset('/js/appear.js')}}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM"></script>


    <!-- template scripts -->
    <script src="{{asset('/js/theme.js')}}"></script>
</body>

</html>