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
                        <h4>Tambah Data Flash Sale</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
              
                        <div class="form-group">
                                <label for="iJudulBuku">Judul Buku</label>
                                <select style="width: 100%" id="iJudulBuku" name="id" required></select>
                            </div>
                            <div class="form-group">
                                <label for="iStock">Stock</label>
                                <input id="iStock" name="stock" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iStockTerjual">Terjual</label>
                                <input id="iStockTerjual" name="stockTerjual" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iHargaBuku">Harga Buku</label>
                                <input id="iHargaBuku" name="hargaBuku" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Harga Flash Sale</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                         
                            <!-- <div class="form-group">
                            <label for="iNama">Tanggal Expired</label>
                                <input type="text" class="form-control" id="iTanggal" name="tanggalExp">
                            </div> -->

                            <div class="row align-items-center">
                                <div class="col-4">
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="profile-widget-picture" id="iPreviewFoto" style="width: 100%">
                                </div>
                                <div class="col-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iFoto" name="foto">
                                        <label class="custom-file-label" for="iFoto" id="iPreviewFilename">Pilih Foto</label>
                                    </div>
                                    <small class="mt-5">Ukuran gambar 320px x 320px.</small>
                                    <small class="mt-5">Format yang diperbolehkan .jpeg atau .jpg.</small>
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
        let iJabatan = $('#iJabatan');
        let iJudulBuku = $('#iJudulBuku');
        let iHargaJadi = $('#iHargaJadi');
        let iHargaBuku = $('#iHargaBuku');
        let iStockTerjual = $('#iStockTerjual');
        let iStock = $('#iStock');

        const iPreviewFoto = $('#iPreviewFoto');
        const iPreviewFilename = $('#iPreviewFilename');
        const iFoto = document.getElementById('iFoto');

        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
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
                let formData = new FormData();
                 formData.append('foto',iFoto.files[0]);
                 formData.append('type',"baru");
                 formData.append('stockTerjual', iStockTerjual.val());
                 formData.append('id',iJudulBuku.val());
                 formData.append('hargaJadi',iHargaJadi.val());
                 formData.append('hargaBuku',iHargaBuku.val());
                 formData.append('stock',iStock.val());
            
              
                $.ajax({
                    url: '{{ url('master/data/flash-sale/submit') }}',
                    method: 'post',
                    enctype:'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal Tersimpan',
                                text: 'Pastikan koneksi internet anda tidak bermasalah dan coba kembali. Hubungi Developer jika tetap bermasalah.',
                            });
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'System Error',
                            text: 'Screenshot atau foto halaman ini dan hubungi Developer',
                        });
                    }
                })
            })
            //     e.preventDefault();
            //     $.ajax({
            //         url: '{{ url('master/data/flash-sale/submit') }}',
            //         method: 'post',
            //         data: $(this).serialize(),
            //         success: function (response) {
            //             if (response === 'success') {
            //                 Swal.fire({
            //                     icon: 'success',
            //                     title: 'Data Tersimpan',
            //                     showConfirmButton: false,
            //                     timer: 1000,
            //                     onClose: function () {
            //                         window.location = '{{ url('master/data/flash-sale') }}';
            //                     }
            //                 });
            //             } else {
            //                 console.log(response);
            //                 Swal.fire({
            //                     icon: 'warning',
            //                     title: 'Data Gagal Tersimpan',
            //                     text: response,
            //                 });
            //             }
            //         },
            //         error: function (response) {
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: 'Data Gagal Tersimpan',
            //                 text: response,
            //             });
            //         }
            //     })
            // })
        });
    </script>
@endsection
