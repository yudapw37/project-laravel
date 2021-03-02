<?php

namespace App\Http\Controllers;

use App\mod_md_flashSale;
use App\mod__ms_barang_promo;
use App\ms_promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_md_buku extends Controller
{
    public function index() {
        return view('dashboard.master-data.buku.baru');
    }

    public function list() {
        return view('dashboard.master-data.buku.list');
    }

    public function edit($id) {
        $data = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();      
        return view('dashboard.master-data.buku.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_barang')
        ->orderBy('ms_barang.judul_buku','ASC');
        if(@$filters){
            $query->where('ms_barang.judul_buku','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kodeBuku = $request->id;
        $stockTerjual = $request->stockTerjual;
        $tglExp = $request->tanggalExp;
        $hargaJadi = $request->hargaJadi;
        $hargaBuku = $request->hargaBuku;
     
        $gambar = $request->foto;
        $foto = ($request->foto !== '') ? $request->file('foto') : '';
        try {
            DB::beginTransaction();

            $filename = null;

            if ($type == 'baru') {    
                $data = DB::table('ms_barang')
                ->where('id','=',$kodeBuku)
                ->first();
                        $transaksi = new mod_md_flashSale();
                        $transaksi->id_buku = $kodeBuku;
                        $transaksi->judul_buku = $data->judul_buku;
                        $transaksi->harga_buku = $hargaBuku;
                        $transaksi->stock = '0';
                        $transaksi->terjual = $stockTerjual;
                        $transaksi->gambar_buku = '-';
                        $transaksi->tgl_exp =  date('Y-m-d',strtotime($tglExp));
                        $transaksi->harga_jadi = $hargaJadi;
                        $transaksi->save();

                        $ldate = date('Y');
                        $ldate1 = date('m');
                        $ldate2 = date('d');
                        $ldate3 = date('h');
                        $ldate4 = date('i');
                        $ldate5 = date('s');
                        $tahun = substr($ldate,2);
                        $count = DB::table('ms_promo')
                        ->select(DB::raw('COUNT(ms_promo.code_promo) as count'))
                        ->first();
                        $c = $count->count;
                        $kode = 'promo_' .$tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);
                        
                        $x = new mod__ms_barang_promo();
                        $x->code_promo = $kode;
                        $x->code_barang = $kodeBuku;
                        $x->save();

                        $c = new ms_promo();
                        $c->code_promo = $kode;
                        $c->nama_promo = 'FLASH SALE';
                        $c->harga_jadi = $hargaJadi;
                        $c->berat_total = $data->berat;
                        $c->save();
                        
                    $result = 'success';

            } elseif ($type == 'edit') {
         
                DB::table('tbl_instansi_fasilitas')->where('id','=',$request->id)
                    ->update([
                       'fasilitas' => $fasilitas
                    ]);
        
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
            DB::table('ms_barang')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}


