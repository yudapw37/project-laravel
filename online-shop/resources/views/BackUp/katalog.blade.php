     @extends('main.mainOther')

    @section('title', 'Aqwam')

    @section('body')

     <div class="container container-240 shop-collection">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Katalog</li>
                <li class="active">{{$namacat}}</li>
            </ul>
            <!-- <div class="filter-collection-left hidden-lg hidden-md">
              <a class="btn">Filter</a>
            </div> -->
            <div class="row shop-colect">
                <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
                    <div class="close-sidebar-collection hidden-lg hidden-md">
                        <span>filter</span><i class="icon_close ion-close"></i>
                    </div>
                     @if ($catx!='promo')
                    <div class="filter filter-cate">
                        <ul class="wiget-content v2">
                            <li class="active" style="border-radius: 5px 5px 0px 0px;background: #e9e9e9;;"><div style="padding:10px 17px">KATEGORI INPRINT</div></li>
                            @foreach ($categoriesinprint as $ctgi)
                            <li class="active"><a href="/katalog/{{$ctgi->id_inprint}}">{{$ctgi->nama_inprint}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter filter-cate">
                        <li class="active" style="border-radius: 5px 5px 0px 0px;background: #e9e9e9;;"><div style="padding:10px 17px">KATEGORI BUKU</div></li>
                        <ul class="wiget-content v2">
                            @foreach ($categories as $ctg)
                            <li class="active"><a href="/katalog/{{$ctg->id_kategori}}">{{$ctg->nama_kategori}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                     @else
                        <div class="filter filter-cate">
                        <ul class="wiget-content v2">
                            <li class="active" style="border-radius: 5px 5px 0px 0px;background: #e9e9e9;;"><div style="padding:10px 17px">KATEGORI PROMO</div></li>
                            @foreach ($categoriespromo as $ctgp)
                            <li class="active"><a href="/katalog/promo{{$ctgp->id}}">{{$ctgp->kategori}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- <div class="banner">
                        <a class="image-bd hover-images" href=""><img src="{{$getBaseUrl}}img/o-banner3.jpg" alt="" class="img-reponsive"></a>
                    </div> -->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
                    <div class="e-product">
                        <!-- <div class="pd-banner">
                           <a href="#" class="image-bd effect_img2"><img src="img/shop-banner_3.jpg" alt="" class="img-reponsive"></a>
                        </div> -->

                        <div class="pd-middle">
                            <div class="view-mode view-group">
                                <a class="grid-icon col active"><img src="{{$getBaseUrl}}img/grid.png" alt=""></a>
                                <a class="grid-icon col2"><img src="{{$getBaseUrl}}img/grid2.png" alt=""></a>
                                <a class="list-icon list"><img src="{{$getBaseUrl}}img/list.png" alt=""></a>
                            </div>
                            <!-- <div class="pd-sort">
                                <div class="filter-sort">
                                    <div class="dropdown">
                                      <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="dropdown-label">Default sorting</span>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li><a href="title-ascending">Judul Buku, A-Z</a></li>
                                            <li><a href="title-descending">Judul Buku, Z-A</a></li>
                                          <li><a href="price-descending">Harga, Tinggi-Rendah</a></li>
                                          <li><a href="price-ascending">Harga, Rendah-Tinggi</a></li>
                                      </ul>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                        <div class="product-collection-grid product-grid">
                            <div class="row">
                            @if ($catx!='promo')
                                 @foreach ($buku as $bk)
                                <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4 product-item minCat">
                                    <div class="pd-bd product-inner">
                                        <div class="product-img">
                                            <a href="/detail/{{$bk->idBuku}}"><img src="{{$getBaseUrl}}img/product/pd3.jpg" alt="" class="img-reponsive"></a>
                                        </div>
                                        <div class="product-info">
                                            <div class="color-group"></div>
                                            <div class="element-list element-list-left">
                                                <ul class="desc-list">
                                                   <li>Penulis : {{$bk->penulis}}</li>
                                                    <li>ISBN : {{$bk->isbn}}</li>
                                                    <li>Cover : {{$bk->cover}}</li>
                                                </ul>
                                            </div>
                                            <div class="element-list element-list-middle">
                                                <!-- <div class="product-rating bd-rating">
                                                    <span class="star star-5"></span>
                                                    <span class="star star-4"></span>
                                                    <span class="star star-3"></span>
                                                    <span class="star star-2"></span>
                                                    <span class="star star-1"></span>
                                                    <div class="number-rating">( 896 reviews )</div>
                                                </div> -->
                                                <h3 class="product-title"><a href="/detail/{{$bk->idBuku}}">{{$bk->judul_buku}}</a></h3>
                                                <div class="product-bottom">
                                                    <div class="product-price">
                                                        <span class="product-price">Rp. {{number_format($bk->harga, 2, ',', '.')}}</span>
                                                    </div>
                                                    <a href="/detail/{{$bk->idBuku}}" class="btn-icon btn-view">
                                                        <span class="icon-bg icon-view"></span>
                                                    </a>
                                                </div>
                                                <div class="product-bottom-group">
                                                    <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addcart">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addwishlist">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-button-group">
                                                <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addcart">
                                                    <span class="icon-bg icon-cart"></span>
                                                </a>
                                                <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addwishlist">
                                                    <span class="icon-bg icon-wishlist"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                             @else
                                 @foreach ($buku as $bk)
                                <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4 product-item minCat">
                                    <div class="pd-bd product-inner">
                                        <div class="product-img">
                                            <a href="/detail/{{$bk->idBuku}}"><img src="{{$getBaseUrl}}img/product/pd3.jpg" alt="" class="img-reponsive"></a>
                                        </div>
                                        <div class="product-info">
                                            <div class="color-group"></div>
                                            <div class="element-list element-list-left">
                                                <!-- <ul class="desc-list">
                                                   <li>Penulis : {{$bk->penulis}}</li>
                                                    <li>ISBN : {{$bk->isbn}}</li>
                                                    <li>Cover : {{$bk->cover}}</li>
                                                </ul> -->
                                            </div>
                                            <div class="element-list element-list-middle">
                                                <h3 class="product-title"><a href="/detail/{{$bk->idBuku}}">{{$bk->nama_promo}}</a></h3>
                                                <div class="product-bottom">
                                                    <div class="product-price">
                                                        <span class="product-price">Rp. {{number_format($bk->harga_jadi, 2, ',', '.')}}</span>
                                                    </div>
                                                    <a href="/detail/{{$bk->idBuku}}" class="btn-icon btn-view">
                                                        <span class="icon-bg icon-view"></span>
                                                    </a>
                                                </div>
                                                <div class="product-bottom-group">
                                                    <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addcart">
                                                        <span class="icon-bg icon-cart"></span>
                                                    </a>
                                                    <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addwishlist">
                                                        <span class="icon-bg icon-wishlist"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-button-group">
                                                <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addcart">
                                                    <span class="icon-bg icon-cart"></span>
                                                </a>
                                                <a data-id="{{$bk->idBuku}}" href="#" class="btn-icon addwishlist">
                                                    <span class="icon-bg icon-wishlist"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                             @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="ml-auto mr-4">{{$buku->links()}}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
