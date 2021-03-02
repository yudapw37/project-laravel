<?php

namespace App\Http\Controllers;
use App\mod_ms_top_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_md_newProduct extends Controller
{
    public function index() {
        return view('dashboard.master-data.new-product.baru');
    }

    public function list() {
        return view('dashboard.master-data.new-product.list');
    }

    public function edit($id) {
        $data = DB::table('ms_flashsale')
        ->select('ms_flashsale.id as id','ms_flashsale.id_buku as id_buku','ms_barang.judul_buku as judul_buku','ms_flashsale.tgl_exp as tgl_exp','ms_flashsale.harga_jadi as harga_jadi')
        ->join('ms_barang','ms_barang.id','=','ms_flashsale.id_buku')
        ->where('ms_flashsale.id',$id)
        ->first();
       
        return view('dashboard.master-data.flash-sale.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $data['data'] =  DB::table('ms_top_produk')
        ->where('kategori','=','new')->get();
        return json_encode($data);

           
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kategori = $request->kategori;
        $idBuku = $request->idBuku;

        try {
            DB::beginTransaction();

            if ($type == 'baru') {
              $datatop = mod_ms_top_produk::where('id_buku','=',$idBuku)->where('kategori','=',$kategori)->first();
              if($datatop) {$result = 'Buku Sudah Ada Di kategori ini';}
              else{
                $hargaJadi = 0;
                $transaksi = new mod_ms_top_produk();
                $transaksi->id_buku = $idBuku;
                $transaksi->kategori =  $kategori;

                $data = DB::table('ms_barang')->where('id','=',$idBuku)->first();
                $datapromo = DB::table('ms_barang_promo')
                            ->select('ms_promo.code_promo as code_promo','ms_promo.harga_jadi as harga_jadi')
                            ->join('ms_promo','ms_promo.code_promo','=','ms_barang_promo.code_promo')
                            ->where('ms_barang_promo.code_barang','=',$idBuku)
                            ->where('ms_promo.is_del','=',0)
                            ->orderBy('ms_promo.created_at','asc')
                            ->get();
                    if($datapromo){
                        foreach($datapromo as $valprm){
                            $getdatapromo = DB::table('ms_barang_promo')
                                     ->where('ms_barang_promo.code_promo','=',$valprm->code_promo)
                                     ->get();
                            if(count($getdatapromo) < 2){
                                $hargaJadi = $valprm->harga_jadi;
                            }
                        }
                    }
                    
                $transaksi->judul_buku = $data->judul_buku;
                $transaksi->harga_buku = $data->harga;
                $transaksi->harga_jadi = $hargaJadi;
                $transaksi->gambar_buku = $data->gambar_buku;
                $transaksi->save();
                $result = 'success';
              } 
                
            } elseif ($type == 'edit') {
         
                // DB::table('tbl_instansi_fasilitas')->where('id','=',$request->id)
                //     ->update([
                //        'fasilitas' => $fasilitas
                //     ]);
        
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_top_produk')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}

