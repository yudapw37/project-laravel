@extends('layout.mainactivities')

<!-- @section('title', 'Daftar Siswa') -->

@section('container')
    <div class="container mt-5 pt-4">
        <h2 class="font-weight-bold cLeft">
        Daftar Siswa
        </h2>
        <hr style="height:5px;background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);;border-radius:5px">
        <form class="" action="/students/search" method="get">
          <table>
            <tr>
              <td class="w-100">
                <input type="text" class="form-control" placeholder="Masukkan Nama Siswa.." name="namaSiswa" value="">
              </td>
              <td>
                <input style="width:80px!important" type="submit" class="btn btn-primary" name="cari" value="cari">
              </td>
              <td >
                <a style="width:130px!important"  href="/students/create"  class="btn btn-info text-light">Tambah Siswa</a>
              </td>
            </tr>

          </table>
        </form>
        <!-- @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif -->
  
    <div style="overflow:auto">
          <table class="table">
            <thead class="lgn">
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Perintah</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($students as $std)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$std->nama}}</td>
                        <td>{{$std->kelas}}</td>
                        <td>{{$std->username}}</td>
                        <td>{{$std->alamat}}</td>
                        <td>
                            <a href="/students/{{$std->id}}/edit" class="badge badge-success mb-2">Edit</a>
                            <a href="/students/delete/{{$std->id}}" class="badge badge-danger">Delete</a>
                        </td>
                    </tr> 
                @endforeach  
            </tbody>
          </table>
         

        </div>
            <div class="row">
                <div class="mr-auto ml-4">Total : {{$students->total()}}</div>
                <div class="ml-auto mr-4">{{$students->links()}}</div>  
            </div> 
      </div>
    
@endsection
