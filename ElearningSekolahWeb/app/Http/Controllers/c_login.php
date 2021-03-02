<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class c_login extends Controller
{
    //

    public function index(Request $request)
    {
        return view('index');
    }

    public function cekLoginGuru(Request $request)
    {
        $login = DB::table('teachers')
        ->where('teachers.username', '=', $request->username )
        ->where('teachers.password', '=',  $request->password )
        ->first();

        if($login){
            $request->session()->put('idUser',$login->id);
            $request->session()->put('namaUser',$login->nama);
            $request->session()->put('username',$login->username);
            $request->session()->put('role','guru');

            return redirect('/students')->with('statusSukses', 'Login Berhasil');
        }
        else{
            return redirect('/')->with('status', 'Login Gagal, Username & Password Salah!');
        }

        // $present = present::orderBy('created_at', 'asc')->paginate(10);
        
    }

    public function cekLoginSiswa(Request $request)
    {
        $login = DB::table('students')
        ->where('students.username', '=', $request->username )
        ->where('students.password', '=',  $request->password )
        ->first();

        if($login){
            $request->session()->put('idUser',$login->id);
            $request->session()->put('namaUser',$login->nama);
            $request->session()->put('username',$login->username);
            $request->session()->put('role','siswa');

           
        // $present = present::orderBy('created_at', 'asc')->paginate(10);
        // if($login){
            return redirect('/kegiatan')->with('statusSukses', 'Login Berhasil');
        }
        else{
            return redirect('/')->with('status', 'Login Gagal, Username & Password Salah!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('idUser');
        $request->session()->forget('namaUser');
        $request->session()->forget('username');
        $request->session()->forget('role');
        $request->session()->forget('idTask'); 

        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
