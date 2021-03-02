<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;

class c_student extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = student::orderBy('created_at', 'asc')->paginate(10);

        return view('students.index', compact('students'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStudent(Request $request)
    {
        $namaSiswa = $request->namaSiswa;

         $students = student::where('nama', 'like', '%' . $namaSiswa . '%')->paginate(10);

        return view('students.index', compact('students'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('students.create');
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
            'nama'=>'required',
            'username'=>'required',
            'password'=>'required',
            'kelas'=>'required',
            'alamat'=>'required'
        ]);

        student::create($request->all());
        return redirect('/students')->with('statusSukses', 'Data Siswa Berhasil Ditambahkan!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        return $student;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        return view ('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        $request->validate([
            'nama'=>'required',
            'username'=>'required',
            'password'=>'required',
            'kelas'=>'required',
            'alamat'=>'required'
        ]);

        student::where('id',$student->id)
                 ->update([
                    'nama'=> $request->nama,
                    'username'=>$request->username,
                    'password'=>$request->password,
                    'kelas'=>$request->kelas,
                    'alamat'=>$request->alamat
                 ]);
                 return redirect('/students')->with('statusSukses', 'Data Siswa Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        student::destroy($student->id);
        return redirect('/students')->with('statusSukses', 'Data Siswa Berhasil Dihapus!');
    }
}
