@extends('dashboard.layout')

@php
$menu = \App\Http\Controllers\c_Dashboard::sidebar();
@endphp

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Karyawan</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="edit">
                        <input type="hidden" name="username" value="{{ $data->username }}">
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label>Username</label>
                                <input id="username" name="username" disabled type="text" class="form-control" value="{{ $data->username }}" autofocus required>
                            </div>
                            <!-- <div class="form-group">
                                <label>Password</label>
                                <input id="password" name="password" type="text" class="form-control" value="" autofocus required>
                            </div> -->
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="{{ $data->nama }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iProvider">No Telp</label>
                                <input id="telp" name="telp" type="text" class="form-control" value="{{ $data->no_telp }}" autofocus required>
                                <!-- <input style="width: 100%" id="telp" name="telp" value="{{ $data->no_telp }}" autofocus required></input> -->
                            </div>
                            <div class="form-group">
                                <label for="iProvider">Jabatan</label>
                                <select style="width: 100%" id="iJabatan" name="iJabatan">
                                
                                @if($data->code_jabatan=='1')
                                    <option value="1">super user</option>
                                @elseif($data->code_jabatan=='2')
                                <option value="2">admin sales</option>
                                @elseif($data->code_jabatan=='3')
                              
                                
                                <option value="3">admin keuangan</option>
                                @elseif($data->code_jabatan=='4')
                              
                                
                                <option value="4"> admin gudang</option>
                                @elseif($data->code_jabatan=='5')
                              
                                
                              <option value="5">manajer gudang</option>
                                          
                              
                                @elseif($data->code_jabatan=='6')
                                <option value="6">Manajer Sales</option>
                                @endif
                                
                                </select>

                            </div>
                            <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                                <select style="width: 100%" id="iLokasi" name="lokasi">
                                   
                                @if($data->code_perusahaan=='1')
                                    <option value="1">PT.Aqwam</option>
                                @elseif($data->code_perusahaan=='2')
                                <option value="2">PT Aqwam Jakarta</option>             
                                @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode Admin</label>
                                <input id="kodeAdmin" name="kodeAdmin" type="text" class="form-control"  value="{{ $data->kodeAdminTrx }}" autofocus required>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/data/karyawan/list') }}'">
                                        <i class="fas fa-times mr-2"></i>Cancel
                                    </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let formData = $('#formData');
        let iJabatan = $('#iJabatan');
        let iLokasi = $('#iLokasi');

        $(document).ready(function () {

            iJabatan.select2({
                ajax: {
                    url: '{{ url('jabatan') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            iLokasi.select2({
                ajax: {
                    url: '{{ url('perusahaan') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/data/karyawan/submit') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location = '{{ url('master/data/karyawan/list') }}';
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Gagal Tersimpan',
                                text: response,
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Tersimpan',
                            text: response,
                        });
                    }
                })
            })
        });
    </script>
@endsection
