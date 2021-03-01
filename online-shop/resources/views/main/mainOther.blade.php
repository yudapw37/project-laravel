<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="csrf-token" content="{{ csrf_token() }}" />
    <meta name="_token" content="{{csrf_token()}}" />
    <meta http-equiv="Cache-Control" content="no-store" />
    <meta name="keywords" content="book, buku, islam, buku islam, aqwam, solo" />
    <meta name="author" content="cemara it solution" />
    <meta name="Description" content="Aqwam Book Store">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('dist/css/bootstrap-select.css')}}"> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
  </head>
  <body>
    <p class="text-left " hidden style="font-size:12px;"><span id="urlimage">{{$urlImage}}</span></p>
      <!-- push menu-->
    <div class="pushmenu menu-home5">
        <div class="menu-push">
            <span class="close-left js-close"><i class="icon-close f-20"></i></span>
            <div class="clearfix"></div>
            <!-- <form role="search" method="get" id="searchform" class="searchform" action="/search">
                <div>
                    <label class="screen-reader-text" for="q"></label>
                    <input type="text" placeholder="Search for products" value="" name="q" id="q" autocomplete="off">
                    <input type="hidden" name="type" value="product">
                    <button type="submit" id="searchsubmit"><i class="ion-ios-search-strong"></i></button>
                </div>
            </form> -->
            <ul class="nav-home5 js-menubar">
                <li class="level1 active dropdown"><a href="/">Home</a>
                </li>
                 <li class="level1 active dropdown">
                  <a href="#">Akun</a>
                  <span class="icon-sub-menu"></span>
                  <ul class="menu-level1 js-open-menu">
                  @if ($nama != 'null')
                        <li class="level2"><a href="/akun" style="cursor:pointer">Akun</a></li>
                        <li class="level2"><a href="/logout" style="cursor:pointer">Keluar</a></li>
                  @else
                        <li class="level2"><a href="/login" title="">Login Akun</a></li>
                        <li class="level2"><a href="/register" title="">Register Akun</a></li>
                  @endif
                  </ul>
                </li>
                <?php
                $url = Request::segment(1) ;
                // echo $url;
                if ($url ==  'akun') { ?>
                  <li class="level1 active dropdown">
                   <a href="#">Menu Akun</a>
                   <span class="icon-sub-menu"></span>
                   <ul class="menu-level1 js-open-menu">
                      <li class="level2" onclick="midBox('Invoice')"><a style="cursor:pointer">Invoice</a></li>
                      <li class="level2" onclick="midBox('Wishlist')"><a style="cursor:pointer">Wishlist</a></li>
                      <li class="level2" onclick="midBox('Order')"><a style="cursor:pointer">Order</a></li>
                      <li class="level2" onclick="midBox('Order History')"><a style="cursor:pointer">Order History</a></li>
                      <li class="level2" onclick="midBox('Alamat')"><a style="cursor:pointer">Alamat</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <li class="level1 active dropdown"><a href="#">Categories</a>
                    <span class="icon-sub-menu"></span>
                    <ul class="menu-level1 js-open-menu" id="categoriesmenu">
                        <li class="level2"><a href="/search?id=1" title="">Semua Tema</a></li>
                        <li class="level2"><a href="/katalog/IP001?id=2" title="">Penerbit</a></li>
                        @if ($promoviewhome==1)
                        <li class="level2"><a href="/katalog/allpromo?id=3" title="">Promo</a></li>
                        @endif
                    </ul>
                </li>
                <li class="level1 active dropdown"><a href="/trace">Lacak Pesanan</a>
                </li>
            </ul>
        </div>
    </div>
   <!-- end push menu-->
    <div class="wrappage">
      <header id="header" class="header-v1">
        <div class="header-center">
          <div class="container container-240">
            <div class="row flex comMidHdr">
              <div class="col-lg-3 col-md-3  col-sm-12 col-xs-12 v-center header-logo">
                <div class="imgHeaderCon">
                  <div class="hidden-md hidden-lg" style="display:flex;justify-content:space-between;">
                    <div class=" imgHeaderConMb">
                      <a href="#" class="icon-pushmenu js-push-menu">
                        <i style="color:white;font-size:30px;" class="fa fa-bars"></i>
                      </a>
                      <a style="color:white; margin-left: 10px;font-size: 19px;margin-top: 1px;" href="#">
                        <div class="">
                          <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </div>
                      </a>
                    </div>
                    <div class="">
                      <a href="/">
                        <div style="z-index:999">
                          <img src="{{$getBaseUrl}}img/logoAqwamList.png" alt="" class="mImgHdr">
                        </div>
                      </a>

                    </div>
                    <div class="mMidRghtPanel">
                      <div class="" style="margin-right:10px;">
                        <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label2">
                          @if ($nama == 'null')
                          <a href="/login"><img style="width:26px;" src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
                          <div id="btnAkunConM" class="d-none" style="cursor:pointer">
                            <a id="btnAkunIns" href="/akun">Akun</a>
                          </div>
                          <div id="btnKeluarConM" class="d-none" style="cursor:pointer">
                            <a id="btnKeluarIns" href="/logout">Keluar</a>
                          </div>
                          @else
                          <div class="dropdownLgn">
                            <a href="#" class=""><img style="width:26px;" src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
                            <div class="dropdown-contentLgn text-center">
                              <div id="btnAkunConM" class="ddCon" style="cursor:pointer">
                                <a id="btnAkunIns" href="/akun">Akun</a>
                              </div>
                              <div id="btnKeluarConM" class="ddCon" style="cursor:pointer">
                                <a id="btnKeluarIns" href="/logout">Keluar</a>
                              </div>
                            </div>
                          </div>
                          @endif
                        </a>
                      </div>
                      <div class="cart" style="margin-top:4px">
                        <a href="#" class="dropdown-toggle cartdropdownget" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" id="cartdropdownget">
                          <img style="width:25px;min-width:25px;" src="{{$getBaseUrl}}img/cart-w.png" alt="">
                          @if ($countCart != 'null')
                          <span id="cartcount" class="count cart-count"> {{$countCart}} </span>
                          @endif
                        </a>
                        @if ($countCart != 'null')
                        <div class="dropdown-menu dropdown-cart cartdropdown" id="cartdropdown">
                          <ul class="mini-products-list cartvalue" style="overflow: auto; max-height: 250px !important;" id="cartvalue">

                          </ul>
                          <div class="bottom-cart" style="margin-bottom:-50px; margin-top:-20px; padding:10px">
                            <div class="cart-price">
                              <span style="margin-top: 5px;" id="countcartjs"></span>
                              <span class="price-total" ><a href="/cartall" class="btn btn-gradient">Lihat Sekarang</a></span>
                            </div>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <a href="/" class="hidden-sm hidden-xs" style="display:flex;justify-content:center">
                    <img src="{{$getBaseUrl}}img/logo_store_aqwam.png" alt="" class="imgHeader">
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 v-center header-search hidden-xs hidden-sm">
                <form method="get" class="ajax-search hSearch" action="/search" role="search">
                    <div class="hSearch1">
                      <button type="submit" aria-label="search"><i class="ion-ios-search-strong"></i></button>
                    </div>
                    <div class="hSearch2">
                      <div ></div>
                    </div>
                    <input class="hSearch3" type="text" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" name="q" placeholder="Membantu Anda Belajar Islam">
                </form>
                <!-- <form method="get" class="searchform ajax-search" style="margin-left: 10px!important;" action="/search" role="search">
                    <input type="text" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" name="q" class="form-control" placeholder="Saya ingin buku...">
                    <div style="cursor: default" class="search-panel"> </div>
                    <span class="input-group-btn">
                      <button class="button_search" type="submit" aria-label="search"><i class="ion-ios-search-strong"></i></button>
                    </span>
                </form> -->
              </div>
              <div class="col-lg-2  col-md-2 hidden-xs hidden-sm v-center header-sub" style="padding:0!important">
                  <div class="right-panel">
                      <div class="header-sub-element row" style="margin-right:15px!important">
                        <!-- <a id="label2" class="dropdown-toggle hidden-sm hidden-xs" style="padding-right: 5px" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label2"> -->
                            <!-- <img style="width:19px;min-width:19px;" src="img/icon-l.png" alt=""> -->
                            @if ($nama == 'null')
                            <a href="/login" style="padding: 0px;" class="hidden-sm hidden-xs"><div class="boxDDLgn">Masuk</div></a>
                            <div id="btnAkunCon" class="d-none" style="cursor:pointer">
                              <a id="btnAkunIns">Akun</a>
                            </div>
                            <div id="btnKeluarCon" class="d-none" style="cursor:pointer">
                              <a id="btnKeluarIns">Keluar</a>
                            </div>
                            @else
                                <!-- <a href="/akun">{{$nama}}</a> -->
                                <div class="dropdownLgn hidden-sm hidden-xs">
                                  <a href="#" >
                                    <div class="boxDDLgn">
                                      @if (strlen($nama) > 9)
                                      {{substr($nama,0, 9).' ...'}}
                                      @else
                                      {{($nama)}}
                                      @endif
                                    </div>
                                  </a>
                                  <div class="dropdown-contentLgn text-center">
                                      <a id="btnAkunIns" href="/akun">
                                        <div id="btnAkunCon" class="ddCon">Akun</div>
                                      </a>
                                      <a id="btnKeluarIns" href="/logout">
                                        <div id="btnKeluarCon" class="ddCon">Keluar</div>
                                      </a>
                                  </div>
                                </div>
                            @endif
                        <!-- </a> -->
                          <div class="hidden-lg hidden-md d-none" style="margin-right:10px;">
                            <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label2">
                                @if ($nama == 'null')
                                <a href="/login"><img style="width:26px;" src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
                                <div id="btnAkunConM" class="d-none" style="cursor:pointer">
                                  <a id="btnAkunIns" href="/akun">Akun</a>
                                </div>
                                <div id="btnKeluarConM" class="d-none" style="cursor:pointer">
                                  <a id="btnKeluarIns" href="/logout">Keluar</a>
                                </div>
                                @else
                                    <div class="dropdownLgn">
                                      <a href="#" class=""><img style="width:26px;" src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
                                      <div class="dropdown-contentLgn text-center">
                                        <div id="btnAkunConM" class="ddCon" style="cursor:pointer">
                                          <a id="btnAkunIns" href="/akun">Akun</a>
                                        </div>
                                        <div id="btnKeluarConM" class="ddCon" style="cursor:pointer">
                                          <a id="btnKeluarIns" href="/logout">Keluar</a>
                                        </div>
                                      </div>
                                    </div>
                                @endif
                            </a>
                          </div>
                          <div class="hidden-xs hidden-sm cart">
                              <a href="#" class="dropdown-toggle cartdropdownget" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="cartdropdownget">
                                  <img style="width:25px;min-width:25px;" src="{{$getBaseUrl}}img/icon-cart.png" alt="">
                                  @if ($countCart != 'null')
                                  <span id="cartcount2" class="count cart-count"> {{$countCart}} </span>
                                  @endif
                              </a>
                              @if ($countCart != 'null')
                              <div class="dropdown-menu dropdown-cart cartdropdown" id="cartdropdown">
                                  <ul class="mini-products-list cartvalue" style="overflow: auto; max-height: 250px !important;" id="cartvalue2">

                                  </ul>
                                  <div class="bottom-cart" style="margin-bottom:-50px; margin-top:-20px; padding:10px">
                                      <div class="cart-price">
                                          <span style="margin-top: 5px;" id="countcartjs"></span>
                                          <span class="price-total" ><a href="/cartall" class="btn btn-gradient">Lihat Sekarang</a></span>
                                      </div>
                                  </div>
                              </div>
                              @endif
                          </div>
                          <div class="btmLftHdr">
                            <a class="whatsapp" href="#">
                              <div class="wa">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a class="instagram" href="#">
                              <div class="ig">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a class="youtube" href="#">
                              <div class="yt">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a class="facebook" href="#">
                              <div class="fb">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                              </div>
                            </a>
                            <a class="blog" href="#">
                              <div class="bg">
                                <i class="fa fa-rss" aria-hidden="true"></i>
                              </div>
                            </a>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- <br style="clear:both" /> -->
            <div style="position: absolute;width:100%;left: 0;padding: 5px 20px;background: white;border-bottom: 1px solid black;" class="hidden-md hidden-lg" >
              <table style="width:100%">
                <tr>
                  <td>
                    <form method="get" class="ajax-search hSearch" action="/search" role="search">
                      <div class="hSearch1" style="">
                        <button type="submit" aria-label="search"><i class="ion-ios-search-strong"></i></button>
                      </div>
                      <div class="hSearch2" style="padding: 10px 15px 10px 5px;">
                        <div></div>
                      </div>
                      <input class="hSearch3" type="text" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" name="q" placeholder="Membantu Anda Belajar Islam">
                    </form>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="header-bottom hidden-xs hidden-sm">
          <div class="container container-240">
            <div class="conBtmRgHdr">
              <div class="btmRgHdr">
                @if ($promoviewhome==1)
                <a href="/katalog/allpromo">
                  <div>
                    PROMO
                  </div>
                </a>
                @endif
                <a href="/katalog/best">
                  <div>
                    BUKU TERLARIS
                  </div>
                </a>
                <a href="/katalog/baru">
                  <div>
                    BUKU TERBARU
                  </div>
                </a>
                <a href="/trace">
                  <div>
                    LACAK PESANAN
                  </div>
                </a>
              </div>
              <!-- <div class="btmLftHdr">
                <a class="whatsapp" href="#">
                  <div class="wa">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                  </div>
                </a>
                <a class="instagram" href="#">
                  <div class="ig">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </div>
                </a>
                <a class="youtube" href="#">
                  <div class="yt">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </div>
                </a>
                <a class="facebook" href="#">
                  <div class="fb">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </div>
                </a>
                <a class="blog" href="#">
                  <div class="bg">
                    <i class="fa fa-rss" aria-hidden="true"></i>
                  </div>
                </a>
              </div> -->
            </div>
          </div>
        </div>

        <div id="hdrBtm" class="header-bottom d-none hidden-xs hidden-sm">
          <div class="container container-240">
            <div class="row flex lr2">
                <div class="col-lg-3 widget-verticalmenu">
                  <div class="navbar-vertical">
                    <button id="catVer" onclick="catVer" class="navbar-toggles"><span>Categories</span></button>
                  </div>
                  <div id="verHide" class="vertical-wrapper">
                      <ul class="vertical-group" id ="categories">
                      </ul>
                  </div>
                </div>
                <div class="col-lg-9 widget-left">
                  <div class="flex lr">
                    <nav class="main-menu">
                      <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                          <li class="level1"><a href="/katalog/promo1"><img src="{{$getBaseUrl}}img/icon-diamond.png" alt="">Promo Bulan Ini<span class="h-ribbon h-pos e-red">Hot</span></a></li>
                          <li class="level1"><a href="/katalog/baru">Buku Terbaru<span class="h-ribbon h-pos e-skyblue">New</span></a></li>
                        </ul>
                      </div>
                    </nav>
                    <div class="header-bottom-right hidden-xs hidden-sm">
                      <img src="{{$getBaseUrl}}img/icon-ship.png" alt="" class="img-reponsive">
                      <span>Banyak Promo Jika Membeli Banyak</span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </header>
      <div class="main-head"></div>
      @yield('body')
    </div>
      <!-- <div class="foot">
      </div> -->
      <footer>
        <div class="feature">
          <div class="container container-240">
            <img src="{{$getBaseUrl}}img/banner/banner_down.png" alt="" class="img-responsive">
          </div>
        </div>
        <div class="bgnFooter">
          <div class="container container-240">
            <div class="row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="conFooter1">
                      <img src="{{$getBaseUrl}}img/aqwam_putih.png" alt="" class="img-reponsive" >
                      <p>Membantu Anda Belajar Islam</p>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="confootImprintTxt">
                      <h4>IMPRINT</h4>
                    </div>
                    <div class="confootImprintImg">
                      <span>
                        <img src="{{$getBaseUrl}}img/imprintImg/01.png" alt="" class="img-reponsive" >
                      </span>
                      <span class="qry1">
                        <img src="{{$getBaseUrl}}img/imprintImg/02.png" alt="" class="img-reponsive" >
                      </span>
                      <span class="qry">
                        <img src="{{$getBaseUrl}}img/imprintImg/05.png" alt="" class="img-reponsive" >
                      </span>
                      <span class="qry">
                        <img src="{{$getBaseUrl}}img/imprintImg/07.png" alt="" class="img-reponsive" >
                      </span>
                      <span>
                        <img src="{{$getBaseUrl}}img/imprintImg/03.png" alt="" class="img-reponsive" >
                      </span>
                      <span>
                        <img src="{{$getBaseUrl}}img/imprintImg/06.png" alt="" class="img-reponsive" >
                      </span>
                      <span>
                        <img src="{{$getBaseUrl}}img/imprintImg/04.png" alt="" class="img-reponsive" >
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row" style="padding-top: 20px;">
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="conFooter2">
                      <div style="width:100%;max-width:330px">
                        <p><span class="red">Kantor Pusat (Solo)</span></p>
                        <p>Jl. Menco Raya 112, Gonilan, Kartasura - Solo 57169 (+62.271) 765 3000</p>
                        <br>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="conFooter2">
                      <div style="width:100%;max-width:330px">
                        <p><span class="red">Kantor Cabang (Jakarta)</span></p>
                        <p>Jl. Pondok Ranggon No. 17 RT. 002/RW. 006, Kec. Cipayung, Jakarta Timur 13860 (+62.21) 845 94931</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="conFooter2">
                      <div style="padding:20px 5px;max-width:350px;">
                        <span class="red">Berlangganan</span>
                        <br>
                        Masukkan Nomor WA Anda
                        untuk menerima informasi
                        dan promo menarik dari kami.
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="conFooter2">
                      <div style="padding:20px 5px;max-width:350px;width:100%">
                        <form class="form_newsletter" action="/subscribe" method="post">
                          @csrf
                          <input type="hp" value="" placeholder="Masukkan No Hp anda" name="text" id="text" class="form-control @error('text') is-invalid @enderror">
                          @error('text') <div class="invalid-feedback" style="color:red"> {{ $errors->first('text') }}</div> @enderror
                          <center>
                            <button id="subscribe2" class="button_mini mt-1 btn btn-primary" style="padding: 5px 50px!important;"  type="submit">
                              SIMPAN
                            </button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="f-top d-none">
            <div class="container container-240">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="footer-block footer-about">
                          <div class="f-logo" style="text-align:center">
                              <a href="#"><img src="{{$getBaseUrl}}img/aqwam_putih.png" alt="" class="img-reponsive" style="max-height:120px"></a>
                          </div>
                          <ul class="footer-block-content" style="text-align:center">
                            <li class="moto">
                              <span>AQWAM STORE - Jembatan Ilmu. <br> Belajar Islam dari Sumbernya</span>
                            </li>
                          </ul>
                            <div class="footer-social social">
                                <h3 class="footer-block-title">Follow us</h3>
                                <a href="#" class="fa fa-twitter"></a>
                                <a href="#" class="fa fa-dribbble"></a>
                                <a href="#" class="fa fa-behance"></a>
                                <a href="#" class="fa fa-instagram"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer-block">
                        <div class="footer-block-newsletter">
                            <h3 class="footer-block-title">Kantor Pusat (Solo)</h3>
                            <ul>
                            <li class="address" >
                                <span>{{$footeraddrs1->text}}</span>
                            </li>
                            <li class="phone" >
                                <span>{{$footerphone1->text}}</span>
                            </li>
                            </ul>
                        </div>
                        <br>
                        <br>
                        <div class="footer-block-newsletter">
                            <h3 class="footer-block-title">Kantor Cabang (Jakarta)</h3>
                             <ul>
                            <li class="address" >
                                <span>{{$footeraddrs2->text}}</span>
                            </li>
                            <li class="phone" >
                                <span>{{$footerphone2->text}}</span>
                            </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="footer-block">
                            <div class="footer-block-newsletter">
                                <h3 class="footer-block-title">Berlangganan</h3>
                                <p>Masukkan No Wa Anda untuk menerima pembaruan harian langsung ke Wa Anda</p>
                                <form class="form_newsletter" action="/subscribe" method="post">
                                @csrf
                                    <input type="hp" value="" placeholder="Masukkan No Hp anda" name="text" id="text" class="form-control @error('text') is-invalid @enderror">
                                    @error('text') <div class="invalid-feedback" style="color:red"> {{ $errors->first('text') }}</div> @enderror
                                    <button id="subscribe2" class="button_mini btn btn-gradient" type="submit">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="f-bottom">

            <div class="container container-240">

                <div class="row flex lr">

                <!-- <center> -->

                    <div class="col-xs-6 f-copyright text-center"><span>© 2020 Cemara IT Solution.</span></div>


                </div>

            </div>

        </div>
      </footer>
        <a href="#" class="btn-gradient scroll_top"><i class="ion-ios-arrow-up"></i></a>
        <script src="{{asset('/js/jquery.js')}}"></script>
        <script src="{{asset('/js/bootstrap.js')}}"></script>
        <!-- <script src="{{asset('/js/getHeaderFooter.js')}}"></script> -->
        <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/js/store.js')}}"></script>
        <script src="{{asset('/js/slick.js')}}"></script>
        <script src="{{asset('/js/countdown.js')}}"></script>
        <script src="{{asset('/js/main.js')}}"></script>
        <script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('dist/js/bootstrap-select.min.js')}}"></script>
    <!-- </div> -->
    <script>
      window.onscroll = function() {scrollHeader()};
      function scrollHeader(){
        var pathname = window.location.pathname;
        var scrll = 40;
        if (pathname == '/') {
          scrll = 100;
        }
        if (document.body.scrollTop > scrll || document.documentElement.scrollTop > scrll) {
          document.querySelector(".header-bottom").style["box-shadow"] = "0px 5px 5px rgb(39 39 39 / 21%)";

          document.querySelector(".imgHeader").style['position'] = "absolute";

          document.querySelector(".imgHeader").style['top'] = "0";
          // document.querySelector(".imgHeader").style['left'] = "0";

          // document.querySelector(".imgHeader").style['height'] = "60px";
          document.querySelector(".mImgHdr").style['height'] = "37px";

          document.querySelector(".imgHeader").style['margin'] = "0";
          document.querySelector(".mImgHdr").style['margin-top'] = "4px";
          document.querySelector(".comMidHdr").style['margin-top'] = "0";
          document.querySelector(".comMidHdr").classList.add('mobMargin')
          document.querySelector(".mMidRghtPanel").style['margin-top'] = "8px";
          document.querySelector(".btmLftHdr").style['margin-top'] = "40px";
          document.querySelector(".comMidHdr").style['margin-bottom'] = "0px";

          document.querySelector(".hSearch1").style['font-size'] = "20px";
          document.querySelector(".hSearch3").style['font-size'] = "12px";
          document.querySelector(".btmRgHdr").style['font-size'] = "12px";

          document.querySelector(".header-bottom").style.border = "none";
          document.querySelector(".hSearch1").style['border-radius'] = "5px 0 0 5px";
          document.querySelector(".hSearch3").style['border-radius'] = "0 5px 5px 0";

          document.querySelector(".hSearch2").style['padding'] = "5px 15px 5px 5px";
          document.querySelector(".imgHeaderConMb").style['padding'] = "8px 0";
          document.querySelector(".conBtmRgHdr").style['padding'] = "0 0 5px";

        }else {
          document.querySelector(".header-bottom").style["box-shadow"] = "none";
          // setTimeout( (document.querySelector(".imgHeader").style['position'] = "relative"), 1000)


          // document.querySelector(".imgHeader").style['height'] = "60px";
          document.querySelector(".mImgHdr").style['height'] = "45px";

          document.querySelector(".imgHeader").style['margin'] = "auto";
          document.querySelector(".mImgHdr").style['margin-top'] = "-8px";
          document.querySelector(".comMidHdr").classList.remove('mobMargin')
          document.querySelector(".comMidHdr").style['margin-top'] = "1em";
          document.querySelector(".mMidRghtPanel").style['margin-top'] = "0";
          document.querySelector(".btmLftHdr").style['margin-top'] = "55px";
          document.querySelector(".comMidHdr").style['margin-bottom'] = "0.5em";

          document.querySelector(".hSearch1").style['font-size'] = "40px";
          document.querySelector(".hSearch3").style['font-size'] = "15px";
          document.querySelector(".btmRgHdr").style['font-size'] = "14px";

          document.querySelector(".header-bottom").style["border-bottom"] = "0.5px solid #c0c0c08a";
          document.querySelector(".hSearch1").style['border-radius'] = "15px 0 0 15px";
          document.querySelector(".hSearch3").style['border-radius'] = "0 15px 15px 0";

          document.querySelector(".hSearch2").style['padding'] = "10px 15px 10px 5px";
          document.querySelector(".imgHeaderConMb").style['padding'] = "0";
          document.querySelector(".conBtmRgHdr").style['padding'] = "0";


        }
      }
      // $('.goSec').on('click', function() {
      //   $('html, body').animate({
      //       scrollTop: $( $(this).attr('href') ).offset().top-150
      //   }, 700);
      //   return false;
      // });

      var imageurl=document.getElementById("urlimage").innerHTML,a=$("#cartcount").data("cartcount");$(document).ready(function(){$(".addcart").click(function(){var o=$(this).data("id");o?$.ajax({url:"{{url('cart/')}}/"+o,type:"GET",success:function(o){"sukses"==o?(Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Ditambahkan ke Keranjang",showConfirmButton:!1,timer:1500}),$.ajax({url:"{{url('cartcount')}}",type:"GET",success:function(o){console.log(o),1==o&&location.reload(),document.getElementById("cartcount").innerHTML=o,document.getElementById("cartcount2").innerHTML=o}})):"login"==o?Swal.fire({title:"Anda harus login dahulu",icon:"info",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ok, Login"}).then(o=>{o.isConfirmed&&(console.log("login"),window.location.href="{{URL::to('login/')}}")}):(console.log(o),Swal.fire({position:"bottom-end",icon:"info",title:o,showConfirmButton:!1,timer:2e3}))}}):console.log("Error")})}),$(document).ready(function(){$(".addwishlist").click(function(){var o=$(this).data("id");o?$.ajax({url:"{{url('wishlist/')}}/"+o,type:"GET",success:function(o){"sukses"==o?Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Ditambahkan ke Favorit",showConfirmButton:!1,timer:1500}):"login"==o?Swal.fire({title:"Anda harus login dahulu",icon:"info",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ok, Login"}).then(o=>{o.isConfirmed&&(console.log("login"),window.location.href="{{URL::to('login/')}}")}):(console.log(o),Swal.fire({position:"bottom-end",icon:"info",title:o,showConfirmButton:!1,timer:2e3}))}}):console.log("Error")})}),$(document).ready(function(){$(".cartdropdownget").click(function(){$.ajax({url:"{{url('cart')}}/",type:"GET",success:function(o){var t="";for(i in variable=o,variable)t+="<li class='item-cart'><div class='product-img-wrap'><a href=''><img src='"+imageurl+variable[i].gambar_buku+"' alt='' class='img-reponsive'></a></div><div class='product-details'><div class='inner-left'><div class='product-name'><a href=''>"+variable[i].judul_buku+"</a></div><span>( x1)</span><div class='product-price' style='color:red; text-align: right !important;'>"+variable[i].harga+"</div></div></div></li>";document.getElementById("cartvalue").innerHTML=t;document.getElementById("cartvalue2").innerHTML=t}}),$.ajax({url:"{{url('cartcount')}}/",type:"GET",success:function(o){variable=o,document.getElementById("countcartjs").innerHTML="Keranjang ("+variable+")"}})})});
    </script>
  </body>
</html>
