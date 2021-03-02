<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class c_Login extends Controller
{
    public function index() {
        if (session()->has('status')) {
            if (session()->get('status') == 'logged in') {
                return redirect('/');
            } else {
           
                return view('dashboard.login');
            }
        } else {
            return view('dashboard.login');
        }
    }

    public function submit(Request $request) {
        $username = $request->username;
        $password = $request->password;

        try {
            $dtUser = DB::table('ms_admin')
                ->where('username','=',$username);
            if ($dtUser->exists()) {
                $user = $dtUser->first();

                $data = $user->password;
                $keyhash = $user->keyhash;
                if($keyhash == '-'){
                    return $result = 'Password harus di reset. Hubungi admin.';
                }
                if($keyhash == null){
                    return $result = 'Password harus di reset. Hubungi admin.';
                }
                // $decryptpass=decrypt($data, $keyhash);  
                
                $keydec=base64_decode($keyhash);
    
                $passdb = $data;
                $passkey = $keydec;
    
                $sufflekey =$passkey;
    
                $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$sufflekey)));
                $key1=(int)substr($getkey,0,1);
                $key2=(int)substr($getkey,1,1);
                $key3=(int)substr($getkey,2,1);
                $key4=(int)substr($getkey,3,1);
    
            
                $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
    
                $encryption_key = base64_decode($key);
                list($encrypted_data, $iv) = explode('::', base64_decode($passdb), 2);
                $decryption= openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    
                $decryptpass = substr($decryption,$key1,$key1).substr($decryption,2*$key1+$key2,$key2).substr($decryption,2*$key1+2*$key2+$key3,$key3).substr($decryption,2*$key1+2*$key2+2*$key3+$key4,$key4).substr($decryption,2*$key1+2*$key2+2*$key3+2*$key4+1);
                
                if($decryptpass==$password){
                    $request->session()->put([
                        'id' => $user->id,
                        'status' => 'logged in',
                        'username' => $username,
                        'name' => $user->nama,
                        'user_id' => $user->id,
                        'created_at' => $user->created_at
                    ]);
                    $result = 'success';
                }
                else{
                    $result = 'Password salah.';
                }
            } else {
                $result = 'Username tidak terdaftar.';
            }
            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function logout(Request $request) {
        try {
            if ($request->session()->has('username')){
                $request->session()->forget('id');
                $request->session()->forget('username');
                $request->session()->forget('name');
                $request->session()->forget('status');
                
                return 'success';
                     
                }else{
                    return 'gagal';
                }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function resetPassword() {
        if (Session::exists('username')) {
            return view('dashboard.reset-password');
        } else {
            return redirect('/');
        }
    }

    public function resetPasswordSubmit(Request $request) {
        $username = Session::get('username');
        $lama = $request->password_lama;
        $baru = $request->password_baru;

        try {
            DB::beginTransaction();
            $dtUser = DB::table('users')->where('username','=',$username)->first();
            if (Crypt::decryptString($dtUser->password) == $lama) {
                DB::table('users')->where('username','=',$username)
                    ->update([
                        'password' => Crypt::encryptString($baru)
                    ]);
                $result = 'success';
            } else {
                $result = 'password salah';
            }
            DB::commit();
            Session::flush();
            return $result;
        } catch (\Exception $ex) {
            $err = [$ex];
            return response()->json($err);
        }
    }
}
