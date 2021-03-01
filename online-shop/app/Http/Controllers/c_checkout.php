<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_penerima_alamat;

use App\mod_kode_ro;
use App\mod_customer;
use App\mod_cart;
use App\mod_buku;
use App\mod_promo_detail;
use App\mod_promo;
use App\mod_order;
use App\mod_transaksi;

use App\mod_diskon;
use App\mod_outstandingorder;
use App\mod_outstandingorder_detail;
use App\mod_barang_stock;
use App\mod_promo_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use GuzzleHttp\Psr7;

class c_checkout extends Controller
{
    public function index(Request $request){
        $allcategories="";
        $countcategories=0;
        $totalberat=0;
        $totalharga=0;
        $totalbarang=0;
        $totaldiskon=0;
        $cekpenerima = '';
        $newdisc = 0;
        $getBaseUrlEnv = env('APP_URL');
        // $pathPublic = '1m4g3st0r3/';
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

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                 $idUser = $request->session()->get('idUser');
                $username = $request->session()->get('username');
                $penerima = mod_penerima_alamat::where('code_customer','=',$idUser)->orderBy('created_at', 'asc')->first();
                if($penerima==null){$cekpenerima = '';}else{$cekpenerima = 'ready';}
                // dd($cekpenerima);
                $jenis_reseller = $request->session()->get('jenis_reseller');
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
                    $newdisc = $this->cekdiskon($totalharga, $jenis_reseller, $diskon);
                    if($newdisc==0){
                        $totaldiskon = 0 ;
                    }else{
                       $totaldiskon = ($newdisc * $totalharga)/100 ; 
                    }

                    $totaldiskonrupiah = "Rp. " . number_format($totaldiskon,2,',','.');
                    $totalhargarupiah = "Rp. " . number_format($totalharga,2,',','.');
                    $digits = 3;
                    $discrand = 0;
                    //$discrand = rand(pow(10, $digits-1), pow(10, $digits)-1);	
		    $discrand = mt_rand(100, 500);
                    $discrandrupiah = "Rp. " . number_format($discrand,2,',','.');
                    $request->session()->put('discrand', $discrand);
                    $disckupon = 0;

                    $pathhf = 'api/headerfooter';
                    $pathcs = 'api/categories';

                    return view('checkout', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv,
                    'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                    'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'urlImage'=>$urlImage,'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                    'countCart'=>$countCart, 'nama'=>$nama, 'buku'=>$buku, 'penerima'=>$penerima, 'totalberat'=>$totalberat, 'totalharga'=>$totalharga,'totalbarang'=>$totalbarang,
                    'totaldiskon'=>$totaldiskon, 'totaldiskonrupiah'=>$totaldiskonrupiah, 'totalhargarupiah'=>$totalhargarupiah , 'totalbarang'=>$totalbarang,
                    'newdisc'=>$newdisc, 'discrand'=>$discrand,'discrandrupiah'=>$discrandrupiah,'cekpenerima'=>$cekpenerima, 'promoviewhome'=>$promoviewhome]);
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


    }
   public function getcount($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;

    }

    // public function getcostawal($destination, $weight){
    //     //Ambil Sebelum Pilih Alamat Lain
    //      $response = Http::asForm()->withHeaders([
    //                         'key' => '33bb31f84e8ed7d793d08db159771b2d'
    //                     ])->post('http://test.com/users', [
    //                         'origin' => '445',
    //                         'originType ' => 'subdistrict',
    //                         'destination' => $destination,
    //                         'destinationType' => 'subdistrict',
    //                         'weight' => $weight,
    //                         'courier' => 'jne:pos:tiki:jnt:pahala:sap:jet:indah:wahana:lion:sicepat',
    //                     ]);

    //         return $response['rajaongkir'];
    // }

    // https://app.moota.co/api/v2/mutation?type=&bank=6QdkNZ7KkeZ&amount=&description=&note=&date=&start_date=&end_date=&page=

    public function getmoota(Request $request){
        $dataord = [];
        $data = [];
        $listord=array();
        $listmoota=array();
        $yesterday=date('Y-m-d',strtotime("-5 days"));
        $now=date('Y-m-d',strtotime("-4 days"));

        $code_order=mod_transaksi::whereBetween('created_at', [$yesterday, $now])->where('approve_sales','=',0)->where('code_status','=',1)->pluck('code_order');
        $getOrder=mod_order::select('id as idOrder','biayaExpedisi','totalDiskon', 'total_harga', 'diskonKodeUnik')->whereIn('id', $code_order )->get();
        foreach($getOrder as $val=>$value){
            $total = $value['total_harga']+$value['biayaExpedisi']-$value['totalDiskon']-$value['diskonKodeUnik'];
            $newid = $value['idOrder'];
            $valharga = substr($total,0);
            $dataord += [$newid => $valharga];
        }

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJucWllNHN3OGxsdyIsImp0aSI6ImMxNTA3ZDgzNGEyZDEzZjkxZGQ3ZTAyZjhhMGE4NmE5MTcxMzMwNzA0NmZmOWE1Yzk2ODNjMTg0MWI3MzcwNGZjNDJiMzY3YjY0NWNiN2U5IiwiaWF0IjoxNjA1MjM0MTM4LCJuYmYiOjE2MDUyMzQxMzgsImV4cCI6MTYzNjc3MDEzOCwic3ViIjoiMTQ5MjMiLCJzY29wZXMiOlsiYXBpIiwidXNlciIsInVzZXJfcmVhZCIsImJhbmsiLCJiYW5rX3JlYWQiLCJtdXRhdGlvbiIsIm11dGF0aW9uX3JlYWQiXX0.p0P6wqHQ7Gutjubdud07sMSHRt7HA9Mi_xJPNozADXn_g1kIBgX3AEhZWIfOGDLQfhH8E5WQpM4vUmoJf5TFxIDKmpFSX4a_Eg5YI5wV8tONUHj7o3GhXJNfIKkTHN9wE3qCjp0Uw6TZZ7qr164TkNHiWMLtVX7AETzaom6f7_h0A4VBj6EOO6aUwx9Y1app60MsPBh6mzW6SfgrbQCsS2EOpArwZH0wwMc3yw11XInhaAryobZcYRu0vo41Jb3vIHKwqUWzHOyuOG7tCV0frrs5rhDcEQzh7mYxucI88ysT3VjbBexf_f6scxcuE1IPBAap9qKNchtIjuI-cA1Pxl22kPyIiUg51cCQ-vqudM2mRKSI31oEC3LGyl79Ysl9GyW72RwEvAhmtpt6fEgHMeyIU-as1csHxqZiliW_u2a7VCO5Coe-RBKd9Z1M4IOoTYY5WxTdYmoe1rh7KEOt2mUL6EwGNSMCTMpGPIByLh06BBcmbYOln0rpU-H-Dfo-Ny75qUgq7cndnjSXHl6Xm1JN9re_N6IAGWmXxO1JiczsMC6Zp_LksNTscCTg-d5hd-sMjk8qOEe0D05EWE4mOLpshq4b2HUCD0pyjIixwr4Lr1IaeqB_t0Iu97_0kaZ4iumjvH19OPi9prwS4LVtoyaLbY_R0Oh08-OaZHWuuQ8',
            'Accept' => 'application/json'
        ])->get('https://app.moota.co/api/v2/mutation', [
             'bank' => '6QdkNZ7KkeZ',
             'start_date' => $yesterday,
             'end_date' => $now,          
        ]);
        $result = $response['data'];
        // return $dataord;
        foreach($result as $val=>$value){
            $key = array_search(substr($value['amount'],0,-3), $dataord);            
                if($key){                 
                    $idOrder=$key;                    
                    array_push($listmoota, $idOrder);
                    mod_transaksi::where('code_order', '=',$idOrder)
                    ->update(
                            ['approve_sales' => 1,
                            'approve_keuangan' => 1,
                            'code_status' => 5,
                            'keterangan' => 'Verifikasi Moota',
                            'verifikasiPembayaran' => 'Verifikasi Moota',
                            'idMoota' => 'moota_'.$value['mutation_id'].'_'.$value['bank']['label'].'('.$value['bank']['account_number'].')'.'_'.$value['created_at']]
                        );
                }
                // $data = ['mutation_id' => $value['mutation_id'], 'amount'=>$value['amount'], 'desc' => 'moota_'.$value['bank_id'].'_'.$value['bank']['label'].'('.$value['bank']['account_number'].')'.'_'.$value['created_at'],'bank_id' => $value['bank_id'], 'created_at' => $value['created_at'] ];
                // array_push($listmoota, $data);
            }
            return $listmoota;        
    }

    public function getcostrajaongkir(Request $request){
            $berat = substr($request->weight,0,-5);

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
            $username=$request->session()->get('username');
            $origin = '445';
            $destination = $request->destination;
            $weight = $berat;
            $int = (int)$berat;
            if($int>50000){
                $courier = 'jne:tiki:jnt:indah:wahana:lion';
            }else{
                $courier = 'jne:pos:tiki:jnt:indah:wahana:lion';
            }

            return $this->ongkirro($origin,$destination,$weight, $courier);
            // dd($request->session());

            }
            else{
                return 'login';
            }
        }
        else{
            return 'login';
        }
    }

    public function ongkirro($origin,$destination,$weight, $courier){
        $response = Http::asForm()->withHeaders([
            'key' => '33bb31f84e8ed7d793d08db159771b2d'
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin,
            'originType' => "city",
            'destination' => $destination,
            'destinationType' => 'subdistrict',
            'weight' => $weight,
            'courier' => $courier,
        ]);

        // return $response['rajaongkir']['results'];
        $data = [];
        $a=array();

        $resMapCosts = $response['rajaongkir']['results'];
        // $kurirPilih =$value;
        foreach($resMapCosts as $keyMap => $valMap){
            $listCosts = $valMap['costs'];
            $listCode = $valMap['code'];
            if ($listCode == 'J&T') {
            $listCode = 'J&T';
            }
            foreach($listCosts as $keyMapCosts => $valMapCosts){
                $listService = $valMapCosts['service'];
                $listBiaya = $valMapCosts['cost'][0]['value'];
                $data = ['id'=>strtoupper($listCode), 'service'=>$listService, 'harga' => $listBiaya ];
                array_push($a, $data);
            }

        }
        return $a;
    }

    public function getongkirmanual(Request $request)
    {
        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){

            $admin = mod_kode_ro::where('kode_ro', '=', $request->kode)->first();
            if($admin){
                return $admin;
            }else{
                return 'login';
            }

            }else{
            return 'login';
            }

        }else{
            return 'login';
        }

    }

    public function addinvoice(Request $request){
        $totalberat=0;
        $totalharga=0;
        $totalbarang=0;
        $totaldiskon=0;
        $newdisc=0;
        $totaldiskonrupiah='';
        $totalhargarupiah='';
        $data = [];
        $promo = [];
        $cekstock=1;
        $stockbuku='';
        $stockpromo='';

        if ($request->session()->has('idUser')){
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $request->validate([
                    'expedisi'=>'required',
                    'biaya_expedisi'=>'required',
                    'nama_pengirim'=>'required|max:200|min:1|',
                    'telephone_pengirim'=>'required|max:20|min:5|',
                    'nama_penerima'=>'required|max:200|min:1|',
                    'telephone_penerima'=>'required|max:20|min:5|',
                    'alamat'=>'required|max:1500|min:5|',
                    'kecamatan'=>'required|max:1500|min:5|'
                ]);
                $username=$request->session()->get('username');
                $jenis_reseller=$request->session()->get('jenis_reseller');
                $user = mod_customer::where('username','=',$username)->first();
                $diskon = $user->diskon;
                $discrandom=$request->session()->get('discrand');

                $kodeAdminTrx = $request->session()->get('kodeAdminTrx');
                $code_customer = $request->session()->get('idUser');
                 $buku = mod_cart::select('id_buku as idBuku','judul_buku','harga', 'berat', 'jumlah')->where('username', '=', $username)->get();
                if(count($buku)>0){
                    foreach($buku as $val=>$value){
                        $totalberat = $totalberat + ($value['berat'] * $value['jumlah']);
                        $totalharga = $totalharga + $value['harga'] * $value['jumlah'] ;
                        $totalbarang =  $totalbarang+ $value['jumlah'];

                                if(substr($value['idBuku'],0,5)=='promo'){
                                    $promo += [ $value['idBuku'] => $value['jumlah'] ];
                                }else{
                                    $data += [ $value['idBuku'] => $value['jumlah'] ];
                                }
                    }
                    $newdisc = $this->cekdiskon($totalharga, $jenis_reseller, $diskon);
                    if($newdisc==0){
                        $totaldiskon = 0 ;
                    }else{
                       $totaldiskon = ($newdisc * $totalharga)/100 ;
                    }
                    // $totaldiskon = $totalharga - ($newdisc * $totalharga)/100 ;
                    $totaldiskonrupiah = "Rp. " . number_format($totaldiskon,2,',','.');
                    $totalhargarupiah = "Rp. " . number_format($totalharga,2,',','.');
                }
                else{
                    return 'session';
                }
                

                if(count($data)>0){
                     $stockbuku = $this->cekstockdb($username,  $data);
                     if($stockbuku!='ready'){$cekstock=0;return $stockbuku;}else{$cekstock=1;}
                }
                if($cekstock==1){
                    if(count($promo)>0){
                            $stockpromo = $this->cekstockpromo($username,  $promo);
                            if($stockpromo!='ready'){$cekstock=0;return $stockpromo;}else{$cekstock=1;}
                        }
                }

                if($cekstock==1){
                    $idorder=$this->generateid($kodeAdminTrx);
                    $invdetail=$this->createinvdetail($idorder, $newdisc,$username);

                    $typeTransaksi = $invdetail;
                    $expedisi=$request->expedisi;
                    $biaya_expedisi=$request->biaya_expedisi;
                    $nama_pengirim=$request->nama_pengirim;
                    $telephone_pengirim=$request->telephone_pengirim;
                    $nama_penerima=$request->nama_penerima;
                    $telephone_penerima=$request->telephone_penerima;
                    $alamat=$request->alamat;
                    $kecamatan=$request->kecamatan;
                    $keyro=$request->keyro;
                    $mnongkir=$request->mnongkir;
                    $valmanual=$request->valmanual;

                    // dd($idOrder)

                    $inv=$this->createinv($username,$newdisc, $idorder,$kodeAdminTrx,$typeTransaksi,$code_customer,$expedisi,$biaya_expedisi
                                ,$nama_pengirim,$telephone_pengirim,$nama_penerima,$telephone_penerima, $alamat,$kecamatan, $keyro,$mnongkir,$valmanual,
                            $totalberat,$totalharga, $totaldiskon,$totaldiskonrupiah,$discrandom,$totalhargarupiah,  $totalbarang);

                    if($inv=='sukses'){
                        $update = $this->updateso($username);
                                                
                        if($update=='sukses'){
                            if($newdisc>$diskon){
                                mod_customer ::where('username', '=', $username)
                                    ->update(
                                        ['diskon' => $newdisc]
                                    ); 
                            }
                            $res=mod_cart::where('username','=', $username)->delete();
                            $request->session()->forget('discrand');
                            return 'sukses';
                        }else{
                            return 'login';
                        }
                    }
                    
                }


            }else{
                return 'login';
            }

        }else{
            return 'login';
        }
    }

    public function createinv($username, $diskon,$idOrder,$kodeAdminTrx,$typeTransaksi,$code_customer,$expedisi,$biaya_expedisi
    ,$nama_pengirim,$telephone_pengirim,$nama_penerima,$telephone_penerima,$alamat,$kecamatan,$keyro,$mnongkir,$valmanual, $totalberat,$totalharga,
    $totaldiskon,$totaldiskonrupiah,$discrandom,$totalhargarupiah,  $totalbarang){


        // ['idOrder', 'kodeAdminTrx', 'totalDiskon', 'typeTransaksi', 'code_customer', 'expedisi', 'biaya_expedisi',
        //'total_barang', 'total_harga', 'nama_pengirim', 'telephone_pengirim','nama_penerima',
        //  'telephone_penerima', 'alamat', 'kecamatan', 'kab_kota', 'propinsi', 'codeGudang'];
        $teks = $kecamatan;
        //pecah string berdasarkan string ","
        $pecah = explode(",", $teks);
        $kec = $pecah[0];
        $kab = $pecah[1];
        $prov = $pecah[2];


        // dd($telephone_pengirim.'-'.$valmanual);
        if($mnongkir=='false'){
            $origin = '445';
            $destination = $keyro;
            $weight = $totalberat;
            $kurir = explode("(", $expedisi);
            $service =explode(")", substr($expedisi,strlen($kurir[0])+1));

            if(strtolower(substr($kurir[0],0,-1))=='j&t'){
                $courier='jnt';
            }else{$courier=strtolower(substr($kurir[0],0,-1));}
            // dd($courier.'-'.$destination.'-'.$weight.'-'.$service[0]);
            $getongkirro=$this->ongkirro($origin,$destination,$weight, $courier);
            foreach ($getongkirro as  $z) {
                if($service[0]==$z['service']){
                    $biayaexpedisi = $z['harga'];
                    //   dd();
                }
            }

        }else{
            $admin = mod_kode_ro::where('kode_ro', '=', $valmanual)->first();
            $courier=$admin->expedisi;
            $biayaexpedisi=$admin->total_harga;
        }



        mod_outstandingorder::create([
            // 'mapel' => strtoupper($request->mapel),
            'idOrder' => $idOrder,
            'kodeAdminTrx' =>$kodeAdminTrx,
            'totalDiskon' => $totaldiskon,
            'typeTransaksi' => $typeTransaksi,
            'code_customer' =>$code_customer,
            'expedisi' => $courier,
            'biaya_expedisi' => $biayaexpedisi,
            'total_barang' =>$totalbarang,
            'total_harga' => $totalharga,
            'nama_pengirim' =>$nama_pengirim,
            'telephone_pengirim' => $telephone_pengirim,
            'nama_penerima' =>$nama_penerima,
            'telephone_penerima' => $telephone_penerima,
            'alamat' =>$alamat,
            'kecamatan' => $kec,
            'kab_kota' => $kab,
            'propinsi' =>$prov,
            'diskonKodeUnik' =>$discrandom,
            'invStore' => 1,
            'codeGudang' => 'Gd_001',
        ]);



        return 'sukses';
    }
    public function createinvdetail($idOrder, $diskon, $username){
        $typeTransaksi = 'regular';
        $buku = mod_cart::select('id_buku as idBuku','judul_buku','harga','harga_awal', 'berat', 'jumlah', 'typeTransaksi')->where('username', '=', $username)->get();
        foreach($buku as $bk){
            // dd(substr($bk['idBuku'],0,5));
            if(substr($bk['idBuku'],0,5)=='promo'){
                $promodetail = mod_promo_detail::select('code_barang')->where('code_promo', '=', $bk['idBuku'])->get();
                // $promo = mod_promo::select('nama_promo ','harga_jadi','berat_total')->where('code_promo', '=', $bk['idBuku'])->first();
                foreach($promodetail as $pd){
                    mod_outstandingorder_detail::create([
                        // 'mapel' => strtoupper($request->mapel),
                        'code_order' => $idOrder,
                        'code_barang' =>$pd['code_barang'],
                        'code_promo' => $bk['idBuku'],
                        'nama_promo' => $bk['judul_buku'],
                        'jumlah' =>$bk['jumlah'],
                        'harga' => $bk['harga_awal'],
                        'harga_promo' => $bk['harga'],
                        'diskon' =>$diskon,
                        'keterangan' => '-',
                    ]);
                }

            }else{

                mod_outstandingorder_detail::create([
                        // 'mapel' => strtoupper($request->mapel),
                        'code_order' => $idOrder,
                        'code_barang' =>$bk['idBuku'],
                        'code_promo' => '-',
                        'nama_promo' => '-',
                        'jumlah' =>$bk['jumlah'],
                        'harga' => $bk['harga'],
                        'harga_promo' => '0',
                        'diskon' =>$diskon,
                        'keterangan' => '-',
                    ]);

            }
            if($bk['typeTransaksi']=='preOrder'){
                $typeTransaksi='preOrder';
            }
        }

        return $typeTransaksi;
        // ['code_order', 'code_barang', 'code_promo', 'nama_promo', 'jumlah', 'harga', 'harga_promo', 'diskon', 'keterangan'];
    }

    public function updateso($username){
        $buku = mod_cart::select('id_buku as idBuku', 'jumlah')->where('username', '=', $username)->get();
         foreach($buku as $bk){
            if(substr($bk['idBuku'],0,5)=='promo'){
                $promodetail = mod_promo_detail::select('code_barang')->where('code_promo', '=', $bk['idBuku'])->get();
                foreach($promodetail as $prm){
                    $valK = 0;
                    $getK=mod_barang_stock::select('k')->where('code_barang', '=',$prm['code_barang'])->where('code_gudang', '=', 'Gd_001')->first();
                    $valK = $getK->k + $bk['jumlah'];
                    mod_barang_stock::where('code_barang', '=',$prm['code_barang'])
                    ->where('code_gudang', '=', 'Gd_001')
                    ->update(
                                    ['k' => $valK]
                            );
                }
            }
            else{
                $valK = 0;
                    $getK=mod_barang_stock::select('k')->where('code_barang', '=',$bk['idBuku'])->where('code_gudang', '=', 'Gd_001')->first();
                    $valK = $getK->k + $bk['jumlah'];
                    mod_barang_stock::where('code_barang', '=',$bk['idBuku'])
                    ->where('code_gudang', '=', 'Gd_001')
                    ->update(
                                    ['k' => $valK]
                            );

            }
        }
        return 'sukses';
    }

    public function generateid($kodeAdminTrx)
    {
        $ldate = date('Y');

                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('H');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);


            if($ldate1=='01')
            {
                $bulan = 'A';
            }
            else if($ldate1=='02')
            {
                $bulan ='B';
            }
            else if($ldate1=='03')
            {
                $bulan ='C';
            }
            else if($ldate1=='04')
            {
                $bulan ='D';
            }
            else if($ldate1=='05')
            {
                $bulan ='E';
            }
            else if($ldate1=='06')
            {
                $bulan ='F';
            }
            else if($ldate1=='07')
            {
                $bulan='G';
            }
            else if($ldate1=='08')
            {
                $bulan='H';
            }
            else if($ldate1=='09')
            {
                $bulan='I';
            }
            else if($ldate1=='10')
            {
                $bulan='J';
            }
            else if($ldate1=='11')
            {
                $bulan='K';
            }
            else if($ldate1=='12')
            {
                $bulan='L';
            }

                $id_rec = 'ORD-'.$tahun.$bulan.$ldate2.'-'.$ldate3.$ldate4.$ldate5.substr($kodeAdminTrx,0,2);
                return $id_rec;
    }
    public function explode($data, $urutan){
        //  $teks = "Mangga,Apel,Durian";
         $teks = $data;

            $exp = explode(",", $teks);

        // $hasil = $pecah[0];
        $hasil = $exp[$urutan];

        return $hasil;
    }
    public function cekdiskon($total, $jenis_reseller,$diskonawal){
        $diskon1 = mod_diskon::where('jenis_user','=',$jenis_reseller)->get();
        $setnewdisc = 0 ;
        if($diskon1){
            foreach($diskon1 as $disc){
            // dd($disc['rangeMin'].','.$disc['rangeMax'].','.$total);
                if($disc['rangeMin']<$total && $disc['rangeMax']>$total){
                    if($diskonawal<$disc['diskon']){
                        // dd($disc['rangeMin'].','.$disc['rangeMax'].','.$total.','.$diskonawal.','.$disc['diskon']);
                        $setnewdisc=$disc['diskon'];
                        break;
                    }else{
                        $setnewdisc=$diskonawal;
                    }

                }else{
                    $setnewdisc=$diskonawal;
                }
            }
        }

        return $setnewdisc;
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
