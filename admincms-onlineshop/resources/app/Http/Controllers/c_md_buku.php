<?php

namespace App\Http\Controllers;

use App\mod_md_ms_gambar_buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;


class c_md_buku extends Controller
{
    public function index() {
        return view('dashboard.master-data.buku.baru');
    }

    public function list() {
        return view('dashboard.master-data.buku.list');
    }
    public function collectionGambar($id) {
        $dataMst = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();  
        $dataTrn = DB::table('ms_gambar_buku')
        ->where('ms_gambar_buku.id_buku',$id)
        ->get()->toArray();
        return view('dashboard.master-data.buku.collection')->with('dataMst',$dataMst)->with('dataTrn',$dataTrn);
    }

    public function edit($id) {
        $data = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();      
        return view('dashboard.master-data.buku.edit')->with('data',$data);
    }
    

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_barang')
        ->orderBy('ms_barang.judul_buku','ASC');
        if(@$filters){
            $query->where('ms_barang.judul_buku','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

    public function submit(Request $request) {
       
        $type = $request->type;
        $kodeBuku = $request->id;
        $barcode = $request->barcode;
        $berat = $request->berat;
        $status = $request->status;
        $judul = $request->judul;
        $penerbit = $request->penerbit;
        $harga = $request->harga;
        $halaman = $request->halaman;
        $ukuran = $request->ukuran;
        $cover = $request->cover;
        $penulis = $request->penulis;
        $isbn = $request->isbn;
        $tahun = $request->tahun;
        $location = $request->fileLocation;


        $gambar = $request->foto;
        $foto = ($request->foto !== '') ? $request->file('foto') : '';
        try {
            DB::beginTransaction();

            $filename = null;
    

            if ($type == 'baru') {    


            } elseif ($type == 'edit') {
         
                DB::beginTransaction();
                $filename = null;
               
                if ($gambar !== '') {
                 
                    $fileFoto=$request->file('foto');
 
                    $filename = time().'.'.$fileFoto->getClientOriginalExtension();    
                    
                    // $tujuan_upload = 'public/';
    
                    // $team = DB::table('ms_flashsale_general')->where('id','=',$request->id)->first();
    
                    // Storage::disk('public')->delete($team->file_name);
                    // $fileFoto->move($tujuan_upload,$filename);
                    Storage::putFileAs('public',$fileFoto,$filename);    
                
        
                }
                if($filename ==null)
                {
                    DB::table('ms_barang')->where('id','=',$request->id)
                    ->update([
                   
                      'barcode' => $barcode,
                      'berat' => $berat,
                      'status' => $status,
                      'judul' =>  $judul,
                      'penerbit' => $penerbit,
                      'harga' => $harga,
                      'halaman' => $halaman,
                      'ukuran' => $ukuran,
                      'cover' => $cover,
                      'penulis' =>   $penulis,
                      'isbn' => $isbn,
                      'tahun' => $tahun
                    ]);
                }
                else
                {
                    DB::table('ms_barang')->where('id','=',$request->id)
                ->update([
               
                  'gambar_buku' => 'storage/'.$filename,
                  'barcode' => $barcode,
                  'berat' => $berat,
                  'status' => $status,
                  'judul_buku' =>  $judul,
                  'penerbit' => $penerbit,
                  'harga' => $harga,
                  'halaman' => $halaman,
                  'ukuran' => $ukuran,
                  'cover' => $cover,
                  'penulis' => $penulis,
                  'isbn' => $isbn,
                  'tahun' => $tahun
                ]);
                }
                
                DB::commit();
         
                $result = 'success';
            }
        
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
            DB::table('ms_barang')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    /// colection

    public function submitCollection(Request $request) {
        $id = $request->id;
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            DB::beginTransaction();
            $filename = Uuid::uuid1()->toString().'.'.$extension;

            Storage::putFileAs('public',$file,$filename);

            $gambar = new mod_md_ms_gambar_buku();
            $gambar->id_buku = $id;
            $gambar->gambar = 'storage/'.$filename;
            $gambar->save();

            DB::commit();
            dd($request);
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            dd('Exception Block',$ex);
        }
    }

    public function deleteCollection(Request $request) {
        $id = $request->id;

        try {
            DB::table('ms_gambar_buku')->where('id','=',$id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
    }
}


