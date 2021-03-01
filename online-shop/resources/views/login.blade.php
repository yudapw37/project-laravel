@extends('main.mainLogin')
@section('title', 'Aqwam')
@section('body')
  <div class="container container-240">
    <div class="boxLogin">
      <form class="" action="/ceklogin" method="post">
        <div style="display:flex;justify-content:center">
          <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -98px 0 0;" alt="">
          <h4 style="color:white;position:absolute;margin:-61px 0 0">MASUK AKUN</h4>
        </div>
        @csrf
        <!-- <div class="text-center " style="padding: 40px 0;">
          <h1 class="display-3">LOGIN</h1>
        </div> -->
        @if (session('statussalah'))
        <div class="alert alert-danger">
            {{ session('statussalah') }}
        </div>
        @endif
        @if (session('statusSuksesDaftar'))
        <div class="alert alert-success">
            {{ session('statusSuksesDaftar') }}
        </div>
        @endif
        <div style="width:100%;">
          <h4 class="mt-1">UserName</h4>
          <input type="text" class="form-control mt-1 mb-2 @error('username') is-invalid @enderror" name="username" id=username value="{{old('username')}}">
          @error('username') <div style="color:red"class="invalid-feedback">Username Harus Di isi!!</div> @enderror
          <h4 class="mt-2">Password</h4>
          <input id="inptPass" name="inptPass" type="password" class="form-control mt-1 @error('inptPass') is-invalid @enderror" style="float:left" value="">
          <!-- <span class="eye input-group-text  border border-left-0 border-light bg-light" onclick="pswrdvisibility()"> -->
          <div onclick="passVis()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:15px;height:32px;padding-top:7px;">
            <i id="hide" class="fa fa-eye-slash"></i>
          </div>
          @error('inptPass') <div style="color:red"class="invalid-feedback">Password Harus Di isi!!</div> @enderror
            <!-- <i id="hide2" class="fa fa-eye-slash" ></i> -->
          <!-- </span> -->
          <center>
            <button type="submit" class="btn mt-2 text-center btn-primary" style="padding: 5px 50px!important;" name="button">MASUK</button>
          </center>
          <br>
          <h5 class="mt-1">belum memiliki akun? <a style="color:#ff9191" href="/register">daftar disini</a> </h5>
        </div>
      </form>
    </div>
  </div>
@endsection
