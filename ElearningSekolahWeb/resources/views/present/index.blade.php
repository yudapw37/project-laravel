@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
    <!-- <div class="container-fluid px-md-5">
        <div class="row">
            <div class="col-10">
                <h3 class="display-5" style="margin-top:70px !important;">Aktifitas Siswa</h3>
                <hr style="border-top: 3px solid grey !important;" />
            </div>    
        </div>
        <div class="row">
            <form class="form-inline mb-3" action="/aktifitas/search" method="get">
                <div class="form-group m-2">
                    <input name="namaSiswa" type="text" class="form-control " style="min-width:75px;" placeholder="Masukkan Nama Siswa.." id="namaSiswa" >
                </div>
                <div class="form-group m-2">
                <button type="submit" class="btn btn-success float-left" style="width:90px;margin: 2px 1px 1px 2px;border: 1px solid #D1D1D1" name="insert_test" value="" >Cari</button>
                </div>
            </form>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif -->
    <div class="container mt-5 pt-4">
        <h2 class="font-weight-bold cLeft">
        Aktifitas Siswa
        </h2>
        <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
        <form class="" action="/aktifitas/search" method="get">
          <table>
            <tr>
              <td class="w-100">
                <input type="text" class="form-control" name="namaSiswa" placeholder="Masukkan Nama Siswa.."  id="namaSiswa" value="">
              </td>
              <td>
                <input style="width:80px!important" type="submit" class="btn btn-primary" name="cari" value="cari">
              </td>
              
            </tr>

          </table>
        </form>
        <div style="overflow:auto">
          <table class="table">
            <thead class="lgn">
              <tr>
                <th style="width:5%">#</th>
                <th style="width:15%" class="font-top">Nama Siswa</th>
                <th style="width:10%" class="font-top">MaPel</th>
                <th style="width:10%" class="font-top">Nama Tugas</th>
                <th tyle="width:15%">File Tugas</th>
                <th tyle="width:15%">Tgl Kirim</th>
                <th tyle="width:15%">Nilai</th>
                <th style="width:5%"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($present as $pre)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pre->username}}</td>
                        <td>{{$pre->mapel}}</td>
                        <td>{{$pre->namaTugas}}</td>
                        <td><a href="/tasks/{{$pre->file_upload}}">{{$pre->file_upload}}</a></td>
                        <td>{{$pre->tanggal}}</td>
                        <td>{{$pre->nilai}}</td>
                        <td>
                            <a href="/kegiatan/{{$pre->id}}/nilai" class="badge badge-success">Nilai</a>
                        </td>
                    </tr> 
                @endforeach  
            </tbody>
          </table>
         

        </div>
            <div class="row">
                <div class="mr-auto ml-4">Total : {{$present->total()}}</div>
                <div class="ml-auto mr-4">{{$present->links()}}</div>  
            </div> 
    </div>

    {{-- Modal Form Show POST --}}
<div class="modal fade bd-example-modal-l" id="show" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>          
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="">ID :</label>
                <b id="i"/>
            </div>
            <div class="form-group">
                <label for="">Title :</label>
                <b id="ti"/>
            </div>
            <div class="form-group">
                <label for="">Body :</label>
                <b id="by"/>
            </div>
        </div>
    </div>
  </div>
</div>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript">
    // Show function
  $(document).on('click', '.show-modal', function() {
  $('#show').modal('show');
  $('#i').text($(this).data('id'));
  $('#ti').text($(this).data('code_tasks'));
  $('#by').text($(this).data('code_students'));
  $('.modal-title').text('Detail Absensi & Tugas Siswa');
  });

  function show(id) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      kecTujuan.innerHTML = xhr.responseText
    }
  }
  xhr.open("GET", "", true);
  xhr.send();
 }

</script>
    
@endsection
