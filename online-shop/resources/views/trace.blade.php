@extends('main.mainOther')
@section('title', 'Aqwam')
@section('body')
<div class="container container-240 text-center my-4">
  <h2>Lacak Pesanan Anda</h2>
    <div class="mt-2" style="display:flex;justify-content:center">
      <input type="text" style="border:2px solid lightgrey; border-radius:5px; padding: 10px 15px; font-size: 15px;text-transform: uppercase; width:100%; max-width:500px;" placeholder="Masukkan No Order ..." id="noOrd" name="noOrd">
      <button type="button" onclick="clcked(noOrd.value)" class="btn btn-primary ml-1" name="button">LACAK</button>
    </div>
    <!-- <table id='detail' class="table mt-2">
        <tbody>
            <tr>
            <td>No Order</td>
            <td id='noOrder'>ORD-20L29-160247YG</td>
            </tr>
            <tr>
            <td>Jasa Kirim</td>
            <td id='jasaKirim'>WAHANA</td>
            </tr>
            <tr>
            <td>Pengirim</td>
            <td id='pengirim'>Aqwam</td>
            </tr>
            <tr>
            <td>Tujuan</td>
            <td id='penerima'>Tejo <br> Jl Anggrek No 22, Jakarta</td>
            </tr>
            <tr>
            <td>Tanggal Kirim</td>
            <td id='tanggal'>2020-12-31</td>
            </tr>
            <tr>
            <td>Status</td>
            <td id='status'>On Process</td>
            </tr>

        </tbody>
    </table>
    <table id='manifest' class="table mt-2">
        <tbody>
            <tr class='text-bold'>
            <td >Date</td>
            <td>Position</td>
            <td>Description</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
            <td>2020-12-31 16:35:31</td>
            <td>SOLO</td>
            <td>Di pickup oleh petugas</td>
            </tr>

            <tr>
            <td>2020-12-31 19:30:31</td>
            <td>Nganjuk</td>
            <td>Diterima di fasilitas WAHANA</td>
            </tr>

            <tr>
            <td>2021-01-01 14:30:31</td>
            <td>Jombang</td>
            <td>Diterima di fasilitas WAHANA</td>
            </tr>

        </tbody>
    </table> -->
    <center>
      <div class="traceBox mt-4" >
        <div class="p-2">
          MASUKKAN NOMOR ORDER
        </div>
        <!-- <div onclick="slideUp()" class="traceUpperBox">
          ORD-20I01-053951YG
          <span class="fa fa-angle-up"></span>
        </div>
        <div class="traceLowerBox" style="display:none">
          <table class="table" style="background:#ffffff75;font-size:15px;">
            <tr>
              <th colspan="2" style="text-align:center">DETAIL</th>
            </tr>
            <tr>
              <td>No Order</td>
              <td>12345</td>
            </tr>
            <tr>
              <td>Kurir</td>
              <td>JNE - Yakin Esok Sampai</td>
            </tr>
            <tr>
              <td>Pengirim</td>
              <td>Aqwam</td>
            </tr>
            <tr>
              <td>Asal</td>
              <td>Salatiga</td>
            </tr>
            <tr>
              <td>Penerima</td>
              <td>Ardi</td>
            </tr>
            <tr>
              <td>Tujuan</td>
              <td>Salatiga</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>SAMPAI</td>
            </tr>
          </table>
          <table class="table"style="background:#ffffff75;">
            <tr>
              <td colspan="2">tanggal</td>
            </tr>
            <tr>
              <td>tanggal</td>
              <td>
                <div class="detTrace">
                  <p>jam</p>
                  <p>detail</p>
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <div class="detTrace">
                  <p>jam</p>
                  <p>detail yang sangat angat panjang menjadikan dia dua baris</p>
                </div>
              </td>
            </tr>
          </table>
        </div> -->
      </div>
    </center>
</div>


<script>
    var r = 0;
    function slideUp() {
        $(".traceLowerBox").slideToggle();
         if (r == 0) {
           r = 180;
         }else {
           r = 0
         }

        document.querySelector(".fa-angle-up").style['transform'] = "rotate("+r+"deg)";

        // $("fa-angle-up").css({
        //     "-webkit-transform": "rotate(180deg)",
        //     "-moz-transform": "rotate(180deg)",
        //     "transform": "rotate(180deg)"
        // });
    }

    var input = document.getElementById("noOrd");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            console.log(input.value);
            getcekresi(input.value);
        }
    });

    function clcked(val) {
      getcekresi(val)
    }

    function getcekresi(noOrd){
      if (noOrd == "") {
        noOrd = '-'
      }
      var data = ''
      var y = ''
      document.querySelector(".traceBox").innerHTML = "<div style='font-size:10px!important;margin:-5px auto!important' class='loader'>Loading...</div><div class='pb-3 pt-s'></div>";
        $.ajaxSetup({
              headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
              }
              }),
              jQuery.ajax({
                  url: "{{ url('/traceOrder') }}",
                  method: "post",
                  data: {
                    noOrd: noOrd,
                  },
                  success: function(response) {
                    if(response=='gagal'){
                      document.querySelector(".traceBox").innerHTML = '<div class="traceUpperBox">Data Tidak Ditemukan</div>';
                    }
                    else{
                      data += '<div onclick="slideUp()" class="traceUpperBox">'+noOrd+'<span class="fa fa-angle-up"></span></div>'+'<div class="traceLowerBox" style="display:none"> <table class="table" style="background:#ffffff75;font-size:14px;text-transform: uppercase;"> <tr> <th colspan="2" style="text-align:center;font-size:16px">DETAIL</th></tr> <tr><th>No Order</th><td>'+noOrd+'</td></tr><tr> <th>Kurir</th> <td>'+response.summary.courier_name+'</td></tr><tr><th>Layanan</th><td>'+response.summary.service_code+'</td></tr><tr><th>Pengirim</th><td>'+response.summary.shipper_name+'</td></tr><tr><th>Asal</th><td>'+response.summary.origin+'</td></tr><tr><th>Penerima</th><td>'+response.summary.receiver_name+'</td></tr><tr><th>Tujuan</th><td>'+response.summary.destination+'</td></tr><tr><th>Status</th><td>'+response.summary.status+'</td></tr></table>'+
                      '<table class="table"style="background:#ffffff75;">';

                      console.log(response);
                      console.log(response.summary);
                      console.log(response.manifest);




                      for (var i = 0; i < response.manifest.length; i++) {
                        if (y != response.manifest[i].manifest_date) {
                          data +='<tr class="hidden-md hidden-lg"><td colspan="2" class="detTraceDate"><i class="fa fa-calendar"></i> '+response.manifest[i].manifest_date+'</td></tr>'
                          data += '<tr><td class="hidden-sm hidden-xs detTraceDate"><i class="fa fa-calendar"></i> '+response.manifest[i].manifest_date+'</td><td><div class="detTrace"><p><i class="fa fa-clock-o"></i> '+response.manifest[i].manifest_time+'</p><p><i class="fa fa-pencil-square-o"></i> '+response.manifest[i].manifest_description+'</p></div></td></tr>'
                        }else {
                          data += '<tr><td class="hidden-sm hidden-xs detTraceDate"></td><td><div class="detTrace"><p><i class="fa fa-clock-o"></i> '+response.manifest[i].manifest_time+'</p><p><i class="fa fa-pencil-square-o"></i> '+response.manifest[i].manifest_description+'</p></div></td></tr>'

                        }
                        y = response.manifest[i].manifest_date;
                      }

                      data += '</table></div>'

                      document.querySelector(".traceBox").innerHTML = data;
                    }
                  }
              })
    }
</script>
@endsection
