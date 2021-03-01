     @extends('main.mainHome')

    @section('title', 'Aqwam')

    @section('body')



        <div class="ads-group v3">
            <div class="container container-240">
                <div class="row">
                    <div class="col-lg-2 col-md-2 set-w"></div>
                    <div class="col-lg-9 col-md-9 set-w2">
                      <div class="slide">
                          <div class="e-slide v2 js-slider-3items">
                              @foreach ($slider as $sld)
                                 <div class="e-slide-img v2">
                                  <a href="#"><img src="{{$urlImage}}{{$sld->gambar}}" alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <!-- <p class="cate v2 white text-center">Power to the pro</p>
                                      <h3 class="white v3 text-center">The vision is brighter than ever.</h3> -->
                                      <!-- <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a> -->
                                  </div>
                                </div>
                              @endforeach
                              <!-- <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_3.jpg" alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div>
                              <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_2.jpg"  alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div>
                              <div class="e-slide-img v2">
                                  <a href="#"><img src="img/slider/720 _x_450_1.jpg" alt=""></a>
                                  <div class="box-center slide-content v3">
                                      <a href="#" class="slide-btn e-red-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a>
                                  </div>
                              </div> -->
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container-240">
          <div class="row">
            <div class="col-lg-2 col-md-2" style="margin-right: 80px;"></div>
            <div class="col-lg-9 col-md-12 col-sm-12">
              <div class="row pRon" >
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm">
                  <a href="/katalog/IP001" class="roundedMod">
                    <img src="img/rounded/004.png" class="imgRnd" alt="">
                  </a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm ">
                  <a href="/katalog/IP002" class="roundedMod">
                    <img src="img/rounded/002.png" class="imgRnd" alt="">
                  </a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm ">
                  <a href="/katalog/IP003" class="roundedMod">
                    <img src="img/rounded/001.png" class="imgRnd" alt="">
                  </a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm ">
                  <a href="/katalog/IP004" class="roundedMod">
                    <img src="img/rounded/003.png" class="imgRnd" alt="">
                  </a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm ">
                  <a href="/katalog/IP005" class="roundedMod">
                    <img src="img/rounded/005.png" class="imgRnd" alt="">
                  </a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-4 pRon-sm ">
                  <a href="/katalog/IP006" class="roundedMod">
                    <img src="img/rounded/006.png" class="imgRnd" alt="">
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

        <div class="flash-deals">
            <div class="container container-240">
                <div class="title-icon t-column">
                    <div class="t-inside">
                        <img src="img/FlashDeals.png" class="imgBnr" alt="">
                    </div>

                </div>
                <div class="row">
                    <div style="max-width:400px" class="col-md-4 col-xl-3 hidden-sm hidden-xs">
                      <img src="{{$urlImage}}{{$flashsalegen->gambar_sale}}" alt="">
                    </div>
                    <div class="col-md-8 col-xl-9 col-sm-12 col-xs-12">
                      <div class="owl-carousel owl-theme owl-cate js-owl-cate2">
                           @foreach ($flashSale as $fs)
                           <div class="product-countd pd-bd product-inner">
                                <div class="product-item-countd">
                                    <div class="product-head product-img">
                                        <a href="/detail/{{$fs->id_buku}}"><img src="{{$urlImage}}{{$fs->gambar_buku}}" alt=""></a>
                                        <!-- <div class="ribbon-price v3 red"><span>- 30% </span></div> -->
                                    </div>
                                    <div class="product-info">
                                        <p class="product-cate text-center">{{$fs->judul_buku}}</p>
                                        <div class="product-price" style="text-align:center">
                                            <span class="red">Rp. {{number_format($fs->harga_jadi, 2, ',', '.')}}</span>
                                            <br>
                                            <span class="old">Rp. {{number_format($fs->harga_buku, 2, ',', '.')}}</span>
                                        </div>
                                        <!-- <h3 class="product-title text-center v2 hidden-sm hidden-xs"><a href="#">Judul Buku Flash Sale 1</a></h3> -->
                                        <div class="deal-progress">
                                            <div class="deal-stock">
                                                <span class="stock-sold">{{$fs->terjual}} Sudah terjual</span>
                                                <!-- <span class="stock-available">Tersedia: <strong>30</strong></span> -->
                                            </div>
                                            <div class="progress">
                                                <span class="progress-bar" style="width:27.5956%"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                           @endforeach

                      </div>
                      <div style="margin-top: 15px" class="flashDeal hidden-sm hidden-xs text-bold">
                      <!-- <div class="countdown countdown-time" style="font-size:10px!important" data-countdown="countdown" data-date="08-19-2021-00-00-00"> -->
                        <div class="countdown countdown-time" style="font-size:10px!important" data-countdown="countdown" data-date="{{$flashsalegen->waktu}}">
                        <!-- <h4>Waktu Promo tinggal<span style="font-weight: 900;"> 4 </span>hari lagi</h4> -->
                      </div>
                    </div>
                </div>

            </div>
        </div>
      </div>

        <div class="releases  bg-gradient bg-insinde" style="padding-bottom:20px;">
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
                            @foreach ($bestSeller as $best)
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="/detail/{{$best->id_buku}}"><img src="{{$urlImage}}{{$best->gambar_buku}}" alt="" class="img-reponsive"></a>
                                        <div class="ribbon-price red"><span>- 30% </span></div>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">

                                            <h3 class="product-title"><a href="#">{{$best->judul_buku}}</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. {{number_format($best->harga_buku, 2, ',', '.')}}</span></div>
                                                <a href="/detail/{{$best->id_buku}}" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group" style="padding-left:30px !important;padding-right:30px !important">
                                            <a data-id="{{$best->id_buku}}"  class="btn-icon addcart" >
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a data-id="{{$best->id_buku}}" class="btn-icon addwishlist">
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
            </div>
        </div>
        <div class="releases bg-gradient bg-insinde" style="padding-bottom:20px;">
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
                            @foreach ($newRelease as $new)
                            <div class="product-item">
                                <div class="pd-bd product-inner">
                                    <div class="product-img">
                                        <a href="/detail/{{$new->id_buku}}"><img src="{{$urlImage}}{{$new->gambar_buku}}" alt="" class="img-reponsive"></a>
                                        <div class="ribbon-price red"><span>- 30% </span></div>
                                    </div>
                                    <div class="product-info">
                                        <div class="color-group">
                                        </div>
                                        <div class="element-list element-list-left">
                                        </div>
                                        <div class="element-list element-list-middle">
                                            <p class="product-cate">pre order</p>
                                            <h3 class="product-title"><a href="#">{{$new->judul_buku}}</a></h3>
                                            <div class="product-bottom">
                                                <div class="product-price"><span>Rp. {{number_format($new->harga_buku, 2, ',', '.')}}</span></div>
                                                <a href="/detail/{{$new->id_buku}}" class="btn-icon btn-view">
                                                <span class="icon-bg icon-view"></span>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="product-button-group" style="padding-left:30px !important;padding-right:30px !important">
                                            <a data-id="{{$new->id_buku}}" class="btn-icon addcart">
                                            <span class="icon-bg icon-cart"></span>
                                        </a>
                                            <a data-id="{{$new->id_buku}}" class="btn-icon addwishlist">
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
            </div>
        </div>
        <div class="releases  bg-gradient bg-insinde" style="padding-bottom:50px;">
          <div class="container container-240">
            <div class="title-icon t-column mg-50">
              <div class="t-inside">
                <img src="img/review_buku.png" class="imgBnr" alt="">
              </div>
              <!-- <h1>New releases</h1> -->
            </div>
            <div class="tab-content">
              <div class="row parent">
                <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs parent">
                  <div style="border: 1px solid #c6c6c6b8;border-radius: 10px;background: #ededed8f;padding:20px 5px;">
                    <div style="color: #fcda8b;" class="text-center">
                      <i class="fa fa-star s1" aria-hidden="true"></i>
                      <i class="fa fa-star s2" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o s3" aria-hidden="true"></i>
                      <i class="fa fa-star-o s2" aria-hidden="true"></i>
                      <i class="fa fa-star-o s1" aria-hidden="true"></i>
                    </div>
                    <div class="text-center" style="padding:20px 0 10px;">
                      <img style="width:100px;padding-bottom: 10px;" src="http://cemaraitsalatiga.com/1m4g3st0r3/buku/gambarbuku1.jpeg">
                      <a href="/detail/315-AQW" style="font-size:15px; max-width:50px;" class="text-bold text-danger"><p>Fikih Kesehatan</p></a>
                    </div>
                    <div style="padding:5px 20px;text-align: justify; text-justify: inter-word;">
                      <p>
                        Do not go gentle into that good night,
                        Old age should burn and rave at close of day;
                        Rage, rage against the dying of the light.
                        Though wise men at their end know dark is right,
                        Because their words had forked no lightning they
                        Do not go gentle into that good night.
                        Good men, the last wave by, crying how bright
                        Their frail deeds might have danced in a green bay,
                      </p>
                      <p class="text-bold text-center mt-1"> Professor Brand by Dylan Thomas in Christopher Nolan’s Interstellar</p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 parent">
                  <img src="img/review-1.png" style="border: 1px solid #c6c6c6b8;border-radius: 10px;width:100%" alt="">
                  <!-- <div style="border: 1px solid #c6c6c6b8;border-radius: 10px;background: #ededed8f;padding:20px 5px;">
                    <div style="color: #fcda8b;" class="text-center">
                      <i class="fa fa-star s1" aria-hidden="true"></i>
                      <i class="fa fa-star s2" aria-hidden="true"></i>
                      <i class="fa fa-star s3" aria-hidden="true"></i>
                      <i class="fa fa-star s2" aria-hidden="true"></i>
                      <i class="fa fa-star s1" aria-hidden="true"></i>
                    </div>
                    <div class="text-center" style="padding:20px 0 10px;">
                      <img style="width:100px;padding-bottom: 10px;" src="http://cemaraitsalatiga.com/1m4g3st0r3/buku/gambarbuku1.jpeg">
                      <a href="/detail/315-AQW" style="font-size:15px; max-width:50px;" class="text-bold text-danger"><p>Fikih Kesehatan</p></a>
                    </div>
                    <div style="padding:5px 20px;text-align: justify; text-justify: inter-word;">
                      <p>
                        Do not go gentle into that good night,
                        Old age should burn and rave at close of day;
                        Rage, rage against the dying of the light.
                        Though wise men at their end know dark is right,
                        Because their words had forked no lightning they
                        Do not go gentle into that good night.
                        Good men, the last wave by, crying how bright
                        Their frail deeds might have danced in a green bay,
                        Rage, rage against the dying of the light.
                        Wild men who caught and sang the sun in flight,
                        And learn, too late, they grieved it on its way,
                        Do not go gentle into that good night.
                        Grave men, near death, who see with blinding sight
                        Blind eyes could blaze like meteors and be gay,
                        Rage, rage against the dying of the light.
                        And you, my father, there on that sad height,
                        Curse, bless, me now with your fierce tears, I pray.
                        Do not go gentle into that good night.
                        Rage, rage against the dying of the light.
                      </p>
                      <p class="text-bold text-center mt-1"> Professor Brand by Dylan Thomas in Christopher Nolan’s Interstellar</p>
                    </div>
                  </div> -->
                </div>

                <div class="col-lg-4 hidden-sm hidden-md hidden-xs parent ">
                  <div style="border: 1px solid #c6c6c6b8;border-radius: 10px;background: #ededed8f;padding:20px 5px;">
                    <div style="color: #fcda8b;" class="text-center">
                      <i class="fa fa-star s1" aria-hidden="true"></i>
                      <i class="fa fa-star s2" aria-hidden="true"></i>
                      <i class="fa fa-star s3" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o s2" aria-hidden="true"></i>
                      <i class="fa fa-star-o s1" aria-hidden="true"></i>
                    </div>
                    <div class="text-center" style="padding:20px 0 10px;">
                      <img style="width:100px;padding-bottom: 10px;" src="http://cemaraitsalatiga.com/1m4g3st0r3/buku/gambarbuku1.jpeg">
                      <a href="/detail/315-AQW" style="font-size:15px; max-width:50px;" class="text-bold text-danger"><p>Fikih Kesehatan</p></a>
                    </div>
                    <div style="padding:5px 20px;text-align: justify; text-justify: inter-word;">
                      <p>
                        Do not go gentle into that good night,
                        Old age should burn and rave at close of day;
                        Rage, rage against the dying of the light.
                        Though wise men at their end know dark is right,
                        Because their words had forked no lightning they
                        Do not go gentle into that good night.
                        Good men, the last wave by, crying how bright
                        Their frail deeds might have danced in a green bay,
                        Rage, rage against the dying of the light.
                        Wild men who caught and sang the sun in flight,
                        And learn, too late, they grieved it on its way,
                        Do not go gentle into that good night.
                        Grave men, near death, who see with blinding sight
                        Blind eyes could blaze like meteors and be gay,
                      </p>
                      <p class="text-bold text-center mt-1"> Professor Brand by Dylan Thomas in Christopher Nolan’s Interstellar</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

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
