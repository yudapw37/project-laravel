@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
      <div class="container mt-5 pt-4">
        <div class="row">
          <div class="col-md-6 col-12 my-1">
            <h2 class="font-weight-bold cLeft">
            Kegiatan & Tugas
            </h2>
          </div>
          <div class="col-md-6 col-12 my-1">
            <h2 class="font-weight-bold cRight">
            {{ now()->day.'/'.now()->month.'/'.now()->year }}
            </h2>
          </div>
        </div>
        <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
        @if (session('statusSimpan'))
            <div class="alert alert-success">
                {{ session('statusSimpan') }}
            </div>
        @endif
        <form method="post" action="/kegiatan/add" class="" enctype="multipart/form-data">
        @csrf
            <table class="mt-2 table table-borderless">
            <tr>
                <td>Kegiatan </td>
                <td style="width:1px!important;">:</td>
                @if($task)
                <td>{{$task->nama}}</td>
                @else
                <td>-</td>
                @endif
            </tr>
            <tr>
                <td></td>
                <td style="width:1px!important;"> </td>
                @if($task)
                <td>{{$task->keterangan}}</td>
                @else
                <td>Belum Ada Tugas Di tanggal Ini. Hubungi Guru Bersangkutan untuk cek tugas</td>
                @endif
            </tr>
            @if($task) 
            <tr>
                <td></td>
                <td style="width:1px!important;"> </td>
                <td>Klik file > <a href="/images/{{$task->file}}">{{$task->file}}</a></td>
            </tr>
            @endif
            <tr>
                <td style="min-width:110px!important" >Unggah File </td>
                <td>:</td>
                <td>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="myInput" aria-describedby="myInput">
                    <label class="custom-file-label" for="myInput">Pilih Data</label>
                </div>
                </td>
            </tr>
            <div class="form-group">
            <tr>
                <td class="align-top">Komentar</td>
                <td class="align-top">:</td>
                <td class="w-100">
                <textarea class="form-control @error('komentar') is-invalid @enderror" type="text"  name="komentar" value="{{old('komentar')}}" rows="4"></textarea>
                @error('komentar') <div class="invalid-feedback">Komentar Harus Di isi!!</div> @enderror
                </td>
            </tr>
            </div>
            <tr>
                <td colspan="3">
                @if($task)
                <button type="submit" class="btn mt-2 py-2 font-weight-bolder btnsbmt float-right" style="color:white;">
                    <i class="fas fa-save"></i> Simpan
                </button>
                @else
                @endif
                </td>
            </tr>
            </table>
        </form>
        <br>
        <br>
        <h2 class="font-weight-bold cLeft">
        Riwayat Siswa
        </h2>
        <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
        <div class="" style="overflow:auto"> 
        <table class="table">
          <thead >
            <tr class="lgn">
            <th>#</th>
              <th>Tanggal</th>
              <th>Kegiatan</th>
              <th>File</th>
              <th>Nilai</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($present as $pre)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pre->tanggal}}</td>
                        <td>{{$pre->nama}}</td>
                        <td><a href="/tasks/{{$pre->file_upload}}">{{$pre->file_upload}}</td>
                        <td>{{$pre->nilai}}</td>
                    
                    <?php 
                        $d1 =  substr($pre->tanggal,0,10);
                        $d2 = date("Y-m-d");
                            if($d1 == $d2){
                    ?>
                        <td>
                            <a href="/kegiatan/{{$pre->id}}/edit" class="btn btn-success">Edit</a>
                        </td>
                    <?php
                            }
                            else{
                                echo '<td></td>';
                            }
                    ?> 
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
        
@endsection