@extends('main.mainLogin')
@section('title', 'Aqwam')
@section('body')
        <div class="container container-240">
          <div class="boxLogin">
            <form class="" action="/registercust" method="post">
              <div style="display:flex;justify-content:center">
                <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -98px 0 0;" alt="">
                <h4 style="color:white;position:absolute;margin:-61px 0 0">BUAT AKUN</h4>
              </div>
              @csrf
              <!-- <div class="text-center " style="padding: 40px 0;">
                <h1 class="display-3">Buat Akun</h1>
              </div> -->
              <div style="width:100%;">
                <h4 class="mt-1">UserName</h4>
                <input type="text" class="form-control mt-s @error('username') is-invalid @enderror" name="username" id="username" value="{{old('username')}}">
                @error('username') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <h4 class="mt-1">Password</h4>
                <input id="inptPass" type="password" class="form-control mt-s @error('password') is-invalid @enderror" style="float:left" name="password" value="{{old('password')}}">
                <div onclick="passVis()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:9px;height:32px;padding-top:7px;">
                  <i id="hide" class="fa fa-eye-slash"></i>
                </div>
                @error('password') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <h4 class="mt-3">Nama</h4>
                <input type="text" class="form-control mt-s @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}">
                 @error('nama') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <h4 class="mt-1">Email</h4>
                <input type="text" class="form-control mt-s @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}">
                 @error('email') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <h4 class="mt-1">No HP</h4>
                <input type="text" class="form-control mt-s @error('telephone') is-invalid @enderror" name="telephone" id="telephone" value="{{old('telephone')}}">
                 @error('telephone') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <!-- <h4 class="mt-1">Kode Admin </h4>
                <input type="text" class="form-control mt-s" name="kodeadmin" id="kodeadmin" value="{{old('kodeadmin')}}"> -->
                <h4 class="mt-1">Alamat</h4>
                <textarea name="alamat" id="alamat" class="form-control mt-s @error('alamat') is-invalid @enderror" rows="4" cols="80"></textarea>
                 @error('alamat') <div style="color:red"class="invalid-feedback">{{ $message }}</div> @enderror
                <button type="submit" class="btn mt-2 btn-block text-center btn-primary" name="button">DAFTAR</button>
                <br>
                <h5 class="mt-1">sudah memiliki akun? <a style="color:#ff9191" href="/login">masuk lewat sini</a> </h5>

              </div>

            </form>
          </div>
        </div>
@endsection
