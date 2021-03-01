    @extends('main.mainOther')
    @section('title', 'Aqwam')
    @section('body')
        <!-- <div class="container container-240"> -->
            <div class="single-product-detail product-bundle product-aff">
              @if ($valpromo!='promo')
              <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Detail</li>
                    <li class="active hidden-sm hidden-xs">{{$buku->judul_buku}} @if ($hargajadi!='0') (Promo) @endif</li>
                    <!-- <li class="active">{{$allcategories}}</li> -->
                </ul>
                <div class="row flexDetail">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="boxImgDtl">
                        <div class="flex product-img-slide">
                          <div class="product-images">
                            <div class="main-img js-product-slider">
                              @if ($gmbrready=='1')
                              @foreach ($gambar as $gmbr)
                              <a href="#" class="hover-images effect"><img src="{{$urlImage}}{{$gmbr['gambar']}}" alt="photo" class="img-reponsive"></a>
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
                                <img src="{{$urlImage}}{{$gmbr['gambar']}}" alt="photo" class="img-reponsive">
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
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="single-flex detDesc">
                            <div class="single-product-info product-info product-grid-v2 s-50 descPad" style="height:100%;border:2px solid #cecece;border-radius:10px; padding:10px; margin-right:10px; font-size:15px;">
                                <div style="margin-bottom:10px;">
                                  <span style="background:red;padding:6px 20px;;font-weight:400;font-size:13px;color:white;width:auto;text-transform: uppercase">
                                    @if($buku->jenis_pre_order_buku == 1)
                                    pre order
                                    @endif
                                    @if($buku->jenis_pre_order_buku == 0)
                                    regular
                                    @endif
                                  </span>
                                </div>
                                <div style="display:flex;margin:8px 0 5px;flex-wrap: wrap">
                                  <div style="padding:0;min-width:110px;">
                                    @if($reviewstars > 1)
                                    @for ($i = 1; $i < 6; $i++)
                                    @if ($i <= $reviewstars)
                                    <span style="color:orange;" class="fa fa-star s1"></span>
                                    @else
                                    <span style="color:orange;"class="fa fa-star-o s1"></span>
                                    @endif
                                    @endfor
                                    @else
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    @endif
                                  </div>
                                  <div style="padding:0;margin:0">
                                    <p class="number-rating">( {{$reviewer}} ulasan )</p>
                                  </div>
                                </div>
                                <div style="height:auto!important" class="text-bold">{{$buku->judul_buku}}</div>
                                <div>
                                  @if ($hargajadi!='0')
                                  <div style="height:auto!important">
                                    <span style="text-decoration: line-through;font-size:12px;">Rp. {{number_format($buku->harga, 2, ',', '.')}}</span>  <br>
                                    <span style="color:red;font-weight:700">Rp. {{number_format($hargajadi, 2, ',', '.')}}</span>
                                  </div>
                                  @else
                                  <div>
                                    <span style="color:red;font-weight:700">Rp. {{number_format($buku->harga, 2, ',', '.')}}</span>
                                  </div>
                                  @endif
                                </div>
                                <div>
                                    <p>Status Buku : </p>
                                    @if($stockbuku->total > 50)
                                       <span style="font-weight:700"> Buku Tersedia </span>
                                    @endif
                                    @if($stockbuku->total < 50 && $stockbuku->total > 0)
                                       <span style="font-weight:700"> Buku Terbatas </span>
                                    @endif
                                    @if($stockbuku->total <= 0)
                                       <span style="font-weight:700;color:red;"> Buku Habis </span>
                                    @endif
                                </div>
                                <div>
                                    <p>Penerbit </p>
                                    <span style="font-weight:700">{{$buku->penerbit}}</span>
                                </div>
                                <div>
                                  <p>Penulis </p>
                                  <span style="font-weight:700">{{$buku->penulis}}</span>
                                </div>
                                <div>
                                  <p>ISBN </p>
                                  <span style="font-weight:700">{{$buku->isbn}}</span>
                                </div>
                                <div>
                                  <p>Cover </p>
                                  <span style="font-weight:700">{{$buku->cover}}</span>
                                </div>
                                <div>
                                  <p>Ukuran | Berat </p>
                                  <span style="font-weight:700">{{$buku->ukuran}} | {{$buku->berat}}</span>
                                </div>
                                <div class="single-product-button-group" >
                                    <div class="mr-s <?php if($stockbuku->total <= 0){echo 'disabled';} ?>" >
                                       <a data-id="{{$buku->idBuku}}" href="#" style="padding: 5px 50px!important" class="btn btn-primary addcart ">Beli Buku</a>
                                       <!-- <a data-id="{{$buku->idBuku}}" href="#" style="color:white" class="btn-add-cart addcart ">Add to cart <span class="icon-bg icon-cart v2"></span></a> -->
                                    </div>
                                    <div style="min-width:49px;padding:0">
                                      <a data-id="{{$buku->idBuku}}" href="#" style="display:flex;justify-content:center;align-items:center;background:lightgrey" class="e-btn btn-icon addwishlist">
                                        <span class="fa fa-heart" style="display:flex!important;justify-content:center;align-items:center;color:white;font-size: 21px;margin-top: 1px;"></span>
                                      </a>
                                    </div>
                                </div>
                                <div class="product-tags">
                                    <!-- <label>Tags :</label>
                                    <a href="#">Fast,</a>
                                    <a href="#">Gaming,</a>
                                    <a href="#">Strong</a> -->
                                </div>
                            </div>
                            <div class="single-product-feature s-50 hidden-xs hidden-sm" style="border:2px solid #cecece;border-radius:10px; padding:10px;">
                                <div style="display: flex;justify-content:center;flex-direction: column;height:100%">
                                  <img src="{{$getBaseUrl}}img/banner/sliderKanan.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
                <div class="single-product-tab">
                  <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
                  <div class="container container-240">
                    <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -54px 0 0;" alt="">
                    <h4 style="color:white;position:absolute;margin:-25px 0 0 90px">DESKRIPSI</h4>
                    <div class="entry-content" style="padding:50px 0">
                      <div class="entry-inside">
                              <div class="entry-info">
                                 {!!$buku->diskripsi!!}
                              </div>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="single-product-tab">
                  <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
                  <div class="container container-240">
                    <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -54px 0 0;" alt="">
                    <h4 style="color:white;position:absolute;margin:-22px 0 0 104px">REVIEW</h4>
                    <div class="entry-content" style="padding:50px 0">
                      <div class="entry-inside">
                        <div class="entry-info">
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
                      </div>
                  </div>
                  </div>
                </div>
                <div class="single-product-tab">
                  <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
                  <div class="container container-240">
                    <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -54px 0 0;" alt="">
                    <h4 style="color:white;position:absolute;margin:-22px 0 0 104px">ULASAN</h4>
                    <div class="entry-content" style="padding:50px 0">
                        <div class="entry-inside">
                          <div class="entry-info">
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
                        </div>
                    </div>
                  </div>
                </div>
              @else
                <div class="container">
                  <ul class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li class="active">Detail</li>
                      <li class="active hidden-sm hidden-xs">{{$buku->nama_promo}} @if ($hargajadi!='0') (Promo) @endif</li>
                      <!-- <li class="active">{{$allcategories}}</li> -->
                  </ul>
                  <div class="row flexDetail">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="boxImgDtl">
                        <div class="flex product-img-slide">
                          <div class="product-images">
                            <div class="main-img js-product-slider">
                              @if ($gmbrready=='1')
                              @foreach ($gambar as $gmbr)
                              <a href="#" class="hover-images effect"><img src="{{$urlImage}}{{$gmbr['gambar']}}" alt="photo" class="img-reponsive"></a>
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
                                <img src="{{$urlImage}}{{$gmbr['gambar']}}" alt="photo" class="img-reponsive">
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
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="single-flex detDesc">
                            <div class="single-product-info product-info product-grid-v2 s-50 descPad" style="height:100%;border:2px solid #cecece;border-radius:10px; padding:10px; margin-right:10px; font-size:15px;">
                                <div style="margin-bottom:10px;">
                                  <span style="background:red;padding:6px 20px;;font-weight:400;font-size:13px;color:white;width:auto;text-transform: uppercase">
                                    PROMO
                                  </span>
                                </div>
                                <div style="display:flex;margin:8px 0 5px;flex-wrap: wrap">
                                  <div style="padding:0;min-width:110px;">
                                    @if($reviewstars > 1)
                                    @for ($i = 1; $i < 6; $i++)
                                    @if ($i <= $reviewstars)
                                    <span style="color:orange;" class="fa fa-star s1"></span>
                                    @else
                                    <span style="color:orange;"class="fa fa-star-o s1"></span>
                                    @endif
                                    @endfor
                                    @else
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    <span style="color:orange;" class="fa fa-star-o s1"></span>
                                    @endif
                                  </div>
                                  <div style="padding:0;margin:0">
                                    <p class="number-rating">( {{$reviewer}} ulasan )</p>
                                  </div>
                                </div>
                                <div style="height:auto!important" class="text-bold">{{$buku->nama_promo}}</div>
                                <div>
                                  @if ($hargajadi!='0')
                                  <div style="height:auto!important">
                                    <span style="text-decoration: line-through;font-size:12px;">Rp. {{number_format($hargaawal, 2, ',', '.')}}</span>  <br>
                                    <span style="color:red;font-weight:700">Rp. {{number_format($hargajadi, 2, ',', '.')}}</span>
                                  </div>
                                  @else
                                  <div>
                                    <span style="color:red;font-weight:700">Rp. {{number_format($buku->hargaawal, 2, ',', '.')}}</span>
                                  </div>
                                  @endif
                                </div>
                                <div>
                                    <p>Status Buku : </p>
                                    @if($stockbuku->total > 50)
                                       <span style="font-weight:700"> Buku Tersedia </span>
                                    @endif
                                    @if($stockbuku->total < 50 && $stockbuku->total > 0)
                                       <span style="font-weight:700"> Buku Terbatas </span>
                                    @endif
                                    @if($stockbuku->total <= 0)
                                       <span style="font-weight:700;color:red;"> Buku Habis </span>
                                    @endif
                                </div>
                                <!-- <div>
                                    <p>Penerbit </p>
                                    <span style="font-weight:700">{{$buku->penerbit}}</span>
                                </div>
                                <div>
                                  <p>Penulis </p>
                                  <span style="font-weight:700">{{$buku->penulis}}</span>
                                </div>
                                <div>
                                  <p>ISBN </p>
                                  <span style="font-weight:700">{{$buku->isbn}}</span>
                                </div>
                                <div>
                                  <p>Cover </p>
                                  <span style="font-weight:700">{{$buku->cover}}</span>
                                </div>
                                <div>
                                  <p>Ukuran | Berat </p>
                                  <span style="font-weight:700">{{$buku->ukuran}} | {{$buku->berat}}</span>
                                </div> -->
                                <div class="single-product-button-group" >
                                  <div class="mr-s <?php if($stockbuku->total <= 0){echo 'disabled';} ?>" >
                                     <a data-id="{{$buku->idBuku}}" href="#" style="padding: 5px 50px!important" class="btn btn-primary addcart ">Beli Buku</a>
                                     <!-- <a data-id="{{$buku->idBuku}}" href="#" style="color:white" class="btn-add-cart addcart ">Add to cart <span class="icon-bg icon-cart v2"></span></a> -->
                                  </div>
                                  <div style="min-width:49px;padding:0">
                                    <a data-id="{{$buku->idBuku}}" href="#" style="display:flex;justify-content:center;align-items:center;background:lightgrey" class="e-btn btn-icon addwishlist">
                                      <span class="fa fa-heart" style="display:flex!important;justify-content:center;align-items:center;color:white;font-size: 21px;margin-top: 1px;"></span>
                                    </a>
                                  </div>
                                </div>
                                <div class="product-tags">
                                    <!-- <label>Tags :</label>
                                    <a href="#">Fast,</a>
                                    <a href="#">Gaming,</a>
                                    <a href="#">Strong</a> -->
                                </div>
                            </div>
                            <div class="single-product-feature s-50 hidden-xs hidden-sm" style="border:2px solid #cecece;border-radius:10px; padding:10px;">
                              <div style="display: flex;justify-content:center;flex-direction: column;height:100%">
                                <img src="{{$getBaseUrl}}img/banner/sliderKanan.png" alt="">
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="single-product-tab">
                  <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
                  <div class="container container-240">
                    <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -54px 0 0;" alt="">
                    <h4 style="color:white;position:absolute;margin:-25px 0 0 90px">DESKRIPSI</h4>
                    <div class="entry-content" style="padding:50px 0">
                      <div class="entry-inside">
                        <div class="entry-info">
                          @if($buku->diskripsi)
                           {!!$buku->diskripsi!!}
                          @else
                           -
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
        <!-- </div> -->
    @endsection
