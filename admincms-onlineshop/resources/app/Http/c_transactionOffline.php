<?php

namespace App\Http\Controllers;

use App\mod_ms_customer;
use App\mod_ms_customer_alamat;
use App\mod_outstanding_order;
use App\mod_outstanding_orderdetail;
use App\mod_ms_orderDetail;
use App\mod_ms_order;
use App\mod_transaksi;
use App\mod_ms_barangStock;
use App\mod_transaksi_pg;
use App\mod_transaksiDetail_pg;
use App\mod_ms_barang_gudang;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;


class c_transactionOffline extends Controller
{
    public function searchCustomer(Request $request) {
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
                             ->select('ms_customer.id as  id','ms_customer.nama as nama','ms_customer.telephone','ms_customer_alamat.alamat as alamat','ms_customer_alamat.rt as rt','ms_customer_alamat.rw as rw','ms_customer_alamat.kelurahan as kelurahan','ms_customer_alamat.kecamatan as kecamatan','ms_customer_alamat.kab_kota as kab_kota','ms_customer_alamat.propinsi as propinsi')
                             ->join('ms_customer_alamat','ms_customer_alamat.code_customer','=','ms_customer.id')
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

    public function addCustomer(Request $request) {
        $token = $request->token;
        $nama = $request->nama;
        $telephone = $request->telephone;
        $kodeAdminTrx = $request->kodeAdminTrx;
        $alamat = $request->alamat;
        $diskon = $request->diskon;
        $rt = $request->rt;
        $rw = $request->rw;
        $kelurahan = $request->kelurahan;
        $kecamatan = $request->kecamatan;
        $kab_kota = $request->kab_kota;
        $propinsi = $request->propinsi;

        try {
            if($token=='va72r7nm79')
            {
                DB::beginTransaction();
                $count = DB::table('ms_customer')
                ->select(DB::raw('COUNT(ms_customer.id) as count'))
                ->first();
           
                $c = $count->count;
                $kode = 'CUS' . str_pad($c, 6, '0', STR_PAD_LEFT);
                $transaksi = new mod_ms_customer();
                $transaksi->nama = $nama;
                $transaksi->id = $kode;
                $transaksi->telephone = $telephone;
                $transaksi->kodeAdminTrx = $kodeAdminTrx;
                $transaksi->diskon = $diskon;
                $transaksi->save();

                $alamatDB = new mod_ms_customer_alamat();
                $alamatDB->code_customer = $kode;
                $alamatDB->alamat = $alamat;
                $alamatDB->rt = $rt;
                $alamatDB->rw = $rw;
                $alamatDB->kelurahan = $kelurahan;
                $alamatDB->kecamatan = $kecamatan;
                $alamatDB->kab_kota = $kab_kota;
                $alamatDB->propinsi = $propinsi;
                $alamatDB->save();

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


    public function inputOrder(Request $request) {
        $token = $request->token;
        $code_customer = $request->code_customer;
        $nama_pengirim = $request->nama_pengirim;
        $telephone_pengirim = $request->telephone_pengirim;
        $nama_penerima = $request->nama_penerima;
        $telephone_penerima = $request->telephone_penerima;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kab_kota = $request->kab_kota;
        $propinsi = $request->propinsi;
        $kodeAdminTrx = $request->kodeAdminTrx;
        $totalDiskon = $request->totalDiskon;
        $code_expedisi = $request->code_expedisi;
        $totalBiaya =$request->biaya_expedisi;
        $total_harga = $request->total_harga;
        $total_barang = $request->total_barang;
        $typeTransaksi = $request->typeTransaksi;
        $codeGudang = $request->codeGudang;
  
        try {
            if($token=='ijt8ned054')
            {
                DB::beginTransaction();
               
                $transaksi = new mod_outstanding_order();
             
                $transaksi->kodeAdminTrx = $kodeAdminTrx;
                $transaksi->typeTransaksi = $typeTransaksi;
                $transaksi->totalDiskon = $totalDiskon;
                $transaksi->code_customer = $code_customer;
                $transaksi->expedisi = $code_expedisi;
                $transaksi->biaya_expedisi = $totalBiaya;
                $transaksi->total_barang = $total_barang;
                $transaksi->total_harga = $total_harga;
                $transaksi->nama_pengirim = $nama_pengirim;
                $transaksi->telephone_pengirim = $telephone_pengirim;
                $transaksi->nama_penerima = $nama_penerima;
                $transaksi->telephone_penerima = $telephone_penerima;
                $transaksi->alamat = $alamat;
                $transaksi->kecamatan = $kecamatan;
                $transaksi->kab_kota = $kab_kota;
                $transaksi->propinsi = $propinsi;
                $transaksi->codeGudang = $codeGudang;
                $transaksi->save();

                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);

                // $result = 
                // DB::table('outstanding_order')
                // ->select(DB::raw('COUNT(outstanding_order.id) as count'))
                //  ->first();

            //    $kode = str_pad($result->count, 4, '0', STR_PAD_LEFT);
                $id_rec = 'ORD-'.$tahun.$ldate1.$ldate2.'-'.$ldate3.$ldate4.$ldate5;
                DB::table('outstanding_order')->where('id', '=', $transaksi->id)
                ->update([
                    'idOrder' => $id_rec
                ]);
                // $kode = 'ORD' . str_pad($transaksi->id, 5, '0', STR_PAD_LEFT);
                // $id_rec = $kode.'-'.$ldate.$ldate1.$ldate2.'-'.$ldate3.$ldate4.$ldate5;
                // DB::table('outstanding_order')->where('id', '=', $transaksi->id)
                // ->update([
                //     'idOrder' => $id_rec
                // ]);
                DB::commit();
                $result=$id_rec;    
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
                    // $result = [];
                    //         $result = 
                    //                  DB::table('outstanding_order')
                    //                  ->select('outstanding_order.id as  id','outstanding_order.idOrder as idOrder','outstanding_order.code_customer as code_customer','outstanding_order.nama_pengirim as namaPengirim','outstanding_order.telephone_pengirim as telephonePengirim','outstanding_order.nama_penerima as namaPenerima','outstanding_order.telephone_penerima as telephonePenerima','outstanding_order.kab_kota as kab_kota','outstanding_order.propinsi as propinsi')
                    //                  ->join('ms_customer','ms_customer.id','=','outstanding_order.code_customer')
                    //                  ->where('outstanding_order.idOrder', '=', $code_order)
                    //                   ->get();
                    //         }
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

    public function dataGetOutStandingOrderCustomer($code_order)
    {
        try{
                // $result = 'True';
                $result = 
                DB::table('outstanding_order')
                ->select('outstanding_order.id as  id','outstanding_order.idOrder as idOrder','outstanding_order.code_customer as code_customer','ms_customer.nama as nama','outstanding_order.nama_pengirim as namaPengirim','outstanding_order.telephone_pengirim as telephonePengirim','outstanding_order.nama_penerima as namaPenerima','outstanding_order.alamat as alamat','outstanding_order.kecamatan as kecamatan','outstanding_order.telephone_penerima as telephonePenerima','outstanding_order.kab_kota as kab_kota','outstanding_order.propinsi as propinsi','outstanding_order.created_at as created_at','outstanding_order.expedisi as expedisi','outstanding_order.biaya_expedisi as biayaExpedisi', 'outstanding_order.typeTransaksi as  typeTransaksi', 'outstanding_order.total_harga as  totalHarga', 'outstanding_order.totalDiskon as  totalDiskon','outstanding_order.codeGudang as codeGudang')
                ->join('ms_customer','ms_customer.id','=','outstanding_order.code_customer')
                ->where('outstanding_order.idOrder', '=', $code_order)
                ->where('outstanding_order.image','=','-')
                ->get(); 
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function dataGetOutStandingOrderDetail($code_order)
    {
        try{
                // $result = 'True';
                $result = 
                DB::table('outstanding_orderdetail')
                ->select(DB::raw('(SELECT SUM(berat) as totalBerat FROM ms_barang JOIN outstanding_orderdetail A ON A.code_barang = ms_barang.id WHERE A.code_order = "'.$code_order.'" AND A.code_promo = outstanding_orderdetail.code_promo)as totalBerat'),
                'outstanding_orderdetail.id as  id','outstanding_orderdetail.code_order as code_order','ms_barang.id as code_barang','ms_barang.judul_buku as judul_buku','outstanding_orderdetail.jumlah as jumlah','ms_barang.berat as berat','outstanding_orderdetail.diskon as diskon','outstanding_orderdetail.harga as harga','outstanding_orderdetail.code_promo as code_promo','outstanding_orderdetail.nama_promo as nama_promo','outstanding_orderdetail.harga_promo as harga_promo')
                ->join('ms_barang','ms_barang.id','=','outstanding_orderdetail.code_barang')
                ->where('outstanding_orderdetail.code_order', '=', $code_order)
              
                ->get(); 
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

/////////////////////////////////////////////////////////////////////////////
public function getAllItem(Request $request) {
    $token = $request->token;
    $code_order = $request->code_order;
    $namaBuku = $request->nama_buku;
    $offset  = $request->offset;
    $codeGudang = $request->codeGudang;
    try {
        if($token=='4f397id1ot')
        {
            $result= [
                'data' => $this->getAllItem_($namaBuku,$offset,$codeGudang),
                'count' => $this->getCount_($this->getAllItem_($namaBuku,$offset,$codeGudang)),
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

    public function getAllItem_($namaBuku,$offset,$codeGudang) {

        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            $result = [];
                    $query = 
                                  DB::table('ms_barang')
                             ->select('ms_barang.id as id','ms_barang.judul_buku as judul_buku','ms_barang.berat as berat','ms_barang.kategori as kategori','ms_barang.harga as harga', DB::raw('(ms_barang_stock.d - ms_barang_stock.k) as stock'))
                            //  ->join('ms_kategori_buku','ms_kategori_buku.id','=','ms_barang.code_kategori_buku')
                             ->join('ms_barang_stock','ms_barang_stock.code_barang','=','ms_barang.id')
                              //->where('ms_kategori_buku.nama_kategori', 'like', $kategori.'%')
                              ->where('ms_barang.judul_buku','like', '%'.$namaBuku.'%')
                            ->orderBy('ms_barang.judul_buku','asc')
                              ->limit(10)
                              ->offset($offset);
                          
            if($codeGudang){
                $query->where('ms_barang_stock.code_gudang','=',$codeGudang);
            }
            $result=$query ->get();
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCount_($data) {
      
        try {
                    $result = 0;
                    foreach($data as $val)
                    {
                        $result++;
                    }
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function inputItemOrder(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $code_barang = $request->code_barang;
        $code_promo = $request->code_promo;
        $nama_promo = $request->nama_promo;
        $harga_promo = $request->harga_promo;
        $harga = $request->harga;
     
        $jumlah = $request->jumlah;
        $diskon = $request->diskon;
        $codeGudang = $request->codeGudang;
        try {
            if($token=='6w2kwivjf4')
            {
                DB::beginTransaction();
               
                $transaksi = new mod_outstanding_orderdetail();
                $transaksi->code_order = $code_order;
                $transaksi->code_barang = $code_barang;
                $transaksi->code_promo = $code_promo;
                $transaksi->nama_promo = $nama_promo;
                $transaksi->harga_promo = $harga_promo;
                $transaksi->jumlah = $jumlah;
                $transaksi->diskon = $diskon;
                $transaksi->harga = $harga;
                $transaksi->save();

                $k = DB::table('ms_barang_stock')
                ->select('k as stock')
                ->where('code_barang','=',$code_barang)
                ->where('code_gudang','=',$codeGudang)
                ->first();
                $stock_sekarang = ($k->stock +$jumlah);
                DB::beginTransaction();
                DB::table('ms_barang_stock')
                ->where('code_barang','=',$code_barang)
                ->where('code_gudang','=',$codeGudang)
                ->update([
                    'k'=>$stock_sekarang, 
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

    public function cekStock(Request $request) {
        $data = $request->data;
        $token = $request->token;
        $val_decode = json_decode($data);
        $codeGudang = $request->codeGudang;
        try
        {
            if($token=='7s2kwivjf4')
            {
                foreach ($val_decode as $y => $val)
                {
                    $stockJson = $val;
                    $codeBarang = $y;

                    $stockJson = $val;
                    $codeBarang = $y;

                    if(strtolower(substr($codeBarang,0,5)) == 'promo'){
                        $dt =
                        // DB::table('ms_promo')
                        // ->select('ms_promo.code_promo as codePromo',DB::raw('a.min as stock'))
                        // ->join(DB::raw('(select ms_barang_promo.code_promo as code_promo, 
                        //             min(ms_barang_stock.d-ms_barang_stock.k)as min from ms_barang
                        //             join ms_barang_promo on ms_barang_promo.code_barang=ms_barang.id
                        //             join ms_barang_stock on ms_barang_stock.code_barang = ms_barang.id
                        //             GROUP BY ms_barang_promo.code_promo) as a'),
                        //             'ms_promo.code_promo','=','a.code_promo' )
                        // ->where('ms_promo.code_promo','=',$codeBarang);
                        
                        DB::table('ms_promo')
                        ->select('ms_promo.code_promo as codePromo',DB::raw('a.min as stock'))
                        ->join(DB::raw('(select ms_barang_promo.code_promo as code_promo, 
                                    min(ms_barang_stock.d-ms_barang_stock.k)as min from ms_barang
                                    join ms_barang_promo on ms_barang_promo.code_barang=ms_barang.id
                                    join ms_barang_stock on ms_barang_stock.code_barang = ms_barang.id
                                    where ms_barang_stock.code_gudang="'.$codeGudang.'"
                                    GROUP BY ms_barang_promo.code_promo) as a'),
                                    'ms_promo.code_promo','=','a.code_promo' )
                        ->where('ms_promo.code_promo','=',$codeBarang)
                        // ->where('codeGudang','=',$codeGudang)
                        ->first();
                    }
                    else
                    {
                        $dt = DB::table('ms_barang_stock')
                        ->select(DB::raw('(d-k) as stock'))
                        ->where('code_barang','=',$codeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->first();
                    }
                    
                    
                    $stockSistem = $dt->stock;
                    $stockCek = $stockSistem-$stockJson;
                    
                    
                    $stockSistem = $dt->stock;
                    $stockCek = $stockSistem-$stockJson;

                    // $dt = DB::table('ms_barang_stock')
                    // ->select(DB::raw('(d-k) as stock'))
                    // ->where('code_barang','=',$codeBarang)
                    // ->first();
                    // $stockSistem = $dt->stock;
                    // $stockCek = $stockSistem-$stockJson;
                    if($stockCek<0)
                    {
            
                        $result = 'failed';  
                        break;
                    }
                    else
                    {
                        $result = 'success';
                    }
                }
               
        // foreach($val_decode as $val)
        // {
        //     
        // }
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


    public function updateAlamatIO(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $alamat = $request->alamat;
        $kab_kota = $request->kab_kota;
        $propinsi = $request->propinsi;
        try {
            if($token=='z34c8gfvl')
            {
                DB::beginTransaction();
               
                DB::table('outstanding_order')
                ->where('idOrder','=',$code_order)
                ->update([
                    'alamat'=>$alamat, 
                    'kab_kota'=>$kab_kota, 
                    'propinsi'=>$propinsi 
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


    public function editItemOrder(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $code_barang = $request->code_barang;
 
        $jumlah = $request->jumlah;
        try {
            if($token=='z68cn8gfvl')
            {
                DB::beginTransaction();
               
                DB::table('outstanding_orderdetail')
                ->where('code_order','=',$code_order)
                ->where('code_barang','=',$code_barang)
                ->update([
                 
                    'jumlah'=>$jumlah 
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

    // public function deleteItemOrder(Request $request) {
    //     $token = $request->token;
    //     $code_order = $request->code_order;
    //     $code_barang = $request->code_barang;
    //     try {
    //         if($token=='c1gqabseqm')
    //         {
    //             DB::beginTransaction();
               
    //             DB::table('outstanding_orderdetail')->where('code_order','=',$code_order)
    //             ->where('code_barang','=',$code_barang)->delete();
    //             DB::commit();
    //             $result='success';    
    //                 }
    //                 else
    //                 {
    //                     $result = 'Invalid Token';   
    //                 }  
    //                 return response()->json($result); 
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         return response()->json($ex);
    //     }
    // }

    public function getItemOrder(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        try {
            if($token=='pjpal1n9fk')
            {
                $result = [];
                    $result = 
                            //  DB::table('outstanding_orderdetail')
                            //  ->select('outstanding_orderdetail.id as id','outstanding_orderdetail.code_barang as code_barang')
                            // //  ->join('ms_barang','ms_barang.id','=','outstanding_orderdetail.code_barang')
                            
                            // //   ->where('outstanding_orderdetail.code_order', '=', $code_order)
                            //   ->get();

                            $result = 
                            DB::table('outstanding_orderdetail')
                            ->select('outstanding_orderdetail.id as id','outstanding_orderdetail.code_barang as code_barang','ms_barang.judul_buku as judul_buku','outstanding_orderdetail.jumlah as jumlah','outstanding_orderdetail.harga as harga')
                            ->join('ms_barang','ms_barang.id','=','outstanding_orderdetail.code_barang')
                            ->where('outstanding_orderdetail.code_order', '=', $code_order) 
                            ->get();
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

    public function orderNow(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $gambar = $request->gambar;
        $keterangan = $request->keterangan;
        $bank = $request->bank;
        if($bank){$bankInput=$bank;}
        else{$bankInput='-';}
        try {
            if($token=='dzgbjjv3ud')
            {
                DB::beginTransaction();
                $order = DB::table('outstanding_order')
                ->select('outstanding_order.idOrder as id','outstanding_order.typeTransaksi as typeTransaksi','outstanding_order.kodeAdminTrx as kodeAdmin','outstanding_order.expedisi as expedisi','outstanding_order.totalDiskon as totalDiskon','outstanding_order.code_customer as code_customer','outstanding_order.biaya_expedisi as biayaExpedisi','outstanding_order.total_barang as totalB','outstanding_order.total_harga as totalH','outstanding_order.nama_pengirim as namaPengirim','outstanding_order.telephone_pengirim as telephonePengirim','outstanding_order.nama_penerima as namaPenerima','outstanding_order.telephone_penerima as telephonePenerima','outstanding_order.alamat as alamat','outstanding_order.kecamatan as kecamatan','outstanding_order.kab_kota as kab_kota','outstanding_order.propinsi as propinsi','outstanding_order.image as image','outstanding_order.codeGudang as codeGudang')
                ->where('outstanding_order.idOrder','=',$code_order)
                ->first();

                // $kodeAdminTrx = DB::table('ms_admin')
                // ->select('ms_admin.kodeAdminTrx as kodeAdminTrx')
                // ->where('ms_admin.username','=',$username)
                // ->first();

                $orderDetail = [];
                $orderDetail = DB::table('outstanding_orderdetail')
                ->select('outstanding_orderdetail.id as id','outstanding_orderdetail.code_order as code_order','outstanding_orderdetail.code_barang as code_barang','outstanding_orderdetail.code_promo as code_promo','outstanding_orderdetail.nama_promo as nama_promo','outstanding_orderdetail.jumlah as jumlah','outstanding_orderdetail.harga as harga','outstanding_orderdetail.harga_promo as harga_promo','outstanding_orderdetail.diskon as diskon','outstanding_orderdetail.keterangan as keterangan')
                ->where('outstanding_orderdetail.code_order','=', $code_order)
                ->get();
                // $total_brg = 
                // $total_hrg = 
            

                $transaksi = new mod_ms_order();
                $transaksi->id = $order->id;
                $transaksi->code_customer = $order->code_customer;
           
                $transaksi->expedisi = $order->expedisi;
                $transaksi->biayaExpedisi = $order->biayaExpedisi;
                 $transaksi->totalDiskon = $order->totalDiskon;
                $transaksi->total_barang = $order->totalB;
                $transaksi->total_harga =  $order->totalH;
                $transaksi->nama_pengirim = $order->namaPengirim;
                $transaksi->telephone_pengirim = $order->telephonePengirim;
                $transaksi->nama_penerima =  $order->namaPenerima;
                $transaksi->telephone_penerima = $order->telephonePenerima;
                $transaksi->alamat = $order->alamat;
                $transaksi->kecamatan = $order->kecamatan;
                $transaksi->kab_kota = $order->kab_kota;
                $transaksi->propinsi =$order->propinsi;
                $transaksi->pre_order = '0';
                $transaksi->image = $gambar;
                $transaksi->codeGudang = $order->codeGudang;
                $transaksi->bank = $bankInput;
                // // $transaksi->lunas = $lunas;
                $transaksi->save();

                $transaksiOrder = new mod_transaksi();
                $transaksiOrder->code_order = $code_order;
                $transaksiOrder->kodeAdminTrx = $order->kodeAdmin;
                $transaksiOrder->approve_sales = '1';
                $transaksiOrder->code_status='4';
                if($order->codeGudang =='Gd_002')
                {
                    $transaksiOrder->code_perusahaan = '2';
                }
                $transaksiOrder->typeTransaksi = $order->typeTransaksi;
                $transaksiOrder->keterangan =  '-';
          
                $transaksiOrder->save();
              
               
                $val_decode = json_decode($orderDetail);

                foreach($val_decode as $val)
                {
                    $transaksiOrderDetail = new mod_ms_orderDetail();
                    $transaksiOrderDetail->code_order = $val->code_order;
                    $transaksiOrderDetail->code_barang = $val->code_barang;
                    $transaksiOrderDetail->code_promo = $val->code_promo;
                    $transaksiOrderDetail->nama_promo = $val->nama_promo;
                    $transaksiOrderDetail->jumlah = $val->jumlah;
                    $transaksiOrderDetail->harga = $val->harga;
                    $transaksiOrderDetail->harga_promo = $val->harga_promo;
                    $transaksiOrderDetail->diskon = $val->diskon;
                    $transaksiOrderDetail->keterangan = $val->keterangan;
                    $transaksiOrderDetail->save();
                }
             
                DB::commit();
                DB::table('outstanding_order')->where('idOrder','=',$code_order)
                ->delete();
                      DB::table('outstanding_orderdetail')->where('code_order','=',$code_order)
                 ->delete();
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
            return response()->json( $ex);
        }
    }

 
    public function getAllOrderOutstanding(Request $request) {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        // $kodeOrderDetail = $request->kodeOrderDetail;
        $namaPenerima = $request->namaPenerima;
        $offset = $request->offset;
        try {
            if($token=='5nkeygqp9l')
            {
                $result= [
                    'data' => $this->getOrder($offset,$kodeAdmin,$namaPenerima),
                    'count' => $this->getCount($kodeAdmin,$namaPenerima)
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
    public function getOrder($offset,$kodeAdmin,$namaPenerima)
    {
        try{
        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
            $query = 
                DB::table('outstanding_order')
                ->select('outstanding_order.id as id','outstanding_order.idOrder as idOrder','ms_customer.nama as nama','outstanding_order.nama_penerima as namaPenerima','outstanding_order.total_harga as totalHarga','outstanding_order.biaya_expedisi as biayaExpedisi','outstanding_order.totalDiskon as totalDiskon','outstanding_order.typeTransaksi as typeTransaksi','outstanding_order.created_at as created_at')
                ->join('ms_customer','ms_customer.id','=','outstanding_order.code_customer')
                ->where('outstanding_order.image','=','-')
                ->where('outstanding_order.kodeAdminTrx','=',$kodeAdmin)
                ->orderBy('outstanding_order.updated_at', 'DESC')
                ->limit(10)
                ->offset($offset);

            // if($kodeOrderDetail){
            //     $query->where('outstanding_order.idOrder', 'like', $kodeOrderDetail.'%');
            // }

            if($namaPenerima){
                    $query->where('outstanding_order.nama_penerima', 'like', $namaPenerima.'%');
                }

            
            // if($sb1){
            //     $query->orderBy($sb1, 'ASC');
            // }
           

            $result=$query ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCount($kodeAdmin,$namaPenerima)
    {
        try{
    // if($offset){$offset=(int)$offset;}
        // else{$offset=0;}
        $query = 
        DB::table('outstanding_order')
        ->select(DB::raw('COUNT(outstanding_order.id) as count'))
        ->where('outstanding_order.image','=','-')
        ->where('outstanding_order.kodeAdminTrx','=',$kodeAdmin);
        // ->where('outstanding_order.idOrder', 'like', $kodeOrderDetail.'%')
        // ->first();

        if($namaPenerima){
            $query->where('outstanding_order.nama_penerima', 'like', $namaPenerima.'%');
        }

        $result=$query ->first();
        return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function editOutstanding(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $totalDiskon = $request->totalDiskon;
        $typeTransaksi = $request->typeTransaksi;
        $expedisi = $request->expedisi;
        $biaya_expedisi = $request->biaya_expedisi;
        $total_barang = $request->total_barang;
        $total_harga = $request->total_harga;
        $nama_pengirim = $request->nama_pengirim;
        $telephone_pengirim = $request->telephone_pengirim;
        $nama_penerima = $request->nama_penerima;
        $telephone_penerima = $request->telephone_penerima;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kab_kota = $request->kab_kota;
        $propinsi = $request->propinsi;
        $image = $request->image;
        try {
            if($token=='98sc8gfvl')
            {
                DB::beginTransaction();
               
                DB::table('outstanding_order')
                ->where('idOrder','=',$code_order)
                ->update([
                    'totalDiskon'=>$totalDiskon,
                    'typeTransaksi'=>$typeTransaksi,
                    'expedisi'=>$expedisi,
                    'biaya_expedisi'=>$biaya_expedisi,
                    'total_barang'=>$total_barang,
                    'total_harga'=>$total_harga,
                    'nama_pengirim'=>$nama_pengirim,
                    'telephone_pengirim'=>$telephone_pengirim,
                    'nama_penerima'=>$nama_penerima,
                    'telephone_penerima'=>$telephone_penerima,
                    'alamat'=>$alamat, 
                    'kecamatan'=>$kecamatan, 
                    'kab_kota'=>$kab_kota, 
                    'propinsi'=>$propinsi,
                    'image'=>$image,

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

   
    public function deleteOutstandingItemOrder(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
        $codeGudang = $request->codeGudang;
        try {
            if($token=='6w2kwivjf4')
            {
                DB::beginTransaction();
                $OutstandingOrderItem = [];
                $OutstandingOrderItem = DB::table('outstanding_orderdetail')
                ->select('code_barang as codeBarang','jumlah as jumlah')
                ->where('code_order','=',$code_order)
                ->get();
                $val_decode = json_decode($OutstandingOrderItem);

                foreach ($val_decode as  $val)
                {
                            $kodeBarang = $val->codeBarang;
                            $jumlah = $val->jumlah;
               

                        $k = DB::table('ms_barang_stock')
                        ->select('k as stock')
                        ->where('code_barang','=',$kodeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->first();
                        $stock_sekarang = ($k->stock -$jumlah);
                   
                        DB::table('ms_barang_stock')
                        ->where('code_barang','=',$kodeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->update([
                            'k'=>$stock_sekarang, 
                        ]);
                    
                }
           
                DB::table('outstanding_orderdetail')->where('code_order','=',$code_order)
               ->delete();
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



    public function deleteOutstanding(Request $request) {
        $token = $request->token;
        $code_order = $request->code_order;
     $codeGudang = $request->codeGudang;
        try {
            if($token=='6w2kwivjf4')
            {
                DB::beginTransaction();
                $OutstandingOrderItem = [];
                $OutstandingOrderItem = DB::table('outstanding_orderdetail')
                ->select('code_barang as codeBarang','jumlah as jumlah')
                ->where('code_order','=',$code_order)
                ->get();
                $val_decode = json_decode($OutstandingOrderItem);

                foreach ($val_decode as  $val)
                {
                            $kodeBarang = $val->codeBarang;
                            $jumlah = $val->jumlah;
               

                        $k = DB::table('ms_barang_stock')
                        ->select('k as stock')
                        ->where('code_barang','=',$kodeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->first();
                        $stock_sekarang = ($k->stock -$jumlah);
                   
                        DB::table('ms_barang_stock')
                        ->where('code_barang','=',$kodeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->update([
                            'k'=>$stock_sekarang, 
                        ]);
                    
                }
                DB::table('outstanding_order')->where('idOrder','=',$code_order)
                ->delete();
                 DB::table('outstanding_orderdetail')->where('code_order','=',$code_order)
                ->delete();
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


    public function deleteCustomer(Request $request) {
        $token = $request->token;
        $idCustomer = $request->idCustomer;
      
        try {
            if($token=='98sc8gfvl')
            {
                DB::beginTransaction();
               
                DB::table('ms_customer')
                ->where('id','=',$idCustomer)
                ->update([
                    'isDell'=>'1',

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

    public function getTransaksiDataPG(Request $request) {
        $nama_gudang = $request->nama_gudang;
        $token = $request->token;
        $code_perusahaan = $request->code_perusahaan;
        $pic = $request->pic;
        try{
                if($token=='77sc8gfvl')
                {
            $query = 
                DB::table('transaksi_pg')
                ->select('transaksi_pg.id as id','transaksi_pg.code_transaksi_pg as code_transaksi_pg',
                DB::raw('(SELECT nama as pic FROM ms_admin where ms_admin.kodeAdminTrx = transaksi_pg.pic) as pic'),
                'ms_barang_gudang.nama_gudang as nama_gudang','transaksi_pg.created_at as tanggalInput')
                // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                ->join('ms_barang_gudang', 'ms_barang_gudang.code_gudang','=','transaksi_pg.code_gudang')  
                ->where('ms_barang_gudang.nama_gudang','like','%'.$nama_gudang.'%')
                ->orderBy('transaksi_pg.created_at','desc')
                ->limit(10);
            
                if($code_perusahaan){
                    $query->where('transaksi_pg.code_perusahaan', '=', $code_perusahaan);
                }
                if($pic){
                    $query->where('transaksi_pg.pic', '=', $pic);
                }
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

    public function getDetailTransaksiDataPG(Request $request) {
        $code_transaksi_pg = $request->code_transaksi;
        $token = $request->token;
        try {
            if($token=='66sc8gfvl')
            {
                $result= [
                    'data' => $this->getDetailPG($code_transaksi_pg),
                     'itemDetail' => $this->getDetailPGOrder($code_transaksi_pg)
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

    public function getDetailPG($code_transaksi_pg) {
       
        try{
        
            $query = 
                // DB::table('transaksi_pg')
                // ->select('transaksi_pg.id as id','transaksi_pg.code_transaksi_pg as code_transaksi_pg',
                // 'ms_barang_gudang.nama_gudang as nama_gudang', DB::raw('(SELECT nama as pic FROM ms_admin where ms_admin.kodeAdminTrx = transaksi_pg.pic) as pic'),
                // 'ms_barang.judul_buku as judul_buku','transaksi_pg_detail.jumlah as jumlah')
                // // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                // ->join('ms_barang_gudang', 'ms_barang_gudang.code_gudang','=','transaksi_pg.code_gudang')
                // ->join('transaksi_pg_detail', 'transaksi_pg_detail.code_transaksi_pg','=','transaksi_pg.code_transaksi_pg')
                // ->join('ms_barang', 'ms_barang.id','=','transaksi_pg_detail.code_barang')  
                // ->where('transaksi_pg.code_transaksi_pg','=',$code_transaksi_pg);

                DB::table('transaksi_pg')
                ->select('transaksi_pg.id as id','transaksi_pg.code_transaksi_pg as code_transaksi_pg',
                'ms_barang_gudang.nama_gudang as nama_gudang','ms_barang_gudang.alamat as alamat','ms_barang_gudang.telephone as telephone','ms_status_trx.status as status','transaksi_pg.status as statusPG','transaksi_pg.harga_total as harga_total','transaksi_pg.total_diskon as total_diskon')
                // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                ->join('ms_barang_gudang', 'ms_barang_gudang.code_gudang','=','transaksi_pg.code_gudang')
                ->join('ms_status_trx', 'ms_status_trx.id','=','transaksi_pg.status')

                ->where('transaksi_pg.code_transaksi_pg','=',$code_transaksi_pg);
                $result=$query ->get();
   
       
            return $result;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function getDetailPGOrder($code_transaksi_pg) {
       
        try{
        
            $query = 
                DB::table('transaksi_pg')
                ->select('transaksi_pg.id as id','transaksi_pg_detail.code_barang as codeBarang',
                'ms_barang.judul_buku as judul_buku','transaksi_pg_detail.jumlah as jumlah','transaksi_pg_detail.harga as harga','transaksi_pg_detail.diskon as diskon')
                // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                ->join('ms_barang_gudang', 'ms_barang_gudang.code_gudang','=','transaksi_pg.code_gudang')
                ->join('transaksi_pg_detail', 'transaksi_pg_detail.code_transaksi_pg','=','transaksi_pg.code_transaksi_pg')
                ->join('ms_barang', 'ms_barang.id','=','transaksi_pg_detail.code_barang')  
                ->where('transaksi_pg.code_transaksi_pg','=',$code_transaksi_pg);
                $result=$query ->get();
   
       
            return $result;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function insertTransaksiDataPG(Request $request) {
        $token = $request->token;
        $pic = $request->pic;
        $code_gudang = $request->codeGudang;
        $harga_total = $request->hargaTotal;
        $total_diskon = $request->totalDiskon;
        $jasa_kirim = $request->jasaKirim;
        $ongkos_kirim = $request->ongkosKirim;
        $status = $request->status; 
        if(substr($pic,0,3)=='JKT'){$statusFix='10'; $codePT=2;}
        if(substr($pic,0,3)!='JKT'){$statusFix=$status;$codePT=1;}
        try{
            if($token=='44sc8gfvl')
            {
            DB::beginTransaction();
            $ldate = date('Y');
            $ldate1 = date('m');
            $ldate2 = date('d');
            $ldate3 = date('h');
            $ldate4 = date('i');
            $ldate5 = date('s');
            $tahun = substr($ldate,2);
            $kode = 'PG-'.$tahun.$ldate1.$ldate2.'-'.$ldate3.$ldate4.$ldate5;  
            $transaksi = new mod_transaksi_pg();
            $transaksi->code_transaksi_pg = $kode;
            $transaksi->code_perusahaan = $codePT;
            $transaksi->pic = $pic;
            $transaksi->ongkos_kirim=$ongkos_kirim;
            $transaksi->code_gudang = $code_gudang;
            $transaksi->harga_total = $harga_total;
            $transaksi->total_diskon = $total_diskon;
            $transaksi->jasa_kirim = $jasa_kirim;
            $transaksi->status=$statusFix;
            $transaksi->save();
            DB::commit();
            $result=$kode;    
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


    public function insertTransaksiDataPG_Detail(Request $request) {
        $token = $request->token;
        $code_transksi_pg = $request->codeTransaksi;
        $cdGudang = $request->cdGudang;
        $bkJumlah = $request->bkJumlah;
        $bkHarga = $request->bkHarga;
        $bkDiskon = $request->bkDiskon;
        $bkJumlahDec = json_decode($bkJumlah, true);
        $bkDiskonDec= json_decode($bkDiskon, true);
        $bkHargaDec = json_decode($bkHarga, true);
        try{
            if($token=='55sc8gfvl')
            {
                $i=0;
                foreach ($bkJumlahDec as $y => $val)
                {
                    $jumlah = $val;
                    $code_barang = $y;
                    $harga = $bkHargaDec[$y];
                    $diskon = $bkDiskonDec[$y];

                    DB::beginTransaction();
                    $transaksi = new mod_transaksiDetail_pg();
                    $transaksi->code_transaksi_pg = $code_transksi_pg;
                    $transaksi->code_barang = $code_barang;
                    $transaksi->jumlah = $jumlah;
                    $transaksi->harga = $harga;
                    $transaksi->diskon = $diskon;
                    $transaksi->save();

                    $k = DB::table('ms_barang_stock')
                    ->select('k as stock')
                    ->where('code_barang','=',$code_barang)
                    ->where('code_gudang','=',$cdGudang)
                    ->first();
                    $stock_sekarang = ($k->stock + $jumlah);
                    DB::beginTransaction();
                    DB::table('ms_barang_stock')
                    ->where('code_barang','=',$code_barang)
                    ->where('code_gudang','=',$cdGudang)
                    ->update([
                        'k'=>$stock_sekarang, 
                    ]);
                    $i +=1;
                }
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

    public function insertGudang(Request $request) {
        $token = $request->token;
        $namaGudang = $request->namaGudang;
        $alamat = $request->alamat;
        $telephone = $request->telephone;
        try{
            if($token=='39sc8gfvl')
            {
                DB::beginTransaction();
                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);
                $kode = 'GD-'.$tahun.$ldate1.$ldate2.'-'.$ldate3.$ldate4.$ldate5;  
                DB::beginTransaction();
                $transaksi = new mod_ms_barang_gudang();
                $transaksi->code_gudang = $kode;
                $transaksi->nama_gudang = $namaGudang;
                $transaksi->alamat = $alamat;
                $transaksi->telephone = $telephone;
                $transaksi->save();

            DB::commit();
            $result=$kode;    
                }
                else
                {
                    $result = 'Invalid Token';   
                }  
                return response()->json($result); 
        } catch (\Exception $ex) {
            return response()->json($transaksi);
        }
    }

    public function deleteGudang(Request $request) {
        $token = $request->token;
        $id = $request->id;
      
        try {
            if($token=='98sc8gf0l')
            {
                DB::beginTransaction();
               
                DB::table('ms_barang_gudang')
                ->where('id','=',$id)
                ->update([
                    'is_del'=>'1',

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

    public function getGudang(Request $request) {
        $nama_gudang = $request->nama_gudang;
        $token = $request->token;
        try{
                if($token=='77sc8gf89')
                {
            $query = 
                DB::table('ms_barang_gudang')
                ->select('ms_barang_gudang.id as id','ms_barang_gudang.code_gudang as code_gudang', 'ms_barang_gudang.nama_gudang as nama_gudang',
                'ms_barang_gudang.telephone as telephone','ms_barang_gudang.alamat as alamat')
                // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                ->where('ms_barang_gudang.nama_gudang','like','%'.$nama_gudang.'%')
                ->where('ms_barang_gudang.is_del','=','0');
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

    public function getDetailGudang(Request $request) {
        $code_gudang = $request->code_gudang;
        $token = $request->token;
        try{
                if($token=='77sc8gfvl')
                {
            $query = 
                DB::table('ms_barang_gudang')
                ->select('ms_barang_gudang.id as id','ms_barang_gudang.code_gudang as code_gudang',
                'ms_barang_gudang.telephone as telephone','ms_barang_gudang.alamat as alamat')
                // ->join('ms_admin', 'stock_opnam.code_barang','=','ms_barang.id')
                ->where('ms_barang_gudang.code_gudang','=',$code_gudang);
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

    public function updateTransaksiDataPG(Request $request) {
        $token = $request->token;
        $tipeStatus = $request->tipeStatus;
        $id= $request->id;
        try{
            if($token=='55sc8gfvl')
            {
            DB::beginTransaction();
            DB::table('transaksi_pg')->where('id', '=', $id)
            ->update([
                'status' => $tipeStatus
            ]);

            if($tipeStatus=='10')
            {
                $transaksiPG = DB::table('transaksi_pg')
                ->select('transaksi_pg.code_transaksi_pg as code','transaksi_pg.code_gudang as codeGudang')
                ->where('id','=',$id)
                ->first();
                $transaksiPGDetail = DB::table('transaksi_pg_detail')
                ->select('transaksi_pg_detail.code_transaksi_pg as codeTransaksi','transaksi_pg_detail.code_barang as code_barang','transaksi_pg_detail.jumlah as jumlah')
                ->where('transaksi_pg_detail.code_transaksi_pg','=',$transaksiPG->code)
                ->get();
             
                $val_decode = json_decode($transaksiPGDetail);

                foreach ($val_decode as  $val)
                {

                    $barangStock = DB::table('ms_barang_stock')
                    ->select('ms_barang_stock.id as id','ms_barang_stock.code_barang as codeBarang','ms_barang_stock.d as d')
                    ->where('ms_barang_stock.code_barang','=',$val->code_barang)
                    ->where('ms_barang_stock.code_gudang','=',$transaksiPG->codeGudang)
                    ->first();

                    if($barangStock)
                    {
                        $stock = $barangStock->d +  $val->jumlah;
                        $barangStock_ = $barangStock->d;
                        DB::table('ms_barang_stock')
                        ->where('id', '=', $barangStock->id)
                        ->update([
                            'd' => $stock
                        ]);
                    }
                    else
                    {
                        $barangStock = new mod_ms_barangStock();
                        $barangStock->code_barang = $val->code_barang;
                        $barangStock->d = $val->jumlah;
                        $barangStock->code_gudang = $transaksiPG->codeGudang;
                        $barangStock->save();
                    }

                  
                }

            }
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
}
