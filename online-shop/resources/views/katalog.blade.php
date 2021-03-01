@extends('main.mainOther')
@section('title', 'Aqwam')
@section('body')
    <!-- <div style="position: fixed;height: 100%;width: 100%;background: white;z-index: 9999;top: 100%;">
      <div class="row" style="font-size:25px; height:100%; overflow:auto;text-align:center;">
        <div class="col-sm-6 col-md-4" style="border:1px solid #cecece">
          <a href="/katalog/K001">Adab</a>
        </div>
        <div class="col-sm-6 col-md-4" style="border:1px solid #cecece">
          <a href="/katalog/K002">Akhir Zaman</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K003">Akhlak</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K004">Akidah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K005">Al Quran</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K006">Amalan Harian</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K007">Bahasa Arab</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K008">Biografi</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K009">Buku Anak</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K010">Buku Saku & Souvenir</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K011">Dakwah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K012">Doa dan Dzikir</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K013">Ekonomi Islam</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K014">Fikih</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K015">Hadits</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K016">Haji Umrah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K017">Ibadah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K018">Keluarga</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K019">Kesehatan</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K020">Khutbah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K021">Kisah Islami</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K022">Manajemen Hati</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K023">Muamalah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K024">Muslimah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K025">Nabi Muhammad</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K026">Parenting</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K027">Pemikiran</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K028">Pemuda</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K029">Pendidikan</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K030">Pernikahan</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K031">Puasa & Ramadhan</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K032">Referensi (Turats)</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K033">Sejarah</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K034">Shalat</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K035">Tafsir</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K036">Tips & Motivasi</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K037">Tokoh</a>
        </div>
        <div class="col-sm-6 col-md-4">
          <a href="/katalog/K038">Zakat & Sedekah</a>
        </div>

       </div>
    </div> -->
     <div class="container container-240 shop-collection">
      <ul class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li class="active">Katalog</li>
          <li class="active deadmob">{{$namacat}}</li>
          @if (Request::get('id') == '1' )
          <button onclick="getcatmobile('1')" class="float-right btn btn-gradient btnKategori" type="button" data-toggle="modal" data-target="#exampleModal" name="button">Menu Kategori</button>
          @elseif (Request::get('id') == '2' )
          <button onclick="getcatmobile('2')" class="float-right btn btn-gradient btnKategori" type="button" data-toggle="modal" data-target="#exampleModal" name="button">Menu Penerbit</button>          
          @endif
      </ul>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                @if (Request::get('id') == '1' )
                Menu Kategori
                @elseif (Request::get('id') == '2' )
                Menu Penerbit
                @elseif (Request::get('id') == '3' )
                Menu Promo
                @endif
              </h5>
            </div>
            <div class="modal-body" style="padding:0 5px!important;overflow:auto;max-height:300px;">
              <table id='listmenumobile' class="table">
                <tr>
                  <td onclick="document.getElementById('judu1').click()" style="border:1px solid red">
                    <a href="#" id="judu1">judul1</a>
                  </td>
                </tr>
                <tr>
                  <td onclick="document.getElementById('judu2').click()" style="border:1px solid red">
                    <a href="#" id="judu2">judul2</a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer" style="margin-top:5px;border-top:0px solid white!important">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="filter-collection-left hidden-lg hidden-md">
        <a class="btn">Filter</a>
      </div> -->
      <div class="row shop-colect">
          <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
            <div class="rBannerCon">
              <div class="rBannerConTxt">
                <h3>IMPRINT</h3>
              </div>
              <img src="{{$getBaseUrl}}img/banner/imgTitle.png" class="rBannerConImg">
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
              <!-- <div class="close-sidebar-collection hidden-lg hidden-md">
                  <span>filter</span><i class="icon_close ion-close"></i>
              </div>
               @if ($catx!='promo')
              <div class="filter filter-cate">
                  <ul class="wiget-content v2">
                      <li class="active" style="border-radius: 5px 5px 0px 0px;background: #e9e9e9;;"><div style="padding:10px 17px">KATEGORI PENERBIT</div></li>
                      @foreach ($categoriesinprint as $ctgi)
                      <li class="active"><a href="/katalog/{{$ctgi->id_inprint}}">{{$ctgi->nama_inprint}} </a></li>
                      @endforeach
                  </ul>
              </div>
              <div class="filter filter-cate">
                  <li class="active" style="border-radius: 5px 5px 0px 0px;background: #e9e9e9;;"><div style="padding:10px 17px">KATEGORI TEMA</div></li>
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
              @endif -->
              <!-- <div class="banner">
                  <a class="image-bd hover-images" href=""><img src="{{$getBaseUrl}}img/o-banner3.jpg" alt="" class="img-reponsive"></a>
              </div> -->
          </div>
          <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
            <div class="catUpperHome hidden-xs hidden-sm">
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
              <div class="e-product" style="min-height:500px">
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
                      <div class="row" style="display: flex; flex-wrap: wrap;">
                      @if ($catx!='promo')
                           @foreach ($katalogbuku as $bk)
                          <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 product-item product-item2 minCat" style="margin-bottom:20px">
                              <div class="pd-bd product-inner lPad">
                                <a data-id="{{$bk['idBuku']}}" class="btn-icon addwishlist hidden-md hidden-lg wshlstMob">
                                  <span class="fa fa-heart" style="font-size: 20px;color:#fff"></span>
                                </a>
                                  <div class="product-img">
                                      <a href="/detail/{{$bk['idBuku']}}"><img src="{{$urlImage}}{{$bk['gambar_buku']}}" alt="" class="img-reponsive"></a>
                                  </div>
                                  <div class="product-info">
                                      <div class="element-list element-list-left">
                                          <ul class="desc-list">
                                             <li>Penulis : {{$bk['penulis']}}</li>
                                              <li>ISBN : {{$bk['isbn']}}</li>
                                              <li>Cover : {{$bk['cover']}}</li>
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
                                          <h3 class="product-title">
                                            <a href="/detail/{{$bk['idBuku']}}">
                                              <span class="judulMobile">
                                                @if (strlen($bk['judul_buku']) >30 )
                                                  {{substr($bk['judul_buku'],0,30) }} ...
                                                @else
                                                  {{$bk['judul_buku']}}
                                                @endif
                                              </span>
                                              <span class="judulDesktop">{{$bk['judul_buku']}}</span>
                                            </a>
                                          </h3>
                                          <div class="product-bottom">
                                                @if ($bk['harga_jadi'] != '0')
                                                    <div class="product-price">
                                                      <span class="redBox">Rp. {{number_format($bk['harga_jadi'], 0, ',', '.')}}</span>
                                                      <br>
                                                      <span class="old" style="font-size:12px!important;">Rp. {{number_format($bk['harga'], 0, ',', '.')}}</span>
                                                    </div>
                                                @else
                                                <div class="product-price" style="/*padding-top:9px;*/"><span >Rp. {{number_format($bk['harga'], 0, ',', '.')}}</span></div>
                                                @endif
                                                <div class="hidden-lg hidden-md" style="margin-right:8px;margin-top:8px;">
                                                  <a data-id="{{$bk['idBuku']}}"  class="btn-icon addcart" >
                                                    <span class="icon-bg icon-cart"></span>
                                                  </a>
                                                </div>
                                              <!-- <a href="/detail/{{$bk['idBuku']}}" class="btn-icon btn-view">
                                                  <span class="icon-bg icon-view"></span>
                                              </a> -->
                                          </div>
                                          <div class="product-bottom-group">
                                              <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addcart">
                                                  <span class="icon-bg icon-cart"></span>
                                              </a>
                                              <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addwishlist">
                                                  <span class="icon-bg icon-wishlist"></span>
                                              </a>
                                          </div>
                                      </div>
                                      <div class="product-button-group lPadG">
                                          <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addcart">
                                              <span class="icon-bg icon-cart"></span>
                                          </a>
                                          <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addwishlist">
                                              <span class="icon-bg icon-wishlist"></span>
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                       @else
                           @foreach ($katalogbuku as $bk)
                          <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3 product-item product-item2 minCat" style="margin-bottom:20px">
                              <div class="pd-bd product-inner lPad">
                                  <div class="product-img">
                                      <a href="/detail/{{$bk['idBuku']}}"><img src="{{$urlImage}}{{$bk['gambar_buku']}}" alt="" class="img-reponsive"></a>
                                  </div>
                                  <div class="product-info">
                                      <div class="element-list element-list-left">
                                      </div>
                                      <div class="element-list element-list-middle">
                                          <h3 class="product-title">
                                            <a href="/detail/{{$bk['idBuku']}}">
                                              <span class="judulMobile">
                                                @if (strlen($bk['nama_promo']) >30 )
                                                  {{substr($bk['nama_promo'],0,30) }} ...
                                                @else
                                                  {{$bk['nama_promo']}}
                                                @endif
                                              </span>
                                              <span class="judulDesktop">{{$bk['nama_promo']}}</span>
                                            </a>
                                          </h3>
                                          <div class="product-bottom">
                                            @if ($bk['harga_jadi'] != '0')
                                                <div class="product-price"><span class="redBox">Rp. {{number_format($bk['harga_jadi'], 0, ',', '.')}}</span>
                                                <br> <span class="old" style="font-size:12px!important;">Rp. {{number_format($bk['harga'], 0, ',', '.')}}</span></div>
                                            @else
                                            <div class="product-price" style="/*padding-top:9px;*/"><span >Rp. {{number_format($bk['harga'], 0, ',', '.')}}</span></div>
                                            @endif
                                            <div class="hidden-lg hidden-md" style="margin-right:8px;margin-top:8px;">
                                              <a data-id="{{$bk['idBuku']}}"  class="btn-icon addcart" >
                                                <span class="icon-bg icon-cart"></span>
                                              </a>
                                            </div>
                                              <!-- <div class="product-price">
                                                  <span class="product-price">Rp. {{number_format($bk['harga_jadi'], 2, ',', '.')}}</span>
                                              </div> -->
                                              <a href="/detail/{{$bk['idBuku']}}" class="btn-icon btn-view">
                                                  <span class="icon-bg icon-view"></span>
                                              </a>
                                          </div>
                                          <div class="product-bottom-group">
                                              <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addcart">
                                                  <span class="icon-bg icon-cart"></span>
                                              </a>
                                              <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addwishlist">
                                                  <span class="icon-bg icon-wishlist"></span>
                                              </a>
                                          </div>
                                      </div>
                                      <div class="product-button-group lPadG">
                                          <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addcart">
                                              <span class="icon-bg icon-cart"></span>
                                          </a>
                                          <a data-id="{{$bk['idBuku']}}" href="#" class="btn-icon addwishlist">
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
                    <center>
                      <!-- <div style="margin:0 4em">{{$buku->links()}}</div> -->
                      <div style="margin:0 2em">
                        @if ($buku->hasPages())
                          <ul class="pagination pagination-sm">
                              {{-- Previous Page Link --}}
                              @if ($buku->onFirstPage())
                                  <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                              @else
                                  <li class="page-item"><a class="page-link" href="{{ $buku->previousPageUrl().'&q='.Request::get('q') }}" rel="prev">&laquo;</a></li>
                              @endif
                              @if($buku->currentPage() > 3)
                                  <li class="page-item hidden-xs"><a class="page-link" href="{{ $buku->url(1).'&q='.Request::get('q') }}">1</a></li>
                              @endif
                              @if($buku->currentPage() > 4)
                                  <li class="page-item disabled hidden-xs" style="border: 0px solid #f0f0f0;"><span class="page-link" style="border-radius:5px;border-color:#f1f1f1!important">...</span></li>
                              @endif
                              @foreach(range(1, $buku->lastPage()) as $i)
                                  @if($i >= $buku->currentPage() - 2 && $i <= $buku->currentPage() + 2)
                                      @if ($i == $buku->currentPage())
                                          <li class="page-item active"><span style="border-radius:5px;border-color:#f1f1f1!important;background:#f8f8f8;color:#999!important" class="page-link">{{ $i }}</span></li>
                                      @else
                                          <li class="page-item" ><a class="page-link" href="{{ $buku->url($i).'&q='.Request::get('q') }}">{{ $i }}</a></li>
                                      @endif
                                  @endif
                              @endforeach
                              @if($buku->currentPage() < $buku->lastPage() - 3)
                                  <li class="page-item disabled hidden-xs"><span style="border-radius:5px;border-color:#f1f1f1!important" class="page-link">...</span></li>
                              @endif
                              @if($buku->currentPage() < $buku->lastPage() - 2)
                                  <li class="page-item hidden-xs"><a class="page-link" href="{{ $buku->url($buku->lastPage()).'&q='.Request::get('q') }}">{{ $buku->lastPage() }}</a></li>
                              @endif
                              {{-- Next Page Link --}}
                              @if ($buku->hasMorePages())
                                  <li class="page-item"><a class="page-link" href="{{ $buku->nextPageUrl().'&q='.Request::get('q') }}" rel="next">&raquo;</a></li>
                              @else
                                  <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                              @endif
                          </ul>
                          @endif
                      </div>
                    </center>
                  </div>
              </div>
          </div>
      </div>
      </div>
      <script>
          function getcatmobile(x){
              if (x=='1'){
                  console.log(x);
                   jQuery.ajax({
                      url: "{{ url('/m_semua') }}",
                      method: 'get',
                      success: function(response){
                          var get = ""
                          for (i in response) {
                           get += '<tr><td onclick="document.getElementById(`'+response[i].id_kategori+'`).click()" style="border-bottom:2px solid #c4c4c463;"><a href="/katalog/'+response[i].id_kategori+'?id=1" id="'+response[i].id_kategori+'">'+response[i].nama_kategori+'</a></td></tr>'
                          }
                           document.getElementById("listmenumobile").innerHTML = get;
                      }
                  });
              }
              else if (x=='2'){
                  console.log(x);
                  jQuery.ajax({
                      url: "{{ url('/m_penerbit') }}",
                      method: 'get',
                      success: function(response){
                          var get = ""
                          for (i in response) {
                           get += '<tr><td onclick="document.getElementById(`'+response[i].id_inprint+'`).click()" style="border-bottom:2px solid #c4c4c463"><a href="/katalog/'+response[i].id_inprint+'?id=2" id="'+response[i].id_inprint+'">'+response[i].nama_inprint+'</a></td></tr>'
                          }
                           document.getElementById("listmenumobile").innerHTML = get;
                      }
                  });
              }
              else if (x=='3'){
                  console.log(x);
                  jQuery.ajax({
                      url: "{{ url('/m_promo') }}",
                      method: 'get',
                      success: function(response){
                          console.log(response);
                          var get = ""
                          for (i in response) {
                           get += '<tr><td onclick="document.getElementById(`'+response[i].idp+'`).click()" style="border-bottom:2px solid #c4c4c463"><a href="/katalog/promo'+response[i].idp+'?id=3" id="'+response[i].idp+'">'+response[i].kategori+'</a></td></tr>'
                          }
                           document.getElementById("listmenumobile").innerHTML = get;
                      }
                  });
              }
          }
      </script>
  @endsection
