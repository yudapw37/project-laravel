@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')
    <div class="container container-240 mt-4">
    <!-- <div id="idinv" hidden>{{$id}}<div> -->
      <h3 class="text-center">Verifikasi Pembayaran - <span style="white-space: nowrap;" id="idinv">{{$id}}</span></h3>
      <center>
        <div style="max-width:800px;margin-top:5px;">
            <a href="/akun" style="float:right" class="btn btn-danger">Kembali</a>
        </div>
      </center>
      <center>
      <form action="/bayar" method="post" enctype="multipart/form-data">
      @csrf
        <div class="conUpload">
        <input type="text" id="idinv" hidden name="idinv" value="{{$id}}">
          <div class="row text-left">
            <div class="col-sm-6 col-md-6 col-xs-12" style="margin-bottom:1em">
              <p class="text-bold">Jumlah Yang harus Dibayarkan :</p>
              <span style="white-space: nowrap;padding-left:5px;">{{$hasil_rupiah}}</span>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12" style="margin-bottom:1em">
              <p class="text-bold">Pilih Bank :</p>
              <select name="bank" id="bank" class="form-control" required >
                <option value="" selected disabled>--PILIH---</option>
                <option value="Mandiri">Mandiri</option>
                <option value="Bca">BCA</option>
                <option value="Bri">BRI</option>
                <option value="Bni">BNI</option>
              </select>
            </div>
          </div>
          <center>
            <div class="file-drop-area">
              <br>
              <br>
              <br>
              <img id="blah" style="display:none" src="#" class="" alt="your image" />
              <p class="fake-btn">Pilih atau tarik dan letakkan files disini</p>
              <p class="file-msg"> - </p>
              <!-- <input id="file" value="file"  name="file" type="file"> -->
              <input type='file' name="file" class="file-input" id="imgInp" />
            </div>
          </center>
          <input class=" mt-1 btn btn-success w-100" type="submit" name="SIMPAN" value="SIMPAN">
        </div>
        </form>
      </center>
    </div>

  <!-- <div class="container container-240">
    <center>
      <div class="conUpload" style="">
        <input type="text" name=""  class="form-control" style="pointer-events:none" value="">
        <div>
          <div id="ddClick" onclick="dosometing(this.value)" value="1" style="width:100%;height:35px;margin-top:-35px;"></div>
          <div id="conOutterDD" class="w-100" style="position: relative;">
            <div id="ddCon" class="d-none conCDD" style="">
              <input type="text" class="form-control" name="" value="">
              <div onclick="fillCOmbo(value1)" class="">value1</div>
              <div onclick="fillCOmbo(value2)" class="">value2</div>
              <div onclick="fillCOmbo(value3)" class="">value3</div>
              <div onclick="fillCOmbo(value4)" class="">value4</div>
              <div onclick="fillCOmbo(value5)" class="">value5</div>
              <div onclick="fillCOmbo(value6)" class="">value6</div>
              <div onclick="fillCOmbo(value7)" class="">value7</div>
              <div onclick="fillCOmbo(value8)" class="">value8</div>
              <div onclick="fillCOmbo(value9)" class="">value9</div>
              <div onclick="fillCOmbo(value10)" class="">value10</div>

            </div>

          </div>

        </div>
      </div>
    </center>
  </div> -->

    <script type="text/javascript">

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
          $('#blah').slideToggle();
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });

    // <form runat="server">
    //   <input type='file' id="imgInp" />
    //   <img id="blah" src="#" alt="your image" />
    // </form>


      // window.onload = function () { document.getElementById('ddClick').value = "1";};

      // document.getElementById("conOutterDD").addEventListener("mouseout", cOffFocus);





      // function simpan(){
      //   var e = document.getElementById("bank");
      //   var pilihbank = e.value;

      //   var c = document.getElementById("idinv");
      //   var idInv = c.innerHTML;

      //   var b = document.getElementById("file");
      //   var file = b.value;
      //   var b1 = document.getElementById("file1");
      //   var file1 = b1.value;

      //   console.log(idInv);
      //   console.log(pilihbank);
      //   console.log(file);


      //           $.ajaxSetup({
      //             headers: {
      //               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
      //               'enctype':'multipart/form-data'
      //               }
      //             });
      //           jQuery.ajax({
      //               url: "{{ url('/bayar') }}",
      //                 method: 'post',
      //                 enctype:'multipart/form-data',
      //                 encoding:'multipart/form-data',
      //                 data: {
      //                     idinv: idInv,
      //                     file: file,
      //                     file1:file1,
      //                     bank: pilihbank
      //                 },
      //                 success: function(response){
      //                      console.log(response);
      //                   if(respon=='gagal'){}
      //                   else if(respon=='login'){}
      //                   else{}
      //                 }
      //              });
      // }


      // function cOffFocus(){
      //   console.log(121);
      // }
      // function dosometing(val){
      //   var dCon = document.getElementById('ddCon')
      //   var dClck = document.getElementById('ddClick')
      //   if (val == 1) {
      //     dCon.classList.remove('d-none');
      //     dClck.value = "2";
      //   }else {
      //     dCon.classList.add('d-none');
      //     dClck.value = "1";
      //   }
      // }

      var $fileInput = $('.file-input');
      var $droparea = $('.file-drop-area');

      // highlight drag area
      $fileInput.on('dragenter focus click', function() {
      $droparea.addClass('is-active');
      });

      // back to normal state
      $fileInput.on('dragleave blur drop', function() {
      $droparea.removeClass('is-active');
      });

      // change inner text
      $fileInput.on('change', function() {
      var filesCount = $(this)[0].files.length;
      var $textContainer = $(this).prev();

      if (filesCount === 1) {
      // if single file is selected, show file name
      var fileName = $(this).val().split('\\').pop();
      $textContainer.text(fileName);
      } else {
      // otherwise show number of files
      $textContainer.text(filesCount + ' file yang akan diunggah');
      }
      });
    </script>


@endsection
