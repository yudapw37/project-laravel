<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\mod_penerima_alamat;
use App\mod_order;
use App\mod_outstandingorder;
use App\mod_outstandingorder_detail;
use App\mod_barang_stock;
use App\mod_transaksi;
use App\mod_moota_log;
use App\mod_alamat_cust;
use App\mod_customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Mail;

class cekMutasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mutasi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek Mutasi Moota Batch Job';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bri='6QdkNZ7KkeZ';
        $bni='Nylzr8r8Wxb';
        $mandiri='2EpWooD9WJd';
        $bca='V1ajMBvZWvL';

        $getmootabri = $this->getmoota($bri, 'Bri');
        $getmootabni = $this->getmoota($bni, 'Bni');
        $getmootamandiri = $this->getmoota($mandiri, 'Mandiri');
        $getmootabca = $this->getmoota($bca, 'Bca');

        $getmootastorebri = $this->getmootastore($bri, 'Bri');
        $getmootastorebni = $this->getmootastore($bni, 'Bni');
        $getmootastoremandiri = $this->getmootastore($mandiri, 'Mandiri');
        $getmootastorebca = $this->getmootastore($bca, 'Bca');
        

        $deleteinvoice = $this->deleteInv();
        
        $updateDiskon = $this->updateDiskon();

        $backUp = $this->backupdb();
    }

    public function getmoota($bankid, $valBank)
    {
        date_default_timezone_set("Asia/Bangkok");
        $getOrder='';
        $getTransaksi='';
        $getMoota='';
        $dataord = [];
        $data = [];
        $listord=array();
        $listmoota=array();
        $yesterday=date('Y-m-d',strtotime("-1 days"));
        $now=date('Y-m-d',strtotime("-0 days"));

        $code_order=mod_transaksi::where('created_at','>',$yesterday)->where('approve_sales','=',1)->where('approve_keuangan','=',0)->where('code_status','=',4)->where('typeTransaksi','<>','tempo')->where('hold','=',0)->pluck('code_order');
        $getOrder=mod_order::select('id as idOrder','biayaExpedisi','totalDiskon', 'total_harga', 'diskonKodeUnik')->whereIn('id', $code_order )->get();
        foreach($getOrder as $val=>$value){
            $total = $value['total_harga']+$value['biayaExpedisi']-$value['totalDiskon']-$value['diskonKodeUnik'];
            $newid = $value['idOrder'];
            $valharga = substr($total,0);
            $dataord += [$newid => $valharga];
        }
        $getOrder=json_encode($code_order);
        $getTransaksi=json_encode($dataord);

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJucWllNHN3OGxsdyIsImp0aSI6ImMxNTA3ZDgzNGEyZDEzZjkxZGQ3ZTAyZjhhMGE4NmE5MTcxMzMwNzA0NmZmOWE1Yzk2ODNjMTg0MWI3MzcwNGZjNDJiMzY3YjY0NWNiN2U5IiwiaWF0IjoxNjA1MjM0MTM4LCJuYmYiOjE2MDUyMzQxMzgsImV4cCI6MTYzNjc3MDEzOCwic3ViIjoiMTQ5MjMiLCJzY29wZXMiOlsiYXBpIiwidXNlciIsInVzZXJfcmVhZCIsImJhbmsiLCJiYW5rX3JlYWQiLCJtdXRhdGlvbiIsIm11dGF0aW9uX3JlYWQiXX0.p0P6wqHQ7Gutjubdud07sMSHRt7HA9Mi_xJPNozADXn_g1kIBgX3AEhZWIfOGDLQfhH8E5WQpM4vUmoJf5TFxIDKmpFSX4a_Eg5YI5wV8tONUHj7o3GhXJNfIKkTHN9wE3qCjp0Uw6TZZ7qr164TkNHiWMLtVX7AETzaom6f7_h0A4VBj6EOO6aUwx9Y1app60MsPBh6mzW6SfgrbQCsS2EOpArwZH0wwMc3yw11XInhaAryobZcYRu0vo41Jb3vIHKwqUWzHOyuOG7tCV0frrs5rhDcEQzh7mYxucI88ysT3VjbBexf_f6scxcuE1IPBAap9qKNchtIjuI-cA1Pxl22kPyIiUg51cCQ-vqudM2mRKSI31oEC3LGyl79Ysl9GyW72RwEvAhmtpt6fEgHMeyIU-as1csHxqZiliW_u2a7VCO5Coe-RBKd9Z1M4IOoTYY5WxTdYmoe1rh7KEOt2mUL6EwGNSMCTMpGPIByLh06BBcmbYOln0rpU-H-Dfo-Ny75qUgq7cndnjSXHl6Xm1JN9re_N6IAGWmXxO1JiczsMC6Zp_LksNTscCTg-d5hd-sMjk8qOEe0D05EWE4mOLpshq4b2HUCD0pyjIixwr4Lr1IaeqB_t0Iu97_0kaZ4iumjvH19OPi9prwS4LVtoyaLbY_R0Oh08-OaZHWuuQ8',
            'Accept' => 'application/json'
        ])->get('https://app.moota.co/api/v2/mutation', [
             'bank' => $bankid,
             'start_date' => $yesterday,
             'end_date' => $now,          
        ]);
        $result = $response['data'];

        $getOrder=json_encode($code_order);
        $getTransaksi=json_encode($getOrder);
        $getMoota=json_encode($result);
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
            
            
         mod_moota_log::create([
            // 'mapel' => strtoupper($request->mapel),
            'bank' => $valBank,
            'getOrder' => $getOrder,
            'getTransaksi' =>$getTransaksi,
            'getMoota' =>$getMoota
            ]);
            
        return $listmoota;
    }

    public function getmootastore($bankid, $valBank)
    {
        date_default_timezone_set("Asia/Bangkok");
        $getOrder='';
        $getTransaksi='';
        $getMoota='';
        $dataord = [];
        $data = [];
        $listord=array();
        $listmoota=array();
        $yesterday=date('Y-m-d',strtotime("-1 days"));
        $now=date('Y-m-d',strtotime("-0 days"));

        $code_order=mod_transaksi::where('created_at','>',$yesterday)->where('approve_sales','=',0)->where('approve_keuangan','=',0)->where('typeTransaksi','<>','tempo')->where('hold','=',0)->pluck('code_order');
        $getOrder=mod_order::select('id as idOrder','biayaExpedisi','totalDiskon', 'total_harga', 'diskonKodeUnik')->whereIn('id', $code_order )->get();
        foreach($getOrder as $val=>$value){
            $total = $value['total_harga']+$value['biayaExpedisi']-$value['totalDiskon']-$value['diskonKodeUnik'];
            $newid = $value['idOrder'];
            $valharga = substr($total,0);
            $dataord += [$newid => $valharga];
        }
        $getOrder=json_encode($code_order);
        $getTransaksi=json_encode($dataord);

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJucWllNHN3OGxsdyIsImp0aSI6ImMxNTA3ZDgzNGEyZDEzZjkxZGQ3ZTAyZjhhMGE4NmE5MTcxMzMwNzA0NmZmOWE1Yzk2ODNjMTg0MWI3MzcwNGZjNDJiMzY3YjY0NWNiN2U5IiwiaWF0IjoxNjA1MjM0MTM4LCJuYmYiOjE2MDUyMzQxMzgsImV4cCI6MTYzNjc3MDEzOCwic3ViIjoiMTQ5MjMiLCJzY29wZXMiOlsiYXBpIiwidXNlciIsInVzZXJfcmVhZCIsImJhbmsiLCJiYW5rX3JlYWQiLCJtdXRhdGlvbiIsIm11dGF0aW9uX3JlYWQiXX0.p0P6wqHQ7Gutjubdud07sMSHRt7HA9Mi_xJPNozADXn_g1kIBgX3AEhZWIfOGDLQfhH8E5WQpM4vUmoJf5TFxIDKmpFSX4a_Eg5YI5wV8tONUHj7o3GhXJNfIKkTHN9wE3qCjp0Uw6TZZ7qr164TkNHiWMLtVX7AETzaom6f7_h0A4VBj6EOO6aUwx9Y1app60MsPBh6mzW6SfgrbQCsS2EOpArwZH0wwMc3yw11XInhaAryobZcYRu0vo41Jb3vIHKwqUWzHOyuOG7tCV0frrs5rhDcEQzh7mYxucI88ysT3VjbBexf_f6scxcuE1IPBAap9qKNchtIjuI-cA1Pxl22kPyIiUg51cCQ-vqudM2mRKSI31oEC3LGyl79Ysl9GyW72RwEvAhmtpt6fEgHMeyIU-as1csHxqZiliW_u2a7VCO5Coe-RBKd9Z1M4IOoTYY5WxTdYmoe1rh7KEOt2mUL6EwGNSMCTMpGPIByLh06BBcmbYOln0rpU-H-Dfo-Ny75qUgq7cndnjSXHl6Xm1JN9re_N6IAGWmXxO1JiczsMC6Zp_LksNTscCTg-d5hd-sMjk8qOEe0D05EWE4mOLpshq4b2HUCD0pyjIixwr4Lr1IaeqB_t0Iu97_0kaZ4iumjvH19OPi9prwS4LVtoyaLbY_R0Oh08-OaZHWuuQ8',
            'Accept' => 'application/json'
        ])->get('https://app.moota.co/api/v2/mutation', [
             'bank' => $bankid,
             'start_date' => $yesterday,
             'end_date' => $now,          
        ]);
        $result = $response['data'];

        $getOrder=json_encode($code_order);
        $getTransaksi=json_encode($getOrder);
        $getMoota=json_encode($result);
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
            
            
         mod_moota_log::create([
            // 'mapel' => strtoupper($request->mapel),
            'bank' => $valBank,
            'getOrder' => $getOrder,
            'getTransaksi' =>$getTransaksi,
            'getMoota' =>$getMoota
            ]);
            
        return $listmoota;
    }

    public function deleteInv(){
        date_default_timezone_set("Asia/Bangkok");
        $yesterday=date('Y-m-d h:i:s',strtotime("-1 days"));
        $idOrder=mod_outstandingorder::where('invStore','=',1)->where('created_at','<',$yesterday )->pluck('idOrder') ;

        $res=mod_outstandingorder::whereIn('idOrder', $idOrder)->delete();
        $invdetail = mod_outstandingorder_detail::whereIn('code_order', $idOrder)->get();
        foreach($invdetail as $val){
             $stock=mod_barang_stock::where('code_barang', '=',$val['code_barang'])->where('code_gudang', '=', 'Gd_001')->first();
             $valk = $stock->k;
             $valnow = $valk - $val['jumlah'];
             mod_barang_stock::where('code_barang', '=',$val['code_barang'])
                    ->where('code_gudang', '=', 'Gd_001')
                    ->update(
                                    ['k' => $valnow]
                            );
        }
        $resdetail=mod_outstandingorder_detail::whereIn('code_order', $idOrder)->delete();
        
    }

    public function updateDiskon(){         
         try {
                date_default_timezone_set("Asia/Bangkok");
                $mt='';
                $yr='';
                $year = date('Y');
                $month = date('m');
                $day = date('d');
                $hour = date("H");

                if((int)$day == 24){
                    if($hour=="23"){
                        $data = []; 

                        $now = $year.'-'.$month.'-'.$day.' 23:59:59';

                        if($month=='01'){$mt='12'; $intyr = (int)$year; $yr=$intyr-1;}else{$intmnth = (int)$month; $mt=$intmnth-1; $yr=$year;}
                        $yesterday = $yr.'-'.$mt.'-26 00:00:00';
                        
                        $cust =
                        DB::table('ms_customer')
                        ->select('ms_customer.id as id','ms_customer.username as userId', 'ms_customer.nama as nama', 'ms_customer.diskon as diskon', 'ms_customer.created_at as created_at')                
                        ->get(); 
                        
                        foreach($cust as $cs){
                            $custOrder = DB::table('order')
                            ->select('order.id','order.code_customer' ,'order.biayaExpedisi','order.total_harga' ,'order.totalDiskon')
                            ->join('transaksi','transaksi.code_order','=','order.id')
                            ->where('order.code_customer', '=', $cs->id)
                            ->where('transaksi.code_status', '=', 10)
                            ->whereBetween('order.created_at',[$yesterday,$now])
                            ->get();
                            
                            $expedisi = 0 ; $harga=0; $diskon=0;

                            foreach($custOrder as $cst){
                                $expedisi = $expedisi + $cst->biayaExpedisi;
                                $harga = $harga + $cst->total_harga;
                                $diskon = $diskon + $cst->totalDiskon;
                            }

                            $selisih = $harga-$diskon;
                            $discCust = 0 ;
                            if($selisih<500000){
                                $discCust = 25 ;
                            }
                            if($selisih>=500000 && $selisih<1000000){
                                $discCust = 30 ;
                            }
                            if($selisih>=1000000 && $selisih<1500000){
                                $discCust = 35 ;
                            }
                            if($selisih>=1500000 && $selisih<2000000){
                                $discCust = 40 ;
                            }
                            if($selisih>=2000000 && $selisih<3000000){
                                $discCust = 45 ;
                            }
                            if($selisih>=3000000){
                                $discCust = 50 ;
                            }

                            DB::table('ms_customer')
                            ->where('id', '=', $cs->id)
                            ->update(
                                    [ 
                                        'diskon' => $discCust,
                                        'created_at' => $cs->created_at                                    
                                    ]
                                );
                        }                                               
                    
                        $result='sukses';
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

    public function backupdb(){

        date_default_timezone_set("Asia/Bangkok");
        $mt='';
        $yr='';
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $hour = date("H");

        if($hour=="23"){
          $filename = "backup-1" . Carbon::now()->format('Y-m-d') . ".zip";
        	$command = "mysqldump --opt --databases ".env('DB_DATABASE')." -h ".env('DB_HOST')." -u " . env('DB_USERNAME') ." -p'" . env('DB_PASSWORD') . "' | gzip > " . storage_path() . "/app/backup/" . $filename;
        	$returnVar = NULL;
        	$output  = NULL;
        	exec($command, $output, $returnVar);  
        }
    }

}
