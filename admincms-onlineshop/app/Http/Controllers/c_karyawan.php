<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_karyawan;
use Illuminate\Support\Facades\DB;

class c_karyawan extends Controller
{
    public function index() {
        return view('dashboard.master-data.guru-karyawan.baru');
    }

    public function list() {
        return view('dashboard.master-data.guru-karyawan.list');
    }

    public function edit($username) {
        $data = DB::table('users')->where('username','=',$username)->first();
        $dtCheck = DB::table('sys_permission')->select('id_menu')->where('username','=',$username)->get();
        $check = [];
        foreach ($dtCheck as $c) {
            $check[] = $c->id_menu;
        }
        return view('dashboard.master-data.user-management.edit')->with('data',$data)->with('check',$check);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $data = [
            'where' => []
        ];
        if ($filters !== null) {
            foreach ($filters as $f) {
                $data['where'][] = [
                    $f['field'],$f['type'],'%'.$f['value'].'%'
                ];
            }
        }
        return DB::table('tbl_karyawan')
        ->select('ms_admin.id as id','ms_admin.username as username','ms_admin.isDell as status','nama','ms_jabatan.jabatan as jabatan','ms_admin.kodeAdminTrx as kodeAdminTrx')
        ->join('ms_jabatan','ms_jabatan.id','=','ms_admin.code_jabatan')
   
        ->where($data['where'])
        ->paginate(20);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $instansi = $request->bidang;
        $nama = $request->nama;
        $jabatan = $request->jabatan;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                if($instansi =='0')
                {
                    $bid = "KB/RA";
                }
                else if($instansi =="1")
                {
                    $bid = "SD";
                }
                else if($instansi =="2")
                {
                    $bid = "MTS";
                }
                        $transaksi = new mod_karyawan();
                        $transaksi->instansi = $bid;
                        $transaksi->nama = $nama;
                        $transaksi->jabatan = $jabatan;
                        $transaksi->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
               
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

    public function resetPassword(Request $request) {
        $username = $request->username;
        try {
            DB::beginTransaction();
            DB::table('users')->where('username','=',$username)
                ->update([
                    'password' => Crypt::encryptString($username)
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function disable(Request $request) {
        $username = $request->username;
        try {
            DB::beginTransaction();
            DB::table('users')->where('username','=',$username)
                ->update([
                    'status' => 0
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function activate(Request $request) {
        $username = $request->username;
        try {
            DB::beginTransaction();
            DB::table('users')->where('username','=',$username)
                ->update([
                    'status' => 1
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}
