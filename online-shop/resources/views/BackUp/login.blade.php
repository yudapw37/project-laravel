@extends('main.mainLogin')

@section('title', 'Aqwam')

@section('body')

<div class="container container-240">
          <div class="boxLogin">
          <form class="" action="/ceklogin" method="post">
          @csrf
            <div class="text-center " style="padding: 40px 0;">
              <h1 class="display-3">LOGIN</h1>
            </div>
            <div style="width:100%;">
              <h4 class="mt-1">UserName</h4>
              <input type="text" class="form-control mt-1 mb-2" name="username" id=username value="">
              <h4 class="mt-2">Password</h4>
              <input id="inptPass" name="inptPass" type="password" class="form-control mt-1" style="float:left" value="">
              <!-- <span class="eye input-group-text  border border-left-0 border-light bg-light" onclick="pswrdvisibility()"> -->
              <div onclick="passVis()" style="float:right;margin-left:-95px;padding-right:10px;margin-top:15px;height:32px;padding-top:7px;">
                <i id="hide" class="fa fa-eye-slash"></i>
              </div>
                <!-- <i id="hide2" class="fa fa-eye-slash" ></i> -->
              <!-- </span> -->
              <button type="submit" class="btn mt-2 text-center w-100 btn-gradient" name="button">MASUK</button>
              <br>
              <h5 class="mt-1">belum memiliki akun? <a style="color:#ff9191" href="/register">daftar disini</a> </h5>
            </div>
          </form>
          </div>

        </div>

@endsection