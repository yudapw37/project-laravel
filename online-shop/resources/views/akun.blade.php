@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')


<div class="container container-240 shop-collection catleft cAtas">
  <div class="w-100 conDataDiri" style="font-family:arial;">
    <div style="display:flex;justify-content:center">
      <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -98px 0 0;" alt="">
      <h4 style="color:white;position:absolute;margin:-61px 0 0">AHLAN WA SAHLAN!</h4>
    </div>
    <div class="cCon1">
      <div class="row">
        <div class="col-md-3 col-sm-12 conDD1" style="height:125px">
          <p class="text-left text-bold" style="font-size:15px;" id="isiNamaDisini" > {{$nama}}</p>
          <p class="text-left" style="font-size:12px;">Username : <span id="isiUsernameDisini">{{$userid}}</span></p>
          <p class="text-left" style="font-size:12px;">Email : <span id="isiEmailDisini">{{$email}}</span></p>
          <p class="text-left hidden-sm hidden-xs" style="font-size:12px;">No HP : <span id="isiHPDisini">{{$telephone}}</span></p>

        </div>
        <div class="col-md-3 hidden-sm hidden-xs" style="height:125px">
          <p class="text-left text-bold" style="font-size:15px;"> Alamat</p>
          <p class="text-left" style="font-size:12px;">- <span id="isiAlamatDisini">{{$alamat}}</span></p>
        </div>
        <div class="col-md-3 col-sm-12 conDD2" style="height:125px">
          <p class="text-left text-bold" style="font-size:15px;"> Type User</p>
          <p class="text-left" style="font-size:12px; margin-left:10px;">{{$jenis_reseller}}</p>
          <p class="text-left text-bold" style="font-size:15px;"> Diskon Tercapai</p>
          <p class="text-left" style="font-size:12px;margin-left:10px;"> {{$diskon}} %</p>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs" style="height:125px">
          <table class="w-100">
            <tr>
              <td>
                <center>
                  <!-- <a href="#" class="btn btn-primary" style="width:120px;margin-bottom:5px;">Edit Data</a> -->
                  <!-- Button trigger modal -->
                  <button onclick="btnEdtDataweb()" id="edtData" type="button" style="width:120px;margin-bottom:5px;" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropEdt">
                    Ubah Data Diri
                  </button>
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <!-- <a href="#" class="btn btn-primary" style="width:120px;margin-bottom:5px">Ubah Password</a> -->
                  <!-- Button trigger modal -->
                  <button id="edtPass" type="button" style="width:120px;margin-bottom:5px;" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropPass">
                    Ubah Password
                  </button>
                </center>
              </td>
            </tr>
            @if( "$jenis_reseller" != 'Member Reseller')

            <tr>
              <td>
                <center>
                  <button onclick="updatereseller()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Daftar Reseller
                  </button>
                  <!-- <a href="/reseller" class="btn btn-primary" style="width:120px">Daftar Reseller</a> -->
                </center>
              </td>
            </tr>

            @endif
          </table>
          <br>
        </div>
      </div>
    </div>
    <div class="hidden-lg cCon2">
      <table class="w-100">
        <tr>
          <td>
            <center>
              <button onclick="btnEdtData()" class="btn btn-primary" style="width:90px;margin-bottom:5px;"><p>Ubah</p>Data Diri</button>
            </center>
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <button onclick="btnEdtPass()" class="btn btn-primary" style="width:90px;margin-bottom:5px"><p>Ubah</p> Password</button>
            </center>
          </td>
        </tr>
          @if( "$jenis_reseller" != 'Member Reseller')
        <tr>
          <td>
            <center>
              <button onclick="updatereseller()" type="button" class="btn btn-primary" style="width:90px;" data-toggle="modal" data-target="#exampleModal">
                <p>Daftar</p> Reseller
              </button>
              <!-- <a href="/reseller" class="btn btn-primary" style="width:90px;"><p>Daftar</p> Reseller</a> -->
            </center>
          </td>
        </tr>
         @endif
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Daftar Reseller</h5>
          </div>
          <div class="modal-body" style="padding-bottom: 6em">
            <p style="text-align:justify">
              Daftarkan diri anda menjadi reseller <span class="text-bold text-danger">AQWAM</span> untuk mendapatkan promo-promo menarik khusus reseller. hubungi Admin <span class="text-bold" id="reseleradmindata"> 0899999999 </span> untuk mendaftarkan diri anda menjadi reseller <span class="text-bold text-danger">AQWAM</span>.
            </p>
            <button type="button" class="btn btn-secondary" style="position: absolute;margin-top: 2em;right:2em;" data-dismiss="modal">Close</button>
          </div>
          <!-- <div class="modal-footer">
          </div> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
          <div class="modal-header">
            <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>

          </div>
          <div class="modal-body" style="padding: 0 5px!important;">
            <div style="padding:0px 5px;overflow:auto">
              <table class="table table-bordered" id="tblorddetail">
                <!-- <tr>
                <td>No Order</td>
                <td>123123123</td>
              </tr>
              <tr>
              <td>Pembeli :</td>
              <td>Agung</td>
            </tr>
            <tr>
            <td>No Hp</td>
            <td>08999999</td>
          </tr>
          <tr>
          <td>Alamat Pengiriman</td>
          <td> Jl Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga Jawa Tengah</td>
        </tr>
        <tr>
        <td colspan="2">
        barang :
        <table class="table table-bordered">
        <tr>
        <th>Kode Barang</th>
        <th>Nama Buku</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Diskon</th>
        <th>Total</th>
      </tr>
      <tr>
      <td>123123</td>
      <td>Cara Memakan Nasi</td>
      <td>12</td>
      <td>12000</td>
      <td>12%</td>
      <td>144000</td>
    </tr>
    <tr>
    <td>123123</td>
    <td>Cara Memakan Nasi</td>
    <td>12</td>
    <td>12000</td>
    <td>12%</td>
    <td>144000</td>
  </tr>
</table>
</td>
</tr>
<tr>
<td>Ekspedisi</td>
<td>JNE(REG)</td>
</tr>
<tr>
  <td>Harga Awal</td>
  <td>288000</td>
</tr>
<tr>
  <td>Biaya Ekspedisi</td>
  <td>20000</td>
</tr>
<tr>
  <td>diskon</td>
  <td>34560</td>
</tr>
<tr>
  <td>Total harga</td>
  <td>253440</td>
</tr> -->
</table>
            </div>
          </div>
          <div class="modal-footer">
            <a id="btnUlasBarang" href="#" class="btn btn-success d-none">Ulas Pesanan</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit data -->
    <div class="modal fade" id="staticBackdropEdt" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
          <div class="modal-header">
            <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Diri</h5>
          </div>
          <div style="padding: 0px 10px" class="modal-body">
            <div style="width:100%;">
              <h4 class="mt-1">UserName</h4>
              <input id="usernameedt" type="text" class="form-control mt-s" name="username"  value="">
              <h4 class="mt-1">Nama</h4>
              <input id="namaedt" type="text" class="form-control mt-s" name="nama" value="">
              <h4 class="mt-1">Email</h4>
              <input id="emailedt" type="text" class="form-control mt-s" name="email"  value="">
              <h4 class="mt-1">No HP</h4>
              <input id="hpedt" type="text" class="form-control mt-s" name="telephone"  value="">
             <h4 class="mt-1">Alamat</h4>
              <textarea id="alamatedt" name="alamat"  class="form-control mt-s" rows="4" cols="80"></textarea>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" onclick="editakun()" class="btn btn-success">Simpan</button>
          </div>
          <div>
            <h5 style="padding:10px; color:red; display: none; text-align: center;" id="edterrorakun">Error</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="staticBackdropPass" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
          <div class="modal-header">
            <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Diri</h5>
          </div>
          <div style="padding: 0px 10px" class="modal-body">
            <div style="width:100%;">
              <h4 class="mt-1">Password lama</h4>
              <input id="inptPassLama" type="password" class="form-control mt-s" style="float:left" name="inptPass" value="">
              <div onclick="passVis1()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:9px;height:32px;padding-top:7px;">
                <i id="hide1" class="fa fa-eye-slash"></i>
              </div>
              <h4 class="mt-3">Password Baru</h4>
              <input id="inptPassBaru" type="password" class="form-control mt-s" style="float:left" name="inptPass" value="">
              <div onclick="passVis2()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:9px;height:32px;padding-top:7px;">
                <i id="hide2" class="fa fa-eye-slash"></i>
              </div>
              <h4 class="mt-3">Ulang Password Baru</h4>
              <input id="inptPassConfirm" type="password" class="form-control mt-s" style="float:left" name="inptPass" value="">
              <div onclick="passVis3()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:9px;height:32px;padding-top:7px;">
                <i id="hide3" class="fa fa-eye-slash"></i>
              </div>
            </div>
          </div>

          <div class="modal-footer mt-5">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" onclick="editpass()" class="btn btn-success">Simpan</button>
          </div>
          <div>
            <h5 style="padding:10px; color:red; display: none; text-align: center;" id="passerrorakun">Error</h5>
          </div>
        </div>
      </div>
    </div>

  </div>
            <div class="filter-collection-left d-none">
              <a class="btnAkn btn-gradient">Menu</a>
            </div>
            <div class="row shop-colect">
                <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar aknSide" style="padding:0" id="filter-sidebar">
                  <div class="rBannerCon" >
                    <div class="rBannerConTxt">
                      <h3>Menu</h3>
                    </div>
                    <img src="img/banner/imgTitle.png" class="rBannerConImg">
                    <div class="rBannerConBtm">
                      <div class="rBannerConBtmSdw">
                          <a  onclick="midBox('Invoice')" style="cursor:pointer"><h3>Invoice </h3></a>
                          <a  onclick="midBox('Wishlist')" style="cursor:pointer"><h3>Wishlist </h3></a>
                          <a  onclick="midBox('Order')" style="cursor:pointer"><h3>Order </h3></a>
                          <a  onclick="midBox('Order History')" style="cursor:pointer"><h3>Order History </h3></a>
                          <a  onclick="midBox('Order Ditahan')" style="cursor:pointer"><h3>Order Ditahan </h3></a>
                          <a  onclick="midBox('Alamat')" style="cursor:pointer"><h3>Alamat </h3></a>
                      </div>
                    </div>
                  </div>
                    <!-- <div id="filter" class="close-sidebar-collection btn-gradient hidden-lg hidden-md">
                        <span>Menu</span><i class="icon_close ion-close"></i>
                    </div>
                    <div class="filter filter-cate">
                        <ul class="wiget-content v3">
                          <li class="active"><div style="background:#e9e9e9;padding:10px 17px" style="cursor: context-menu" disabled>Menu</div>
                                <ul class="wiget-content v4">
                                  <li onclick="midBox('Invoice')"><a style="cursor:pointer"><h3>Invoice </h3></a></li>
                                  <li onclick="midBox('Wishlist')"><a style="cursor:pointer"><h3>Wishlist </h3></a></li>
                                  <li onclick="midBox('Order')"><a style="cursor:pointer"><h3>Order </h3></a></li>
                                  <li onclick="midBox('Order History')"><a style="cursor:pointer"><h3>Order History</h3></a></li>
                                  <li onclick="midBox('Order Ditahan')"><a style="cursor:pointer"><h3>Order Ditahan</h3></a></li>
                                  <li onclick="midBox('Alamat')"><a style="cursor:pointer"><h3>Alamat </h3></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> -->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 collection-list" style="padding-top:32px;">
                  <div class="boxAkun">
                    <!-- <div class="boxAkunUpperBoxText">
                      <h1 id="textMidBox" class="page-title v4">Invoice</h1>
                    </div> -->
                    <div style="display:flex;justify-content:center">
                      <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -98px 0 0;" alt="">
                      <h4 id="textMidBox" style="color:white;position:absolute;margin:-61px 0 0">MASUK AKUN</h4>
                    </div>
                    <div id="conMidBox" class="boxAkunMidBox">
                      <div id="dataDiri" class="d-none">
                        <table class="table">
                          <tr>
                            <td>
                              <div class="conBoxPic">
                                <div class="boxPic">
                                  <img src="img/about/team_1.jpg" alt="">
                                  <button class="btnPic" type="button" onclick="btnPic()" name="button">Unggah Foto</button>
                                  <input style="display:none" type="file" id="myfile" name="myfile">
                                </div>
                              </div>
                            </td>
                            <td style="width:100%;min-width:500px">
                              <div  class="boxRight">
                                <table class="table bordered">
                                  <tr>
                                    <td style="font-weight:bold">Ubah Biodata Diri</td>
                                  </tr>
                                  <tr>
                                    <td>Nama :</td>
                                  </tr>
                                  <tr>
                                    <td> <input type="text" class="form-control" name="" value=""> </td>
                                  </tr>
                                  <tr>
                                    <td>Tanggal Lahir :</td>
                                  </tr>
                                  <tr>
                                    <td> <input type="text" class="form-control" name="" value=""> </td>
                                  </tr>
                                  <tr>
                                    <td>Jenis Kelamin :</td>
                                  </tr>
                                  <tr>
                                    <td> <input type="text" class="form-control" name="" value=""> </td>
                                  </tr>
                                  <tr>
                                    <td>Email :</td>
                                  </tr>
                                  <tr>
                                    <td> <input type="text" class="form-control" name="" value=""> </td>
                                  </tr>
                                  <tr>
                                    <td>Nomor HP :</td>
                                  </tr>
                                  <tr>
                                    <td> <input type="text" class="form-control" name="" value=""> </td>
                                  </tr>

                                </table>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div id="wishList" class="d-none">
                      <p class="text-left " hidden style="font-size:12px;"><span id="urlimage">{{$urlImage}}</span></p>
                        <div class="shopping-cart v2 bd-7">
                          <div style="max-height:600px;overflow-y:auto!important" class="table-responsive">
                              <table class="table cart-table">
                                  <tbody id="tablewishlist">
                                    <tr>
                                      <td>Tidak Ada Buku</td>
                                    </tr>
                                      <!-- <tr class="item_cart">
                                          <td class="product-name flex align-center">
                                              <a href="#" class="btn-del"><i class="ion-ios-close-empty"></i></a>
                                              <div class="product-img pProd">
                                                  <img src="img/product/sound2.jpg" alt="Futurelife">
                                              </div>
                                              <div class="product-info tProd">
                                                  <a href="#" title="">Harman Kardon Onyx Studio Harman Kardon Onyx Studio</a>
                                              </div>
                                          </td>
                                          <td class="total-price">
                                              <p class="price">$1,215.00</p>
                                          </td>
                                          <td class="w-button">
                                              <a class="btn-addcart btn-gradient">Add to cart</a>
                                          </td>
                                      </tr> -->

                                  </tbody>
                              </table>
                          </div>
                          <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalwhislist">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="prevwish()" id="prevwishlist" href="#">&laquo;</a>
                              <a id="pagewish" class="active">0</a>
                              <a onclick="nextwish()" id="nextwishlist" href="#">&raquo;</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id="Alamat" class="d-none">
                        <div class="upperBoxAlamat">
                          <!-- Button trigger modal -->
                          <button type="button" class="btnNorm btn-gradient" data-toggle="modal" data-target="#staticBackdrop">
                            Tambah Alamat
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                                <div class="modal-header">
                                  <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Alamat Baru</h5>
                                </div>
                                <div style="padding: 0px 10px" class="modal-body">
                                <table class="table table-responsive">

                                  <tr>
                                    <td>Nama Penerima</td>
                                  </tr>
                                  <tr>
                                    <td><input id="namamnl" type="text" class="form-control" name="" value=""></td>
                                  </tr>
                                  <tr>
                                    <td>Nomor HP</td>
                                  </tr>
                                  <tr>
                                    <td><input id="hpmnl" type="text" class="form-control" name="" value=""></td>
                                  </tr>
                                  <tr>
                                    <td>Kota/Kecamatan</td>
                                  </tr>
                                  <tr>
                                    <td>
                                    <!-- <select class="form-control selectpicker" id="kota" data-live-search="true" onkeyup="getkota()">
                                        <option ><input type="text" class="form-control" placeholder="Ketik 3 Huruf.." id="selectkota" onkeyup="getkota()"></option>
                                        <option value="1">Jawa Tengah,Salatiga</option>
                                        <option value="2">Jawa Tengah,Semarang</option>
                                    </select> -->

                                    <!-- <div class="form-group"> -->
                                      <!-- <label for="iJudulBuku">Judul Buku</label> -->
                                      <!-- <select id="tag_list" name="tag_list[]" class="form-control" multiple></select> -->
                                      <!-- <select style="width: 100%" id="tag_list" class="form-control" name="tag" multiple onchange="onkeyup1()" ></select>
                                  </div> -->
                                    <!-- <div class="dropdown-content">
                                    <select class="form-control cari" id="iJudulBuku" style="width:100%;" name="id" ></select> -->
                                    <!-- <select class="cari form-control" style="width:500px;" name="cari"></select> -->
                                      <input type="text" class="form-control" placeholder="Ketik 3 Huruf.." id="selectkota" onkeyup="onkey(this.value)" list="cityname">
                                      <datalist id="cityname">
                                        <!-- <option data-id="1" value="Boston"></option>
                                        <option data-id="2" value="Cambridge"></option> -->
                                      </datalist>

                                    </td>
                                  </tr>


                                  <tr>
                                    <td>Alamat Lengkap</td>
                                  </tr>
                                  <tr>
                                    <td><textarea id="alamatmnl" rows="4" type="text" class="form-control" name="" value=""></textarea></td>
                                  </tr>
                                </table>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <button onclick="addalamatmanual()"type="button" data-dismiss="modal" class="btn btn-success">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal fade" id="staticBackdropEditAlamat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEditAlamatLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                                <div class="modal-header">
                                  <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropEditAlamatLabel">Edit Alamat</h5>
                                </div>
                                <div style="padding: 0px 10px" class="modal-body">
                                <table class="table table-responsive">
                                  <tr hidden>
                                    <td>Id alamat</td>
                                  </tr>
                                  <tr hidden>
                                    <td><input id="idmnl" type="text" class="form-control" name="" value=""></td>
                                  </tr>
                                  <tr >
                                    <td>Nama Penerima</td>
                                  </tr>
                                  <tr>
                                    <td><input id="namaalmedit" type="text" class="form-control" name="" value=""></td>
                                  </tr>
                                  <tr>
                                    <td>Nomor HP</td>
                                  </tr>
                                  <tr>
                                    <td><input id="hpalmedit" type="text" class="form-control" name="" value=""></td>
                                  </tr>
                                  <tr>
                                    <td>Kota/Kecamatan</td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <input type="text" class="form-control" placeholder="Ketik 3 Huruf.." id="selectkota2" onkeyup="onkey(this.value)" list="cityname2">
                                      <datalist id="cityname2">
                                        <!-- <option data-id="1" value="Boston"></option>
                                        <option data-id="2" value="Cambridge"></option> -->
                                      </datalist>

                                    </td>
                                  </tr>


                                  <tr>
                                    <td>Alamat Lengkap</td>
                                  </tr>
                                  <tr>
                                    <td><textarea id="almedit" rows="4" type="text" class="form-control" name="" value=""></textarea></td>
                                  </tr>
                                </table>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <button onclick="editalamatmanual()"type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="midBoxAlamat table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td>Penerima</td>
                              <td class="hidden-sm hidden-xs">Alamat Pengiriman</td>
                              <td class="hidden-sm hidden-xs">Daerah Pengiriman</td>
                              <td style="width:120px"></td>
                            </tr>
                            <tbody id="tablealamat">
                            <!-- <tr>
                              <td><span class="text-bold">Arditya Wahyuliantara</span><br> 089696873414 </td>
                              <td><span class="text-bold">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td>Jawa Tengah, Kota Salatiga, Sidorejo 50711 Salatiga</td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnKcl btn-danger"  name="button" title="Hapus Alamat"><span class="fa fa-trash"></span></button>
                                <button type="button" style="font-size:12px;" class="btnKcl btn-info" name="button" title="Ubah Alamat"><span class="fa fa-pencil-square-o"></span></button>
                              </td>
                            </tr> -->
                            </tbody>
                          </table>
                        </div>
                        <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalalamat">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="prevalm()" id="prevalamat" href="#">&laquo;</a>
                              <a id="pagealamat" class="active">0</a>
                              <a onclick="nextalm()" id="nextalamat" href="#">&raquo;</a>
                            </div>
                          </div>
                      </div>



                      <div id="Order" class="d-none">
                        <div class="midBoxOrder table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td>No Order</td>
                              <td class="hidden-sm hidden-xs">Status Order</td>
                              <td class="text-center hidden-sm hidden-xs">Tanggal Update</td>
                              <td class="text-center" style="width:80px"></td>
                            </tr>
                            <tbody id="tableorder">
                            <!-- <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="1"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr>
                            <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="2"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr> -->
                            </tbody>

                          </table>
                        </div>

                        <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalorder">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="prevord()" id="prevorder" href="#">&laquo;</a>
                              <a id="pageorder" class="active">0</a>
                              <a onclick="nextord()" id="nextorder" href="#">&raquo;</a>
                            </div>
                          </div>


                      </div>

                      <div id="Order Ditahan" class="d-none">
                        <div class="midBoxOrder table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td>No Order</td>
                              <td>Status Order</td>
                              <td class="text-center">Tanggal Update</td>
                              <td class="text-center" style="width:80px"></td>
                            </tr>
                            <tbody id="tableorderhold">
                            <!-- <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="1"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr>
                            <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="2"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr> -->
                            </tbody>

                          </table>
                        </div>

                        <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalorderhold">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="prevordhold()" id="prevorderhold" href="#">&laquo;</a>
                              <a id="pageorderhold" class="active">0</a>
                              <a onclick="nextordhold()" id="nextorderhold" href="#">&raquo;</a>
                            </div>
                          </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                                  <div class="modal-header">
                                    <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>

                                  </div>
                                  <div class="modal-body" style="padding: 0 5px!important;">
                                    <div style="padding:0px 5px;overflow:auto">
                                      <table class="table table-bordered" id="tblorddetail">
                                        <!-- <tr>
                                        <td>No Order</td>
                                        <td>123123123</td>
                                      </tr>
                                      <tr>
                                      <td>Pembeli :</td>
                                      <td>Agung</td>
                                    </tr>
                                    <tr>
                                    <td>No Hp</td>
                                    <td>08999999</td>
                                  </tr>
                                  <tr>
                                  <td>Alamat Pengiriman</td>
                                  <td> Jl Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga Jawa Tengah</td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                barang :
                                <table class="table table-bordered">
                                <tr>
                                <th>Kode Barang</th>
                                <th>Nama Buku</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Total</th>
                              </tr>
                              <tr>
                              <td>123123</td>
                              <td>Cara Memakan Nasi</td>
                              <td>12</td>
                              <td>12000</td>
                              <td>12%</td>
                              <td>144000</td>
                            </tr>
                            <tr>
                            <td>123123</td>
                            <td>Cara Memakan Nasi</td>
                            <td>12</td>
                            <td>12000</td>
                            <td>12%</td>
                            <td>144000</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                    <td>Ekspedisi</td>
                    <td>JNE(REG)</td>
                  </tr>
                  <tr>
                  <td>Harga Awal</td>
                  <td>288000</td>
                </tr>
                <tr>
                <td>Biaya Ekspedisi</td>
                <td>20000</td>
              </tr>
              <tr>
              <td>diskon</td>
              <td>34560</td>
            </tr>
            <tr>
            <td>Total harga</td>
            <td>253440</td>
          </tr> -->
        </table>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>

                      <div id="Order History" class="d-none">
                        <table class="w-100" style="margin-bottom:2rem;">
                          <tr>
                            <td>
                              <input id="noInvoice" type="text" class="form-control" name="noInvoice" placeholder="Masukkan Nama Tujuan..." value="">
                            </td>
                            <td style="width:100px;">
                              <input id="ordbtn" type="button" onclick="cariBuku( noInvoice.value)" class="btn btn-success" style="width:90px;float:right" name="cari" value="cari">
                            </td>
                          </tr>
                        </table>
                        <div class="midBoxOrder table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td >No Order</td>
                              <td class="text-center hidden-sm hidden-xs">Tujuan</td>
                              <td class="text-center hidden-sm hidden-xs" style="min-width:180px;">Jumlah</td>
                              <td class="text-center" style="width:80px"></td>
                            </tr>

                            <tbody id="tableorderhistory">
                            <!-- <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="1"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr> -->
                            <!-- <tr>
                              <td><span class="text-bold f-15">1122334455</span><br>(11-12-2013)</td>
                              <td><span class="text-bold f-15">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                              <td class="text-center"><span class="text-bold text-center f-15">Rp 1.000.0000</span></td>
                              <td>
                                <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="2"><span class="text-bold">Detail</span></button>
                              </td>
                            </tr> -->
                            </tbody>
                          </table>
                        </div>

                        <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalorderhistory">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="prevordhs()" id="prevorderhistory" href="#">&laquo;</a>
                              <a id="pageorderhistory" class="active">0</a>
                              <a onclick="nextordhs()" id="nextorderhistory" href="#">&raquo;</a>
                            </div>
                          </div>

                            <!-- Modal -->
                            <!-- <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                                  <div class="modal-header">
                                    <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>

                                  </div>
                                  <div class="modal-body" style="padding: 0 5px!important;">
                                    <div class="jdlModalOrder">
                                      <div class="bmb1 text-bold border-bawah text-center">
                                        Judul Buku
                                      </div>
                                      <div class="bmb2 text-bold border-bawah text-center">
                                        Harga
                                      </div>
                                      <div class="bmb2 text-bold border-bawah text-center">
                                        jumlah
                                      </div>
                                      <div class="bmb2 text-bold border-bawah text-center">
                                        Total
                                      </div>
                                    </div>

                                    <div class="boxModalBody">
                                      <div class="contentModalOrder">
                                        <div class="bmb1">
                                          Banjir Darah
                                        </div>
                                        <div class="bmb2 text-center">
                                          Rp 110000
                                        </div>
                                        <div class="bmb2 text-center">
                                          10
                                        </div>
                                        <div class="bmb2 text-center">
                                          Rp 1100000
                                        </div>
                                      </div>


                                      <div class="contentModalOrder">
                                        <div class="bmb1">
                                          Banjir Darah
                                        </div>
                                        <div class="bmb2 text-center">
                                          Rp 110000
                                        </div>
                                        <div class="bmb2 text-center">
                                          10
                                        </div>
                                        <div class="bmb2 text-center">
                                          Rp 1100000
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div> -->
                      </div>

                      <div id="Invoice" class="">
                        <div class="midBoxOrder table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td class="hidden-sm hidden-xs">Tanggal</td>
                              <td>Invoice</td>
                              <td class="hidden-sm hidden-xs">Tujuan</td>
                              <td class="hidden-sm hidden-xs">Tagihan</td>
                              <td style="width:80px"></td>
                            </tr>

                            <tbody id="tableinvoice">
                              <!-- <tr>
                                <td><span class="text-bold f-15">11-12-2013</span></td>
                                <td><span class="text-bold f-15">1122334455</span></td>
                                <td><span class="text-bold f-15">Dalam Proses</span></td>
                                <td>
                                  <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalInvoice" data-id="1122334455"><span class="text-bold">Detail</span></button>
                                </td>
                              </tr> -->
                            </tbody>



                            <!-- Modal -->
                            <!-- <div class="modal fade" id="modalInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                                  <div class="modal-header">
                                    <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>

                                  </div>
                                  <div class="modal-body" style="padding: 0 5px!important;">
                                    <div class="boxModalBody">
                                      <div class="contentModalInv">
                                        <table>
                                          <tr>
                                            <td>1231313</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div> -->


                          </table>
                        </div>
                        <div class="text-right mt-1" style="margin-right:15px">
                            <div class="text-bold" style="float:left; border:0.5px solid #c4c4c4; border-radius: 5px; padding: 10px 5px;margin:20px 0px 10px 10px">
                              Total :
                              <span id="totalinvoice">
                                1
                              </span>
                            </div>
                            <div class="pagination">
                              <a onclick="previnv()" id="previnvoice" href="#">&laquo;</a>
                              <a id="pageinvoice" class="active">0</a>
                              <a onclick="nextinv()" id="nextinvoice" href="#">&raquo;</a>
                            </div>
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->

        <script>
          var datadiri="",datainvoice="",cekcountinvoice=0,datawishlist="",cekcountwishlist=0,dataorder="",cekcountorder=0,dataorderhistory="",cekcountorderhistory=0,searchorderhistory="",dataalamat="",cekcountalamat=0,dataorderhold="",cekcountorderhold=0;const prevwishlist=document.getElementById("prevwishlist"),nextwishlist=document.getElementById("nextwishlist"),previnvoice=document.getElementById("previnvoice"),nextinvoice=document.getElementById("nextinvoice"),prevorder=document.getElementById("prevorder"),nextorder=document.getElementById("nextorder"),prevorderhistory=document.getElementById("prevorderhistory"),nextorderhistory=document.getElementById("nextorderhistory"),prevalamat=document.getElementById("prevalamat"),nextalamat=document.getElementById("nextalamat"),prevorderhold=document.getElementById("prevorderhold"),nextorderhold=document.getElementById("nextorderhold");var imageurl=document.getElementById("urlimage").innerHTML;function editpass(){var e="",t="",a="",n=document.getElementById("passerrorakun");e=document.getElementById("inptPassLama").value,t=document.getElementById("inptPassBaru").value,a=document.getElementById("inptPassConfirm").value,""==e.trim()||""==t.trim()||""==a.trim()?(Swal.fire({position:"bottom-end",icon:"info",title:"Isi Data Dengan Lengkap & Benar",showConfirmButton:!1,timer:2e3}),n.style.display="block",n.innerHTML="Isi Data Anda dengan Benar"):($.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/editpass') }}",method:"post",data:{oldpass:e,newpass:t,confirmpass:a},success:function(e){"login"==e?(Swal.fire({position:"bottom-end",icon:"info",title:"Session habis, anda harus login dahulu",showConfirmButton:!1,timer:2e3}),window.location.href="{{URL::to('login')}}"):"sukses"==e?(Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Menyimpan Akun",showConfirmButton:!1,timer:2500}),$(function(){$("#staticBackdropEdt").modal("toggle")}),n.style.display="none",window.location.href="{{URL::to('logout')}}"):"pendek"==e?(n.style.display="block",n.innerHTML="Password baru minimal 6 huruf"):"panjang"==e?(n.style.display="block",n.innerHTML="Password baru maksimal 20 huruf"):"salah"==e?(n.style.display="block",n.innerHTML="Password baru dan ulang password berbeda, harus sama"):"sama"==e?(n.style.display="block",n.innerHTML="Password baru tidak boleh sama dengan password lama"):(n.style.display="block",n.innerHTML="Isi Data Anda dengan Benar")}}))}function editakun(){var e,ui="",t="",a="",n="",o=document.getElementById("edterrorakun");ui=document.getElementById("usernameedt").value,t=document.getElementById("namaedt").value,a=document.getElementById("emailedt").value,e=document.getElementById("hpedt").value,n=document.getElementById("alamatedt").value;var d=isNumeric(e);""==t.trim()||""==a.trim()||""==ui.trim()||""==e||""==n.trim()?(o.style.display="block",o.innerHTML="Isi Data Anda dengan Benar & Tidak Boleh Kosong"):0==d?(o.style.display="block",o.innerHTML="Isi no Hp Anda dengan Angka yang Benar"):($.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/edituser') }}",method:"post",data:{usernameedt:ui,namaedt:t,emailedt:a,hpedt:e,alamatedt:n},success:function(e){"login"==e?(Swal.fire({position:"bottom-end",icon:"info",title:"Session habis, anda harus login dahulu",showConfirmButton:!1,timer:2e3}),window.location.href="{{URL::to('login')}}"):"sukses"==e?(Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Menyimpan Akun",showConfirmButton:!1,timer:2500}),$(function(){$("#staticBackdropEdt").modal("toggle")}),location.reload()):(o.style.display="block",o.innerHTML="Isi Data Anda dengan Benar",Swal.fire({position:"bottom-end",icon:"info",title:"Isi Data Anda dengan Benar",showConfirmButton:!1,timer:2e3}))}}))}function changepass(){}function onZoom(){var e=document.getElementsByClassName("zoomIn").length,t=document.getElementById("zImg");t.className=0==e?"mw-120 zoomIn":"mw-100"}function cekKota(){val=document.getElementById("kota").value,kec=document.getElementById("kecamatan"),""!=val||"-"!=val?kec.disabled=!1:kec.disabled=!0}function btnPic(){document.getElementById("myfile").click()}function getkota(){document.getElementById("kota").value;console.log("input")}function onkey(val1){getkota1(val1)}$("#modalOrder").on("show.bs.modal",function(e){var t=$(e.relatedTarget).data("id");$(this).find(".modal-title").text("Invoice No :"+t)}),document.getElementById("Invoice").addEventListener("load",midBox("Invoice"));var up=0;function getkota1(val2){var e=val2;console.log(e),e.length>=3&&getkotaall(e),e.length<3&&(document.getElementById("cityname").innerHTML=""),up=e.length}function getkotaall(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/alamatro') }}",method:"post",data:{val:e},success:function(e){var t="";for(i in console.log(e),variable=e,variable)t+='<option data-id="'+variable[i].id_alamat+'" value="'+variable[i].text+'"></option>';document.getElementById("cityname").innerHTML=t ; document.getElementById("cityname2").innerHTML=t}})}function btnEdtDataweb(){isivaledit()}function btnEdtData(){isivaledit(),document.getElementById("edtData").click()}function btnEdtPass(){document.getElementById("edtPass").click()}function updatereseller(){jQuery.ajax({url:"{{ url('admin') }}",method:"get",success:function(e){console.log(e),document.getElementById("reseleradmindata").innerHTML=e.nama+"("+e.no_telp+")"}})}function isivaledit(){var e=document.getElementById("isiUsernameDisini").innerHTML,t=document.getElementById("isiNamaDisini").innerHTML,a=document.getElementById("isiEmailDisini").innerHTML,n=document.getElementById("isiHPDisini").innerHTML,o=document.getElementById("isiAlamatDisini").innerHTML;console.log(n),document.getElementById("usernameedt").value=e,document.getElementById("namaedt").value=t,document.getElementById("emailedt").value=a,document.getElementById("hpedt").value=n,document.getElementById("alamatedt").value=o}function midBox(e){console.log(e),document.getElementById("textMidBox").innerHTML=e,"Data Diri"==e?(document.getElementById("dataDiri").className="",document.getElementById("wishList").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("Order").className="d-none",document.getElementById("Invoice").className="d-none",document.getElementById("Order History").className="d-none"):"Wishlist"==e?(document.getElementById("wishList").className="",document.getElementById("dataDiri").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("Order").className="d-none",document.getElementById("Order History").className="d-none",document.getElementById("Invoice").className="d-none",getcountwishlist(),(datawishlist=cekcountwishlist)?console.log(datawishlist):(getwishlist(1),datawishlist=cekcountwishlist,document.getElementById("pagewish").innerHTML=1,prevwishlist.classList.add("disabled2"))):"Alamat"==e?(document.getElementById("Alamat").className="",document.getElementById("dataDiri").className="d-none",document.getElementById("Order Ditahan").className="d-none",document.getElementById("wishList").className="d-none",document.getElementById("Order").className="d-none",document.getElementById("Order History").className="d-none",document.getElementById("Invoice").className="d-none",getcountalamat(),(dataalamat=cekcountalamat)?console.log(dataalamat):(getalamat(1),dataalamat=cekcountalamat,document.getElementById("pagealamat").innerHTML=1,prevalamat.classList.add("disabled2"))):"Order"==e?(document.getElementById("Order").className="",document.getElementById("Order History").className="d-none",document.getElementById("Order Ditahan").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("dataDiri").className="d-none",document.getElementById("wishList").className="d-none",document.getElementById("Invoice").className="d-none",document.getElementById("btnUlasBarang").classList.add("d-none"),getcountorder(),(dataorder=cekcountorder)?console.log(dataorder):(getorder(1),dataorder=cekcountorder,document.getElementById("pageorder").innerHTML=1,prevorder.classList.add("disabled2"))):"Order Ditahan"==e?(document.getElementById("Order Ditahan").className="",document.getElementById("Order").className="d-none",document.getElementById("Order History").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("dataDiri").className="d-none",document.getElementById("wishList").className="d-none",document.getElementById("Invoice").className="d-none",getcountorderhold(),(dataorderhold=cekcountorderhold)?console.log(dataorderhold):(getorderhold(1),dataorderhold=cekcountorderhold,document.getElementById("pageorderhold").innerHTML=1,prevorderhold.classList.add("disabled2"))):"Invoice"==e?(document.getElementById("Invoice").className="",document.getElementById("Order").className="d-none",document.getElementById("Order Ditahan").className="d-none",document.getElementById("Order History").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("dataDiri").className="d-none",document.getElementById("wishList").className="d-none",getcountinvoice(),(datainvoice=cekcountinvoice)?console.log(datainvoice):(getinvoice(1),datainvoice=cekcountinvoice,document.getElementById("pageinvoice").innerHTML=1,previnvoice.classList.add("disabled2"))):"Order History"==e&&(document.getElementById("Order History").className="",document.getElementById("btnUlasBarang").classList.remove("d-none"),document.getElementById("Order").className="d-none",document.getElementById("Order Ditahan").className="d-none",document.getElementById("Alamat").className="d-none",document.getElementById("dataDiri").className="d-none",document.getElementById("wishList").className="d-none",document.getElementById("Invoice").className="d-none",getcountorderhistory(""),(dataorderhistory=cekcountorderhistory)?console.log(dataorderhistory):(getorderhistory(1,""),dataorder=cekcountorderhistory,document.getElementById("pageorderhistory").innerHTML=1,prevorderhistory.classList.add("disabled2"))),document.getElementById("filter").click()}function previnv(){var e=0,t=document.getElementById("pageinvoice").innerHTML;nextinvoice.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pageinvoice").innerHTML=parseInt(t)-1,getinvoice(e)):previnvoice.classList.add("disabled2")}function nextinv(){var e=0;previnvoice.classList.remove("disabled2");var t=document.getElementById("pageinvoice").innerHTML;5*t<cekcountinvoice?(e=parseInt(t)+1,document.getElementById("pageinvoice").innerHTML=e,getinvoice(e)):nextinvoice.classList.add("disabled2")}function getinvoice(e){document.getElementById("tableinvoice").innerHTML="<tr><td colspan='5' style='padding:30px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var t=5*(e-1);console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/invoice') }}",method:"post",data:{page:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="";if(console.log(e),variable=e,"null"!=variable)for(i in variable)console.log(variable[i].idOrder),t+='<tr><td class="hidden-sm hidden-xs"><span class="text-bold f-15">'+date(variable[i].created_at)+'</span></td><td><span class="text-bold f-15">'+variable[i].idOrder+'</span><p class="hidden-lg hidden-md"><span class="text-bold">'+variable[i].nama_penerima+' </span>( '+rupiah(netto(variable[i].total_harga,variable[i].biaya_expedisi,variable[i].totalDiskon))+' )</p><p class="hidden-lg hidden-md">'+date(variable[i].created_at)+'</p></td><td class="hidden-sm hidden-xs"><span class="text-bold f-15">'+variable[i].nama_penerima+'</span></td><td class="hidden-sm hidden-xs"><span class="text-bold f-15">'+rupiah(netto(variable[i].total_harga,variable[i].biaya_expedisi,variable[i].totalDiskon))+'</span></td><td style="width:100px;"> <a type="button" href="/print/'+variable[i].idOrder+'" class="btn btn-primary" name="button"><i class="fa fa-print" style="font-size:15px"></i></a> <a type="button" href="/verif/'+variable[i].idOrder+'" class="btn btn-success" name="button"><i class="fa fa-check-square-o" style="font-size:15px"></i></a></td></tr>';else t="<tr> Data Kosong </tr>";document.getElementById("tableinvoice").innerHTML=t}})}function getcountinvoice(){jQuery.ajax({url:"{{ url('/countinvoice') }}",method:"get",success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalinvoice").innerHTML=e,(cekcountinvoice=e)<5?nextinvoice.classList.add("disabled2"):nextinvoice.classList.remove("disabled2")}})}function deleteinvoice(e){var t=$(e).data("id");console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/deleteinvoice') }}",method:"post",data:{id:t},success:function(e){console.log(e),document.getElementById("totalinvoice").innerHTML=e,(cekcountinvoice=e)<5?nextinvoice.classList.add("disabled2"):nextinvoice.classList.remove("disabled2"),e>0&&getinvoice(1)}})}function prevwish(){var e=0,t=document.getElementById("pagewish").innerHTML;nextwishlist.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pagewish").innerHTML=parseInt(t)-1,getwishlist(e)):prevwishlist.classList.add("disabled2")}function nextwish(){var e=0;prevwishlist.classList.remove("disabled2");var t=document.getElementById("pagewish").innerHTML;5*t<cekcountwishlist?(e=parseInt(t)+1,document.getElementById("pagewish").innerHTML=e,getwishlist(e)):nextwishlist.classList.add("disabled2")}function getwishlist(e){document.getElementById("tablewishlist").innerHTML="<tr><td colspan='3' style='padding:30px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var t=5*(e-1);console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/wishlist') }}",method:"post",data:{page:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="",a="";if(console.log(e),variable=e,null!=variable)for(i in variable)a=0==variable[i].stock?'<td class="w-button hidden-xs hidden-sm"> <a class="btn-addcart btn-gradient disabled" >Stock Kosong</a> </td> </tr>':'<td class="w-button hidden-sm hidden-xs"> <a class="btn-addcart btn-gradient" onclick="addcart(this)" data-id="'+variable[i].idBuku+'"  href="#">Add to cart</a> </td> </tr>',(y= 21 <= variable[i].judul_buku.length? variable[i].judul_buku.substring(0, 20)+' ...': variable[i].judul_buku),t+='<tr class="item_cart"> <td class="product-name flex align-center"> <a href="#" onclick="deletewishlist(this)" data-id="'+variable[i].idBuku+'" class="btn-del hidden-sm hidden-xs"><i class="fa fa-trash text-danger text-bold"></i></a> <div class="product-img pProd"> <img src="'+imageurl+variable[i].gambar+'" alt="Futurelife"> </div> <div class="product-info tProd"> <a href="/detail/'+variable[i].idBuku+'" title=""><span class="judulMobile">'+y+'</span><span class="judulDesktop">'+variable[i].judul_buku+'</span></a><br> <span class="hidden-lg hidden-md">'+rupiah(variable[i].harga)+'</span> <br> <a class="float-right hidden-md hidden-lg" onclick="addcart(this)" data-id="'+variable[i].idBuku+'"><i style="font-size:26px;color:#ed3237" class="fa fa-cart-plus" ></i></a> <a href="#" onclick="deletewishlist(this)" data-id="'+variable[i].idBuku+'" class="btn-del float-right hidden-md hidden-lg"><i style="font-size:26px" class="fa fa-trash text-danger text-bold"></i></a> </div> </td> <td class="total-price hidden-sm hidden-xs"> <p class="price">'+rupiah(variable[i].harga)+"</p> </td>"+a;else t='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tablewishlist").innerHTML=t}})}function getcountwishlist(){jQuery.ajax({url:"{{ url('/countwishlist') }}",method:"get",success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalwhislist").innerHTML=e,(cekcountwishlist=e)<5?nextwishlist.classList.add("disabled2"):nextwishlist.classList.remove("disabled2")}})}function deletewishlist(e){var t=$(e).data("id");console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/deletewishlist') }}",method:"post",data:{id:t},success:function(e){console.log(e),document.getElementById("totalwhislist").innerHTML=e,(cekcountwishlist=e)<5?nextwishlist.classList.add("disabled2"):nextwishlist.classList.remove("disabled2"),e>0&&getwishlist(1),0==e&&(wish='<tr class="item_cart">Data Kosong</tr>',document.getElementById("tablewishlist").innerHTML=wish)}})}function prevord(){var e=0,t=document.getElementById("pageorder").innerHTML;nextorder.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pageorder").innerHTML=parseInt(t)-1,getorder(e)):prevorder.classList.add("disabled2")}function nextord(){var e=0;prevorder.classList.remove("disabled2");var t=document.getElementById("pageorder").innerHTML;5*t<cekcountorder?(e=parseInt(t)+1,document.getElementById("pageorder").innerHTML=e,getorder(e)):nextorder.classList.add("disabled2")}function getorder(e){document.getElementById("tableorder").innerHTML="<tr><td colspan='4' style='padding:30px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var t=5*(e-1);console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/order') }}",method:"post",data:{page:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="";if(console.log(e),variable=e,null!=variable)for(i in variable)t+='<tr><td><span class="text-bold f-15">'+variable[i].code_order+"</span><p class='hidden-md hidden-lg text-bold f-15'>"+getstatusord(variable[i].code_status)+"("+variable[i].code_status+")</p><p>("+date(variable[i].created_at)+')</p></td><td class="hidden-sm hidden-xs"><span class="text-bold f-15">'+getstatusord(variable[i].code_status)+"("+variable[i].code_status+')</td> <td class="text-center hidden-sm hidden-xs"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>';else t='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tableorder").innerHTML=t}})}function getcountorder(){jQuery.ajax({url:"{{ url('/countorder') }}",method:"get",success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalorder").innerHTML=e,(cekcountorder=e)<5?nextorder.classList.add("disabled2"):nextorder.classList.remove("disabled2")}})}function getorddetail(e){console.log(e);var t=$(e).data("id");console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/orderdetail') }}",method:"post",data:{id:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var a="",n="";if(console.log(e),variable=e,null!=variable){var o=variable.ord.expedisi,d=parseInt(variable.ord.total_harga)+parseInt(variable.ord.biayaExpedisi)-parseInt(variable.ord.totalDiskon);for(i in a="<tr><td>No Order</td><td>"+t+"</td></tr><tr><td>Pembeli :</td><td>"+variable.ord.nama_pengirim+"</td></tr><tr><td>No Hp</td><td>"+variable.ord.telephone_pengirim+"</td></tr><tr><td>Tujuan </td><td>"+variable.ord.nama_penerima+" ("+variable.ord.telephone_penerima+") <br>"+variable.ord.alamat+'</td></tr><tr><td colspan="2">barang : <table class="table table-bordered" id=""><tr><th>Nama Buku</th><th>Jumlah</th><th>Harga</th><th>Diskon</th><th>Total</th></tr><tbody id="detailord"></tbody></table></td></tr><tr><td>Ekspedisi</td><td>'+o.toUpperCase()+"</td></tr><tr><td>Harga Awal</td><td>"+rupiah(variable.ord.total_harga)+"</td></tr><tr><td>Biaya Ekspedisi</td><td>"+rupiah(variable.ord.biayaExpedisi)+"</td></tr><tr><td>Diskon</td><td>"+rupiah(variable.ord.totalDiskon)+"</td></tr><tr><td>Total harga</td><td>"+rupiah(d)+"</td></tr>",variable.a){if(nama="",buku="",code=variable.a[i].code,"promo"==code.substring(0,5).toLowerCase()){for(x in console.log(variable.a[i].nama),nm=variable.a[i].nama.nama,buku1=variable.a[i].nama.buku,buku1)buku+="-"+buku1[x]+"<br>";nama=nm+"<br>"+buku}else nama=variable.a[i].nama;n+="<tr><td>"+nama+"</td><td>"+variable.a[i].jumlah+"</td><td>"+variable.a[i].harga+"</td><td>"+variable.a[i].diskon+"</td><td>"+variable.a[i].total+"</td></tr>"}}else a='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tblorddetail").innerHTML=a,document.getElementById("detailord").innerHTML=n}})}function prevordhold(){var e=0,t=document.getElementById("pageorderhold").innerHTML;nextorderhold.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pageorderhold").innerHTML=parseInt(t)-1,getorderhold(e)):prevorderhold.classList.add("disabled2")}function nextordhold(){var e=0;prevorderhold.classList.remove("disabled2");var t=document.getElementById("pageorderhold").innerHTML;5*t<cekcountorderhold?(e=parseInt(t)+1,document.getElementById("pageorderhold").innerHTML=e,getorderhold(e)):nextorderhold.classList.add("disabled2")}function getorderhold(e){document.getElementById("tableorderhold").innerHTML="<tr><td colspan='4' style='padding:30px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var t=5*(e-1);console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/orderhold') }}",method:"post",data:{page:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="";if(console.log(e),variable=e,null!=variable)for(i in variable)t+='<tr><td><span class="text-bold f-15">'+variable[i].code_order+"</span><br>("+date(variable[i].created_at)+')</td><td><span class="text-bold f-15">'+getstatusordhold(variable[i].code_status)+"("+variable[i].code_status+')</td> <td class="text-center"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>';else t='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tableorderhold").innerHTML=t}})}function getcountorderhold(){jQuery.ajax({url:"{{ url('/countorderhold') }}",method:"get",success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalorderhold").innerHTML=e,(cekcountorderhold=e)<5?nextorderhold.classList.add("disabled2"):nextorderhold.classList.remove("disabled2")}})}function prevordhs(){var e=0,t=document.getElementById("pageorderhistory").innerHTML;nextorderhistory.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pageorderhistory").innerHTML=parseInt(t)-1,getorderhistory(e,searchorderhistory)):prevorderhistory.classList.add("disabled2")}function nextordhs(){var e=0;prevorderhistory.classList.remove("disabled2");var t=document.getElementById("pageorderhistory").innerHTML;5*t<cekcountorderhistory?(e=parseInt(t)+1,document.getElementById("pageorderhistory").innerHTML=e,getorderhistory(e,searchorderhistory)):nextorderhistory.classList.add("disabled2")}function getorderhistory(e,t){document.getElementById("tableorderhistory").innerHTML="<tr><td colspan='4' style='padding:3px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var a=5*(e-1);$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/orderhistory') }}",method:"post",data:{page:a,ordInput:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="";if(console.log(e),variable=e,null!=variable)for(i in variable)t+='<tr><td style="min-width:230px!important"><span class="text-bold f-15">'+variable[i].idOrder+'</span><p clas="hidden-md hidden-lg">'+variable[i].nama_penerima+'</p> <p>'+date(variable[i].created_at)+'</p></td><td class="hidden-sm hidden-xs" style="min-width:285px;"><span class="text-bold f-15"> '+variable[i].nama_penerima+' </span><br>'+variable[i].alamat+'</td><td class="hidden-sm hidden-xs text-center"><span class="text-bold text-center f-15">'+rupiah(netto(variable[i].total_harga,variable[i].biayaExpedisi,variable[i].totalDiskon))+'</span></td><td><div style="padding-top:5px;"><button  onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].idOrder+'"><span class="text-bold">Detail</span></button></div></td></tr>';else t='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tableorderhistory").innerHTML=t}})}function getcountorderhistory(e){jQuery.ajax({url:"{{ url('/countorderhistory') }}",method:"get",data:{ordInput:e},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalorderhistory").innerHTML=e,(cekcountorderhistory=e)<5?nextorderhistory.classList.add("disabled2"):nextorderhistory.classList.remove("disabled2")}})}function cariBuku(e){getorderhistory(1,searchorderhistory=e),getcountorderhistory(searchorderhistory)}var input=document.getElementById("noInvoice");function prevalm(){var e=0,t=document.getElementById("pagealamat").innerHTML;nextalamat.classList.remove("disabled2"),t>1?(e=parseInt(t)-1,document.getElementById("pagealamat").innerHTML=parseInt(t)-1,getalamat(e)):prevalamat.classList.add("disabled2")}function nextalm(){var e=0;prevalamat.classList.remove("disabled2");var t=document.getElementById("pagealamat").innerHTML;5*t<cekcountalamat?(e=parseInt(t)+1,document.getElementById("pagealamat").innerHTML=e,getalamat(e)):nextalamat.classList.add("disabled2")}function getalamat(e){document.getElementById("tablealamat").innerHTML="<tr><td colspan='4' style='padding:30px 0px 40px' ><div style='font-size:15px!important;' class='loaderR'>Loading...</div></td></tr>";var t=5*(e-1);console.log(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/akunalamat') }}",method:"post",data:{page:t},success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}");var t="";if(console.log(e),variable=e,null!=variable)for(i in variable)t+='<tr><td><p class="text-bold">'+variable[i].nama+"</p><p class='hidden-lg hidden-md'>"+variable[i].alamat+"</p> "+variable[i].no_telp+'</td><td class="hidden-sm hidden-xs">'+variable[i].alamat+'</td><td class="hidden-sm hidden-xs">'+variable[i].kecamatan+'</td><td><button type="button" style="font-size:12px;" class="btnKcl btn-danger" onclick=deletealamatdetail(this) data-id="'+variable[i].id+'" name="button" title="Hapus Alamat"><span class="fa fa-trash"></span></button><button type="button" style="font-size:12px; margin-left:10px;" class="btnKcl btn-info" name="button" data-toggle="modal" data-target="#staticBackdropEditAlamat" onclick=getalamatdetail(this) data-id="'+variable[i].id+'" title="Ubah Alamat"><span class="fa fa-pencil-square-o"></span></button></td></tr>';else t='<tr class="item_cart">Data Kosong</tr>';document.getElementById("tablealamat").innerHTML=t}})}function getcountalamat(){jQuery.ajax({url:"{{ url('/countakunalamat') }}",method:"get",success:function(e){"login"==e&&(window.location.href="{{URL::to('/')}}"),document.getElementById("totalalamat").innerHTML=e,(cekcountalamat=e)<5?nextalamat.classList.add("disabled2"):nextalamat.classList.remove("disabled2")}})}function addcart(e){var t=$(e).data("id");console.log(t),t?$.ajax({url:"{{url('cart/')}}/"+t,type:"GET",success:function(e){"sukses"==e?(Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Ditambahkan ke Keranjang",showConfirmButton:!1,timer:1500}),$.ajax({url:"{{url('cartcount')}}",type:"GET",success:function(e){1==e&&location.reload(),console.log(e),document.getElementById("cartcount").innerHTML=e}})):"login"==e?Swal.fire({title:"Anda harus login dahulu",icon:"info",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ok, Login"}).then(e=>{e.isConfirmed&&(console.log("login"),window.location.href="{{URL::to('login/')}}")}):(console.log(e),Swal.fire({position:"bottom-end",icon:"info",title:e,showConfirmButton:!1,timer:2e3}))}}):console.log("Error")}function rupiah(e){var t=e.toString().split("").reverse().join("").match(/\d{1,3}/g);return"Rp. "+(t=t.join(".").split("").reverse().join(""))+",00"}function date(e){var t=new Date(e);return months=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],t.getDate()+" "+months[t.getMonth()]+" "+t.getFullYear()}function getstatusord(e){return 4==e?"Proses Verifikasi Pembayaran":1==e?"Proses Verifikasi Pembayaran":5==e?"Proses Verifikasi Pembayaran":6==e?"Proses Pengemasan Barang":7==e?"Proses Pengemasan Barang":9==e?"Selesai & Menunggu dikirim Kurir":"Unknown"}function getstatusordhold(e){return 71==e?"Gagal Konfirmasi Sales":81==e?"Proses Verifikasi Pembayaran Gagal":91==e?"Stock Buku Di Gudang Habis":"Unknown"}function netto(e,t,a){return parseInt(e)+parseInt(t)-parseInt(a)}function isNumeric(e){return"string"==typeof e&&(!isNaN(e)&&!isNaN(parseFloat(e)))}function setalamat(e,t,a,n,o){document.getElementById("namaalamat").innerHTML=e,document.getElementById("noalamat").innerHTML=" ("+t+")",document.getElementById("alamat").innerHTML=a,document.getElementById("kecalamat").innerHTML=n,document.getElementById("destination").innerHTML=o,gEkspedisiPrice(),document.getElementById("cEkspPrice").innerHTML="-",document.getElementById("totalall").innerHTML="-",document.getElementById("textkurir").innerHTML="-";document.getElementById("kKirimManual").classList;btnorder.add("disabled"),ongkir=0,subtotal=0,$(function(){$("#staticBackdrop").modal("toggle")})}function addalamatmanual(){var e="",t="",a="";e="";e=document.getElementById("namamnl").value,t=document.getElementById("hpmnl").value,a=document.getElementById("alamatmnl").value,selectkota=document.getElementById("selectkota").value;var n=$('#cityname option[value="'+$("#selectkota").val()+'"]').data("id"),o=isNumeric(t);""==e.trim()||""==t.trim()||""==selectkota||""==a.trim()?Swal.fire({position:"bottom-end",icon:"info",title:"Isi Data Dengan Lengkap & Benar",showConfirmButton:!1,timer:2e3}):0==o?Swal.fire({position:"bottom-end",icon:"info",title:"Isi No Hp dengan benar",showConfirmButton:!1,timer:2e3}):($.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),jQuery.ajax({url:"{{ url('/addalamat') }}",method:"post",data:{nama:e,no_telp:t,alamat:a,kecamatan:selectkota,kode_ro:n},success:function(o){"hapus"==o?Swal.fire({position:"bottom-end",icon:"info",title:"Alamat tersimpan maksimal 10, hapus dahulu untuk menyimpan alamat baru",showConfirmButton:!1,timer:2e3}):"login"==o?(Swal.fire({position:"bottom-end",icon:"info",title:"Session habis, anda harus login dahulu",showConfirmButton:!1,timer:2e3}),window.location.href="{{URL::to('login')}}"):"sukses"==o?(getcountalamat(), getalamat(1), Swal.fire({position:"bottom-end",icon:"success",title:"Sukses Menyimpan alamat",showConfirmButton:!1,timer:2500}),setalamat(e,t,a,selectkota,n)):Swal.fire({position:"bottom-end",icon:"info",title:"Isi Data Anda dengan Benar",showConfirmButton:!1,timer:2e3})}}))}function passVis1(){vis("inptPassLama","hide1")}function passVis2(){vis("inptPassBaru","hide2")}function passVis3(){vis("inptPassConfirm","hide3")}function vis(e,t){var a=document.getElementById(e),n=document.getElementById(t);"password"===a.type?(a.type="text",n.className="fa fa-eye"):(a.type="password",n.className="fa fa-eye-slash")}input.addEventListener("keyup",function(e){13===e.keyCode&&(e.preventDefault(),document.getElementById("ordbtn").click())});

        function getalamatdetail(e) {
          var t = $(e).data("id");
          console.log(t);
          $.ajaxSetup({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
            }
            }),
            jQuery.ajax({
                url: "{{ url('/getdetailalamat') }}",
                method: "post",
                data: {
                    id: t
                },
                success: function(response) {
                  console.log(response);
                  if(response == 'login'){window.location.href = "{{URL::to('/login')}}";}
                  if (response != 'login'){
                    document.getElementById("idmnl").value =response.id;
                    document.getElementById("namaalmedit").value =response.nama;
                    document.getElementById("hpalmedit").value=response.no_telp;
                    document.getElementById("almedit").value=response.alamat;
                  }
                }
            })
          }
          function editalamatmanual(){
            var n = $('#cityname option[value="' + $("#selectkota2").val() + '"]').data("id");
            var a = document.getElementById("namaalmedit").value;
            var b = document.getElementById("hpalmedit").value;
            var c = document.getElementById("almedit").value;
            var d = document.getElementById("selectkota2").value;
            var z= document.getElementById("idmnl").value;
            console.log(n);
            console.log(d);
            console.log(z);
            if(a.trim()=="" || b.trim()=="" || c.trim()=="" || d.trim()=="" ){
              Swal.fire({
                position: 'bottom-end',
                icon: 'info',
                title: 'Harap Data di isi dengan lengkap dan benar',
                showConfirmButton: false,
                timer: 2000
                });
            }else{
              $.ajaxSetup({
              headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
              }
              }),
              jQuery.ajax({
                  url: "{{ url('/editalamat') }}",
                  method: "post",
                  data: {
                      id: z,
                      nama: a,
                      no_telp: b,
                      alamat: c,
                      kecamatan:  d,
                      kode_ro: n,
                  },
                  success: function(response) {
                    if(response=='sukses'){
                      Swal.fire({
                      position: 'bottom-end',
                      icon: 'success',
                      title: 'Sukses Edit Alamat',
                      showConfirmButton: false,
                      timer: 2000
                      });
                      getalamat(1);
                    }
                    if(response=='login'){
                      window.location.href = "{{URL::to('/login')}}";
                    }
                  }
              })
            }

          }
          function deletealamatdetail(e){
            var t = $(e).data("id");
            Swal.fire({
            title: 'Apakah Ingin Menghapus',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: '#aeaeae',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            })

            .then((result) => {
                if (result.isConfirmed) {
                    console.log('login');
                       $.ajaxSetup({
                        headers: {
                          "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
                        }
                        }),
                        jQuery.ajax({
                            url: "{{ url('/deletealamat') }}",
                            method: "post",
                            data: {
                                id: t
                            },
                            success: function(response) {
                              if(response=='sukses'){
                                Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: 'Sukses Hapus Alamat',
                                showConfirmButton: false,
                                timer: 2000
                                });
                                getalamat(1);
                                getcountalamat();
                              }
                              if(response=='login'){
                                window.location.href = "{{URL::to('/login')}}";
                              }
                            }
                        });
                }
            });
          }
        </script>

@endsection
