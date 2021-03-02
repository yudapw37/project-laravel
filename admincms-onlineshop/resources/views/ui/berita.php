<!DOCTYPE html>
<html lang="en">

<head>
    <title>YPIHMSUBANDI</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="../vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="../vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="../vendors/jquery-lightbox/css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="../vendors/owl-carousel/owl-carousel/owl.carousel.css">
    <link type="text/css" rel="stylesheet" href="../vendors/owl-carousel/owl-carousel/owl.theme.css">
    <link type="text/css" rel="stylesheet" href="../vendors/jquery-circliful/css/jquery.circliful.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="../home/assets/css/themes/green.css" id="theme-change" class="style-change color-change">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom" class="frontend-one-page">
    <!--BEGIN PAGE LOADER-->
    <!-- <div id="page-loader"><img src="http://swlabs.co/images/icon/preloader.gif" alt="" />
    </div> -->
    <!--END PAGE LOADER-->
    <!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN CONTENT-->
    <header>
        <div class="bg-overlay pattern">
            <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header page-scroll">
                        <button type="button" data-toggle="collapse" data-target=".navbar-main-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button><a id="logo" href="/" class="navbar-brand"><span>YPI</span>HMSUBANDI</a>
                    </div>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                      <ul class="nav navbar-nav main-menu">
                          <li class="page-scroll"><a href="index.php#page-top">Home</a>
                          </li>
                          <li class="page-scroll"><a href="index.php#about">Aktifitas</a>
                          </li>
                          <li class="page-scroll"><a href="index.php#about-1">Tentang Kami</a>
                          </li>
                          <li class="page-scroll"><a data-hover="dropdown">Anggota</a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php#team"></i>Struktur Organisasi</a>
                                </li>
                                <li><a href="index.php#services"></i>Guru&Karyawan</a>
                                </li>
                            </ul>
                          </li>
                          <li class="page-scroll"><a href="index.php#skills">Visi&Misi</a>
                          </li>
                          <li class="page-scroll"><a href="index.php#features">Program Kerja</a>
                          </li>
                          <li class="page-scroll"><a data-hover="dropdown">Pendidikan</a>
                            <ul class="dropdown-menu">
                                <li><a href="pendidikan.php?cat=1"></i>KB/RA</a>
                                </li>
                                <li><a href="pendidikan.php?cat=2"></i>SDIP</a>
                                </li>
                                <li><a href="pendidikan.php?cat=3"></i>MTS</a>
                                </li>
                            </ul>
                          </li>
                          <li class="page-scroll"><a data-hover="dropdown">Pendaftaran</a>
                            <ul class="dropdown-menu">
                                <li><a href="pendaftaran.php?cat=1"></i>KB/RA</a>
                                </li>
                                <li><a href="pendaftaran.php?cat=2"></i>SDIP</a>
                                </li>
                                <li><a href="pendaftaran.php?cat=3"></i>MTS</a>
                                </li>
                            </ul>
                          </li>
                      </ul>
                    </div>
                </div>
            </nav>
            <section class="intro">
                <div class="intro-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="slide-intro">
                                    <h1>Pendidikan <div id="rotate"><div>KB/RA</div><div>SD</div><div>MTS</div></div></h1>
                                    <p class="intro-text">YAYASAN PENDIDIKAN ISLAM HAJI MUHAMMAD SUBANDI Memiliki 3 Tingkat Pendidikan Yaitu KB/RA, SD, MTS</p>
                                </div>
                                <div class="section-next page-scroll"><a href="#about" class="btn btn-circle"><i class="fa fa-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </header>
      <section id="about" class="section-content">
        <h2 class="section-heading"><span>JUDUL BERITA</span></h2>
        <div class="line"></div>
        <div class="container">
          <p class="section-description" style="text-align:justify">
            <?php $berita = '
            Sejak pandemi Covid-19 melanda, banyak perusahaan menerapkan sistem kerja " work from home" (WFH). Hal ini membuat banyak karyawan tergoda untuk menyelesaikan pekerjaan kantor dari atas tempat tidur.
            Memang terasa nyaman mengerjakan tugas kantor sembari rebahan di atas kasur yang empuk. Sayangnya, kebiasaan ini justru bisa mengurangi produktifitas dan berdampak negatif bagi kesehatan. Ahli kiropraktik dari Cleveland Clinic, Andrew Bang juga menyarankan para karyawan untuk menghindari kebiasaan ini.
            Menurutnya, menyelesaikan pekerjaan di atas tempat tidur bisa menganggu jadwal tidur dan mengurangi produktifitas. "Kebiasaan ini juga bisa merusak postur tubuh dan mendatangkan rasa sakit yang mengganggu," ucap dia.

            Mengapa hal ini bisa terjadi?
            Menurut Andrew Bang, bekerja di atas tempat tidur bisa membuat otak mengasosiasikan kasur sebagai tempat kerja. Hal ini bisa berdampak negatif pada kualitas tidur kita. Itu sebabnya, kamar tidur harus menjadi lingkungan yang santai untuk mendukung kualitas tidur kita.
            "Riset juga membuktikan menggunakan ponsel atau gadget tepat sebelum tidur bisa membuat kita sulit memejamkan mata karena cahaya biru yang dipancarkannya," ucap Andrew Bang. Oleh karena itu, mengerjakan tugas kantor dari tempat tidur juga membut kita sulit memejamkan mata di malam hari.
            Tidak memiliki batasan antara waktu kerja dan pribadi juga bisa membuat produktifitas menurun.

            Cara terbaik saat WFH
            Tubuh yang kurang sehat atau rumah yang terlalu ramai sehingga sulit berkonsentrasi membuat tempat tidur menjadi pilihan banyak orang saat harus WFH. "Jika harus bekerja dari tempat tidur, kita harus pandai mengatur waktur," ucap Andrew Bang. Biasanya, banyak dari kita menyelesaikan tugas kantor di atas tempat tidur sembari berbaring.
            Hal ini bisa meyebabkan sakit di bagian tulang belakang. "Posisi tubuh saat mengerjakan tugas kantor juga harus diperhatikan. Sebisa mungkin, tulang belakang harus berada di posisi netral," ucap Andrew Bang. Selain itu, pastikan kepala, lengan, dan punggung betada di posisi yang tepat agar tidak terasa sakit.
            Kita juga tidak disarankan menyandarkan kepala ke dinding atau ranjang karena akan membuat sisi belakang otot tegang, termasuk fleksor pinggul. "Posisi tersebut bisa menyebabkan rasa sakit di bagian punggung karena otot tulang belakang tertarik," ucapnya. Andrew Bang juga menyarankan agar kita menghindari bantal agar leher tidak tertekuk.
            Jika harus menggunakannya, gunakan satu bantal kecil di bawah leher. Kita juga harus memperbanyak bergerak, minimal setiap 45 menit melakukan peregangan agar otot tubuh tidak kaku.
            ';
            echo nl2br($berita);
            ?>
          </p>
        </div>
      </section>
    <footer >
        <div class="container">
            <p class="text-center">Cemara IT Salatiga</p>
        </div>
    </footer>
    <!--END CONTENT-->
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <!--loading bootstrap js-->
    <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <script src="../vendors/isotope/dist/isotope.pkgd.min.js"></script>
    <script src="../vendors/jquery.hoverdir.js"></script>
    <script src="../vendors/modernizr.custom.97074.js"></script>
    <script src="../vendors/jquery-lightbox/js/lightbox.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu6tm60TzeUo9rWpLnrQ7mrFn4JPMVje4&amp;sensor=false"></script>
    <script src="../vendors/owl-carousel/owl-carousel/owl.carousel.min.js"></script>
    <script src="../vendors/jquery-circliful/js/jquery.circliful.min.js"></script>
    <!--Loading script for each page-->
    <script src="assets/plugins/jquery-backstretch/jquery.backstretch.min.js"></script>
    <script src="assets/js/one-page_slider.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="assets/js/jquery-text-effect.js"></script>
    <script src="../js/frontend-one-page.js"></script>
</body>

</html>
