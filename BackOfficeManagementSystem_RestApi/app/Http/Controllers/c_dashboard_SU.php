<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_dashboard_SU extends Controller
{
    //
    public function getDashboardSales(Request $request) {
        $token = $request->token;
        // $kodeAdmin = $request->kodeAdmin;
        // $kodeOrderDetail = $request->kodeOrderDetail;
        // $status = $request->status;
        // $offset = $request->offset;
        // $typeTransaksi = $request->typeTransaksi;
        // $sb1 = $request->sortBy;

        try {
            if($token=='2nkeygqp9l')
            {
                $result = [];
                // if($offset){$offset=(int)$offset;}
                // else{$offset=0;}
                    $query = 
                        DB::table('order')
                        ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as nama_pengirim','order.nama_penerima as nama_penerima','order.kab_kota as alamatOrder', 'transaksi.created_at as tanggal',
                        DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaAdmin"), 
                        'ms_status_trx.status as status', 'transaksi.updated_at as update', 'transaksi.code_status as code_status')
                        ->join('ms_customer','ms_customer.id','=','order.code_customer')
                        ->join('transaksi','transaksi.code_order','=','order.id')
                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                        // ->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                        ->orderBy('transaksi.updated_at', 'DESC')
                        ->limit(50);
                        // ->offset($offset);

                    // if($kodeOrderDetail){
                    //     $query->where('transaksi.code_order', 'like', $kodeOrderDetail.'%');
                    // }
                    // if($status){
                    //     $query->where('transaksi.code_status', 'like', $status.'%');
                    // }
                    
                    // if($sb1){
                    //     $query->orderBy($sb1, 'ASC');
                    // }
                   
                    // if($typeTransaksi == 'konfirmasi'){                        
                    //     $query->whereIn('transaksi.code_status', array(4,5,6) );
                    //     $query->where('transaksi.approve_sales','=','1');
                    // }
                    // else{
                    //     $query->whereIn('transaksi.code_status' , array(1,3));
                    //     $query->where('transaksi.approve_sales','=','0');
                    // }

                    $result=$query ->get();
            }
            else
            {
                $result = 'Invalid Token Sales Manager';   
            }    
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getDashboardFinance(Request $request) {
        $token = $request->token;

        try {
            if($token=='2nkeygqp9l')
            {
                $result = [];
                    $query = 
                    DB::table('order')
                    ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.kab_kota as alamatOrder', 'transaksi.created_at as tanggal',
                    DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaAdmin"), 
                    'ms_status_trx.status as status', 'transaksi.updated_at as update')
                    ->join('ms_customer','ms_customer.id','=','order.code_customer')
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                        // ->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                        
                        ->where('transaksi.approve_sales','=','1')
                        ->where('transaksi.approve_sales2','=','0')
                        ->orderBy('transaksi.updated_at', 'DESC')
                        ->limit(50);
                        

                    $result=$query ->get();
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
    public function getDashboardWarehouse(Request $request) {
        $token = $request->token;

        try {
            if($token=='2nkeygqp9l')
            {
                $result = [];
                    $query = 
                    DB::table('order')
                    ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama','order.nama_pengirim as nama_pengirim','order.nama_penerima as nama_penerima', 'order.kab_kota as alamatOrder', 'transaksi.created_at as tanggal',
                    DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kode_AWO) as namaAdmin"), 
                    'ms_status_trx.status as status', 'transaksi.updated_at as update', 'transaksi.code_status as code_status')
                    ->join('ms_customer','ms_customer.id','=','order.code_customer')
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                        // ->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                        ->where('transaksi.approve_sales2','=','1')
                        ->orderBy('transaksi.updated_at', 'DESC')
                        ->limit(50);
                        

                    $result=$query ->get();
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
