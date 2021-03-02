@extends('ui.layout.main')

@section('title', 'YPIHMSUBANDI')

@section('body')
<?php $catDaftar= $varTypeDaftar;?>

  <header>
        <div class="bg-overlay pattern">
            <nav role="navigation" style="background-color:rgba(0, 0, 0, 0.64)!important;" class="navbar navbar-custom navbar-fixed-top">
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
        </div>
    </header>

    <section id="about" class="section-content">
      <h2 class="section-heading">Formulir Pendaftaran <span><?php if($catDaftar==1){echo "KBRA";}elseif($catDaftar==2){echo "SDIP";}elseif($catDaftar==3){echo "MTS";} ?></span></h2>
      <div class="line"></div>
      <div class="container" style="">
        <div style="border: 2px solid #ddd;border-radius: 5px; overflow:auto">
          <table class="table table-xl-responsive" style="text-align:left!important;">
<!-- -------------------------------------- REGISTRASI PESERTA DIDIK -------------------------------------- -->
            <tr>
              <td colspan="2" class="text-weight-bold900 bg-gry" style="background-color: #f8f9fa!important" >REGISTRASI PESERTA DIDIK</td>
            </tr>
            <tr>
              <td class="p20"> Jenis Pendaftaran</td>
              <td style="min-width: 400px">
                <select class="form-control" name="jenisPendaftaran">
                  <option>Baru</option>
                  <option>Pindah</option>
                </select>
              </td>
            </tr>
          <?php if ($catDaftar !=1): ?>

            <tr>
              <td class="p20"> Tanggal Masuk Sekolah</td>
              <td>
                <input type="text" name="tanggalMasukSekolah" class="form-control" value="">
              </td>
            </tr>
            <tr>
              <td class="p20"> Apakah Pernah <?php if($catDaftar==2){echo "TK/RA ";}elseif($catDaftar==3){echo "SDIP ";} ?>?</td>
              <td>
                <input type="text" name="pernahMasukSekolah" class="form-control" value="">
              </td>
            </tr>
            <tr>
              <td class="p20"> nama <?php if($catDaftar==2){echo "TK/RA ";}elseif($catDaftar==3){echo "SDIP ";} ?></td>
              <td>
                <input type="text" name="namaPernahMasukSekolah" class="form-control" value="">
              </td>
            </tr>
            <tr>
              <td class="p20"> alamat <?php if($catDaftar==2){echo "TK/RA ";}elseif($catDaftar==3){echo "SDIP ";} ?></td>
              <td>
                <input type="text" name="alamatPernahMasukSekolah" class="form-control" value="">
              </td>
            </tr>
            <tr>
              <td class="p20"> Diterima disekolah ini di Kelas</td>
              <td>
                <input type="text" name="diterimaDisekolah" class="form-control" value="">
              </td>
            </tr>
            <tr>
              <td class="p20"> Pada tanggal</td>
              <td>
                <input type="date" name="padaTanggal" class="form-control" value="">
              </td>
            </tr>
          <?php endif; ?>
<!-- -------------------------------------- REGISTRASI PESERTA DIDIK -------------------------------------- -->
<!-- -------------------------------------------- IDENTITAS ANAK -------------------------------------------- -->

          <tr>
            <td colspan="2" class="text-weight-bold900 bg-gry" >IDENTITAS ANAK</td>
          </tr>
          <tr>
            <td class="p20"> Nama Lengkap</td>
            <td>
              <input type="text" name="namaLengkap" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Nama Panggilan</td>
            <td>
              <input type="text" name="namaPanggilan" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Jenis Kelamin</td>
            <td>
              <select class="form-control" name="jenisKelamin">
                <option>Laki-Laki</option>
                <option>Peremuan</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="p20"> Tempat / Tanggal Lahir</td>
            <td>
              <table style="width:100%">
                <tr>
                  <td><input style="width:98%;float:left" type="text" name="tempatLahir" class="form-control" value=""></td>
                  <td><input style="width:98%;float:right" type="date" name="tanggalLahir" class="form-control" value=""></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="p20"> Agama</td>
            <td>
              <select class="form-control" name="agama">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Budha</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="p20 text-weight-bold text-center" >ALAMAT</td>
          </tr>
          <tr>
            <td class="p20"> Dusun</td>
            <td>
              <table style="width:100%">
                <tr>
                  <td><input style="width:100%;float:left" type="text" name="dusun" class="form-control" value=""></td>
                  <td style="width:23px;padding-left:3px;">Rt</td>
                  <td style="width:40px;"><input  class="form-control" type="text" name="rt" value=""></td>
                  <td style="width:28px; padding-left:3px;">Rw</td>
                  <td style="width:40px;"><input class="form-control" type="text" name="rw" value=""></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="p20"> Keluarahan / Desa</td>
            <td>
              <input type="text" name="desa" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Kecamatan</td>
            <td>
              <table style="width:100%">
                <tr>
                  <td><input style="width:100%;float:left" type="text" name="kecamatan" class="form-control" value=""></td>
                  <td style="width:70px;padding-left:5px;">Kode Pos</td>
                  <td style="width:100px"><input type="text" name="kodePos" class="form-control" value=""></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="p20"> Moda Transportasi</td>
            <td>
              <input type="text" name="transportasi" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> No Telefon</td>
            <td>
              <input type="text" name="noTelp" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Penerima KPS/PKH/KIP</td>
            <td>
              <select class="form-control" onchange="cekKIP(this.value)" name="KIP">
                <option selected disabled> ----- PILIH -----</option>
                <option value="1">Menerima</option>
                <option value="2">Tidak Menerima</option>
              </select>
            </td>
          </tr>
          <tr id='noKIP' class="d-none">
            <td class="p20"> No KPS/PKH/KIP</td>
            <td>
              <input type="text" name="noKIP" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Kewarganegaraan</td>
            <td>
              <input type="text" name="kewarganegaraan" class="form-control" value="">
            </td>
          </tr>

<!-- -------------------------------------------- IDENTITAS ANAK -------------------------------------------- -->
<!-- ---------------------------------------- DATA ORANG TUA / WALI ---------------------------------------- -->

          <tr>
            <td colspan="2" class="text-weight-bold900 bg-gry" >DATA ORANG TUA / WALI</td>
          </tr>
          <tr>
            <td colspan="2" class="p20 text-weight-bold text-center" >DATA AYAH KANDUNG</td>
          </tr>
          <tr>
            <td class="p20"> Nama</td>
            <td>
              <input type="text" name="namaAyah" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Tempat Tanggal Lahir</td>
            <td>
              <table style="width:100%">
                <tr>
                  <td><input style="width:98%;float:left" type="text" name="tempatLahirAyah" class="form-control" value=""></td>
                  <td><input style="width:98%;float:right" type="date" name="tanggalLahirAyah" class="form-control" value=""></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="p20"> Agama</td>
            <td>
              <select class="form-control" name="agamaAyah">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Budha</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="p20"> Pekerjaan</td>
            <td>
              <input type="text" name="pekerjaanAyah" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Penghasilan Bulanan</td>
            <td>
              <input type="text" name="penghasilanAyah" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Pendidikan</td>
            <td>
              <input type="text" name="pendidikanAyah" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="p20 text-weight-bold text-center" >DATA IBU KANDUNG</td>
          </tr>
          <tr>
            <td class="p20"> Nama</td>
            <td>
              <input type="text" name="namaIbu" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Tempat Tanggal Lahir</td>
            <td>
              <table style="width:100%">
                <tr>
                  <td><input style="width:98%;float:left" type="text" name="tempatLahirIbu" class="form-control" value=""></td>
                  <td><input style="width:98%;float:right" type="date" name="tanggalLahirIbu" class="form-control" value=""></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="p20"> Agama</td>
            <td>
              <select class="form-control" name="agamaIbu">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Budha</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="p20"> Pekerjaan</td>
            <td>
              <input type="text" name="pekerjaanIbu" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Penghasilan Bulanan</td>
            <td>
              <input type="text" name="penghasilanIbu" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Pendidikan</td>
            <td>
              <input type="text" name="pendidikanIbu" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="p20 text-weight-bold text-center" >DATA WALI</td>
          </tr>
          <tr>
            <td class="p20"> Nama</td>
            <td>
              <input type="text" name="namaWali" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Tempat Tanggal Lahir</td>
              <td>
                <table style="width:100%">
                  <tr>
                    <td><input style="width:98%;float:left" type="text" name="tempatLahirWali" class="form-control" value=""></td>
                    <td><input style="width:98%;float:right" type="date" name="tanggalLahirWali" class="form-control" value=""></td>
                  </tr>
                </table>
              </td>
          </tr>
          <tr>
            <td class="p20"> Agama</td>
            <td>
              <select class="form-control" name="agamaWali">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Budha</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="p20"> Pekerjaan</td>
            <td>
              <input type="text" name="pekerjaanWali" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Penghasilan Bulanan</td>
            <td>
              <input type="text" name="penghasilanWali" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Pendidikan</td>
            <td>
              <input type="text" name="pendidikanWali" class="form-control" value="">
            </td>
          </tr>
<!-- ---------------------------------------- DATA ORANG TUA / WALI ---------------------------------------- -->
<!-- -------------------------------------------- DATA PERIODIK -------------------------------------------- -->

          <tr>
            <td colspan="2" class="text-weight-bold900 bg-gry" >DATA PERIODIK</td>
          </tr>
          <tr>
            <td class="p20"> Tinggi Badan</td>
            <td>
              <input type="text" name="tinggi" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Berat Badan</td>
            <td>
              <input type="text" name="berat" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Jarak Tempat Tinggal ke Sekolah</td>
            <td>
              <input type="text" name="jarak" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Waktu Tempuh</td>
            <td>
              <input type="text" name="waktu" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Jumlah Saudara Kandung</td>
            <td>
              <input type="text" name="jumlahSaudara" class="form-control" value="">
            </td>
          </tr>
          <tr>
            <td class="p20"> Anak Ke</td>
            <td>
              <input type="text" name="anakKe" class="form-control" value="">
            </td>
          </tr>
          <!-- -------------------------------------------- DATA PERIODIK -------------------------------------------- -->
        </table>
        </div>
      </div>
    </section>
    <footer style="background-color:rgba(0, 0, 0, 0.64)!important;">
        <div class="container">
            <p class="text-center">Cemara IT Salatiga</p>
        </div>
    </footer>
    <!--END CONTENT-->
    <script>
      function cekKIP(id){
        var kip = document.getElementById('noKIP')
        if (id == 1) {
          kip.className = ""
        }else {
          kip.className = "d-none"
        }
      }
    </script>

@endsection
