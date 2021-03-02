<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class c_invoice extends Controller
{
    public function getKecamatan(Request $request){
        $val = $request->val;
        try {
            $query =
                DB::table('ms_alamat_ro')
                ->select('id_alamat as id_alamat', 'text as text')
                ->where('text', 'like', '%'.$val.'%')
                ->limit(50)
                ->get();
            return response()->json($query);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getDisc(Request $request){
        $val = $request->val;
        try {
            $query =
                DB::table('ms_customer')
                ->select('id as id', 'diskon as diskon')
                ->where('id', 'like', '%'.$val.'%')
                ->first();
            return response()->json($query->diskon);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function createInvoice(Request $request){
        
        $kodeAdmin = $request->kodeadmin;
        $typetrx = $request->typetrx;
        $akun = $request->akun;
        $pengirim = $request->pengirim;
        $nopengirim = $request->nopengirim;
        $penerima = $request->penerima;
        $nopenerima = $request->nopenerima;
        $alamatpenerima = $request->alamatpenerima;
        $keckab = $request->keckab;
        $kurir1 = $request->kurir1;
        $kurir2 = $request->kurir2;
        $ongkoskurir = $request->ongkoskurir;
        $buku = $request->buku;
        
        $result = '';
        if(!empty($kodeAdmin) && !empty($typetrx) && !empty($kurir1) && !empty($kurir2) && !empty($akun) && !empty($pengirim) && !empty($nopengirim) && !empty($penerima) && !empty($nopenerima) && !empty($alamatpenerima)&& !empty($keckab) && !empty($buku)){                    
            $result = 'ok';
        }
        else{
            $result = 'gagal';
        }
        
        if(empty($ongkoskurir)){
            $ongkoskurir=0;
        }

        if($result == 'ok'){
            $rslt = $this->cekStock(json_decode($request->buku, true), $request->kodeadmin);

            if($rslt!='ready'){return response()->json($rslt);}
            else{
                $id = $this->generateid($request->kodeadmin);
                if(!empty($id)){               
                    $codeOrder = $id;

                    $cek = substr($kodeAdmin,0,3);
                    if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
                    else{$gudang='Gd_001';}

                    $expedisi = strtolower($kurir1).'('.$kurir2.')';

                    $deBuku = json_decode($request->buku, true);
                    $totalDisc = 0;
                    $totalBarang = 0;
                    $totalHarga = 0;
                    $discrand = 0;                    
		            $discrand = mt_rand(100, 500);
                    $discrandrupiah = "Rp. " . number_format($discrand,2,',','.');

                    foreach($deBuku as $val)
                    {
                        $totalBarang = $totalBarang + $val['jumlah'];
                        $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                        $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
                    }

                    $kec = $this->getKec($request->keckab, 'kec');
                    $kab = $this->getKec($request->keckab, 'kab');
                    $prov = $this->getKec($request->keckab, 'prov');
                    
                    $order = $this->createOrder($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang, $discrand);
                   
                    if($order == 'sukses'){
                        $orderDetail = $this->createOrderDetail($codeOrder,$deBuku);
                        if($orderDetail == 'sukses'){
                            $updateSo = $this->updateso($deBuku, $kodeAdmin);
                            if($updateSo == 'sukses'){
                                $result= $updateSo;
                            }                            
                        }
                    }
                }            
                
            }
        }
        
        return response()->json($result);
    }

    public function createInvoiceUpdate(Request $request){
        
        $kodeAdmin = $request->kodeadmin;
        $typetrx = $request->typetrx;
        $akun = $request->akun;
        $pengirim = $request->pengirim;
        $nopengirim = $request->nopengirim;
        $penerima = $request->penerima;
        $nopenerima = $request->nopenerima;
        $alamatpenerima = $request->alamatpenerima;
        $keckab = $request->keckab;
        $kurir1 = $request->kurir1;
        $kurir2 = $request->kurir2;
        $ongkoskurir = $request->ongkoskurir;
        $buku = $request->buku;
        $gudangnew = $request->gudang;
        
        $result = '';
        if(!empty($kodeAdmin) && !empty($typetrx) && !empty($kurir1) && !empty($kurir2) && !empty($akun) && !empty($pengirim) && !empty($nopengirim) && !empty($penerima) && !empty($nopenerima) && !empty($alamatpenerima)&& !empty($keckab) && !empty($buku)){                    
            $result = 'ok';
        }
        else{
            $result = 'gagal';
        }
        
        if(empty($ongkoskurir)){
            $ongkoskurir=0;
        }

        if($result == 'ok'){
            $rslt = $this->cekStock(json_decode($request->buku, true), $gudangnew);

            if($rslt!='ready'){return response()->json($rslt);}
            else{
                $id = $this->generateid($request->kodeadmin);
                if(!empty($id)){               
                    $codeOrder = $id;

                    $cek = substr($kodeAdmin,0,3);
                    if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
                    else{$gudang='Gd_001';}

                    $expedisi = strtolower($kurir1).'('.$kurir2.')';

                    $deBuku = json_decode($request->buku, true);
                    $totalDisc = 0;
                    $totalBarang = 0;
                    $totalHarga = 0;
                    $discrand = 0;                    
		            $discrand = mt_rand(100, 500);
                    $discrandrupiah = "Rp. " . number_format($discrand,2,',','.');

                    foreach($deBuku as $val)
                    {
                        $totalBarang = $totalBarang + $val['jumlah'];
                        $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                        $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
                    }

                    $kec = $this->getKec($request->keckab, 'kec');
                    $kab = $this->getKec($request->keckab, 'kab');
                    $prov = $this->getKec($request->keckab, 'prov');
                    
                    $order = $this->createOrder($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudangnew, $discrand);
                   
                    if($order == 'sukses'){
                        $orderDetail = $this->createOrderDetail($codeOrder,$deBuku);
                        if($orderDetail == 'sukses'){
                            $updateSo = $this->updateso($deBuku, $gudangnew);
                            if($updateSo == 'sukses'){
                                $result= $updateSo;
                            }                            
                        }
                    }
                }            
                
            }
        }
        
        return response()->json($result);
    }

    public function createOrder($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang, $discrand){

         try {
                // DB::beginTransaction();               

                DB::table('outstanding_order')->insert(
                    [
                        'idOrder' => $codeOrder, 
                        'kodeAdminTrx' => $kodeAdmin,
                        'typeTransaksi' => $typetrx, 
                        'totalDiskon' => $totalDisc,
                        'code_customer' => $akun, 
                        'expedisi' => $expedisi,
                        'biaya_expedisi' => $ongkoskurir, 
                        'total_barang' => $totalBarang,
                        'total_harga' => $totalHarga, 
                        'nama_pengirim' => $pengirim,
                        'telephone_pengirim' => $nopengirim, 
                        'nama_penerima' => $penerima,
                        'telephone_penerima' => $nopenerima, 
                        'alamat' => $alamatpenerima,
                        'kecamatan' => $kec, 
                        'kab_kota' => $kab,
                        'propinsi' => $prov, 
                        'codeGudang' => $gudang,
                        'image' => '-',
                        'diskonKodeUnik' => $discrand, 
                        'invStore' => 0,
                        'listPO' => 0,
                    ]
                );               
            
                $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function createOrderDetail($codeOrder,$deBuku){

         try {

            foreach($deBuku as $val)
            {
                if(substr($val['id'],0,5)=='promo'){
                    $getmstpromo = DB::table('ms_promo')
                        ->select('code_promo','nama_promo', 'harga_jadi')
                        ->where('code_promo','=', $val['id'])
                        ->first();
                    $getpromo = DB::table('ms_barang_promo')
                        ->select('code_promo','code_barang')
                        ->where('code_promo','=', $val['id'])
                        ->get();
                    if(count($getpromo) < 2){
                        $promodetail = DB::table('ms_barang_promo')
                           ->select('code_promo','code_barang')
                           ->where('code_promo','=', $val['id'])
                           ->first();
                        $barang =  DB::table('ms_barang')
                           ->select('id','harga')
                           ->where('id','=', $promodetail->code_barang)
                           ->first();
                        DB::table('outstanding_orderdetail')->insert(
                            [
                                'code_order' => $codeOrder, 
                                'code_barang' => $promodetail->code_barang,
                                'code_promo' => $promodetail->code_promo, 
                                'nama_promo' => $getmstpromo->nama_promo,
                                'jumlah' => $val['jumlah'], 
                                'harga' => $barang->harga,
                                'harga_promo' => $getmstpromo->harga_jadi, 
                                'diskon' => $val['diskon'],
                                'keterangan' => '-'
                            ]
                        );   
                    }else{
                        foreach($getpromo as $valprm){
                            $barang =  DB::table('ms_barang')
                                ->select('id','harga')
                                ->where('id','=', $valprm->code_barang)
                                ->first();

                            DB::table('outstanding_orderdetail')->insert(
                                [
                                    'code_order' => $codeOrder, 
                                    'code_barang' => $valprm->code_barang,
                                    'code_promo' => $valprm->code_promo, 
                                    'nama_promo' => $getmstpromo->nama_promo,
                                    'jumlah' => $val['jumlah'], 
                                    'harga' => $barang->harga,
                                    'harga_promo' => $getmstpromo->harga_jadi, 
                                    'diskon' => $val['diskon'],
                                    'keterangan' => '-'
                                ]
                            );
                        }
                    }
                }else{
                    DB::table('outstanding_orderdetail')->insert(
                        [
                            'code_order' => $codeOrder, 
                            'code_barang' => $val['id'],
                            'code_promo' => '-', 
                            'nama_promo' => '-',
                            'jumlah' => $val['jumlah'], 
                            'harga' => $val['harga'],
                            'harga_promo' => 0, 
                            'diskon' => $val['diskon'],
                            'keterangan' => '-'
                        ]
                    );
                }
                    // $totalBarang = $totalBarang + $val['jumlah'];
                    // $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                    // $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
            }
            $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function cekStock($buku, $gudangnew){
        // $cek = substr($kodeAdmin,0,3);
        // if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
        // else{$gudang='Gd_001';}
        $gudang=$gudangnew;
        $rslt = '';
        foreach($buku as $val){
            // $rslt = $val['id'];
                        
            if(substr($val['id'],0,5)=='promo'){
                $getpromo = DB::table('ms_barang_promo')
                           ->select('code_promo','code_barang')
                           ->where('code_promo','=', $val['id'])
                           ->get();
                
                if(count($getpromo) < 2){
                    $promodetail = DB::table('ms_barang_promo')
                           ->select('code_promo','code_barang')
                           ->where('code_promo','=', $val['id'])
                           ->first();
                    // return $promodetail->code_barang;
                    // break;
                    $getcount = DB::table('ms_barang_stock')
                           ->select('code_barang',DB::raw('d - k as total'))
                           ->where('code_barang','=', $promodetail->code_barang)
                           ->where('code_gudang', '=', $gudang)
                           ->first();
                    if($getcount->total<1){
                        return 'notready';
                        break;
                    }elseif($getcount->total< $val['jumlah']){
                        return 'notready';
                        break;
                    }else{
                        $rslt = 'ready';
                    }
                }
                else{
                    foreach($getpromo as $valprm){
                        $getcount = DB::table('ms_barang_stock')
                            ->select('code_barang',DB::raw('d - k as total'))
                            ->where('code_barang','=', $valprm->code_barang)
                            ->where('code_gudang', '=', $gudang)
                            ->first();
                        if($getcount->total<1){
                            return 'notready';
                            break;
                        }elseif($getcount->total< $val['jumlah']){
                            return 'notready';
                            break;
                        }else{
                            $rslt = 'ready';
                        }
                    }
                }
            }
            else{
                $getcount = DB::table('ms_barang_stock')
                           ->select('code_barang',DB::raw('d - k as total'))
                           ->where('code_barang','=', $val['id'])
                           ->where('code_gudang', '=', $gudang)
                           ->first();
                if($getcount->total<1){
                    return 'notready';
                    break;
                }elseif($getcount->total< $val['jumlah']){
                    return 'notready';
                    break;
                }else{
                    $rslt = 'ready';
                }
            }
        }
        return $rslt;
    }

    public function generateid($kodeAdminTrx){
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

    public function updateso($buku, $gudangnew){
        $rslt = '';
        // $cek = substr($kodeAdmin,0,3);
        // if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
        // else{$gudang='Gd_001';}
        $gudang=$gudangnew;
        // $buku = mod_cart::select('id_buku as idBuku', 'jumlah')->where('username', '=', $username)->get();
         foreach($buku as $bk){
            if(substr($bk['id'],0,5)=='promo'){
                $promodetail = DB::table('ms_barang_promo')->select('code_barang')->where('code_promo', '=', $bk['id'])->get();
                foreach($promodetail as $prm){
                    $valK = 0;
                    // $rslt = $prm->code_barang;
                    $getK=DB::table('ms_barang_stock')->select('k')->where('code_barang', '=',$prm->code_barang)->where('code_gudang', '=', $gudang)->first();
                    $valK = $getK->k + $bk['jumlah'];
                    DB::table('ms_barang_stock')->where('code_barang', '=',$prm->code_barang)
                    ->where('code_gudang', '=', $gudang)
                    ->update(
                                ['k' => $valK]
                            );
                }
            }
            else{
                $valK = 0;
                    $getK=DB::table('ms_barang_stock')->select('k')->where('code_barang', '=',$bk['id'])->where('code_gudang', '=', $gudang)->first();
                    $valK = $getK->k + $bk['jumlah'];
                    DB::table('ms_barang_stock')->where('code_barang', '=',$bk['id'])
                    ->where('code_gudang', '=', $gudang)
                    ->update(
                                ['k' => $valK]
                            );

            }
        }
        // return $rslt;
        return 'sukses';
    }

    public function getKec($kec, $var){
        $rslt=''; $i = 0; 
        $chars = str_split($kec);
        foreach($chars as $val){
            // i = i + 1;
            if($var=='kec'){
                if($val == ','){
                    $i=$i+1;  
                }
                if($i==1){
                    if($val != ','){
                        $rslt= $rslt.$val; 
                    }  
                }
                if($val == '-'){
                    $i=$i+1;
                }  
            }
            if($var=='kab'){
                if($i==1){
                    if($val != ','){
                        $rslt= $rslt.$val;
                    }                     
                }
                if($val == ','){
                    $i=$i+1;
                }  
            }
            if($var=='prov'){
                if($i==2){
                    if($val != ','){
                        $rslt= $rslt.$val;
                    }                     
                }
                if($val == ','){
                    $i=$i+1;
                }  
            }                                    
        }        
        return $rslt;
    }

    private function baseUrlRajaOngkir(){
        $baseUrl = 'https://pro.rajaongkir.com/api/';
        return $baseUrl ;
    }

    public function callApiRajaOngkir($typeReq, $typeParam, $urlSpesifik, $dataArray){
        $client = new Client();
        $url = $this-> baseUrlRajaOngkir();
        $urlApi = $url . $urlSpesifik;
        $request = strtoupper($typeReq);

        if ($typeParam == "header") { $setTypeParam = 'query'; }
        elseif ($typeParam == "body") { $setTypeParam = 'json'; }
        
        $response = $client->request($request, $urlApi, [ $setTypeParam => $dataArray ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ongkirro($origin,$destination,$weight, $courier){
        $spesifikApi = 'cost';
        $typeParam = 'body';
        $typeReq = 'post';

        $key = '33bb31f84e8ed7d793d08db159771b2d';
        $dataArray = ['key' => $key, 'origin' => $origin,'originType' => "city",'destinationType' => 'subdistrict','destination' => $destination, 'weight' => $weight,'courier' => $courier];
        $value = $this->callApiRajaOngkir($typeReq, $typeParam, $spesifikApi, $dataArray);
        return $value['rajaongkir']['results'];
    }

    public function getcostrajaongkir(Request $request){
            // $berat = substr($request->weight,0,-5);
        
            $berat = $request->weight;
            $origin = '445';
            $destination = $request->destination;
            $weight = $berat;
            $int = (int)$berat;
            if($int>50000){
                $courier = 'jne:tiki:jnt:indah:wahana:lion';
            }else{
                $courier = 'jne:pos:tiki:jnt:indah:wahana:lion';
            }

            // return $this->ongkirro($origin,$destination,$weight, $courier);
            // dd($request->session());

                $data = [];
                $a=array();

                // $resMapCosts = $response['rajaongkir']['results'];
                $resMapCosts = $this->ongkirro($origin,$destination,$weight, $courier);
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
                        $text = strtoupper($listCode).' ('.$listService .') - '. $listBiaya ; 
                        $data = ['id'=>strtoupper($listCode), 'service'=>$listService, 'harga' => $listBiaya, 'text' => $text ];
                        array_push($a, $data);
                    }

                }
                return $a;           
           
    }

    public function getcostrajaongkirupdate(Request $request){
            // $berat = substr($request->weight,0,-5);
        
            $berat = $request->weight;
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $berat;
            $int = (int)$berat;
            if($int>50000){
                $courier = 'jne:tiki:jnt:indah:wahana:lion';
            }else{
                $courier = 'jne:pos:tiki:jnt:indah:wahana:lion';
            }

            // return $this->ongkirro($origin,$destination,$weight, $courier);
            // dd($request->session());

                $data = [];
                $a=array();

                // $resMapCosts = $response['rajaongkir']['results'];
                $resMapCosts = $this->ongkirro($origin,$destination,$weight, $courier);
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
                        $text = strtoupper($listCode).' ('.$listService .') - '. $listBiaya ; 
                        $data = ['id'=>strtoupper($listCode), 'service'=>$listService, 'harga' => $listBiaya, 'text' => $text ];
                        array_push($a, $data);
                    }

                }
                return $a;           
           
    }

    public function getOutstandingOrderCustomer(Request $request) {

        $token = $request->token;

        $code_order = $request->code_order;

        try {

            if($token=='6vkktpeblt')

            {

                $result= [

                    'dataGetOutStandingOrderCustomer' => $this->dataGetOutStandingOrderCustomer($code_order),

                    'dataGetOutStandingOrderDetail' => $this->dataGetOutStandingOrderDetail($code_order),

                ];

            }

            else

            {

                $result = 'Invalid Token';   

            }  

                    return response()->json($result); 

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function dataGetOutStandingOrderCustomer($code_order){

        try{

                // $result = 'True';

                $result = 

                DB::table('outstanding_order')

                ->select('outstanding_order.id as  id','outstanding_order.idOrder as idOrder','outstanding_order.code_customer as code_customer','ms_customer.nama as nama','outstanding_order.nama_pengirim as namaPengirim','outstanding_order.telephone_pengirim as telephonePengirim','outstanding_order.nama_penerima as namaPenerima','outstanding_order.alamat as alamat','outstanding_order.kecamatan as kecamatan','outstanding_order.telephone_penerima as telephonePenerima','outstanding_order.kab_kota as kab_kota','outstanding_order.propinsi as propinsi','outstanding_order.created_at as created_at','outstanding_order.expedisi as expedisi','outstanding_order.biaya_expedisi as biayaExpedisi', 'outstanding_order.typeTransaksi as  typeTransaksi', 'outstanding_order.total_harga as  totalHarga', 'outstanding_order.totalDiskon as  totalDiskon','outstanding_order.diskonKodeUnik as diskonKodeUnik','outstanding_order.codeGudang as codeGudang')

                ->join('ms_customer','ms_customer.id','=','outstanding_order.code_customer')

                ->where('outstanding_order.idOrder', '=', $code_order)

                ->where('outstanding_order.image','=','-')

                ->get(); 

            return   $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function dataGetOutStandingOrderDetail($code_order){

        try{
                // $result = 'True';

                // DB::raw('(SELECT SUM(berat) as totalBerat FROM ms_barang JOIN outstanding_orderdetail A ON A.code_barang = ms_barang.id WHERE A.code_order = "'.$code_order.'" AND A.code_promo = outstanding_orderdetail.code_promo)as totalBerat'),

                $data = [];
                $a=array();

                $result = 
                DB::table('outstanding_orderdetail')
                ->select('outstanding_orderdetail.id as  id','outstanding_orderdetail.code_order as code_order','ms_barang.id as code_barang','ms_barang.judul_buku as judul_buku','outstanding_orderdetail.jumlah as jumlah','ms_barang.berat as berat','outstanding_orderdetail.diskon as diskon','outstanding_orderdetail.harga as harga','outstanding_orderdetail.code_promo as code_promo','outstanding_orderdetail.nama_promo as nama_promo','outstanding_orderdetail.harga_promo as harga_promo')
                ->join('ms_barang','ms_barang.id','=','outstanding_orderdetail.code_barang')
                ->where('outstanding_orderdetail.code_order', '=', $code_order) 
                ->get();
                
                foreach($result as $rslt){
                    $id=$rslt->id;
                    $code_barang=$rslt->code_barang;
                    if($rslt->code_promo == '-'){
                        $barang = DB::table('ms_barang')
                        ->select('id as  id','berat')
                        ->where('id', '=', $code_barang) 
                        ->first();

                        $data = ['totalBerat'=>$barang->berat, 'id'=>$rslt->id, 'code_order' => $rslt->code_order, 'code_barang' => $rslt->code_barang , 
                        'judul_buku'=>$rslt->judul_buku, 'jumlah' => $rslt->jumlah, 'berat' => $rslt->berat, 
                        'diskon'=>$rslt->diskon, 'harga' => $rslt->harga, 'code_promo' => $rslt->code_promo, 
                        'nama_promo' => $rslt->nama_promo, 'harga_promo' => $rslt->harga_promo ];
                        array_push($a, $data);
                    }else{
                        $barang = DB::table('ms_promo')
                        ->select('code_promo as  code_promo','berat_total')
                        ->where('code_promo', '=', $rslt->code_promo) 
                        ->first();

                        $data = ['totalBerat'=>$barang->berat_total, 'id'=>$rslt->id, 'code_order' => $rslt->code_order, 'code_barang' => $rslt->code_barang , 
                        'judul_buku'=>$rslt->judul_buku, 'jumlah' => $rslt->jumlah, 'berat' => $rslt->berat, 
                        'diskon'=>$rslt->diskon, 'harga' => $rslt->harga, 'code_promo' => $rslt->code_promo, 
                        'nama_promo' => $rslt->nama_promo, 'harga_promo' => $rslt->harga_promo ];
                        array_push($a, $data);
                    }
                    
                }

            return   $a;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function updateInvoice(Request $request){
        $kodeAdmin = $request->kodeadmin;
        $typetrx = $request->typetrx;
        $akun = $request->akun;
        $pengirim = $request->pengirim;
        $nopengirim = $request->nopengirim;
        $penerima = $request->penerima;
        $nopenerima = $request->nopenerima;
        $alamatpenerima = $request->alamatpenerima;
        $keckab = $request->keckab;
        $kurir1 = $request->kurir1;
        $kurir2 = $request->kurir2;
        $ongkoskurir = $request->ongkoskurir;
        $buku = $request->buku;
        $codeOrder = $request->codeOrder;

        $result= 'ok';

        if(!empty($kodeAdmin) && !empty($typetrx) && !empty($kurir1) && !empty($kurir2) && !empty($ongkoskurir) && !empty($akun) && !empty($pengirim) && !empty($nopengirim) && !empty($penerima) && !empty($nopenerima) && !empty($alamatpenerima)&& !empty($keckab) && !empty($buku)){                    
            $result = 'ok';
        }
        else{
            $result = 'gagal';
        } 

        if($result == 'ok'){
            $backStock = $this->backStock($request->kodeadmin, $request->codeOrder);

            if($backStock == 'sukses' ){
                DB::table('outstanding_orderdetail')->where('code_order', $codeOrder)->delete();

                $rslt = $this->cekStock(json_decode($request->buku, true), $request->kodeadmin);

                if($rslt!='ready'){return response()->json($rslt);}
                else{
                    // $id = $this->generateid($request->kodeadmin);
                    if(!empty($codeOrder)){               
                        $codeOrder = $codeOrder;

                        $cek = substr($kodeAdmin,0,3);
                        if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
                        else{$gudang='Gd_001';}

                        $expedisi = strtolower($kurir1).'('.$kurir2.')';

                        $deBuku = json_decode($request->buku, true);
                        $totalDisc = 0;
                        $totalBarang = 0;
                        $totalHarga = 0;
                        foreach($deBuku as $val)
                        {
                            $totalBarang = $totalBarang + $val['jumlah'];
                            $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                            $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
                        }

                        $kec = $this->getKec($request->keckab, 'kec');
                        $kab = $this->getKec($request->keckab, 'kab');
                        $prov = $this->getKec($request->keckab, 'prov');
                        
                        $order = $this->updateOrder($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang);
                    
                        if($order == 'sukses'){
                            $orderDetail = $this->createOrderDetail($codeOrder,$deBuku);
                            if($orderDetail == 'sukses'){
                                $updateSo = $this->updateso($deBuku, $kodeAdmin);
                                if($updateSo == 'sukses'){
                                    $result= $updateSo;
                                }                            
                            }
                        }
                    }            
                    
                }
            
            }
        }
        

        return response()->json($result);
    }
    public function backStock($kodeAdmin, $codeOrder){
        $rslt = '';
        $cek = substr($kodeAdmin,0,3);
        if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
        else{$gudang='Gd_001';}

        $detail = DB::table('outstanding_orderdetail')
                ->select('code_order','code_barang' ,'code_promo','nama_promo', 'jumlah','harga','harga_promo', 'diskon')
                ->where('code_order', '=', $codeOrder) 
                ->get();

        foreach($detail as $dt){
                $getK=DB::table('ms_barang_stock')->select('d','k')->where('code_barang', '=',$dt->code_barang)->where('code_gudang', '=', $gudang)->first();
                if($getK->k== 0){
                    $valD = $getK->d + $dt->jumlah;
                    DB::table('ms_barang_stock')->where('code_barang', '=',$dt->code_barang)
                    ->where('code_gudang', '=', $gudang)
                    ->update(
                                ['d' => $valD]
                            );
                }else{
                    $valK = $getK->k - $dt->jumlah;
                    DB::table('ms_barang_stock')->where('code_barang', '=',$dt->code_barang)
                    ->where('code_gudang', '=', $gudang)
                    ->update(
                                ['k' => $valK]
                            );
                }                
                    
        }
        
        return 'sukses';
    }
    public function updateOrder($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang){

         try {
                // DB::beginTransaction();               

                $oustanding = DB::table('outstanding_order')
                ->select('idOrder','created_at' ,'updated_at')
                ->where('idOrder', '=', $codeOrder) 
                ->first();

                DB::table('outstanding_order')
                    ->where('idOrder', '=', $codeOrder)
                    ->update(
                                [ 
                                    'kodeAdminTrx' => $kodeAdmin,
                                    'typeTransaksi' => $typetrx, 
                                    'totalDiskon' => $totalDisc,
                                    'code_customer' => $akun, 
                                    'expedisi' => $expedisi,
                                    'biaya_expedisi' => $ongkoskurir, 
                                    'total_barang' => $totalBarang,
                                    'total_harga' => $totalHarga, 
                                    'nama_pengirim' => $pengirim,
                                    'telephone_pengirim' => $nopengirim, 
                                    'nama_penerima' => $penerima,
                                    'telephone_penerima' => $nopenerima, 
                                    'alamat' => $alamatpenerima,
                                    'kecamatan' => $kec, 
                                    'kab_kota' => $kab,
                                    'propinsi' => $prov, 
                                    'codeGudang' => $gudang,
                                    'image' => '-',
                                    'diskonKodeUnik' => 0, 
                                    'invStore' => 0,
                                    'created_at' => $oustanding->created_at                                    
                                ]
                            );                               
            
                $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function getCustAdmin(Request $request){
        $val = $request->val;
        $kodeAdmin = $request->kodeAdmin;
        try {
            $query =
                DB::table('ms_customer')
                ->select('id as id', 'nama as nama', 'diskon as diskon')
                ->where('isDell', '=', 0)
                ->where('nama', 'like', '%'.$val.'%')
                ->where('kodeAdminTrx', '=', $kodeAdmin)
                ->limit(25)
                ->get();
            return response()->json($query);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getBukuPO(Request $request){        
        $val = $request->val;
        date_default_timezone_set("Asia/Bangkok");
        $maxDate=date('Y-m-d h:i:s',strtotime("-2 month"));

        try {
            $query =
                DB::table('ms_promo')
                ->select('code_promo as code_promo', 'nama_promo as nama_promo', 'harga_jadi as harga_jadi', 'berat_total as berat_total')
                ->where('is_del', '=', 0)
                ->where('nama_promo', 'like', '%PO%')
                ->where('created_at','>',$maxDate )
                ->where('tanggal_cetak', '<>', '2020-01-01 00:00:00')
                ->get();
            return response()->json($query);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getListPO(Request $request) {

        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $codeOrder = $request->codeOrder;
        $namaPenerima = $request->namaPenerima;
        $offset = $request->offset;

        try {

            if($token=='5nkeygqp9l')

            {
                $result= [
                    'data' => $this->getOrderPO($offset,$kodeAdmin,$namaPenerima,$codeOrder),
                    'count' => $this->getCountPO($kodeAdmin,$namaPenerima,$codeOrder)
                ];
            }

            else
            {
                $result = 'Invalid Token';  
            }    

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function getOrderPO($offset,$kodeAdmin,$namaPenerima,$codeOrder){

        try{

            $data = [];
            $a=array();

        if($offset){$offset=(int)$offset;}

        else{$offset=0;}

            $query = 
                DB::table('outstanding_order')
                ->select('outstanding_order.id as id','outstanding_order.idOrder as idOrder','ms_customer.nama as nama','outstanding_order.nama_penerima as namaPenerima','outstanding_order.total_harga as totalHarga','outstanding_order.biaya_expedisi as biayaExpedisi','outstanding_order.totalDiskon as totalDiskon','outstanding_order.typeTransaksi as typeTransaksi','outstanding_order.invStore as invStore','outstanding_order.created_at as created_at')
                ->join('ms_customer','ms_customer.id','=','outstanding_order.code_customer')
                ->where('outstanding_order.image','=','-')
                // ->where('outstanding_order.invStore','=',$type)
                ->where('outstanding_order.listPO','=', 1)
                ->where('outstanding_order.kodeAdminTrx','=',$kodeAdmin)
                ->orderBy('outstanding_order.updated_at', 'DESC')
                ->limit(10)
                ->offset($offset);

            if($namaPenerima){
                    $query->where('outstanding_order.nama_penerima', 'like', $namaPenerima.'%');
                }
            
            if($codeOrder){
                    $query->where('outstanding_order.idOrder', 'like', '%'.$codeOrder.'%');
                }

            $result=$query ->get();

            foreach($result as $rslt){
                    // $id=$rslt->id;
                    // $code_barang=$rslt->code_barang;
                $DetailBuku = DB::table('outstanding_orderdetail')
                            ->select('code_order as code_order', 'nama_promo as nama_promo', 'jumlah as jumlah')
                            ->distinct('code_order')
                            ->where('code_order','=',$rslt->idOrder)
                            ->get();
                $data = ['id'=>$rslt->id, 'idOrder'=>$rslt->idOrder, 'nama' => $rslt->nama, 'namaPenerima' => $rslt->namaPenerima , 
                        'typeTransaksi'=>$rslt->typeTransaksi, 'buku' => $DetailBuku];
                array_push($a, $data);
            }

            return $a;

        } catch (\Exception $ex) {
            return response()->json($ex);
        }

    }

    public function getCountPO($kodeAdmin,$namaPenerima,$codeOrder){

        try{    

        $query = 
        DB::table('outstanding_order')
        ->select(DB::raw('COUNT(outstanding_order.id) as count'))
        ->where('outstanding_order.image','=','-')
        ->where('outstanding_order.listPO','=', 1)
        // ->where('outstanding_order.invStore','=',$type)
        ->where('outstanding_order.kodeAdminTrx','=',$kodeAdmin);

        if($namaPenerima){
            $query->where('outstanding_order.nama_penerima', 'like', $namaPenerima.'%');
        }
        if($codeOrder){
            $query->where('outstanding_order.idOrder', 'like', '%'.$codeOrder.'%');
        }

        $result=$query ->first();

        return   $result;

        } catch (\Exception $ex) {
            return response()->json($ex);
        }

    }

    public function createPO(Request $request){
        
        $kodeAdmin = $request->kodeadmin;
        $typetrx = $request->typetrx;
        $akun = $request->akun;
        $pengirim = $request->pengirim;
        $nopengirim = $request->nopengirim;
        $penerima = $request->penerima;
        $nopenerima = $request->nopenerima;
        $alamatpenerima = $request->alamatpenerima;
        $keckab = $request->keckab;
        $kurir1 = $request->kurir1;
        $kurir2 = $request->kurir2;
        $ongkoskurir = $request->ongkoskurir;
        $buku = $request->buku;
        
        $result = '';
        if(!empty($kodeAdmin) && !empty($typetrx) && !empty($kurir1) && !empty($kurir2) && !empty($ongkoskurir) && !empty($akun) && !empty($pengirim) && !empty($nopengirim) && !empty($penerima) && !empty($nopenerima) && !empty($alamatpenerima)&& !empty($keckab) && !empty($buku)){                    
            $result = 'ok';
        }
        else{
            $result = 'gagal';
        } 

        if($result == 'ok'){           
                $id = $this->generateid($request->kodeadmin);
                if(!empty($id)){               
                    $codeOrder = $id;

                    $cek = substr($kodeAdmin,0,3);
                    if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
                    else{$gudang='Gd_001';}

                    $expedisi = strtolower($kurir1).'('.$kurir2.')';

                    $deBuku = json_decode($request->buku, true);
                    $totalDisc = 0;
                    $totalBarang = 0;
                    $totalHarga = 0;
                    foreach($deBuku as $val)
                    {
                        $totalBarang = $totalBarang + $val['jumlah'];
                        $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                        $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
                    }

                    $kec = $this->getKec($request->keckab, 'kec');
                    $kab = $this->getKec($request->keckab, 'kab');
                    $prov = $this->getKec($request->keckab, 'prov');
                    
                    $order = $this->createOrderPO($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang);
                   
                    if($order == 'sukses'){
                        $orderDetail = $this->createOrderDetail($codeOrder,$deBuku);
                        if($orderDetail == 'sukses'){
                            $addHistory = createManagerReport($codeOrder, 0, $kodeAdmin, $akun, $deBuku);
                            $result= $orderDetail;                                                        
                        }
                    }
                }            
                
            }        
        return response()->json($result);
    }
    
    public function createOrderPO($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang){

         try {
                // DB::beginTransaction();               

                DB::table('outstanding_order')->insert(
                    [
                        'idOrder' => $codeOrder, 
                        'kodeAdminTrx' => $kodeAdmin,
                        'typeTransaksi' => 'preOrder', 
                        'totalDiskon' => $totalDisc,
                        'code_customer' => $akun, 
                        'expedisi' => $expedisi,
                        'biaya_expedisi' => $ongkoskurir, 
                        'total_barang' => $totalBarang,
                        'total_harga' => $totalHarga, 
                        'nama_pengirim' => $pengirim,
                        'telephone_pengirim' => $nopengirim, 
                        'nama_penerima' => $penerima,
                        'telephone_penerima' => $nopenerima, 
                        'alamat' => $alamatpenerima,
                        'kecamatan' => $kec, 
                        'kab_kota' => $kab,
                        'propinsi' => $prov, 
                        'codeGudang' => $gudang,
                        'image' => '-',
                        'diskonKodeUnik' => 0, 
                        'invStore' => 0,
                        'listPO' => 1,
                    ]
                );               
            
                $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function createManagerReport($codeOrder, $type, $kodeAdmin, $cust, $buku){
        try {
            foreach($deBuku as $val)
            {
                if(substr($val['id'],0,5)=='promo'){
                    $getmstpromo = DB::table('ms_promo')
                        ->select('code_promo','nama_promo', 'harga_jadi')
                        ->where('code_promo','=', $val['id'])
                        ->first();
                }
                DB::table('ms_po_manager')->insert(
                            [
                                'code_order' => $codeOrder, 
                                'kodeAdmin' => $kodeAdmin, 
                                'code_cust' => $cust,
                                'code_po' => $getmstpromo->code_promo, 
                                'jumlah' => $val['jumlah'],
                                'type' => $type
                            ]
                        );
            }
            $result='sukses';
            return $result;
        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }
    public function createManagerReportInv($codeOrder, $type){
        try {
            
                $getreport = DB::table('ms_po_manager')
                    ->select('code_order','kodeAdmin' ,'code_cust','code_po','jumlah')
                    ->where('code_order','=', $codeOrder)
                    ->where('type','=', 0)
                    ->get();

            foreach($getreport as $val)
            {            
                DB::table('ms_po_manager')->insert(
                            [
                                'code_order' => $val->code_order, 
                                'kodeAdmin' => $val->kodeAdmin, 
                                'code_cust' => $val->code_cust,
                                'code_po' => $val->code_po, 
                                'jumlah' => $val->jumlah,
                                'type' => 1
                            ]
                        );
            }
            $result='sukses';
            return $result;
        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }
    public function deleteManagerReport($codeOrder, $type, $kodeAdmin){
        try {

            DB::table('ms_po_manager')->where('code_order', $codeOrder)->where('type', $type)->where('kodeAdmin', $kodeAdmin)->delete();

            $result='sukses';
            return $result;
        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function getDetailPO(Request $request){
        try{
            
            $data = [];
            $a=array();

            $Order = 
            DB::table('outstanding_order')
            ->select('idOrder as idOrder','nama_pengirim as nama_pengirim','telephone_pengirim as telephone_pengirim','nama_penerima as nama_penerima','telephone_penerima as telephone_penerima','alamat as alamat')
            ->where('listPO','=', 1)
            ->where('idOrder', '=', $request->CodeOrder)
            ->first();

            $OrderDetail =
            DB::table('outstanding_orderdetail')
            ->select('outstanding_orderdetail.code_promo as code_promo','outstanding_orderdetail.nama_promo as nama_promo','outstanding_orderdetail.jumlah as jumlah','outstanding_orderdetail.harga_promo as harga_promo','outstanding_orderdetail.diskon as diskon','ms_promo.berat_total as berat_total')
            ->join('ms_promo','ms_promo.code_promo','=','outstanding_orderdetail.code_promo')
            ->where('code_order', '=', $request->CodeOrder)
            ->get();

            $data = ['idOrder'=>$Order->idOrder, 'nama_pengirim'=>$Order->nama_pengirim, 'telephone_pengirim' => $Order->telephone_pengirim, 'nama_penerima' => $Order->nama_penerima , 'telephone_penerima' => $Order->telephone_penerima, 
                    'alamat' => $Order->alamat ,'buku' => $OrderDetail];
            array_push($a, $data);

        return   $a;

        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function updatePO(Request $request){
        $kodeAdmin = $request->kodeadmin;
        $typetrx = $request->typetrx;
        $akun = $request->akun;
        $pengirim = $request->pengirim;
        $nopengirim = $request->nopengirim;
        $penerima = $request->penerima;
        $nopenerima = $request->nopenerima;
        $alamatpenerima = $request->alamatpenerima;
        $keckab = $request->keckab;
        $kurir1 = $request->kurir1;
        $kurir2 = $request->kurir2;
        $ongkoskurir = $request->ongkoskurir;
        $buku = $request->buku;
        $codeOrder = $request->codeOrder;

        $result= 'ok';

        if(!empty($kodeAdmin) && !empty($typetrx) && !empty($kurir1) && !empty($kurir2) && !empty($ongkoskurir) && !empty($akun) && !empty($pengirim) && !empty($nopengirim) && !empty($penerima) && !empty($nopenerima) && !empty($alamatpenerima)&& !empty($keckab) && !empty($buku)){                    
            $result = 'ok';
        }
        else{
            $result = 'gagal';
        } 

        if($result == 'ok'){

                DB::table('outstanding_orderdetail')->where('code_order', $codeOrder)->delete();
                    // $id = $this->generateid($request->kodeadmin);
                    if(!empty($codeOrder)){               
                        $codeOrder = $codeOrder;

                        $cek = substr($kodeAdmin,0,3);
                        if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
                        else{$gudang='Gd_001';}

                        $expedisi = strtolower($kurir1).'('.$kurir2.')';

                        $deBuku = json_decode($request->buku, true);
                        $totalDisc = 0;
                        $totalBarang = 0;
                        $totalHarga = 0;
                        foreach($deBuku as $val)
                        {
                            $totalBarang = $totalBarang + $val['jumlah'];
                            $totalDisc = $totalDisc + (($val['diskon']*$val['harga'])/100)*$val['jumlah'];
                            $totalHarga = $totalHarga + $val['harga']*$val['jumlah'];
                        }

                        $kec = $this->getKec($request->keckab, 'kec');
                        $kab = $this->getKec($request->keckab, 'kab');
                        $prov = $this->getKec($request->keckab, 'prov');
                        
                        $order = $this->updateOrderPO($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang);
                    
                        if($order == 'sukses'){
                            $orderDetail = $this->createOrderDetail($codeOrder,$deBuku);
                            if($orderDetail == 'sukses'){
                                $deleteReport = deleteManagerReport($codeOrder, 0, $kodeAdmin);
                                if($deleteReport == 'sukses'){
                                    $addHistory = createManagerReport($codeOrder, 0, $kodeAdmin, $akun, $deBuku);
                                    $result= 'sukses'; 
                                }                                     
                            }
                        }
                    }            
                    
                }
            
        return response()->json($result);
    }

    public function updateOrderPO($codeOrder,$kodeAdmin,$typetrx,$totalDisc,$akun,$expedisi,$ongkoskurir,$totalBarang,$totalHarga,$pengirim,$nopengirim,$penerima,$nopenerima,$alamatpenerima,$kec,$kab,$prov,$gudang){

         try {
                // DB::beginTransaction();               

                $oustanding = DB::table('outstanding_order')
                ->select('idOrder','created_at' ,'updated_at')
                ->where('idOrder', '=', $codeOrder) 
                ->first();

                DB::table('outstanding_order')
                    ->where('idOrder', '=', $codeOrder)
                    ->update(
                                [ 
                                    'kodeAdminTrx' => $kodeAdmin,
                                    'typeTransaksi' => $typetrx, 
                                    'totalDiskon' => $totalDisc,
                                    'code_customer' => $akun, 
                                    'expedisi' => $expedisi,
                                    'biaya_expedisi' => $ongkoskurir, 
                                    'total_barang' => $totalBarang,
                                    'total_harga' => $totalHarga, 
                                    'nama_pengirim' => $pengirim,
                                    'telephone_pengirim' => $nopengirim, 
                                    'nama_penerima' => $penerima,
                                    'telephone_penerima' => $nopenerima, 
                                    'alamat' => $alamatpenerima,
                                    'kecamatan' => $kec, 
                                    'kab_kota' => $kab,
                                    'propinsi' => $prov, 
                                    'codeGudang' => $gudang,
                                    'image' => '-',
                                    'diskonKodeUnik' => 0, 
                                    'listPO' => 1,
                                    'created_at' => $oustanding->created_at                                    
                                ]
                            );                               
            
                $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function createInvoicePO(Request $request){
         try {
                // DB::beginTransaction();
            $order = json_decode($request->order, true);               
            foreach($order as $val){
                $codeOrder = $val['idPO'];
                $oustanding = DB::table('outstanding_order')
                ->select('idOrder','created_at' ,'updated_at')
                ->where('idOrder', '=', $codeOrder) 
                ->first();

                $addReport = $this->createManagerReportInv($codeOrder, 0);

                DB::table('outstanding_order')
                    ->where('idOrder', '=', $codeOrder)
                    ->update(
                            [ 
                                'listPO' => 0,
                                'created_at' => $oustanding->created_at                                    
                            ]
                        );
            }                               
            
            $result= 'sukses';
            return response()->json($result);

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function deletePO(Request $request){
         try {
                // DB::beginTransaction();
            $codeOrder = $request->codeOrder;

            $delOrder = $this->delOrderPO($codeOrder);
            if($delOrder =='sukses'){
                DB::table('outstanding_orderdetail')->where('code_order', $codeOrder)->delete();
                $result='sukses';
            }else{
                $result='gagal';
            }                           
            
            
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function delOrderPO($codeOrder){
        try {

            $deleteReport = deleteManagerReport($codeOrder, 0, $kodeAdmin);
            if($deleteReport == 'sukses'){
                DB::table('outstanding_order')->where('idOrder', $codeOrder)->delete();
            }                                      
            
            $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function backStockInv($kodeAdmin, $codeOrder){
        $rslt = '';
        $cek = substr($kodeAdmin,0,3);
        if(strtoupper($cek)=='JKT'){$gudang='Gd_002';}
        else{$gudang='Gd_001';}

        $oustanding = DB::table('outstanding_order')
                ->select('idOrder','created_at' ,'updated_at','typeTransaksi')
                ->where('idOrder', '=', $codeOrder) 
                ->first();

        if($oustanding->typeTransaksi != 'preOrder'){
            $detail = DB::table('outstanding_orderdetail')
                ->select('code_order','code_barang' ,'code_promo','nama_promo', 'jumlah','harga','harga_promo', 'diskon')
                ->where('code_order', '=', $codeOrder) 
                ->get();

            foreach($detail as $dt){
                    $getK=DB::table('ms_barang_stock')->select('d','k')->where('code_barang', '=',$dt->code_barang)->where('code_gudang', '=', $gudang)->first();
                    if($getK->k== 0){
                        $valD = $getK->d + $dt->jumlah;
                        DB::table('ms_barang_stock')->where('code_barang', '=',$dt->code_barang)
                        ->where('code_gudang', '=', $gudang)
                        ->update(
                                    ['d' => $valD]
                                );
                    }else{
                        $valK = $getK->k - $dt->jumlah;
                        DB::table('ms_barang_stock')->where('code_barang', '=',$dt->code_barang)
                        ->where('code_gudang', '=', $gudang)
                        ->update(
                                    ['k' => $valK]
                                );
                    }                
                        
            }
        }       
        
        return 'sukses';
    }
    
    public function deleteInvoice(Request $request){
         try {
                // DB::beginTransaction();
            $codeOrder = $request->codeOrder;
            $kodeAdmin = $request->kodeAdmin;
            $backStockInv = $this->backStockInv($kodeAdmin, $codeOrder);
            if($backStockInv =='sukses'){
                $delOrder = $this->delOrderInvoice($codeOrder);
                if($delOrder =='sukses'){
                    $deleteReport = deleteManagerReport($codeOrder, 1, $kodeAdmin);
                    if($deleteReport =='sukses'){
                        DB::table('outstanding_orderdetail')->where('code_order', $codeOrder)->delete();
                        $result='sukses';
                    }else{
                        $result='gagal';
                    }                    
                }else{
                    $result='gagal';
                }
            }else{
                    $result='gagal';
            }                           
            
            
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function delOrderInvoice($codeOrder){
        try {

            DB::table('outstanding_order')->where('idOrder', $codeOrder)->delete();                           
            
            $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function getFullDataAkunCust(Request $request){
        $val = $request->nama;
        $offset = $request->offset;
        $kodeAdmin = $request->kodeAdmin;
        if($offset){$batas=$offset;}
        else{$batas=0;}
        try {
            $query =
                DB::table('ms_customer')
                ->select('ms_customer.id as id','ms_customer.username as userId', 'ms_customer.nama as nama', 'ms_customer.diskon as diskon', 'ms_customer.alamat as alamat','ms_customer.telephone as telp', 'ms_customer.jenis_reseller as jenis_reseller')
                // ->join('ms_customer_alamat','ms_customer_alamat.code_customer','=','ms_customer.id')
                ->where('ms_customer.isDell', '=', 0)
                ->where('ms_customer.nama', 'like', '%'.$val.'%')
                ->where('ms_customer.kodeAdminTrx', '=', $kodeAdmin)
                ->limit(10)
                ->skip($batas)
                ->get();

            $count =
                DB::table('ms_customer')
                ->select('ms_customer.id as id')
                ->where('ms_customer.isDell', '=', 0)
                ->where('ms_customer.nama', 'like', '%'.$val.'%')
                ->where('ms_customer.kodeAdminTrx', '=', $kodeAdmin)
                ->get();

            
            $countAll = count($count);
            
            $data = [];
            $data = ['data'=>$query, 'count'=>$countAll];
            return response()->json($data);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function createCustomer(Request $request){
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $kodeAdmin = $request->kodeAdmin;
        $reseller = $request->reseller;
        $diskon = $request->diskon;
        try {
                // DB::beginTransaction();
                
                // $count = DB::table('ms_customer')
                //         ->select(DB::raw('COUNT(ms_customer.id) as count'))
                //         ->first();
           
                // $c = $count->count;
                $kode = $this->generateidcus($request->kodeAdmin);

                $username = $this->getUserId($request->kodeAdmin);

                $data = '@!2e*45';
                $gethash = $this->hash();
                $keyenc = base64_encode($gethash);
                // $pass = encrypt($data, $gethash);

                $hashvar = $gethash;

                $pass = $data;

                $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
                $key1=(int)substr($getkey,0,1);
                $key2=(int)substr($getkey,1,1);
                $key3=(int)substr($getkey,2,1);
                $key4=(int)substr($getkey,3,1);

                $sufflepass = substr( $hashvar,0,$key1).substr($pass,0,$key1).substr($hashvar,$key1,$key2).substr($pass,$key1,$key2).substr($hashvar,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($hashvar,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($hashvar,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
                
                $simple_string = $sufflepass;

                $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

                $encryption_key = base64_decode($key);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
                $encryption = base64_encode($encrypted . '::' . $iv);


               DB::table('ms_customer')->insert(
                    [
                        'id' => $kode, 
                        'username' => $username,
                        'password' => $encryption,
                        'keyhash' => $keyenc, 
                        'nama' => $nama,
                        'alamat' => $alamat, 
                        'telephone' => $telp,
                        'kodeAdminTrx' => $kodeAdmin, 
                        'jenis_reseller' => $reseller,
                        'diskon' => $diskon, 
                        'isDell' => 0
                    ]
                );                                 
            
                $result='sukses';
            return response()->json($result);

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function getUserId($kodeAdmin){

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

            $kode = 'USR'.$tahun.$bulan.$ldate2.$ldate3.$ldate4.$ldate5.substr($kodeAdmin,0,2);                
            
            // $kode = $month.$y.$kodeAdm.$urut;

        return $kode;
    }
    public function generateidcus($kodeAdminTrx)
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

            $id_rec = 'CUS'.$tahun.$bulan.$ldate2.$ldate3.$ldate4.$ldate5.substr($kodeAdminTrx,0,2);
            return $id_rec;
    }

    public function hash(){
        $listkey=['1122','1212','2112','2121','1221','2211'];
        $listhash=['@QW', 'Q@W', 'QW@', 'W@Q', 'WQ@'];
        

        $randIndexKEY = array_rand($listkey); 
        $hashKEY = $listkey[$randIndexKEY];

        $randIndexAQW = array_rand($listhash); 
        $hashAQW = $listhash[$randIndexAQW];
        $allhash = $hashAQW.$hashKEY;
        $sufflekey =str_shuffle($allhash);

        return $sufflekey;
    }

    public function editCustomer(Request $request){
        $id = $request->id;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $reseller = $request->reseller;
         try {
                // DB::beginTransaction();               

                $cust = DB::table('ms_customer')
                ->select('id','created_at' ,'updated_at')
                ->where('id', '=', $id) 
                ->first();

                DB::table('ms_customer')
                    ->where('id', '=', $id)
                    ->update(
                                [                                     
                                    'nama' => $nama,
                                    'alamat' => $alamat,
                                    'telephone' => $telp, 
                                    'jenis_reseller' => $reseller,
                                    'created_at' => $cust->created_at                                    
                                ]
                            );                               
            
                $result='sukses';
            return response()->json($result);

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function deleteCustomer(Request $request){
        $id = $request->id;
         try {
                // DB::beginTransaction();               

                $cust = DB::table('ms_customer')
                ->select('id','created_at' ,'updated_at')
                ->where('id', '=', $id) 
                ->first();

                DB::table('ms_customer')
                    ->where('id', '=', $id)
                    ->update(
                                [ 
                                    'isDell' => 1,
                                    'created_at' => $cust->created_at                                    
                                ]
                            );                               
            
                $result='sukses';
            return response()->json($result); 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function getOrderMonthCustomer(Request $request){
        $id = $request->id; 
         try {
                $mt='';
                $yr='';
                $year = date('Y');
                $month = date('m');
                $day = date('d');

                $data = []; 

                $now = $year.'-'.$month.'-'.$day.' 23:59:59';

                if($month=='01'){$mt='12'; $intyr = (int)$year; $yr=$intyr-1;}else{$intmnth = (int)$month; $mt=$intmnth-1; $yr=$year;}
                $yesterday = $yr.'-'.$mt.'-26 00:00:00';
                // DB::beginTransaction();
                $cust =
                DB::table('ms_customer')
                ->select('ms_customer.id as id','ms_customer.username as userId', 'ms_customer.nama as nama', 'ms_customer.diskon as diskon')
                ->where('ms_customer.id', '=', $id)
                ->first();              

                $custOrder = DB::table('order')
                ->select('order.id','order.code_customer' ,'order.biayaExpedisi','order.total_harga' ,'order.totalDiskon')
                ->join('transaksi','transaksi.code_order','=','order.id')
                ->where('order.code_customer', '=', $id)
                ->where('transaksi.code_status', '=', 10)
                ->whereBetween('order.created_at',[$yesterday,$now])
                ->get();
                
                $expedisi = 0 ; $harga=0; $diskon=0;

                foreach($custOrder as $cst){
                    $expedisi = $expedisi + $cst->biayaExpedisi;
                    $harga = $harga + $cst->total_harga;
                    $diskon = $diskon + $cst->totalDiskon;
                }
            
                $selisih = $harga-$diskon ;
                $data = ['id'=>$id,'nama'=>$cust->nama,'diskon'=>$cust->diskon, 'totalExpedisi'=>$expedisi, 'totalBelanja' => $harga, 'diskonBelanja' => $diskon ,'selisih' => $selisih ];

            return response()->json($data);

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function updateDiskon(Request $request){
        $id = $request->id; 
        $diskon = $request->diskon; 
         try {
                // DB::beginTransaction();               

                $cust = DB::table('ms_customer')
                ->select('id','created_at' ,'updated_at')
                ->where('id', '=', $id) 
                ->first();

                DB::table('ms_customer')
                    ->where('id', '=', $id)
                    ->update(
                                [ 
                                    'diskon' => $diskon,
                                    'created_at' => $cust->created_at                                    
                                ]
                            );                               
            
                $result='sukses';
            return $result; 

        } catch (\Exception $ex) {
            // DB::rollBack();
            return $ex;
        }
    }

    public function searchCustomerInvoice(Request $request) {

        $token = $request->token;
        $nama = $request->nama;
        $id = $request->id;
        $offset = $request->offset;
        $kodeAdmin = $request->kodeAdmin;
        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            if($token=='3b0rtr62le')
            {
                $result= [
                    'data' => $this->getCustomer($nama,$id,$offset,$kodeAdmin),
                    'count' => $this->getCustomerCount($nama,$id,$offset,$kodeAdmin),
                ];

            }

            else
            {
                $result = 'Invalid Token';   
            }  

                    return response()->json($result); 

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function getCustomer($nama,$id,$offset,$kodeAdmin)
    {

        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            $result = [];
                    $result = 
                             DB::table('ms_customer')
                             ->select('ms_customer.id as  id','ms_customer.nama as nama','ms_customer.telephone')
                            //  ->join('ms_customer_alamat','ms_customer_alamat.code_customer','=','ms_customer.id')
                              ->where('ms_customer.nama', 'like','%'. $nama.'%')
                              ->where('ms_customer.id', 'like','%'. $id.'%')
                              ->where('ms_customer.kodeAdminTrx','=',$kodeAdmin)
                              ->where('ms_customer.isDell','=','0')
                              ->orderBy('ms_customer.nama','asc')
                              ->limit(10)
                              ->offset($offset)
                              ->get();

                    return $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function getCustomerCount($nama,$id,$offset,$kodeAdmin)
    {
        try {
            $result = [];

                    $result = 

                             DB::table('ms_customer')
                             ->select(DB::raw('COUNT(ms_customer.id) as count'))
                             ->where('ms_customer.nama', 'like','%'. $nama.'%')
                              ->where('ms_customer.id', 'like','%'. $id.'%')
                              ->where('ms_customer.kodeAdminTrx','=',$kodeAdmin)   
                            ->first();
                    return $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }
}
