@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5" style="margin-top:70px !important;">Form Tambah Data Tugas Siswa</h3>
                <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
                <form method="post" action="/task" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <input type="text" class="form-control @error('mapel') is-invalid @enderror" id="mapel" placeholder="Masukkan Mata Pelajaran Tugas . ." name="mapel" value="{{old('mapel')}}">
                        @error('mapel') <div class="invalid-feedback"> Mata Pelajaran Di isi!!</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Tugas</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Tugas . ." name="nama" value="{{old('nama')}}">
                        @error('nama') <div class="invalid-feedback">Nama Harus Di isi!!</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" placeholder="Masukkan Kelas . ." name="kelas" value="{{old('kelas')}}">
                        @error('kelas') <div class="invalid-feedback">Kelas Harus Di isi!!</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Tugas</label>
                        <input type="date" class="form-control ml-2 @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Masukkan Tanggal . ." name="tanggal" value="{{old('tanggal')}}">
                         @error('tanggal') <div class="invalid-feedback">Tanggal Harus Di isi!!</div> @enderror
                    </div> 
                    <div class="form-group">
                        <label for="keterangan">Keterangan Tugas</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukkan Keterangan Tugas . ." name="keterangan" value="{{old('keterangan')}}">
                        @error('keterangan') <div class="invalid-feedback">Keterangan Harus Di isi!!</div> @enderror
                    </div> 
                    <div class="form-group">
                        <label for="file">File Tugas</label>
                        <input type="file" class="form-control ml-2" id="file" placeholder="Masukkan File . ." name="file" value="file">
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary ml-auto mr-4">Tambah Data!!</button>
                    </div>                                        
                </form>
            </div>
        </div>
    </div>
    @endsection