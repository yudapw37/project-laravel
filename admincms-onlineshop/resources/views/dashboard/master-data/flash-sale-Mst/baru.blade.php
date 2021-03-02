@extends('dashboard.layout')

@section('page title','WEB Component Header Section')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                
                <form id="formData">
                    <div class="card card-primary card-outline">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- <img src="{{$url}}{{$data->gambar_sale}}" class="img-fluid" id="iPreviewFoto"> -->
                                    <img src= "/{{$data->gambar_sale}}" class="img-fluid" id="iPreviewFoto">
                                </div>
                             
                                <div class="col-lg">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iFoto" name="foto">
                                        <label class="custom-file-label" for="iFoto" id="iPreviewFilename">Pilih Foto</label>
                                    </div>
                                    <!-- <small class="mt-5">Ukuran maksimal 500kb.</small> -->
                                    <small class="mt-5">Ukuran Gambar 500 x 625 pixel | Format yang diperbolehkan .jpeg atau .jpg.</small>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                <div class="form-group">
                                <label for="iNama">Tanggal Flash Sale Sebelumnya</label>
                                <input type="text" class="form-control" id="iTanggalOld" name="tanggalOld" value="{{$data->waktu}}" readOnly>
                                </div>   
                                <div class="form-group">
                                <label for="iNama">Tanggal Flash Sale Baru</label>
                                <input type="text" class="form-control" id="iTanggal" name="tanggal" >
                                </div>   
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                             
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                  
                                <button type="submit" class="btn btn-block btn-info">
                                        <i class="fas fa-pen"></i> Edit Data
                                    </button>
                                    <!-- <button type="button" class="btn btn-block btn-primary" id="btnEditData">
                                        <i class="fas fa-pen"></i> Edit Data
                                    </button> -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
        </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const iPreviewFoto = $('#iPreviewFoto');
        const iPreviewFilename = $('#iPreviewFilename');
        const iFoto = document.getElementById('iFoto');
       

        let formData = $('#formData');
        const btnEditData = $('#btnEditData');
        const btnEditGambar = $('#btnEditGambar');
        const id = $('#id');
        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'MM-DD-YYYY'
            }
        });

        $(document).ready(function () {
            /*
            Button Action
             */

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
                        // console.log(image);

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
                 formData.append('type',"baru");
                 formData.append('tanggal', iTanggal.val());
                 formData.append('id',id.val());
            
              
                $.ajax({
                    url: '{{ url('master/data/flash-sale-master/submit') }}',
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



            btnEditGambar.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/header-image/edit-gambar') }}';
            });
            btnEditData.click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/data/flash-sale-master/submit') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
           
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
