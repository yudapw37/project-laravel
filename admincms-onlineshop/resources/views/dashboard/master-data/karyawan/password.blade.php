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
                        <h4>Edit Password Karyawan</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label>Username</label>
                                <input id="username" name="username" disabled type="text" class="form-control" value="{{ $data->username }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input id="password" name="password" type="text" class="form-control" value="" autofocus required>
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
                const username = $('#username');
                const password = $('#password');
        $(document).ready(function () {

            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();               

                let formData = new FormData();
                 formData.append('password',password.val());
                 formData.append('username',username.val());
                
                $.ajax({
                    url: '{{ url('master/data/karyawan/pass/submit') }}',
                    method: 'post',
                    enctype:'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Password Baru Tersimpan',
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
