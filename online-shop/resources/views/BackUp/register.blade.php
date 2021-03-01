@extends('main.mainLogin')

@section('title', 'Aqwam')

@section('body')

<div class="container container-240">
          <div class="boxDaftar">
          <form class="" action="/registercust" method="post">
          @csrf
            <div class="text-center " style="padding: 40px 0;">
              <h1 class="display-3">Buat Akun</h1>
            </div>
            <div style="width:100%;">
              <h4 class="mt-1">UserName</h4>
              <input type="text" class="form-control mt-s" name="username" id="username" value="">
              <h4 class="mt-1">Password</h4>
              <input id="inptPass" type="password" class="form-control mt-s" style="float:left" name="inptPass" value="">
              <div onclick="passVis()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:9px;height:32px;padding-top:7px;">
                <i id="hide" class="fa fa-eye-slash"></i>
              </div>
              <h4 class="mt-3">Nama</h4>
              <input type="text" class="form-control mt-s" name="nama" id="nama" value="">
              <h4 class="mt-1">Email</h4>
              <input type="text" class="form-control mt-s" name="email" id="email" value="">
              <h4 class="mt-1">No HP</h4>
              <input type="text" class="form-control mt-s" name="telephone" id="telephone" value="">
              <h4 class="mt-1">Kode Admin </h4>
              <input type="text" class="form-control mt-s" name="kodeadmin" id="kodeadmin" value="">
              <h4 class="mt-1">Alamat</h4>
              <textarea name="alamat" id="alamat" class="form-control mt-s" rows="4" cols="80"></textarea>
              <button type="submit" class="btn mt-2 text-center w-100 btn-gradient" name="button">MASUK</button>
              <br>
              <h5 class="mt-1">sudah memiliki akun? <a style="color:#ff9191" href="/login">masuk lewat sini</a> </h5>
              
            </div>

          </form>  
          </div>

        </div>

@endsection