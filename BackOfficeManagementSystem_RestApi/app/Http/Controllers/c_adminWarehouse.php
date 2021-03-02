<?php



namespace App\Http\Controllers;

use App\mod_transaksiLog;
use App\mod_return_buku;

use http\Env\Response;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Psr7\str;



class c_adminWarehouse extends Controller

{





    public function getAllOrder(Request $request) {

        $token = $request->token;

        //$kodeAdmin = $request->kodeAdmin;

        $kodeOrderDetail = $request->kodeOrderDetail;

        $typeTransaksi = $request->typeTransaksi;

        $offset = $request->offset;

        $sb1 = $request->sortBy;

        $kodeAdmin = $request->kodeAdmin;

        $namaSales= $request->namaSales;

        $namaStaf = $request->namaStaf;

        $typeOrder = $request->typeOrder;

        $nama_penerima = $request->nama_penerima;



        if(@$nama_penerima){$namaPenerima=$nama_penerima;}else{$namaPenerima='';}



        try {

            if($token=='2nkeygqp9l')

            {

                $result= [



                     'data' => $this->getOrder($offset,$kodeOrderDetail,$sb1,$typeTransaksi, $kodeAdmin, $namaSales,$namaStaf, $typeOrder,$namaPenerima),

                   'count' => $this->getCount($offset,$kodeOrderDetail,$sb1,$typeTransaksi, $kodeAdmin, $namaSales, $namaStaf, $typeOrder,$namaPenerima),

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

    /////////////////////////

    public function getOrder($offset,$kodeOrderDetail,$sb1,$typeTransaksi, $kodeAdmin, $namaSales, $namaStaf, $typeOrder,$namaPenerima)

    {

        try{

         $result = [];

                if($offset){$offset=(int)$offset;}

                else{$offset=0;}



                if(@$namaSales){

                    $tableSalesfromNama = DB::table('ms_admin')

                    ->select('kodeAdminTrx')

                    ->where('nama', 'like','%'.$namaSales.'%');

                    $resultSales=$tableSalesfromNama ->get();

                    $listKodeSalesfromNama = array();



                    $val_Sales = json_decode($resultSales);

                    foreach($val_Sales as $val){

                        if($val->kodeAdminTrx != '-')

                        {array_push($listKodeSalesfromNama, $val->kodeAdminTrx);}

                    }



                }

                if(@$namaStaf){

                    $tableStaffromNama = DB::table('ms_admin')

                    ->select('kodeAdminTrx')

                    ->where('nama', 'like','%'.$namaStaf.'%');

                    $resultStaf=$tableStaffromNama ->get();

                    $listKodeStaffromNama = array();



                    $val_Sales = json_decode($resultStaf);

                    foreach($val_Sales as $val){

                        if($val->kodeAdminTrx != '-')

                        {array_push($listKodeStaffromNama, $val->kodeAdminTrx);}

                    }

                }



                if($typeOrder != 'preOrder'){

                    $query =

                        DB::table('order')

                        ->select(DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaSales"),

                        DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kode_AWO) as namaStaf"),

                        'transaksi.id as id', 'order.id as codeOrder','ms_customer.telephone as nomorhp', 'ms_customer.nama as nama','transaksi.typeTransaksi as typeTransaksi','ms_status_trx.status as status','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.expedisi as expedisi','order.lunas as lunas','transaksi.no_resi as noResiTable','transaksi.created_at as tanggal','transaksi.cetak as cetak')

                        ->join('ms_customer','ms_customer.id','=','order.code_customer')

                        ->join('transaksi','transaksi.code_order','=','order.id')

                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')

                        ->where('transaksi.approve_sales','=','1')

                        ->where('transaksi.approve_keuangan','=','1')

                        ->where('transaksi.approve_sales2','=','1')



                        // ->where('transaksi.kode_AWO','=',$kodeAdmin)

                        ->where('transaksi.no_resi','=','-')

                        // ->where('ms_admin.nama','=','$nama')

                        ->orderBy('order.updated_at', 'ASC')

                        ->limit(10)

                        ->offset($offset);

                }

                else{

                    $query =



                    // SELECT mp.tanggal_cetak as tanggalCetak FROM `orderdetail`od join ms_promo mp on od.code_promo = mp.code_promo

                    // where code_order = 'ORD-200724-094733'

                    // ORDER by mp.tanggal_cetak DESC

                    // LIMIT 1

                        DB::table('order')

                        ->select(DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaSales"),

                        DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kode_AWO) as namaStaf"),

                        'transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama','transaksi.typeTransaksi as typeTransaksi',

                        DB::raw("(SELECT mp.tanggal_cetak as tanggalCetak FROM `orderdetail`od join ms_promo mp on od.code_promo = mp.code_promo

                        where code_order = order.id ORDER by mp.tanggal_cetak DESC LIMIT 1) as tanggalCetak"),

                        DB::raw("(SELECT mp.nama_promo as nama_promo FROM `orderdetail`od join ms_promo mp on od.code_promo = mp.code_promo

                        where code_order = order.id ORDER by mp.tanggal_cetak DESC LIMIT 1) as nama_promo"),

                        'ms_status_trx.status as status','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.expedisi as expedisi','order.lunas as lunas','transaksi.no_resi as noResiTable','transaksi.created_at as tanggal')

                        ->join('ms_customer','ms_customer.id','=','order.code_customer')

                        ->join('transaksi','transaksi.code_order','=','order.id')

                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')

                        // ->join('orderdetail','orderdetail.code_order','=','order.id')

                        // ->join('ms_promo','ms_promo.code_promo','=','order.id')

                        ->where('transaksi.approve_sales','=','1')

                        ->where('transaksi.approve_keuangan','=','1')

                        ->where('transaksi.approve_sales2','=','1')



                        // ->where('transaksi.kode_AWO','=',$kodeAdmin)

                        ->where('transaksi.no_resi','=','-')

                        // ->where('ms_admin.nama','=','$nama')

                        ->orderBy('order.updated_at', 'ASC')

                        ->limit(10)

                        ->offset($offset);

                }







                    // if($kodeAdmin != 'WH000'){



                    // }

                    if($kodeAdmin != 'WH000'){

                        $query->where('transaksi.kode_AWO','=',$kodeAdmin);

                         if(substr($kodeAdmin,0,3) == 'JKT'){

                            // $query->whereIn('transaksi.code_status', array(6,7,9));

                            if($typeTransaksi == 'cetak'){

                                // $query->where('transaksi.approve_gudang','=','0');

                                $query->where('transaksi.code_status','=',9);

                            }

                            elseif($typeTransaksi == 'pengemasan'){

                                // $query->where('transaksi.approve_gudang','=','1');

                                // $query->where('transaksi.code_status','<>','10');

                                $query->where('transaksi.code_status','=',7);

                            }

                            else{

                                // $query->where('transaksi.code_status','<>','10');

                                $query->where('transaksi.code_status','=',6);

                            }

                         }else{

                             $query->whereIn('transaksi.code_status', array(6,7));

                         }



                        if($typeTransaksi == 'konfirmasiBaru'){

                            $query->where('transaksi.approve_gudang','=','0');

                            if($typeOrder != 'preOrder'){

                                $query->where('transaksi.typeTransaksi','<>','preOrder');

                            }

                            else{

                                $query->where('transaksi.typeTransaksi','=','preOrder');

                            }

                        }

                        else{

                            $query->where('transaksi.approve_gudang','=','1');

                        }



                    }

                    else{

                        if($typeTransaksi == 'konfirmasiBaru'){

                            if($sb1=='menungguKonfirmasi'){

                                $query->where('transaksi.code_status','=', 6);

                            }

                            elseif($sb1=='prosesKemas'){

                                $query->where('transaksi.code_status','=', 7);

                            }

                            else{

                                $query->whereIn('transaksi.code_status', array(6,7));

                            }

                        }

                        if($typeTransaksi == 'cetak'){

                             $query->where('transaksi.code_status','=',9);

                        }



                    }



                    if(substr($kodeAdmin,0,3) == 'JKT'){

                        $query->where('transaksi.code_perusahaan', '=', '2');



                    }

                    else{

                        $query->where('transaksi.code_perusahaan', '=', '1');

                    }

                    // if($kodeAdmin == 'WH000' && $typeTransaksi == 'cetak'){



                    // }

                    // if($kodeAdmin == 'WH000' && $typeTransaksi == 'konfirmasiBaru'){



                    // }

                    if($kodeOrderDetail){

                        $query->where('transaksi.code_order', 'like','%'. $kodeOrderDetail.'%');

                    }

                    if($namaPenerima){

                        $query->where('order.nama_penerima', 'like','%'. $namaPenerima.'%');

                    }

                    if(@$namaSales){

                        $query->whereIn('transaksi.kodeAdminTrx', $listKodeSalesfromNama);

                        // $query->where('ms_admin.nama', 'like', $namaSales.'%');

                    }

                    if(@$namaStaf){

                        $query->whereIn('transaksi.kode_AWO', $listKodeStaffromNama);

                        // $query->where('ms_admin.nama', 'like', $namaSales.'%');

                    }









                    $result=$query ->get();



                return   $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function getCount($offset,$kodeOrderDetail,$sb1,$typeTransaksi, $kodeAdmin, $namaSales, $namaStaf, $typeOrder,$namaPenerima)

    {

        try{

            if($offset){$offset=(int)$offset;}

        else{$offset=0;}



        if(@$namaSales){

            $tableSalesfromNama = DB::table('ms_admin')

            ->select('kodeAdminTrx')

            ->where('nama', 'like','%'.$namaSales.'%');

            $resultSales=$tableSalesfromNama ->get();

            $listKodeSalesfromNama = array();



            $val_Sales = json_decode($resultSales);

            foreach($val_Sales as $val){

                if($val->kodeAdminTrx != '-')

                {array_push($listKodeSalesfromNama, $val->kodeAdminTrx);}

            }

        }

        if(@$namaStaf){

            $tableStaffromNama = DB::table('ms_admin')

            ->select('kodeAdminTrx')

            ->where('nama', 'like','%'.$namaStaf.'%');

            $resultStaf=$tableStaffromNama ->get();

            $listKodeStaffromNama = array();



            $val_Sales = json_decode($resultStaf);

            foreach($val_Sales as $val){

                if($val->kodeAdminTrx != '-')

                {array_push($listKodeStaffromNama, $val->kodeAdminTrx);}

            }

        }



            $query =

                DB::table('transaksi')

                ->select(DB::raw('count(transaksi.id) as count'))

                ->join('order', 'order.id', '=', 'transaksi.code_order')

                // ->join('ms_admin','ms_admin.kodeAdminTrx','=','transaksi.kodeAdminTrx')

                ->where('transaksi.approve_sales','=','1')

                ->where('transaksi.approve_keuangan','=','1')

                ->where('transaksi.approve_sales2','=','1')

                // ->where('transaksi.kode_AWO','=',$kodeAdmin)

                ->where('transaksi.no_resi','=','-')

                ->limit(10);



                if($kodeAdmin != 'WH000'){

                    $query->where('transaksi.kode_AWO','=',$kodeAdmin);

                         if(substr($kodeAdmin,0,3) == 'JKT'){

                            // $query->whereIn('transaksi.code_status', array(6,7,9));

                            if($typeTransaksi == 'cetak'){

                                // $query->where('transaksi.approve_gudang','=','0');

                                $query->where('transaksi.code_status','=',9);

                            }

                            elseif($typeTransaksi == 'pengemasan'){

                                // $query->where('transaksi.approve_gudang','=','1');

                                // $query->where('transaksi.code_status','<>','10');

                                $query->where('transaksi.code_status','=',7);

                            }

                            else{

                                // $query->where('transaksi.code_status','<>','10');

                                $query->where('transaksi.code_status','=',6);

                            }

                         }else{

                             $query->whereIn('transaksi.code_status', array(6,7));

                         }



                        if($typeTransaksi == 'konfirmasiBaru'){

                            $query->where('transaksi.approve_gudang','=','0');

                            if($typeOrder != 'preOrder'){

                                $query->where('transaksi.typeTransaksi','<>','preOrder');

                            }

                            else{

                                $query->where('transaksi.typeTransaksi','=','preOrder');

                            }

                        }

                        else{

                            $query->where('transaksi.approve_gudang','=','1');

                        }



                    // $query->where('transaksi.kode_AWO','=',$kodeAdmin);

                    // $query->whereIn('transaksi.code_status', array(6,7));

                    // if($typeTransaksi == 'konfirmasiBaru'){

                    //     $query->where('transaksi.approve_gudang','=','0');

                    // }

                    // else{

                    //     $query->where('transaksi.approve_gudang','=','1');

                    // }

                    // if($typeOrder != 'preOrder'){

                    //     $query->where('transaksi.typeTransaksi','<>','preOrder');

                    // }

                    // else{

                    //     $query->where('transaksi.typeTransaksi','=','preOrder');

                    // }

                }

                else{

                    if($typeTransaksi == 'konfirmasiBaru'){

                        if($sb1=='menungguKonfirmasi'){

                            $query->where('transaksi.code_status','=', 6);

                        }

                        elseif($sb1=='prosesKemas'){

                            $query->where('transaksi.code_status','=', 7);

                        }

                        else{

                            $query->whereIn('transaksi.code_status', array(6,7));

                        }

                    }

                    if($typeTransaksi == 'cetak'){

                         $query->where('transaksi.code_status','=',9);

                    }

                }



                if(substr($kodeAdmin,0,3) == 'JKT'){

                    $query->where('transaksi.code_perusahaan', '=', '2');

                }

                else{

                    $query->where('transaksi.code_perusahaan', '=', '1');

                }



                if($kodeOrderDetail){

                    $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');

                }

                if($namaPenerima){

                    $query->where('order.nama_penerima', 'like', '%'.$namaPenerima.'%');

                }

                if(@$namaSales){

                    $query->whereIn('transaksi.kodeAdminTrx', $listKodeSalesfromNama);

                    // $query->where('ms_admin.nama', 'like', $namaSales.'%');

                }

                if(@$namaStaf){

                    $query->whereIn('transaksi.kode_AWO', $listKodeStaffromNama);

                    // $query->where('ms_admin.nama', 'like', $namaSales.'%');

                }



                // if($typeTransaksi == 'konfirmasiBaru'){

                //     $query->where('transaksi.approve_gudang','=','0');

                // }

                // else{

                //     $query->where('transaksi.approve_gudang','=','1');

                // }





            $result=$query ->first();

            return   $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    /////////////////////////



    public function getDetailTransaction(Request $request) {

        $token = $request->token;

        $kodeOrderDetail = $request->kodeOrderDetail;



        try {

            if($token=='6lscxf2ypx')

            {

                $result= [

                    'orderDetail' => $this->getOrderDetail($kodeOrderDetail),

                    'itemOrder' => $this->getItemOrder($kodeOrderDetail),

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



    public function getOrderDetail($idOrder)

    {

        try{

        return    DB::table('order')

    //     ->select('order.id as code_order','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.kab_kota as kab_kota','order.propinsi as propinsi','order.pre_order as preorder', 'ms_customer.telephone as nomor','ms_customer.nama as nama','order.expedisi as ekspedisi','order.biayaExpedisi as biayaExpedisi','order.image as gambar','ms_status_trx.status as status','ms_status_trx.id as statusId','transaksi.approve_sales as approveSales','transaksi.approve_keuangan as approveKeuangan','transaksi.approve_sales2 as approveSales2','transaksi.approve_gudang as approveGudang','transaksi.keterangan as keteranganHold','order.created_at as tanggal', 'order.totalDiskon as totalDiskon','transaksi.typeTransaksi as typeTransaksi')

    //     ->join('transaksi','transaksi.code_order','=','order.id')

	// // ->join('ms_expedisi','ms_expedisi.id','=','order.expedisi')

    //     ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status' )

    //     ->join('ms_customer','ms_customer.id','=','order.code_customer')

    //     // ->where('transaksi.approveSales','=','0')

    //     ->where('order.id','=',$idOrder)

        ->select('order.id as code_order','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.total_harga as total_harga','order.totalDiskon as diskonTotal','transaksi.typeTransaksi as typeTransaksi',

        'order.kecamatan as kecamatan','order.kab_kota as kab_kota','order.propinsi as propinsi','order.pre_order as preorder', 'ms_customer.telephone as nomor','ms_customer.telephone as nomorhp','ms_customer.nama as nama','order.expedisi as ekspedisi','order.biayaExpedisi as biayaExpedisi','order.image as gambar','ms_status_trx.status as status','ms_status_trx.id as statusId','transaksi.approve_sales as approveSales','transaksi.approve_keuangan as approveKeuangan','transaksi.approve_sales2 as approveSales2','transaksi.approve_gudang as approveGudang','transaksi.keterangan as keteranganHold','order.created_at as tanggal')

        ->join('transaksi','transaksi.code_order','=','order.id')



        ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status' )

        ->join('ms_customer','ms_customer.id','=','order.code_customer')

        // ->where('transaksi.approveSales','=','0')

        ->where('order.id','=',$idOrder)

        ->get();

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function getItemOrder($idOrder)

    {

        try{

        return DB::table('orderdetail')

        ->select('orderdetail.code_barang as kodeBarang','ms_barang.judul_buku as judulBuku','orderdetail.jumlah as qty','orderdetail.harga as harga','orderdetail.diskon as diskon','orderdetail.code_promo as code_promo','orderdetail.nama_promo as nama_promo','orderdetail.harga_promo as harga_promo',DB::raw('(orderdetail.jumlah) * (orderdetail.harga) as subTotal'))

        ->join('ms_barang','ms_barang.id','=','orderdetail.code_barang')

        ->where('orderdetail.code_order','=',$idOrder)

        ->get();

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }





    public function getTransaksiKonfirmasi(Request $request) {

        $sales=$request->kodeAdmin;

        try {

            return [

                 'konfirmasiKeuangan' => $this->konfirmasiKeuangan($sales),

                 'sales' => $this->sales($sales),

                'konfirmasiGudang' => $this->konfirmasiGudang($sales),

            ];

        } catch (\Exception $ex) {

            return response()->json([$ex]);

        }

    }









    public function konfirmasiKeuangan($sales) {

        return DB::table('transaksi')

        ->select(DB::raw('COUNT(transaksi.id) as Total'))

        ->where('transaksi.approveSales','=','1')

        ->where('transaksi.approveKeuangan','=','1')

        ->where('transaksi.approveGudang','=','0')



        ->where('transaksi.sales','=',$sales)

            ->get();

    }

    public function sales($sales) {

        return DB::table('transaksi')

        ->select(DB::raw('COUNT(transaksi.id) as Total'))

        ->where('transaksi.approveSales','=','1')

        ->where('transaksi.approveKeuangan','=','1')

        ->where('transaksi.approveSales2','=','1')

        ->where('transaksi.approveGudang','=','0')



        ->where('transaksi.sales','=',$sales)

            ->get();

    }



    public function konfirmasiGudang($sales) {

        return DB::table('transaksi')

        ->select(DB::raw('COUNT(transaksi.id) as Total'))

        ->where('transaksi.approveSales','=','1')

        ->where('transaksi.approveKeuangan','=','1')

        ->where('transaksi.approveGudang','=','1')

        ->where('transaksi.sales','=',$sales)

        ->get();

    }



    public function history(Request $request) {

        $token = $request->token;

        $kodeAdmin = $request->kodeAdmin;

        $kodeOrderDetail = $request->kodeOrderDetail;

        $offset = $request->offset;

        $sortBy = $request->sortBy;

        $namaSales = $request->namaSales;

        $namaStaf = $request->namaStaf;

        $nama_penerima = $request->nama_penerima;



        if(@$nama_penerima){$namaPenerima=$nama_penerima;}else{$namaPenerima='';}





        try {

            if($token=='0xorxdo6vw')

            {

                $result= [

                    'data' => $this->getOrderHistori($offset,$kodeOrderDetail,$sortBy,$kodeAdmin, $namaSales, $namaStaf, $namaPenerima),

                    'count' => $this->getCountHistori($offset,$kodeOrderDetail,$sortBy,$kodeAdmin, $namaSales, $namaStaf, $namaPenerima),

                ];

                    }

                    else

                    {

                        $result = 'Invalid Token';

                    }



                    return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($result);

        }

    }

    public function getOrderHistori($offset,$kodeOrderDetail,$sortBy,$kodeAdmin, $namaSales, $namaStaf, $namaPenerima)

    {

        try{

            $result = [];



            if($offset){$offset=(int)$offset;}

            else{$offset=0;}

            if(@$namaSales){

                $tableSalesfromNama = DB::table('ms_admin')

                ->select('kodeAdminTrx')

                ->where('nama', 'like','%'.$namaSales.'%');

                $resultSales=$tableSalesfromNama ->get();

                $listKodeSalesfromNama = array();



                $val_Sales = json_decode($resultSales);

                foreach($val_Sales as $val){

                    if($val->kodeAdminTrx != '-')

                    {array_push($listKodeSalesfromNama, $val->kodeAdminTrx);}

                }



            }

            if(@$namaStaf){

                $tableStaffromNama = DB::table('ms_admin')

                ->select('kodeAdminTrx')

                ->where('nama', 'like','%'.$namaStaf.'%');

                $resultStaf=$tableStaffromNama ->get();

                $listKodeStaffromNama = array();



                $val_Sales = json_decode($resultStaf);

                foreach($val_Sales as $val){

                    if($val->kodeAdminTrx != '-')

                    {array_push($listKodeStaffromNama, $val->kodeAdminTrx);}

                }

            }

                    $query =

                    DB::table('transaksi')

                    ->select("transaksi.kodeAdminTrx as namaSales",
                            "transaksi.kode_AWO as namaStaf",
                            'transaksi.id as id', 'order.id as codeOrder','ms_customer.nama as nama', 'transaksi.typeTransaksi as typeTransaksi','ms_status_trx.status as status', 'order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.expedisi as expedisi','transaksi.no_resi as noResiTable','transaksi.created_at as tanggal','ms_customer.telephone as nomorhp')



                        ->join('order','transaksi.code_order','=','order.id')

                        ->join('ms_customer','ms_customer.id','=','order.code_customer')

                        // ->join('ms_admin', 'ms_admin.kodeAdminTrx', '=', 'transaksi.kodeAdminTrx')

                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')

                        ->where('transaksi.approve_sales','=','1')

                        ->where('transaksi.approve_keuangan','=','1')

                        ->where('transaksi.approve_sales2','=','1')

                        ->where('transaksi.approve_gudang','=','1')

                        // ->where('transaksi.kode_AWO','=',$kodeAdmin)

                        // ->where('transaksi.no_resi','<>','-')

                        //->where('transaksi.kodeAdminTrx','=',$kodeAdmin)

                        ->orderBy('order.created_at', 'DESC')

                        ->limit(10)

                        ->offset($offset);



                        if(@$kodeAdmin != 'WH000'){

                            $query->where('transaksi.kode_AWO','=',$kodeAdmin);

                       }

                        if(@$kodeOrderDetail){

                            $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');

                        }

                        if(@$kodeAdmin == 'WH000'){

                            $query->where('transaksi.code_status','=',10);

                        }

                        else{

                            // $vlsalesitemid=()

                            $query->whereIn('transaksi.code_status', [9,10,91]);

                            // $query->where('transaksi.code_status', array(9,10));

                        }

                        if(@$namaSales){

                            $query->whereIn('transaksi.kodeAdminTrx',  $listKodeSalesfromNama);

                        }

                        if(@$namaStaf){

                            $query->whereIn('transaksi.kode_AWO',  $listKodeStaffromNama);

                        }

                        if($namaPenerima){

                            $query->where('order.nama_penerima', 'like', $namaPenerima.'%');

                        }



                        if($sortBy){

                            $query->orderBy($sortBy, 'ASC');

                        }



                        if(substr($kodeAdmin,0,3) == 'JKT'){

                            $query->where('transaksi.code_perusahaan', '=', '2');

                        }

                        else{

                            $query->where('transaksi.code_perusahaan', '=', '1');

                        }



                        $result=$query ->get();



                            return   $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

    public function getCountHistori($offset,$kodeOrderDetail,$sortBy, $kodeAdmin, $namaSales, $namaStaf, $namaPenerima)

    {

        try{

            if(@$namaSales){

                $tableSalesfromNama = DB::table('ms_admin')

                ->select('kodeAdminTrx')

                ->where('nama', 'like','%'.$namaSales.'%');

                $resultSales=$tableSalesfromNama ->get();

                $listKodeSalesfromNama = array();



                $val_Sales = json_decode($resultSales);

                foreach($val_Sales as $val){

                    if($val->kodeAdminTrx != '-')

                    {array_push($listKodeSalesfromNama, $val->kodeAdminTrx);}

                }



            }

            if(@$namaStaf){

                $tableStaffromNama = DB::table('ms_admin')

                ->select('kodeAdminTrx')

                ->where('nama', 'like','%'.$namaStaf.'%');

                $resultStaf=$tableStaffromNama ->get();

                $listKodeStaffromNama = array();



                $val_Sales = json_decode($resultStaf);

                foreach($val_Sales as $val){

                    if($val->kodeAdminTrx != '-')

                    {array_push($listKodeStaffromNama, $val->kodeAdminTrx);}

                }

            }



            $query =

                    DB::table('order')

                    ->select(DB::raw('count(order.id) as count'))

                        ->join('ms_customer','ms_customer.id','=','order.code_customer')

                        ->join('transaksi','transaksi.code_order','=','order.id')

                        // ->join('ms_admin', 'ms_admin.kodeAdminTrx', '=', 'transaksi.kodeAdminTrx')

                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')

                        ->where('transaksi.approve_sales','=','1')

                        ->where('transaksi.approve_keuangan','=','1')

                        ->where('transaksi.approve_sales2','=','1')

                        ->where('transaksi.approve_gudang','=','1');

                        // ->where('transaksi.kode_AWO','=',$kodeAdmin)

                        // ->where('transaksi.no_resi','<>','-')

                        //->where('transaksi.kodeAdminTrx','=',$kodeAdmin)

                        // ->orderBy('order.created_at', 'DESC')

                        // ->limit(10);



                        if(@$kodeAdmin != 'WH000'){

                            $query->where('transaksi.kode_AWO','=',$kodeAdmin);

                       }

                        if(@$kodeOrderDetail){

                            $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');

                        }

                        if(@$kodeAdmin == 'WH000'){

                            $query->where('transaksi.code_status','=',10);

                        }

                        else{

                            // $vlsalesitemid=()

                            $query->whereIn('transaksi.code_status', [9,10,91]);

                            // $query->where('transaksi.code_status', array(9,10));

                        }

                        if(@$namaSales){

                            $query->whereIn('transaksi.kodeAdminTrx',  $listKodeSalesfromNama);

                        }

                        if(@$namaStaf){

                            $query->whereIn('transaksi.kode_AWO',  $listKodeStaffromNama);

                        }

                        if($namaPenerima){

                            $query->where('order.nama_penerima', 'like', $namaPenerima.'%');

                        }



                        // if($sortBy){

                        //     $query->orderBy($sortBy, 'ASC');

                        // }



                        if(substr($kodeAdmin,0,3) == 'JKT'){

                            $query->where('transaksi.code_perusahaan', '=', '2');

                        }

                        else{

                            $query->where('transaksi.code_perusahaan', '=', '1');

                        }







            $result=$query ->first();

            return   $result;

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    ////////////////

    public function historyDetail(Request $request) {

        $token = $request->token;

        $kodeOrderDetail = $request->kodeOrderDetail;



        try {

            if($token=='cc82gl12eu')

            {

            $result= [

            'orderDetail' => $this->getOrderDetail($kodeOrderDetail),

            'itemOrder' => $this->getItemOrder($kodeOrderDetail),

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





    /////////////////////////////////////////////////





    public function updateConfirmationbyAdminSales(Request $request) {

        $token = $request->token;

        //$approve = $request->approveKeuangan;

         $username = $request->username;

         $no_resi = $request->noResi;

         $tipeKonfirmasi = $request->tipeKonfirmasi;



         if(empty($no_resi)){

             $resi='-';

             if($tipeKonfirmasi=='konfirmasi'){$status = '7';}

             else{$status = '9';}

            }

         else{$resi=$no_resi;$status = '10';}

        try {

            if($token=='9g8w11thnv')

            {

                    DB::beginTransaction();
                    // $status = '7';

                    if($tipeKonfirmasi=='updateStafGudang'){

                         DB::table('transaksi')

                        ->where('code_order','=',$request->kodeOrderDetail)

                        ->update([

                             'approve_gudang' => '0',

                             'kode_AWO'=>$username

                         ]);
                        
                    }

                    else{

                        DB::table('transaksi')

                        ->where('code_order','=',$request->kodeOrderDetail)

                        ->update([

                            'approve_gudang' => '1',

                            'code_status'=>$status,

                            'no_resi' => $resi

                        ]);

                    }
                    
                    // if($tipeKonfirmasi=='konfirmasi'){

                    //     DB::table('transaksi')

                    //     ->where('code_order','=',$request->kodeOrderDetail)

                    //     ->update([

                    //         'approve_gudang' => '1',

                    //         'code_status'=> $status

                    //     ]);

                    // }                    
                    // elseif($tipeKonfirmasi=='dikemas'){

                    //     DB::table('transaksi')

                    //     ->where('code_order','=',$request->kodeOrderDetail)

                    //     ->update([

                    //         'approve_gudang' => '1',

                    //         'code_status'=> $status

                    //     ]);

                    // }                    
                    // else{

                    //     DB::table('transaksi')

                    //     ->where('code_order','=',$request->kodeOrderDetail)

                    //     ->update([

                    //         'approve_gudang' => '1',

                    //         'code_status'=>$status,

                    //         'no_resi' => $resi

                    //     ]);

                    // }



                $transaksi = new mod_transaksiLog();

                $transaksi->idOrder = $request->kodeOrderDetail;

                $transaksi->status = $status;

                $transaksi->pic = $username;

                $transaksi->save();

                DB::commit();

                $result='success';

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





    public function holdOrder(Request $request) {

        $token = $request->token;

        $username = $request->username;

        $keterangan = $request->keterangan;

        try {

            if($token=='idd5vr6owk')

            {

            DB::beginTransaction();



            $nama = DB::table('ms_admin')

            ->select('ms_admin.nama as nama')

            ->where('ms_admin.username','=',$username)

            ->first();



            $status = '91';

            DB::table('transaksi')

            ->where('code_order','=',$request->kodeOrderDetail)



            ->update([

                'hold' => '1',

                'code_status'=>$status,

                'keterangan'=>"(".$nama->nama. ") ". $keterangan

            ]);

            $transaksi = new mod_transaksiLog();

            $transaksi->idOrder = $request->kodeOrderDetail;

            $transaksi->status = $status;

            $transaksi->pic = $username;

            $transaksi->save();



            DB::commit();

            $result='success';

        }

        else

        {

            $result = 'Invalid Token';

        }

        return response()->json($result);

                } catch (\Exception $ex) {

                DB::rollBack();

                return response()->json($ex);

            }

    }





    public function activeholdOrder(Request $request) {

        $token = $request->token;

        $username = $request->username;

        $keterangan = $request->keterangan;

        try {

            if($token=='wjnq3cen26')

            {

            DB::beginTransaction();

            $status = '1';

            DB::table('transaksi')

            ->where('code_order','=',$request->kodeOrderDetail)



            ->update([

                'hold' => '0',

                'code_status'=>$status,

                'keterangan'=>$keterangan

            ]);

            $transaksi = new mod_transaksiLog();

            $transaksi->idOrder = $request->kodeOrderDetail;

            $transaksi->status = $status;

            $transaksi->pic = $username;

            $transaksi->save();



            DB::commit();

                 $result='success';

            }

                 else

                 {

                     $result = 'Invalid Token';

                 }

                 return response()->json($result);

                } catch (\Exception $ex) {

                DB::rollBack();

                return response()->json($ex);

        }

    }



    public function cekValidasiItem(Request $request) {

        $token = $request->token;

        $code_order = $request->code_order;

        $code_barang = $request->code_barang;

        $status_barang = $request->status_barang;

        $keterangan = $request->keterangan;

        try {

            if($token=='zids3cen26')

            {

            DB::beginTransaction();



            DB::table('orderdetail')

            ->where('code_order','=',$code_order)

            ->where('code_barang','=',$code_barang)

            ->update([



                'status_barang'=>$status_barang,

                'keterangan'=>$keterangan

            ]);



            DB::commit();

                 $result='success';

            }

                 else

                 {

                     $result = 'Invalid Token';

                 }

                 return response()->json($result);

                } catch (\Exception $ex) {

                DB::rollBack();

                return response()->json($ex);

        }

    }

    public function hibahreturn(Request $request) {

        $token = $request->token;

        $type = $request->type;
        $code_barang = $request->code_barang;
        $jumlah = $request->jumlah;
        $pic = $request->kodeAdminTrx;
        $asal = $request->asal;
        $keterangan = $request->keterangan;

        try {

            if($token=='idd5vr6owk')
            {
                mod_return_buku::create([
                'type'=> $request->type,
                'code_barang'=>$request->code_barang,
                'jumlah'=> $request->jumlah,
                'pic'=>$request->kodeAdminTrx,
                'asal'=> $request->asal,
                'keterangan'=>$request->keterangan,
                ]);

		if(strtoupper(substr($request->asal,0,2))=='GD'){
		$bukuGudang = DB::table('ms_barang_stock')
                            ->select('d','k')
                            ->where('code_barang','=',$request->code_barang)
                            ->where('code_gudang','=',$request->asal)
                            ->first();
		}

                $buku = DB::table('ms_barang_stock')
                            ->select('d','k')
                            ->where('code_barang','=',$request->code_barang)
                            ->where('code_gudang','=','Gd_001')
                            ->first();

                if($request->type=='hibah'){
                    $now = $buku->k + $request->jumlah;
                     DB::table('ms_barang_stock')
                     ->where('code_barang','=',$request->code_barang)
                     ->where('code_gudang','=','Gd_001')
                     ->update([
                        'k'=> $now
                     ]);
		  $result='success';
                }
                if($request->type=='return'){
		   if(strtoupper(substr($request->asal,0,2))=='GD'){
		   	if($bukuGudang != null){
			  $nowGudang = $bukuGudang->k + $request->jumlah;
			  if($bukuGudang->d < $nowGudang){$result='Jumlah buku yang dipilih melebihi stock di gudang asal';}
			  else{
			   DB::table('ms_barang_stock')
                           ->where('code_barang','=',$request->code_barang)
                           ->where('code_gudang','=',$request->asal)
                           ->update([
                               'k'=> $nowGudang
                            ]);

			   $now = $buku->d + $request->jumlah;
                           DB::table('ms_barang_stock')
                           ->where('code_barang','=',$request->code_barang)
                           ->where('code_gudang','=','Gd_001')
                           ->update([
                               'd'=> $now
                            ]);
			  }
				$result='success';
			}
			else{
			  $result='Buku yang dipilih tidak ada di gudang yang dipilih';
			}
                   }
		   else{
		    $now = $buku->d + $request->jumlah;
                    DB::table('ms_barang_stock')
                     ->where('code_barang','=',$request->code_barang)
                     ->where('code_gudang','=','Gd_001')
                     ->update([
                        'd'=> $now
                     ]);

		    $result='success';
		   }
                }


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
     public function gethibahreturn(Request $request) {
        $token = $request->token;
	$dateFrom= $request->dateFrom;
	$dateTo= $request->dateTo;
	$dateTimeFrom = $dateFrom." 00:00:01";
	$dateTimeTo = $dateTo." 23:59:59";
         try {

            if($token=='idd5vr6owk')
            {
                $result = DB::table('ms_return_buku')
                            ->select('ms_return_buku.type', 'ms_return_buku.code_barang', 'ms_barang.judul_buku', 'ms_return_buku.jumlah', 'ms_return_buku.asal', 'ms_return_buku.keterangan', 'ms_return_buku.pic')
                            ->join('ms_barang', 'ms_return_buku.code_barang','=','ms_barang.id')
                            ->orderBy('ms_return_buku.created_at','asc')
			    ->whereBetween('ms_return_buku.created_at', [$dateTimeFrom , $dateTimeTo])
                            ->get();
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

}
