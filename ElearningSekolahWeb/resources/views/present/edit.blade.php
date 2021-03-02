@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
<?php 
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {$url = "https://";   }
    else  {$url = "http://";   }
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];
    $url .= '/tasks/';
    $gambar = $present->file_upload;
    $ext= substr($gambar, -3);
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5" style="margin-top:70px !important;">Form Nilai Tugas Siswa</h3>
                <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
                <div class="scrolling-wrapper">
                <table class="table bg-light table-bordered " >
                    <tr>
                        <td>Nama Siswa</td>
                        <td>{{ $present->nama}}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>{{ $present->kelas}}</td>
                    </tr>
                    <tr>
                        <td>Mata Pelajaran</td>
                        <td>{{ $present->mapel}}</td>
                    </tr>
                    <tr>
                        <td>Nama Tugas</td>
                        <td>{{ $present->namaTugas}}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi Tugas</td>
                        <td>{{ $present->keterangan}}</td>
                    </tr>
                    <tr>
                    @if($ext == 'jpg' || $ext == 'peg' ||$ext == 'png')  
                    <td colspan=2"">
                    <p>Hasil Gambar Tugas</p>
                    <div class="container text-center">
                        <input id="<?php echo 'myCheckbox';?>" class="d-none" type="checkbox" />
                        <label for="<?php echo 'myCheckbox';?>">
                        <img src="<?php echo $url.$gambar; ?>" id="<?php echo 'enimg'; ?>" class="h-300" class="rounded mx-auto d-block" >
                        </label>
                    </div>
                    </td>
                    @else
                    <td>Hasil Tugas</td>
                    <td><a href="/tasks/{{$present->file_upload}}">{{ $present->file_upload}}</td>
                    @endif
                    </tr>
                    <tr>
                        <td>Hasil Keterangan Tugas</td>
                        <td>{{ $present->komentar}}</td>
                    </tr>
                    <tr>
                        <td>Beri Penilaian</td>
                        <td >
                        <form method="post" action="/kegiatan/nilai/{{$present->id}}" class="">
                        @csrf
                            <div class="form-group">
                            <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" placeholder="Masukkan Nilai . ." name="nilai" value="">
                            @error('nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div> 
                            <div class="row">
                                <button type="submit" class="btn btn-primary ml-auto mr-4">Simpan Nilai</button>
                            </div>
                        </form> 
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endsection