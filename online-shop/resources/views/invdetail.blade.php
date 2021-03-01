@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')


        <div class="container container-240 shop-collection catleft cAtas">
          <div id="capture" class="d-none" style="width:1000px;transform: scale(0.85);">
          <div class="border rounded">
          <table class="table table-sm-responsive table-borderless mb-1">
            <tbody><tr>
              <!-- nama store -->
              <td rowspan="3" class="w-75">
                <!-- <p class="h1 font-weight-bold text-danger">AQWAM</p><p class="h4">JEMBATAN ILMU</p> -->
                <img src="../include/img/aqwamhitam.png" class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 mr-auto" style="width:230px">
              </td>
              <!-- Tanggal -->
              <td>
                <p style="margin:1px 0px;"><b>Tanggal</b></p>
                <p style="margin-bottom: 1px;">2020-10-12 13:32:26</p>
              </td>
            </tr>
            <tr>
              <!-- No Invoice -->
              <td>
                <p style="margin:1px 0px;"><b>Nomor Invoice</b></p>
                <p style="margin-bottom: 1px;">ORD-20J12-122802YG</p>
              </td>
            </tr>
            <tr>
              <td>
                <!-- nama admin -->
                <p style="margin:1px 0px;"><b>Nama Admin</b></p>
                <p style="margin-bottom: 1px;">YOGI</p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="margin-bottom: 1px;">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
                <!-- nama pembeli -->
                <p style="margin-bottom: 1px;"><b>Kepada Hani wahyu nugroho</b></p>
                <!-- Terimakasih -->
                <p style="margin-bottom: 1px;">Terimakasih sudah berbelanja di AQWAM STORE, Berikut rincian dari orderan anda :</p>
              </td>
              <!-- keterangan bayar -->
              <td><h5 class="text-danger">BELUM DIBAYAR</h5></td>
            </tr>
          </tbody></table>
          <table class="table table-sm-responsive table-borderless mt-1">
            <tbody><tr class="bg-dark text-light">
              <td class="font-weight-bold">Nama Produk</td>
              <td class="font-weight-bold text-center">Jumlah</td>
              <td class="font-weight-bold text-center">Berat</td>
              <td class="font-weight-bold text-center">Harga</td>
              <td class="font-weight-bold text-center">Diskon</td>
              <td class="font-weight-bold text-center">SubTotal</td>
            </tr>
            <!-- daftar buku -->
            <!-- <tr >
              <td>100 Doa Mustajab Bersejarah</td>
              <td class="text-center">1</td>
              <td class="text-center">1kg</td>
              <td class="text-right">Rp 65.000</td>
              <td class="text-right">Rp 65.000</td>
            </tr>
            <tr>
              <td>Fikih Empat Mazhab Jilid II</td>
              <td class="text-center">1</td>
              <td class="text-center">1kg</td>
              <td class="text-right">Rp 179.000</td>
              <td class="text-right">Rp 179.000</td>
            </tr> -->
            <tr><td style="padding-bottom: 0px!important;">Promo Oktober Sirah Nabawiyah</td><td style="padding-bottom: 0px!important;" class="text-center">2</td><td style="padding-bottom: 0px!important;" class="text-center">1.5 Kg</td><td style="padding-bottom: 0px!important;" class="text-center">160000</td><td style="padding-bottom: 0px!important;" class="text-center">45</td><td style="padding-bottom: 5px!important;" class="text-right"> Rp 320.000,00</td></tr><tr><td style="padding:0px!important;" colspan="6"> &nbsp;&nbsp;&nbsp;  - Sirah Nabawiyah New</td></tr>           <!-- jumlah -->
             <tr class="border-top">
               <td class="font-weight-bold" colspan="2">Jumlah</td>
               <td class="text-center"> </td>
               <td class="text-right"></td>
               <td class="text-right"></td>
               <td class="text-right">320.000,00</td>
             </tr>
            <!-- ekspedisi -->
            <tr>
              <td class="font-weight-bold" colspan="5">Kurir - Diambil</td>
              <td class="text-right">0,00</td>
            </tr>
            <tr>
              <td class="font-weight-bold" colspan="5">Diskon</td>
              <td class="text-right">144.000,00</td>
            </tr>
            <tr>
              <td class="font-weight-bold">TOTAL</td>
              <td class="font-weight-bold"></td>
              <td class="font-weight-bold"></td>
              <td class="font-weight-bold"></td>
              <td class="font-weight-bold"></td>
                          <td class="font-weight-bold text-right">Rp. 176.000,00</td>
            </tr>
          </tbody></table>
          <hr class="border-top m-2">
          <table class="table table-sm-responsive table-borderless">
            <tbody><tr>
              <td class="font-weight-bold" style="width:425px">Rekening Pembayaran
              <p>  </p>
                <p> - BCA 3930577421 an Firman Pramudya </p>
                <p> - BNI 0680545631 an Firman Pramudya </p>
                <p> - Mandiri 900.00.4033595.3 an Firman Pramudya </p>
                <p> - BRI 1440.01.001753.50.6 an Firman Pramudya </p>
                <p> Semoga Allah Memberi Keberkahan</p>
                <p style="border: 2px solid red;text-align: justify;" class="h5 rounded m-2 p-2"><span class="font-weight-bolder">NOTE :</span> Untuk mendukung kecepatan dan ketepatan pengiriman order, harap transfer <span class="font-weight-bolder">sesuai dengan nominal invoice</span>, melalui <span class="font-weight-bolder">satu rekening bank</span> yang dipilih.</p>
              </td>
            <!-- </tr>
            <tr> -->
              <td class="font-weight-bold" style="width:200px">Detail Pengiriman</td>
              <td>
                <p class="font-weight-bold">#Pengirim</p>
                <p>Aqwam (08112639000)</p>
                <p class="font-weight-bold">#Tujuan </p>
                <p>Hani wahyu nugroho (0821 3335 4747)</p>
                <p>diambil gudang</p>
                <p>Kec. Kartasura, Kabupaten Sukoharjo</p>
              </td>

            </tr>
          </tbody></table>
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

          $('#modalOrder').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('id') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('Invoice No :' + recipient)
          })
          $('#modalInvoice').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('id') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('Invoice No : ' + recipient)
          })

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

          function midBox(par){
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
              document.getElementById("Alamat").className = "d-none";
              document.getElementById("dataDiri").className = "d-none";
              document.getElementById("wishList").className = "d-none";
              document.getElementById("Invoice").className = "d-none";
              getcountorder();
              if(dataorder = cekcountorder){console.log(dataorder);}
              else{getorder(1); dataorder = cekcountorder;
                document.getElementById("pageorder").innerHTML = 1;prevorder.classList.add('disabled2');}
            }else if (par == "Invoice") {
              document.getElementById("Invoice").className = "";
              document.getElementById("Order").className = "d-none";
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
              document.getElementById("Order").className = "d-none";
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
                          invoice += '<tr><td><span class="text-bold f-15">'+date(variable[i].created_at)+'</span></td><td><span class="text-bold f-15">'+variable[i].idOrder+'</span></td><td><span class="text-bold f-15">'+variable[i].nama_penerima+'</span></td><td><span class="text-bold f-15">'+rupiah(netto(variable[i].total_harga, variable[i].biaya_expedisi, variable[i].totalDiskon))+'</span></td><td> <button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalInvoice" data-id="1122334455"><span class="text-bold">Detail</span></button></td></tr>'
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
            console.log(id)
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
                      console.log(response);
                      variable = response;
                      if(variable!=null){
                        for (i in variable) {
                          wish += '<tr class="item_cart"> <td class="product-name flex align-center"> <a href="#" onclick="deletewishlist(this)" data-id="'+variable[i].idBuku+'" class="btn-del"><i class="ion-ios-close-empty text-danger text-bold"></i></a> <div class="product-img pProd"> <img src="img/product/sound2.jpg" alt="Futurelife"> </div> <div class="product-info tProd"> <a href="/detail/'+variable[i].idBuku+'" title="">'+variable[i].judul_buku+'</a> </div> </td> <td class="total-price"> <p class="price">'+rupiah(variable[i].harga)+'</p> </td> <td class="w-button"> <a class="btn-addcart btn-gradient" onclick="addcart(this)" data-id="'+variable[i].idBuku+'"  href="#">Add to cart</a> </td> </tr>'
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
                      var order = ""
                      console.log(response);
                      variable = response;
                      // if(variable!=null){
                      //   for (i in variable) {
                      //     order += '<tr><td><span class="text-bold f-15">'+variable[i].code_order+'</span><br>('+date(variable[i].created_at)+')</td><td><span class="text-bold f-15">'+getstatusord(variable[i].code_status)+'('+variable[i].code_status+')</td> <td class="text-center"><span class="text-bold f-15">'+date(variable[i].updated_at)+'</td><td><button onclick="getorddetail(this)" type="button" style="font-size:12px;"class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="'+variable[i].code_order+'"><span class="text-bold">Detail</span></button> </td></tr>'
                      //   }
                      // }else{
                      //   order = '<tr class="item_cart">Data Kosong</tr>'
                      // }
                      // document.getElementById("tableorder").innerHTML = order;
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
                          orderhistory += '<tr><td style="min-width:230px!important"><span class="text-bold f-15">'+variable[i].idOrder+'</span><br>'+date(variable[i].created_at)+'</td><td style="min-width:285px;"><span class="text-bold f-15">Rumah  ( '+variable[i].nama_penerima+' )</span><br>'+variable[i].alamat+'</td><td class="text-center"><span class="text-bold text-center f-15">'+rupiah(netto(variable[i].total_harga, variable[i].biayaExpedisi, variable[i].totalDiskon))+'</span></td><td><button type="button" style="font-size:12px;" class="btnSdg btn-info" name="button" title="Lihat Detail" data-toggle="modal" data-target="#modalOrder" data-id="1"><span class="text-bold">Detail</span></button></td></tr>'
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
              return  'Selesai & Menunggu Kurir'
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

        </script>

@endsection
