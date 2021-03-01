<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "include/head.php" ?>
</head>

<style media="screen">
<?php
$login = 1;
if ($login == 1) {
echo "
.product-button-group{
  display: none!important;
}
";
}
 ?>
</style>

<body>
    <!-- push menu-->
    <?php include "include/nav.php" ?>

    <!-- end push menu-->
    <div class="wrappage">
      <?php include "include/headerHome.php" ?>

        <!-- /header -->
        <div class="ads-group v3">
            <div class="container container-240">
                <div class="row">
                    <div class="col-lg-2 col-md-2 set-w"></div>
                    <div class="col-lg-9 col-md-9 set-w2">
                      <div class="slide">
                          <div class="e-slide v2 js-slider-3items">
                              <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_3.jpg" alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <!-- <p class="cate v2 white text-center">Power to the pro</p>
                                      <h3 class="white v3 text-center">The vision is brighter than ever.</h3> -->
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div>
                              <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_2.jpg"  alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <!-- <p class="cate v2 white text-center">Power to the pro</p>
                                      <h3 class="white v3 text-center">The vision is brighter than ever.</h3> -->
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div>
                              <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_1.jpg" alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <!-- <p class="cate v2 white text-center">Power to the pro</p>
                                      <h3 class="white v3 text-center">The vision is brighter than ever.</h3> -->
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container-240">
            <div class="banner-callus spc1 image-bd effect_img2 bnrUp" style="">
                <a href="#"><img src="img/banner/banner_up.png" alt="" class="img-responsive"></a>
                <div class="box-center v2">
                    <!-- <p>Free Shipping on Orders $50</p> -->
                    <!-- <a href="#" class="btn-callus">Shop now</a> -->
                </div>
            </div>
        </div>
        <!-- <div class="container container-240 bgnRon">
          <div class="pRon">
            <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                  <div class="pRon1 col-md-3 col-sm-3 col-xs-3">
                    <div class="roundedMod">
                      <img src="img/rounded/001.png" alt="">
                    </div>
                  </div>
                  <div class="pRon1 col-md-3 col-sm-3 col-xs-3">
                    <div class="roundedMod">
                      <img src="img/rounded/002.png" alt="">
                    </div>
                  </div>
                  <div class="pRon1 col-md-3 col-sm-3 col-xs-3">
                    <div class="roundedMod">
                      <img class="align-middle" src="img/rounded/003.png" alt="">
                    </div>
                  </div>
                  <div class="pRon1 col-md-3 col-sm-3 col-xs-3">
                    <div class="roundedMod">
                      <img src="img/rounded/004.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="upRowRon row">
                  <div class="pRon1 col-md-4 col-sm-4 col-xs-4">
                    <div class="roundedMod">
                      <img src="img/rounded/005.png" alt="">
                    </div>
                  </div>
                  <div class="pRon1 col-md-4 col-sm-4 col-xs-4">
                    <div class="roundedMod">
                      <img src="img/rounded/006.png" alt="">
                    </div>
                  </div>
                  <div class="pRon1 col-md-4 col-sm-4 col-xs-4">
                    <div class="roundedMod">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        <div class="flash-deals">
            <div class="container container-240">
                <div class="title-icon t-column">
                    <div class="t-inside">
                        <img src="img/FlashDeals.png" class="imgBnr" alt="">
                    </div>

                </div>
                <div class="row">
                    <div style="max-width:400px" class="col-md-4 col-xl-3 hidden-sm hidden-xs">
                      <img src="img/banner/h1_b1.jpg" alt="">
                    </div>
                    <div class="col-md-8 col-xl-9 col-sm-12 col-xs-12">
                      <div class="owl-carousel owl-theme owl-cate js-owl-cate2">
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/1.jpeg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 1</p>
                                      <div class="product-price" style="text-align:center">
                                          <span class="red">Rp. 55.000</span>
                                          <br>
                                          <span class="old">Rp. 90.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2 hidden-sm hidden-xs"><a href="#">Judul Buku Flash Sale 1</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/2.jpeg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 2</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 65.000</span>
                                          <br>
                                          <span class="old">Rp. 88.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 2</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/3.jpeg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 3</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 70.000</span>
                                          <br>
                                          <span class="old">Rp. 102.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 3</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/1.jpeg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 4</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 77.000</span>
                                          <br>
                                          <span class="old">Rp. 90.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 4</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/320_x_320_4.jpg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 5</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 80.000</span>
                                          <br>
                                          <span class="old">Rp. 95.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 5</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/320_x_320_4.jpg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 6</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 80.000</span>
                                          <br>
                                          <span class="old">Rp. 95.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 5</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/320_x_320_4.jpg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 5</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 80.000</span>
                                          <br>
                                          <span class="old">Rp. 95.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 5</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="product-countd pd-bd product-inner">
                              <div class="product-item-countd">
                                  <div class="product-head product-img">
                                      <a href="#"><img src="img/product/320_x_320_1.jpg" alt=""></a>
                                      <div class="ribbon-price v3 red"><span>- 30% </span></div>
                                  </div>
                                  <div class="product-info">
                                      <p class="product-cate text-center">Flash Sale 6</p>
                                      <div class="product-price">
                                          <span class="red">Rp. 67.000</span>
                                          <br>
                                          <span class="old">Rp. 88.000</span>
                                      </div>
                                      <!-- <h3 class="product-title text-center v2"><a href="#">Judul Buku Flash Sale 6</a></h3> -->
                                      <div class="deal-progress">
                                          <div class="deal-stock">
                                              <span class="stock-sold">19% Sudah terjual</span>
                                              <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                          </div>
                                          <div class="progress">
                                              <span class="progress-bar" style="width:27.5956%"></span>
                                          </div>
                                      </div>
                                      <!-- <div class="time-cound">
                                          <p class="text-center">Selesai Promo :</p>
                                          <div class="countdown countdown-time" data-countdown="countdown" data-date="08-19-2021-00-00-00">
                                          </div>
                                      </div> -->
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div style="margin-top: 15px" class="flashDeal hidden-sm hidden-xs text-bold">
                        <div class="countdown countdown-time" style="font-size:10px!important" data-countdown="countdown" data-date="08-19-2021-00-00-00">
                        <!-- <h4>Waktu Promo tinggal<span style="font-weight: 900;"> 4 </span>hari lagi</h4> -->
                      </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- <div class="bestseller2">
            <div class="container container-240">
                <div class="h-heading">
                    <div class="title-icon t-inline">
                        <img src="img/iconbs.png" alt="">
                        <h1>Best Sellers</h1>
                    </div>

                </div>
                <div class="tab-content">
                    <div id="tv" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 product-item hidden-xs hidden-sm">
                                <div class="pd-bd product-inner v3">
                                    <div class="product-img v2">
                                        <a href="#"><img src="img/512_x_512_1.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                            <a href="#" class="circle black"></a>
                                            <a href="#" class="circle skyblue"></a>
                                            <a href="#" class="circle pink"></a>
                                        </div>
                                        <div class="element-list element-list-left">
                                            <ul class="desc-list">
                                                <li>Connects directly to Bluetooth</li>
                                                <li>Battery Indicator light</li>
                                                <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                <li>Computers running Windows</li>
                                            </ul>
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <div class="product-rating bd-rating">
                                                <span class="star star-5"></span>
                                                <span class="star star-4"></span>
                                                <span class="star star-3"></span>
                                                <span class="star star-2"></span>
                                                <span class="star star-1"></span>
                                                <div class="number-rating">( 896 reviews )</div>
                                            </div>
                                            <p class="product-cate">Buku Promo</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 77.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                    <span class="icon-bg icon-view"></span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                                <span class="icon-bg icon-cart"></span>
                                            </a>
                                            <a href="#" class="btn-icon">
                                                <span class="icon-bg icon-wishlist"></span>
                                            </a>
                                            <a href="#" class="btn-icon">
                                                <span class="icon-bg icon-compare"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                <a href="#"><img src="img/product/320_x_320_4.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="color-group">
                                                </div>
                                                <div class="element-list element-list-left">
                                                    <ul class="desc-list">
                                                        <li>Connects directly to Bluetooth</li>
                                                        <li>Battery Indicator light</li>
                                                        <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                        <li>Computers running Windows</li>
                                                    </ul>
                                                </div>
                                                <div class="element-list element-list-middle">
                                                    <div class="product-rating bd-rating">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                        <div class="number-rating">( 896 reviews )</div>
                                                    </div>
                                                    <p class="product-cate">Buku Promo</p>
                                                    <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price"><span>Rp. 77.000</span></div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    <div class="product-bottom-group">
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-cart"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-compare"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-button-group">
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-compare"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                <a href="#"><img src="img/product/320_x_320_1.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="color-group">
                                                </div>
                                                <div class="element-list element-list-left">
                                                    <ul class="desc-list">
                                                        <li>Connects directly to Bluetooth</li>
                                                        <li>Battery Indicator light</li>
                                                        <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                        <li>Computers running Windows</li>
                                                    </ul>
                                                </div>
                                                <div class="element-list element-list-middle">
                                                    <div class="product-rating bd-rating">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                        <div class="number-rating">( 896 reviews )</div>
                                                    </div>
                                                    <p class="product-cate">Buku Promo</p>
                                                    <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price"><span>Rp. 77.000</span></div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    <div class="product-bottom-group">
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-cart"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-compare"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-button-group">
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-compare"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                <a href="#"><img src="img/product/320_x_320_2.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="color-group">
                                                </div>
                                                <div class="element-list element-list-left">
                                                    <ul class="desc-list">
                                                        <li>Connects directly to Bluetooth</li>
                                                        <li>Battery Indicator light</li>
                                                        <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                        <li>Computers running Windows</li>
                                                    </ul>
                                                </div>
                                                <div class="element-list element-list-middle">
                                                    <div class="product-rating bd-rating">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                        <div class="number-rating">( 896 reviews )</div>
                                                    </div>
                                                    <p class="product-cate">Buku Promo</p>
                                                    <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price"><span>Rp. 77.000</span></div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    <div class="product-bottom-group">
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-cart"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-compare"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-button-group">
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-compare"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                <a href="#"><img src="img/product/320_x_320_2.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="color-group">
                                                </div>
                                                <div class="element-list element-list-left">
                                                    <ul class="desc-list">
                                                        <li>Connects directly to Bluetooth</li>
                                                        <li>Battery Indicator light</li>
                                                        <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                        <li>Computers running Windows</li>
                                                    </ul>
                                                </div>
                                                <div class="element-list element-list-middle">
                                                    <div class="product-rating bd-rating">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                        <div class="number-rating">( 896 reviews )</div>
                                                    </div>
                                                    <p class="product-cate">Buku Promo</p>
                                                    <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price"><span>Rp. 77.000</span></div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    <div class="product-bottom-group">
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-cart"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-compare"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-button-group">
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-compare"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                <a href="#"><img src="img/product/320_x_320_2.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="color-group">
                                                </div>
                                                <div class="element-list element-list-left">
                                                    <ul class="desc-list">
                                                        <li>Connects directly to Bluetooth</li>
                                                        <li>Battery Indicator light</li>
                                                        <li>DPI Selection:2600/2000/1600/1200/800</li>
                                                        <li>Computers running Windows</li>
                                                    </ul>
                                                </div>
                                                <div class="element-list element-list-middle">
                                                    <div class="product-rating bd-rating">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                        <div class="number-rating">( 896 reviews )</div>
                                                    </div>
                                                    <p class="product-cate">Buku Promo</p>
                                                    <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price"><span>Rp. 77.000</span></div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    <div class="product-bottom-group">
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-cart"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                        <a href="#" class="btn-icon">
                                                            <span class="icon-bg icon-compare"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-button-group">
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                    <a href="#" class="btn-icon">
                                                        <span class="icon-bg icon-compare"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="releases  bg-gradient bg-insinde">
            <div class="container container-240">
                <div class="title-icon t-column mg-50">
                    <div class="t-inside">
                        <img src="img/bestseller.png" class="imgBnr" alt="">
                    </div>
                    <!-- <h1>New releases</h1> -->
                </div>
                <div class="tab-content">
                    <div id="tv2" class="tab-pane fade in active">
                        <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate">
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_1.jpg" alt="" class="img-reponsive"></a>
                                        <div class="ribbon-price red"><span>- 30% </span></div>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 88.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_2.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 2</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 66.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_3.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 3</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 75.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_4.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 4</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 77.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="releases bg-gradient bg-insinde">
            <div class="container container-240">
                <div class="title-icon t-column mg-50">
                    <div class="t-inside">
                        <img src="img/NewProduct.png" class="imgBnr" alt="">
                    </div>
                    <!-- <h1>New releases</h1> -->
                </div>
                <div class="tab-content">
                    <div id="tv2" class="tab-pane fade in active">
                        <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate">
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_1.jpg" alt="" class="img-reponsive"></a>
                                        <div class="ribbon-price red"><span>- 30% </span></div>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 1</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 88.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_2.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 2</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 66.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_3.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 3</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 75.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="#"><img src="img/product/320_x_320_4.jpg" alt="" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">Judul Buku 4</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. 77.000</span></div>
                                                <a href="#" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group">
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                            <a href="#" class="btn-icon">
                                            <span class="icon-bg icon-compare"></span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <div class="e-category">
            <div class="container container-240">
                <div class="title-icon t-column mg-50">
                    <div class="t-inside">
                        <img src="img/real.png" alt="">
                    </div>
                    <h1>You May Like</h1>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Featured Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Top Rated Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Top Selling Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div style="margin-top:25px" class="homepage-banner">
            <div class="container container-240" style="padding-bottom:50px!important">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" >
                        <div class="banner-img banner-img2">
                            <a href="#"><img src="img/banner/675_x_350_1.jpg" alt="" class=""></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" >
                        <div class="banner-img banner-img2">
                            <a href="#"><img src="img/banner/675_x_350_2.jpg" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" >
                        <div class="banner-img banner-img2">
                            <a href="#"><img src="img/banner/675_x_350_1.jpg" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-lg-6 col-xs-6" style="margin-top:20px">
                        <div class="banner-img banner-img2">
                            <a href="#"><img src="img/banner/675_x_350_2.jpg" alt="" class="img-responsive"></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="container container-240">
            <div class="banner-callus spc1 image-bd effect_img2">
                <a href="#"><img src="img/banner/h1_b7.jpg" alt="" class="img-responsive"></a>
                <div class="box-center v2">
                    <p>Free Shipping on Orders $50</p>
                    <a href="#" class="btn-callus">Shop now</a>
                </div>
            </div>
        </div>
        <div class="more-product bg-gradient bg-insinde">
            <div class="container container-240">

            </div>
        </div>
        <div class="feature">
            <div class="container container-240">
              <img src="" alt="">
                <!-- <div class="feature-inside">
                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/truck.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Pengiriman Seluruh Indonesia</h3>
                            <p>Kita mengirimkan barang ke seuruh penjuru Indonesia</p>
                        </div>
                    </div>

                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/credit-card.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Pembayaran Aman</h3>
                            <p>Pembayaran dilakukan dengan sangat aman.</p>
                        </div>
                    </div>

                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/safety.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Belanja Dengan Aman</h3>
                            <p>Proteksi dari membeli sampai dengan pengiriman.</p>
                        </div>
                    </div> -->
                    <img src="img/banner/banner_down.png" alt="" class="img-responsive">

            </div>
            </div>
        </div>
        <!-- / end content -->
          <?php include_once  "include/foot.php" ?>
        <!-- /footer -->
        <!-- /footer -->
    </div>
    <script>
    window.onscroll = function() {myFunction()};

    function myFunction() {
      if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        var ver = document.getElementById("verHide")
        $("#hdrBtm").fadeOut(100);
        $("#verHide").fadeOut(100);
      } else {
        $("#hdrBtm").fadeIn(500);
        $("#verHide").fadeIn(800);
      }
    }
    // function catVer() {
    //     // $("#verHide").fadeToggle();
    //     console.log(1);
    // }
    // $(document).ready(function(){
    //   $("catVer").click(function(){
    //     console.log(2);
    //     // $("#verHide").fadeToggle();
    //   });
    // });
    </script>
</body>

</html>
