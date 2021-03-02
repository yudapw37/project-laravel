@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5" style="margin-top:70px !important;">Form Tambah Data Siswa</h3>
                <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
                <form method="post" action="/students" class="">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama . ." name="nama" value="{{old('nama')}}">
                        @error('nama') <div class="invalid-feedback">Nama Harus Di isi!!</div> @enderror
                    </div>   
                    <div class="form-group">
                        <label for="nama">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username . ." name="username"  value="{{old('username')}}">
                        @error('username') <div class="invalid-feedback">Username Harus Di isi!!</div> @enderror
                    </div>  
                    <div class="form-group">
                        <label for="nama">Password</label> 
                        <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password . ." name="password" value="{{old('password')}}">
                        @error('password') <div class="invalid-feedback">Password Harus Di isi!!</div> @enderror
                    </div>  
                    <div class="form-group">
                        <label for="nama">Kelas</label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" placeholder="Masukkan Kelas . ." name="kelas" value="{{old('kelas')}}">
                        @error('kelas') <div class="invalid-feedback">Kelas Harus Di isi!!</div> @enderror
                    </div> 
                    <div class="form-group">
                        <label for="nama">Alamat</label>
                        <textarea  type="text" class="form-control @error('alamat') is-invalid @enderror" rows="3" id="alamat" placeholder="Masukkan Alamat . ." name="alamat" value="">{{old('alamat')}}</textarea >
                        @error('alamat') <div class="invalid-feedback">Alamat Harus Di isi!!</div> @enderror
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary ml-auto mr-4">Tambah Data!!</button>
                    </div>                                        
                </form>
            </div>
        </div>
    </div>
    @endsection