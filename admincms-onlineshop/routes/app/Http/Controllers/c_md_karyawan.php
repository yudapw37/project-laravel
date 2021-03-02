<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class c_md_karyawan extends Controller
{
    public function index() {
        return view('dashboard.master-data.karyawan.baru');
    }

    public function list() {
        return view('dashboard.master-data.karyawan.list');
    }

    public function edit($id) {
        $data = DB::table('tbl_instansi_fasilitas')
        ->select('id','fasilitas')
        ->where('id',$id)
        ->first();
       
        return view('dashboard.instansi.mts.fasilitas.edit')->with('data',$data);
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

        $query = DB::table('ms_admin')
        ->select('id','nama','kodeAdminTrx');
        

        if(@$filters){
            $query->where('ms_admin.nama','LIKE','%'.$filters.'%');
        }
       
        return $query->paginate(10);

           
    }

    public function submit(Request $request) {
        $type = $request->type;
        $fasilitas = $request->fasilitas;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                        $transaksi = new mod_instansi_fasilitas();
                        $transaksi->id_instansi = '2';
                        $transaksi->fasilitas = $fasilitas;
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
            DB::table('tbl_instansi_fasilitas')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}

