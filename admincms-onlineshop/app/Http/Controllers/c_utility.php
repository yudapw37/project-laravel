<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use http\Env\Response;
class c_utility extends Controller
{
    public static function  url()
    {
        $url = 'http://aqwam.biz.com/';
        return $url;
    }

    public function perusahaan(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_perusahaan')
                ->select('id', 'nama as text')
                ->where('ms_perusahaan', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_perusahaan')
                ->select('id', 'nama as text')
                ->orderBy('nama', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }


    public function jabatan(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_jabatan')
                ->select('id', 'jabatan as text')
                ->where('ms_jabatan', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('jabtan', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_jabatan')
                ->select('id', 'jabatan as text')
                ->orderBy('jabatan', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function judulBuku(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_barang')
                ->select('id', 'judul_buku as text')
                ->where('judul_buku', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('judul_buku', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_barang')
                ->select('id', 'judul_buku as text')
                ->orderBy('judul_buku', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function kategoriBuku(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_kategori_buku')
                ->select('id_kategori as id', 'nama_kategori as text')
                ->where('nama_kategori', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama_kategori', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_kategori_buku')
                ->select('id_kategori as id', 'nama_kategori as text')
                ->orderBy('nama_kategori', 'asc')
            
                ->get();
        }
        return $koridor;
    }

    public static function kategoriPromo(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_kategori_promo')
                ->select('id as id', 'kategori as text')
                ->where('kategori', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('kategori', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_kategori_promo')
                ->select('id as id', 'kategori as text')
                ->orderBy('kategori', 'asc')
                ->get();
        }
        return $koridor;
    }

    public static function promo(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_promo')
                ->select('code_promo as id', 'nama_promo as text')
                ->where('nama_promo', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama_promo', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_promo')
                ->select('code_promo as id', 'nama_promo as text')
                ->orderBy('nama_promo', 'asc')
                ->get();
        }
        return $koridor;
    }


    public static function kategoriBukuList()
    {
        $dtMenu = DB::table('ms_kategori_buku')
        ->select('ms_kategori_buku.id_kategori as id','ms_kategori_buku.nama_kategori as namaKategori')
        ->orderBy('ms_kategori_buku.nama_kategori', 'asc')
        ->get();

    return $dtMenu;
    }

    public static function kategoriBukuInprint()
    {
        $dtMenu = DB::table('ms_inprint_mst')
        ->select('ms_inprint_mst.id_inprint as id','ms_inprint_mst.nama_inprint as namaKategori')
        ->orderBy('ms_inprint_mst.nama_inprint', 'asc')
        ->get();

    return $dtMenu;
    }

    public function getSlider(Request $request)
    {
        try {
            $images = DB::table('ms_slider')
                ->select('id','gambar as filename')
                ->orderBy('created_at','asc')
                ->get();
            return json_encode($images);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    // Gambar
    public function selectImageSlider(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_barang')
                ->select('id', 'judul_buku as text')
                ->where('judul_buku', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('judul_buku', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_barang')
                ->select('id', 'judul_buku as text')
                ->orderBy('judul_buku', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }
}
