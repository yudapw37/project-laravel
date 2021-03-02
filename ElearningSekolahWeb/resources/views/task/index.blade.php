@extends('layout.mainactivities')



<!-- @section('title', 'Daftar Siswa') -->



@section('container')

    <!-- <div class="container-fluid px-md-5">

        <div class="row">

            <div class="col-10">

                <h3 class="display-5" style="margin-top:70px !important;">Daftar Tugas Siswa</h3>

                <hr style="border-top: 3px solid grey !important;" />

            </div>    

        </div>

        <div class="row">

            <form class="form-inline mb-3" action="/task/search" method="get">

                <div class="form-group m-2">

                    <input name="namaTugas" type="text" class="form-control w-100" style="min-width:75px;" placeholder="Masukkan Nama Tugas.." id="namaTugas" >

                </div>

                <div class="form-group m-2">

                    <button type="submit" class="btn btn-success float-left" style="width:90px;margin: 2px 1px 1px 2px;border: 1px solid #D1D1D1" name="insert_test" value="" >Cari</button>

                </div>

            </form>

                <div class="form-group m-2 ml-auto mr-4">

                    <a href="/task/create" class="btn btn-primary ">Tambah Data Tugas</a> 

                </div>

        </div>

        @if (session('status'))

            <div class="alert alert-success">

                {{ session('status') }}

            </div>

        @endif -->

    <div class="container mt-5 pt-4">

        <h2 class="font-weight-bold cLeft">

        Daftar Tugas Siswa

        </h2>

        <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">

        <form class="" action="/task/search" method="get">

          <table>

            <tr>

              <td class="w-100">

                <input type="text" class="form-control" name="namaTugas" placeholder="Masukkan Nama Tugas.."  id="namaTugas" value="">

              </td>

              <td>

                <input style="width:80px!important" type="submit" class="btn btn-primary" name="cari" value="cari">

              </td>

              <td >

                <a style="width:130px!important"  href="/task/create"  class="btn btn-info text-light">Tambah Tugas</a>

              </td>

            </tr>



          </table>

        </form>

        <div style="overflow:auto">

          <table class="table">

            <thead class="lgn">

              <tr>

                <th style="width:5%">#</th>

                <th style="width:15%" class="font-top">Nama</th>

                <th style="width:25%; min-width:300px">Keterangan Tugas</th>

                <th style="width:15%">File Tugas</th>

                <th style="width:10%">Kelas</th>

                <th style="width:15%">Tgl Tugas</th>

                <th style="width:15%"></th>

              </tr>

            </thead>

            <tbody>

                @foreach ($task as $tsk)

                    <tr>

                        <th scope="row">{{$loop->iteration}}</th>

                        <td>{{$tsk->nama}}</td>

                        <td>{{$tsk->keterangan}}</td>

                        <td><a href="/images/{{$tsk->file}}">{{$tsk->file}}</a></td>

                        <td>{{$tsk->kelas."(".$tsk->mapel.")"}}</td>

                        <td>{{$tsk->tanggal}}</td>

                        <td>

                            <a href="/task/{{$tsk->id}}/edit" class="badge badge-success mb-2">Edit</a>

                            <a href="/task/delete/{{$tsk->id}}" class="badge badge-danger">Delete</a>

                        </td>

                    </tr> 

                @endforeach  

            </tbody>

          </table>

         



        </div>

            <div class="row">

                <div class="mr-auto ml-4">Total : {{$task->total()}}</div>

                <div class="ml-auto mr-4">{{$task->links()}}</div>  

            </div> 

        <!-- <div class="scrolling-wrapper">

            <table class="table table-sm-responsive border rounded">

                <thead class="table-info">

                    <tr>

                    <th scope="col">#</th>

                    <th scope="col">Nama Tugas</th>

                    <th scope="col">Keterangan Tugas</th>

                    <th scope="col">File Tugas</th>

                    <th scope="col">Kelas</th>

                    <th scope="col">Tanggal Tugas</th>

                    <th scope="col">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($task as $tsk)

                    <tr>

                        <th scope="row">{{$loop->iteration}}</th>

                        <td>{{$tsk->nama}}</td>

                        <td>{{$tsk->keterangan}}</td>

                        <td><a href="/images/{{$tsk->file}}">{{$tsk->file}}</a></td>

                        <td>{{$tsk->kelas."(".$tsk->mapel.")"}}</td>

                        <td>{{$tsk->tanggal}}</td>

                        <td>

                            <a href="/task/{{$tsk->id}}/edit" class="badge badge-success">Edit</a>

                            <a href="/task/delete/{{$tsk->id}}" class="badge badge-danger">Delete</a>

                        </td>

                    </tr> 

                    @endforeach               

                </tbody>                

            </table>

            <div class="row">

                <div class="mr-auto ml-4">Total : {{$task->total()}}</div>

                <div class="ml-auto mr-4">{{$task->links()}}</div>  

            </div>          

        </div> -->

    </div>

    

@endsection

