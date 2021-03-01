@extends('main.mainOther')
@section('title', 'Aqwam')
@section('body')
    <div class="main-content space1">
      <div class="container container-240 mt-5">
        <div class="cart-box-container-ver2">
          <div class="row">
            <div class="col-md-8">
              <div class="co-left bd-7" style="padding: 55px 20px 0!important;">
                <div style="display:flex;justify-content:center">
                  <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -90px 0 0;" alt="">
                  <h4 style="color:white;position:absolute;margin:-61px 0 0">DETAIL PENGIRIMAN</h4>
                </div>
                <div class="midBoxAlamat table-responsive">
                  <div style="font-size:13px; padding:20px;">
                    <div style="border-bottom:2px solid #bcb3b3;padding-bottom:0.5em;">
                      <h3 class="text-bold">Data Pengirim</h3>
                    </div>
                    <div class="mt-1" style="border-bottom:2px solid #bcb3b3;padding-bottom:0.5em;">
                      <select onclick="pengirim(this.value)" class="form-control" name="">
                        <option value="1">Aqwam</option>
                        <option value="2">Manual</option>
                      </select>
                      <div class="row" style="padding-bottom: 15px;">
                        <div class="col-sm-12 col-md-6 mt-1">
                          <p style="padding-bottom: 5px;">Nama :</p>
                          <input id="conPengirim1" type="text" class="form-control" disabled name="" value="Aqwam">
                        </div>
                        <div class="col-sm-12 col-md-6 mt-1">
                          <p style="padding-bottom: 5px;">Nomor telepon :</p>
                          <input id="conPengirim2" type="text" class="form-control" disabled name="" value="-">
                        </div>
                      </div>
                    </div>
                    <div class="mt-1" style="border-bottom:2px solid #bcb3b3;padding-bottom:0.5em;">
                      <h3 class="text-bold">Data Penerima</h3>
                    </div>
                    @if ($cekpenerima=='ready')
                    <div class="mt-1" style="border-bottom:2px solid #bcb3b3;padding-bottom:1.5em;">
                      <span style="font-weight:bolder;font-size:15px;" id="namaalamat">{{$penerima->nama}}</span>
                      <span id="noalamat" >({{$penerima->no_telp}})</span>
                      <p id="alamat" class="mt-s">{{$penerima->alamat}}</p>
                      <p id="kecalamat" class="mt-s">{{$penerima->kecamatan}}</p>
                      <p id="destination" hidden class="mt-s">{{$penerima->kode_ro}}</p>
                    </div>
                    @else
                    <div class="mt-1" style="border-bottom:2px solid #bcb3b3;padding-bottom:1.5em;">
                      <span style="font-weight:bolder;font-size:15px;" id="namaalamat">-</span>
                      <span id="noalamat" >(-)</span>
                      <p id="alamat" style="text-align:center;" class="mt-s">-Isi Data Penerima Untuk Melanjutkan Checkout Pesanan-</p>
                      <p id="kecalamat" class="mt-s">-</p>
                      <p id="destination" hidden class="mt-s">0</p>
                    </div>
                    @endif
                    <div style="padding: 10px 0;text-align:right">
                      <button type="button" style="width:125px" class="btnB btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Tambah Alamat
                      </button>

                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content" style="border-radius:10px;border:2px solid #ccc7c7">
                            <div class="modal-header">
                              <button type="button" style="margin:5px 5px 0px 0px" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h5 class="modal-title" id="staticBackdropLabel">Tambah Alamat Baru</h5>
                            </div>
                            <div style="padding: 0px 10px" class="modal-body text-left">
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
                                <td><textarea rows="4" id="alamatmnl" type="text" class="form-control" name="" value=""> </textarea></td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="form-check" style="margin-left:0">
                                    <input type="checkbox" class="form-check-input" id="chkSimpanAlamat">
                                    <label class="form-check-label" for="exampleCheck1">Simpan Alamat</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="button" onclick="cSimpanAlamat(chkSimpanAlamat.checked)" class="btn btn-success">Pilih</button>
                              <!-- <button type="button" onclick="addalamatmanual()" class="btn btn-success">Pilih & Simpan</button> -->
                            </div>
                          </div>
                        </div>
                      </div>

                      <button id="myButton" type="button" style="width:125px" class="btnB btn-primary" data-toggle="modal">
                        Pilih Alamat Lain
                      </button>
                    </div>
                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdropAlamat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Pilih Alamat</h5>
                            </div>
                            <div id="alamatlain" class="modal-body" style="padding: 5px 20px!important;overflow:auto; max-height:320px;border-top: 1px solid #e5e5e5;">
                              <!-- <div class="conAlmt">
                                <p class="text-left text-bold" style="font-size:15px;"> Arditya Wahyuliantara</p>
                                <p class="text-left" style="font-size:12px;">089696873414</span></p>
                                <p class="text-left" style="font-size:12px;">Jl Turusan Kidul no 539 Rt 2 Rw 07 Turusan Sidorejo Salatiga Jawa Tengah Indonesia</span></p>
                                <div class="text-right my-1">
                                  <button type="button" class="btnB btn-gradient" data-toggle="modal" data-target="#staticBackdropAlamat">
                                    Pilih Alamat
                                  </button>
                                </div>
                              </div> -->
                               <!-- <div class="conAlmt">
                                <p class="text-left text-bold" style="font-size:15px;"> Arditya Wahyuliantara</p>
                                <p class="text-left" style="font-size:12px;">089696873414</span></p>
                                <p class="text-left" style="font-size:12px;">Jl Turusan Kidul no 539 Rt 2 Rw 07 Turusan Sidorejo Salatiga Jawa Tengah Indonesia</span></p>
                                <div class="text-right my-1">
                                  <button type="button" class="btnB btn-gradient" data-toggle="modal" data-target="#staticBackdropAlamat">
                                    Pilih Alamat
                                  </button>
                                </div>
                              </div> -->
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btnB btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- mati -->
                  <table class="table d-none" style="font-size:12px" >
                    <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                      <td style="width:60px"></td>
                      <td>Penerima</td>
                      <td>Alamat Pengiriman</td>
                    </tr>

                    <tr>
                      <td>
                        <label class="containerR">
                          <input type="radio" checked name="radio">
                          <span class="checkmark"></span>
                        </label>
                      </td>
                      <td><span class="text-bold">Arditya Wahyuliantara</span><br> 089696873414 </td>
                      <td><span class="text-bold">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                      <!-- <td>
                        <button type="button" onclick="gOngkir(1)" style="font-size:12px;" class="btnPilih btn-success"  name="button" title="Hapus Alamat"><span class="fa fa-check"></span> Pilih</button>
                      </td> -->
                    </tr>
                    <tr>
                      <td>
                        <label class="containerR">
                          <input type="radio" name="radio">
                          <span class="checkmark"></span>
                        </label>
                      </td>
                      <td><span class="text-bold">Arditya Wahyuliantara</span><br> 089696873414 </td>
                      <td><span class="text-bold">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                      <!-- <td>
                        <button type="button" onclick="gOngkir(2)" style="font-size:12px;" class="btnPilih btn-success"  name="button" title="Hapus Alamat"><span class="fa fa-check"></span> Pilih</button>
                      </td> -->
                    </tr>
                    <tr>
                      <td>
                        <label class="containerR">
                          <input type="radio" name="radio">
                          <span class="checkmark"></span>
                        </label>
                      </td>
                      <td><span class="text-bold">Arditya Wahyuliantara</span><br> 089696873414 </td>
                      <td><span class="text-bold">Rumah</span><br>Jl.Turusan Kidul No 539 Rt02 Rw07 Turusan Sidorejo Salatiga</td>
                      <!-- <td>
                        <button type="button" onclick="gOngkir(3)" style="font-size:12px;" class="btnPilih btn-success"  name="button" title="Hapus Alamat"><span class="fa fa-check"></span> Pilih</button>
                      </td> -->
                    </tr>

                  </table>
                  <!-- mati -->
              </div>
              <div class="co-left bd-7" style="padding-top:55px">
                <div style="display:flex;justify-content:center">
                  <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -90px 0 0;" alt="">
                  <h4 style="color:white;position:absolute;margin:-58px 0 0">DAFTAR BUKU</h4>
                </div>
                  <!-- <div class="cmt-title text-center abs">
                      <h1 class="page-title v5">Order</h1>
                  </div> -->
                  <div class="row form-customer v2">

                      <table class="table " style="font-size:12px" >
                      <tr class="text-bold" style="border-bottom: 2px solid #e5e5e5">
                        <td>Judul</td>
                        <td>Berat</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                      </tr>
                      @foreach ($buku as $bk)
                      <tr>
                        <td><span class="text-bold">{{$bk->judul_buku}}</span></td>
                        <td><span class="text">{{$bk->berat}} gram</span></td>
                        <td><span class="text">{{$bk->harga}}</span></td>
                        <td><span class="text">{{$bk->jumlah}}</span></td>
                      </tr>
                      @endforeach
                     <tr style="border-top: 2px solid #e5e5e5">
                        <td><span class="text-bold">Total </span></td>
                        <td><span id="totalberat" class="text">{{$totalberat}} gram</span></td>
                        <td><span class="text">{{$totalharga}} </span></td>
                        <td><span id="totalbarang" class="text">{{$totalbarang}}</span></td>
                      </tr>

                    </table>
                  </div>
              </div>
            </div>
            <div class="col-md-4 pTotOrd">
              <div class="cart-total bd-7 mb-2">
                <div style="display:flex;justify-content:center">
                  <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -34px 0 0;" alt="">
                  <h4 style="color:white;position:absolute;margin:0">TOTAL ORDER</h4>
                </div>
                <div style="margin:55px 15px 0;">
                  <p class="co-title text-bold">Pilih Ekspedisi</p>
                  <table class="w-100 mt-1">
                    <tr>
                      <td>
                        <select onchange="cekManual(this)" id="cEkspds" style="float:left" class="form-control" name="">

                        </select>
                        <div id="spinEks" style='font-size:10px!important;display:none' class='loaderR'>Loading...</div>
                      </td>
                    </tr>
                    <tr id="kKirimManual" class="d-none">
                      <td>
                        <p class="text-bold mt-1">Kode Pengiriman</p>
                        <input type="text" class="form-control mt-1" placeholder="Masukkan kode.." name="" id="kodemanual" value="">
                      </td>
                    </tr>

                  </table>
                  <p class="co-title text-bold mt-1 text-danger" style="font-size:12px;" id ="textkurir">-</p>
                  <div >


                  </div>

                </div>
                <div class="table-responsive">
                    <div class="co-pd">
                        <p class="co-title">
                            <span>Total</span>
                        </p>
                        <!-- <ul class="co-pd-list">
                            <li class="clearfix">
                                <div class="co-name">
                                    Buku Satu x 1 <br>
                                    Buku Dua  x 1
                                </div>
                                <div class="co-price">
                                   Rp.120.000 <br>
                                   Rp.100.000
                                </div>
                            </li>
                        </ul> -->
                    </div>
                    <div style="padding: 0 42px;">
                      <table class="w-100">
                        <tr>
                          <td style="padding: 10px 0;">Subtotal</td>
                          <td class="text-right" id="totalharga">{{$totalhargarupiah}}</td>
                        </tr>
                        <tr>
                          <td style="padding: 10px 0;">Diskon ({{$newdisc}}%)</td>
                          <td class="text-right" id="totaldiskon">{{$totaldiskonrupiah}}</td>
                        </tr>
                        <!-- <tr>
                          <td style="padding: 10px 0;">Diskon Kode Unik</td>
                          <td class="text-right" id="totaldiskon">{{$discrandrupiah}}</td>
                        </tr> -->
                        <tr >
                          <td style="padding: 10px 0;">Pengiriman</td>
                          <td id='cEkspPrice' class="text-right">0</td>
                        </tr>
                        <tr class="text-bold mt-1 text-danger" >
                          <td style="padding: 15px 0;">Grand Total</td>
                          <td class="text-right" id="totalall">Rp. 0,00</td>
                        </tr>

                        <tr hidden class="text-bold mt-1 text-danger" >
                        <td class="text-right" id="totalhrg">{{$totalharga}}</td>
                        <td class="text-right" id="totaldisk">{{$totaldiskon}}</td>
                        <td class="text-right" id="discrand">{{$discrand}}</td>
                        </tr>
                      </table>
                    </div>

                </div>
                <div class="cart-total-bottom v2">
                    <a id='BtnOrder' href="#" onclick="addinv()" class="btn-gradient btn disabled" style="width:60%" >BUAT INVOICE</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function cSimpanAlamat(val){
        // console.log(val);
        if (val === true) {
          addalamatmanual()
        }else {
          isialamat()
        }
      }

      var btnorder =document.getElementById('BtnOrder').classList;
        var q1 = document.getElementById('conPengirim1');
        var q2 = document.getElementById('conPengirim2');
        var ongkir = 0;
        var subtotal= 0;
        var manualongkir = '';
        var valuemanual = '';
        var expedisitext ="";

      function pengirim(val){

        if (val == 1) {
          jQuery.ajax({
                  url: "{{ url('admin') }}",
                  method: 'get',
                  success: function(response){
                    console.log(response);
                    q2.value = response['no_telp'];
                    cekorder();
                  }
                });
          q1.disabled = true;
          q2.disabled = true;
          q1.value = 'Aqwam';

        }else {
          q1.disabled = false;
          q2.disabled = false;
          q1.value = '';
          q2.value = '';
          cekorder();
        }
      }

      q1.addEventListener("keyup", function(event) {
        cekorder();
      });
      q2.addEventListener("keyup", function(event) {
        cekorder();
      });

      $(document).ready(function () {

          // Attach Button click event listener
          $("#myButton").click(function(){
                  document.getElementById("alamatlain").innerHTML =
                "<tr>"+
                    "<td colspan='3' style='padding:30px 0px 40px' >"+
                        "<div style='font-size:15px!important;' class='loaderR'>Loading...</div>"+
                    "</td>"+
                  "</tr>";
                  // var x = (page -1 ) * 5;
                  // console.log(x)
                    $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                          }
                      });
                    jQuery.ajax({
                          url: "{{ url('/getalamat') }}",
                          method: 'post',
                          success: function(response){
                            var wish = ""
                            console.log(response);
                            variable = response;
                            if(variable!=null){
                              for (i in variable) {
                                wish += '<div class="conAlmt"><p hidden class="text-left text-bold" style="font-size:15px;">'+variable[i].kode_ro+'</p><p class="text-left text-bold" style="font-size:15px;">'+variable[i].nama+'</p><p class="text-left" style="font-size:12px;">'+variable[i].no_telp+'</span></p><p class="text-left" style="font-size:12px;">'+variable[i].alamat+'</span></p><p class="text-left" style="font-size:12px;">'+variable[i].kecamatan+'</span></p><div class="text-right my-1"><button onclick="addalamat(this)" data-id="'+variable[i].id+'" type="button" class="btnB btn-gradient" data-toggle="modal" data-target="#staticBackdropAlamat">Pilih Alamat</button></div></div>'
                              }
                            }else{
                              wish = '<tr class="item_cart">Data Kosong</tr>'
                            }
                            document.getElementById("alamatlain").innerHTML = wish;
                          }});
              // show Modal
              $('#staticBackdropAlamat').modal('show');
          });
      });

      function addalamat(idv){
             var id = $(idv).data("id");
            console.log(id)
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                   });
                   jQuery.ajax({
                            url: "{{ url('/getalamatutama') }}",
                            method: 'post',
                            data: {
                              id: id,
                            },
                            success: function(response){
                              var wish = ""
                              console.log(response);
                              document.getElementById("namaalamat").innerHTML = response.nama;
                              document.getElementById("noalamat").innerHTML = ' (' +response.no_telp+')';
                              document.getElementById("alamat").innerHTML = response.alamat;
                              document.getElementById("kecalamat").innerHTML = response.kecamatan;
                              document.getElementById("destination").innerHTML = response.kode_ro;
                                gEkspedisiPrice();
                                document.getElementById("cEkspPrice").innerHTML = '-';
                                document.getElementById("totalall").innerHTML = '-';
                                document.getElementById("textkurir").innerHTML = '-';
                                var kk =document.getElementById('kKirimManual').classList;
                                btnorder.add("disabled");
                                // cekorder();
                     }});
                     ongkir = 0;
                     subtotal= 0;
           }

           function isialamat(){
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
              setalamat(namamnl,hpmnl,alamatmnl,selectkota,kode_ro);
            }


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
                              }
                        }});

              }

           }


          window.onload = function () { gEkspedisiPrice(); pengirim(1);};



          function cekManual(val){


            var kk =document.getElementById('kKirimManual').classList;
            console.log(val.value);
            cek = val.value;

            textongkir = val.options[val.selectedIndex].text;
            // document.getElementById("textkurir").innerHTML = val;

            if (cek == 'manual') {
                ongkir = 0;
                subtotal= 0;
              if (kk.contains("d-none")) {
                kk.remove("d-none")
              }
              document.getElementById("cEkspPrice").innerHTML = '-';
              document.getElementById("totalall").innerHTML = '-';
              jQuery.ajax({
                    url: "{{ url('admin') }}",
                    method: 'get',
                    success: function(response){
                      console.log(response);
                      document.getElementById("textkurir").innerHTML = 'Mohon hubungi admin '+response['nama']+' ( '+response['no_telp']+' ). Untuk mendapatkan Kode Ongkir Kargo.';

                    }
                  });
                  cekorder();


            }else if (cek == 'pilih') {
                ongkir = 0;
                subtotal= 0;
                document.getElementById("cEkspPrice").innerHTML = '-';
                document.getElementById("totalall").innerHTML = '-';
                cekorder();
                kk.add("d-none");
                document.getElementById("textkurir").innerHTML = '-'
                manualongkir = 'false';
                valuemanual = '-';
            }else {
              document.getElementById("textkurir").innerHTML = '-'
              if (kk.contains("d-none") == 'false') {
              }else {
                kk.add("d-none")
                expedisitext = textongkir;
                var totalharga = document.getElementById("totalhrg").innerHTML;
                var totaldiskon = document.getElementById("totaldisk").innerHTML;
                // var discrandom = document.getElementById("discrand").innerHTML;
                document.getElementById("cEkspPrice").innerHTML = rupiah(val.value);
                console.log(totalharga);
                console.log(totaldiskon);
                console.log(expedisitext);
                // console.log(discrandom);
                ongkir = parseInt(val.value);
                // discrandInt = parseInt(discrandom);
                subtotal = totalharga-totaldiskon + ongkir;
                console.log(subtotal);
                document.getElementById("totalall").innerHTML = rupiah(subtotal);
                // kk.remove("d-none");
                // btnorder.remove("disabled");
                cekorder();
                manualongkir = 'false';
                valuemanual = '-';
              }

            }
          }

          function gEkspedisiPrice(){
            var eks = document.getElementById('cEkspds');
            var spn = document.getElementById('spinEks');

            eks.style.display = 'none';
            spn.style.display = 'block';

            console.log('teswt');
            var totalbarang = document.getElementById("totalbarang").innerHTML ;
            var totalberat = document.getElementById("totalberat").innerHTML ;
            var destination = document.getElementById("destination").innerHTML ;
            var azn = '';
            if(destination == 0){
               azn = '<option value="pilih"> --Pilih-- </option>';
               document.getElementById('cEkspds').innerHTML = azn;
            }else{
              console.log(azn);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('costrajaongkir') }}",
                    method: 'post',
                    data: {
                      destination: destination,
                      weight: totalberat,
                    },
                    success: function(response){
                      console.log(response);
                      azn += '<option value="pilih"> --Pilih-- </option>';
                      for (i in response) {
                        // console.log(response[i].id+"("+response[i].service +") - " + response[i].harga);
                          // azn += '<option value="Rp.20.000">TIKI - REG (Rp.20.000)</option>';
                              azn += '<option value="'+response[i].harga+'">'+response[i].id+" ("+response[i].service +") - " + response[i].harga+'</option>'
                           }
                      // console.log(azn);
                      azn += '<option value="manual"> input manual </option>';
                      document.getElementById('cEkspds').innerHTML = azn;
                      eks.style.display = 'block';
                      spn.style.display = 'none';
                    }
                  });
            }

            // console.log(totalberat);
            // console.log(destination);


          }

      var manualcek = document.getElementById("kodemanual");
        manualcek.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                  console.log(manualcek.value);
                  $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                  });
                  jQuery.ajax({
                      url: "{{ url('getongkirmanual') }}",
                      method: 'post',
                      data: {
                        kode: manualcek.value,
                      },
                      success: function(response){
                        console.log(response);
                        if(response != 'login'){
                          document.getElementById("textkurir").innerHTML = 'Kode benar, ekspedisi rekomendasi adalah '+response['expedisi']+' dan biaya '+response['total_harga'];
                          expedisitext = response['expedisi'];
                          ongkir = parseInt(response['total_harga']);
                          document.getElementById("cEkspPrice").innerHTML = rupiah(response['total_harga']);
                          var totalharga = document.getElementById("totalhrg").innerHTML;
                          var totaldiskon = document.getElementById("totaldisk").innerHTML;
                          // var discrandom = document.getElementById("discrand").innerHTML;
                          // discrandInt = parseInt(discrandom);
                          subtotal = totalharga-totaldiskon + ongkir;
                          document.getElementById("totalall").innerHTML = rupiah(subtotal);
                          cekorder();
                          manualongkir = 'true';
                          valuemanual = manualcek.value;
                        }
                        if(response == 'login'){
                          document.getElementById("textkurir").innerHTML = 'Kode tidak benar';
                        }

                        // document.getElementById('cEkspds').innerHTML = azn;
                      }
                    });
                }
          });

      function cekorder(){
        console.log(q1.value);
        console.log(q2.value);
        console.log(ongkir);
        console.log(subtotal);
        if(q1.value!=''&&q2.value!=''&&ongkir!=0&&subtotal!=0){
          btnorder.remove("disabled");
        }else{
          btnorder.add("disabled");
        }

      }

      function addinv(){
        var namatujuan = document.getElementById("namaalamat").innerHTML;
        var notujuan = document.getElementById("noalamat").innerHTML ;
        var alamattujuan = document.getElementById("alamat").innerHTML;
        var kectujuan = document.getElementById("kecalamat").innerHTML;
        var destination = document.getElementById("destination").innerHTML;
        var discrandom = document.getElementById("discrand").innerHTML;
        console.log(q1.value);
        console.log(q2.value);
        console.log(ongkir);
        console.log(subtotal);
        console.log(namatujuan);
        console.log(notujuan);
        console.log(alamattujuan);
        console.log(kectujuan);
        console.log(destination);

        Swal.fire({
          title: 'Transksi Anda',
          html: "<table class='w-100'>"+
                    "<tr>"+
                      "<td class='text-left' style='padding: 10px 0;'>Subtotal Belanja</td>"+
                      "<td class='text-right'>"+rupiah(subtotal)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td class='text-left' style='padding: 10px 0;'>Diskon Kode Unik</td>"+
                      "<td class='text-right'>"+rupiah(discrandom)+"</td>"+
                    "</tr>"+
                    "<tr class='text-bold mt-1 text-danger'>"+
                      "<td class='text-left' style='padding: 10px 0;'>Total Bayar Sekarang</td>"+
                      "<td class='text-right'>"+rupiah(subtotal-discrandom)+"</td>"+
                    "</tr>"+
                "</table>",
          confirmButtonColor: '#d33',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Lanjut Order'
        }).then((result) => {
          if (result.isConfirmed) {
           $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                  });
                  jQuery.ajax({
                      url: "{{ url('addinv') }}",
                      method: 'post',
                      data: {
                        keyro: destination,
                        expedisi: expedisitext,
                        biaya_expedisi: ongkir,
                        nama_pengirim: q1.value,
                        telephone_pengirim: q2.value,
                        nama_penerima: namatujuan,
                        telephone_penerima: notujuan,
                        alamat: alamattujuan,
                        kecamatan: kectujuan,
                        mnongkir: manualongkir,
                        valmanual: valuemanual
                      },
                      success: function(response){
                        if (response == 'sukses'){

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'success',

                                            title: 'Sukses Membuat Invoice, Cek di akun (invoice) untuk melakukan pembayaran.',

                                            showConfirmButton: false,

                                            timer: 3500,
                                            onClose: () => {
                                                   window.location.href = "{{URL::to('akun')}}";
                                                  }
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

                                                })

                                        .then((result) => {

                                                    if (result.isConfirmed) {

                                                        console.log('login');

                                                        window.location.href = "{{URL::to('login/')}}";

                                                    }

                                                });

                                }
                                else if(response == 'session'){

                                    Swal.fire({

                                                title: 'Session Anda Habis. Perbarui Keranjang anda',

                                                icon: 'info',

                                                showConfirmButton: false,

                                                timer: 2500,
                                                onClose: () => {
                                                   window.location.href = "{{URL::to('/')}}";
                                                  }
                                            });

                                }
                                else{

                                    console.log(response);

                                    Swal.fire({

                                            position: 'bottom-end',

                                            icon: 'info',

                                            title: 'Cek Data Pengirim, Penerima & Ekspedisi. Pastikan Terisi',

                                            showConfirmButton: false,

                                            timer: 2000

                                            });

                                }

                      }
                  });

          }
        })





      }

      function rupiah(bil){
            var 	bilangan = bil;

            var	reverse = bilangan.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');

            var idr = 'Rp. '+ribuan+',00';

              return idr;
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

    </script>

@endsection
