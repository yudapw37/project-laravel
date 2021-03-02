<?php

namespace App\Http\Controllers;

use App\mod_ms_admin;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;
class c_superUser extends Controller
{
    public function getSemuaUser() {
     try {
         $result = [];
                 $result = 
                          DB::table('ms_admin')
                          ->select('ms_admin.username as username','ms_admin.nama as nama','ms_jabatan.jabatan as jabatan','ms_admin.kodeAdminTrx as kodeAdmin')
                          ->join('ms_jabatan','ms_jabatan.id_jabatan','=','ms_admin.code_jabatan')
                          ->get();    
         return response()->json($result);
     } catch (\Exception $ex) {
         return response()->json($ex);
     }
    }

    public function viewEdit(Request $request) {
      $username = $request->username;
        try {
            $result = [];
                    $result = 
                             DB::table('ms_admin')
                             ->select('ms_admin.username as username','ms_admin.nama as nama','ms_jabatan.jabatan as jabatan','ms_admin.kodeAdminTrx as kodeAdmin')
                             ->join('ms_jabatan','ms_jabatan.id_jabatan','=','ms_admin.code_jabatan')
                             ->where('ms_admin.username','=',$username)
                             ->get();
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
      
    }

    public function edit(Request $request) {
        $nama = $request->nama;
        $codeJabatan = $request->codeJabatan;
        $username = $request->username;
        try {
            DB::beginTransaction();
            DB::table('ms_admin')->where('username','=',$username)
                ->update([
                    'nama' => $nama,
                    'code_jabatan' => $codeJabatan,
                ]);
                $result = 'success';
                DB::commit();
                return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }


    public function submit(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $nama = $request->nama;
        $code_jabatan = $request->code_jabatan;
        $kodeAdmin = $request->kodeAdmin;

        try {
            DB::beginTransaction();
                    $user = new mod_ms_admin();
                    $user->username = $username;
                    $user->password = $password;
                    $user->nama = $nama;
                    $user->code_jabatan = $code_jabatan;
                    $user->kodeAdminTrx = $kodeAdmin;
                    $user->save();
                    $result = 'success';
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($err);
        }
    }

    public function resetPassword(Request $request) {
        $username = $request->username;
        try {
            DB::beginTransaction();
            DB::table('ms_admin')->where('username','=',$username)
                ->update([
                    'password' => $username
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
            DB::table('ms_admin')->where('username','=',$username)
                ->update([
                    'isDel' => 1
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
            DB::table('ms_admin')->where('username','=',$username)
                ->update([
                    'isDel' => 0
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}
