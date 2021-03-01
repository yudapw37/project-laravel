<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;

use App\mod_customer;
use App\mod_alamat_cust;
use App\mod_transaksi;
use App\mod_admin;
use DB;

use Illuminate\Http\Request;

class c_login_register extends Controller
{
    public function index()
    {
        $allcategories="";
        $countcategories=0;
        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '/imgpublic';
        $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

        $pathhf = 'api/headerfooter';
        $pathcs = 'api/categories'; 

        return view('login', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'getBaseUrlEnv'=>$getBaseUrlEnv, 
        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 
        'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2, 'pathPublic'=>$pathPublic, 
        'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 
        'allcategories'=>$allcategories]);
    }

    public function regindex()
    {
        $allcategories="";
        $countcategories=0;
        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '/imgpublic';
        $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

        $pathhf = 'api/headerfooter';
        $pathcs = 'api/categories'; 

        return view('register', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'getBaseUrlEnv'=>$getBaseUrlEnv, 
        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 
        'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2, 'pathPublic'=>$pathPublic, 
        'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 
        'allcategories'=>$allcategories]);
    }

    public function ceklogin(Request $request){
        $request->validate([
            'username'=>'required|max:20|min:4|',
            'inptPass'=>'required|max:20|min:2|'
        ]);
        // $cek = mod_customer::select('id as idUser', 'username', 'nama', 'kodeAdminTrx')->where('username', '=', $request->username)
        //                             ->where('password', '=', $request->inptPass)->first();
        
        $user = mod_customer::select('id as idUser', 'username', 'nama', 'kodeAdminTrx', 'password', 'keyhash', 'jenis_reseller')->where('username', '=', $request->username)->first();
        
        if($user){
            $data = $user->password;
            $keyhash = $user -> keyhash;
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
            
            
            // dd($keyenc.'-'.$keydec.'-'.$passdb.'-'.$decryption.'-'.$decryptpass);
            if($request->inptPass==$decryptpass){
                    $request->session()->put('token', '4qw4m5t0r3');  
                    $request->session()->put('idUser', $user->idUser);  
                    $request->session()->put('username', $user->username);  
                    $request->session()->put('nama', $user->nama);
                    $request->session()->put('kodeAdminTrx', $user->kodeAdminTrx);
                    $request->session()->put('jenis_reseller', $user->jenis_reseller);

                    return redirect('/')->with('statusSukses', 'Login Sukses');
            }
            else{
                return redirect('/login')->with('statussalah', 'Login Gagal. Password tidak tepat');  
            }                   
        }
        else{
            return redirect('/login')->with('statussalah', 'Login Gagal. Username dan Password tidak tepat');
            // echo 'salah';statussalah
        }    
    }

    public function registercust(Request $request){
        $request->validate([
            'username'=>'required|unique:ms_customer|min:6',
            'password'=>'required|min:6',
            'nama'=>'required|min:6',
            'email'=>'required',
            'telephone'=>'required',
            'alamat'=>'required'
        ]);
        
        $data = $request->password;
        $gethash = $this->hash();
        $keyenc = base64_encode($gethash);
        // $pass = encrypt($data, $gethash);

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

        // $encryption;

        
        if($request->kodeadmin){
            $kodeAdminTrx = $request->kodeadmin; 
        }else{
            $kodeAdminTrx = $this->getkodeadmin(); 
        }      
                $count = DB::table('ms_customer')
                        ->select(DB::raw('COUNT(ms_customer.id) as count'))
                        ->first();
           
                $c = $count->count;
                $kode = 'CUS' . str_pad($c, 6, '0', STR_PAD_LEFT).$kodeAdminTrx;

            mod_customer::create([
                'id' => $kode,
                'username' => $request->username,
                'password' => $encryption,
                'email' => $request->email,
            	'nama' => $request->nama,
                'telephone' => $request->telephone,
                'kodeAdminTrx' => $kodeAdminTrx,
                'keyhash' => $keyenc,
                'alamat' => $request->alamat
            ]);
    // mod_alamat_cust::create([
    //             'code_customer' => $kode,
    //             'alamat' => $request->alamat
    //         ]);
        return redirect('/login')->with('statusSuksesDaftar', 'Akun Berhasil Dibuat. Silahkan Login');
    } 
    public function getkodeadmin()
    {
        // $year = date('Y');
        // $month = date('m');

        // $kodeAdminTrx = mod_transaksi::select('count(kodeAdminTrx) as jumlah')
        //                                 ->where('created_at','like', $year.'-'.$month.'%' )
        //                                 ->where('kodeAdminTrx','!=', 'TRIAL' )
        //                                 ->where('kodeAdminTrx','!=', 'JKT0DW' )
        //                                 ->groupBy('jumlah')->orderBy('jumlah', 'asc')->first();
        $a=array();
        $kode = mod_admin::select('kodeAdminTrx')->where('kodeAdminTrx','!=', 'TRIAL' )
                            ->where('kodeAdminTrx','!=', 'JKT0DW' )
                            ->where('code_jabatan','=', '2' )
                            ->get();
                            
        foreach($kode as $ord1){
            // dd($ord1->kodeAdminTrx);
            array_push($a, $ord1->kodeAdminTrx);
        }
        //  dd($a);
        
        // $kode = array("JKT0NV", "TA00X", "AL00X", "ZA00X", "YG00X", "CH00X");
        $random = array_rand($a);   
        // dd($a[$random]);
        return $a[$random];
    }

    public function logout(Request $request){
         
        if ($request->session()->has('idUser')){
                $request->session()->forget('idUser');
                $request->session()->forget('username');
                $request->session()->forget('nama');
                $request->session()->forget('kodeAdminTrx');
                $request->session()->forget('token');
                $request->session()->forget('jenis_reseller');
                
                return redirect('/')->with('statusSukses', 'Berhasil Logout!');
                     
        }else{
            return 'null';
        }
        
    }

    public function decrypt($data, $keyhash){
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
        return $decryptpass;
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
    public function encrypt($data, $hash){
        
        $hashvar = $hash;

        $pass = $data;

        $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
        $key1=(int)substr($getkey,0,1);
        $key2=(int)substr($getkey,1,1);
        $key3=(int)substr($getkey,2,1);
        $key4=(int)substr($getkey,3,1);

        $sufflepass = substr($sufflekey,0,$key1).substr($pass,0,$key1).substr($sufflekey,$key1,$key2).substr($pass,$key1,$key2).substr($sufflekey,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($sufflekey,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($sufflekey,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
        
        $simple_string = $sufflepass;

        $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
        $encryption = base64_encode($encrypted . '::' . $iv);

        return $encryption;

    }
}
