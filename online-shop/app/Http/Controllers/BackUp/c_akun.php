<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_customer;
use App\mod_cart;
use App\mod_alamat_cust;
use Illuminate\Http\Request;

class c_akun extends Controller
{
    public function index(Request $request)
    {
        $allcategories="";
        $alamat="";
        $email="";
        $diskon=0;
        $nama="";
        $countcategories=0;
        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '/imgpublic';
        $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                    $username = $request->session()->get('username');
                    $user = mod_customer::select('id as idUser', 'username', 'nama','email', 'alamat', 'diskon', 'telephone', 'jenis_reseller')->where('username', '=', $username)->first();
                    // dd($user);
                    $alamat =$user->alamat;
                    $diskon = $user->diskon;
                    $email = $user->email;
                    $telephone = $user->telephone;
                    $nama = $user->nama;
                    if($user->jenis_reseller==0){
                        $jenis_reseller = 'Custommer';
                    }else{
                        $jenis_reseller = 'Member Reseller';
                    }
                    
                    $countCart = $this->getcountcart($username);

                    $pathhf = 'api/headerfooter';
                    $pathcs = 'api/categories'; 

                    return view('akun', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'getBaseUrlEnv'=>$getBaseUrlEnv, 
                    'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 
                    'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2, 'pathPublic'=>$pathPublic, 
                    'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 
                    'allcategories'=>$allcategories,  'countCart'=>$countCart, 'nama'=>$nama,  'username'=>$username,'email'=>$email,'alamat'=>$alamat, 'diskon'=>$diskon, 'telephone'=>$telephone, 'jenis_reseller'=>$jenis_reseller]);
                }else{
                return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }
            }else{
                $countCart = 'null';
                $nama = 'null';
                $username = 'null';

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }

        
    }
    public function getcountcart($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;
       
    }
    public function editpass(Request $request){
        $errormsg='';
        if ($request->session()->has('idUser')){  
            if($request->session()->get('token')=='4qw4m5t0r3'){
                $request->validate([
                    'oldpass'=>'required|min:1',
                    'newpass'=>'required|min:1',
                    'confirmpass'=>'required|min:1',
                ]);
                if(strlen($request->newpass) < 6){return "pendek";}
                elseif(strlen($request->newpass) > 20){return "panjang";}
                else{
                    $idUser=$request->session()->get('idUser');
                    $username=$request->session()->get('username');
                    $user = mod_customer::select('id as idUser', 'username','password', 'keyhash')
                    ->where('username', '=', $username)->where('id', '=', $idUser)->first();

                    $data = $user->password;
                    $keyhash = $user->keyhash;
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
                    if($request->oldpass==$decryptpass){
                        if($request->newpass!=$request->confirmpass){
                            return 'salah';
                        }
                        elseif($request->newpass==$request->oldpass){
                            return 'sama';
                        }
                        else{
                            $data = $request->newpass;
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

                                    mod_customer ::where('id', '=', $idUser)                             
                                            ->where('username', '=', $username)
                                            ->update(
                                                ['password' => $encryption, 'keyhash'=>$keyenc]
                                        );
                            return 'sukses';
                        }
                    }else{
                        return 'password salah';
                    }
                }               
            }else{
                return 'login';
            }
        }else{
            return 'login';
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
    public function editakun(Request $request){
        if ($request->session()->has('idUser')){  
            $request->validate([
                'namaedt'=>'required|max:99|min:1',
                'emailedt'=>'required|min:1',
                'hpedt'=>'required|min:1',
                'alamatedt'=>'required|max:999|min:1'
            ]);
            $idUser=$request->session()->get('idUser');
            $username=$request->session()->get('username');
            mod_customer ::where('id', '=', $idUser)                             
                                ->where('username', '=', $username)
                                ->update(
                                    ['nama' => $request->namaedt, 'telephone'=>$request->hpedt, 
                                    'email'=>$request->emailedt, 'alamat'=>$request->alamatedt]
                            );
            mod_alamat_cust::where('code_customer', '=', $idUser)
                            ->update(
                                [ 'alamat'=>$request->alamatedt]
                            );
            return 'sukses';
        }else{
            return 'login';
        }
    }
    public function editreseller(Request $request){
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

            // dd($id);

            if($request->session()->get('token')=='4qw4m5t0r3'){
                $username = $request->session()->get('username');
                $user = mod_customer::select('id as idUser', 'username', 'nama','email', 'alamat', 'diskon', 'telephone', 'jenis_reseller')->where('username', '=', $username)->first();
                // dd($user);
                $alamat =$user->alamat;
                $diskon = $user->diskon;
                $email = $user->email;
                $telephone = $user->telephone;
                $nama = $user->nama;
                if($user->jenis_reseller==0){
                    $jenis_reseller = 'Custommer';
                }else{
                    $jenis_reseller = 'Member Reseller';
                }
                
                $countCart = $this->getcountcart($username);

                $pathhf = 'api/headerfooter';
                $pathcs = 'api/categories'; 

                return view('reseller', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs,'getBaseUrlEnv'=>$getBaseUrlEnv, 
                'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 
                'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2, 'pathPublic'=>$pathPublic, 
                'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 
                'allcategories'=>$allcategories,  'countCart'=>$countCart, 'nama'=>$nama,  'username'=>$username,'email'=>$email,'alamat'=>$alamat, 'diskon'=>$diskon, 'telephone'=>$telephone, 'jenis_reseller'=>$jenis_reseller]);
            }else{
            return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }

    }
}
