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
                        <h4>Tambah Data New Product</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                        <div class="form-group">
                                <label for="iKategori">Kategori Buku</label>
                                <select class="form-control" id="iKategori" name="kategori" disable>
                                    <!-- <option value="best">Best Seller</option> -->
                                    <option value="new">New Product</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="iJudulBuku">Judul Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="idBuku" required></select>
                            </div>
                           
                            <!-- <div class="form-group">
                                <label for="iJudulBuku">Stock Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <div class="form-group">
                                <label for="iJudulBuku">Harga Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <div class="form-group">
                                <label>Harga Flash Sale</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                        
                            <div class="form-group">
                            <label for="iNama">Tanggal Expired</label>
                                <input type="text" class="form-control" id="iTanggal" name="tanggalExp">
                            </div> -->
                        
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                              
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
        let iKategori = $('#iKategori');
        let iJudulBuku = $('#iJudulBuku');
        // const iTanggal = $('#iTanggal').daterangepicker({
        //     singleDatePicker: true,
        //     locale: {
        //         format: 'DD-MM-YYYY'
        //     }
        // });


        $(document).ready(function () {

            iJudulBuku.select2({
                ajax: {
                    url: '{{ url('judulBuku') }}',
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
                    url: '{{ url('master/data/new-product/submit') }}',
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
                                    window.location = '{{ url('master/data/new-product/list') }}';
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
