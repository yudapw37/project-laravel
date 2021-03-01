<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_kategori_inprint;
use App\mod_headerfooter;
use App\mod_kategori_trn_buku;
use App\mod_kategori_inprint_buku;

use Carbon\Carbon;

use App\mod_topproduct;
use App\mod_cart;
use App\mod_buku;
use App\mod_promo;
use App\mod_promo_detail;
use App\mod_kategori_promo;
use App\mod_kategori_promo_trn;
use App\mod_promo_view;
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
        $dataval = [];
        $a=array();

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';


            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint::orderBy('created_at', 'asc')->get();
            $categoriespromo = mod_kategori_promo::where('status','=',0)->orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;

            // dd($categoriesinprint);
        // $categoriesKatalog = $request->categoriesKatalog;

        $dateS = Carbon::now()->startOfMonth()->subMonth(2);
        $startDay = Carbon::now()->startOfDay();
        $dateE= $startDay->copy()->endOfDay();
        // $dateE = Carbon::now();

        if(substr($cat,0,5)=='promo')
        {
            if($promoviewhome == 0){
                    return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }else{  
                $namacatget = mod_kategori_promo::select('kategori as ctgs')->where('id', '=', substr($cat,5))->first();
                $namacat = $namacatget->ctgs;
                $idbuku = mod_kategori_promo_trn::where('id_kategori', '=', substr($cat,5) )->pluck('id_promo');
                if($idbuku){
                    $buku = mod_promo::select('code_promo as idBuku','nama_promo','harga_jadi','gambar_buku')->whereIn('code_promo', $idbuku )->paginate(12);
                    foreach ($buku as $bk){
                        $hargaawal=0;
                        $getBukuPromoCode = mod_promo_detail::where('code_promo', '=',$bk->idBuku)->pluck('code_barang');
                        $bukupromoharga = mod_buku::select('id as idBuku','harga')->whereIn('id', $getBukuPromoCode)->get();
                        foreach ($bukupromoharga as $bkph){
                            $hargabk = $bkph->harga;
                            $hargaawal +=$hargabk ;
                        }
                        $dataval = ['idBuku'=>$bk->idBuku, 'nama_promo'=>$bk->nama_promo,'harga' => $hargaawal,'harga_jadi' => $bk->harga_jadi,
                                    'gambar_buku' => $bk->gambar_buku];
                        array_push($a, $dataval);
                    }
                }
                $catx='promo';
            }


        }elseif($cat =='allpromo')
        {  
            if($promoviewhome == 0){
                    return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }else{           
                 $buku = mod_promo::select('code_promo as idBuku','nama_promo','harga_jadi','gambar_buku')->where('is_del', '=',0)->paginate(12);
		        $idbuku= mod_promo::paginate(12)->where('is_del', '=',0)->pluck('code_promo');
                 foreach ($buku as $bk){
                    $hargaawal=0;
                    $getBukuPromoCode = mod_promo_detail::where('code_promo', '=',$bk->idBuku)->pluck('code_barang');
                    $bukupromoharga = mod_buku::select('id as idBuku','harga')->whereIn('id', $getBukuPromoCode)->get();
                    foreach ($bukupromoharga as $bkph){
                        $hargabk = $bkph->harga;
                        $hargaawal +=$hargabk ;
                    }
                    $dataval = ['idBuku'=>$bk->idBuku, 'nama_promo'=>$bk->nama_promo,'harga' => $hargaawal,'harga_jadi' => $bk->harga_jadi,
                                'gambar_buku' => $bk->gambar_buku];
                    array_push($a, $dataval);
                 }
            
                $catx='promo';
            }


        }elseif(substr($cat,0,2)=='IP'){
             $namacatget = mod_kategori_inprint::select('nama_inprint')->where('id_inprint', '=', $cat)->first();
            $namacat = $namacatget->nama_inprint;
             $idbuku = mod_kategori_inprint_buku::where('id_inprint', '=', $cat )->pluck('id_buku');

            if($idbuku){
                 $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->whereIn('id', $idbuku )->where('store', '=', 'Y')->paginate(12);

                 foreach ($buku as $bk){
                    $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => 0,
                    'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $bk->gambar_buku];

                    $cekpromo = mod_promo_detail::where('code_barang', '=', $bk->idBuku )->orderBy('created_at', 'asc')->get();

                    if($promoviewhome == 1){
                        
                        if(count($cekpromo)>0){

                            foreach($cekpromo as $ckp=>$value){
                                $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                                if($promodelete->is_del==0){
                                    $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                    if(count($getprmdetail) < 2){
                                        $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                        $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                        $hargajadi=$promo->harga_jadi;
                                        if($promo->gambar_buku=='storage/default/no-image.png'){
                                            $gambarbukupromo = $bk->gambar_buku;
                                        }else{
                                            $gambarbukupromo = $promo->gambar_buku;
                                        }
                                        $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => $hargajadi,
                                        'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $gambarbukupromo];
                                    }
                                }
                            }
                        }
                    }
                   
                   array_push($a, $dataval);
                }
            }
        }elseif($cat=='baru'){
            $namacat = 'Buku Baru';
            $idbuku = '';
            // $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->orderBy('updated_at', 'DESC')->where('store', '=', 'Y')->whereBetween('updated_at',[$dateS,$dateE])->paginate(12);
            
            $varBestSeller = 'new';
            $bestSeller = mod_topproduct::where('kategori', 'like', '%' . $varBestSeller . '%')->pluck('id_buku');
            $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->whereIn('id', $bestSeller )->where('store', '=', 'Y')->orderBy('updated_at', 'DESC')->paginate(12);

            // dd($dateS.'_'.$dateE);
            foreach ($buku as $bk){
                $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => 0,
                'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $bk->gambar_buku];

                $cekpromo = mod_promo_detail::where('code_barang', '=', $bk->idBuku )->orderBy('created_at', 'asc')->get();

                if($promoviewhome == 1){
                        if(count($cekpromo)>0){

                        foreach($cekpromo as $ckp=>$value){
                            $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                            if($promodelete->is_del==0){
                                $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                if(count($getprmdetail) < 2){
                                    $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                    $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                    $hargajadi=$promo->harga_jadi;
                                    if($promo->gambar_buku=='storage/default/no-image.png'){
                                        $gambarbukupromo = $bk->gambar_buku;
                                    }else{
                                        $gambarbukupromo = $promo->gambar_buku;
                                    }
                                    $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => $hargajadi,
                                    'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $gambarbukupromo];
                                }
                            }
                        }
                    }
                }
               
               array_push($a, $dataval);
            }
        }
        elseif($cat=='best'){
            $namacat = 'Best Seller';
            $idbuku = '';
            $varBestSeller = 'best';
            $bestSeller = mod_topproduct::where('kategori', 'like', '%' . $varBestSeller . '%')->pluck('id_buku');
            $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->whereIn('id', $bestSeller )->where('store', '=', 'Y')->orderBy('updated_at', 'DESC')->paginate(12);

            foreach ($buku as $bk){
                $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => 0,
                'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $bk->gambar_buku];

                $cekpromo = mod_promo_detail::where('code_barang', '=', $bk->idBuku )->orderBy('created_at', 'asc')->get();

                if($promoviewhome == 1){
                        if(count($cekpromo)>0){

                        foreach($cekpromo as $ckp=>$value){
                            $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                            if($promodelete->is_del==0){
                                $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                if(count($getprmdetail) < 2){
                                    $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                    $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                    $hargajadi=$promo->harga_jadi;
                                    if($promo->gambar_buku=='storage/default/no-image.png'){
                                        $gambarbukupromo = $bk->gambar_buku;
                                    }else{
                                        $gambarbukupromo = $promo->gambar_buku;
                                    }
                                    $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => $hargajadi,
                                    'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $gambarbukupromo];
                                }
                            }
                        }
                    }
                }
               
               array_push($a, $dataval);
            }
        }
        else{
            $namacatget = mod_categories::select('nama_kategori')->where('id_kategori', '=', $cat)->first();
            $namacat = $namacatget->nama_kategori;
            $idbuku = mod_kategori_trn_buku::where('id_kategori', '=', $cat )->pluck('id_buku');

            if($idbuku){
                 $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->where('store', '=', 'Y')->whereIn('id', $idbuku )->paginate(12);

                 foreach ($buku as $bk){
                    $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => 0,
                    'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $bk->gambar_buku];

                    $cekpromo = mod_promo_detail::where('code_barang', '=', $bk->idBuku )->orderBy('created_at', 'asc')->get();

                    if($promoviewhome == 1){
                            if(count($cekpromo)>0){

                            foreach($cekpromo as $ckp=>$value){
                                $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                                if($promodelete->is_del==0){
                                    $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                    if(count($getprmdetail) < 2){
                                        $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                        $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                        $hargajadi=$promo->harga_jadi;
                                        if($promo->gambar_buku=='storage/default/no-image.png'){
                                            $gambarbukupromo = $bk->gambar_buku;
                                        }else{
                                            $gambarbukupromo = $promo->gambar_buku;
                                        }
                                        $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => $hargajadi,
                                        'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $gambarbukupromo];
                                    }
                                }
                            }
                        }
                    }
                   
                   array_push($a, $dataval);
                }
            }

        }

        $katalogbuku = $a;

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
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'urlImage'=>$urlImage,'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1,
             'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'categoriespromo'=>$categoriespromo, 'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
             'countCart'=>$countCart, 'nama'=>$nama, 'katalogbuku'=>$katalogbuku, 'promoviewhome'=>$promoviewhome]);
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
        $dataval = [];
        $a=array();

        $getBaseUrlEnv = env('APP_URL');
        // $pathPublic = '1m4g3st0r3/';
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint::orderBy('created_at', 'asc')->get();
            $categoriespromo = mod_kategori_promo::where('status','=',0)->orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;

            // dd($categoriesinprint);
        // $categoriesKatalog = $request->categoriesKatalog;

        $dateS = Carbon::now()->startOfMonth()->subMonth(2);
        $dateE = Carbon::now()->startOfMonth();


            // $namacatget = mod_categories::select('nama_kategori')->where('id_kategori', '=', $cat)->first();
            // $namacat = $namacatget->nama_kategori;
            // $idbuku = mod_buku::where('judul_buku', 'LIKE', '%'.$cat.'%' )->pluck('id_buku');
            $namacat=$cat;
            $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->where('judul_buku', 'LIKE', '%'.$cat.'%' )->where('store', '=', 'Y')->paginate(12);

            foreach ($buku as $bk){
               $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => 0,
               'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $bk->gambar_buku];

               $cekpromo = mod_promo_detail::where('code_barang', '=', $bk->idBuku )->orderBy('created_at', 'asc')->get();

               if($promoviewhome == 1){
                    if(count($cekpromo)>0){

                        foreach($cekpromo as $ckp=>$value){
                            $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                            if($promodelete->is_del==0){
                                $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                if(count($getprmdetail) < 2){
                                    $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                    $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                    $hargajadi=$promo->harga_jadi;
                                    if($promo->gambar_buku=='storage/default/no-image.png'){
                                        $gambarbukupromo = $bk->gambar_buku;
                                    }else{
                                        $gambarbukupromo = $promo->gambar_buku;
                                    }
                                    $dataval = ['idBuku'=>$bk->idBuku, 'judul_buku'=>$bk->judul_buku,'harga' => $bk->harga,'harga_jadi' => $hargajadi,
                                    'penulis' => $bk->penulis,'isbn' => $bk->isbn,'cover' => $bk->cover,'gambar_buku' => $gambarbukupromo];
                                }
                            }
                        }
                    }
               }
              
              array_push($a, $dataval);
           }
           // dd($a);
            $katalogbuku = $a;
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

        // Log::debug('testt');


            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';
            return view('katalog', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'idbuku'=>$idbuku,'buku'=>$buku, 'namacat'=>$namacat,'cat'=>$cat, 'catx'=>$catx, 'bukupromo'=>$bukupromo,  'getBaseUrl'=>$getBaseUrl, 'pathPublic'=>$pathPublic,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1,'urlImage'=>$urlImage,
             'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'categoriespromo'=>$categoriespromo, 'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
             'countCart'=>$countCart, 'nama'=>$nama,'katalogbuku'=>$katalogbuku, 'promoviewhome'=>$promoviewhome]);
    }

    public function getcountcart($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;

    }
}
