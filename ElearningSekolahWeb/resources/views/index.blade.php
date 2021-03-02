<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <!-- <link rel ="icon" href ="include/img/icon2.png" type = "image/x-icon"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/style.css')}}">
    <link href="{{asset('assets/fontAwesome/all.css')}}" rel="stylesheet">
    <title>Login</title>
  </head>
  <body class="lgn" >
    <div class="title-login mx-auto">
      <!-- <img src="include/img/aqwamLogin.png" class="mx-auto" style="max-height:110px;display: block;" > -->
      <p class="font-weight-bolder text-center text-light mb-4 display-4" style="text-shadow: 0px 5px 10px rgba(40, 40, 40, 0.7);">E-LEARNING</p>
    </div>
    <div id='pilihan' class="container">
      <div class="row">
        <div class="col-md-6 col-12 my-3">
          <button id='guru' class="btn w-100 h-300 bgradasi" style="">
            <div style="height:70%">
              <i style="font-size:180px" class="fas fa-chalkboard-teacher mt-2"></i>
            </div>
            <center class="font-weight-bolder" style="font-size:50px">GURU</center>
          </button>
        </div>
        <div class="col-md-6 col-12 my-3">
          <button id='murid'  class="btn bgradasi w-100 h-300">
            <div style="height:70%">
              <i style="font-size:200px" class="fas fa-users"></i>
            </div>
            <center style="font-size:50px">SISWA</center>
          </button>
        </div>
      </div>
    </div>

    <div class="form-login" style="display:none" id="cLogin">
      <div class="outter-form-login">
        <form id='cForm' action="dirPhp/cekLogin.php" class="inner-login" method="post">
        @csrf
          <div class="form-group input-group">
            <div class="input-group-prepend ">
              <i class="fa fa-user input-group-text border border-right-0 border-light" style="padding-top:16px;height:50px; width:38px"></i>
            </div>
            <input type="text" class="form-control border border-left-0 border-light" name="username" style="height:50px;font-size:17px;" placeholder="Username">
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <i class="fa fa-key input-group-text  border border-right-0 border-light" style="padding-top:16px;height:50px; width:38px;"></i>
            </div>
            <input type="password" id="inpt" style="height:50px;font-size:17px;" class="form-control border border-left-0 border-right-0 border-light bg-light" data-toggle="password" name="password" placeholder="Password">
            <div class="input-group-append border border-0">
              <span class="eye input-group-text  border border-left-0 border-light bg-light" onclick="pswrdvisibility()">
                <i id="hide1" class="fa fa-eye" ></i>
                <i id="hide2" class="fa fa-eye-slash" ></i>
              </span>
            </div>
          </div>

          <button type="submit" class="btn mt-2 py-2 btn-block font-weight-bolder btnsbmt" style="color:white;">
            <i class="fa fa-sign-in"></i> Masuk
          </button>
        </form>
          <button id='kembali' class="mb-2 btn btn-block py-2 btn-warning font-weight-bolder" style="color:white;">Kembali</button>
      </div>
    </div>

    <footer>
      <?php if (session('status')) {
        $x = session('status');?>
        <div class="alert alert-danger float-md-right mX-2 py-4" role="alert">
          <div class="row">
            <div class="col text-center">
              <b><?php echo $x; ?></b>
            </div>
            <div class="col m-auto" style="max-width:5px!important">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      <?php  }; ?>
    </footer>

    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script>

      // function login(stat){
      //   console.log(stat);
      //   var form = document.getElementById('gForm')
      //   var guru = document.getElementById('guru')
      //   if (stat == 'guru') {
      //     form.action ='guru.php'
      //     // guru.fadeOut();
      //   }else {
      //     form.action ='siswa.php'
      //   }
      // }

      function pswrdvisibility() {
        var x = document.getElementById("inpt");
        var y = document.getElementById("hide1");
        var z = document.getElementById("hide2");

        if (x.type === 'password') {
          x.type = "text";
          y.style.display = "block";
          z.style.display = "none";
        } else {
          x.type = "password";
          y.style.display = "none";
          z.style.display = "block";
        }
      }

      $(document).ready(function(){
        $("#guru").click(function(){
          $("#pilihan").fadeOut(1);
          $("#cLogin").fadeIn(1000);
          // $("#cLogin").fadeIn(3000);
        //   $('#cForm').attr('action', 'dirPhp/cekLogin.php?id=guru');
          $('#cForm').attr('action', '/loginGuru');
          // var guru = document.getElementById('guru');
          // form.action ='guru.php';
        });
        $("#murid").click(function(){
          $("#pilihan").fadeOut(1);
          $("#cLogin").fadeIn(1000);
          // $("#cLogin").fadeIn(3000);
          $('#cForm').attr('action', '/loginSiswa');
          // var guru = document.getElementById('guru');
          // form.action ='guru.php';
        });
        $("#kembali").click(function(){
          $("#cLogin").fadeOut(1);
          $("#pilihan").fadeIn(1000);
        });
      });
    </script>
  </body>
</html>
