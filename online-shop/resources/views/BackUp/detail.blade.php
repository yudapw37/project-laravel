    @extends('main.mainOther')

    @section('title', 'Aqwam')

    @section('body')
        <div class="container container-240">
            <div class="single-product-detail product-bundle product-aff">
            @if ($valpromo!='promo')
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Detail</li>
                    <li class="active">{{$buku->judul_buku}} @if ($hargajadi!='0') (Promo) @endif</li>
                    <!-- <li class="active">{{$allcategories}}</li> -->
                </ul>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">

                        <div class="flex product-img-slide">


                            <div class="product-images">
                                <div class="main-img js-product-slider">

                                    @if ($gmbrready=='1')
                                    @foreach ($gambar as $gmbr)
                                        <a href="#" class="hover-images effect"><img src="{{$getBaseUrl}}{{$gmbr->gambar}}" alt="photo" class="img-reponsive"></a>
                                    @endforeach
                                    @else
                                        <a href="#" class="hover-images effect"><img src="{{$getBaseUrl}}img/no-image.png" alt="photo" class="img-reponsive"></a>
                                    @endif
                                </div>
                            </div>
                            <div class="multiple-img-list-ver2 js-click-product">
                                 @if ($gmbrready=='1')
                                    @foreach ($gambar as $gmbr)
                                         <div class="product-col">
                                                <div class="img active">
                                                    <img src="{{$getBaseUrl}}{{$gmbr->gambar}}" alt="photo" class="img-reponsive">
                                                </div>
                                            </div>
                                    @endforeach
                                    @else
                                         <div class="product-col">
                                                <div class="img active">
                                                    <img src="{{$getBaseUrl}}img/no-image.png" alt="photo" class="img-reponsive">
                                                </div>
                                            </div>
                                    @endif


                            </div>
                        </div>


                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="single-flex">
                            <div class="single-product-info product-info product-grid-v2 s-50">
                                <p class="product-cate">
                                @if($buku->jenis_pre_order_buku == 1)
                                pre order
                                @endif
                               @if($buku->jenis_pre_order_buku == 0)
                                regular
                                @endif
                                </p>
                                <div class="product-rating">
                                    @for ($i = 1; $i < 6; $i++)
                                    @if ($i <= $reviewstars)
                                        <span style="color:orange;" class="fa fa-star s1"></span>
                                    @else
                                        <span style="color:orange;"class="fa fa-star-o s1"></span>
                                    @endif

                                    @endfor



                                    <div class="number-rating">( {{$reviewer}} ulasan )</div>
                                </div>
                                <h3 class="product-title">{{$buku->judul_buku}}</h3>
                                @if ($hargajadi!='0')
                                <div class="product-price">
                                    <span class="old">Rp. {{number_format($buku->harga, 2, ',', '.')}}</span>  <br>
                                    <span class="red">Rp. {{number_format($hargajadi, 2, ',', '.')}}</span>
                                </div>
                                 @else
                                 <div class="product-price">
                                    <span >Rp. {{number_format($buku->harga, 2, ',', '.')}}</span>
                                </div>
                                @endif
                                <div class="availability">
                                    <p class="product-inventory"> <label>Availability : </label>
                                    @if($stockbuku->total > 50)
                                       <span> In stock </span>
                                    @endif
                                    @if($stockbuku->total < 50 && $stockbuku->total > 0)
                                       <span> Limited Stock </span>
                                    @endif
                                    @if($stockbuku->total <= 0)
                                       <span style="color:red;"> Sold Out </span>
                                    @endif
                                   </p>
                                </div>
                                <div class="product-sku">
                                    <label>Penerbit : </label><span>{{$buku->penerbit}}</span>
                                </div>
                                <div class="short-desc">
                                    <p class="product-desc">Detail Produk Buku</p>
                                    <ul class="desc-list">
                                       <li>Penulis : {{$buku->penulis}}</li>
                                       <li>ISBN : {{$buku->isbn}}</li>
                                       <li>Cover : {{$buku->cover}}</li>
                                       <li>Ukuran : {{$buku->ukuran}}</li>
                                       <li>Berat : {{$buku->berat}}</li>
                                    </ul>
                                </div>


                                <div class="single-product-button-group" >
                                    <div  class="e-btn cart-qtt btn-gradient <?php if($stockbuku->total <= 0){echo 'disabled';} ?>" >
                                        <div class="e-quantity">
                                          <input disabled type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty input-text js-number" size="4">

                                       </div>
                                       <a data-id="{{$buku->idBuku}}" href="#" class="btn-add-cart addcart ">Add to cart <span class="icon-bg icon-cart v2"></span></a>
                                    </div>
                                    <a data-id="{{$buku->idBuku}}" href="#" class="e-btn btn-icon addwishlist">
                                        <span class="icon-bg icon-wishlist"></span>
                                    </a>

                                </div>

                                <div class="product-tags">
                                    <!-- <label>Tags :</label>
                                    <a href="#">Fast,</a>
                                    <a href="#">Gaming,</a>
                                    <a href="#">Strong</a> -->
                                </div>
                            </div>
                            <div class="single-product-feature s-50 hidden-xs hidden-sm">
                                <div class="bd-7">
                                    <div class="single-feature-box">
                                        <div class="single-feature-img">
                                            <img src="{{$getBaseUrl}}img/feature/credit-card2.png" alt="">
                                        </div>
                                        <div class="single-feature-info">
                                            <h3>Pembayaran Aman</h3>
                            <p>Pembayaran dilakukan dengan sangat aman.</p>
                                            <!-- <h3>Safe Payment</h3>
                                            <p>Pay with the world’s most payment methods.</p> -->
                                        </div>
                                    </div>

                                    <div class="single-feature-box">
                                        <div class="single-feature-img">
                                            <img src="{{$getBaseUrl}}img/feature/safety2.png" alt="">
                                        </div>
                                        <div class="single-feature-info">
                                            <h3>Belanja Dengan Aman</h3>
                            <p>Proteksi dari membeli sampai dengan pengiriman.</p>
                                        </div>
                                    </div>

                                    <div class="single-feature-box">
                                        <div class="single-feature-img">
                                            <img src="{{$getBaseUrl}}img/feature/truck2.png" alt="">
                                        </div>
                                        <div class="single-feature-info">
                                            <h3>Pengiriman Seluruh Indonesia</h3>
                            <p>Kita mengirimkan barang ke seuruh penjuru Indonesia</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="hot-line e-gradient">
                                    <p>Hotline</p>
                                    <div class="flex align-center tele">
                                        <img src="{{$getBaseUrl}}img/feature/hotline.png" alt="">
                                        <div class="phone-number">
                                            <p>{{$headerphone->text}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-product-tab bd-7">
                  <div class="cmt-title text-center abs">
                      <ul class="nav nav-tabs text-center">
                          <li class="active"><a data-toggle="pill" href="#desc">Description</a></li>
                          <!-- <li><a data-toggle="pill" href="#info">Specification</a></li>
                          <li><a data-toggle="pill" href="#review">Reviews</a></li> -->
                      </ul>
                  </div>
                  <div class="tab-content">
                      <div id="desc" class="tab-pane fade in active">
                          <div class="entry-content" style="padding-bottom:50px">
                              <!-- <div class="entry-img-first text-center image-bd">
                                  <img src="img/banner/675_x_350_1.jpg" alt="">
                              </div> -->
                              <div class="entry-inside">
                                  <!-- <div class="entry-element flex align-center"> -->
                                      <!-- <div class="entry-img text-center">
                                          <img src="img/product/320_x_320_1.jpg" alt="">
                                      </div> -->
                                      <div class="entry-info">
                                          <h3>Deskripsi Produk Buku</h3>
                                         {{$buku->diskripsi}}
                                          <!-- <p>Fikih merupakan kajian yang bersifat aplikatif. Dalam Islam, fikih lebih dipahami sebagai disiplin ilmu yang menyusun secara sistematis hasil ijtihad para ulama terhadap sumber hukum Islam. Dalam perkembangannya, fikih mempelajari hukum-hukum yang diambilkan dari dalil-dalil tafshili (rinci) sehingga diharapkan mampu menjawab berbagai persoalan umat bukan hanya dari aspek legalitas hukum Islam belaka.
                                        <br>
                                        Pada awalnya mazhab dalam fikih cukup banyak. Namun, yang paling dikenal adalah Mazhab Hanafi, Mazhab Maliki, Mazhab Syafi’i, dan Mazhab Hanbali. Dalam perkembangannya, keempat mazhab inilah yang diterima dan terwariskan di tengah umat Islam. Karya-karya fikih pun semakin beragam, dengan banyaknya para ulama dari berbagai mazhab tersebut. Konsekuensinya, pendapat hukum sebagai produk ijtihad pun semakin beragam.
                                        <br>
                                        Karenanya, para penuntut ilmu membutuhkan buku pegangan yang merangkum pendapat keempat mazhab. Ada banyak buku yang dikenal, tetapi buku yang ada di hadapan pembaca ini barangkali termasuk yang paling praktis. Buku yang berjudul asli Al-Fiqh ‹ala Al-Madzahib Al-Arba’ah—atau “Fikih Empat Mazhab”, di negeri asalnya (Mesir) telah dikenal oleh para penuntut ilmu Syariah, khususnya yang mempelajari perbandingan mazhab dalam fikih. Di samping tidak terlalu tebal, kompetensi penulisnya sebagai guru besar Fikih dan Usul Fikih merupakan jaminan tersendiri akan kualitas buku ini.</p> -->
                                      </div>
                                  <!-- </div> -->

                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="single-product-tab bd-7">
                  <div class="cmt-title text-center abs">
                      <ul class="nav nav-tabs text-center">
                          <li class="active"><a data-toggle="pill" href="#desc">Review</a></li>
                          <!-- <li><a data-toggle="pill" href="#info">Specification</a></li>
                          <li><a data-toggle="pill" href="#review">Reviews</a></li> -->
                      </ul>
                  </div>
                  <div class="tab-content">
                      <div id="desc" class="tab-pane fade in active">
                          <div class="entry-content" style="padding-bottom:50px">
                              <!-- <div class="entry-img-first text-center image-bd">
                                  <img src="img/banner/675_x_350_1.jpg" alt="">
                              </div> -->
                              <div class="entry-inside">
                                  <!-- <div class="entry-element flex align-center"> -->
                                      <!-- <div class="entry-img text-center">
                                          <img src="img/product/320_x_320_1.jpg" alt="">
                                      </div> -->
                                      <div class="entry-info">
                                          <h3>Review Produk Buku</h3>
                                         @foreach ($review as $rv1)
                                            @php
                                                $p3 = $rv1->rating
                                            @endphp
                                          <p>
                                               <b>  {{$rv1->nama_reviewer}}   </b>
                                               @for ($i = 1; $i < 6; $i++)
                                                    @if ($i <= $p3)
                                                        <span style="color:orange; font-size:12px;" class="fa fa-star s1"></span>
                                                    @else
                                                        <span style="color:orange; font-size:12px;"class="fa fa-star-o s1"></span>
                                                    @endif

                                                @endfor


                                                <br> - {{$rv1->text}}
                                            </p>
                                        @endforeach
                                      </div>
                                  <!-- </div> -->

                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="single-product-tab bd-7">
                  <div class="cmt-title text-center abs">
                      <ul class="nav nav-tabs text-center">
                          <li class="active"><a data-toggle="pill" href="#desc">Ulasan</a></li>
                          <!-- <li><a data-toggle="pill" href="#info">Specification</a></li>
                          <li><a data-toggle="pill" href="#review">Reviews</a></li> -->
                      </ul>
                  </div>
                  <div class="tab-content">
                      <div id="desc" class="tab-pane fade in active">
                          <div class="entry-content" style="padding-bottom:50px">
                              <!-- <div class="entry-img-first text-center image-bd">
                                  <img src="img/banner/675_x_350_1.jpg" alt="">
                              </div> -->
                              <div class="entry-inside">
                                  <!-- <div class="entry-element flex align-center"> -->
                                      <!-- <div class="entry-img text-center">
                                          <img src="img/product/320_x_320_1.jpg" alt="">
                                      </div> -->
                                      <div class="entry-info">
                                          <h3>Ulasan Produk Buku</h3>
                                           @foreach ($ulasan as $ul)
                                            @php
                                                $p3 = $ul->rating
                                            @endphp
                                          <p>
                                               <b>  {{$ul->nama_reviewer}}   </b>
                                               @for ($i = 1; $i < 6; $i++)
                                                    @if ($i <= $p3)
                                                        <span style="color:orange; font-size:12px;" class="fa fa-star s1"></span>
                                                    @else
                                                        <span style="color:orange; font-size:12px;"class="fa fa-star-o s1"></span>
                                                    @endif

                                                @endfor


                                                <br> - {{$ul->text}}
                                            </p>
                                        @endforeach
                                      </div>
                                  <!-- </div> -->

                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            @else
                <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Detail</li>
                        <li class="active">{{$buku->nama_promo}} @if ($hargajadi!='0') (Promo) @endif</li>
                        <!-- <li class="active">{{$allcategories}}</li> -->
                    </ul>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <div class="flex product-img-slide">


                                <div class="product-images">
                                    <div class="main-img js-product-slider">

                                        @if ($gmbrready=='1')
                                        @foreach ($buku as $gmbr)
                                            <a href="#" class="hover-images effect"><img src="{{$getBaseUrl}}{{$buku->gambar_buku}}" alt="photo" class="img-reponsive"></a>
                                        @endforeach
                                        @else
                                            <a href="#" class="hover-images effect"><img src="{{$getBaseUrl}}img/no-image.png" alt="photo" class="img-reponsive"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="multiple-img-list-ver2 js-click-product">
                                    @if ($gmbrready=='1')
                                        @foreach ($buku as $gmbr)
                                            <div class="product-col">
                                                    <div class="img active">
                                                        <img src="{{$getBaseUrl}}{{$gmbr->gambar_buku}}" alt="photo" class="img-reponsive">
                                                    </div>
                                                </div>
                                        @endforeach
                                        @else
                                            <div class="product-col">
                                                    <div class="img active">
                                                        <img src="{{$getBaseUrl}}img/no-image.png" alt="photo" class="img-reponsive">
                                                    </div>
                                                </div>
                                        @endif


                                </div>
                            </div>


                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="single-flex">
                                <div class="single-product-info product-info product-grid-v2 s-50">
                                    <p class="product-cate">
                                    promo
                                    </p>
                                    <div class="product-rating">
                                        @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $reviewstars)
                                            <span style="color:orange;" class="fa fa-star s1"></span>
                                        @else
                                            <span style="color:orange;"class="fa fa-star-o s1"></span>
                                        @endif

                                        @endfor



                                        <div class="number-rating">( {{$reviewer}} ulasan )</div>
                                    </div>
                                    <h3 class="product-title">{{$buku->nama_promo}}</h3>
                                    @if ($hargajadi!='0')
                                    <div class="product-price">
                                        <span class="old">Rp. {{number_format($buku->harga_jadi, 2, ',', '.')}}</span>  <br>
                                        <span class="red">Rp. {{number_format($hargaawal, 2, ',', '.')}}</span>
                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span >Rp. {{number_format($buku->harga_jadi, 2, ',', '.')}}</span>
                                    </div>
                                    @endif
                                    <div class="availability">
                                        <p class="product-inventory"> <label>Availability : </label>
                                        @if($stockbukupromo > 50)
                                        <span> In stock </span>
                                        @endif
                                        @if($stockbukupromo < 50 && $stockbukupromo > 0)
                                        <span> Limited Stock </span>
                                        @endif
                                        @if($stockbukupromo <= 0)
                                        <span style="color:red;"> Sold Out </span>
                                        @endif
                                    </p>
                                    </div>
                                    


                                    <div class="single-product-button-group" >
                                        <div  class="e-btn cart-qtt btn-gradient <?php if($stockbukupromo <= 0){echo 'disabled';} ?>" >
                                            <div class="e-quantity">
                                            <input disabled type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty input-text js-number" size="4">

                                        </div>
                                        <a data-id="{{$buku->idBuku}}" href="#" class="btn-add-cart addcart ">Add to cart <span class="icon-bg icon-cart v2"></span></a>
                                        </div>
                                        <a data-id="{{$buku->idBuku}}" href="#"class="e-btn btn-icon addwishlist">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>

                                    </div>

                                    <div class="product-tags">
                                        <!-- <label>Tags :</label>
                                        <a href="#">Fast,</a>
                                        <a href="#">Gaming,</a>
                                        <a href="#">Strong</a> -->
                                    </div>
                                </div>
                                <div class="single-product-feature s-50 hidden-xs hidden-sm">
                                    <div class="bd-7">
                                        <div class="single-feature-box">
                                            <div class="single-feature-img">
                                                <img src="{{$getBaseUrl}}img/feature/credit-card2.png" alt="">
                                            </div>
                                            <div class="single-feature-info">
                                                <h3>Pembayaran Aman</h3>
                                <p>Pembayaran dilakukan dengan sangat aman.</p>
                                                <!-- <h3>Safe Payment</h3>
                                                <p>Pay with the world’s most payment methods.</p> -->
                                            </div>
                                        </div>

                                        <div class="single-feature-box">
                                            <div class="single-feature-img">
                                                <img src="{{$getBaseUrl}}img/feature/safety2.png" alt="">
                                            </div>
                                            <div class="single-feature-info">
                                                <h3>Belanja Dengan Aman</h3>
                                <p>Proteksi dari membeli sampai dengan pengiriman.</p>
                                            </div>
                                        </div>

                                        <div class="single-feature-box">
                                            <div class="single-feature-img">
                                                <img src="{{$getBaseUrl}}img/feature/truck2.png" alt="">
                                            </div>
                                            <div class="single-feature-info">
                                                <h3>Pengiriman Seluruh Indonesia</h3>
                                <p>Kita mengirimkan barang ke seuruh penjuru Indonesia</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="hot-line e-gradient">
                                        <p>Hotline</p>
                                        <div class="flex align-center tele">
                                            <img src="{{$getBaseUrl}}img/feature/hotline.png" alt="">
                                            <div class="phone-number">
                                                <p>{{$headerphone->text}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-product-tab bd-7">
                    <div class="cmt-title text-center abs">
                        <ul class="nav nav-tabs text-center">
                            <li class="active"><a data-toggle="pill" href="#desc">Description</a></li>
                            <!-- <li><a data-toggle="pill" href="#info">Specification</a></li>
                            <li><a data-toggle="pill" href="#review">Reviews</a></li> -->
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="desc" class="tab-pane fade in active">
                            <div class="entry-content" style="padding-bottom:50px">
                                <!-- <div class="entry-img-first text-center image-bd">
                                    <img src="img/banner/675_x_350_1.jpg" alt="">
                                </div> -->
                                <div class="entry-inside">
                                    <!-- <div class="entry-element flex align-center"> -->
                                        <!-- <div class="entry-img text-center">
                                            <img src="img/product/320_x_320_1.jpg" alt="">
                                        </div> -->
                                        <div class="entry-info">
                                            <h3>Deskripsi Produk Buku</h3>
                                            {{$buku->deskripsi}}
                                            <!-- <p>Fikih merupakan kajian yang bersifat aplikatif. Dalam Islam, fikih lebih dipahami sebagai disiplin ilmu yang menyusun secara sistematis hasil ijtihad para ulama terhadap sumber hukum Islam. Dalam perkembangannya, fikih mempelajari hukum-hukum yang diambilkan dari dalil-dalil tafshili (rinci) sehingga diharapkan mampu menjawab berbagai persoalan umat bukan hanya dari aspek legalitas hukum Islam belaka.
                                            <br>
                                            Pada awalnya mazhab dalam fikih cukup banyak. Namun, yang paling dikenal adalah Mazhab Hanafi, Mazhab Maliki, Mazhab Syafi’i, dan Mazhab Hanbali. Dalam perkembangannya, keempat mazhab inilah yang diterima dan terwariskan di tengah umat Islam. Karya-karya fikih pun semakin beragam, dengan banyaknya para ulama dari berbagai mazhab tersebut. Konsekuensinya, pendapat hukum sebagai produk ijtihad pun semakin beragam.
                                            <br>
                                            Karenanya, para penuntut ilmu membutuhkan buku pegangan yang merangkum pendapat keempat mazhab. Ada banyak buku yang dikenal, tetapi buku yang ada di hadapan pembaca ini barangkali termasuk yang paling praktis. Buku yang berjudul asli Al-Fiqh ‹ala Al-Madzahib Al-Arba’ah—atau “Fikih Empat Mazhab”, di negeri asalnya (Mesir) telah dikenal oleh para penuntut ilmu Syariah, khususnya yang mempelajari perbandingan mazhab dalam fikih. Di samping tidak terlalu tebal, kompetensi penulisnya sebagai guru besar Fikih dan Usul Fikih merupakan jaminan tersendiri akan kualitas buku ini.</p> -->
                                        </div>
                                    <!-- </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
        </div>

    @endsection
