<?php

namespace App\Http\Controllers;

use App\mod_transaksiLog;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_adminFinance extends Controller
{
    public function getAllOrder(Request $request) {
        $token = $request->token;

        $kodeOrderDetail = $request->kodeOrderDetail;
        $offset = $request->offset;
        $sb1 = $request->sortBy;
        $typeTransaksi = $request->typeTransaksi;

        try {
            if($token=='2nkeygqp9l')
            {
                $result= [    
                'data' => $this->getOrder($offset,$kodeOrderDetail,$sb1,$typeTransaksi),
                'count' => $this->getCount($offset,$kodeOrderDetail,$sb1,$typeTransaksi),
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
    public function getOrder($offset,$kodeOrderDetail,$sb1,$typeTransaksi)
    {
        try{
            $result = [];
                if($offset){$offset=(int)$offset;}
                else{$offset=0;}
                    $query = 
                        DB::table('order')
                        ->select('transaksi.id as id', 'order.id as codeOrder','order.bank as bank',DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaSales"),
                        'ms_customer.nama as nama',  'order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','transaksi.typeTransaksi as typeTransaksi', 'ms_status_trx.status as status','transaksi.created_at as tanggal', 'transaksi.updated_at as tanggalUpdated')
                        ->join('ms_customer','ms_customer.id','=','order.code_customer')
                        ->join('transaksi','transaksi.code_order','=','order.id')
                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                        ->where('transaksi.approve_sales','=','1')
                        ->where('transaksi.approve_keuangan','=','0')
                        ->where('transaksi.approve_sales2','=','0')
                        ->where('transaksi.approve_gudang','=','0')
                        //->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                        ->orderBy('transaksi.updated_at', 'ASC')
                        ->limit(10)
                        ->offset($offset);

                    if($kodeOrderDetail){
                        $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                    }
                                      
                    if($sb1){
                        $query->orderBy($sb1, 'ASC');
                    }
                   
                    if($typeTransaksi == 'konfirmasiBaru'){  
                        $query->where('transaksi.hold','=','0');
                    }
                    else{
                        $query->where('transaksi.hold','=','1');
                    }

                    $result=$query ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCount($offset,$kodeOrderDetail,$sb1,$typeTransaksi)
    {
        try{
            if($offset){$offset=(int)$offset;}
        else{$offset=0;}
   
            $query = 
            DB::table('transaksi')
                ->select(DB::raw('count(transaksi.id) as count'))
                ->where('transaksi.approve_sales','=','1')
                ->where('transaksi.approve_keuangan','=','0')
                ->where('transaksi.approve_sales2','=','0')
                ->where('transaksi.approve_gudang','=','0')
               
                //  ->groupBy('transaksi.code_perusahaan')
                ->limit(10);
          
    

                if($kodeOrderDetail){
                    $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                }
                              
           
            if($typeTransaksi == 'konfirmasiBaru'){  
                $query->where('transaksi.hold','=','0');
            }
            else{
                $query->where('transaksi.hold','=','1');
            }
            $result=$query ->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    /////////////////

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
        return     DB::table('order')
        ->select('order.id as code_order','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.total_harga as total_harga','order.totalDiskon as diskonTotal','transaksi.typeTransaksi as typeTransaksi',
        'order.kecamatan as kecamatan','order.kab_kota as kab_kota','order.propinsi as propinsi','order.pre_order as preorder', 'ms_customer.telephone as nomor','ms_customer.nama as nama','order.expedisi as ekspedisi','order.biayaExpedisi as biayaExpedisi','order.image as gambar','ms_status_trx.status as status','ms_status_trx.id as statusId','transaksi.approve_sales as approveSales','transaksi.approve_keuangan as approveKeuangan','transaksi.approve_sales2 as approveSales2','transaksi.approve_gudang as approveGudang','transaksi.keterangan as keteranganHold','order.lunas as lunas','order.created_at as tanggal')
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
        //$kodeAdmin = $request->kodeAdmin;
        $kodeOrderDetail = $request->kodeOrderDetail;
        $offset = $request->offset;
        $sortBy = $request->sortBy;

        try {
            if($token=='0xorxdo6vw')
            {
     
                $result= [
                    // 'test',
                     'data' => $this->getOrderHistori($offset,$kodeOrderDetail,$sortBy),
                      'count' => $this->getCountHistori($offset,$kodeOrderDetail,$sortBy),
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

    public function getOrderHistori($offset,$kodeOrderDetail,$sortBy)
    {
        try{
            $result = [];
            
            if($offset){$offset=(int)$offset;}
            else{$offset=0;}

                    $query =
                             DB::table('order')
                             ->select('transaksi.id as id', 'order.id as codeOrder','order.bank as bank', DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaSales"),
                             'ms_customer.nama as nama','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat', 'transaksi.typeTransaksi as typeTransaksi','ms_status_trx.status as status','transaksi.created_at as tanggal', 'order.updated_at as tanggalUpdated')
                             ->join('ms_customer','ms_customer.id','=','order.code_customer')
                         ->join('transaksi','transaksi.code_order','=','order.id')
                         ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                         ->where('transaksi.approve_sales','=','1')
                         ->where('transaksi.approve_keuangan','=','1')
                         ->orderBy('order.updated_at', 'DESC')
                         ->limit(10)
                        ->offset($offset);
                      

                        if($kodeOrderDetail){
                            $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                        }
                        
                        // if($sortBy){
                        //     $query->orderBy($sortBy, 'ASC');
                        // }                       
                        
                        $result=$query ->get();
           
                            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCountHistori($offset,$kodeOrderDetail,$sortBy)
    {
        try{

            $query = 
                DB::table('transaksi')
                ->select(DB::raw('count(transaksi.id) as count'))
               
                ->where('transaksi.approve_sales','=','1')
                ->where('transaksi.approve_keuangan','=','1')
              
                ->groupBy('transaksi.kodeAdminTrx')
                ->limit(10);
                if($kodeOrderDetail){
                    $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                }


            $result=$query ->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    /////////

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


    public function updateConfirmationbyAdminSales(Request $request) {
        $token = $request->token;
        // $approve = $request->approveKeuangan;
        $tipe = $request->tipe;
         $username = $request->username;
         $kodeOrderDetail = $request->kodeOrderDetail;
        try {
            DB::beginTransaction();
            if($token=='9g8w11thnv')
            {
                if($tipe=='pelunasan')
                {
                    DB::beginTransaction();
                    $status = '22';
                    DB::table('order')
                    ->where('id','=',$request->kodeOrderDetail)
                 
                    ->update([
                        'lunas' => '1',
                    ]);
                    $transaksi = new mod_transaksiLog();
                    $transaksi->idOrder = $request->kodeOrderDetail;
                    $transaksi->status = $status;
                    $transaksi->pic = $username;
                    $transaksi->save();
        
                    DB::commit();
                    $result='success';    
                }
                elseif($tipe=='pelunasanTempo')
                {                    
                    DB::beginTransaction();
                    
                    $getType =  DB::table('transaksi')
                    ->select('transaksi.typeTransaksi as type')
                    ->where('code_order','=',$request->kodeOrderDetail)
                    ->first();

                    $status = '22';
                    DB::table('order')
                        ->where('id','=',$request->kodeOrderDetail)
                        ->update([
                                 'lunas' => '1',

                                ]);

                    if($getType->type == 'arisan')
                    {
                        DB::table('transaksi')
                        ->where('code_order','=',$request->kodeOrderDetail)
                        ->update([
                            'approve_keuangan' => '1',
                            'approve_sales2' => '1',
                            'approve_gudang' => '0',
                            'transaksi.code_status' => '6',
                            'transaksi.no_resi' => '-',
                            'keterangan' => 'lunas hutang arisan',
                        ]);
                
                    }
                    else{
                        DB::table('transaksi')
                        ->where('code_order','=',$request->kodeOrderDetail)
                        ->update([
                            'approve_keuangan' => '1',
                            'keterangan' => 'lunas hutang',
                        ]);
                    }
               
                    $transaksi = new mod_transaksiLog();
                    $transaksi->idOrder = $request->kodeOrderDetail;
                    $transaksi->status = $status;
                    $transaksi->pic = $username;
                    $transaksi->save();
        
                    DB::commit();
                    $result='success';    
                }
                elseif($tipe=='pelunasanPindahGudang')
                {
                    DB::beginTransaction();
                    $status = '22';
                    DB::table('order')
                    ->where('id','=',$request->kodeOrderDetail)
                 
                    ->update([
                        'lunas' => '1',

                    ]);

                    DB::table('transaksi')
                    ->where('code_order','=',$request->kodeOrderDetail)
                 
                    ->update([
                        'approve_sales' => '1',
                        'approve_keuangan' => '1',
                        'approve_sales2' => '1',
                        'approve_gudang' => '1',
                        'code_status' => '10'

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
                    $trn =  DB::table('transaksi')
                    ->select('transaksi.typeTransaksi as type')
                    ->where('code_order','=',$request->kodeOrderDetail)
                    ->first();
    
                    $query =  DB::table('order')
                    ->where('id','=',$request->kodeOrderDetail);
                    if($trn->type == 'regular')
                    {
                        $query->update([
                            'lunas' => '1',
                        ]);
                
                    }
                    elseif($trn->type == 'preOrder')
                    {
                        $query->update([
                            'lunas' => '1',
                        ]);
                
                    }
                    else
                    {
                        $query->update([
                            'lunas' => '2',
                        ]);
                    }
    
                       
                        $status = '5';
                        DB::table('transaksi')
                        ->where('code_order','=',$kodeOrderDetail)
                        ->update([
                            'approve_keuangan' => '1',
                            'code_status'=>$status 
                        ]);
                    
                    
                    $transaksi = new mod_transaksiLog();
                    $transaksi->idOrder = $request->kodeOrderDetail;
                    $transaksi->status = $status;
                    $transaksi->pic = $username;
                    $transaksi->save();
                    DB::commit();
                    $result='success'; 
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

            $status = '81';
            DB::table('transaksi')
            ->where('code_order','=',$request->kodeOrderDetail)
         
            ->update([
                'hold' => '1',
                'code_status'=>$status,
                'keterangan'=> "(".$nama->nama. ") ". $keterangan
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
}
