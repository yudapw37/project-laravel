<?php

namespace App\Http\Controllers;

use App\sysPermission;
use App\mod_ms_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class c_MasterUserManagement extends Controller
{
    public function index() {
        return view('dashboard.master-data.user-management.baru');
    }

    public function list() {
        return view('dashboard.master-data.user-management.list');
    }

    public function edit($username) {
        $data = DB::table('ms_admin')->where('username','=',$username)->first();
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
        return DB::table('ms_admin')
            ->select('id','username','isDell as status','nama')

            ->where($data['where'])
            ->paginate(8);
    }

    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $username = $request->username;
        $name = $request->name;
        $systemAplikasi = $request->systemAplikasi;
        $jabatan = $request->jabatan;
        $kodeAdminTransaksi = $request->kodeAdminTransaksi;

   
        $permission = $request->permission;

        if ($request->username !== null || $request->username !== '') {
            $email = $request->username;
            $dtUser = DB::table('ms_admin')
                ->where('username','=',$username);
        } else {
            $dtUser = DB::table('ms_admin')->where('username','=',$username);
        }

        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                if ($dtUser->doesntExist()) {
                    $user = new mod_ms_admin();
                    $user->username = $username;
                    $user->password = Crypt::encryptString($username);
                    $user->nama = $name;
                    $user->code_perusahaan =$systemAplikasi;
                    $user->code_jabatan = $jabatan;
                    $user->kodeAdminTrx = $kodeAdminTransaksi;
                    $user->tipe = '0';
                    $user->isDell = '0';
                    $user->save();

                    foreach ($permission as $p) {
                        $userPermission = new sysPermission();
                        $userPermission->username = $username;
                        $userPermission->id_menu = $p;
                        $userPermission->save();
                    }

                    $result = 'success';
                } else {
                    $result = 'Username sudah terdaftar';
                }
            } elseif ($type == 'edit') {
                DB::table('ms_admin')
                    ->where('username','=',$username)
                    ->update([
                        'nama' => $name,
                       
                    ]);
                DB::table('sys_permission')->where('username','=',$username)->delete();
                foreach ($permission as $p) {
                    $userPermission = new sysPermission();
                    $userPermission->username = $username;
                    $userPermission->id_menu = $p;
                    $userPermission->save();
                }
                $result = 'success';
            }
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
            DB::table('ms_admin')->where('username','=',$username)
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
            DB::table('ms_admin')->where('username','=',$username)
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
