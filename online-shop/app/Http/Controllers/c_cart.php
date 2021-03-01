<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;

use App\mod_cart;
use App\mod_buku;

use App\mod_barang_stock;
use App\mod_promo_detail;
use App\mod_promo_view;

use App\mod_promo;
use Illuminate\Http\Request;
use DB;

class c_cart extends Controller
{   
    public function index(Request $request){ 
        $dataval = [];
        $a=array();
        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $allcategories="";
                $countcategories=0;
                $hargajadi=0;
                $getBaseUrlEnv = env('APP_URL');
                $pathPublic = 'storage/';
                $getBaseUrl = 'https://aqwam.com/';
                $urlImage = 'https://admin.aqwam.com/';


                $categories = mod_categories::orderBy('created_at', 'asc')->get();
                $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

                $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
                $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
                $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
                $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
                $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

                $promoview = mod_promo_view::first();
                $promoviewhome = $promoview->type;

                // $cekpromo = mod_promo_detail::where('code_barang', '=', $idBuku )->first();
                
                // if($cekpromo){
                //     $getpromo = mod_promo_detail::where('code_promo', '=', $cekpromo->code_promo )->get();
                //     if(count($getpromo) < 2){
                //          $promo = mod_promo::where('code_promo', '=', $cekpromo->code_promo )->first();
                //          $hargajadi=$promo->harga_jadi;
                //     }
                // }
            
                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    $countCart = $this->getcount($username);
                    $idbukugetcart = mod_cart::where('username', '=', $username)->pluck('id_buku');
                    if($idbukugetcart){  
                        $cart = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover', 'berat')->whereIn('id', $idbukugetcart )->get();
                }
                if($idbukugetcart){
                    $idbukuget = mod_cart::where('username', '=', $username)->where('id_buku','not like', "%promo%")->pluck('id_buku');
                    $cart = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover', 'gambar_buku')->whereIn('id', $idbukuget )->get();
                    $harga = 0;
                    foreach ($cart as $crt){
                        $harga = $crt->harga;                        
                        $cekpromo = mod_promo_detail::where('code_barang', '=', $crt->idBuku)->orderBy('created_at', 'asc')->get();
                        if($promoviewhome == 1){
                            if(count($cekpromo)>0){
                                foreach($cekpromo as $ckp=>$value){
                                    $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                    // dd($getprmdetail);
                                    if(count($getprmdetail) < 2){
                                        $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                        $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                        $harga=$promo->harga_jadi;
                                        // dd($harga.'_'.$cekprmfix->code_promo);
                                    }
                                }                               
                            }
                        }                            
                            $dataval = ['idBuku'=>$crt->idBuku, 'judul_buku'=>$crt->judul_buku, 'harga' => $harga,'berat' => $crt->berat,'gambar_buku' => $crt->gambar_buku, 'penulis' => $crt->penulis, 'isbn' => $crt->isbn , 'cover' => $crt->cover];
                            array_push($a, $dataval);
                        }

                    $idprm = mod_cart::where('username', '=', $username)->where('id_buku','like', "%promo%")->pluck('id_buku');
                    $prm = mod_promo::whereIn('code_promo', $idprm )->get();
                     
                    foreach ($prm as $pr){
                        $harga = 0;

                            $dataval = ['idBuku'=>$pr->code_promo, 'judul_buku'=>$pr->nama_promo, 'harga' => $pr->harga_jadi,'berat' => $pr->berat_total, 'gambar_buku' => $pr->gambar_buku,'penulis' => '-', 'isbn' => '-' , 'cover' => '-'];
                            array_push($a, $dataval);
                        }
                   
                }

                // dd($a);

                    $pathhf = 'api/headerfooter';
                    $pathcs = 'api/categories';

                return view('cart', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
                'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl,'urlImage'=>$urlImage, 'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                'countCart'=>$countCart, 'nama'=>$nama, 'cart'=>$cart,'hargajadi'=>$hargajadi, 'a'=>$a, 'promoviewhome'=>$promoviewhome]);
                
            }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }

        }else{
                $countCart = 'null';
                $nama = 'null';
                $username = 'null';

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
        }          

          
    }
    public function add(Request $request)
    {
        $jumlah = 1;

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username=$request->session()->get('username');

                $getcart = mod_cart::where('username', '=', $username )->where('id_buku', '=', $request->id )->first();
                if($getcart){
                    return 'Buku sudah ada di cart';
                }else{
                    mod_cart::create([
                        // 'mapel' => strtoupper($request->mapel),
                        'username' => $username,
                        'jumlah' => $jumlah,
                        'id_buku' => $request->id,
                    ]);
                    $cartCount = mod_cart::where('username', '=', $username)->count();
                    // $cartCount= $getcart->count();
                    return 'sukses';

                }
            }else{
            return 'login';
            }
        }else{
            return 'login';
        }
    }

    public function getcart(Request $request)
    {
        $urlImage = 'https://admin.aqwam.com/';
         $dataval = [];
        $a=array();
        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username=$request->session()->get('username');
                $promoview = mod_promo_view::first();
                $promoviewhome = $promoview->type;
                
                    $idbuku = mod_cart::where('username', '=', $username)->pluck('id_buku');

                    // $idbuku = mod_kategori_trn_buku::where('id_kategori', '=', $cat )->pluck('id_buku');
                
                if($idbuku){
                    $idbuku = mod_cart::where('username', '=', $username)->where('id_buku','not like', "%promo%")->pluck('id_buku');
                    $cart = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','berat','gambar_buku')->whereIn('id', $idbuku )->get();
                     
                    foreach ($cart as $crt){
                        $harga = 0;
                        $harga = $crt->harga; 
                        $cekpromo = mod_promo_detail::where('code_barang', '=', $crt->idBuku)->orderBy('created_at', 'asc')->get();
                        // $cekidpromo = mod_promo_detail::where('code_barang', '=', $crt->idBuku)->orderBy('created_at', 'asc')->first();
                        
                        if($promoviewhome == 1){
                             if(count($cekpromo)>0){
                                foreach($cekpromo as $ckp=>$value){
                                    $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                    $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                                    // dd($getprmdetail);
                                    if($promodelete->is_del==0){
                                        if(count($getprmdetail) < 2){
                                        $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                        $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                        $harga=$promo->harga_jadi;
                                        // dd($harga.'_'.$cekprmfix->code_promo);
                                    }
                                    }                                    
                                }                               
                            }
                        }
                            $dataval = ['idBuku'=>$crt->idBuku, 'judul_buku'=>$crt->judul_buku, 'harga' => $harga,'berat' => $crt->berat, 'penulis' => $crt->penulis, 'gambar_buku' => $crt->gambar_buku, 'isbn' => $crt->isbn , 'cover' => $crt->cover, 'urlImage' => $urlImage];
                            array_push($a, $dataval);
                        }

                    $idprm = mod_cart::where('username', '=', $username)->where('id_buku','like', "%promo%")->pluck('id_buku');
                    $prm = mod_promo::whereIn('code_promo', $idprm )->get();
                     
                    foreach ($prm as $pr){
                        $harga = 0;

                            $dataval = ['idBuku'=>$pr->code_promo, 'judul_buku'=>$pr->nama_promo, 'harga' => $pr->harga_jadi,'berat' => $pr->berat_total, 'gambar_buku' => $pr->gambar_buku,'penulis' => '-', 'isbn' => '-' , 'cover' => '-', 'urlImage' => $urlImage];
                            array_push($a, $dataval);
                        }
                   
                }
                    // $cartCount= $getcart->count();
                    return $a;  
            }else{
                return 'login';
            }         
        }else{
            return 'login';
        }
    }

    public function getcountcart(Request $request)
    {
        // $username = 'user1';
        // $jumlah = 1;

        // $cartCount = mod_cart::where('username', '=', $username)->count();
                // $cartCount= $getcart->count();
        // return $cartCount;

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
            $username=$request->session()->get('username');
            
                $cartCount = mod_cart::where('username', '=', $username)->count();
                // $cartCount= $getcart->count();
                return $cartCount;    
            }else{
            return 'login';
            }       
        }else{
            return 'login';
        }
    }
    public function getcount($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;
       
    }

    public function delcart(Request $request)
    {

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username=$request->session()->get('username');

                $delete = mod_cart::where('username', '=', $username )->where('id_buku', '=',  $request->id)->delete();
                if($delete){
                    // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
                    $count = mod_cart::where('username', '=', $username )->count(); 
                    return $count;               
                }else{
                    return 'gagal delete';
                }
            }else{
            return 'login';
            }
        }else{
            return 'login';
        }
    }

    public function addcart(Request $request)
    {

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username=$request->session()->get('username');

                $getcart = mod_cart::where('username', '=', $username )->where('id_buku', '=', $request->id )->first();
                if($getcart){
                    return 'Buku sudah ada di cart';
                }else{
                    mod_cart::create([
                        // 'mapel' => strtoupper($request->mapel),
                        'username' => $username,
                        'jumlah' =>$request->jumlah,
                        'id_buku' => $request->id,
                    ]);
                    $cartCount = mod_cart::where('username', '=', $username)->count();
                    // $cartCount= $getcart->count();
                    return 'sukses';

                }
            }else{
            return 'login';
            }
        }else{
            return 'login';
        }
    }
    public function updatecart(Request $request)
    {
        $cek = 0;
        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username=$request->session()->get('username');

                $promoview = mod_promo_view::first();
                $promoviewhome = $promoview->type;

                $data = [];
                $promo = [];
                $list = $request->listmap;
                // dd($list);
                foreach($list as $val=>$value){
                        if($value['jumlah']!=""){
                            if($value['jumlah']!=0){
                                $cek = 1;
                                
                                if(substr($value['id'],0,5)=='promo'){
                                    $promo += [ $value['id'] => $value['jumlah'] ]; 
                                    
                                }else{
                                    $data += [ $value['id'] => $value['jumlah'] ]; 
                                }           
                            }else{
                                return 'gagal, Tidak Bisa Lanjutkan jika di cart ada yg 0';
                                break;
                            }                   
                        }
                        else{
                            return 'gagal, Tidak Bisa Lanjutkan jika di cart ada yg tidak ke Isi';
                            break;
                        }     
                    }
                    // dd(count($data));
                if(count($data)>0){
                    // return $data;

                    $stock = $this->cekstockdb($username,  $data);
                
                    // return $stock;

                    if($stock != 'ready'){
                        return $stock;
                    }else{
                        $cek = 1; 
                    }
                }

                if(count($promo)>0){
                    // return $data;

                    $stock = $this->cekstockpromo($username,  $promo);
                
                    // return $stock;

                    if($stock != 'ready'){
                        return $stock;
                    }else{
                        $cek = 1; 
                    }
                }
                
                

                if($cek==1){
                    foreach($list as $val=>$value){
                            $berat = substr($value['berat'],0,-5);
                            $typeTransaksi = 'regular'; 
                            if(substr($value['id'],0,5)=='promo'){
                                $getallpromo=mod_promo::select('code_promo','pre_order as po','harga_jadi','nama_promo')->where('code_promo', '=',$value['id'])->first();                                 
                                if($getallpromo->po == '1'){
                                    $typeTransaksi = 'preOrder';
                                }
                                $getallpromodetail=mod_promo_detail::select('code_promo','code_barang')->where('code_promo','=',$value['id'])->get(); 
                                $hargaawal=0;           
                                foreach($getallpromodetail as $valdetail){
                                    $bukuprm = mod_buku::select('harga','judul_buku')->where('id','=',$valdetail['code_barang'] )->first();
                                     $hargaawal+=$bukuprm->harga;
                                    mod_cart ::where('id_buku', '=', $value['id'])                             
                                    ->where('username', '=', $username)
                                    ->update(
                                        ['jumlah' => $value['jumlah'], 'harga'=>$getallpromo->harga_jadi, 'harga_awal'=>$hargaawal, 'berat'=>$berat, 'judul_buku'=>$getallpromo->nama_promo, 'typeTransaksi'=>$typeTransaksi]
                                    );
                                }
                            }else{
                                $buku = mod_buku::select('jenis_pre_order_buku as po','harga', 'judul_buku')->where('id','=', $value['id'] )->first();
                                // dd($buku);
                                if($buku->po == '1'){
                                    $typeTransaksi = 'preOrder';
                                }
                                $hargajadi = 0;
                                if($buku->harga){
                                    $hargajadi = $buku->harga;
                                }                                 
                                $cekpromo = mod_promo_detail::where('code_barang', '=', $value['id'])->orderBy('created_at', 'asc')->get();
                                if($promoviewhome == 1){
                                    if(count($cekpromo)>0){
                                        foreach($cekpromo as $ckp=>$val){
                                            $getprmdetail = mod_promo_detail::where('code_promo', '=', $val['code_promo'])->get();
                                            $promodelete = mod_promo::where('code_promo', '=', $val['code_promo'])->first();
                                            if($promodelete->is_del==0){
                                                if(count($getprmdetail) < 2){
                                                $cekprmfix = mod_promo_detail::where('code_promo', '=', $val['code_promo'])->first();
                                                $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                                $hargajadi=$promo->harga_jadi;
                                            }
                                            }                                            
                                        }                               
                                    }
                                }
                                mod_cart ::where('id_buku', '=', $value['id'])                             
                                    ->where('username', '=', $username)
                                    ->update(
                                        ['jumlah' => $value['jumlah'], 'harga'=>$hargajadi, 'harga_awal'=>$buku->harga, 'berat'=>$berat, 'judul_buku'=>$buku->judul_buku, 'typeTransaksi'=>$typeTransaksi]
                                ); 
                            }
                            
                            // 
                                         
                            
                    }
                    return 'sukses';
                    //  return Json(new {redirect='/checkout'}, JsonRequestBehavior.AllowGet);
                }
            }else{
            return 'login';
            }
        }else{
            return 'login';
        }
    }
    public function cekstockdb($username, $list){
            $idbuku = mod_cart::where('username', '=', $username)->where('id_buku', 'not like', '%' . 'promo' . '%' )->pluck('id_buku');
            $getnotcount = mod_barang_stock::select('code_barang',DB::raw('d - k as total'))->whereIn('code_barang', $idbuku)->where('code_gudang', '=', 'Gd_001')->get();
            // return $getnotcount;
            foreach($getnotcount as $val){
                // return $val['code_barang'];
                if($val['total']<1){
                    $buku = mod_buku::select('judul_buku')->where('id','=', $val['code_barang'] )->first();
                    return 'gagal, ('.$val['code_barang'].') '.$buku['judul_buku'].' Stock Baru Saja Habis, Tolong di hapus untuk melanjutkan belanja anda';
                    break;                                     
                }else{ 
                    if($list[$val['code_barang']]>$val['total']){
                            $buku = mod_buku::select('judul_buku')->where('id','=', $val['code_barang'] )->first();
                            return 'gagal, ('.$val['code_barang'].') '.$buku['judul_buku'].' Stock tidak tercukupi, Tolong di kurangi untuk melanjutkan belanja anda';
                            break;
                        }
                }
             }
            return 'ready';
        }
    public function cekstockpromo($username, $list){
            $idpromo = mod_cart::where('username', '=', $username)->where('id_buku', 'like', '%' . 'promo' . '%' )->pluck('id_buku');
            $getallpromo=mod_promo_detail::select('code_promo','code_barang')->whereIn('code_promo', $idpromo)->get();            
            // return $getnotcount;
            foreach($getallpromo as $val){
                // return $val['code_barang'];
               
                $getbuku = mod_barang_stock::select('code_barang',DB::raw('d - k as total'))->where('code_barang','=', $val['code_barang'])->where('code_gudang', '=', 'Gd_001')->first();
                 
                 if($getbuku->total<1){
                    $buku = mod_buku::select('judul_buku')->where('id','=', $val['code_barang'] )->first();
                    return 'gagal, ('.$val['code_barang'].') '.$buku['judul_buku'].' Stock Baru Saja Habis, Tolong di hapus untuk melanjutkan belanja anda';
                    break;                                     
                }else{ 
                    // dd($list);
                    if($list[$val['code_promo']]>$getbuku->total){
                            $buku = mod_buku::select('judul_buku')->where('id','=', $val['code_barang'] )->first();
                            return 'gagal, ('.$val['code_barang'].') '.$buku['judul_buku'].' Stock tidak tercukupi, Tolong di kurangi untuk melanjutkan belanja anda';
                            break;
                        }
                }
             }
            return 'ready';
        }

    
}
