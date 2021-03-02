<?php

namespace App\Http\Controllers;

use App\mod_karyawan;
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

    public function edit($username) {
        $data = DB::table('ms_admin')
        ->select('id','username','nama', 'no_telp','code_jabatan','code_perusahaan','kodeAdminTrx')
        ->where('username',$username)
        ->first();
       
        return view('dashboard.master-data.karyawan.edit')->with('data',$data);
    }

    public function editPass($username) {
        $data = DB::table('ms_admin')
        ->select('id','username','nama', 'no_telp','code_jabatan','code_perusahaan','kodeAdminTrx')
        ->where('username',$username)
        ->first();
       
        return view('dashboard.master-data.karyawan.password')->with('data',$data);
    }

    public function data(Request $request) {
        $data['data'] = DB::table('ms_admin')
        ->select('ms_admin.id as id','ms_admin.username as username','ms_admin.isDell as status','nama','ms_jabatan.jabatan as jabatan','ms_admin.kodeAdminTrx as kodeAdminTrx')
        ->join('ms_jabatan','ms_jabatan.id','=','ms_admin.code_jabatan')
        ->get();
    return json_encode($data);
           
    }

    public function submit(Request $request) {
        $type = $request->type;
        $username = $request->username;
        $nama = $request->nama;
        $telp = $request->telp;
        $iJabatan = $request->iJabatan;
        $lokasi = $request->lokasi;
        $kodeAdmin = $request->kodeAdmin;

        if($username==null){
            return 'username Tidak boleh kosong';
        }
        if($nama==null){
            return 'nama Tidak boleh kosong';
        }
        if($telp==null){
            return 'telp Tidak boleh kosong';
        }
        if($iJabatan==null){
            return 'Jabatan Tidak boleh kosong';
        }
        if($lokasi==null){
            return 'Tidak boleh kosong';
        }
        if($kodeAdmin==null){
            return 'kode Admin Tidak boleh kosong';
        }
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                $username = $request->username;
                $password = $request->password;
                if(preg_match('/[^a-z0-9*_]+/i', $password)) {
                    return 'Tidak boleh ada special character';
                }
                if($password==null){
                    return 'Tidak boleh kosong';
                }
                if(strlen($password)<5){
                    return 'Password tidak boleh kurang dari 5 kata';
                }        

                $data = $request->password;
                $gethash = $this->hash();
                $keyenc = base64_encode($gethash);

                $hashvar = $gethash;

                $pass = $data;

                $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
                $key1=(int)substr($getkey,0,1);
                $key2=(int)substr($getkey,1,1);
                $key3=(int)substr($getkey,2,1);
                $key4=(int)substr($getkey,3,1);

                $sufflepass = substr( $hashvar,0,$key1).substr($pass,0,$key1).substr($hashvar,$key1,$key2).substr($pass,$key1,$key2).substr($hashvar,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($hashvar,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($hashvar,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
                
                $simple_string = $sufflepass;

                $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

                $encryption_key = base64_decode($key);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
                $encryption = base64_encode($encrypted . '::' . $iv);

                $keyhash = $keyenc;
                $pasword = $encryption;

                $employee = new mod_karyawan();
                $employee->code_perusahaan = $lokasi;
                $employee->username = $username;
                $employee->password = $pasword;
                $employee->keyhash = $keyhash;
                $employee->nama = $nama;
                $employee->no_telp = $telp;
                $employee->code_jabatan = $iJabatan;
                $employee->kodeAdminTrx = $kodeAdmin;
                $employee->save();
                
                        
                    $result = 'success';
            } elseif ($type == 'edit') {         
                DB::table('ms_admin')->where('username','=',$request->username)
                    ->update([
                        'nama' =>  $nama,
                        'no_telp' =>     $telp ,
                        'code_jabatan' =>     $iJabatan ,
                        'code_perusahaan' =>     $lokasi ,
                        'kodeAdminTrx' =>      $kodeAdmin 
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
    public function passSubmit(Request $request) {
        // $request->validate([
        //     'username'=>'required',
        //     'password'=>'required|min:6'
        // ]);
        $username = $request->username;
        $password = $request->password;
        if(preg_match('/[^a-z0-9*_]+/i', $password)) {
            return 'Tidak boleh ada special character';
        }
        if($password==null){
            return 'Tidak boleh kosong';
        }
        if(strlen($password)<6){
            return 'Password tidak boleh kurang dari 6 kata';
        }        

        $data = $request->password;
        $gethash = $this->hash();
        $keyenc = base64_encode($gethash);

        $hashvar = $gethash;

        $pass = $data;

        $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
        $key1=(int)substr($getkey,0,1);
        $key2=(int)substr($getkey,1,1);
        $key3=(int)substr($getkey,2,1);
        $key4=(int)substr($getkey,3,1);

        $sufflepass = substr( $hashvar,0,$key1).substr($pass,0,$key1).substr($hashvar,$key1,$key2).substr($pass,$key1,$key2).substr($hashvar,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($hashvar,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($hashvar,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
        
        $simple_string = $sufflepass;

        $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
        $encryption = base64_encode($encrypted . '::' . $iv);

        try {
            DB::beginTransaction();            
                DB::table('ms_admin')->where('username','=',$request->username)
                    ->update([
                       'password' => $encryption,
                       'keyhash' => $keyenc
                    ]);        
               $result = 'success';
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    
    }

    public function hash(){
        $listkey=['1122','1212','2112','2121','1221','2211'];
        $listhash=['@QW', 'Q@W', 'QW@', 'W@Q', 'WQ@'];
        

        $randIndexKEY = array_rand($listkey); 
        $hashKEY = $listkey[$randIndexKEY];

        $randIndexAQW = array_rand($listhash); 
        $hashAQW = $listhash[$randIndexAQW];
        $allhash = $hashAQW.$hashKEY;
        $sufflekey =str_shuffle($allhash);

        return $sufflekey;
    }



    public function disable(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_admin')->where('id','=',$id)
                ->update([
                    'isDell' => 1
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function activate(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_admin')->where('id','=',$id)
                ->update([
                    'isDell' => 0
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}

