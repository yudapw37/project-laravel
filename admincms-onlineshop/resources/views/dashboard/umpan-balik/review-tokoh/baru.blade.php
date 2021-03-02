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
                        <h4>Review Buku - Tokoh</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
              
                        <div class="form-group">
                                <label for="iJudulBuku">Judul Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <div class="form-group">
                                <label for="inamaReviewer">Nama Reviewer</label>
                                <input id="inamaReviewer" name="namaReviewer" type="text" class="form-control" autofocus required>
                            </div>
                     
                            <div class="form-group">
                                <label for="iHargaBuku">Review</label>
                                <div class="form-group">
                            <textarea name="review" rows="9" type="text" class="form-control" style="height:200px" autofocus required > </textarea>
                            </div>
                            </div>
                            <div class="form-group">
                                <label>Ratings</label>
                                <input id="iratings" name="ratings" type="number" class="form-control" autofocus required>
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
        let iJabatan = $('#iJabatan');
        let iJudulBuku = $('#iJudulBuku');

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
                    url: '{{ url('umpan-balik/data/review-tokoh/submit') }}',
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
                                    window.location = '{{ url('umpan-balik/data/review-tokoh') }}';
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
