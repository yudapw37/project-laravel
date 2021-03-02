@extends('dashboard.layout')
@php
$menu = \App\Http\Controllers\c_utility::kategoriBukuInprint();
@endphp


@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kategori Buku Inprint</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                         
                        <div class="form-group">
                                <label for="iJudulBuku">Judul Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <hr>
                            <h5>Kategori Buku</h5>
             
                                <hr>
                                
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <h6 class="ml-5">kategori</h6>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                @foreach($menu as $m)
                                                    <div class="col-lg-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="permission[]" class="custom-control-input" id="permission_{{ $m->id }}" value="{{ $m->id }}">
                                                            <label class="custom-control-label" for="permission_{{ $m->id}}">{{ $m->namaKategori }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                             
                        
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
        let iJudulBuku= $('#iJudulBuku');

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
                    url: '{{ url('master/data/buku-kategori-inprint/submit') }}',
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
                                    window.location = '{{ url('master/data/buku-kategori-inprint') }}';
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
