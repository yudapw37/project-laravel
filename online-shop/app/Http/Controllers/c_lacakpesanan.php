<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_kategori_inprint_buku;
use App\mod_cart;
use App\mod_transaksi;
use App\mod_order;
use App\mod_promo_view;
use Illuminate\Support\Facades\Http;

class c_lacakpesanan extends Controller
{
    // Kode kurir: pos, wahana, jnt, sap, sicepat, jet, dse, first, ninja, lion, idl, rex, ide, sentral

    public function index(Request $request)
    {
        $allcategories="";
        $countcategories=0;
        $reviewer=0;
        $reviewstars=0;
        $ulasan="";
        $dataval = [];
        $a=array();
        $datavalb = [];
        $b=array();
        $datavalc = [];
        $c=array();

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';

        $varNewRelease = 'new';
        $varBestSeller = 'best';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint_buku::orderBy('created_at', 'asc')->get();

	    $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;


            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();
            
            if ($request->session()->has('idUser')){
                $username = $request->session()->get('username');
                $nama = $request->session()->get('nama');
                $countCart = $this->getcountcart($username);
            }else{
                $countCart = 'null';
                $nama = 'null';
                $username = 'null';
            }

            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';
            return view('trace', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 'pathPublic'=>$pathPublic, 'urlImage'=>$urlImage,
            'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
            'countCart'=>$countCart, 'nama'=>$nama, 'promoviewhome'=>$promoviewhome]);
    }

    public function getcountcart($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;

    }

    public function cektrace(Request $request){
        $request->validate([
            'noOrd'=>'required'
            ]);
        $noOrder = $request->noOrd;
        $transaksi = mod_transaksi::where('code_order', '=', $noOrder)->first();
        $order = mod_order::where('id', '=', $noOrder)->first();
        
        if($order){
            $a = $order->expedisi;

            if (strpos($a, '(') != false) {
                $getExplode=explode("(",$a);
                $expedisi = $getExplode[0];
            }else{
                $expedisi = $a;
            }

            $response = Http::asForm()->withHeaders([
                'key' => '33bb31f84e8ed7d793d08db159771b2d'
            ])->post('https://pro.rajaongkir.com/api/waybill', [
                'waybill' => $transaksi->no_resi,
                'courier' => $expedisi
            ]);

            // return $response['rajaongkir']['results'];
            $data = [];
            $a=array();

            $status = $response['rajaongkir']['status']['code'];
            if($status=='200'){
                $results = $response['rajaongkir']['result'];
                // $details = $response['rajaongkir']['results']['details'];
                // $manifest = $response['rajaongkir']['results']['manifest'];
            }
            else{
                $results = 'gagal';
            }
        }
        else{
            $results = 'gagal';
        }
        
        
        return $results;
    
    }
}
