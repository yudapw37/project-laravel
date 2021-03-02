<?php

namespace App\Http\Controllers;

use App\mod_ms_promo;
use App\mod_ms_barang_promo;
use App\mod_barang_trn;
use App\mod_ms_barangStock;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_manajerSales extends Controller
{    

    public function salesAmount(Request $request) {
        $token = $request->token;
        $from_date = $request->datepickerfrom;
        $to_date = $request->datepickerto;
        $fm_date = substr($from_date,0,10);
        $t_date = substr($to_date,0,10);
        // $code_promo = $request->code_promo;
        try {
            if($token=='ijt8ned054')
            {
                $queryAdmin =
                DB::table('ms_admin')            
                ->select('ms_admin.nama as nama', 'ms_admin.kodeAdminTrx as kodeAdminTrx')
                ->where('ms_admin.code_jabatan','=','2')
                ->where('ms_admin.kodeAdminTrx','<>','SA00X')
                ->get();
                
                $val_decode = json_decode($queryAdmin);
                // print_r($val_decode);
                foreach($val_decode as $val)
                {
                    for($i=0; $i<5 ; $i++)
                    {
                        if($i==0){$type='regular';}
                        if($i==1){$type='preOrder';}
                        if($i==2){$type='arisan';}
                        if($i==3){$type='pembayaranAgen';}
                        if($i==4){$type='tempo';}

                            // $get= $this->salesAmountDetailSubFunction( $val->kodeAdminTrx, $type, 1, $fm_date, $t_date);
                            $query =
                            DB::table('transaksi')            
                            ->select('transaksi.typeTransaksi as typeTransaksi', DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('sum(order.total_harga) as totalHarga'), DB::raw('sum(order.totalDiskon) as totalDiskon')) 
                            ->join ('order','transaksi.code_order', '=','order.id')
                             ->where('transaksi.kodeAdminTrx','=',$val->kodeAdminTrx)
                             ->where('transaksi.typeTransaksi','=',$type) 
                            ->groupBy('transaksi.typeTransaksi');
            
                            // if($typeTransaksi!='tempo'){
                            //     $query->where('order.lunas','=','1');
                            //     $query->whereBetween('order.updated_at',[$fm_date, $t_date]);
                            //     if($lunas==1){
                            //         $query->where('transaksi.code_status','=','10');
                            //     }
                            // }
                            // else{
                            //     $query->whereBetween('transaksi.created_at',[$fm_date, $t_date]);
                            // }
                            
            
                            $res=$query->first();
                        
                            // $query_decode = json_decode($get);
                            print_r($val->kodeAdminTrx);
                            echo '<br>';
                            print_r($type);
                        
                    }
                }   
            }
            else
            {
                $result = 'Invalid Token';   
            }  
            return response()->json($res); 
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function BukuOrderSale(Request $request) {
        $token = $request->token;
        $code_buku = $request->code_buku;
        $kodeAdminTrx = $request->kodeAdminTrx;
        $from_date = $request->datepickerfrom;
        $to_date = $request->datepickerto;
        $fm_date = substr($from_date,0,10);
        $t_date = substr($to_date,0,10)." 23:59:59";


        try {
            if($token=='8fjv76qp9l')
            {
                $status = '';
                $x = $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "preOrder", 1);
                $result= [
        
                    //  'bukuRegulerProses' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date,  $inv, $typerTrx, $selesai)
                    'bukuInvoice' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 1, "regular", 1),
                     'bukuRegulerProses' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "regular", 0),
                     'bukuRegulerSelesai' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "regular", 1),
                     'bukuPreOrderProses' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "preOrder", 0),
                     'bukuPreOrderSelesai' => $x,
                     'bukuArisanProses' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "arisan", 0),
                     'bukuArisanSelesai' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "arisan", 1),
                     'bukuTempoProses' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "tempo", 0),
                     'bukuTempoSelesai' => $this->bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, 0, "tempo", 1),
                     'totalBukuPreOrderSelesai' =>$this->totalBukuOrderSales($code_buku,$x)

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


    public function ResellerAdminSales(Request $request) {
        $token = $request->token;
        $kodeAdminTrx = $request->kodeAdminTrx;
        $from_date = $request->datepickerfrom;
        $to_date = $request->datepickerto;
        $fm_date = substr($from_date,0,10);
        $t_date = substr($to_date,0,10)." 23:59:59";


        try {
            if($token=='09ije76qp9l')
            {
                $status = '';
                $result= [
                    
                'ResellerAdminSales' => $this->resellerOrderSales( $kodeAdminTrx, $fm_date, $t_date)
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

    public function salesAmountDetailTransaksi(Request $request) {
        $token = $request->token;
        $kodeAdminTrx = $request->kodeAdminTrx;
        $from_date = $request->datepickerfrom;
        $to_date = $request->datepickerto;
        $fm_date = substr($from_date,0,10);
        $t_date = substr($to_date,0,10)." 23:59:59";


        try {
            if($token=='2nke76qp9l')
            {

                
                // $day = Carbon::now()->format('d');
                // $month = Carbon::now()->addMonth(1)->format('m');
                // $year = Carbon::now()->format('Y');
                $status = '';
                $result= [
                    
                    'RegulerLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'regular', 1, $fm_date, $t_date, $status),
                    'PreOrderDikirim' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'preOrder', 1, $fm_date, $t_date, 'diKirim'),
                    'PreOrderBlmDIkirim' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'preOrder', 1, $fm_date, $t_date, 'blmDikirim'),
                    'ArisanLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'arisan', 1, $fm_date, $t_date, $status),
                    'ArisanProses' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'arisan', 0, $fm_date, $t_date, $status),                    
                    'ArisanHutang' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'arisan', 2, $fm_date, $t_date, $status),
                    'TempoLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'tempo', 1, $fm_date, $t_date, $status),
                    'TempoProsesKirim' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'tempo', 2, $fm_date, $t_date, 'kirim'),
                    // 'TempoProsesPelunasanSemua' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'tempo', 0, $fm_date, $t_date, 'pelunasanSemua'),
                    'TempoProsesPelunasan' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'tempo', 0, $fm_date, $t_date, 'pelunasan'),
                    'TempoHutang' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'tempo', 2, $fm_date, $t_date, $status),
                    'PGLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'pembayaranAgen', 1, $fm_date, $t_date, $status),
                    // 'PGNonLunas' => $this->salesAmountDetailPG( $kodeAdminTrx, $fm_date, $t_date),
                    'Ongkir' => $this->salesAmountOngkir( $kodeAdminTrx, $fm_date, $t_date),
                    'RegulerNonLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'regular', 0, $fm_date, $t_date, $status)          
                    // 'PreOrderNonLunas' => $this->salesAmountDetailSubFunction( $kodeAdminTrx, 'preOrder', 0, $fm_date, $t_date, $status),
                    
                
                    //    'PGNonLunas' => $this->salesAmountDetailPG( $kodeAdminTrx),
                
                  //  'RegulerInvoice' => $this->salesAmountDetailInvoice( $kodeAdminTrx, 'regular', $fm_date, $t_date),
                  //  'PreOrderInvoice' => $this->salesAmountDetailInvoice( $kodeAdminTrx, 'preOrder', $fm_date, $t_date),
                  //  'ArisanInvoice' => $this->salesAmountDetailInvoice( $kodeAdminTrx, 'arisan', $fm_date, $t_date),
                  //  'TempoInvoice' => $this->salesAmountDetailInvoice( $kodeAdminTrx, 'tempo', $fm_date, $t_date),
                  
                  
                    
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

    public function salesAmountDetailSubFunction( $kodeAdminTrx, $typeTransaksi, $lunas, $fm_date, $t_date, $status) {
        

        try {

            $query =
                DB::table('order')            
                ->select('transaksi.typeTransaksi as typeTransaksi', 
                DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('sum(order.total_harga) as totalHarga'), 
                DB::raw('sum(order.totalDiskon) as totalDiskon')) 
                ->join ('transaksi','transaksi.code_order', '=','order.id')
                ->where('transaksi.kodeAdminTrx','=',$kodeAdminTrx)
                ->where('transaksi.typeTransaksi','=',$typeTransaksi)
                ->where('order.lunas','=',$lunas)                
                ->groupBy('transaksi.typeTransaksi');

                if($typeTransaksi=='regular' ){
                    $from = date('2020-07-26');
                    $to = date('2020-07-27');
                    $query->whereBetween('transaksi.updated_at',[$fm_date, $t_date]);
                    // $query->whereBetween('transaksi.updated_at',[$from, $to]);                    
                    $query->where('transaksi.code_status','=','10');
                        
                }

                if($typeTransaksi=='preOrder' ){
                    $query->whereBetween('transaksi.updated_at',[$fm_date, $t_date]);
                    // $query->whereBetween('transaksi.updated_at',['2020-06-26', '2020-07-27']);
                    if($lunas==1){
                        if($status=='diKirim'){
                            $query->where('transaksi.code_status','=','10');
                        }elseif($status=='blmDikirim'){
                            $query->where('transaksi.code_status','<>','10');
                            // $query->where('transaksi.approveSales','=','1');
                        }                        
                    }else{
                            $query->where('transaksi.code_status','=','10');
                        
                    }
                }
                
                if($typeTransaksi=='arisan' || $typeTransaksi=='pembayaranAgen' || $typeTransaksi=='tempo'){
                    
                    if($lunas != 0 && $status !='kirim'){
                        $query->where('transaksi.code_status','=','10');
                    }

                    if($status=='kirim'){
                        $query->where('transaksi.code_status','<>','10');
                        //  $query->where('transaksi.code_status','=','10');
                    }
                    // if($status=='pelunasanSemua'){
                    //     $query->where('transaksi.code_status','=','10');
                    // }
                    if($status=='pelunasan'){
                        $query->where('transaksi.code_status','=','10');
                    }

                    if($lunas==1){
                        $query->whereBetween('order.updated_at',[$fm_date, $t_date]);
                    }
                    else{
                        // if($status=='pelunasan'){
                        //     $query->whereBetween('transaksi.updated_at',[$fm_date, $t_date]);
                        // }
                        // elseif($status=='pelunasanSemua'){

                        // }else{
                            
                        // }
                        $query->whereBetween('transaksi.updated_at',[$fm_date, $t_date]);
                    }
                    
                }

                $res=$query->first();                
             
            return $res; 
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function salesAmountOngkir( $kodeAdminTrx, $fm_date, $t_date) {
       
        try {
            
                // SELECT sum(total_barang), sum(total_harga) FROM `order` o join transaksi t on o.id = t.code_order where t.typeTransaksi = 'regular' and o.lunas = 0 and t.kodeAdminTrx ='YG00x'

            $query =
                DB::table('order')            
                ->select(DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('sum(order.biayaExpedisi) as biayaExpedisi')) 
                ->join ('transaksi','transaksi.code_order', '=','order.id')
                ->where('transaksi.code_status','=','10')
                 ->where('transaksi.kodeAdminTrx','=',$kodeAdminTrx)
                 ->whereBetween('transaksi.updated_at',[$fm_date, $t_date])
                ->first();                
             
            return $query; 
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function salesAmountDetailPG( $kodeAdminTrx, $fm_date, $t_date) {
       
        try {
            
                // SELECT sum(total_barang), sum(total_harga) FROM `order` o join transaksi t on o.id = t.code_order where t.typeTransaksi = 'regular' and o.lunas = 0 and t.kodeAdminTrx ='YG00x'

            $query =
                DB::table('transaksi_pg')            
                ->select(DB::raw('sum(transaksi_pg_detail.jumlah) as totalBarang'), DB::raw('sum(transaksi_pg.harga_total) as totalHarga')) 
                ->join ('transaksi_pg_detail','transaksi_pg_detail.code_transaksi_pg', '=','transaksi_pg.code_transaksi_pg')
                ->where('transaksi_pg.pic','=',$kodeAdminTrx)
                ->whereBetween('transaksi_pg.updated_at',[$fm_date, $t_date])
                ->first();                
             
            return $query; 
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function salesAmountDetailInvoice( $kodeAdminTrx, $typeTransaksi) {
       
        try {
            // $fromDate = date('2020-07-01');
            // $toDate = date('2020-07-31');
            
                // SELECT sum(total_barang), sum(total_harga) FROM `order` o join transaksi t on o.id = t.code_order where t.typeTransaksi = 'regular' and o.lunas = 0 and t.kodeAdminTrx ='YG00x'

            $query =
                DB::table('outstanding_order')            
                ->select('outstanding_order.typeTransaksi as typeTransaksi',DB::raw('sum(outstanding_order.total_barang) as totalBarang'), DB::raw('sum(outstanding_order.total_harga) as totalHarga'), DB::raw('sum(outstanding_order.totalDiskon) as totalDiskon')) 
                ->where('outstanding_order.kodeAdminTrx','=',$kodeAdminTrx)
                ->where('outstanding_order.typeTransaksi','=',$typeTransaksi)
                // ->whereBetween('transaksi.created_at',[$fromDate, $toDate])
                ->groupBy('outstanding_order.typeTransaksi')
                ->first();                
             
            return $query; 
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function resellerOrderSales( $kodeAdminTrx, $fm_date, $t_date) {
       
        try {
            return DB::table('order')        
            ->select(DB::raw("(SELECT nama FROM ms_customer WHERE ms_customer.id = order.code_customer) as nama"), 
                DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('(sum(order.total_harga)-sum(order.totalDiskon)) as totalHarga'))
            ->join('transaksi','transaksi.code_order','=','order.id')
            ->join('ms_customer','ms_customer.id','=','order.code_customer')
            ->where('transaksi.approve_sales','=','1')
            ->where('transaksi.approve_keuangan','=','1')
            ->where('transaksi.approve_gudang','=','1')
            ->where('transaksi.code_status','=','10')
            ->whereBetween('transaksi.updated_at',[$fm_date, $t_date])
            ->where('transaksi.kodeAdminTrx','=',$kodeAdminTrx)
            ->groupBy('order.code_customer')
            ->orderBy('totalHarga', 'DESC')
            ->get();
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function bukuOrderSales($code_buku, $kodeAdminTrx, $fm_date, $t_date, $inv, $typerTrx, $selesai) {
       
        // SELECT od.code_barang FROM `order` o 
        // join `orderdetail` od on o.id=od.code_order	
        // join `transaksi` t on o.id=t.code_order	
        // where od.code_barang = '005-AZN'
        // AND t.kodeAdminTrx ='YG00X'

        try {
            if($inv == 1){
                $query =
                DB::table('outstanding_order')        
                    ->select( DB::raw('sum(outstanding_orderdetail.jumlah) as jumlah') )            
                    ->join('outstanding_orderdetail','outstanding_orderdetail.code_order','=','outstanding_order.idOrder') 
                    ->where('outstanding_orderdetail.code_barang','=',$code_buku)                   
                    ->whereBetween('outstanding_order.updated_at',[$fm_date, $t_date])
                    ->where('outstanding_order.kodeAdminTrx','=',$kodeAdminTrx) 
                    // ->where('outstanding_order.typeTransaksi','=',$typerTrx)
                    ->groupBy('outstanding_orderdetail.code_barang');
            }else{
                $query =
                DB::table('order')        
                    ->select(DB::raw('sum(orderdetail.jumlah) as jumlah') )
                    ->join('transaksi','transaksi.code_order','=','order.id')             
                    ->join('orderdetail','orderdetail.code_order','=','order.id') 
                    ->where('orderdetail.code_barang','=',$code_buku)                   
                    ->whereBetween('transaksi.updated_at',[$fm_date, $t_date])
                    ->where('transaksi.kodeAdminTrx','=',$kodeAdminTrx) 
                    ->where('transaksi.typeTransaksi','=',$typerTrx)
                    ->groupBy('orderdetail.code_barang');

                    if($selesai==1){
                        $query->where('transaksi.code_status','=','10');
                    }
                    else{
                        $query->where('transaksi.code_status','<>','10');
                    }
            }
            

            $res=$query->get();
            return  $res;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function totalBukuOrderSales($code_buku, $totalBuku) {

        try {
            foreach($totalBuku as $x => $val)
            {
            $s=$val->jumlah;
            break;
        }
            $buku = DB::table('ms_barang')
            ->select('judul_buku as judul')
            ->where('id','=',$code_buku)
            ->first();
           $buku = DB::table('ms_promo')
           ->select('ms_promo.harga_jadi as hargaJadi')
           ->where('ms_promo.nama_promo','LIKE','%'.$buku->judul.'%')
           ->first();
           $harga = $buku->hargaJadi;
            $totalHarga = ($harga * $s);
            return  $totalHarga;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function salesOrder() {
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


    public function getAllPromo(Request $request) {
        $token = $request->token;
        $namaPromo = $request->namaPromo;
        $codeGudang = $request->codeGudang;
        $offset = $request->offset;
        try {

            if($token=='2nkeygqp9l')
            {

                if($offset){$offset=(int)$offset;}
                else{$offset=0;}

                // select ms_promo.nama_promo, ms_promo.harga_jadi, a.minStock , ms_promo.created_at
                // from (select ms_promo.code_promo as code_promo, min(ms_barang_stock.d-ms_barang_stock.k) 
                // as minStock from ms_barang
                // join ms_barang_promo on ms_barang_promo.code_barang=ms_barang.id
                // join ms_promo on ms_promo.code_promo = ms_barang_promo.code_promo
                // join ms_barang_stock on ms_barang_stock.code_barang = ms_barang.id
                // GROUP BY ms_barang_promo.code_promo) a
                // join ms_promo on ms_promo.code_promo = a.code_promo
                if($codeGudang){$codeGudangQuery=$codeGudang;}
                else{$codeGudangQuery='Gd_001';}

                $query =
                    DB::table('ms_promo')
                    ->select('ms_promo.code_promo as codePromo','ms_promo.nama_promo as namaPromo', 
                    'ms_promo.harga_jadi as hargaJadi', 'ms_promo.berat_total as berat_total', DB::raw('a.min as minStock'), 'ms_promo.created_at as created_at')
                    ->join(DB::raw('(select ms_barang_promo.code_promo as code_promo, min(ms_barang_stock.d-ms_barang_stock.k) 
                        as min from ms_barang
                        join ms_barang_promo on ms_barang_promo.code_barang=ms_barang.id
                        join ms_barang_stock on ms_barang_stock.code_barang = ms_barang.id
                        where ms_barang_stock.code_gudang = "'.$codeGudangQuery.'"
                        GROUP BY ms_barang_promo.code_promo) as a'),
                        'ms_promo.code_promo','=','a.code_promo' );
                    // ->offset($offset)
                    //  ->limit(10);

                if($namaPromo){
                    $query->where('ms_promo.nama_promo', 'like','%'. substr($namaPromo,6,strlen($namaPromo)).'%');
                }            

                $result=$query ->get();               
            }
            else
            {
                $result = 'Invalid Token';   
            }    
            return response()->json($result);
        } catch (\Exception $ex) 
        {
            return response()->json($ex);
        }
    }

    public function getDetailPromo(Request $request) {
        $token = $request->token;
        $code_promo = $request->code_promo;

        try {
            if($token=='3nke6gqp9l')
            {
                $result= [
                    'orderDetail' => $this->getDetail($code_promo),
                    'itemOrder' => $this->getItemPromo($code_promo),
                ];
               
            }
            else
            {
                $result = 'Invalid Token';   
            }    
            return response()->json($result);
        } catch (\Exception $ex) 
        {
            return response()->json($ex);
        }
    }

    public function getDetail($code_promo)
    {
        try{
        return DB::table('ms_promo')
        ->select( 'ms_promo.code_promo as codePromo','ms_promo.nama_promo as namaPromo', 'ms_promo.harga_jadi as hargaJadi','ms_promo.tanggal_cetak as tanggal_cetak','ms_promo.created_at as created_at')        
        ->where('ms_promo.code_promo','=',$code_promo)
        ->get();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getItemPromo($code_promo)
    {
        try{
        return DB::table('ms_barang_promo')
        ->select('ms_barang.id as kodeBarang','ms_barang.judul_buku as judulBuku','ms_barang.harga as harga')
        ->join('ms_barang','ms_barang.id','=','ms_barang_promo.code_barang')
        ->where('ms_barang_promo.code_promo','=',$code_promo)
        ->get();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }

    }

    public function getAdminSales(Request $request) {
        $token = $request->token;

        try {
            if($token=='3nk76gqp9l')
            {
                $query = 
                    DB::table('ms_admin')
                    ->select('ms_admin.kodeAdminTrx as kodeAdminTrx', 'ms_admin.nama as nama')
                    ->where('ms_admin.code_jabatan','=','2')
                    ->where('ms_admin.kodeAdminTrx','<>','SA00X');
                    
                $result=$query ->get();
               
            }
            else
            {
                $result = 'Invalid Token';   
            }    
            return response()->json($result);
        } catch (\Exception $ex) 
        {
            return response()->json($ex);
        }
    }

    public function addPromo(Request $request) {
        $token = $request->token;
        $code_barang_list = $request->code_barang_list;
        $nama_promo = $request->nama_promo;
        $harga_jadi = $request->harga_jadi;
        $berat_total = $request->berat_total;
        $tanggal_cetak = $request->date;

        try {
            if($token=='va72r7nm79')
            {
                DB::beginTransaction();
                $count = DB::table('ms_promo')
                ->select(DB::raw('COUNT(ms_promo.code_promo) as count'))
                ->first();

                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);
           
                $c = $count->count;
                $kode = 'promo_' .$tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);
                $promo = new mod_ms_promo();
                $promo->code_promo = $kode;
                $promo->nama_promo = $nama_promo;
                $promo->harga_jadi = $harga_jadi;
                $promo->berat_total = $berat_total;
                $promo->tanggal_cetak = $tanggal_cetak;
                $promo->save();

                foreach($code_barang_list as $key => $val)
                {
                    $barangPromo = new mod_ms_barang_promo();
                        $barangPromo->code_promo = $kode;
                        $barangPromo->code_barang = $val;
                        $barangPromo->save();
                }
                // for($i=0; $i<count($code_barang_list)-1; $i++)
                //     {                        
                        
                //     }

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

    public function editPromo(Request $request) {
        $token = $request->token;
        $code_barang_list = $request->code_barang_list;
        $code_promo = $request->code_promo;
        $nama_promo = $request->nama_promo;
        $harga_jadi = $request->harga_jadi;

        try {
            if($token=='6vkktpeblt')
            {
                DB::beginTransaction();

                DB::table('ms_barang_promo')
                ->where('code_promo','=',$code_promo)->delete();
                
                DB::table('ms_promo')->where('code_promo', '=', $code_promo)
                ->update([
                            'nama_promo' => $nama_promo,
                            'harga_jadi' => $harga_jadi
                        ]);

                for($i=0; $i<count($code_barang_list)-1; $i++)
                    {                        
                        $barangPromo = new mod_ms_barang_promo();
                        $barangPromo->code_promo = $code_promo;
                        $barangPromo->code_barang = $code_barang_list[$i];
                        $barangPromo->save();
                    }

                // $barangPromo = new mod_ms_barang_promo();
                // $barangPromo->code_promo = $code_promo;
                // $barangPromo->code_barang = $code_barang;
                // $barangPromo->save();

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

    
    public function deletePromo(Request $request) {
        $token = $request->token;
        $code_promo = $request->code_promo;

        try {
            if($token=='ijt8ned054')
            {
                DB::beginTransaction();

                DB::table('ms_barang_promo')
                ->where('code_promo','=',$code_promo)->delete();

                DB::table('ms_promo')
                ->where('code_promo','=',$code_promo)->delete();

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

    public function topOrder($sales) {
        
        try{
            if($token=='ijt8ned054')
            {
                $fromDate = date('2020-07-01');
                $toDate = date('2020-07-31');
                
                $year = date('Y');
                $month = date('m');
        
                    return DB::table('order')        
                    ->select(DB::raw("(SELECT nama FROM ms_customer WHERE ms_customer.id = order.code_customer) as nama"), 
                        DB::raw('sum(order.total_barang) as totalBarang'), DB::raw('sum(order.total_harga) as totalHarga'))
                    ->join('transaksi','transaksi.code_order','=','order.id')
                    ->join('ms_customer','ms_customer.id','=','order.code_customer')
                    ->where('transaksi.approve_sales','=','1')
                    ->where('transaksi.approve_keuangan','=','1')
                    ->where('transaksi.approve_gudang','=','1')
                    // ->whereBetween('transaksi.created_at',[$fromDate, $toDate])
                    ->where('transaksi.updated_at','like', $year.'-'.$month.'%' )
                    ->where('transaksi.kodeAdminTrx','=',$sales)
                    ->groupBy('order.code_customer')
                    ->orderBy('totalHarga', 'DESC')
                    ->get();
            }
            else
            {
                $result = 'Invalid Token';   
            }  
            
            } catch (\Exception $ex) {
                return response()->json($ex);
            }
        }
    
}
