@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Flash Sale</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Judul Buku</label>
                                <input  id="iJudulBuku" name="judulBuku" type="text" value="{{ $data->judul_buku }}" class="form-control" disabled="disabled" >
                            </div>

                            <div class="form-group">
                                <label for="iStock">Stock</label>
                                <input id="iStock" name="stock" type="text" class="form-control" value="{{$data->stock}}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iStockTerjual">Terjual</label>
                                <input id="iStockTerjual" name="stockTerjual" type="text" value="{{$data->terjual}}" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iHargaBuku">Harga Buku</label>
                                <input id="iHargaBuku" name="hargaBuku" type="text" value="{{$data->harga_buku}}" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Harga Flash Sale</label>
                                <input id="iHargaJadi" name="hargaJadi" type="text" value="{{$data->harga_jadi}}" class="form-control" autofocus required>
                            </div>

                            <div class="row align-items-center">

                            <div class="col-4">

                            <img src= "/{{$data->gambar_buku}}" class="img-fluid" id="iPreviewFoto">

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
                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/data/flash-sale/list') }}'">
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
        const iPreviewFoto = $('#iPreviewFoto');

        const iPreviewFilename = $('#iPreviewFilename');

        const iFoto = document.getElementById('iFoto');

        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            value:value="{{ $data->harga_jadi }}",
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        const id = $('#id');
        const stock = $('#iStock');
        const hargaJadi = $('#iHargaJadi');
        const stockTerjual = $('#iStockTerjual');


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

                    if ((image.size/1000) > 100000) {

                        input.value = '';

                        alert('Ukuran maksimal 500kb. Ukuran file anda '+(image.size/1000)+'Kb');

                    } else {

                        iPreviewFilename.html(value);

                        let reader = new FileReader();

                        reader.onload = function(e) {

                            iPreviewFoto.attr('src', e.target.result);

                        };

                        reader.readAsDataURL(input.files[0]);                 

                    }

                }

                });

                formData.submit(function (e) {

                e.preventDefault();

                let formData = new FormData();

                formData.append('foto',iFoto.files[0]);
                formData.append('type',"edit");
                formData.append('fileLocation', iPreviewFilename.val());
                formData.append('id',id.val());
                formData.append('id_','{{$data->id}}');
                formData.append('stock',stock.val());
                formData.append('hargaJadi',hargaJadi.val());
                formData.append('stockTerjual',stockTerjual.val());

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

                                    window.location = '{{ url('master/data/flash-sale/list') }}';

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
