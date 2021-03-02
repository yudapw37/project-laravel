<?php

namespace App\Http\Controllers;
use App\mod_md_bestSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class c_md_bestSeller extends Controller
{
    public function index() {
        return view('dashboard.master-data.best-seller.baru');
    }

    public function list() {
        return view('dashboard.master-data.best-seller.list');
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
        $filters = $request->filters;
        // $data = [
        //     'where' => []
        // ];
        // if ($filters !== null) {
        //     foreach ($filters as $f) {
        //         $data['where'][] = [
        //             $f['field'],$f['type'],'%'.$f['value'].'%'
        //         ];
        //     }
        // }

        $query = DB::table('ms_flashsale')
        ->select('ms_flashsale.id as id','ms_flashsale.id_buku as id_buku','ms_barang.judul_buku as judul_buku','ms_flashsale.tgl_exp as tgl_exp','ms_flashsale.harga_jadi as harga_jadi')
        ->join('ms_barang','ms_barang.id','=','ms_flashsale.id_buku');
        if(@$filters){
            $query->where('ms_flashsale.id_buku','LIKE','%'.$filters.'%');
        }
       
        return $query->paginate(10);

           
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kodeBuku = $request->id;
        $tglExp = $request->tanggalExp;
       
        $hargaJadi = $request->hargaJadi;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                        $transaksi = new mod_md_flashSale();
                        $transaksi->id_buku = $kodeBuku;
                        $transaksi->tgl_exp =  date('Y-m-d',strtotime($tglExp));
                        $transaksi->harga_jadi = $hargaJadi;
                        $transaksi->save();
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
            DB::table('ms_flashsale')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}

