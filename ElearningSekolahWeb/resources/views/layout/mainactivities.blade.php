<html>
  <head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php session_start();?>
        <title>E-Learning</title>
        <!-- <link rel ="icon" href ="../include/img/icon2.png" type = "image/x-icon"> -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/style.css')}}">
        <link href="{{asset('assets/fontAwesome/all.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  </head>
    <body>
    <?php
    date_default_timezone_set("Asia/Jakarta");
     
    if (!session('namaUser')) {
        echo '<script>window.location = "/";</script>';
    }
    
    if (session('status')) {
                $x = session('status');?>
                <div class="alert alert-danger cAlt float-md-right mX-2 py-4" role="alert">
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
        <?php        
        if (session('statusSukses')) {
                $x = session('statusSukses');?>
                <div class="alert alert-success cAlt float-md-right mx-3 my-4 py-4" role="alert">
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
    <?php
  // require_once 'cekSession.php';
        function print_array($array_data, $comment='') {
                if($array_data) {
                    echo '<pre>';

                    if ($comment) echo '# ' . $comment . "\n";
                    echo '--------------------------------'. "\n";
                    print_r($array_data);
                    echo "\n--------------------------------";
                    echo '</pre>';
                }
            }
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark lgn  justify-content-sm-start fixed-top">
        <div class="container-fluid px-lg-5 px-md-4">
            <div class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 mr-auto font-weight-bolder">
            E-Learning
            </div>

            <!-- <img src="../include/img/icon7.png" class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 mr-auto" style="width:80px"> -->
            <!-- mobile-nav-btn -->
            <?php if (session('role') == 'guru'): ?>
            <button class="navbar-toggler align-self-start my-auto  boder border-light " type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bgnav p-3 p-lg-0 mt-5 px-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
                <ul class="navbar-nav align-self-stretch ">
                <li class="nav-item active px-3 px-lg-0" >
                    <a class="nav-link text-light font-weight-bold" href="{{('/students')}}">Daftar Siswa</a>
                </li>
                <li class="nav-item active px-3 px-lg-0" >
                    <a class="nav-link text-light font-weight-bold" href="{{('/task')}}">Daftar Tugas</a>
                </li>
                <li class="nav-item active px-3 px-lg-0" >
                    <a class="nav-link text-light font-weight-bold" href="{{('/aktifitas')}}">Aktifitas Siswa</a>
                </li>
                </ul>
            </div>
            <?php endif; ?>
            <!-- nav-btn -->

            <!-- accnt-btn -->
            <div class="dropdown ml-5  order-2">
            <button style="color:white" class="usr btn btn-outline-light my-2 my-sm-0 font-weight-bold" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Session::get('namaUser')}}
            </button>
            <div class="dropdown-menu dropdown-menu-right lgn border bg-light " aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item font-weight-bold text-light" href="/logout">Keluar</a>
            </div>
            </div>

        </div>
        </nav>

        @yield('container')

        <?php
            if (@$blnk == '1') {

            }else {
            echo '<div class="overlay"></div>
            <footer style="background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);">
            <p style="height:40px"></p>
            </footer>';
            }
        ?>

        <footer>
        
            </footer>


        <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/script.js')}}"></script>

        <script>
        document.querySelector('.custom-file-input').addEventListener('change',function(e){
          var fileName = document.getElementById("myInput").files[0].name;
          var nextSibling = e.target.nextElementSibling
          nextSibling.innerText = fileName
          })
        </script>
    </body>
</html>