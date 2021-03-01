<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_kategori_inprint;
use App\mod_headerfooter;
use App\mod_kategori_trn_buku;
use App\mod_kategori_inprint_buku;

use Carbon\Carbon;

use App\mod_cart;
use App\mod_buku;
use App\mod_promo;
use App\mod_kategori_promo;
use App\mod_kategori_promo_trn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class c_katalog extends Controller
{
     public function index($cat=null, Request $request)
    {
        $allcategories="";
        $countcategories=0;
        $bukupromo="";
        $buku="Empty";
        $catx='';
        $namacat='';

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '1m4g3st0r3/';
        $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint::orderBy('created_at', 'asc')->get();
            $categoriespromo = mod_kategori_promo::where('status','=',0)->orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();
            
            // dd($categoriesinprint);
        // $categoriesKatalog = $request->categoriesKatalog;

        $dateS = Carbon::now()->startOfMonth()->subMonth(2);
        $dateE = Carbon::now()->startOfMonth(); 

        if(substr($cat,0,5)=='promo')
        {
             $namacatget = mod_kategori_promo::select('kategori as ctgs')->where('id', '=', substr($cat,5))->first();
            $namacat = $namacatget->ctgs;
            $idbuku = mod_kategori_promo_trn::where('id_kategori', '=', substr($cat,5) )->pluck('id_promo');
             if($idbuku){
                 $buku = mod_promo::select('code_promo as idBuku','nama_promo','harga_jadi','gambar_buku')->whereIn('code_promo', $idbuku )->paginate(12);
             }
             $catx='promo';
            
        }elseif(substr($cat,0,2)=='IP'){
             $namacatget = mod_kategori_inprint::select('nama_inprint')->where('id_inprint', '=', $cat)->first();
            $namacat = $namacatget->nama_inprint;
             $idbuku = mod_kategori_inprint_buku::where('id_inprint', '=', $cat )->pluck('id_buku');
            
            if($idbuku){
                 $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->whereIn('id', $idbuku )->paginate(12);
            }
        }elseif($cat=='baru'){
            $namacat = 'Buku Baru';
            $idbuku = '';
            $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->orderBy('updated_at', 'DESC')->whereBetween('updated_at',[$dateS,$dateE])->paginate(12);
        }
        else{
            $namacatget = mod_categories::select('nama_kategori')->where('id_kategori', '=', $cat)->first();
            $namacat = $namacatget->nama_kategori;
            $idbuku = mod_kategori_trn_buku::where('id_kategori', '=', $cat )->pluck('id_buku');
            
            if($idbuku){
                 $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->whereIn('id', $idbuku )->paginate(12);
            }
            
            
        }

        if ($request->session()->has('idUser')){
            $username = $request->session()->get('username');
            $nama = $request->session()->get('nama');
            $countCart = $this->getcountcart($username);
        }else{
            $countCart = 'null';
            $nama = 'null';
            $username = 'null';
        }

        Log::debug('testt');

           
            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';  
            return view('katalog', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'idbuku'=>$idbuku,'buku'=>$buku, 'namacat'=>$namacat,'cat'=>$cat, 'catx'=>$catx, 'bukupromo'=>$bukupromo,  'getBaseUrl'=>$getBaseUrl, 'pathPublic'=>$pathPublic,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1,
             'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'categoriespromo'=>$categoriespromo, 'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
             'countCart'=>$countCart, 'nama'=>$nama]);
    }

    public function indexsearch(Request $request)
    {
        $allcategories="";
        $countcategories=0;
        $bukupromo="";
        $buku="Empty";
        $catx='';
        $namacat='';
        $cat=$request->q;
        $idbuku ='';

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '1m4g3st0r3/';
        $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint::orderBy('created_at', 'asc')->get();
            $categoriespromo = mod_kategori_promo::where('status','=',0)->orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();
            
            // dd($categoriesinprint);
        // $categoriesKatalog = $request->categoriesKatalog;

        $dateS = Carbon::now()->startOfMonth()->subMonth(2);
        $dateE = Carbon::now()->startOfMonth(); 

        
            // $namacatget = mod_categories::select('nama_kategori')->where('id_kategori', '=', $cat)->first();
            // $namacat = $namacatget->nama_kategori;
            // $idbuku = mod_buku::where('judul_buku', 'LIKE', '%'.$cat.'%' )->pluck('id_buku');  
            $namacat=$cat;  
            $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->where('judul_buku', 'LIKE', '%'.$cat.'%' )->paginate(12);        
            // if($idbuku){
                 
            // }

        if ($request->session()->has('idUser')){
            $username = $request->session()->get('username');
            $nama = $request->session()->get('nama');
            $countCart = $this->getcountcart($username);
        }else{
            $countCart = 'null';
            $nama = 'null';
            $username = 'null';
        }

        Log::debug('testt');

           
            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';  
            return view('katalog', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'idbuku'=>$idbuku,'buku'=>$buku, 'namacat'=>$namacat,'cat'=>$cat, 'catx'=>$catx, 'bukupromo'=>$bukupromo,  'getBaseUrl'=>$getBaseUrl, 'pathPublic'=>$pathPublic,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1,
             'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'categoriespromo'=>$categoriespromo, 'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
             'countCart'=>$countCart, 'nama'=>$nama]);
    }

    public function getcountcart($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;
       
    }
}
