<?php



namespace App\Http\Controllers;



use App\mod_stockOpnam;

use App\mod_stockOpnam_log;

use http\Env\Response;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;



class c_Android_SO extends Controller

{

    public function getItemBarang(Request $request) {

        $barcode = $request->barcode;

        $judulBuku = $request->judulBuku;

        try{



            $query =

                DB::table('ms_barang')

                ->select('ms_barang.id as id','ms_barang.barcode as barcode','ms_barang.judul_buku as judulBuku','ms_barang.kategori as kategori')

                ->orderBy('ms_barang.judul_buku','asc');

                if(@$barcode){

                    $query->where('ms_barang.barcode','=',$barcode);

                }



                if(@$judulBuku){



                    $query->where('ms_barang.judul_buku', 'like', '%'.$judulBuku.'%');



                }





            $result=$query ->get();

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function getDetailListSO(Request $request) {

        $pic = $request->pic;

        $code_buku = $request->code_buku;

        try{



            $codeGudang = DB::table('ms_admin')

            ->select('ms_admin.kodeAdminTrx as kodeAdminTrx')

            ->where('ms_admin.username','=',$pic)

            ->first();

            $kode = $codeGudang->kodeAdminTrx;

            if('JKT' ==substr($kode,0,3))

            {

                $kode_Gudang = 'Gd_002';

            }

            else

            {

                $kode_Gudang = 'Gd_001';

            }



            $query = DB::table('stock_opnam')

            ->select('stock_opnam.id as id','stock_opnam.code_barang as codeBarang','ms_barang.judul_buku as judul','stock_opnam.pic as pic','stock_opnam.code_gudang as codeGudang','stock_opnam.stock as stock')

           ->join('ms_barang','ms_barang.id','=','stock_opnam.code_barang')

            ->where('stock_opnam.code_gudang','=',$kode_Gudang)

            ->orderBy('stock_opnam.id','asc')

            ->where('stock_opnam.code_barang','=',$code_buku);



            $result=$query ->get();

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($request);

        }

    }



    public function inputStockOpnam(Request $request) {

        $codeBarang = $request->codeBarang;

        $barcode = '-';

        $stock = $request->stock;

        $pic = $request->pic;



        try{



            DB::beginTransaction();

            $codeGudang = DB::table('ms_admin')

            ->select('ms_admin.kodeAdminTrx as kodeAdminTrx')

            ->where('ms_admin.username','=',$pic)

            ->first();



            $transaksi = new mod_stockOpnam();

            $transaksi->code_barang = $codeBarang;

            $transaksi->code_barcode = '-';

            $transaksi->stock = $stock;

            $transaksi->pic = $pic;

            $kode = $codeGudang->kodeAdminTrx;

            if('JKT' ==substr($kode,0,3))

            {

                $transaksi->code_gudang = 'Gd_002';

            }

            else

            {

                $transaksi->code_gudang = 'Gd_001';

            }



            $transaksi->save();





            DB::commit();

            $result = [

                'status' => 'success',

            ];

            return response()->json($result);

        } catch (\Exception $ex) {

            DB::rollBack();

            return response()->json($ex);

        }

    }



    public function syncroniseSOInsert(Request $request) {

        try{



            DB::beginTransaction();

            $stockOpnam = [];

            $stockOpnam =  DB::table('stock_opnam')

            ->select('stock_opnam.code_barang as codeBarang','stock_opnam.pic as pic','stock_opnam.code_gudang as codeGudang','stock_opnam.stock as stock')



            ->orderBy('stock_opnam.id','asc')

            ->get();

            $val_decode = json_decode($stockOpnam);







            foreach($val_decode as $val)

            {

                $k = DB::table('ms_barang_stock')

                ->select('d as stock')

                ->where('code_barang','=',$val->codeBarang)

                ->where('code_gudang','=',$val->codeGudang)

                ->first();

                $stock_sekarang = ($k->stock +$val->stock);





                DB::table('ms_barang_stock')

                ->where('code_barang','=',$val->codeBarang)

                ->where('code_gudang','=',$val->codeGudang)

                ->update([

                    'd' => $stock_sekarang


                ]);



                $transaksi = new mod_stockOpnam_log();

                $transaksi->code_barang = $val->codeBarang;

                $transaksi->barcode = '-';

                $transaksi->qty = $val->stock;

                $transaksi->pic = $val->pic;

                $transaksi->code_gudang = $val->codeGudang;

                $transaksi->save();



            }

            DB::commit();

        $result="success";







             return response()->json($result);

        } catch (\Exception $ex) {



            DB::rollBack();



            return response()->json($stock_sekarang);

        }

    }



    public function syncroniseSO(Request $request) {

        // $pic = $request->pic;



        try{



            DB::beginTransaction();

            $stockOpnam = [];

            $stockOpnam =  DB::table('stock_opnam')

            ->select('stock_opnam.code_barang as codeBarang','stock_opnam.pic as pic','stock_opnam.code_gudang as codeGudang',DB::raw('SUM(stock_opnam.stock) as stock'))

            ->groupBy('stock_opnam.code_barang')

            ->orderBy('stock_opnam.id','asc')

            ->get();

            $val_decode = json_decode($stockOpnam);



            foreach($val_decode as $val)

            {
                //      SELECT  sum(outstanding_orderdetail.jumlah) as stockInvoice
                //     FROM outstanding_orderdetail join outstanding_order on outstanding_orderdetail.code_order=outstanding_order.idOrder
                //     where outstanding_orderdetail.code_barang = ms_barang.id and outstanding_order.codeGudang = "'.$kode_Gudang.'"
                //     GROUP BY outstanding_orderdetail.code_barang
                //      SELECT  sum(orderdetail.jumlah) as stockOutGoing
                //     FROM orderdetail join `order`o on o.id=orderdetail.code_order
                //     where orderdetail.code_barang = ms_barang.id and o.codeGudang = "'.$kode_Gudang.'"
                //     GROUP BY orderdetail.code_barang
                $ord = DB::table('orderdetail')
                ->select(DB::raw('sum(orderdetail.jumlah) as stockOutGoing'))
                ->join('order', 'orderdetail.code_order','=','order.id')
                ->where('orderdetail.code_barang','=',$val->codeBarang)
                ->where('order.code_gudang','=',$val->codeGudang)
                ->first();
                $inv = DB::table('outstanding_orderdetail')
                ->select(DB::raw('sum(outstanding_orderdetail.jumlah) as stockInvoice'))
                ->join('outstanding_order', 'outstanding_orderdetail.code_order','=','outstanding_order.idOrder')
                ->where('outstanding_orderdetail.code_barang','=',$val->codeBarang)
                ->where('outstanding_order.code_gudang','=',$val->codeGudang)
                ->first();

                $stockOutGoing = $ord->stockOutGoing;
                $stockInvoice = $inv->stockInvoice;
                $keluar = $stockOutGoing + $stockInvoice;
		
		$d1 = $val->stock;
		$dx = $d1 - $keluar;

                DB::table('ms_barang_stock')
                ->where('code_barang','=',$val->codeBarang)
                ->where('code_gudang','=',$val->codeGudang)
                ->update([
                    'd' => $dx,
                    'k' => 0,

                ]);

                $transaksi = new mod_stockOpnam_log();
                $transaksi->code_barang = $val->codeBarang;
               // $transaksi->barcode = $barcode;
                $transaksi->qty = $val->stock;
                $transaksi->pic = $val->pic;
                $transaksi->code_gudang = $val->codeGudang;
                $transaksi->save();

            }



            DB::commit();



            return   $result='success';



            // return response()->json($stockOpnam);

        } catch (\Exception $ex) {



            DB::rollBack();



            return response()->json($ex);

        }

    }



    public function getlistStockOpnamBarang(Request $request) {

        $judulBuku = $request->judulBuku;

        // $pic = $request->pic;

        $kode_Gudang = $request->kode_gudang;

        try{
        
	$dataval = [];
        $a=array();
	
		$barang = DB::table('ms_barang')
			 ->get();
                
		foreach ($barang as $br){
			$SL = DB::table('ms_barang_stock')
			       ->where('ms_barang_stock.code_barang', '=', $br->id)
			        ->where('ms_barang_stock.code_gudang', '=', $kode_Gudang)
			       ->first();
			$stockLama = $SL->d - $SL->k;

			$SOG = DB::table('orderdetail')
			       ->join('order', 'order.id', '=', 'orderdetail.code_order')
			       ->join('transaksi', 'order.id', '=', 'transaksi.code_order')
			       ->where('order.codeGudang', '=', $kode_Gudang)
			       ->where('transaksi.code_status', '<>', 10)
		  	       ->where('orderdetail.code_barang', '=', $br->id)
			       ->sum('orderdetail.jumlah');
			
			$SINV = DB::table('outstanding_orderdetail')
			       ->join('outstanding_order', 'outstanding_order.idOrder', '=', 'outstanding_orderdetail.code_order')
			       ->where('outstanding_order.codeGudang', '=', $kode_Gudang)
		  	       ->where('outstanding_orderdetail.code_barang', '=', $br->id)
			       ->sum('outstanding_orderdetail.jumlah');

			$SB = DB::table('stock_opnam')
			       ->where('stock_opnam.code_barang', '=', $br->id)
			       ->where('stock_opnam.code_gudang', '=', $kode_Gudang)
			       ->sum('stock_opnam.stock');
	
			$dataval = ['id'=>$br->id, 'judulBuku'=>$br->judul_buku,'stockLama' => $stockLama,'stockOutGoing' => $SOG,'stockInvoice' => $SINV, 'stockBaru' => $SB];
                    	array_push($a, $dataval);
		}

	     $result=$a;

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function getlistStockOpnamBarangModal(Request $request) {

        $kode_Gudang = $request->kode_gudang;

        try{

            $query = DB::table('ms_barang')

                ->select('ms_barang.id as id', 'ms_barang.judul_buku as judulBuku',

                    DB::raw('(ms_barang_stock.d - ms_barang_stock.k) as stockLama'),

                    DB::raw('(SELECT  sum(orderdetail.jumlah) as stockOutGoing

                        FROM orderdetail join `order`o on o.id=orderdetail.code_order

                        where orderdetail.code_barang = ms_barang.id and o.codeGudang = "'.$kode_Gudang.'"

                        GROUP BY orderdetail.code_barang) as stockOutGoing'),

                    DB::raw('(SELECT  sum(outstanding_orderdetail.jumlah) as stockInvoice

                        FROM outstanding_orderdetail join outstanding_order on outstanding_orderdetail.code_order=outstanding_order.idOrder

                        where outstanding_orderdetail.code_barang = ms_barang.id and outstanding_order.codeGudang = "'.$kode_Gudang.'"

                        GROUP BY outstanding_orderdetail.code_barang) as stockInvoice'),

                    DB::raw('(SELECT  sum(stock_opnam.stock) as stockBaru

                        FROM stock_opnam where stock_opnam.code_barang = ms_barang.id and stock_opnam.code_gudang = "'.$kode_Gudang.'"

                        GROUP BY stock_opnam.code_barang) as stockBaru'))

                ->leftjoin('stock_opnam', 'stock_opnam.code_barang','=','ms_barang.id')

                ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')

                ->orderBy('ms_barang.judul_buku','asc')

                ->limit(10)

                ->where('ms_barang_stock.code_gudang','=',$kode_Gudang)

                ->distinct();



            $result=$query ->get();

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function getlistStockOpnamAndroid(Request $request) {

        $judulBuku = $request->judulBuku;

        $pic = $request->pic;



        try{

            $codeGudang = DB::table('ms_admin')

            ->select('ms_admin.kodeAdminTrx as kodeAdminTrx')

            ->where('ms_admin.username','=',$pic)

            ->first();

            $kode = $codeGudang->kodeAdminTrx;

            if('JKT' ==substr($kode,0,3))

            {

                $kode_Gudang = 'Gd_002';

            }

            else

            {

                $kode_Gudang = 'Gd_001';

            }



            $query = DB::table('ms_barang')

            ->select('ms_barang.id as id', 'ms_barang.judul_buku as judulBuku',

                DB::raw('(ms_barang_stock.d - ms_barang_stock.k) as stockLama'),

                DB::raw('(SELECT  sum(orderdetail.jumlah) as stockOutGoing

                    FROM orderdetail join `order`o on o.id=orderdetail.code_order

                    where orderdetail.code_barang = ms_barang.id and o.codeGudang = "'.$kode_Gudang.'"

                    GROUP BY orderdetail.code_barang) as stockOutGoing'),

                DB::raw('(SELECT  sum(outstanding_orderdetail.jumlah) as stockInvoice

                    FROM outstanding_orderdetail join outstanding_order on outstanding_orderdetail.code_order=outstanding_order.idOrder

                    where outstanding_orderdetail.code_barang = ms_barang.id and outstanding_order.codeGudang = "'.$kode_Gudang.'"

                    GROUP BY outstanding_orderdetail.code_barang) as stockInvoice'),

                DB::raw('(SELECT  sum(stock_opnam.stock) as stockBaru

                    FROM stock_opnam where stock_opnam.code_barang = ms_barang.id and stock_opnam.code_gudang = "'.$kode_Gudang.'"

                    GROUP BY stock_opnam.code_barang) as stockBaru'))

            ->leftjoin('stock_opnam', 'stock_opnam.code_barang','=','ms_barang.id')

            ->join('ms_barang_stock', 'ms_barang_stock.code_barang','=','ms_barang.id')

            ->orderBy('ms_barang.judul_buku','asc')

            ->where('ms_barang_stock.code_gudang','=',$kode_Gudang)

            ->limit(1)

            ->distinct();



            if($judulBuku){

                $query->where('ms_barang.judul_buku', 'like', '%'.$judulBuku.'%');

            }



            $result=$query ->get();

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function getListInputSO(Request $request)

    {

        $codeBarang = $request->codeBarang;

        try{



            $query =

            $query = DB::table('stock_opnam')

            ->select(DB::raw('(SELECT ms_barang.id as id from ms_barang where ms_barang.id = stock_opnam.code_barang) as id'),DB::raw('SUM(stock_opnam.stock) as stockBaru'))



           ->groupBy('stock_opnam.code_barang')

           ->orderBy('stock_opnam.id','asc')

           ->where('stock_opnam.code_barang','=',$codeBarang);

            $result=$query ->get();

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }





    public function deleteInputSO(Request $request)

    {

        $id = $request->id;

        try{

            DB::beginTransaction();

            DB::table('stock_opnam')

            ->where('id','=',$id)->delete();



            DB::commit();

            $result = [

                'status' => 'success',

            ];

            return response()->json($result);

        } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }



    public function deleteSO(Request $request)

    {

      $codeGudang = $request->codeGudang;

        try{



            DB::beginTransaction();

            DB::table('stock_opnam')

            ->where('code_gudang','=', $codeGudang)

            ->delete();



            DB::commit();

            $result = [

                'status' => 'success',

            ];

            return response()->json($result);

     } catch (\Exception $ex) {

            return response()->json($ex);

        }

    }

}

