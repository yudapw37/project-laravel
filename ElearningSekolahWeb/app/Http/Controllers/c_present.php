<?php

namespace App\Http\Controllers;

use App\present;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class c_present extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $present = DB::table('presents')
        ->select('presents.id as id', 'students.username as username','tasks.mapel as mapel','tasks.nama as namaTugas','presents.komentar as komentar','presents.file_upload as file_upload','presents.nilai as nilai','presents.created_at as tanggal')
            ->join('students', 'students.id', '=', 'presents.code_students')
            ->join('tasks', 'tasks.id', '=', 'presents.code_tasks')
            ->orderBy('presents.created_at','DESC')
            ->paginate(10);

        // $present = present::orderBy('created_at', 'asc')->paginate(10);
        return view('present.index', compact('present'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPresent(Request $request)
    {
        $namaSiswa = $request->namaSiswa;
        $present = DB::table('presents')
        ->select('presents.id as id', 'students.username as username','tasks.mapel as mapel','tasks.nama as namaTugas','presents.komentar as komentar','presents.file_upload as file_upload','presents.nilai as nilai','presents.created_at as tanggal')
            ->join('students', 'students.id', '=', 'presents.code_students')
            ->join('tasks', 'tasks.id', '=', 'presents.code_tasks')
            ->where('students.nama', 'like', '%' . $namaSiswa . '%')
            ->orderBy('presents.created_at','DESC')
            ->paginate(10);
        // $present = present::orderBy('created_at', 'asc')->paginate(10);
        return view('present.index', compact('present'));
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idUser = session()->get('idUser');
        $present = DB::table('presents')
            ->select('presents.id as id','presents.created_at as tanggal', 'tasks.nama as nama','presents.file_upload as file_upload','presents.nilai as nilai')
            ->join('students', 'students.id', '=', 'presents.code_students')
            ->join('tasks', 'tasks.id', '=', 'presents.code_tasks')
            ->where('students.id', '=', $idUser)
            ->orderBy('presents.created_at','DESC')
            ->paginate(5);

        $task = DB::table('tasks')
            ->whereDate('tanggal','=', Carbon::today())
            ->first();

        if($task){
            $request->session()->put('idTask',$task->id);
        }        

        return view('activities.index', array('present' => $present, 'task' => $task))->with('role', 'siswa');
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
            'komentar'=>'required',
        ]);

        $presents = DB::table('presents')
            ->whereDate('created_at','=', Carbon::today())
            ->first();

        if($presents){
            return redirect('/kegiatan')->with('status', 'Data Kegiatan Siswa Di tanggal ini sudah ada!');
        }
        else
        {
            $idUser = session()->get('idUser');
            $idTask = session()->get('idTask');
            $username = session()->get('username');    

            if($request->file){
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();

                $nama_file = "Tugas_".$username."_".time().".".$ext;

                $tujuan_upload = 'tasks';
                $file->move($tujuan_upload,$nama_file);
            }
            else{$nama_file="-";}

            present::create([
                    'code_tasks' => $idTask,
                    'code_students' => $idUser,
                    'komentar' => $request->komentar,
                    'file_upload' => $nama_file,
                ]);

            return redirect('/kegiatan')->with('statusSimpan', 'Data Kegiatan Siswa Berhasil Ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function show(present $present)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function edit(present $present)
    {
        $idUser = session()->get('idUser');
        $presentDb = DB::table('presents')
            ->select('presents.created_at as tanggal', 'tasks.nama as nama','presents.file_upload as file_upload')
            ->join('students', 'students.id', '=', 'presents.code_students')
            ->join('tasks', 'tasks.id', '=', 'presents.code_tasks')
            ->where('students.id', '=', $idUser)
            ->orderBy('presents.created_at','DESC')
            ->paginate(5);

        $task = DB::table('tasks')
            ->whereDate('tanggal','=', Carbon::today())
            ->first();

        $prsnt = DB::table('presents')
            ->where('id','=', $present->id)
            ->first();

        // $request->session()->put('idTask',$task->id);

        // return view('activities.index', array('present' => $present, 'task' => $task))->with('role', 'siswa');
        return view ('activities.edit', array('presentDb' => $presentDb, 'task' => $task, 'prsnt' => $prsnt));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, present $present)
    {
        $idUser = session()->get('idUser');
        $idTask = session()->get('idTask'); 
        $username = session()->get('username');     

        $request->validate([
            'komentar'=>'required',
        ]);

        if($request->file){
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $nama_file = "Tugas_".$username."_".time().".".$ext;

            $tujuan_upload = 'tasks';
            $file->move($tujuan_upload,$nama_file);
        }
        else{$nama_file="-";}

        present::where('id',$present->id)
                 ->update([
                    'code_tasks' => $idTask,
                    'code_students' => $idUser,
                    'komentar' => $request->komentar,
                    'file_upload' => $nama_file,
                 ]);
        return redirect('/kegiatan')->with('statusSimpan', 'Data Kegiatan Siswa Berhasil Diubah!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function showEditNilai(Present $present)
    {
        $present = DB::table('presents')
        ->select('presents.id as id', 'students.username as username','students.nama as nama','students.kelas as kelas','tasks.mapel as mapel','tasks.nama as namaTugas','tasks.keterangan as keterangan','presents.komentar as komentar','presents.file_upload as file_upload','presents.created_at as tanggal')
            ->join('students', 'students.id', '=', 'presents.code_students')
            ->join('tasks', 'tasks.id', '=', 'presents.code_tasks')
            ->orderBy('presents.created_at','DESC')
            ->where('presents.id','=', $present->id)
            ->first();

        // $present = present::orderBy('created_at', 'asc')->paginate(10);
        return view('present.edit', compact('present'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function updateNilai(Request $request, present $present)
    {
        $request->validate([
            'nilai'=> 'required|numeric'
        ]);
        present::where('id',$present->id)
                 ->update([
                    'nilai' => $request->nilai,
                 ]);
        return redirect('/aktifitas')->with('statusSimpan', 'Nilai Siswa Berhasil Ditambah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\present  $present
     * @return \Illuminate\Http\Response
     */
    public function destroy(present $present)
    {
        //
    }
}
