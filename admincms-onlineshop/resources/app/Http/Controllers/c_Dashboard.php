<?php

namespace App\Http\Controllers;

use App\order;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_dashboard extends Controller
{
    public function dashboard(Request $request) {
        $sales=$request->kodeAdmin;
        $token = $request->token;
        try {
            if($token=='2vo7ots08a')
            {
            return [
                'orderBaru' => $this->orderBaru($sales),
                 'konfirmasiKeuangan' => $this->konfirmasiKeuangan($sales),
                'konfirmasiGudang' => $this->konfirmasiGudang($sales),
                'selesaiTransaksi' => $this->selesaiTransaksi($sales),
                'konfirmasiKeuanganBaru' => $this->konfirmasiKeuanganBaru($sales),
                'setujuKonfirmasiKeuangan' => $this->setujuKonfirmasiKeuangan($sales),
                'tahanTransaksiKeuangan' => $this->tahanTransaksiKeuangan($sales),
                'semuaKonfirmasiKauangan' => $this->semuaKonfirmasiKauangan($sales),
                'konfirmasiGudangBaru' => $this->konfirmasiGudangBaru($sales),
                'setujuKonfirmasiGudang' => $this->setujuKonfirmasiGudang($sales),
                'tahanTransaksiGudang' => $this->tahanTransaksiGudang($sales),
                'semuaKonfirmasiGudang' => $this->semuaKonfirmasiGudang($sales),
                 'semuaTransaksi' => $this->semuaTransaksi(),
                 'jumlahTransaksiperBulan' => $this->jumlahTransaksiperBulan($sales),
                 'jumlahTransaksiAdminSales' => $this->jumlahTransaksiSetiapAdminSales(),
                  'topOrder' => $this ->topOrder($sales),
                  'jumlahTransaksiSetiapAdminGudangBaru' => $this ->jumlahTransaksiSetiapAdminGudangBaru(),
                  'jumlahTransaksiSetiapAdminGudangSelesai' => $this ->jumlahTransaksiSetiapAdminGudangSelesai()
                  
                //  'transaksiBulanan' => $this->transaksiBulanan(),
            ];
        }
        else
        {
             $result = 'Invalid Token';   
             return response()->json($result);
        }     
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }

    public function orderBaru($sales) {
        // $startDate = 
        if(@$sales != 'SA00X'){
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','0')
            ->where('transaksi.approve_keuangan','=','0')
            ->where('transaksi.approve_gudang','=','0')
            ->where('transaksi.hold','=','0')
        //    ->where('order.created_at','like', date('Y-m-d').'%')
            ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();}
        else{
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','0')
            ->where('transaksi.approve_keuangan','=','0')
            ->where('transaksi.approve_gudang','=','0')
            ->where('transaksi.hold','=','0')
        //    ->where('order.created_at','like', date('Y-m-d').'%')
            // ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();
        }
    }

    public function konfirmasiKeuangan($sales) {
        if(@$sales != 'SA00X'){
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_gudang','<>','1')
            ->where('transaksi.hold','=','0')
            // ->where('order.created_at','like', date('Y-m-d').'%')
            ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();}
        else{
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_gudang','<>','1')
            ->where('transaksi.hold','=','0')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        // ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();
        }
    }

    public function konfirmasiGudang($sales) {
        if(@$sales != 'SA00X'){
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_sales2','=','0')
            ->where('transaksi.approve_gudang','=','0')
            ->where('transaksi.hold','=','0')
            // ->where('order.created_at','like', date('Y-m-d').'%')
            ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();}
        else{
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_sales2','=','0')
            ->where('transaksi.approve_gudang','=','0')
            ->where('transaksi.hold','=','0')
            // ->where('order.created_at','like', date('Y-m-d').'%')
            // ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();
        }
    }
    public function selesaiTransaksi($sales) {
        if(@$sales != 'SA00X'){
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_gudang','=','1')
            ->where('transaksi.hold','=','0')
            // ->where('transaksi.no_resi','<>','-')
            // ->where('order.created_at','like', date('Y-m-d').'%')
            ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();}
        else{
            return DB::table('order')
            ->select(DB::raw('COUNT(order.id) as Total'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_gudang','=','1')
            ->where('transaksi.hold','=','0')
            // ->where('transaksi.no_resi','<>','-')
            // ->where('order.created_at','like', date('Y-m-d').'%')
            // ->where('transaksi.kodeAdminTrx','=',$sales)
            ->get();
        }
    }

    public function konfirmasiKeuanganBaru($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','0')
        ->where('transaksi.approve_gudang','=','0')
        ->where('transaksi.hold','=','0')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }

    public function setujuKonfirmasiKeuangan($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','0')
        
        ->where('transaksi.hold','=','1')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }

    public function tahanTransaksiKeuangan($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_gudang','=','1')
        ->where('transaksi.code_status','=','10')
        // ->where('transaksi.approve_keuangan','=','0')
        ->where('order.lunas','=','0')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }

    public function semuaKonfirmasiKauangan($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
  
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }

    public function konfirmasiGudangBaru($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('transaksi.approve_gudang','=','0')
        ->where('transaksi.hold','=','0')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        // ->where('transaksi.kode_AWO','=',$sales)
        ->get();
    }

    public function setujuKonfirmasiGudang($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('transaksi.approve_gudang','=','1')
        ->where('transaksi.code_status','=','7')
        ->where('transaksi.hold','=','0')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        // ->where('transaksi.kode_AWO','=',$sales)
        ->get();
    }

    public function tahanTransaksiGudang($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('transaksi.approve_gudang','=','1')
        ->where('transaksi.code_status','=','9')
        ->where('transaksi.hold','=','0')
        // ->where('transaksi.kode_AWO','=',$sales)
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }

    public function semuaKonfirmasiGudang($sales) {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('transaksi.approve_gudang','=','1')
        ->where('transaksi.code_status','=','10')
        // ->where('transaksi.kode_AWO','=',$sales)
        //->where('transaksi.no_resi','<>','-')
        // ->where('order.created_at','like', date('Y-m-d').'%')
        //->where('transaksi.kodeAdminTrx','=',$sales)
        ->get();
    }


    public function semuaTransaksi() {
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('transaksi.approve_sales','=','1')
        ->where('transaksi.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('transaksi.approve_gudang','=','1')
        ->where('transaksi.no_resi','<>','-')
        // // ->where('order.created_at','like', date('Y-m-d').'%')
        // ->where('order.sales','=',$sales)
        ->get();
    }

    public function transaksiBulanan() {        
        return DB::table('order')
        ->select(DB::raw('COUNT(order.id) as Total'))
        ->join('transaksi','transaksi.code_order','=','order.id')
        ->where('order.approve_sales','=','1')
        ->where('order.approve_keuangan','=','1')
        ->where('transaksi.approve_sales2','=','1')
        ->where('order.approve_gudang','=','1')
        ->where('order.no_resi','<>','-')
        // // ->where('order.created_at','like', date('Y-m-d').'%')
        // ->where('order.sales','=',$sales)
        ->whereBetween('order.created_at',[
            date('Y-m-d',strtotime('first day of this month')),
            date('Y-m-d',strtotime('last day of this month'))
        ])
        ->get();

        // $day = date('y-m-d');
        // try {
            // $last7dayTicket = [];
            // $last7dayHarga = [];
            // foreach ($day as $d) {
            //     $total = DB::table('order')
            //         ->select(DB::raw('COUNT(order.id) as total,SUM(harga) as total_harga'))
            //         ->where('order.created_at','=',date('Y-m-d',strtotime($d)))->first();
            //     $last7dayTicket[] = $total->total ?? 0;
            //     $last7dayHarga[] = $total->total_harga ?? 0;
            // }
            // $transaksiBulanIni = DB::table('order')
            //     ->select(DB::raw('SUM(order.id) as order'))
            //     ->whereBetween('order.created_at',[
            //         date('Y-m-d',strtotime('first day of this month')),
            //         date('Y-m-d',strtotime('last day of this month'))
            //     ])->first();
            // $result = [
               
            //     // 'statistics_chart' => $last7dayHarga,
            //     // 'tiket_hari_ini' => $last7dayTicket[6],
            //     // 'transaksi_hari_ini' => $last7dayHarga[6] ?? 0,
            //     'transaksi_bulan_ini' => $transaksiBulanIni->order,
            // ];
            // return response()->json($result);
        // } catch (\Exception $ex) {
        //     return response()->json([$transaksiBulanIni]);
        // }
    }


    public function jumlahTransaksiperBulan($sales) {
        $year = date('Y');
        try{
            
            // SELECT Month(created_at) as bulan, count(id)
            // from transaksi
            // GROUP BY Month(created_at) 
            // order BY Month(created_at)

                return DB::table('order')            
                ->select(DB::raw("Month(transaksi.updated_at) as month"), DB::raw('(sum(order.total_harga) - sum(order.totalDiskon)) as total'))
                ->join('transaksi','transaksi.code_order','=','order.id')
                ->where('transaksi.updated_at','like', $year.'%')
                ->where('transaksi.typeTransaksi','=','regular')
                // ->where('transaksi.approve_gudang','=', '1')
                ->where('transaksi.code_status','=', '10')
                ->where('order.lunas','=','1')
                ->where('transaksi.kodeAdminTrx','=',$sales)
                ->groupBy('month')
                ->get();
            } 
        catch (\Exception $ex) 
        {
                return response()->json($ex);
        }
    }

    public function jumlahTransaksiSetiapAdminSales() {
        try{
            
            //  SELECT ms_admin.nama as nama, a.total FROM 
            // (SELECT kodeAdminTrx as kodeAdminTrx, count(approve_gudang) as total 
            // FROM transaksi GROUP BY kodeAdminTrx order BY kodeAdminTrx ASC) a 
            // JOIN ms_admin on ms_admin.kodeAdminTrx = a.kodeAdminTrx

            return DB::table('ms_admin')            
            ->select(DB::raw("ms_admin.nama as nama"), DB::raw('a.total'))
            ->join(DB::raw('(SELECT kodeAdminTrx as kodeAdminTrx, count(approve_gudang) as total 
                    FROM transaksi where transaksi.approve_gudang = 1
                    and Month(transaksi.updated_at) = MONTH(CURRENT_TIMESTAMP)
                    and Year(transaksi.updated_at)=YEAR(CURRENT_TIMESTAMP)
                    GROUP BY kodeAdminTrx order BY kodeAdminTrx ASC) as a'),
                    'ms_admin.kodeAdminTrx','=','a.kodeAdminTrx')
                ->get();
                 } catch (\Exception $ex) {
                return response()->json($ex);
            }
        }

    public function topOrder($sales) {
    try{
        $year = date('Y');
        $month = date('m');
  
        if(@$sales != 'SA00X'){
            return DB::table('order')        
            ->select(DB::raw("(SELECT nama FROM ms_customer WHERE ms_customer.id = order.code_customer) as nama"), 
                DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('(sum(order.total_harga)-sum(order.totalDiskon)) as totalHarga'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->join('ms_customer','ms_customer.id','=','order.code_customer')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_gudang','=','1')
            ->where('transaksi.code_status','=','10')
            ->where('transaksi.updated_at','like', $year.'-'.$month.'%' )
            ->where('transaksi.kodeAdminTrx','=',$sales)
            ->groupBy('order.code_customer')
            ->orderBy('totalHarga', 'DESC')
            ->get();}
        else{
            return DB::table('order')        
            ->select(DB::raw("(SELECT nama FROM ms_customer WHERE ms_customer.id = order.code_customer) as nama"), 
                DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('(sum(order.total_harga)-sum(order.totalDiskon)) as totalHarga'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->join('ms_customer','ms_customer.id','=','order.code_customer')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_gudang','=','1')
            ->where('transaksi.code_status','=','10')
            ->where('transaksi.updated_at','like', $year.'-'.$month.'%' )
            // ->where('transaksi.kodeAdminTrx','=',$sales)
            ->groupBy('order.code_customer')
            ->orderBy('totalHarga', 'DESC')
            ->get();
        }
             } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
  
    public function buku(Request $request) {
            $token = $request->token;
        try{
            if($token=='00dy5ny4ot')
            {
            $result = [];
            $result = 
                     DB::table('ms_barang')
                     ->select(DB::raw('COUNT(ms_barang.id) as total'))
                     ->first();
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

        public function customer(Request $request) {
            $token = $request->token;
            try{
                if($token=='p3yir0m3j2')
                {
                $result = [];
                $result = 
                         DB::table('ms_customer')
                         ->select(DB::raw('COUNT(ms_customer.id) as total'))
                         ->first();
                }
                {
                    $result = 'Invalid Token';   
                } 
                         return response()->json($result); 
                     } catch (\Exception $ex) {
                    return response()->json($ex);
                }
            }

            public function admin_sales(Request $request) {
                $token = $request->token;
                try{
                    if($token=='rr8gssy5bx')
                    {
                    $result = [];
                    $result = 
                             DB::table('ms_admin')
                             ->select(DB::raw('COUNT(ms_admin.id) as total'))
                             ->first();
                    }
                    {
                        $result = 'Invalid Token';   
                    } 
                             return response()->json($result); 
                         } catch (\Exception $ex) {
                        return response()->json($ex);
                    }
                }

                ////////////////////Manajer Edi////////////////////////////////
                public function jumlahTransaksiSetiapAdminGudangBaru() {
                    try{
                        
                        //  SELECT ms_admin.nama as nama, a.total FROM 
                        // (SELECT kodeAdminTrx as kodeAdminTrx, count(approve_gudang) as total 
                        // FROM transaksi GROUP BY kodeAdminTrx order BY kodeAdminTrx ASC) a 
                        // JOIN ms_admin on ms_admin.kodeAdminTrx = a.kodeAdminTrx
            
                        return DB::table('ms_admin')            
                        ->select(DB::raw("ms_admin.nama as nama"), DB::raw('a.total'))
                        ->join(DB::raw('(SELECT kode_AWO as kode_AWO, count(approve_gudang) as total 
                                FROM transaksi where transaksi.approve_gudang = 0
                                and transaksi.code_status IN ("6", "7") 
                                and Month(transaksi.updated_at) = MONTH(CURRENT_TIMESTAMP)
                                and Year(transaksi.updated_at)=YEAR(CURRENT_TIMESTAMP)
                                GROUP BY kode_AWO order BY kode_AWO ASC) as a'),
                                'ms_admin.kodeAdminTrx','=','a.kode_AWO')
                            ->get();
                             } catch (\Exception $ex) {
                            return response()->json($ex);
                        }
                    }
                public function jumlahTransaksiSetiapAdminGudangSelesai() {
                    try{
                        
                        //  SELECT ms_admin.nama as nama, a.total FROM 
                        // (SELECT kodeAdminTrx as kodeAdminTrx, count(approve_gudang) as total 
                        // FROM transaksi GROUP BY kodeAdminTrx order BY kodeAdminTrx ASC) a 
                        // JOIN ms_admin on ms_admin.kodeAdminTrx = a.kodeAdminTrx
            
                        return DB::table('ms_admin')            
                        ->select(DB::raw("ms_admin.nama as nama"), DB::raw('a.total'))
                        ->join(DB::raw('(SELECT kode_AWO as kode_AWO, count(approve_gudang) as total 
                                FROM transaksi where transaksi.approve_gudang = 1
                                and transaksi.code_status IN ("9", "10") 
                                and Month(transaksi.updated_at) = MONTH(CURRENT_TIMESTAMP)
                                and Year(transaksi.updated_at)=YEAR(CURRENT_TIMESTAMP)
                                GROUP BY kode_AWO order BY kode_AWO ASC) as a'),
                                'ms_admin.kodeAdminTrx','=','a.kode_AWO')
                            ->get();
                             } catch (\Exception $ex) {
                            return response()->json($ex);
                        }
                    }

                    public function daftar() {
                        try{
                            return DB::table('ms_admin')            
                            ->select(DB::raw("ms_admin.nama as nama"), DB::raw('a.total'))
                            ->join(DB::raw('(SELECT kode_AWO as kode_AWO, count(approve_gudang) as total 
                                    FROM transaksi where transaksi.approve_gudang = 0
                                    and transaksi.code_status IN ("6", "7") 
                                    and Month(transaksi.updated_at) = MONTH(CURRENT_TIMESTAMP)
                                    and Year(transaksi.updated_at)=YEAR(CURRENT_TIMESTAMP)
                                    GROUP BY kode_AWO order BY kode_AWO ASC) as a'),
                                    'ms_admin.kodeAdminTrx','=','a.kode_AWO')
                                ->get();
                                 } catch (\Exception $ex) {
                                return response()->json($ex);
                            }
                        }
                    // public function jumlahTransaksiSetiapAdminGudangSelesai() {
                    //     try{
                            
                    //         //  SELECT ms_admin.nama as nama, a.total FROM 
                    //         // (SELECT kodeAdminTrx as kodeAdminTrx, count(approve_gudang) as total 
                    //         // FROM transaksi GROUP BY kodeAdminTrx order BY kodeAdminTrx ASC) a 
                    //         // JOIN ms_admin on ms_admin.kodeAdminTrx = a.kodeAdminTrx
                
                    //         return DB::table('ms_admin')            
                    //         ->select(DB::raw("ms_admin.nama as nama"), DB::raw('a.total'))
                    //         ->join(DB::raw('(SELECT kode_AWO as kode_AWO, count(approve_gudang) as total 
                    //                 FROM transaksi where transaksi.approve_gudang = 1
                    //                 and transaksi.code_status IN ("9", "10") 
                    //                 and Month(transaksi.updated_at) = MONTH(CURRENT_TIMESTAMP)
                    //                 and Year(transaksi.updated_at)=YEAR(CURRENT_TIMESTAMP)
                    //                 GROUP BY kode_AWO order BY kode_AWO ASC) as a'),
                    //                 'ms_admin.kodeAdminTrx','=','a.kode_AWO')
                    //             ->get();
                    //              } catch (\Exception $ex) {
                    //             return response()->json($ex);
                    //         }
                    //     }

                public function konfirmasiManajerBaru($sales) {
                    return DB::table('order')
                    ->select(DB::raw('COUNT(order.id) as Total'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_sales2','=','1')
                    ->where('transaksi.approve_gudang','=','0')
                    // ->where('order.created_at','like', date('Y-m-d').'%')
                    ->where('transaksi.kode_AWO','=',$sales)
                    ->get();
                }
            
                public function setujuKonfirmasiManajerGudang($sales) {
                    return DB::table('order')
                    ->select(DB::raw('COUNT(order.id) as Total'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_sales2','=','1')
                    ->where('transaksi.approve_gudang','=','1')
                    ->where('transaksi.code_status','=','7')
                    // ->where('order.created_at','like', date('Y-m-d').'%')
                    //->where('transaksi.kodeAdminTrx','=',$sales)
                    ->where('transaksi.kode_AWO','=',$sales)
                    ->get();
                }
            
                public function tahanTransaksiManajerGudang($sales) {
                    return DB::table('order')
                    ->select(DB::raw('COUNT(order.id) as Total'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_sales2','=','1')
                    ->where('transaksi.approve_gudang','=','0')
                    ->where('transaksi.hold','=','1')
                    ->where('transaksi.kode_AWO','=',$sales)
                    // ->where('order.created_at','like', date('Y-m-d').'%')
                    //->where('transaksi.kodeAdminTrx','=',$sales)
                    ->get();
                }
            
                public function semuaKonfirmasiManajerGudang($sales) {
                    return DB::table('order')
                    ->select(DB::raw('COUNT(order.id) as Total'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_sales2','=','1')
                    ->where('transaksi.approve_gudang','=','1')
                    ->where('transaksi.kode_AWO','=',$sales)
                    //->where('transaksi.no_resi','<>','-')
                    // ->where('order.created_at','like', date('Y-m-d').'%')
                    //->where('transaksi.kodeAdminTrx','=',$sales)
                    ->get();
                }
            
            
                public function semuaManajerTransaksi() {
                    return DB::table('order')
                    ->select(DB::raw('COUNT(order.id) as Total'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_sales2','=','1')
                    ->where('transaksi.approve_gudang','=','1')
                    ->where('transaksi.no_resi','<>','-')
                    // // ->where('order.created_at','like', date('Y-m-d').'%')
                    // ->where('order.sales','=',$sales)
                    ->get();
                }
}