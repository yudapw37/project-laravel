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
                        <h4>Tambah Data Buku</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
              
                        <div class="form-group">
                                <label for="iJudulBuku">Kode Buku</label>
                                <input id="iHargaBuku" name="hargaBuku" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iStockTerjual">Barcode</label>
                                <input id="iStockTerjual" name="stockTerjual" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iHargaBuku">Berat</label>
                                <input id="iHargaBuku" name="hargaBuku" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Judul</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Penerbit</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Halaman</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Ukuran</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Cover</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Penulis</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>ISBN</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="text" class="form-control" id="iTanggal" name="tanggalExp">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
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

        const iPreviewFoto = $('#iPreviewFoto');
        const iPreviewFilename = $('#iPreviewFilename');
        const iFoto = document.getElementById('iFoto');

        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY',
                autoclose: true,
            viewMode: "Decade view",
            }
        });


        $(document).ready(function () {
            iFoto.addEventListener('change',function () {
                const allowed = ['.jpeg','.jpg'];
                let input = this;
                let image = input.files[0];
                let value = input.value;
                let length = value.length;
                let index = value.lastIndexOf(".");
                let extension = value.substring(index,length).toLowerCase();
                if (!allowed.includes(extension)) {
                    alert('Format yang diperbolehkan yaitu .jpeg atau .jpg');
                } else {
                    if ((image.size/1000) > 1000) {
                        input.value = '';
                        alert('Ukuran maksimal 500kb. Ukuran file anda '+(image.size/1000)+'Kb');
                    } else {
                        iPreviewFilename.html(value);
                        // console.log(image);

                        let reader = new FileReader();
                        reader.onload = function(e) {
                            iPreviewFoto.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            });




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
                    url: '{{ url('master/data/flash-sale/submit') }}',
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
                                    window.location = '{{ url('master/data/flash-sale') }}';
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
