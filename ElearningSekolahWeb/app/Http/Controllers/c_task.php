<?php

namespace App\Http\Controllers;

use App\task;
use Illuminate\Http\Request;

class c_task extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = task::orderBy('tanggal', 'desc')->paginate(10);
        return view('task.index', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTask(Request $request)
    {
        $namaTugas = $request->namaTugas;

         $task = task::where('nama', 'like', '%' . $namaTugas . '%')->orderBy('tanggal', 'desc')->paginate(10);

        return view('task.index', compact('task'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel'=>'required',
            'nama'=>'required',
            'keterangan'=>'required',
            'kelas'=>'required',
            'tanggal'=>'required'
        ]);

        if($request->file){
            $file = $request->file('file');
            // dd($file.'-'.$request->file);
            $ext = $file->getClientOriginalExtension();

            $nama_file = "Tugas_Kelas".$request->kelas."_".time().".".$ext;

            $tujuan_upload = 'images';
            $file->move($tujuan_upload,$nama_file);
        }
        else{$nama_file="-";}

        task::create([
                'mapel' => strtoupper($request->mapel),
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'kelas' => $request->kelas,
            	'file' => $nama_file,
                'tanggal' => $request->tanggal,
            ]);
        return redirect('/task')->with('statusSukses', 'Data Tugas Siswa Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        return view ('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        $request->validate([
            'mapel'=>'required',
            'nama'=>'required',
            'kelas'=>'required',
            'keterangan'=>'required',
            'tanggal'=>'required'
        ]);

        if($request->file){
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $nama_file = "Tugas_Kelas".$request->kelas."_".time().".".$ext;

            $tujuan_upload = 'images';
            $file->move($tujuan_upload,$nama_file);
        }
        else{$nama_file="-";}

        task::where('id',$task->id)
                 ->update([
                    'mapel' => strtoupper($request->mapel),
                    'nama'=> $request->nama,
                    'keterangan'=>$request->keterangan,
                    'kelas'=>$request->kelas,
                    'file' => $nama_file,
                    'tanggal'=>$request->tanggal
                 ]);
                 return redirect('/task')->with('statusSukses', 'Data Tugas Siswa Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        task::destroy($task->id);
        return redirect('/task')->with('status', 'Data Tugas Siswa Berhasil Dihapus!');
    }
}
