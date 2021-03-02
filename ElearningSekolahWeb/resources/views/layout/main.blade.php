<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->


    <title>@yield('title')</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-info justify-content-sm-start fixed-top">
    <div class="container-fluid px-lg-5 px-md-4">
        <button class="navbar-toggler align-self-start my-auto  boder border-light" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand " href="#">Web Admin</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link active" href="{{('/students')}}">Daftar Siswa</a>
            <a class="nav-item nav-link active" href="{{('/task')}}">Daftar Tugas</a>
            <a class="nav-item nav-link active" href="{{('/aktifitas')}}">Aktifitas Siswa</a>
            </div>           
        </div>  
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="{{('/kegiatan')}}">Log Out</a>
        </div>       
    </div>
  </nav>

    @yield('container')

 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <footer>
      <?php if (session('status')) {
        $x = session('status');?>
        <div class="alert alert-success float-md-right mX-2 py-4" role="alert">
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

  </body>
  
</html>