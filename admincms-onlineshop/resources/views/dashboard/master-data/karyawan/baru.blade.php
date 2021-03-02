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
                        <h4>Tambah Data Karyawan</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                    
                            <div class="form-group">
                                <label>Username</label>
                                <input id="username" name="username" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" name="password" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input id="nama" name="nama" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iProvider">No Telp</label>
                                <input id="telp" name="telp" type="text" class="form-control"  autofocus required>
                               </div>
                            <div class="form-group">
                                <label for="iProvider">Jabatan</label>
                                <select style="width: 100%" id="iJabatan" name="iJabatan" required ></select>
                            </div>
                            <div class="form-group">
                                <label for="iPerusahaan">Lokasi</label>
                                <select style="width: 100%" id="iPerusahaan" name="lokasi" required ></select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="iProvider">Lokasi</label>
                                <input id="lokasi" type="text" name="lokasi"  class="form-control" autofocus required >
                            </div> -->
                            <div class="form-group">
                                <label>Kode Admin</label>
                                <input id="kodeAdmin" name="kodeAdmin" type="text" class="form-control"  autofocus required>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <!-- <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/user-management') }}'">
                                        <i class="fas fa-times mr-2"></i>Cancel
                                    </button> -->
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
        let iPerusahaan = $('#iPerusahaan');

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
            iPerusahaan.select2({
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
                                    window.location = '{{ url('master/data/karyawan') }}';
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
