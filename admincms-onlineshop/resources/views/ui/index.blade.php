@extends('ui.layout.main')

@section('title', 'YPIHMSUBANDI')

@section('body')

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
                            <li class="page-scroll"><a href="#page-top">Home</a>
                            </li>
                            <li class="page-scroll"><a href="#about">Aktifitas</a>
                            </li>
                            <li class="page-scroll"><a href="#about-1">Tentang Kami</a>
                            </li>
                            <li class="page-scroll"><a data-hover="dropdown">Anggota</a>
                              <ul class="dropdown-menu">
                                  <li><a href="#team"></i>Struktur Organisasi</a>
                                  </li>
                                  <li><a href="#services"></i>Guru&Karyawan</a>
                                  </li>
                              </ul>
                            </li>
                            <li class="page-scroll"><a href="#skills">Visi&Misi</a>
                            </li>
                            <li class="page-scroll"><a href="#features">Program Kerja</a>
                            </li>
                            <li class="page-scroll"><a data-hover="dropdown">Pendidikan</a>
                              <ul class="dropdown-menu">
                                  <li><a href="/kbra"></i>KB/RA</a>
                                  </li>
                                  <li><a href="/sdip"></i>SDIP</a>
                                  </li>
                                  <li><a href="/mts"></i>MTS</a>
                                  </li>
                              </ul>
                            </li>
                            <li class="page-scroll"><a data-hover="dropdown">Pendaftaran</a>
                              <ul class="dropdown-menu">
                                  <li><a href="/daftarKBRA"></i>KB/RA</a>
                                  </li>
                                  <li><a href="/daftarSDIP"></i>SDIP</a>
                                  </li>
                                  <li><a href="/daftarMTS"></i>MTS</a>
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
      <h2 class="section-heading">AKTIFITAS <span>TERBARU</span></h2>
      <div class="line"></div>
      <p class="section-description" style="text-align:justify">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div id="owl-our-clients" class="owl-carousel">
                <div class="item">
                  <div class="avatar"><center><img src="../images/recentUpdate/1.jpg" alt="" class="img-responsive" /></center></div>
                  <div style="width:50%;height:3px!important" class="line"></div>
                  <div class="description">Lomba Balap Karung dilakukang selama pelaksanaan kegiatan perayaan hari kemerdekaan Indonesia 17 agustus. <a href="berita.php#about">lanjut baca ...</a></div>
                </div>
                <div class="item">
                  <div class="avatar"><center><img src="../images/recentUpdate/2.jpg" alt="" class="img-responsive" /></center></div>
                  <div style="width:50%;height:3px!important" class="line"></div>
                  <div class="description">Lomba Balap Karung dilakukang selama pelaksanaan kegiatan perayaan hari kemerdekaan Indonesia 17 agustus. <a href="berita.php#about">lanjut baca ...</a></div>
                </div>

              </div>
            </div>
          </div>
        </div>
    </section>
    <section id="about-1" class="section-content">
      <div class="container">
        <div class="row mbxxl">
          <div class="col-lg-12">
            <h2 class="section-heading">TENTANG <span>KAMI</span></h2>
            <div class="line"></div>
            <p class="section-description" style="text-align:justify">
            <?php $text =
                  'Yayasan ini bernama: Yayasan Pendidikan Islam Haji Muhammad Subandi disingkat YPI  H. M. Subandi, berkedudukan di Kabupaten Semarang dan berkantor untuk pertama kalinya di Lingkungan Kadipaten, Rukun Tetangga 001, Rukun Warga 004, Kelurahan Harjosari, Kecamatan Bawen, Kabupaten Semarang, Propinsi Jawa Tengah.

                  Sebagaimana yang termaktub dalam Akta Pendirian, bahwa Yayasan Pendidikan Islam Haji Muhammad Subandi Bawen adalah sebuah Yayasan yang bergerak di bidang sosial, keagamaan dan kemanusiaan. Salah satu kegiatan yang sudah dijalankan adalah menyelenggarakan pendidikan berupa Raudlatul Athfal (RA) Haji Soebandi yang  didirikan pada tahun 2003, Sekolah Dasar Islam Plus H. M. Subandi yang didirikan pada tahun 2003, dan Kelompok Bermain Haji Muhammad Subandi yang didirikan pada tahun 2013. Pada Tahun Pelajaran 2017/2018 ini peserta didik dari keseluruhan jenjang pendidikan yang diselenggarakan oleh Yayasan Pendidikan Islam Haji Muhammad Subandi  berjumlah 605 anak dengan rincian Kelompok Bermain sebanyak 19 anak, RA sebanyak 121 anak, dan SD sebanyak 465 anak.';
                  echo nl2br($text);
            ?>
            </p>
          </div>
        </div>
      </div>
    </section>
    <section id="team" class="section-content">
        <div class="container">
            <div class="row mbxxl">
                <div class="col-lg-12">
                    <h2 class="section-heading">STRUKTUR <span>ORGANISASI</span></h2>
                    <div class="line"></div>
                    <!-- <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
                </div>
            </div>
            <div id="owl-our-team" class="owl-carousel">
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/1.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">H. M. Subdandi</div>
                        <div class="poisition">Ketua Pembina</div>
                        <div class="line"></div>
                        <div class="description">H. M. Subdandi merupakan ketua pembina dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/2.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">HJ. Jami'ah</div>
                        <div class="poisition">Anggota Pembina</div>
                        <div class="line"></div>
                        <div class="description">HJ. Jami'ah merupakan anggota pembina dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/3.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">Drs. H. Makhasin</div>
                        <div class="poisition">Anggota Pembina</div>
                        <div class="line"></div>
                        <div class="description">Drs. H. Makhasin merupakan anggota pembina dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/4.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">H. Kasbun Rofiq M, S.Ag</div>
                        <div class="poisition">Ketua Pengawas</div>
                        <div class="line"></div>
                        <div class="description">H. Kasbun Rofiq M, S.Ag merupakan ketua pengawas dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/5.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">KH. Syamsudin</div>
                        <div class="poisition">Anggota Pengawas</div>
                        <div class="line"></div>
                        <div class="description">KH. Syamsudin merupakan anggota pengawas dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/6.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">Untung Budiarto, S.H.</div>
                        <div class="poisition">Ketua Pengurus</div>
                        <div class="line"></div>
                        <div class="description">Untung Budiarto, S.H. merupakan ketua pengrus dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/7.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">Drs. Rohmad, M.Pd</div>
                        <div class="poisition">Wakil Ketua Pengurus</div>
                        <div class="line"></div>
                        <div class="description">Drs. Rohmad, M.Pd merupakan wakil ketua pengrus dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/8.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">Farah Mawadini, M.Pd</div>
                        <div class="poisition">Sekretaris</div>
                        <div class="line"></div>
                        <div class="description">Farah Mawadini, M.Pd merupakan sekretaris dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>
                <div class="item">
                    <div class="team-content">
                        <div class="avatar"><img src="../images/avatar/9.jpg" alt="" class="img-responsive img-circle" />
                        </div>
                        <div class="name">Eryanah Budiarti, SE</div>
                        <div class="poisition">Bendahara</div>
                        <div class="line"></div>
                        <div class="description">Eryanah Budiarti, SE merupakan bendahara dari Yayasan Pendidikan Islam Haji Muhammad Subandi</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id="services" class="section-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-heading"><span>Guru </span>&<span> Karyawan</span></h2>
            <div class="line" style="margin-bottom:5px!important;"></div>
          </div>
        </div>
        <div class="row">
          <div id="owl-about1" class="owl-carousel">
            <div class="item">
              <table class="table" style="width:70%!important;margin:1px auto 5px auto">
                <thead class="c b">
                  <tr>
                    <th colspan="3" class="text-center bg-light"><h3 style="font-weight: bold;"><span>KB/RA</h3></span></th>
                  </tr>
                  <tr>
                    <th class="text-center" style="width:10%">No</th>
                    <th class="text-center" style="width:45%">Jabatan</th>
                    <th class="text-center" style="width:45%">Nama</th>
                  </tr>
                </thead>
                <tbody class="a">
                  <tr class="b">
                    <td>1</td>
                    <td>Pengajar</td>
                    <td class="text-left">Alkomah, S.Pd.AUD</td>
                  </tr>
                  <tr class="b">
                    <td>2</td>
                    <td>Pengajar</td>
                    <td class="text-left">Munafiatun, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>3</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ike Setya Darmayanti, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>4</td>
                    <td>Pengajar</td>
                    <td class="text-left">Umi Rohmatun, S.Pd.SD</td>
                  </tr>
                  <tr class="b">
                    <td>5</td>
                    <td>Pengajar</td>
                    <td class="text-left">Nurul Fauziah, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>6</td>
                    <td>Pengajar</td>
                    <td class="text-left">Siti Wahyu Utami, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>7</td>
                    <td>Pengajar</td>
                    <td class="text-left">Siti Jumiyatis Sa'adah</td>
                  </tr>
                  <tr class="b">
                    <td>8</td>
                    <td>Pengajar</td>
                    <td class="text-left">Nurul Hidayah</td>
                  </tr>
                  <tr class="b">
                    <td>9</td>
                    <td>Pengajar</td>
                    <td class="text-left">Marinten</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="item">
              <table class="table" style="width:70%!important;margin:1px auto 5px auto;">
                <thead class="c b">
                  <tr >
                    <th colspan="3" class="text-center bg-light"><h3 style="font-weight: bold;"><span>SDIP</span></h3></th>
                  </tr>
                  <tr>
                    <th class="text-center" style="width:10%">No</th>
                    <th class="text-center" style="width:45%">Jabatan</th>
                    <th class="text-center" style="width:45%">Nama</th>
                  </tr>
                </thead>
                <tbody class="a">
                  <tr class="b">
                    <td>1</td>
                    <td>Pengajar</td>
                    <td class="text-left">Syamsodin, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>2</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ericca Fudyarina, A.Md</td>
                  </tr>
                  <tr class="b">
                    <td>3</td>
                    <td>Pengajar</td>
                    <td class="text-left">Alfiyah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>4</td>
                    <td>Pengajar</td>
                    <td class="text-left">Isaroh, S.Pd.SD</td>
                  </tr>
                  <tr class="b">
                    <td>5</td>
                    <td>Pengajar</td>
                    <td class="text-left">Istirochah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>6</td>
                    <td>Pengajar</td>
                    <td class="text-left">Any Maskanah, S.Pd.SD</td>
                  </tr>
                  <tr class="b">
                    <td>7</td>
                    <td>Pengajar</td>
                    <td class="text-left">Sri Walyati, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>8</td>
                    <td>Pengajar</td>
                    <td class="text-left">Dhiana Nastitia, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>9</td>
                    <td>Pengajar</td>
                    <td class="text-left">Dian Arthia W, S.Pd.SD</td>
                  </tr>
                  <tr class="b">
                    <td>10</td>
                    <td>Pengajar</td>
                    <td class="text-left">Sri Handayani, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>11</td>
                    <td>Pengajar</td>
                    <td class="text-left">Anis Mahsunah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>12</td>
                    <td>Pengajar</td>
                    <td class="text-left">Epri Kurniawati, S.S</td>
                  </tr>
                  <tr class="b">
                    <td>13</td>
                    <td>Pengajar</td>
                    <td class="text-left">Tatimatun, A.Md</td>
                  </tr>
                  <tr class="b">
                    <td>14</td>
                    <td>Pengajar</td>
                    <td class="text-left">Mutmainah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>15</td>
                    <td>Pengajar</td>
                    <td class="text-left">Muhamad Hisam Kurniawan</td>
                  </tr>
                  <tr class="b">
                    <td>16</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ari Tri Ismawati, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>17</td>
                    <td>Pengajar</td>
                    <td class="text-left">Imam Sahuri</td>
                  </tr>
                  <tr class="b">
                    <td>18</td>
                    <td>Pengajar</td>
                    <td class="text-left">Santoso</td>
                  </tr>
                  <tr class="b">
                    <td>19</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ngasiyah</td>
                  </tr>
                  <tr class="b">
                    <td>20</td>
                    <td>Pengajar</td>
                    <td class="text-left">Siti Yuliyanti, S.Psi.I</td>
                  </tr>
                  <tr class="b">
                    <td>21</td>
                    <td>Pengajar</td>
                    <td class="text-left">Umi Jauharoh, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>22</td>
                    <td>Pengajar</td>
                    <td class="text-left">Isni Zamhariyah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>23</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ahmad Samsul, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>24</td>
                    <td>Pengajar</td>
                    <td class="text-left">Nur Fitriani</td>
                  </tr>
                  <tr class="b">
                    <td>25</td>
                    <td>Pengajar</td>
                    <td class="text-left">Nur Ika Wati, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>26</td>
                    <td>Pengajar</td>
                    <td class="text-left">Zuhrotun Nafiah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>27</td>
                    <td>Pengajar</td>
                    <td class="text-left">Rosidita Nuha, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>28</td>
                    <td>Pengajar</td>
                    <td class="text-left">Umi Hidayatul Khasanah, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>29</td>
                    <td>Pengajar</td>
                    <td class="text-left">Wijayanti Maslakah, S.Pd</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="item">
              <table class="table" style="width:70%!important;margin:1px auto 5px auto">
                <thead class="c b">
                  <tr>
                    <th colspan="3" class="text-center bg-light"><h3 style="font-weight: bold;"><span>MTS</span></h3></th>
                  </tr>
                  <tr>
                    <th class="text-center" style="width:10%">No</th>
                    <th class="text-center" style="width:45%">Jabatan</th>
                    <th class="text-center" style="width:45%">Nama</th>
                  </tr>
                </thead>
                <tbody class="a">
                  <tr class="b">
                    <td>1</td>
                    <td>Pengajar</td>
                    <td class="text-left">Rachman Karsono, S. Pd. I</td>
                  </tr>
                  <tr class="b">
                    <td>2</td>
                    <td>Pengajar</td>
                    <td class="text-left">Ahmad Makmun, S.Pd.I</td>
                  </tr>
                  <tr class="b">
                    <td>3</td>
                    <td>Pengajar</td>
                    <td class="text-left">Desi Nur Baeti, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>4</td>
                    <td>Pengajar</td>
                    <td class="text-left">Putri Siami Alfiatun, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>5</td>
                    <td>Pengajar</td>
                    <td class="text-left">Siti Fatimah S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>6</td>
                    <td>Pengajar</td>
                    <td class="text-left">Attiin Machfiroh, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>7</td>
                    <td>Pengajar</td>
                    <td class="text-left">Komiyatun, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>8</td>
                    <td>Pengajar</td>
                    <td class="text-left">Dwi Indah Permata Sari</td>
                  </tr>
                  <tr class="b">
                    <td>9</td>
                    <td>Pengajar</td>
                    <td class="text-left">Firyal Nihalya Salsabila</td>
                  </tr>
                  <tr class="b">
                    <td>10</td>
                    <td>Pengajar</td>
                    <td class="text-left">Febriyan Nur Asti</td>
                  </tr>
                  <tr class="b">
                    <td>11</td>
                    <td>Pengajar</td>
                    <td class="text-left">Aulia Spfiani, S.Pd</td>
                  </tr>
                  <tr class="b">
                    <td>12</td>
                    <td>Pengajar</td>
                    <td class="text-left">Endang Sulastri, A.Md</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="skills" class="section-content">
        <div class="container">
            <div class="row mbxxl">
                <div class="col-lg-12">
                    <h2 class="section-heading"><span>VISI</span> & <span>MISI</span></h2>
                    <div class="line"></div>
                    <h4 style="font-size:30px;" class="section-heading"><span>VISI</span></h4>
                    <p class="section-description">
                      Terwujudnya insan yang memiliki keseimbangan spiritual, intelektual dan moral
                      menuju generasi ulul albab yang berkomitmen tinggi terhadap kemaslahatan umat
                      dengan berlandaskan pengabdian kepada Allah SWT
                      <br>
                      (Qs.3 : 190-191)
                    </p>
                    <h4 style="font-size:30;" class="section-heading"><span>MISI</span></h4>
                    <p class="section-description">
                      Menyelenggarakan proses pendidikan islam yang berorientasi pada mutu,
                      berdaya saing tinggi dan berbasis pada sikap sepiritual,
                      intelektual dan moral guna mewujudkan kader umat yang menjadi rahmatan lil’alamin
                    </p>
                </div>
            </div>
      </div>
    </section>
    <section id="features" class="section-content">
        <div class="container">
            <div class="row mbxxl">
                <div class="col-lg-12">
                    <h2 class="section-heading">Program <span>Kerja</span></h2>
                    <!-- <div class="line"></div> -->
                    <p class="section-description">
                      Yayasan mempunyai maksud dan tujuan di bidang Sosial, Keagamaan dan Kemanusiaan.
                      Untuk mencapai maksud dan tujuan tersebut di atas, Yayasan menjalankan kegiatan sebagai berikut:
                    </p>
                    <div style="width:50%" class="line"></div>
                    <div class="row">
                      <div class="col-12 col-md-6 col-lg-4">
                        <h4 style="font-size:30px;" class="section-heading"><span>Bidang Sosial</span></h4>
                        <table style="font-size:18px;">
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Pendidikan Formal dan Nonformal.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td>Mendirikan dan menyelenggarakan Pendidikan Anak Usia Dini (PAUD) sampai perguruan Tinggi.</td>
                          </tr>
                          <tr>
                          <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                          <td>Study Banding.</td>
                        </tr>
                        </table>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                        <h4 style="font-size:30px;" class="section-heading"><span>Bidang Keagamaan</span></h4>
                        <table style="font-size:18px;">
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Mendirikan dan menyelenggarakan Taman Pendidikan Al Qur’an (TPA).</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td>Mendirikan dan menyelenggarakan Pondok Pesantren dan Madrasah.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td >Menerima dan menyalurkan amal zakat, infak, dan shadaqah.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td >Meningkatkan pemahaman keagamaan.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td >Menyelenggarakan Majelis Taklim.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td >Melaksanakan syiar keagamaan.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                            <td >Study banding keagamaan.</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                        <h4 style="font-size:30px;" class="section-heading"><span>Bidang Kemanusiaan</span></h4>
                        <table style="font-size:18px;">
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Memberi bantuan kepada korban bencana alam.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Pemberian bea siswa bagi murid dari keluarga yang tidak mampu.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Memberi bantuan kepada tuna wisma, fakir miskin dan yatim piatu.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Memberikan bea siswa bagi siswa yang berprestasi.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Menyalurkan bantuan bencana alam.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Menyantuni yatim piatu dan dhuafa.</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top"><i class="fa fa-plus-circle" style="margin-right:10px;" aria-hidden="true"></i></td>
                            <td> Melestarikan lingkungan hidup.</td>
                          </tr>

                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection