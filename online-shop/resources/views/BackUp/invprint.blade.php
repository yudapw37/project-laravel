@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')

      <div class="text-center" style="">
        <h1 id="cap1" class="h1"> INVOICE {{$inv->idOrder}}</h1>
        <div id="cap2" class="container mb-5" style="width:100%">
          <a class="btn btn-danger float-right mx-2" href="/akun">Kembali</a>
          <input type="button" class="btn btn-success float-right mx-2" onclick="printDiv('capture')" value="Cetak Invoice PDF" />
          <button id="download" class="btn btn-success float-right mx-2">Cetak Invoice PNG</button>
        </div>
      </div>
      <div class="container-fluid p-2 mt-5" style="overflow:auto">
        <center>
          <div style="width:100%;" id="canvas" />
        </center>
      </div>

      <div style="overflow:auto">
        <div id="capture" style="width:1000px;transform: scale(0.85);padding:1.5em">
          <div style="border: 1px solid #ff8b8bb8; border-radius: 10px;">
          <table class="table table-sm-responsive table-borderless mb-1">
            <tbody>
              <tr>
                <!-- nama store -->
                <td rowspan="3" class="w-75">
                  <!-- <p class="h1 text-bold text-danger">AQWAM</p><p class="h4">JEMBATAN ILMU</p> -->
                  <img src="../img/aqwam.png" class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 mr-auto" style="width:230px;height:auto">
                </td>
                <!-- Tanggal -->
                <td>
                  <p style="margin:1px 0px;"><b>Tanggal</b></p>
                  <p style="margin-bottom: 1px;">{{$inv->created_at}}</p>
                </td>
              </tr>
              <tr>
                <!-- No Invoice -->
                <td>
                  <p style="margin:1px 0px;"><b>Nomor Invoice</b></p>
                  <p style="margin-bottom: 1px;" id='codeinv'>{{$inv->idOrder}}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <!-- nama admin -->
                  <p style="margin:1px 0px;"><b>Nama Admin</b></p>
                  <p style="margin-bottom: 1px;">{{$namaadmin}}</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p style="margin-bottom: 1px;">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
                  <!-- nama pembeli -->
                  <p style="margin-bottom: 1px;"><b>Kepada {{$nama}}</b></p>
                  <!-- Terimakasih -->
                  <p style="margin-bottom: 1px;">Terimakasih sudah berbelanja di AQWAM STORE, Berikut rincian dari orderan anda :</p>
                </td>
                <!-- keterangan bayar -->
                <td>
                  <h5 class="text-danger">BELUM DIBAYAR</h5>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="table table-sm-responsive table-borderless mt-1">
            <!-- <tbody> -->
              <tr class="bg-dark text-light" style="    background: #ed3237;    color: white;">
                <td class="text-bold">Nama Produk</td>
                <td class="text-bold text-center">Jumlah</td>
                <td class="text-bold text-center">Berat</td>
                <td class="text-bold text-center">Harga</td>
                <td class="text-bold text-center">Diskon</td>
                <td class="text-bold text-center">SubTotal</td>
              </tr>
            <tbody id="detailord">

            </tbody>

             <tr class="border-top">
               <td class="text-bold" colspan="2">Jumlah</td>
               <td class="text-center"> </td>
               <td class="text-right"></td>
               <td class="text-right"></td>
               <td class="text-right">Rp. {{number_format($inv->total_harga, 2,',','.')}}</td>
             </tr>
            <!-- ekspedisi -->
            <tr>
              <td class="text-bold" colspan="5">Kurir - {{$inv->expedisi}}</td>
              <td class="text-right">Rp. {{number_format($inv->biaya_expedisi, 2,',','.')}}</td>
            </tr>
            <tr>
              <td class="text-bold" colspan="5">Diskon</td>
              <td class="text-right">Rp. {{number_format($inv->totalDiskon, 2,',','.')}}</td>
            </tr>
            <tr>
              <td class="text-bold">TOTAL</td>
              <td class="text-bold"></td>
              <td class="text-bold"></td>
              <td class="text-bold"></td>
              <td class="text-bold"></td>
                          <td class="text-bold text-right">Rp. {{number_format($inv->total_harga + $inv->biaya_expedisi - $inv->totalDiskon, 2,',','.')}}</td>
            </tr>
          </tbody></table>
          <hr class="border-top m-2">
          <table class="table table-sm-responsive table-borderless">
            <tbody><tr>
              <td class="text-bold" style="width:425px">Rekening Pembayaran
              <p>  </p>
                <p> - BCA 3930577421 an Firman Pramudya </p>
                <p> - BNI 0680545631 an Firman Pramudya </p>
                <p> - Mandiri 900.00.4033595.3 an Firman Pramudya </p>
                <p> - BRI 1440.01.001753.50.6 an Firman Pramudya </p>
                <p> Semoga Allah Memberi Keberkahan</p>
                <p style="border: 2px solid red;text-align: justify; margin: 1em 2em 1em 0.5em ; padding:1em; border-radius:10px;" class="h5"><span class="text-bold">NOTE :</span> Untuk mendukung kecepatan dan ketepatan pengiriman order, harap transfer <span class="text-bold">sesuai dengan nominal invoice</span>, melalui <span class="text-bold">satu rekening bank</span> yang dipilih.</p>
              </td>
            <!-- </tr>
            <tr> -->
              <td class="text-bold" style="width:200px">Detail Pengiriman</td>
              <td>
                <p class="text-bold">#Pengirim</p>
                <p>{{$inv->nama_pengirim}} ({{$inv->telephone_pengirim}})</p>
                <p class="text-bold">#Tujuan </p>
                <p>{{$inv->nama_penerima}} ({{$inv->telephone_penerima}})</p>
                <p>{{$inv->alamat}}</p>
                <p>Kec. {{$inv->kecamatan}}, Kab. {{$inv->kab_kota}}, Prov. {{$inv->propinsi}}</p>
              </td>

            </tr>
          </tbody></table>
        </div>
        </div>
      </div>
<script src="{{asset('/js/html2canvas.js')}}"></script>
<script>

    document.getElementById("download").addEventListener("click", function() {
      document.getElementById("capture").className="";
      document.getElementById("canvas").className="d-none";

        html2canvas(document.querySelector('#capture'),{useCORS: true,allowTaint: true,}).then(function(canvas) {
            saveAs(canvas.toDataURL(), 'file-name.png');
        });
        document.getElementById("capture").className="d-none";
        document.getElementById("canvas").className="";
    });
    window.onbeforeunload = function () {
      console.log('jalan');
      window.scrollTo(0, 0);
    }

    function saveAs(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download === 'string') {
            link.href = uri;
            link.download = filename;
            //Firefox requires the link to be in the body
            document.body.appendChild(link);
            //simulate click
            link.click();
            //remove the link when done
            document.body.removeChild(link);
        } else {
            window.open(uri);
        }
    }

    function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       document.body.innerHTML = printContents;
       window.print();
       location.reload();
     }

    // var fieldId = $('#field').data("field-id");

    // console.log(fieldId);

    codeInvoice = '';

    window.onload = function () { codeInvoice=document.getElementById("codeinv").innerHTML; getdetail(codeInvoice);};

    console.log(codeInvoice);
    function getdetail(codeInvoice){
            // console.log(varidord);
            var id =codeInvoice;
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('/invdetail') }}",
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
                           orddetail +='<tr><td>'+nama+'</td><td class="text-center">'+variable.a[i].jumlah+'</td><td class="text-center">'+variable.a[i].berat+'</td><td class="text-center">'+variable.a[i].harga+'</td><td class="text-center">'+variable.a[i].diskon+'</td><td class="text-right"> '+ rupiah(variable.a[i].total)+'</td></tr>';
                         }

                      }else{
                        orddetail = '<tr class="item_cart">Data Kosong</tr>';
                      }
                      document.getElementById("detailord").innerHTML = orddetail;
                      html2canvas(document.querySelector("#capture")).then(canvas => {
                        document.getElementById('canvas').appendChild(canvas)
                        document.getElementById("capture").className="d-none";
                      });
                    }});
    }

    function rupiah(bil){
            var 	bilangan = bil;

            var	reverse = bilangan.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');

            var idr = 'Rp. '+ribuan+',00';

              return idr;
          }
</script>

@endsection
