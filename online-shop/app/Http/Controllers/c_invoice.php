<?php

namespace App\Http\Controllers;
use App\mod_customer;
use App\mod_invoice;
use App\mod_invoice_detail;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_cart;
use App\mod_admin;
use App\mod_buku;
use App\mod_penerima_alamat;
use App\mod_promo;
use App\mod_promo_detail;
use App\mod_outstandingorder;
use App\mod_outstandingorder_detail;
use App\mod_order;
use App\mod_order_detail;
use App\mod_transaksi;
use App\mod_promo_view;
use Illuminate\Http\Request;

class c_invoice extends Controller
{
    public function index(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $idUser=$request->session()->get('idUser');
                $invoice = mod_invoice::select('id as idInvoice','idOrder','total_harga','biaya_expedisi','totalDiskon','nama_penerima','created_at')->where('code_customer', '=', $idUser )->orderBy('created_at', 'DESC')->skip($page)->take(5)->get(); 
            //     if($idbuku){
            //         // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
            //         $buku = mod_buku::select('id as idBuku','judul_buku','harga','cover')->whereIn('id', $idbuku )
            //         ->skip($page)->take(5)->get();                
            //    }
                if($invoice){
                    return $invoice;
                }
                else{
                    return 'null';
                }
            }else{
            return 'login';
            }            
        }else{
            return 'login';
        }
            
    }
    public function count(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $count = mod_invoice::where('code_customer', '=', $idUser )->count();

        //     if($idbuku){
        //         // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
        //         $count = mod_buku::whereIn('id', $idbuku )->count();                
        //    }
            return $count;
        }else{
            return 'login';
        }
            
    }

    public function add(Request $request)
    {

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');

            // $getwish = mod_wishlist::where('username', '=', $username )->where('id_buku', '=', $request->id )->first();
            // if($getwish){
            //     return 'Buku sudah ada di wishlist';
            // }else{
            //     mod_wishlist::create([
            //         // 'mapel' => strtoupper($request->mapel),
            //         'username' => $username,
            //         'id_buku' => $request->id,
            //     ]);
            //     return 'sukses';

            // }
        }else{
            return 'login';
        }
    }
    public function delete(Request $request){
        $id = $request->id;
        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $idUser=$request->session()->get('idUser');
                $delete = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->delete();
                $deletedetail = mod_invoice_detail::where('code_order', '=', $id)->delete();
                if($delete){
                    // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
                    $count = mod_invoice::where('code_customer', '=', $idUser )->count(); 
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
    public function detail(Request $request){

        $allcategories="";
        $countcategories=0;
        $totalberat=0;
        $totalharga=0;
        $totalbarang=0;
        $totaldiskon=0;
        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';


            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;


            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

            $penerima = mod_penerima_alamat::orderBy('created_at', 'asc')->first();

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                    $idUser=$request->session()->get('idUser');
                    $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
                    $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
                    // return $invdetail;

                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    $countCart = $this->getcount($username);
                    $user = mod_customer::where('username','=',$username)->first();
                    $diskon = $user->diskon;
                    $buku = mod_cart::select('id_buku as idBuku','judul_buku','harga', 'berat', 'jumlah')->where('username', '=', $username)->get();
                    if($buku){  
                        foreach($buku as $val=>$value){
                            $totalberat = $totalberat + ($value['berat'] * $value['jumlah']);
                            $totalharga = $totalharga + $value['harga'] * $value['jumlah'] ;                        
                            $totalbarang =  $totalbarang+ $value['jumlah'];
                        }
                        $totaldiskon = $totalharga - ($diskon * $totalharga)/100 ;
                        $totaldiskonrupiah = "Rp. " . number_format($totaldiskon,2,',','.');
                        $totalhargarupiah = "Rp. " . number_format($totalharga,2,',','.');
                
                        $pathhf = 'api/headerfooter';
                        $pathcs = 'api/categories';

                        return view('invdetail', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
                        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                        'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl,'urlImage'=>$urlImage, 'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                        'countCart'=>$countCart, 'nama'=>$nama, 'buku'=>$buku, 'penerima'=>$penerima, 'totalberat'=>$totalberat, 'totalharga'=>$totalharga,'totalbarang'=>$totalbarang, 
                        'totaldiskon'=>$totaldiskon, 'totaldiskonrupiah'=>$totaldiskonrupiah, 'totalhargarupiah'=>$totalhargarupiah, 'promoviewhome'=>$promoviewhome]);
                }
               }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }
            }else{
                $countCart = 'null';
                $nama = 'null';
                $username = 'null';

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }


        // $id = $request->id;
        // if ($request->session()->has('idUser')){
        //     $idUser=$request->session()->get('idUser');
        //     $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
        //     $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
        //     return $invdetail;
        // }else{
        //     return 'login';
        // }
            
    }

    public function printinv(Request $request, $id){

        $id = $request->id;
        $dataval = [];
        $a=array();
        $listbuku=array();

        $promocode = array("promo");
        $cekparam=0;

       $idUser=$request->session()->get('idUser');
       
        

            // $penerima = mod_penerima_alamat::orderBy('created_at', 'asc')->first();

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                    $allcategories="";
                    $countcategories=0;
                    $totalberat=0;
                    $totalharga=0;
                    $totalbarang=0;
                    $totaldiskon=0;
                    $countCart =0;
                    $penerima ="";
                    $invdetail ='';
                    $getBaseUrlEnv = env('APP_URL');
                    $pathPublic = 'storage/';
                    $getBaseUrl = 'https://aqwam.com/';
                    $urlImage = 'https://admin.aqwam.com/';

                        $categories = mod_categories::orderBy('created_at', 'asc')->get();
                        $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;


                        $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
                        $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
                        $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
                        $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
                        $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

                    $idUser=$request->session()->get('idUser');
                     $kodeAdminTrx = $request->session()->get('kodeAdminTrx');

                    $admin = mod_admin::select('nama','no_telp')->where('kodeAdminTrx', '=', $kodeAdminTrx)->first();
                    $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
                    // $invdetail = $this->getdetailinv($id);
                    // $invdetail=$getinvdetail->a;
                    // dd($invdetail);
                    // return $invdetail;

                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    $countCart = $this->getcount($username);
                    $idbuku = mod_cart::where('username', '=', $username)->pluck('id_buku');
                    if($idbuku){  
                        $cart = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover', 'berat')->whereIn('id', $idbuku )->get();
                    }
                    // $countCart = $this->getcount($username);
                    
                    $pathhf = 'api/headerfooter';
                    $pathcs = 'api/categories';

                    return view('invprint', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
                        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                        'pathPublic'=>$pathPublic, 'urlImage'=>$urlImage,'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                        'countCart'=>$countCart, 'nama'=>$nama, 'cart'=>$cart,'invdetail'=>$invdetail,'inv'=>$inv, 'namaadmin'=>$admin->nama, 'promoviewhome'=>$promoviewhome]);
               }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }
            }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }            
    }
    public function getcount($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;
       
    }

    public function getdetailinv(Request $request){
        $id = $request->id;
        $dataval = [];
        $a=array();
        $listbuku=array();
        $promocode = array("promo");
        $cekparam=0;
        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser'); 
            $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();

         foreach($invdetail as $ord1){
                if($ord1['code_promo']!='-'){
                    $codecek = $ord1['code_promo'];

                    if(!in_array($codecek,$promocode)){
                        // $cPromo += [$ord1['code_promo']=>'1'];
                         
                        array_push($promocode, $codecek);
                        
                        $getpromo = mod_promo::where('code_promo', '=', $ord1['code_promo'] )->first();
                        $idpromodetail = mod_promo_detail::where('code_promo', '=', $ord1['code_promo'] )->pluck('code_barang');
                        $buku1 = mod_buku::select('id as idBuku','judul_buku','berat')->whereIn('id', $idpromodetail )->get();
                        $listbuku=array();
                        foreach($buku1 as $bk){ 
                            array_push($listbuku, $bk['judul_buku']);
                        }

                        $code = $ord1['code_promo'];   
                        $nama = [ 'nama' => $ord1['nama_promo'], 'buku'=> $listbuku];
                        $jumlah = $ord1['jumlah'];
                        $berat =$getpromo->berat_total;
                        $harga = $getpromo->harga_jadi;
                        $diskon = $ord1['diskon'];
                        $total = $ord1['jumlah']*$harga;
                        $dataval = ['code'=>strtoupper($code), 'nama'=>$nama, 'jumlah' => $jumlah,'berat' => $berat, 'harga' => $harga, 'diskon' => $diskon, 'total' => $total ];
                        array_push($a, $dataval);
                    }
                    else{
                        // break;
                    }

                    
                }else{
                    $buku2 = mod_buku::select('id as idBuku','judul_buku','berat')->where('id','=', $ord1['code_barang'] )->first();
                    $code = $buku2->idBuku;
                    $nama = $buku2->judul_buku;
                    $jumlah = $ord1['jumlah'];
                    $berat =$buku2->berat;
                    $harga = $ord1['harga'];
                    $diskon = $ord1['diskon'];
                    $total = $ord1['jumlah']*$ord1['harga'];
                    $dataval = ['code'=>strtoupper($code), 'nama'=>$nama, 'jumlah' => $jumlah, 'berat' => $berat,'harga' => $harga, 'diskon' => $diskon, 'total' => $total ];
                    array_push($a, $dataval);
                }
                
                // break;
            }
            

            $data = ['a'=>$a];
            

            return $data;
        }else{
            return 'login';
        }

         

    }

    public function verif(Request $request, $id){


       $idUser=$request->session()->get('idUser');
       
        // dd($id);

            // $penerima = mod_penerima_alamat::orderBy('created_at', 'asc')->first();

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                    $allcategories="";
                    $countcategories=0;
                    $totalberat=0;
                    $totalharga=0;
                    $totalbarang=0;
                    $totaldiskon=0;
                    $countCart =0;
                    $penerima ="";
                    $getBaseUrlEnv = env('APP_URL');
                    $pathPublic = 'storage/';
                    $getBaseUrl = 'https://aqwam.com/';
                    $urlImage = 'https://admin.aqwam.com/';

                        $categories = mod_categories::orderBy('created_at', 'asc')->get();
                        $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;


                        $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
                        $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
                        $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
                        $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
                        $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

                    $idUser=$request->session()->get('idUser');
                    $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
                    $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
                    // return $invdetail;

                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    // $countCart = $this->getcount($username);
                    $user = mod_customer::where('username','=',$username)->first();
                    $diskon = $user->diskon;
                    $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
                    $discinv = $inv->totalDiskon;
                    $totalharga = $inv->total_harga;
                    $biayaexpedisi = $inv->biaya_expedisi;

                    $totalbayar = $totalharga + $biayaexpedisi -  $discinv;
                    $hasil_rupiah = "Rp " . number_format($totalbayar,2,',','.');

                    $pathhf = 'api/headerfooter';
                    $pathcs = 'api/categories';
                return view('confirm', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
                        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                        'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'urlImage'=>$urlImage,'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                        'countCart'=>$countCart, 'nama'=>$nama,  
                        'id'=>$id, 'totalbayar'=>$totalbayar, 'hasil_rupiah'=>$hasil_rupiah, 'promoviewhome'=>$promoviewhome]);
               }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }
            }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }


        // $id = $request->id;
        // if ($request->session()->has('idUser')){
        //     $idUser=$request->session()->get('idUser');
        //     $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
        //     $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
        //     return $invdetail;
        // }else{
        //     return 'login';
        // }
            
    }
    public function bayar(Request $request){
        if ($request->session()->has('idUser')){
            $request->validate([
                'file'=>'required',
                'bank'=>'required'
            ]);
                
            $code = $request->idinv;
            $bank = $request->bank;
            $file = $request->file;
            $fileget2=$_FILES['file']['name'];
            
            // dd($request->idinv);

            if($request->file){
                $fileget = $request->file('file');
                
                $ext = $file->getClientOriginalExtension();

                $nama_file = $code."_".time().".".$ext;
                // dd($fileget2.'__'.$fileget.'__'.$ext.'__'.$nama_file);
                $tujuan_upload = 'uploads';
                $file->move($tujuan_upload,$nama_file);
            }
            else{$nama_file="-";}

            $geturl = $this->url();
            $namadb = $geturl.$nama_file;
                // dd();
            $inv= mod_outstandingorder::where('idOrder','=', $code)->first();
            $invdetail= mod_outstandingorder_detail::where('code_order','=', $code)->get();
            // dd($inv);
            mod_order::create([
                'id' => $inv->idOrder,
                'code_customer' => $inv->code_customer,
                'expedisi' => $inv->expedisi,
                'biayaExpedisi' => $inv->biaya_expedisi,
                'totalDiskon' => $inv->totalDiskon,
            	'total_barang' => $inv->total_barang,
                'total_harga' => $inv->total_harga,
                'nama_pengirim' => $inv->nama_pengirim,
                'telephone_pengirim' => $inv->telephone_pengirim,
                'status_alamat' => 0,
                'nama_penerima' => $inv->nama_penerima,
                'telephone_penerima' => $inv->telephone_penerima,
                'alamat' => $inv->alamat,
            	'kecamatan' => $inv->kecamatan,
                'kab_kota' => $inv->kab_kota,
                'propinsi' => $inv->propinsi,
                'image' => $namadb,
                'lunas' => 0,
                'codeGudang' => $inv->codeGudang,
                'bank' => $request->bank,
                'diskonKodeUnik' => $inv->diskonKodeUnik
            ]);
            mod_transaksi::create([
                'code_order' => $inv->idOrder,
                'code_perusahaan' => "1",
                'kodeAdminTrx' => $inv->kodeAdminTrx,
                'kode_AWO' => "-",
            	'approve_sales' => 0,
                'approve_keuangan' => 0,
                'approve_sales2' => 0,
                'approve_gudang' => 0,
                'no_resi' => "-",
                'hold' => 0,
                'code_status' => 1,
                'typeTransaksi' => $inv->typeTransaksi,
            	'keterangan' => "-",
                'cetak' => 0
            ]);

            foreach($invdetail as $invd){ 
                mod_order_detail::create([
                'code_order' => $inv->idOrder,
                'code_barang' => $invd['code_barang'],
                'code_promo' => $invd['code_promo'],
                'nama_promo' => $invd['nama_promo'],
            	'jumlah' => $invd['jumlah'],
                'harga' => $invd['harga'],
                'harga_promo' => $invd['harga_promo'],
                'diskon' => $invd['diskon'],
                'status_barang' => 0,
                'keterangan' => "-"
                ]);
            }

            mod_outstandingorder::where('idOrder', $inv->idOrder)->delete();
            mod_outstandingorder_detail::where('code_order', $inv->idOrder)->delete();
          
            return redirect('/akun')->with('status', 'Berhasil');
        }else{
            return redirect('/')->with('statusLogin', 'Login Dahulu!');
        }

        
    }

    public function url(){
        return 'aqwam.com/uploads/';
    }
}
