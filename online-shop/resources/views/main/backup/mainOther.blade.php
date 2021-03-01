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

    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-select.css')}}">

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->

</head>



<style media="screen">

    <?php

        // $login = 1;

        //     if ($login == 1) {

        //     echo "

        //         .product-button-group{

        //         display: none!important;

        //         }

        //     ";

        // }

    ?>

</style>



<body>

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
                      <?php
                      $url = Request::url();
                      // echo substr($nama,strpos($nama, 'm/')+2);
                      if (substr($url,strpos($url, 'm/')+2) == 'akun') { ?>
                        <li class="level2" onclick="midBox('Invoice')"><a style="cursor:pointer">Invoice</a></li>
                        <li class="level2" onclick="midBox('Wishlist')"><a style="cursor:pointer">Wishlist</a></li>
                        <li class="level2" onclick="midBox('Order')"><a style="cursor:pointer">Order</a></li>
                        <li class="level2" onclick="midBox('Order History')"><a style="cursor:pointer">Order History</a></li>
                        <li class="level2" onclick="midBox('Alamat')"><a style="cursor:pointer">Alamat</a></li>
                      <?php }else { ?>
                        <li class="level2"><a href="/akun" style="cursor:pointer">Akun</a></li>
                      <?php } ?>
                        <li class="level2"><a href="/logout" style="cursor:pointer">Keluar</a></li>
                  @else
                        <li class="level2"><a href="/login" title="">Login Akun</a></li>

                        <li class="level2"><a href="/register" title="">Register Akun</a></li>

                  @endif
                </ul>
                </li>

                <li class="level1 active dropdown"><a href="#">Categories</a>

                    <span class="icon-sub-menu"></span>

                    <ul class="menu-level1 js-open-menu" id="categoriesmenu">

                        <li class="level2"><a href="/login" title="">Login Akun</a></li>

                        <li class="level2"><a href="/register" title="">Register Akun</a></li>
                    </ul>

                </li>

            </ul>

        </div>

    </div>

 <!-- end push menu-->

        <div class="wrappage">

            <header id="header" class="header-v1">

                <div class="topbar hidden-xs hidden-sm">

                    <div class="container container-240">

                        <div class="row flex">

                            <div class="col-md-6 col-sm-6 col-xs-4 flex-left">

                                <div class="topbar-left">

                                    <div class="element element-store hidden-xs hidden-sm">

                                        <a id="label1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                                        <img src="{{$getBaseUrl}}img/icon-map.png" alt="">

                                        <span>Store Location</span>



                                        </a>

                                    </div>

                                    <div class="element hidden-xs hidden-sm">

                                        <a href="#"><img src="{{$getBaseUrl}}img/icon-track.png" alt=""><span>Track Your Order</span></a>

                                    </div>

                                    <div class="element element-account hidden-md hidden-lg">

                                        <a href="#">My Account</a>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-8 flex-right">

                                <div class="topbar-right">

                                    <div class="element hidden-xs hidden-sm">

                                        <a href="#">Blog Aqwam </a>

                                    </div>

                                    <div class="element hidden-xs hidden-sm">

                                        <a href="#">Tv Aqwam</a>

                                    </div>

                                    <div class="element element-leaguage">

                                        <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label2">

                                            <img src="{{$getBaseUrl}}img/icon-l.png" alt="">

                                            @if ($nama == 'null')
                                            <a href="/login">Login Akun</a>
                                            <div id="btnAkunCon" class="d-none" style="cursor:pointer">
                                              <a id="btnAkunIns">Akun</a>
                                            </div>
                                            <div id="btnKeluarCon" class="d-none" style="cursor:pointer">
                                              <a id="btnKeluarIns">Keluar</a>
                                            </div>
                                            @else
                                                <div class="dropdownLgn">
                                                  <a href="" class="">{{$nama}}</a>
                                                  <div class="dropdown-contentLgn text-center">
                                                    <div id="btnAkunCon" class="ddCon" style="cursor:pointer">
                                                      <a id="btnAkunIns" href="/akun">Akun</a>
                                                    </div>
                                                    <div id="btnKeluarCon" class="ddCon" style="cursor:pointer">
                                                      <a id="btnKeluarIns" href="/logout">Keluar</a>
                                                    </div>
                                                  </div>
                                                </div>
                                            @endif



                                        </a>

                                    </div>

                                   <div class="element element-currency">

                                        <a id="label3" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label3">



                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="header-center">

                    <div class="container container-240">

                    <div class="row flex">



                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 v-center header-logo">
                              <div class="imgHeaderCon">
                                <a href="/">
                                  <img src="{{$getBaseUrl}}img/aqwam_putih.png" alt="" class="imgHeader">
                                </a>
                              </div>
                            </div>

                            <div class="col-lg-7 col-md-7 v-center header-search hidden-xs hidden-sm">

                                <form method="get" class="searchform ajax-search" action="/search" role="search">

                                    <!-- <input type="hidden" name="type" value="product"> -->

                                    <input type="text" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" name="q" class="form-control" placeholder="Saya ingin buku...">


                                    <div style="cursor: default" class="search-panel">



                                    </div>

                                    <span class="input-group-btn">

                                            <button class="button_search" type="button" aria-label="search"><i class="ion-ios-search-strong"></i></button>

                                    </span>

                                </form>

                            </div>

                            <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6 v-center header-sub">

                                <div class="right-panel">

                                    <div class="header-sub-element row">

                                    <div class="sub-left hidden-xs hidden-sm">

                                        <img src="{{$getBaseUrl}}img/icon-call.png" alt="">

                                    </div>

                                    <div class="sub-right hidden-xs hidden-sm" style="font-size: 15px;margin-right:20px">

                                        <span>Call Us Free</span>

                                        <div id = 'headerPhone'>{{$headerphone->text}}</div>

                                    </div>

                                    <div class="hidden-lg hidden-md" style="margin-right:10px;">
                                      <!-- <a href="/akun"><img src="img/co-login.png" alt=""></a> -->
                                      <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="label2">
                                          @if ($nama == 'null')
                                          <a href="/login"><img src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
                                          @else
                                              <!-- <a href="/akun">{{$nama}}</a> -->
                                              <div class="dropdownLgn">
                                                <a href="#" class=""><img src="{{$getBaseUrl}}img/icon-l.png" alt=""></a>
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

                                        <div class="cart">

                                            <a href="#" class="dropdown-toggle cartdropdownget" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="cartdropdownget">

                                                <img src="{{$getBaseUrl}}img/icon-cart.png" alt="">
                                                @if ($countCart != 'null')
                                                <span id="cartcount" class="count cart-count"> {{$countCart}} </span>

                                                @endif
                                            </a>

                                            @if ($countCart != 'null')
                                            <div class="dropdown-menu dropdown-cart cartdropdown" id="cartdropdown">
                                                <ul class="mini-products-list cartvalue" style="overflow: auto; max-height: 250px !important;" id="cartvalue">
                                                    <!-- <li class="item-cart">

                                                        <div class="product-img-wrap">

                                                            <a href="#"><img src="img/cart1.jpg" alt="" class="img-reponsive"></a>

                                                        </div>

                                                        <div class="product-details">

                                                            <div class="inner-left">

                                                                <div class="product-name"><a href="#">Buku Banjir Darah </a></div>

                                                                <span>( x1)</span>

                                                                <div class="product-price" style="color:red; text-align: right !important;">

                                                                    Rp. 100.000

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </li>
                                                    <li class="item-cart">

                                                        <div class="product-img-wrap">

                                                            <a href="#"><img src="img/cart1.jpg" alt="" class="img-reponsive"></a>

                                                        </div>

                                                        <div class="product-details">

                                                            <div class="inner-left">

                                                                <div class="product-name"><a href="#">Buku Banjir </a></div>

                                                                <span>( x1)</span>

                                                                <div class="product-price" style="color:red; text-align: right !important;">

                                                                    Rp. 100.000

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </li>
                                                    <li class="item-cart">

                                                        <div class="product-img-wrap">

                                                            <a href="#"><img src="img/cart1.jpg" alt="" class="img-reponsive"></a>

                                                        </div>

                                                        <div class="product-details">

                                                            <div class="inner-left">

                                                                <div class="product-name"><a href="#">Buku  </a></div>

                                                                <span>( x1)</span>

                                                                <div class="product-price" style="color:red; text-align: right !important;">

                                                                    Rp. 100.000

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </li>  -->
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

                            </div>

                        </div>

                        <br style="clear:both" />

                        <div style="width:100%" class="hidden-md hidden-lg">

                        <table style="width:100%">

                            <tr>

                            <td style="width:30px">

                                <a href="#" class="hidden-md hidden-lg icon-pushmenu js-push-menu">

                                <i style="color:white;font-size:30px" class="fa fa-bars"></i>

                                </a>

                            </td>

                            <td>

                                <input type="text" name="" class="form-control" value="">

                            </td>

                            </tr>



                        </table>

                        <!-- <div style="float:left;width:30px!important;border:1px solid white">

                        </div>

                        <div style="margin-bottom: 15px;width: 90%;float:right;border:1px solid white">

                    </div> -->

                    </div>

                    </div>

                </div>

                <div id="hdrBtm" class="header-bottom hidden-xs hidden-sm">

                    <div class="container container-240">

                        <div class="row flex lr2">

                            <div class="col-lg-3 widget-verticalmenu">

                                <div class="navbar-vertical">

                                    <button id="catVer" onclick="catVerShow()" class="navbar-toggles navbar-drop"><span>Categories</span></button>

                                </div>

                                <div id="verHide" class="vertical-wrapper">

                                    <ul class="vertical-group" id ="categories">


                                    </ul>

                                </div>

                            </div>

                            <div class="col-lg-9 widget-left">

                                <div class="flex lr e-border">

                                    <nav class="main-menu">

                                        <div class="collapse navbar-collapse" id="myNavbar">

                                            <ul class="nav navbar-nav">

                                                <li class="level1"><a href="/">Home</a></li>

                                                <li class="level1"><a href="/katalog/promo1">Promo Bulan Ini<span class="h-ribbon h-pos e-red">Hot</span></a></li>

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

            <div class="main-head">



            </div>



            @yield('body')


            <!-- </div> -->



            <div class="foot">



            </div>

            <footer>
              <div class="feature">
                <div class="container container-240">
                  <img src="{{$getBaseUrl}}img/banner/banner_down.png" alt="" class="img-responsive">
                </div>
              </div>

                <div class="f-top">

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

                </div>



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

        </div>



        <script>
        var a = $('#cartcount').data('cartcount');

            $(document).ready(function(){

                $('.addcart').click(function(){

                    var id = $(this).data('id');

                    if(id){
                            $.ajax({

                            url:"{{url('cart/')}}/"+id,

                            type:"GET",

                            success:function(response){

                                if (response == 'sukses'){

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'success',

                                            title: 'Sukses Ditambahkan ke Keranjang',

                                            showConfirmButton: false,

                                            timer: 1500

                                            });

                                            $.ajax({

                                                    url:"{{url('cartcount')}}",

                                                    type:"GET",

                                                    success:function(response){

                                                        console.log(response);
                                                        if (response==1){
                                                                location.reload();
                                                        }

                                                        document.getElementById("cartcount").innerHTML = response;

                                                    }});



                                    }

                                else if(response == 'login'){

                                    Swal.fire({

                                                title: 'Anda harus login dahulu',

                                                icon: 'info',

                                                showCancelButton: true,

                                                confirmButtonColor: '#3085d6',

                                                cancelButtonColor: '#d33',

                                                confirmButtonText: 'Ok, Login'

                                                })

                                        .then((result) => {

                                                    if (result.isConfirmed) {

                                                        console.log('login');

                                                        window.location.href = "{{URL::to('login/')}}";

                                                    }

                                                });

                                }

                                else{

                                    console.log(response);

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'info',

                                            title: response,

                                            showConfirmButton: false,

                                            timer: 2000

                                            });

                                }

                            }

                        });

                    }

                    else{

                        console.log('Error');

                    }

                });

            });


            $(document).ready(function(){

                $('.addwishlist').click(function(){



                    var id = $(this).data('id');

                    // alert(id);

                    if(id){

                        // alert(id);

                            $.ajax({

                            url:"{{url('wishlist/')}}/"+id,

                            type:"GET",

                            success:function(response){

                                if (response == 'sukses'){

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'success',

                                            title: 'Sukses Ditambahkan ke Favorit',

                                            showConfirmButton: false,

                                            timer: 1500

                                            });

                                    }

                                else if(response == 'login'){

                                    Swal.fire({

                                                title: 'Anda harus login dahulu',

                                                icon: 'info',

                                                showCancelButton: true,

                                                confirmButtonColor: '#3085d6',

                                                cancelButtonColor: '#d33',

                                                confirmButtonText: 'Ok, Login'

                                                }).then((result) => {

                                                    if (result.isConfirmed) {

                                                        console.log('login');

                                                        window.location.href = "{{URL::to('login/')}}";

                                                    }

                                                });

                                }

                                else{

                                    console.log(response);

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'info',

                                            title: response,

                                            showConfirmButton: false,

                                            timer: 2000

                                            });

                                }

                            }

                        });

                    }

                    else{

                        console.log('Error');

                    }

                });

            });

            $(document).ready(function(){

                $('.cartdropdownget').click(function(){

                    // alert("testcart");

                            $.ajax({

                            url:"{{url('cart')}}/",

                            type:"GET",

                            success:function(response){
                                var cart = ""
                                variable = response;
                                for (i in variable) {
                                    cart += "<li class='item-cart'><div class='product-img-wrap'><a href=''><img src='img/cart1.jpg' alt='' class='img-reponsive'></a></div><div class='product-details'><div class='inner-left'><div class='product-name'><a href=''>"+variable[i].judul_buku+"</a></div><span>( x1)</span><div class='product-price' style='color:red; text-align: right !important;'>"+variable[i].harga+"</div></div></div></li>"
                                }
                                // alert(variable);

                                document.getElementById("cartvalue").innerHTML = cart;

                            }

                        });
                        $.ajax({

                            url:"{{url('cartcount')}}/",

                            type:"GET",

                            success:function(response){
                                var cart = ""
                                variable = response;

                                // alert(variable);

                                document.getElementById("countcartjs").innerHTML = "Keranjang (" +variable+")"; ;

                            }

                        });


                });

            });

        </script>

</body>

</html>
