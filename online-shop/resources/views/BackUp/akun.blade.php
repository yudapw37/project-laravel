@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')


<div class="container container-240 shop-collection catleft cAtas">
  <div class="w-100 conDataDiri" style="font-family:arial;">
    <div class="cCon1">
      <div class="row">
        <div class="col-md-3 col-sm-12 conDD1" style="height:125px">
          <p class="text-left text-bold" style="font-size:15px;" id="isiNamaDisini" > {{$nama}}</p>
          <p class="text-left" style="font-size:12px;">Username : <span id="isiUsernameDisini">{{$username}}</span></p>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
              <button type="button" class="btn btn-primary" style="width:90px;" data-toggle="modal" data-target="#exampleModal">
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
              Daftarkan diri anda menjadi reseller <span class="text-bold text-danger">AQWAM</span> untuk mendapatkan promo-promo menarik khusus reseller. hubungu <span class="text-bold" id="noTelpDisini"> 0899999999 </span> untuk mendaftarkan diri anda menjadi reseller <span class="text-bold text-danger">AQWAM</span>.
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
              <input id="usernameedt" type="text" class="form-control mt-s" disabled name="username"  value="">
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
                <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar aknSide" id="filter-sidebar">
                    <div id="filter" class="close-sidebar-collection btn-gradient hidden-lg hidden-md">
                        <span>Menu</span><i class="icon_close ion-close"></i>
                    </div>
                    <div class="filter filter-cate">
                        <ul class="wiget-content v3">
                          <li class="active"><div style="background:#e9e9e9;padding:10px 17px" style="cursor: context-menu" disabled>Menu</div>
                                <ul class="wiget-content v4">
                                  <!-- <li onclick="midBox('Data Diri')"><a style="cursor:pointer"><h3>Data Diri </h3></a></li> -->
                                  <li onclick="midBox('Invoice')"><a style="cursor:pointer"><h3>Invoice </h3></a></li>
                                  <li onclick="midBox('Wishlist')"><a style="cursor:pointer"><h3>Wishlist </h3></a></li>
                                  <li onclick="midBox('Order')"><a style="cursor:pointer"><h3>Order </h3></a></li>
                                  <li onclick="midBox('Order History')"><a style="cursor:pointer"><h3>Order History</h3></a></li>
                                  <li onclick="midBox('Order Ditahan')"><a style="cursor:pointer"><h3>Order Ditahan</h3></a></li>
                                  <li onclick="midBox('Alamat')"><a style="cursor:pointer"><h3>Alamat </h3></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
                  <div class="boxAkun">
                    <div class="boxAkunUpperBoxText">
                      <h1 id="textMidBox" class="page-title v4">Invoice</h1>
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
                                      <input type="text" class="form-control" placeholder="Ketik 3 Huruf.." id="selectkota" onkeyup="onkey()" list="cityname">
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
                                  <button onclick="addalamatmanual()"type="button" class="btn btn-success">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="midBoxAlamat table-responsive">
                          <table class="table" style="font-size:12px" >
                            <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                              <td>Penerima</td>
                              <td>Alamat Pengiriman</td>
                              <td>Daerah Pengiriman</td>
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
                              <td>Status Order</td>
                              <td class="text-center">Tanggal Update</td>
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
                              <td class="text-center">Tujuan</td>
                              <td class="text-center" style="min-width:180px;">Jumlah</td>
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
                              <td>Tanggal</td>
                              <td>Invoice</td>
                              <td>Tujuan</td>
                              <td>Tagihan</td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script>
        let iJudulBuku = $('#iJudulBuku');

        // $(document).ready(function () {
        //  iJudulBuku.select2({
        //         ajax: {
        //             url: '{{ url('alamatro') }}',
        //             dataType: 'json',
        //             data: function (params) {
        //                 return {
        //                     search: params.term,
        //                 }
        //             }
        //         }
        //     });
        //   });

        // $('#month').select2({
        //     placeholder: 'Select a month'
        // });



        // function onkeyup1(){
        //   // $("#tag_list").removeAttr('disabled');
        //     var input = document.getElementById("tag_list").value;
        //     console.log(input);
        // }

        //   $('#tag_list').select2({

        //     placeholder: "Ketik 3 huruf",
        //     minimumInputLength: 3,
        //     // multiple:false,
        //     ajax: {
        //         url: '/alamatro',
        //         dataType: 'json',
        //         data: function (params) {
        //             return {
        //                 q: $.trim(params.term)
        //             };
        //         },
        //         processResults: function (data) {
        //           console.log(data);
        //             return {
        //                 results: data
        //             };
        //             $('#tag_list').prop('disabled', true );
        //         },
        //         cache: true
        //     }
        // });

        </script>



        <script>
          var datadiri = "";
          var datainvoice = "";
          var cekcountinvoice = 0;
          var datawishlist = "";
          var cekcountwishlist = 0;
          var dataorder = "";
          var cekcountorder = 0;
          var dataorderhistory = "";
          var cekcountorderhistory = 0;
          var searchorderhistory = "";
          var dataalamat = "";
          var cekcountalamat = 0;
          var dataorderhold = "";
          var cekcountorderhold = 0;
          const prevwishlist = document.getElementById('prevwishlist');
          const nextwishlist = document.getElementById('nextwishlist');
          const previnvoice = document.getElementById('previnvoice');
          const nextinvoice = document.getElementById('nextinvoice');
          const prevorder = document.getElementById('prevorder');
          const nextorder = document.getElementById('nextorder');
          const prevorderhistory = document.getElementById('prevorderhistory');
          const nextorderhistory = document.getElementById('nextorderhistory');
          const prevalamat = document.getElementById('prevalamat');
          const nextalamat = document.getElementById('nextalamat');
          const prevorderhold = document.getElementById('prevorderhold');
          const nextorderhold = document.getElementById('nextorderhold');



          $('#modalOrder').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('id') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('Invoice No :' + recipient)
          })
          // $('#modalInvoice').on('show.bs.modal', function (event) {
          // var button = $(event.relatedTarget) // Button that triggered the modal
          // var recipient = button.data('id') // Extract info from data-* attributes
          // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          // var modal = $(this)
          // modal.find('.modal-title').text('Invoice No : ' + recipient)
          // })
          function editpass(){
            var inptPassLama='';
            var inptPassBaru='';
            var inptPassConfirm='';
            var x = document.getElementById("passerrorakun");
            inptPassLama = document.getElementById("inptPassLama").value;
            inptPassBaru = document.getElementById("inptPassBaru").value;
            inptPassConfirm = document.getElementById("inptPassConfirm").value;
            if(inptPassLama.trim()=='' || inptPassBaru.trim()=='' || inptPassConfirm.trim()=='' ){
              Swal.fire({
                  position: 'bottom-end',
                  icon: 'info',
                  title: 'Isi Data Dengan Lengkap & Benar',
                  showConfirmButton: false,
                  timer: 2000
                  });
                   x.style.display = "block";
                   x.innerHTML  = "Isi Data Anda dengan Benar" ;
            }
            else{
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                   });
                   jQuery.ajax({
                            url: "{{ url('/editpass') }}",
                            method: 'post',
                            data: {
                              oldpass: inptPassLama,
                              newpass: inptPassBaru,
                              confirmpass: inptPassConfirm
                            },
                            success: function(response){

                              if (response=='login'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Session habis, anda harus login dahulu',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });
                                window.location.href = "{{URL::to('login')}}";
                              }
                              else if (response=='sukses'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'success',
                                  title: 'Sukses Menyimpan Akun',
                                  showConfirmButton: false,
                                  timer: 2500
                               });
                               $(function () {
                                  $('#staticBackdropEdt').modal('toggle');
                                });
                                 x.style.display = "none";
                                window.location.href = "{{URL::to('logout')}}";
                              }
                              else if (response=='pendek'){
                                 x.style.display = "block";
                                 x.innerHTML  = "Password baru minimal 6 huruf" ;
                              }
                              else if (response=='panjang'){
                                 x.style.display = "block";
                                 x.innerHTML  = "Password baru maksimal 20 huruf" ;
                              }
                              else if (response=='salah'){
                                 x.style.display = "block";
                                 x.innerHTML  = "Password baru dan ulang password berbeda, harus sama" ;
                              }
                              else if (response=='sama'){
                                 x.style.display = "block";
                                 x.innerHTML  = "Password baru tidak boleh sama dengan password lama" ;
                              }else{
                                 x.style.display = "block";
                                 x.innerHTML  = "Isi Data Anda dengan Benar" ;
                                // Swal.fire({
                                //   position: 'bottom-end',
                                //   icon: 'info',
                                //   title: 'Isi Data Anda dengan Benar',
                                //   showConfirmButton: false,
                                //   timer: 2000
                                //   });
                              }
                        }});

              }
          }

          function editakun(){
            var namaedt='';
            var emailedt='';
            var hpedt='';
            var alamatedt='';
            var y = document.getElementById("edterrorakun");
            namaedt = document.getElementById("namaedt").value;
            emailedt = document.getElementById("emailedt").value;
            hpedt = document.getElementById("hpedt").value;
            alamatedt = document.getElementById("alamatedt").value;
            var ceknum = isNumeric(hpedt);
            if(namaedt.trim()=='' || emailedt.trim()=='' || hpedt=='' || alamatedt.trim()=='' ){
              // Swal.fire({
              //     position: 'bottom-end',
              //     icon: 'info',
              //     title: 'Isi Data Dengan Benar & Tidak Boleh Kosong',
              //     showConfirmButton: false,
              //     timer: 2000
              //     });
                  y.style.display = "block";
                  y.innerHTML  = "Isi Data Anda dengan Benar & Tidak Boleh Kosong" ;
            }
            else if(ceknum==false){
              // Swal.fire({
              //     position: 'bottom-end',
              //     icon: 'info',
              //     title: 'Isi No Hp dengan benar',
              //     showConfirmButton: false,
              //     timer: 2000
              //     });
                  y.style.display = "block";
                  y.innerHTML  = "Isi no Hp Anda dengan Angka yang Benar" ;
            }
            else{
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                   });
                   jQuery.ajax({
                            url: "{{ url('/edituser') }}",
                            method: 'post',
                            data: {
                              namaedt: namaedt,
                              emailedt: emailedt,
                              hpedt: hpedt,
                              alamatedt: alamatedt,
                            },
                            success: function(response){

                              if (response=='login'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Session habis, anda harus login dahulu',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });
                                window.location.href = "{{URL::to('login')}}";
                              }
                              else if (response=='sukses'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'success',
                                  title: 'Sukses Menyimpan Akun',
                                  showConfirmButton: false,
                                  timer: 2500
                               });
                               $(function () {
                                  $('#staticBackdropEdt').modal('toggle');
                                });
                                location.reload();
                              }else{
                                  y.style.display = "block";
                                  y.innerHTML  = "Isi Data Anda dengan Benar" ;
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Isi Data Anda dengan Benar',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });


                              }
                        }});

              }
          }
          function changepass(){

          }

          function onZoom(){
            var x = document.getElementsByClassName("zoomIn").length;
            var y = document.getElementById('zImg')
            if (x == 0) {
              y.className ="mw-120 zoomIn"
            }else {
              y.className ="mw-100"
            }
          }

          // document.getElementById("kota").addEventListener("change", cekKota);
          function cekKota(){
            val = document.getElementById("kota").value
            kec = document.getElementById('kecamatan');
            if (val != "" || val != "-") {
              kec.disabled = false;
            }else {
              kec.disabled = true;
            }
          }
          function btnPic(){
            document.getElementById("myfile").click();
          }

          document.getElementById("Invoice").addEventListener("load", midBox('Invoice'));

          function getkota(){
            var input = document.getElementById("kota").value;
            console.log('input');
          }
          function onkey(){
            getkota1();
            }

          var up = 0;
          function getkota1(){
            var input = document.getElementById("selectkota").value;
            console.log(input);
            if(input.length >= 3){
              // if (input.length>up){
                getkotaall(input);
              // }
            }
             if(input.length < 3){
               document.getElementById("cityname").innerHTML = '';
             }
             up = input.length;
          }

          function getkotaall(val){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/alamatro') }}",
                    method: 'post',
                    data: {
                      val: val,
                    },
                    success: function(response){
                      var x = ""
                      console.log(response);
                      variable = response;
                        for (i in variable) {
                         x +='<option data-id="'+variable[i].id_alamat+'" value="'+variable[i].text+'"></option>';

                        }
                      document.getElementById("cityname").innerHTML = x ;
                    }});
          }

          function btnEdtDataweb(){
              isivaledit();
          }
          function btnEdtData(){
              isivaledit();
              document.getElementById('edtData').click();
          }
          function btnEdtPass(){
            document.getElementById('edtPass').click();
          }

          function isivaledit(){
            var username = document.getElementById("isiUsernameDisini").innerHTML;
            var nama = document.getElementById("isiNamaDisini").innerHTML;
            var email = document.getElementById("isiEmailDisini").innerHTML;
            var telp = document.getElementById("isiHPDisini").innerHTML;
            var alamat = document.getElementById("isiAlamatDisini").innerHTML;
            console.log(telp);
             document.getElementById("usernameedt").value = username;
             document.getElementById("namaedt").value = nama;
             document.getElementById("emailedt").value = email;
             document.getElementById("hpedt").value = telp;
             document.getElementById("alamatedt").value = alamat;
          }


          function midBox(par){
            console.log(par);
            const midText = document.getElementById('textMidBox')
            midText.innerHTML = par
            if (par == "Data Diri") {
              document.getElementById("dataDiri").className = "";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("Order").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              document.getElementById("Order History").className = "d-none";
            }else if (par == "Wishlist") {
              document.getElementById("wishList").className = "";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("Order").className = "d-none";
              document.getElementById("Order History").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              getcountwishlist();
              if(datawishlist = cekcountwishlist){console.log(datawishlist);}
                else{getwishlist(1); datawishlist = cekcountwishlist;
                document.getElementById("pagewish").innerHTML = 1;prevwishlist.classList.add('disabled2');}
              // console.log(cekcountwishlist);

            }else if (par == "Alamat") {
              document.getElementById("Alamat").className = "";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("Order Ditahan").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Order").className = "d-none";
              document.getElementById("Order History").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              getcountalamat();
              if(dataalamat = cekcountalamat){console.log(dataalamat);}
              else{getalamat(1); dataalamat = cekcountalamat;
                document.getElementById("pagealamat").innerHTML = 1;prevalamat.classList.add('disabled2');}
            }else if (par == "Order") {
              document.getElementById("Order").className = "";
              document.getElementById("Order History").className = "d-none";
              document.getElementById("Order Ditahan").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              document.getElementById("btnUlasBarang").classList.add('d-none');
              getcountorder();
              if(dataorder = cekcountorder){console.log(dataorder);}
              else{getorder(1); dataorder = cekcountorder;
                document.getElementById("pageorder").innerHTML = 1;prevorder.classList.add('disabled2');}
            }else if (par == "Order Ditahan") {
              document.getElementById("Order Ditahan").className = "";
              document.getElementById("Order").className = "d-none";
              document.getElementById("Order History").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              getcountorderhold();
              if(dataorderhold = cekcountorderhold){console.log(dataorderhold);}
              else{getorderhold(1); dataorderhold = cekcountorderhold;
                document.getElementById("pageorderhold").innerHTML = 1;prevorderhold.classList.add('disabled2');}
            }else if (par == "Invoice") {
              document.getElementById("Invoice").className = "";
              document.getElementById("Order").className = "d-none";
              document.getElementById("Order Ditahan").className = "d-none";
              document.getElementById("Order History").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              getcountinvoice();
              if(datainvoice = cekcountinvoice){console.log(datainvoice);}
              else{getinvoice(1); datainvoice = cekcountinvoice;
                document.getElementById("pageinvoice").innerHTML = 1;previnvoice.classList.add('disabled2');}
            }else if (par == "Order History") {
              document.getElementById("Order History").className = "";
              document.getElementById("btnUlasBarang").classList.remove('d-none');
              document.getElementById("Order").className = "d-none";
              document.getElementById("Order Ditahan").className = "d-none";
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              getcountorderhistory("");
              if(dataorderhistory = cekcountorderhistory){console.log(dataorderhistory);}
              else{getorderhistory(1,""); dataorder = cekcountorderhistory;
                document.getElementById("pageorderhistory").innerHTML = 1;prevorderhistory.classList.add('disabled2');}
            }
            document.getElementById('filter').click();
          }

          function previnv(){
            var now =0;
            var x = document.getElementById("pageinvoice").innerHTML;
            nextinvoice.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pageinvoice").innerHTML = parseInt(x) - 1;
              getinvoice(now);
            }else{
              previnvoice.classList.add('disabled2');
            }

          }
          function nextinv(){
            var now =0;
            previnvoice.classList.remove('disabled2');
            var x = document.getElementById("pageinvoice").innerHTML;
            var y = x * 5;
            if(y < cekcountinvoice){
              now = parseInt(x) + 1;
              document.getElementById("pageinvoice").innerHTML = now;
              getinvoice(now);
            }else{
              nextinvoice.classList.add('disabled2');
            }
          }
          function getinvoice(page){
            document.getElementById("tableinvoice").innerHTML =
          "<tr>"+
              "<td colspan='5' style='padding:30px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            console.log(x)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/invoice') }}",
                    method: 'post',
                    data: {
                      page: x,
                    },
                    success: function(response){
                      if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var invoice = ""
                      console.log(response);
                      variable = response;
                      if(variable!='null'){
                        for (i in variable) {
                          console.log(variable[i].idOrder)
                          invoice += '<tr><td><span class="text-bold f-15">'+date(variable[i].created_at)+'</span></td>'+
                          '<td><span class="text-bold f-15">'+variable[i].idOrder+'</span></td>'+
                          '<td><span class="text-bold f-15">'+variable[i].nama_penerima+'</span></td>'+
                          '<td><span class="text-bold f-15">'+rupiah(netto(variable[i].total_harga, variable[i].biaya_expedisi, variable[i].totalDiskon))+'</span></td>'+
                          '<td style="width:100px;"> <a type="button" href="/print/'+variable[i].idOrder+'" class="btn btn-primary" name="button"><i class="fa fa-print" style="font-size:15px"></i></a> <a type="button" href="/verif/'+variable[i].idOrder+'" class="btn btn-success" name="button"><i class="fa fa-check-square-o" style="font-size:15px"></i></a></td></tr>'
                          // invoice += '<tr class="item_cart"> <td class="product-name flex align-center"> <a href="#" onclick="deletewishlist(this)" data-id="'+variable[i].idBuku+'" class="btn-del"><i class="ion-ios-close-empty"></i></a> <div class="product-img pProd"> <img src="img/product/sound2.jpg" alt="Futurelife"> </div> <div class="product-info tProd"> <a href="/detail/'+variable[i].idBuku+'" title="">'+variable[i].judul_buku+'</a> </div> </td> <td class="total-price"> <p class="price">'+rupiah(variable[i].harga)+'</p> </td> <td class="w-button"> <a class="btn-addcart btn-gradient" onclick="addcart(this)" data-id="'+variable[i].idBuku+'"  href="#">Add to cart</a> </td> </tr>'
                        }
                      }else{
                        invoice = '<tr> Data Kosong </tr>'
                      }
                      document.getElementById("tableinvoice").innerHTML = invoice;
                    }});
          }
          function getcountinvoice(){
              jQuery.ajax({
                  url: "{{ url('/countinvoice') }}",
                   method: 'get',
                  success: function(response){
                    if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    document.getElementById("totalinvoice").innerHTML = response;
                    cekcountinvoice = response;
                    if(cekcountinvoice<5){nextinvoice.classList.add('disabled2');}
                    else{nextinvoice.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }



          function deleteinvoice(idv){
            var id = $(idv).data("id");
            console.log(id);
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/deleteinvoice') }}",
                    method: 'post',
                    data: {
                      id: id,
                    },
                    success: function(response){
                      console.log(response);
                      document.getElementById("totalinvoice").innerHTML = response;
                      cekcountinvoice = response;
                      if(cekcountinvoice<5){nextinvoice.classList.add('disabled2');}
                      else{nextinvoice.classList.remove('disabled2');}
                      if(response>0){ getinvoice(1); }
                    }});
          }

          function prevwish(){
            var now =0;
            var x = document.getElementById("pagewish").innerHTML;
            nextwishlist.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pagewish").innerHTML = parseInt(x) - 1;
              getwishlist(now);
            }else{
              prevwishlist.classList.add('disabled2');
            }

          }
          function nextwish(){
            var now =0;
            prevwishlist.classList.remove('disabled2');
            var x = document.getElementById("pagewish").innerHTML;
            var y = x * 5;
            if(y < cekcountwishlist){
              now = parseInt(x) + 1;
              document.getElementById("pagewish").innerHTML = now;
              getwishlist(now);
            }else{
              nextwishlist.classList.add('disabled2');
            }
          }
          function getwishlist(page){
            document.getElementById("tablewishlist").innerHTML =
          "<tr>"+
              "<td colspan='3' style='padding:30px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            console.log(x)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/wishlist') }}",
                    method: 'post',
                    data: {
                      page: x,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var wish = ""
                      var btnd = ""
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                                  if(variable[i].stock==0){
                                   btnd = '<td class="w-button"> <a class="btn-addcart btn-gradient disabled" >Stock Kosong</a> </td> </tr>'
                                  }else{
                                    btnd ='<td class="w-button"> <a class="btn-addcart btn-gradient" onclick="addcart(this)" data-id="'+variable[i].idBuku+'"  href="#">Add to cart</a> </td> </tr>'
                                  }
                              wish += '<tr class="item_cart"> <td class="product-name flex align-center"> <a href="#" onclick="deletewishlist(this)" data-id="'+variable[i].idBuku+'" class="btn-del"><i class="ion-ios-close-empty text-danger text-bold"></i></a> <div class="product-img pProd"> <img src="img/product/sound2.jpg" alt="Futurelife"> </div> <div class="product-info tProd"> <a href="/detail/'+variable[i].idBuku+'" title="">'+variable[i].judul_buku+'</a> </div> </td> <td class="total-price"> <p class="price">'+rupiah(variable[i].harga)+'</p> </td>'+btnd

                        }
                      }else{
                        wish = '<tr class="item_cart">Data Kosong</tr>'
                      }
                      document.getElementById("tablewishlist").innerHTML = wish;
                    }});
          }
          function getcountwishlist(){

              jQuery.ajax({
                  url: "{{ url('/countwishlist') }}",
                  method: 'get',
                  success: function(response){
                     if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    // console.log(response);
                    document.getElementById("totalwhislist").innerHTML = response;
                    cekcountwishlist = response;
                    if(cekcountwishlist<5){nextwishlist.classList.add('disabled2');}
                    else{nextwishlist.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }

          function deletewishlist(idv){
            var id = $(idv).data("id");
            console.log(id)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/deletewishlist') }}",
                    method: 'post',
                    data: {
                      id: id,
                    },
                    success: function(response){
                      console.log(response);
                      document.getElementById("totalwhislist").innerHTML = response;
                      cekcountwishlist = response;
                      if(cekcountwishlist<5){nextwishlist.classList.add('disabled2');}
                      else{nextwishlist.classList.remove('disabled2');}
                      if(response>0){ getwishlist(1); }
                      if(response==0){
                        wish = '<tr class="item_cart">Data Kosong</tr>'

                      document.getElementById("tablewishlist").innerHTML = wish;
                      }
                    }});
          }


          function prevord(){
            var now =0;
            var x = document.getElementById("pageorder").innerHTML;
            nextorder.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pageorder").innerHTML = parseInt(x) - 1;
              getorder(now);
            }else{
              prevorder.classList.add('disabled2');
            }

          }
          function nextord(){
            var now =0;
            prevorder.classList.remove('disabled2');
            var x = document.getElementById("pageorder").innerHTML;
            var y = x * 5;
            if(y < cekcountorder){
              now = parseInt(x) + 1;
              document.getElementById("pageorder").innerHTML = now;
              getorder(now);
            }else{
              nextorder.classList.add('disabled2');
            }
          }
          function getorder(page){
            document.getElementById("tableorder").innerHTML =
          "<tr>"+
              "<td colspan='4' style='padding:30px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            console.log(x)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/order') }}",
                    method: 'post',
                    data: {
                      page: x,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var order = ""
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                          order += '<tr><td><span class="text-bold f-15">'+variable[i].code_order+'</span><br>('+date(variable[i].created_at)+')</td><td><span class="text-bold f-15">'+getstatusord(variable[i].code_status)+'('+variable[i].code_status+')</td> <td class="text-center"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>'
                        }
                      }else{
                        order = '<tr class="item_cart">Data Kosong</tr>'
                      }
                      document.getElementById("tableorder").innerHTML = order;
                    }});
          }
          function getcountorder(){

              jQuery.ajax({
                  url: "{{ url('/countorder') }}",
                  method: 'get',
                  success: function(response){
                     if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    // console.log(response);
                    document.getElementById("totalorder").innerHTML = response;
                    cekcountorder = response;
                    if(cekcountorder<5){nextorder.classList.add('disabled2');}
                    else{nextorder.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }
          function getorddetail(varidord){
            console.log(varidord);
            var id = $(varidord).data("id");
            console.log(id);
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/orderdetail') }}",
                    method: 'post',
                    data: {
                      id: id,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var order = "";
                      var orddetail = "";
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        var exp = variable.ord.expedisi;
                        var total = parseInt(variable.ord.total_harga)+parseInt(variable.ord.biayaExpedisi)-parseInt(variable.ord.totalDiskon);
                        order ='<tr><td>No Order</td><td>'+id+'</td></tr><tr><td>Pembeli :</td><td>'+variable.ord.nama_pengirim+'</td></tr><tr><td>No Hp</td><td>'+variable.ord.telephone_pengirim+'</td></tr><tr><td>Tujuan </td><td>'+variable.ord.nama_penerima+' ('+variable.ord.telephone_penerima+') <br>'+variable.ord.alamat+'</td>'+
                        '</tr><tr><td colspan="2">barang : <table class="table table-bordered" id=""><tr><th>Nama Buku</th><th>Jumlah</th><th>Harga</th><th>Diskon</th><th>Total</th></tr><tbody id="detailord"></tbody></table></td></tr>'+
                        '<tr><td>Ekspedisi</td><td>'+exp.toUpperCase()+'</td></tr><tr><td>Harga Awal</td><td>'+rupiah(variable.ord.total_harga)+'</td></tr><tr><td>Biaya Ekspedisi</td><td>'+rupiah(variable.ord.biayaExpedisi)+'</td></tr><tr><td>Diskon</td><td>'+rupiah(variable.ord.totalDiskon)+'</td></tr><tr><td>Total harga</td><td>'+rupiah(total)+'</td></tr>';
                         for (i in variable.a) {
                           nama = '';
                           buku = '';
                           code = variable.a[i].code;
                          //  console.log(code.substring(0, 5));
                           if(code.substring(0, 5).toLowerCase()=='promo'){
                             console.log(variable.a[i].nama);
                             nm = variable.a[i].nama.nama;
                             buku1 = variable.a[i].nama.buku;
                             for (x in buku1){
                               buku += '-'+buku1[x] +'<br>';
                             }
                            nama=nm+'<br>'+buku;
                           }else{
                             nama = variable.a[i].nama;
                           }
                           orddetail +='<tr><td>'+nama+'</td><td>'+variable.a[i].jumlah+'</td><td>'+variable.a[i].harga+'</td><td>'+variable.a[i].diskon+'</td><td>'+variable.a[i].total+'</td></tr>';
                         }

                      }else{
                        order = '<tr class="item_cart">Data Kosong</tr>';
                      }
                      //   for (i in variable) {
                      //     order += '<tr><td><span class="text-bold f-15">'+variable[i].code_order+'</span><br>('+date(variable[i].created_at)+')</td><td><span class="text-bold f-15">'+getstatusord(variable[i].code_status)+'('+variable[i].code_status+')</td> <td class="text-center"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>'
                      //   }
                      // }else{
                      //   order = '<tr class="item_cart">Data Kosong</tr>'
                      // }
                      document.getElementById("tblorddetail").innerHTML = order;
                      document.getElementById("detailord").innerHTML = orddetail;
                    }});
          }

          function prevordhold(){
            var now =0;
            var x = document.getElementById("pageorderhold").innerHTML;
            nextorderhold.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pageorderhold").innerHTML = parseInt(x) - 1;
              getorderhold(now);
            }else{
              prevorderhold.classList.add('disabled2');
            }

          }
          function nextordhold(){
            var now =0;
            prevorderhold.classList.remove('disabled2');
            var x = document.getElementById("pageorderhold").innerHTML;
            var y = x * 5;
            if(y < cekcountorderhold){
              now = parseInt(x) + 1;
              document.getElementById("pageorderhold").innerHTML = now;
              getorderhold(now);
            }else{
              nextorderhold.classList.add('disabled2');
            }
          }
          function getorderhold(page){
            document.getElementById("tableorderhold").innerHTML =
          "<tr>"+
              "<td colspan='4' style='padding:30px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            console.log(x)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/orderhold') }}",
                    method: 'post',
                    data: {
                      page: x,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var order = ""
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                          order += '<tr><td><span class="text-bold f-15">'+variable[i].code_order+'</span><br>('+date(variable[i].created_at)+')</td><td><span class="text-bold f-15">'+getstatusordhold(variable[i].code_status)+'('+variable[i].code_status+')</td> <td class="text-center"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>'
                        }
                      }else{
                        order = '<tr class="item_cart">Data Kosong</tr>'
                      }
                      document.getElementById("tableorderhold").innerHTML = order;
                    }});
          }
          function getcountorderhold(){

              jQuery.ajax({
                  url: "{{ url('/countorderhold') }}",
                  method: 'get',
                  success: function(response){
                     if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    // console.log(response);
                    document.getElementById("totalorderhold").innerHTML = response;
                    cekcountorderhold = response;
                    if(cekcountorderhold<5){nextorderhold.classList.add('disabled2');}
                    else{nextorderhold.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }

          function prevordhs(){
            var now =0;
            var x = document.getElementById("pageorderhistory").innerHTML;
            nextorderhistory.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pageorderhistory").innerHTML = parseInt(x) - 1;
              getorderhistory(now,searchorderhistory);
            }else{
              prevorderhistory.classList.add('disabled2');
            }

          }
          function nextordhs(){
            var now =0;
            prevorderhistory.classList.remove('disabled2');
            var x = document.getElementById("pageorderhistory").innerHTML;
            var y = x * 5;
            if(y < cekcountorderhistory){
              now = parseInt(x) + 1;
              document.getElementById("pageorderhistory").innerHTML = now;
              getorderhistory(now, searchorderhistory);
            }else{
              nextorderhistory.classList.add('disabled2');
            }
          }
          function getorderhistory(page, search){
            document.getElementById("tableorderhistory").innerHTML =
          "<tr>"+
              "<td colspan='4' style='padding:3px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            // console.log(x);
            // console.log(search)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/orderhistory') }}",
                    method: 'post',
                    data: {
                      page: x,
                      ordInput: search,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var orderhistory = ""
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                          orderhistory += '<tr><td style="min-width:230px!important"><span class="text-bold f-15">'+variable[i].idOrder+'</span><br>'+date(variable[i].created_at)+'</td><td style="min-width:285px;"><span class="text-bold f-15">Rumah  ( '+variable[i].nama_penerima+' )</span><br>'+variable[i].alamat+'</td><td class="text-center"><span class="text-bold text-center f-15">'+rupiah(netto(variable[i].total_harga, variable[i].biayaExpedisi, variable[i].totalDiskon))+'</span></td><td><div style="padding-top:5px;"><button  onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].idOrder+'"><span class="text-bold">Detail</span></button></div></td></tr>'
                        }
                      }else{
                        orderhistory = '<tr class="item_cart">Data Kosong</tr>'
                      }
                      document.getElementById("tableorderhistory").innerHTML = orderhistory;
                    }});
          }
          function getcountorderhistory(search){

              jQuery.ajax({
                  url: "{{ url('/countorderhistory') }}",
                  method: 'get',
                  data: {
                      ordInput: search,
                    },
                  success: function(response){
                     if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    // console.log(response);
                    document.getElementById("totalorderhistory").innerHTML = response;
                    cekcountorderhistory = response;
                    if(cekcountorderhistory<5){nextorderhistory.classList.add('disabled2');}
                    else{nextorderhistory.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }

          function cariBuku( value){
            searchorderhistory=value;
            getorderhistory(1, searchorderhistory);
            getcountorderhistory(searchorderhistory);
          }

          var input = document.getElementById("noInvoice");
            input.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("ordbtn").click();
                }
          });


          function prevalm(){
            var now =0;
            var x = document.getElementById("pagealamat").innerHTML;
            nextalamat.classList.remove('disabled2');
            if (x > 1){
              now = parseInt(x) - 1;
              document.getElementById("pagealamat").innerHTML = parseInt(x) - 1;
              getalamat(now);
            }else{
              prevalamat.classList.add('disabled2');
            }

          }
          function nextalm(){
            var now =0;
            prevalamat.classList.remove('disabled2');
            var x = document.getElementById("pagealamat").innerHTML;
            var y = x * 5;
            if(y < cekcountalamat){
              now = parseInt(x) + 1;
              document.getElementById("pagealamat").innerHTML = now;
              getalamat(now);
            }else{
              nextalamat.classList.add('disabled2');
            }
          }
          function getalamat(page){
            document.getElementById("tablealamat").innerHTML =
          "<tr>"+
              "<td colspan='4' style='padding:30px 0px 40px' >"+
                  "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
              "</td>"+
            "</tr>";
            var x = (page -1 ) * 5;
            console.log(x)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/akunalamat') }}",
                    method: 'post',
                    data: {
                      page: x,
                    },
                    success: function(response){
                       if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                      var alamat = ""
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                          alamat += '<tr><td><span class="text-bold">'+variable[i].nama+'</span><br> '+variable[i].no_telp+'</td><td><span class="text-bold">Rumah</span><br>'+variable[i].alamat+'</td><td>'+variable[i].kecamatan+'</td><td><button type="button" style="font-size:12px;" class="btnKcl btn-danger"  name="button" title="Hapus Alamat"><span class="fa fa-trash"></span></button><button type="button" style="font-size:12px; margin-left:10px;" class="btnKcl btn-info" name="button" title="Ubah Alamat"><span class="fa fa-pencil-square-o"></span></button></td></tr>'
                        }
                      }else{
                        alamat = '<tr class="item_cart">Data Kosong</tr>'
                      }
                      document.getElementById("tablealamat").innerHTML = alamat;
                    }});
          }
          function getcountalamat(){

              jQuery.ajax({
                  url: "{{ url('/countakunalamat') }}",
                  method: 'get',
                  success: function(response){
                     if(response=='login'){
                           window.location.href = "{{URL::to('/')}}";
                      }
                    // console.log(response);
                    document.getElementById("totalalamat").innerHTML = response;
                    cekcountalamat = response;
                    if(cekcountalamat<5){nextalamat.classList.add('disabled2');}
                    else{nextalamat.classList.remove('disabled2');}
                    // console.log(response);
                  }});
          }


          function addcart(idv){
            var id = $(idv).data("id");
            console.log(id);
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
                                                  if (response==1){
                                                        location.reload();
                                                        // midBox(Wishlist);
                                                      }

                                                    console.log(response);

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
          }


          function rupiah(bil){
            var 	bilangan = bil;

            var	reverse = bilangan.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');

            var idr = 'Rp. '+ribuan+',00';

              return idr;
          }
          function date(char){
            var d = new Date(char);
              months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            // return d.getDate()+' '+months[d.getMonth()]+' '+d.getFullYear();
            return d.getDate()+' '+months[d.getMonth()]+' '+d.getFullYear();
          }
          function getstatusord(val){
            if(val==4){
              return  'Proses Verifikasi Pembayaran';
            }
            else if(val==5){
              return  'Proses Verifikasi Pembayaran';
            }
            else if(val==6){
              return  'Proses Pengemasan Barang';
            }
            else if(val==7){
              return  'Proses Pengemasan Barang';
            }
            else if(val==9){
              return  'Selesai & Menunggu dikirim Kurir'
            }
            else{
              return 'Unknown'
            }
          }
          function getstatusordhold(val){
            if(val==71){
              return  'Gagal Konfirmasi Sales';
            }
            else if(val==81){
              return  'Proses Verifikasi Pembayaran Gagal';
            }
            else if(val==91){
              return  'Stock Buku Di Gudang Habis';
            }
            else{
              return 'Unknown'
            }
          }
          function netto(val1, val2, val3){
            var netto = 0;

            var valint1 = parseInt(val1);
            var valint2 = parseInt(val2);
            var valint3 = parseInt(val3);
            netto= valint1+valint2-valint3;
            // console.log(valint1);
            // console.log(valint2);
            // console.log(valint3);
            // console.log(netto);
            return netto;
          }

          function isNumeric(str) {
            if (typeof str != "string") return false
            return !isNaN(str) &&
                  !isNaN(parseFloat(str))
          }

          function setalamat(namamnl,hpmnl,alamatmnl,selectkota,kode_ro){
            document.getElementById("namaalamat").innerHTML = namamnl;
              document.getElementById("noalamat").innerHTML = ' (' +hpmnl+')';
              document.getElementById("alamat").innerHTML = alamatmnl;
              document.getElementById("kecalamat").innerHTML = selectkota;
              document.getElementById("destination").innerHTML = kode_ro;
              gEkspedisiPrice();
              document.getElementById("cEkspPrice").innerHTML = '-';
              document.getElementById("totalall").innerHTML = '-';
              document.getElementById("textkurir").innerHTML = '-';
              var kk =document.getElementById('kKirimManual').classList;
              btnorder.add("disabled");
              ongkir = 0;
              subtotal= 0;
              $(function () {
                $('#staticBackdrop').modal('toggle');
              });
          }

           function addalamatmanual(){
            var namamnl='';
            var hpmnl='';
            var alamatmnl='';
            var namamnl='';
            namamnl = document.getElementById("namamnl").value;
            hpmnl = document.getElementById("hpmnl").value;
            alamatmnl = document.getElementById("alamatmnl").value;
            selectkota = document.getElementById("selectkota").value;
            var kode_ro = $('#cityname option[value="' + $('#selectkota').val() + '"]').data('id');
            var ceknum = isNumeric(hpmnl);
            if(namamnl.trim()=='' || hpmnl.trim()=='' || selectkota=='' || alamatmnl.trim()=='' ){
              Swal.fire({
                  position: 'bottom-end',
                  icon: 'info',
                  title: 'Isi Data Dengan Lengkap & Benar',
                  showConfirmButton: false,
                  timer: 2000
                  });
            }
            else if(ceknum==false){
              Swal.fire({
                  position: 'bottom-end',
                  icon: 'info',
                  title: 'Isi No Hp dengan benar',
                  showConfirmButton: false,
                  timer: 2000
                  });
            }
            else{
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                   });
                   jQuery.ajax({
                            url: "{{ url('/addalamat') }}",
                            method: 'post',
                            data: {
                              nama: namamnl,
                              no_telp: hpmnl,
                              alamat: alamatmnl,
                              kecamatan: selectkota,
                              kode_ro: kode_ro,
                            },
                            success: function(response){
                              if(response=='hapus'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Alamat tersimpan maksimal 10, hapus dahulu untuk menyimpan alamat baru',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });
                              }
                              else if (response=='login'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Session habis, anda harus login dahulu',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });
                                window.location.href = "{{URL::to('login')}}";
                              }
                              else if (response=='sukses'){
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'success',
                                  title: 'Sukses Menyimpan alamat',
                                  showConfirmButton: false,
                                  timer: 2500
                               });
                               setalamat(namamnl,hpmnl,alamatmnl,selectkota,kode_ro);
                              }else{
                                Swal.fire({
                                  position: 'bottom-end',
                                  icon: 'info',
                                  title: 'Isi Data Anda dengan Benar',
                                  showConfirmButton: false,
                                  timer: 2000
                                  });
                              }
                        }});

              }

           }


           function passVis1(){vis("inptPassLama","hide1");}
           function passVis2(){vis("inptPassBaru","hide2");}
           function passVis3(){vis("inptPassConfirm","hide3");}

           function vis(input,tombol){
            var x = document.getElementById(input);
            var y = document.getElementById(tombol);
                if (x.type === 'password') {
                    x.type = "text";
                    y.className= "fa fa-eye";
                } else {
                    x.type = "password";
                    y.className= "fa fa-eye-slash";
                }
            }

        </script>

@endsection
