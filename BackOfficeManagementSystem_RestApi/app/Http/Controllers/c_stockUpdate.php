<?php

namespace App\Http\Controllers;

use App\mod_stockUpdate;
use App\mod_ms_barang;
use App\mod_return_buku;
use App\mod_ms_barangStock;
use App\mod_stockOpnam_log;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_stockUpdate extends Controller
{

    public function getAllStockBukuItem(Request $request) {
        $token = $request->token;
        try {
            if($token=='ssw237id1ot')
            {
                // $result= [
                //     'data' => $this->getAllBuku()
                
                // ];
                $query = DB::table('ms_barang')            
                ->select('ms_barang.id as code', 'ms_barang.judul_buku as judul')           
                ->orderBy('ms_barang.judul_buku','asc');

                $res=$query->get(); 

                $val_decode = json_decode($res, true);

                $dataarray = array();
                foreach($val_decode as $key => $val)
                {
                    $code = $val['code'];
                    $judul =$val['judul'];
                    $dataarray[$judul] = $code;
                    // array_push($dataarray[$judul],$code);
                }              
                
                $rslt = json_encode($dataarray);

                

            }
        else
            {
                $result = 'Invalid Token';   
            }  
        return response()->json($dataarray); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getAllBuku() {

  
        try {

        
                $query = DB::table('ms_barang')            
                // ->select(DB::raw('CONCAT(ms_barang.id, " : ", ms_barang.judul_buku) as Buku'))
                ->select('ms_barang.id as code, ms_barang.judul_buku as judul')
                // ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
                // ->where('ms_barang_stock.code_gudang', '=','Gd_001')
           
                ->orderBy('ms_barang.judul_buku','asc');

                $result=$query->get(); 

                $val_decode = json_decode($result, true);

                $dataarray = array();
                foreach($val_decode as $val)
                {
                    $code = $val->code;
                    $judul = $val->judul;
                    $dataarray[$judul] = $code;
                }              
                
                $rslt = json_encode($dataarray);
           
            return $query;  
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($query);
        }
    }

    
    public function code_Buku() {

        return DB::table('ms_barang')            
             
        ->select('ms_barang.id as code')
        ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
        ->where('ms_barang_stock.code_gudang', '=','Gd_001')
   
         ->orderBy('ms_barang.judul_buku','asc')
         ->get(); 
    }
    public function judul_Buku() {

            return DB::table('ms_barang')            
             
                 ->select('ms_barang.judul_buku')
                 ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
                 ->where('ms_barang_stock.code_gudang', '=','Gd_001')
            
                  ->orderBy('ms_barang.judul_buku','asc')
                  ->get();

    }



    public function getAllStockBuku(Request $request) {
        $token = $request->token;
        $namaBuku = $request->namaBuku;
        $offset  = $request->offset;
        try {
            if($token=='aaw237id1ot')
            {
                $result= [
                    'data' => $this->getAllItemBuku($namaBuku,$offset),
                    'count' => $this->getCount_($namaBuku),
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

    public function getAllItemBuku($namaBuku,$offset) {

        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            $result = [];
                $query = DB::table('ms_barang')            
                ->select('ms_barang.id as code', 'ms_barang.barcode as barcode', 'ms_barang.kategori as kategori', 'ms_barang.judul_buku as judul_buku', 'ms_barang.penerbit as penerbit', 'ms_barang.harga as harga', DB::raw('(ms_barang_stock.d-ms_barang_stock.k) as stock'))
                ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
                ->where('ms_barang_stock.code_gudang', '=','Gd_001')
                ->where('ms_barang.judul_buku', 'like','%'.$namaBuku.'%')
                ->limit(10)
                ->offset($offset)
                ->orderBy('ms_barang.judul_buku','asc');;
               
                $result=$query ->get();    
           
            return $result;  
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function getCount_($namaBuku) {
    
        try {
  
            $result = [];
                    $result = 
                             DB::table('ms_barang')
                             ->select(DB::raw('Count(ms_barang.id) as count'))
                             ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
                             ->where('ms_barang_stock.code_gudang', '=','Gd_001')
                              ->where('ms_barang.judul_buku','like','%'.$namaBuku.'%')   
                   
                            ->first();
   
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getDetailBuku(Request $request) {
        $token = $request->token;
        $code_barang = $request->code_barang;

        try {
            if($token=='3nke6gqp9l')
            {
                $query = DB::table('ms_barang')            
                ->select('ms_barang.id as code', 'ms_barang.barcode as barcode','ms_barang.berat as berat', 
                'ms_barang.kategori as kategori','ms_barang.status as status',  'ms_barang.judul_buku as judul_buku', 
                'ms_barang.penerbit as penerbit', 'ms_barang.harga as harga', 'ms_barang.halaman as halaman',
                'ms_barang.ukuran as ukuran','ms_barang.cover as cover','ms_barang.penulis as penulis',
                'ms_barang.isbn as isbn','ms_barang.tahun as tahun', DB::raw('(ms_barang_stock.d-ms_barang_stock.k) as stock'))
                ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')
                ->where('ms_barang.id', '=',$code_barang);
               
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


    public function addNewBuku(Request $request) {
        $token = $request->token;
        $code_barang = $request->code_barang ;
        $barcode = $request->barcode;
        $berat = $request->berat ;
        $kategori =$request->kategori;
        $status = $request->status;
        $judul_buku = $request->judul_buku;
        $penerbit =$request->penerbit;
        $harga = $request->harga;
        $halaman = $request->halaman;
        $ukuran = $request->ukuran;
        $cover = $request->cover;
        $penulis = $request->penulis;
        $isbn = $request->isbn;
        $tahun = $request->tahun;
        $stock = $request->stock;
        $k = 0;
        // $code_promo = $request->code_promo;

        try {
            if($token=='i2t8n6d054')
            {
                DB::beginTransaction();
                $barang = new mod_ms_barang();
                $barang->id = $code_barang;
                $barang->barcode = $barcode;
                $barang->berat = $berat;
                $barang->kategori = $kategori;
                $barang->status = $status;
                $barang->judul_buku = str_replace("charDan","&",$judul_buku);
                $barang->penerbit = $penerbit;
                $barang->harga = $harga;
                $barang->halaman = $halaman;
                $barang->ukuran = $ukuran;
                $barang->cover = $cover;
                $barang->penulis = $penulis;
                $barang->isbn = $isbn;
                $barang->tahun = $tahun;
                $barang->save();
                
                $barangStock = new mod_ms_barangStock();
                $barangStock->code_barang = $code_barang;
                $barangStock->d = $stock;
                $barangStock->k = $k;
                $barangStock->save();

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

    public function editBuku(Request $request) {
        $token = $request->token;
        $code_barang = $request->code_barang ;
        $barcode = $request->barcode ;
        $berat = $request->berat ;
        $kategori = $request->kategori ;
        $status = $request->status ;
        $judul_buku = $request->judul_buku ;
        $penerbit = $request->penerbit ;
        $harga = $request->harga ;
        $halaman = $request->halaman ;
        $ukuran = $request->ukuran ;
        $cover = $request->cover ;
        $penulis = $request->penulis ;
        $isbn = $request->isbn ;
        $tahun = $request->tahun ;
        // $code_promo = $request->code_promo;

        try {
            if($token=='ijt844d054')
            {
                DB::beginTransaction();
                DB::table('ms_barang')->where('id', '=', $code_barang)
                ->update([
                            'barcode' => $barcode,
                            'berat' => $berat,
                            'kategori' => $kategori,
                            'status' => $status,
                            'judul_buku' => str_replace("charDan","&",$judul_buku),
                            'penerbit' => $penerbit,
                            'harga' => $harga,
                            'halaman' => $halaman,
                            'ukuran' => $ukuran,
                            'cover' => $cover,
                            'penulis' => $penulis,
                            'isbn' => $isbn,
                            'tahun' => $tahun,
                        ]);
                        
                DB::commit();
                $result='success';
            }
            else
            {
                $result = 'Invalid Token';   
            }  
            return response()->json($code_barang); 
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function deleteBuku(Request $request) {
        $token = $request->token;
        $code_barang = $request->code_barang ;
        // $code_promo = $request->code_promo;

        try {
            if($token=='i138ned054')
            {
                DB::beginTransaction();

                DB::table('ms_barang')
                ->where('id', '=', $code_barang)->delete();
                
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

    public function getBukuStockOpdnameBulanan(Request $request) {
        $token = $request->token;
        $namaBuku = $request->namaBuku;
        $offset  = $request->offset;
        $code_gudang  = $request->code_gudang;
        try {
            if($token=='4f397id1ot')
            {
                $result= [
                    'data' => $this->getBukuStockOpname($namaBuku,$offset,$code_gudang),
                    'count' => $this->getCountStockOpname($namaBuku,$code_gudang),
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

    public function getBukuStockOpname($namaBuku,$offset, $code_gudang) {

        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            $result = [];
                $query = DB::table('stock_opnam')            
                ->select('stock_opnam.id as id', 'stock_opnam.code_barang as code_barang', 'ms_barang.kategori as kategori', 'ms_barang.judul_buku as judul_buku', 'ms_barang.penerbit as penerbit', 'ms_barang.harga as harga', 'stock_opnam.stock as stock', 'stock_opnam.pic as pic')
                ->join('ms_barang', 'stock_opnam.code_barang','=','ms_barang.id')
                ->where('ms_barang.judul_buku', 'like','%'. $namaBuku.'%')
                ->where('stock_opnam.code_gudang', '=',$code_gudang)
                ->limit(10)                
                ->offset($offset)
                ->orderBy('ms_barang.judul_buku','asc');
               
            //    ->groupBy('stock_opnam.code_barang')
            //    ->orderBy('stock_opnam.id','asc')
            //    ->limit(10);
                $result=$query ->get(); 
           
            return $result; 
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function getCountStockOpname($namaBuku, $code_gudang) {
    
        try {
  
            $result = [];
                    $result = DB::table('stock_opnam') 
                    ->select(DB::raw('Count(stock_opnam.id) as count'))
                    ->join('ms_barang', 'stock_opnam.code_barang','=','ms_barang.id')
                    ->where('ms_barang.judul_buku', 'like','%'.$namaBuku.'%') 
                    ->where('stock_opnam.code_gudang', '=',$code_gudang)  
                   
                    ->first();



                    //  $result=$query ->get(); 
                    //  $val_decode = json_decode($result);

                    //  foreach($val_decode as $val)
                    //  {
                    //     $count++;
                    //  };
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($result);
        }
    }

    // public function getAllBukuStockOpdnameBulanan($namaBuku,$offset) {

    //     if($offset){$offset=(int)$offset;}
    //     else{$offset=0;}
    //     try {

    //         $result = [];
    //             $query = DB::table('stock_opnam')            
    //             ->select(DB::raw('SUM(stock_opnam.stock) as stock'),DB::raw('(SELECT ms_barang.id as id from ms_barang where ms_barang.id = stock_opnam.code_barang) as id'),DB::raw('(SELECT ms_barang.judul_buku as judulBuku from ms_barang where ms_barang.id = stock_opnam.code_barang) as judulBuku'),DB::raw('(SELECT ms_barang.harga as harga from ms_barang where ms_barang.id = stock_opnam.code_barang) as harga'),DB::raw('(SELECT ms_barang.penerbit as penerbit from ms_barang where ms_barang.id = stock_opnam.code_barang) as penerbit'))
               
    //            ->groupBy('stock_opnam.code_barang')
    //            ->orderBy('stock_opnam.id','asc')
    //            ->limit(10);
    //             $result=$query ->get(); 
           
    //         return $result; 
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         return response()->json($ex);
    //     }
    // }
    public function getCountStock_($namaBuku) {
    
        try {
  
            $result = [];
                    $result = DB::table('stock_opnam') 
                    ->select(DB::raw('SUM(stock_opnam.stock) as stock'))
               
                    ->groupBy('stock_opnam.code_barang')
                    ->orderBy('stock_opnam.id','asc');
                     $result=$query ->get(); 
                     $val_decode = json_decode($result);

                     foreach($val_decode as $val)
                     {
                        $count++;
                     };
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($result);
        }
    }

    public function updatedBukuStockOpnameBulanan(Request $request) {
        $token = $request->token;
        $codeGudang = $request->codeGudang;
        $picInput = $request->pic;
        // $barang_list = $request->barang_list;
        // $code_promo = $request->code_promo;

        try {
            if($token=='ijt8ned033')
            {
                DB::beginTransaction();
                $stockOpnam = [];
                $stockOpnam =  DB::table('stock_opnam')
                ->select('stock_opnam.code_barang as codeBarang', DB::raw('SUM(stock_opnam.stock) as stock'))
                ->where('stock_opnam.code_gudang','=',$codeGudang)
                ->groupBy('stock_opnam.code_barang')
                ->orderBy('stock_opnam.id','asc')
                ->get();
                $val_decode = json_decode($stockOpnam);

                foreach($val_decode as $val)
                {
			
		    $ord = DB::table('orderdetail')
                	->select(DB::raw('sum(orderdetail.jumlah) as stockOutGoing'))
                    ->join('order', 'orderdetail.code_order','=','order.id')
                    ->join('transaksi', 'transaksi.code_order','=','order.id')
                	->where('orderdetail.code_barang','=',$val->codeBarang)
                    ->where('order.codeGudang','=',$codeGudang)
                    ->where('transaksi.code_status','<>',10)
                	->first();
                   $inv = DB::table('outstanding_orderdetail')
                	->select(DB::raw('sum(outstanding_orderdetail.jumlah) as stockInvoice'))
                	->join('outstanding_order', 'outstanding_orderdetail.code_order','=','outstanding_order.idOrder')
                	->where('outstanding_orderdetail.code_barang','=',$val->codeBarang)
                	->where('outstanding_order.codeGudang','=',$codeGudang )
                	->first();

                	$stockOutGoing = $ord->stockOutGoing;
                	$stockInvoice = $inv->stockInvoice;
                	$keluar = $stockOutGoing + $stockInvoice;
		
                $d1 = $val->stock;
                if($d1 == 0){
                    $dx = 0;
                }elseif($d1 == '0'){
                    $dx = 0;
                }else{
                    $dx = $d1 - $keluar;
                }
			    


                    $stockScan = $val->stock;
                    $barangScan = $val->codeBarang;

                    DB::table('ms_barang_stock')
                    ->where('code_barang','=',$barangScan)
                    ->where('code_gudang','=',$codeGudang)                
                    ->update([
                        'd' => $dx,
                        'k' => '0',
                    ]);

                    // $transaksi = new mod_stockOpnam_log();
                    // $transaksi->code_barang = $val->codeBarang;
                    // $transaksi->barcode = '-';
                    // $transaksi->qty = $val->stock;
                    // $transaksi->pic = $picLoop;
                    // $transaksi->code_gudang = $codeGudang;
                    // $transaksi->save();
                }

            
                $stockOpnamLog = [];
                $stockOpnamLog =  DB::table('stock_opnam')
                ->select('stock_opnam.code_barang as codeBarang','stock_opnam.pic as pic','stock_opnam.stock as stock')
                ->where('stock_opnam.code_gudang','=',$codeGudang)
                // ->groupBy('stock_opnam.code_barang')
                ->orderBy('stock_opnam.id','asc')
                ->get();
                $val_decode_log = json_decode($stockOpnamLog);

                foreach($val_decode_log as $val_log)
                {
                    $picLoop=$val_log->pic;
                    $stockScan = $val_log->stock;
                    $barangScan = $val_log->codeBarang;

                    $transaksi = new mod_stockOpnam_log();
                    $transaksi->code_barang = $barangScan;
                    $transaksi->barcode = '-';
                    $transaksi->qty = $stockScan;
                    $transaksi->pic = $picLoop;
                    $transaksi->code_gudang = $codeGudang;
                    $transaksi->save();
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
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function updatedBukuMasuk(Request $request) {
        $token = $request->token;
        $codeGudang = $request->codeGudang;
        $picInput = $request->pic;
        // $barang_list = $request->barang_list;
        // $code_promo = $request->code_promo;

        try {
            if($token=='ijt8n5d033')
            {
                DB::beginTransaction();
                $stockOpnam = [];
                $stockOpnam =  DB::table('stock_opnam')
                ->select('stock_opnam.code_barang as codeBarang','stock_opnam.pic as pic','stock_opnam.stock as stock')
                ->where('stock_opnam.code_gudang','=',$codeGudang)
                // ->groupBy('stock_opnam.code_barang')
                ->orderBy('stock_opnam.id','asc')
                ->get();
                $val_decode = json_decode($stockOpnam);

                foreach($val_decode as $val)
                {
                    $stockLoop=$val->stock;
                    $picLoop=$val->pic;
                    $queryStock = DB::table('ms_barang_stock')
                        ->select('d as d')
                        ->where('code_barang','=',$val->codeBarang)
                        ->where('code_gudang','=',$codeGudang)
                        ->first();
                        $stockDb = $queryStock->d;                        
                    
                    $stock_sekarang = ($stockDb +$stockLoop);

                    DB::table('ms_barang_stock')
                    ->where('code_barang','=',$val->codeBarang)
                    ->where('code_gudang','=',$codeGudang)                
                    ->update([
                        'd' => $stock_sekarang,
                       
                    ]);

                    $transaksi = new mod_stockOpnam_log();
                    $transaksi->code_barang = $val->codeBarang;
                    $transaksi->barcode = '-';
                    $transaksi->qty = $val->stock;
                    $transaksi->pic = $picLoop;
                    $transaksi->code_gudang = $codeGudang;
                    $transaksi->save();
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
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function deleteStockOpnameBukuId(Request $request) {
        $token = $request->token;
        $id = $request->id ;
        // $code_promo = $request->code_promo;

        try {
            if($token=='i138nrt054')
            {
                DB::beginTransaction();
                // stock_opnam.id as id
                DB::table('stock_opnam')
                ->where('id', '=', $id)->delete();
                
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

    public function returnBuku(Request $request) {
        $token = $request->token;
        $code_barang = $request->code_barang;
        $stock = $request->stock;
        // $code_promo = $request->code_promo;
        $username = $request->username;

        try {
            if($token=='ijt8ned066')
            {
                DB::beginTransaction();
                $returnBuku = new mod_return_buku();
                $returnBuku->code_barang = $code_barang;
                $returnBuku->jumlah_return = $stock;
                $returnBuku->pic = $username;
                $returnBuku->save();

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

    public function getDataPindahGudang(Request $request) {
        $token = $request->token;
        $namaGudang = $request->namaGudang;
        $offset  = $request->offset;
        try {
            if($token=='4f397id1ot')
            {
                $result= [
                    'data' => $this->getDataPG($namaGudang,$offset),
                    'count' => $this->getCountPG($namaGudang),
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

    public function getDataPG($namaGudang,$offset) {

        if($offset){$offset=(int)$offset;}
        else{$offset=0;}
        try {

            $result = [];
                $query = DB::table('transaksi_pg')            
                ->select('stock_opnam.id as id', 'stock_opnam.code_barang as code_barang', 'ms_barang.kategori as kategori', 'ms_barang.judul_buku as judul_buku', 'ms_barang.penerbit as penerbit', 'ms_barang.harga as harga', 'stock_opnam.stock as stock', 'stock_opnam.pic as pic')
                ->join('ms_barang', 'stock_opnam.code_barang','=','ms_barang.id')
                ->where('ms_barang.judul_buku', 'like','%'. $namaBuku.'%')
                ->limit(10)                
                ->offset($offset)
                ->orderBy('ms_barang.judul_buku','asc');
               
            //    ->groupBy('stock_opnam.code_barang')
            //    ->orderBy('stock_opnam.id','asc')
            //    ->limit(10);
                $result=$query ->get(); 
           
            return $result; 
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function getCountPG($namaGudang) {
    
        try {
  
            $result = [];
                    $result = DB::table('stock_opnam') 
                    ->select(DB::raw('Count(stock_opnam.id) as count'))
                    ->join('ms_barang', 'stock_opnam.code_barang','=','ms_barang.id')
                    ->where('ms_barang.judul_buku', 'like','%'.$namaBuku.'%')   
                   
                    ->first();



                    //  $result=$query ->get(); 
                    //  $val_decode = json_decode($result);

                    //  foreach($val_decode as $val)
                    //  {
                    //     $count++;
                    //  };
                    return $result; 
        } catch (\Exception $ex) {
            return response()->json($result);
        }
    }

    //////////////

    public function selectExport(Request $request) {
        $token = $request->token;
        $codeGudang =$request->codeGudang;
        $kodeOrderDetail = $request->kodeOrderDetail;
        $offset = $request->offset;
        $type=$request->type;
        try {
            if($token=='2nkeygqp9l')
            {
                $result= [    
                'data' => $this->getOrderExport($codeGudang,$offset,$kodeOrderDetail,$type),
                'count' => $this->getCountExport($codeGudang,$offset,$kodeOrderDetail,$type),
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
    public function getOrderExport($codeGudang,$offset,$kodeOrderDetail,$type)
    {
        try{
            $result = [];
                if($offset){$offset=(int)$offset;}
                else{$offset=0;}
                    $query = 
                        DB::table('order')
                        ->select('transaksi.id as id', 'order.id as codeOrder','ms_customer.nama as nama',  'order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','transaksi.typeTransaksi as typeTransaksi', 'ms_status_trx.status as status','transaksi.export as export','transaksi.created_at as tanggal', 'transaksi.updated_at as tanggalUpdated')
                        ->join('ms_customer','ms_customer.id','=','order.code_customer')
                        ->join('transaksi','transaksi.code_order','=','order.id')
                        ->join('ms_status_trx','ms_status_trx.id','=','transaksi.code_status')
                        ->where('transaksi.approve_sales','=','1')
                        ->where('transaksi.approve_keuangan','=','1')
                        //->where('transaksi.approve_sales2','=','1')
                        //->where('transaksi.approve_gudang','=','1')
                        //->where('transaksi.code_status','=','10')
                        ->where('order.codeGudang','=',$codeGudang)
                        //->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                        ->orderBy('transaksi.created_at', 'DESC')
                        ->limit(10)
                        ->offset($offset);

                    if(@$kodeOrderDetail){
                        $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                    }
                    if($type=="nonLunas")
                    {
                        $query->where('order.lunas','=','2');
                    }
                    else 
                    {
                        $query->where('order.lunas','=','1');
                    }
                                      

                    $result=$query ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    
    public function getCountExport($codeGudang,$offset,$kodeOrderDetail,$type)
    {
        try{
            if($offset){$offset=(int)$offset;}
        else{$offset=0;}
   
            $query = 
            DB::table('transaksi')
                ->select(DB::raw('count(transaksi.id) as count'))
                ->join('order','order.id','=','transaksi.code_order')
                ->where('transaksi.approve_sales','=','1')
                ->where('transaksi.approve_keuangan','=','1')
                //->where('transaksi.approve_sales2','=','1')
                //->where('transaksi.approve_gudang','=','1')
                //->where('transaksi.code_status','=','10')
                ->where('order.codeGudang','=',$codeGudang)
                //  ->groupBy('transaksi.code_perusahaan')
                ->limit(10);
          
    

                if($kodeOrderDetail){
                    $query->where('transaksi.code_order', 'like','%'.$kodeOrderDetail.'%');
                }
                if($type=="nonLunas")
                {
                    $query->where('order.lunas','=','2');
                }
                else 
                {
                    $query->where('order.lunas','=','1');
                }
                              
           
            $result=$query ->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    /////////////////

    public function detailExport(Request $request) {
        $token = $request->token;
        $valOrder = $request->kodeOrderDetail;
        $val_decode = json_decode($valOrder);
        try {
            if($token=='6lscxf2ypx')
            {
                foreach ($val_decode as $y => $val)
                {
                   
                    $codeBarang = $y;
                	$result []= ['data'=> $this->getDetailExport($codeBarang)];

               		DB::beginTransaction();
             		DB::table('transaksi')
                    	   ->where('code_order','=',$codeBarang)                
                    	    ->update([
                        	'export' => 2                       
                    	   ]);

            		DB::commit();
                }
              
            }
            else
            {
                $result = 'Invalid Token';   
            }    
            return response()->json($result);   
        } catch (\Exception $ex) {
            return response()->json($val_decode);
        }
    }

    public function getDetailExport($code_order) {
        try {
                $result= [
                    'orderDetail' => $this->getOrderDetailExport($code_order),
                    'itemOrder' => $this->getItemOrderExport($code_order),
                ];
            
           
           return $result;  
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getOrderDetailExport($idOrder)
    {
        try{
        return     DB::table('order')
        ->select(DB::raw("(SELECT nama FROM ms_admin WHERE ms_admin.kodeAdminTrx = transaksi.kodeAdminTrx) as namaSales"),
        'order.id as code_order','order.nama_pengirim as namaPengirim','order.telephone_pengirim as nomorPengirim','order.nama_penerima as namaPenerima','order.telephone_penerima as telephonePenerima','order.alamat as alamat','order.total_harga as total_harga','order.totalDiskon as diskonTotal','transaksi.typeTransaksi as typeTransaksi',
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

    public function getItemOrderExport($idOrder)
    {
        try{

            
        return 
        DB::table('orderdetail')
                ->select(DB::raw('(SELECT SUM(berat) as totalBerat FROM ms_barang JOIN orderdetail A ON A.code_barang = ms_barang.id WHERE A.code_order = "'.$idOrder.'" AND A.code_promo = orderdetail.code_promo)as totalBerat'),
                'orderdetail.id as  id','orderdetail.code_order as code_order','ms_barang.id as code_barang','ms_barang.judul_buku as judul_buku','orderdetail.jumlah as jumlah','ms_barang.berat as berat','orderdetail.diskon as diskon','orderdetail.harga as harga','orderdetail.code_promo as code_promo','orderdetail.nama_promo as nama_promo','orderdetail.harga_promo as harga_promo')
                ->join('ms_barang','ms_barang.id','=','orderdetail.code_barang')
                ->where('orderdetail.code_order', '=', $idOrder)
              
                ->get(); 

        // DB::table('orderdetail')
        // ->select('orderdetail.code_order as codeOrder','orderdetail.code_barang as kodeBarang','ms_barang.judul_buku as judulBuku','orderdetail.jumlah as qty','orderdetail.harga as harga','orderdetail.diskon as diskon','orderdetail.code_promo as code_promo','orderdetail.nama_promo as nama_promo','orderdetail.harga_promo as harga_promo',DB::raw('(orderdetail.jumlah) * (orderdetail.harga) as subTotal'))
        // ->join('ms_barang','ms_barang.id','=','orderdetail.code_barang')
        // ->where('orderdetail.code_order','=',$idOrder)
        // ->get();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function updateStatusExport($codeOrder,$token)
    {
	$token = $request->token;
	$codeOrder= $request->codeOrder;
        try{
		if ($token == '123456'){
			DB::beginTransaction();
             		DB::table('transaksi')
                    	->where('code_order','=',$codeOrder)                
                    	->update([
                        	'export' => 2                       
                    	]);

            		DB::commit();
            		$result='success';
		}else{		
		 $result = 'Invalid Token';   
            	}  
            return response()->json($result); 
        }catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }        

    }


    public function getStockBuku(Request $request)
    {
	$pic= $request->kodeAdmin;
	$token = $request->token;
        try{            
            if($token=='6lscxf2ypx')
            {
		if(substr($pic,0,3)=='JKT'){$codeGudang='Gd_002';}
		if(substr($pic,0,3)!='JKT'){$codeGudang='Gd_001';}
               $result= DB::table('ms_barang')
                ->select('ms_barang.id', 'ms_barang.judul_buku', 'ms_barang.harga', DB::raw('(ms_barang_stock.d - ms_barang_stock.k)as stock'), 'ms_barang.created_at')
                ->join('ms_barang_stock','ms_barang.id','=','ms_barang_stock.code_barang')
                ->where('ms_barang_stock.code_gudang', '=', $codeGudang)              
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
