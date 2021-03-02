<?php

namespace App\Http\Controllers;
use App\mod_md_flashSale;
use App\mod__ms_barang_promo;
use App\ms_promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class c_md_flashSale extends Controller
{
    public function index() {
        return view('dashboard.master-data.flash-sale.baru');
    }

    public function list() {
        return view('dashboard.master-data.flash-sale.list');
    }

    public function edit($id) {
        $data = DB::table('ms_flashsale')
        ->select('ms_flashsale.id as id','ms_flashsale.id_buku as id_buku','ms_barang.judul_buku as judul_buku','ms_flashsale.harga_jadi as harga_jadi','ms_flashsale.stock as stock','ms_flashsale.terjual as terjual','ms_flashsale.harga_buku as harga_buku','ms_flashsale.gambar_buku as gambar_buku','ms_flashsale.harga_jadi as harga_jadi')
        ->join('ms_barang','ms_barang.id','=','ms_flashsale.id_buku')
        ->where('ms_flashsale.id',$id)
        ->first();
       
        return view('dashboard.master-data.flash-sale.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $data['data'] =  DB::table('ms_flashsale')
        ->select('ms_flashsale.id as id','ms_flashsale.id_buku as id_buku','ms_barang.judul_buku as judul_buku','ms_flashsale.harga_jadi as harga_jadi','ms_flashsale.harga_buku as harga_buku','ms_flashsale.stock as stock','ms_flashsale.terjual as terjual')
        ->join('ms_barang','ms_barang.id','=','ms_flashsale.id_buku')->get();
        return json_encode($data);           
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kodeBuku = $request->id;
        $stockTerjual = $request->stockTerjual;
        $stock = $request->stock;
        $hargaJadi = $request->hargaJadi;
        $gambar = $request->foto;
    
        // $foto = ($request->foto !== '') ? $request->file('foto') : '';
        try {
            DB::beginTransaction();

         
            

            if ($type == 'baru') {    
                $filename = null;

                if ($gambar !== '') {
                 
                    $fileFoto=$request->file('foto');
                  
                    $filename = time().'.'.$fileFoto->getClientOriginalExtension();    
                    
                    $tujuan_upload = 'public/';
    
                    // $team = DB::table('ms_flashsale_general')->where('id','=',$request->id)->first();
    
                    // Storage::disk('public')->delete($team->file_name);
                    // $fileFoto->move($tujuan_upload,$filename);
                    Storage::putFileAs('public',$fileFoto,$filename);    
                }
              



                $data = DB::table('ms_barang')
                ->where('id','=',$kodeBuku)
                ->first();
                        $transaksi = new mod_md_flashSale();
                        $transaksi->id_buku = $kodeBuku;
                        $transaksi->judul_buku = $data->judul_buku;
                        $transaksi->harga_buku = $data->harga;
                        $transaksi->stock = $stock;
                        $transaksi->terjual = $stockTerjual;
                        $sisa = (((int)$stockTerjual/(int)$stock)*100);
                        $transaksi->sisa = $sisa;
                        $transaksi->gambar_buku = 'storage/'.$filename;
                     
                        $transaksi->file_name = $filename;
              
                        // $transaksi->tgl_exp =  date('Y-m-d',strtotime($tglExp));
                        $transaksi->harga_jadi = $hargaJadi;
                        $transaksi->save();

                        $ldate = date('Y');
                        $ldate1 = date('m');
                        $ldate2 = date('d');
                        $ldate3 = date('h');
                        $ldate4 = date('i');
                        $ldate5 = date('s');
                        $tahun = substr($ldate,2);
                        $count = DB::table('ms_promo')
                        ->select(DB::raw('COUNT(ms_promo.code_promo) as count'))
                        ->first();
                        $c = $count->count;
                        $kode = 'promo_' .$tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);
                        
                        $x = new mod__ms_barang_promo();
                        $x->code_promo = $kode;
                        $x->code_barang = $kodeBuku;
                        $x->save();

                        $c = new ms_promo();
                        $c->code_promo = $kode;
                        $c->nama_promo = 'FLASH SALE';
                        $c->harga_jadi = $hargaJadi;
                        $c->berat_total = $data->berat;
                        $c->save();
                        
                    $result = 'success';

            } elseif ($type == 'edit') {
                $id_ = $request->id_;
                $sisa = (((int)$stockTerjual/(int)$stock)*100);
                if($request->file('foto') !==null){
                    $fileFoto=$request->file('foto');              
                    $filename = time().'.'.$fileFoto->getClientOriginalExtension();    
                
                    dd($fileFoto);
                    Storage::putFileAs('public',$fileFoto,$filename);

                    DB::table('ms_flashsale')->where('id','=',$request->id_)
                    ->update([
                       'stock' => $stock,
                       'terjual' => $stockTerjual,
                       'sisa' => $sisa,
                       'harga_jadi' => $hargaJadi,
                       'file_name' => $filename,
                       'gambar_buku' => 'storage/'+$filename,
                    ]);
                    $result = 'success';
                    }
                    
                    else{
                        DB::table('ms_flashsale')->where('id','=',$request->id_)
                        ->update([
                           'stock' => $stock,
                           'terjual' => $stockTerjual,
                           'sisa' => $sisa,
                           'harga_jadi' => $hargaJadi,
                        ]);
                        $result = 'success';
                    }
        
               
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($request);
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

