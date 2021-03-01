    @extends('main.mainHome')
    @section('title', 'Aqwam')
    @section('body')
        <div class="ads-group v3">
            <div class="container container-240">
                <div class="row">
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs set-w">
                      <div class="rBannerCon" >
                        <div class="rBannerConTxt">
                          <h3>IMPRINT</h3>
                        </div>
                        <img src="img/banner/imgTitle.png" alt="" class="rBannerConImg">
                        <div class="rBannerConBtm">
                          <div class="rBannerConBtmSdw">
                            <a href="/katalog/IP001">AQWAM</a>
                            <a href="/katalog/IP002">AQWAMEDIKA</a>
                            <a href="/katalog/IP003">UMMULQURA</a>
                            <a href="/katalog/IP004">AL-AZHAR</a>
                            <a href="/katalog/IP005">BEIRUT</a>
                            <a href="/katalog/IP006">ISTANBUL</a>
                            <a href="/katalog/IP007">ZAIN</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 set-w2">
                      <div class="slide">
                          <div class="e-slide v2 js-slider-3items">
                              @foreach ($slider as $sld)
                                 <div class="e-slide-img v2">
                                  <a href="#"><img src="{{$urlImage}}{{$sld->gambar}}" alt=""></a>
                                  <div class="box-center slide-content v3"></div>
                                </div>
                              @endforeach
                          </div>
                      </div>
                      <div class="catUpperHome hidden-xs">
                        <a href="/katalog/K001">Adab</a>
                        <a href="/katalog/K002">Akhir Zaman</a>
                        <a href="/katalog/K003">Akhlak</a>
                        <a href="/katalog/K004">Akidah</a>
                        <a href="/katalog/K005">Al Quran</a>
                        <a href="/katalog/K006">Amalan Harian</a>
                        <a href="/katalog/K007">Bahasa Arab</a>
                        <a href="/katalog/K008">Biografi</a>
                        <a href="/katalog/K009">Buku Anak</a>
                        <a href="/katalog/K010">Buku Saku & Souvenir</a>
                        <a href="/katalog/K011">Dakwah</a>
                        <a href="/katalog/K012">Doa dan Dzikir</a>
                        <a href="/katalog/K013">Ekonomi Islam</a>
                        <a href="/katalog/K014">Fikih</a>
                        <a href="/katalog/K015">Hadits</a>
                        <a href="/katalog/K016">Haji Umrah</a>
                        <a href="/katalog/K017">Ibadah</a>
                        <a href="/katalog/K018">Keluarga</a>
                        <a href="/katalog/K019">Kesehatan</a>
                        <a href="/katalog/K020">Khutbah</a>
                        <a href="/katalog/K021">Kisah Islami</a>
                        <a href="/katalog/K022">Manajemen Hati</a>
                        <a href="/katalog/K023">Muamalah</a>
                        <a href="/katalog/K024">Muslimah</a>
                        <a href="/katalog/K025">Nabi Muhammad</a>
                        <a href="/katalog/K026">Parenting</a>
                        <a href="/katalog/K027">Pemikiran</a>
                        <a href="/katalog/K028">Pemuda</a>
                        <a href="/katalog/K029">Pendidikan</a>
                        <a href="/katalog/K030">Pernikahan</a>
                        <a href="/katalog/K031">Puasa & Ramadhan</a>
                        <a href="/katalog/K032">Referensi (Turats)</a>
                        <a href="/katalog/K033">Sejarah</a>
                        <a href="/katalog/K034">Shalat</a>
                        <a href="/katalog/K035">Tafsir</a>
                        <a href="/katalog/K036">Tips & Motivasi</a>
                        <a href="/katalog/K037">Tokoh</a>
                        <a href="/katalog/K038">Zakat & Sedekah</a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- imprint circle *dont delete, incase u need it again* -->
        <!-- <div class="container container-240">
          <div class="row">
            <div class="col-lg-2 col-md-2" style="margin-right: 80px;"></div>
            <div class="col-lg-9 col-md-12 col-sm-12">
              <div class="tKatPen hidden-md hidden-lg">Kategori Penerbit</div> <hr class="hidden-md hidden-lg tKatPenLine" style="background:#ff0000">
              <div class="row pRon" >
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm">
                  <a href="/katalog/IP001?id=2" class="roundedMod">
                    <img src="img/rounded/004.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Istanbul</p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm ">
                  <a href="/katalog/IP002?id=2" class="roundedMod">
                    <img src="img/rounded/002.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Ummulqura</p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm ">
                  <a href="/katalog/IP003?id=2" class="roundedMod">
                    <img src="img/rounded/001.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Aqwam</p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm ">
                  <a href="/katalog/IP004?id=2" class="roundedMod">
                    <img src="img/rounded/003.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Zain</p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm ">
                  <a href="/katalog/IP005?id=2" class="roundedMod">
                    <img src="img/rounded/005.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Beirut</p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 pRon-sm ">
                  <a href="/katalog/IP006?id=2" class="roundedMod">
                    <img src="img/rounded/006.png" class="imgRnd" alt="">
                  </a>
                  <p class="hidden-md hidden-lg">Al-Azhar</p>
                </div>
              </div>
            </div>

          </div>
        </div> -->
        <!-- imprint circle *dont delete, incase u need it again* -->
        <div class="container container-240 mt-1 hidden-lg hidden-md">
          <div class="tKatPen">Kategori Penerbit</div> <hr class="hidden-md hidden-lg tKatPenLine" style="background:#ff0000" >
          <div class="confootImprintImg">
            <span class="qry3">
              <a href="/katalog/IP001">
                <img src="{{$getBaseUrl}}img/imprintImg/01.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP002">
                <img src="{{$getBaseUrl}}img/imprintImg/02.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP003">
                <img src="{{$getBaseUrl}}img/imprintImg/05.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP004">
                <img src="{{$getBaseUrl}}img/imprintImg/07.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP005">
                <img src="{{$getBaseUrl}}img/imprintImg/03.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP006">
                <img src="{{$getBaseUrl}}img/imprintImg/06.png" alt="" class="img-reponsive" >
              </a>
            </span>
            <span class="qry3">
              <a href="/katalog/IP007">
                <img src="{{$getBaseUrl}}img/imprintImg/04.png" alt="" class="img-reponsive" >
              </a>
            </span>
          </div>
        </div>
        <div class="container container-240 mt-1 hidden-lg hidden-md d-none">
          <div class="row">
            <div class="col-lg-2 col-md-2" style="margin-right: 80px;"></div>
            <div class="col-lg-9 col-md-12 col-sm-12">
              <div class="tKatPen">Semua Kategori</div> <hr class="hidden-md hidden-lg tKatPenLine" style="background:#ff0000" >
              <div class="row pRon" style="margin-top:25px!important;">
                <div class="col-sm-6 col-xs-6" style="padding:0 2px!important;">
                  <a href="search?id=1">
		                  <img src='{{$urlImage}}{{$bannerAll->gambar}}' style="border:1px;border-radius:5px; width:100%;" alt="All Book">
                  </a>
                </div>
                <div class="col-sm-6 col-xs-6" style="padding:0 2px!important;">
                  <a href="/katalog/allpromo">
		                  <img src='{{$urlImage}}{{$bannerPromo->gambar}}' style="border:1px;border-radius:5px; width:100%;"  alt="All Sale">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="margin-top:25px" class="homepage-banner d-none">
            <div class="container container-240" style="">
                <div class="row">
                    @foreach ($banner as $bnr)
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" >
                        <div class="banner-img banner-img2">
                            <a href="#"><img src="{{$urlImage}}{{$bnr->gambar}}" alt="" class=""></a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        @if ($promoviewhome==1)
        <section id="secPromo">
          
          <div class="releases  bg-gradient bg-insinde">
            <div class="" style="margin-bottom:35px">
              <div class="container container-240 hidden-sm hidden-xs text-bold" style="margin-bottom:-10px">
                <div class="conTxtLngkp">
                  <a href="/katalog/allpromo">Lihat Selengkapnya <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </a>
                </div>
              </div>
              <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
              <div class="mobBanner container container-240">
                <img src="img/banner/imgTitle.png" class="imgBnrH" alt="">
                <h3 style="color:white;position:absolute;margin:-28px 0 0 88px" class="mobBnrHTxt">PROMO</h3>
              </div>
            </div>
            <div class="container container-240">
              <table class="table d-none" style="margin-bottom:10px!important;margin-top:20px;">
                <tr>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                  <td style="width:108px;text-align:center;font-weight:500;font-size:16px"><div style="margin-top:10px">PROMO</div></td>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                </tr>
              </table>
              <!-- <div class="tKatPen hidden-md hidden-lg">Big Sale</div> <hr class="hidden-md hidden-lg tKatPenLine"> -->
              <div class="row">
                <!-- <div style="max-width:400px" class="col-md-4 col-xl-3 hidden-sm hidden-xs">
                <img  src="{{$urlImage}}{{$flashsalegen->gambar_sale}}" alt="">
              </div> -->
              
              <div class="col-md-12 col-xl-12 col-sm-12 col-xs-12">
                <div class="owl-carousel owl-theme owl-cate js-owl-cate2">
                  
                  @foreach ($bigPromo as $fs)
                  <div class="product-item">
                    <div class="pd-bd product-inner lPad">
                      <a data-id="{{$fs['idBuku']}}" class="btn-icon addwishlist hidden-md hidden-lg wshlstMob">
                        <span class="fa fa-heart" style="font-size: 20px;color:#fff"></span>
                      </a>
                      <div class="product-head product-img">
                        <a href="/detail/{{$fs['idBuku']}}"><img src="{{$urlImage}}{{$fs['gambar']}}" alt="" class="img-reponsive"></a>
                        <!-- <div class="ribbon-price v3 red"><span>- 30% </span></div> -->
                      </div>
                      <div class="product-info">
                        <p class="product-title" style="margin-top:1em;">{{$fs['judul_buku']}}</p>
                        <div style="display:flex">
                          <div class="product-price" style="text-align:center">
                            <p class="red" style="font-size:15px!important">Rp. {{number_format($fs['harga_jadi'], 0, ',', '.')}}</p>
                            <div style="margin-top:-5px">
                              <span class="old" style="font-size:12px!important">Rp. {{number_format($fs['harga'], 0, ',', '.')}}</span>
                            </div>
                          </div>
                          <div class="hidden-lg hidden-md" style="margin-right:8px;margin-top:8px;">
                            <a data-id="{{$fs['idBuku']}}"  class="btn-icon addcart" >
                              <span class="icon-bg icon-cart"></span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  
                </div>
              </div>
            </div>
            <div class="float-right hidden-md hidden-lg">
              <a href="katalog/promo{{$idpromonow}}?id=3" style="color:#ff4e4b">Lihat Selengkapnya</a>
            </div>

          </div>
        </div>
        
        </section>
        @endif
        <section id="secBest">
          <div class="releases  bg-gradient bg-insinde">
            <div class=" " style="margin-bottom:35px">
              <div class="hidden-sm hidden-xs container container-240 text-bold" style="margin-bottom:-10px">
                <div class="conTxtLngkp">
                  <a href="/katalog/best">Lihat Selengkapnya <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </a>
                </div>
              </div>
              <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
              <div class="mobBanner container container-240">
                <img src="img/banner/imgTitle.png" class="imgBnrH" alt="">
                <h4 style="color:white;position:absolute;margin:-25px 0 0 63px" class="mobBnrHTxt">BUKU TERLARIS</h4>
              </div>
            </div>
            <div class="container container-240">
              <table class="table d-none" style="margin-bottom:10px!important">
                <tr>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                  <td style="width:108px;text-align:center;font-weight:500;font-size:16px"><div>BUKU TERLARIS</div></td>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                </tr>
              </table>
              <div class="tab-content">
                <div id="tv2" class="tab-pane fade in active">
                  <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate2">
                    @foreach ($bestSeller as $best)
                    <div class="product-item">
                      <div class="pd-bd product-inner lPad">
                        <a data-id="{{$best['id_buku']}}" class="btn-icon addwishlist hidden-md hidden-lg wshlstMob">
                          <span class="fa fa-heart" style="font-size: 20px;color:#fff"></span>
                        </a>
                        <div class="product-img">
                          <a href="/detail/{{$best['id_buku']}}"><img src="{{$urlImage}}{{$best['gambar']}}" alt="" class="img-reponsive"></a>
                          <div class="ribbon-price red"><span>- 30% </span></div>
                        </div>
                        <div class="product-info">
                          <div class="element-list element-list-middle">

                            <h3 class="product-title" style="height:32px;overflow:hidden;"><a href="/detail/{{$best['id_buku']}}">{{$best['judul_buku']}}</a></h3>
                            <div class="product-bottom">
                              @if ($best['harga_jadi'])
                              <div class="product-price"><span class="red">Rp. {{number_format($best['harga_jadi'], 0, ',', '.')}}</span>
                                <br> <span class="old" style="font-size:12px!important;">Rp. {{number_format($best['harga_buku'], 0, ',', '.')}}</span></div>
                                @else
                                <div class="product-price" style="padding-top:9px;"><span>Rp. {{number_format($best['harga_buku'], 0, ',', '.')}}</span></div>
                                @endif
                                <div class="hidden-lg hidden-md" style="margin-right:8px;margin-top:8px;">
                                  <a data-id="{{$best['id_buku']}}"  class="btn-icon addcart" >
                                    <span class="icon-bg icon-cart"></span>
                                  </a>
                                </div>
                              </a>
                            </div>
                          </div>
                          <div class="product-button-group lPadG" style="">
                            <a data-id="{{$best['id_buku']}}"  class="btn-icon addcart" >
                              <span class="icon-bg icon-cart"></span>
                            </a>
                            <a data-id="{{$best['id_buku']}}" class="btn-icon addwishlist">
                              <span class="icon-bg icon-wishlist"></span>
                            </a>

                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach

                  </div>
                </div>

              </div>
              <div class="float-right hidden-md hidden-lg">
                <a href="katalog/best" style="color:#ff4e4b">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
        </section>
        <section id="secNew">
          <div class="releases  bg-gradient bg-insinde" >

            <div class="" style="margin-bottom:35px">
              <div class="container container-240 hidden-sm hidden-xs text-bold" style="margin-bottom:-10px">
                <div class="conTxtLngkp">
                  <a href="/katalog/baru">Lihat Selengkapnya <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </a>
                </div>
              </div>
              <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
              <div class="mobBanner container container-240">
                <img src="img/banner/imgTitle.png" class="imgBnrH" alt="">
                <h4 style="color:white;position:absolute;margin:-25px 0 0 65px" class="mobBnrHTxt">BUKU TERBARU</h4>
              </div>
            </div>
            <div class="container container-240">
              <table class="table d-none" style="margin-bottom:10px!important">
                <tr>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                  <td style="width:115px;text-align:center;font-weight:500;font-size:16px"><div>BUKU TERBARU</div></td>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                </tr>
              </table>
              <div class="tab-content">
                <div id="tv2" class="tab-pane fade in active">
                  <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate2">
                    @foreach ($newRelease as $new)
                    <div class="product-item">
                      <div class="pd-bd product-inner lPad">
                        <a data-id="{{$new['id_buku']}}" class="btn-icon addwishlist hidden-md hidden-lg wshlstMob">
                          <span class="fa fa-heart" style="font-size: 20px;color:#fff"></span>
                        </a>
                        <div class="product-img">
                          <a href="/detail/{{$new['id_buku']}}"><img src="{{$urlImage}}{{$new['gambar']}}" alt="" class="img-reponsive"></a>
                          <div class="ribbon-price red"><span>- 30% </span></div>
                        </div>
                        <div class="product-info">
                          <div class="element-list element-list-middle">
                            <!-- <p class="product-cate">pre order</p> -->
                            <h3 class="product-title" style="height:33px;overflow:hidden"><a href="/detail/{{$new['id_buku']}}">{{ \Illuminate\Support\Str::limit($new['judul_buku'], 25, $end=' ...') }}</a></h3>
                            <div class="product-bottom">
                              @if ($new['harga_jadi'])
                              <div class="product-price"><span class="red">Rp. {{number_format($new['harga_jadi'], 0, ',', '.')}}</span>
                                <br> <span class="old" style="font-size:12px!important;">Rp. {{number_format($new['harga_buku'], 0, ',', '.')}}</span></div>
                                @else
                                <div class="product-price" style="padding-top:9px;"><span >Rp. {{number_format($new['harga_buku'], 0, ',', '.')}}</span></div>
                                @endif
                                <div class="hidden-lg hidden-md" style="margin-right:8px;margin-top:8px;">
                                  <a data-id="{{$new['id_buku']}}"  class="btn-icon addcart" >
                                    <span class="icon-bg icon-cart"></span>
                                  </a>
                                </div>

                              </div>
                            </div>
                            <div class="product-button-group lPadG" style="">
                              <a data-id="{{$new['id_buku']}}" class="btn-icon addcart">
                                <span class="icon-bg icon-cart"></span>
                              </a>
                              <a data-id="{{$new['id_buku']}}" class="btn-icon addwishlist">
                                <span class="icon-bg icon-wishlist"></span>
                              </a>

                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach

                    </div>
                  </div>

                </div>
                <div class="float-right hidden-md hidden-lg">
                  <a href="katalog/baru" style="color:#ff4e4b">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
        </section>
        <section id="secRev">
          <div class="releases  bg-gradient bg-insinde" style="padding-bottom:50px;">
            <div class="" style="margin-bottom:35px">
              <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
              <div class="mobBanner container container-240">
                <img src="img/banner/imgTitle.png" class="imgBnrH" alt="">
                <h4 style="color:white;position:absolute;margin:-25px 0 0 73px" class="mobBnrHTxt">REVIEW BUKU</h4>
              </div>
            </div>
            <div class="container container-240">
              <table class="table hidden-lg hidden-md d-none" style="margin-bottom:10px!important">
                <tr>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                  <td style="width:115px;text-align:center;font-weight:500;font-size:16px"><div>REVIEW BUKU</div></td>
                  <td><hr style="background:#ff0000;border: 1px solid #ff0000;"></td>
                </tr>
              </table>
              <div class="tab-content">
                <div class="otrConReview">
                  @foreach ($review_gambar as $rvwgmbr)
                  <div class="ConReview">
                    <img src="{{$urlImage}}{{$rvwgmbr->path}}" style="border: 1px solid #c6c6c6b8;border-radius: 10px;width:100%" alt="">
                  </div>
                  @endforeach
                </div>
                <!-- <div class="row parent">
                  @foreach ($review_gambar as $rvwgmbr)
                  <div class="col-lg-4 col-md-6 col-sm-6 parent">
                    <img src="{{$urlImage}}{{$rvwgmbr->path}}" style="border: 1px solid #c6c6c6b8;border-radius: 10px;width:100%" alt="">
                  </div>
                  @endforeach
                </div> -->
              </div>
            </div>
          </div>
        </section>

        <!-- </div> -->
        <!-- <div class="container container-240">
            <div class="banner-callus spc1 image-bd effect_img2">
                <a href="#"><img src="img/banner/h1_b7.jpg" alt="" class="img-responsive"></a>
                <div class="box-center v2">
                    <p>Free Shipping on Orders $50</p>
                    <a href="#" class="btn-callus">Shop now</a>
                </div>
            </div>
        </div> -->
        <!-- <div class="more-product bg-gradient bg-insinde">
            <div class="container container-240">

            </div>
        </div> -->



    @endsection
