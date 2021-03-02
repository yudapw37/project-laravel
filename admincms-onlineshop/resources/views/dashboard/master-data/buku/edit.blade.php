@extends('dashboard.layout')



@section('content')

    <div class="section-body">

        <div class="row">

            <div class="col-12 col-md-6 col-lg-12">

                <div class="card">

                    <div class="card-header">

                        <h4>Edit Data Buku</h4>

                    </div>

                    <form id="formData">

                        <input type="hidden" name="type" value="edit">

                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <div class="card-body">

                            <div class="form-group">

                                <label>Kode Buku</label>

                                <input  id="iJudulBuku" name="judulBuku" type="text" value="{{ $data->id }}" class="form-control" disabled="disabled" >

                            </div>

                            <div class="form-group">

                                <label for="iBarcode">Barcode</label>

                                <input id="iBarcode" name="barcode" type="text" value="{{ $data->barcode }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label for="iBerat">Berat</label>

                                <input id="iBerat" name="berat" type="text" value="{{ $data->berat }}" class="form-control" autofocus required>

                            </div>

                            <!-- <div class="form-group">

                                <label>Kategori</label>

                                <select style="width: 100%" id="iJudulBuku" value="{{ $data->kategori }}" name="id" required></select>

                            </div> -->

                            <div class="form-group">

                                <label>Status</label>

                                <input id="iStatus" name="status" type="text" value="{{ $data->status }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Judul</label>

                                <input id="iJudul" name="judul" type="text" value="{{ $data->judul_buku }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Deskripsi</label>

                                <textarea id="iDiskripsi" name="deskripsi" class="form-control" style="height:200px" autofocus required>{{ $data->diskripsi}}</textarea>

                            </div>

                            <div class="form-group">

                                <label>Penerbit</label>

                                <input id="iPenerbit" name="penerbit" type="text" value="{{ $data->penerbit }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Harga</label>

                                <input id="iHarga" name="harga" type="text" value="{{ $data->harga }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Halaman</label>

                                <input id="iHalaman" name="halaman" type="text" value="{{ $data->halaman }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Ukuran</label>

                                <input id="iUkuran" name="ukuran" type="text" value="{{ $data->ukuran }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Cover</label>

                                <input id="iCover" name="cover" type="text" value="{{ $data->cover }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Penulis</label>

                                <input id="iPenulis" name="penulis" type="text" value="{{ $data->penulis }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>ISBN</label>

                                <input id="iIsbn" name="isbn" type="text" value="{{ $data->isbn }}" class="form-control" autofocus required>

                            </div>

                            <div class="form-group">

                                <label>Tahun</label>

                                <input type="text" class="form-control" id="iTahun"  name="tahun" value="{{ $data->tahun }}">

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

                                    <button type="button" class="btn btn-block btn-outline-danger" onclick="window.location = '{{ url('master/data/buku/list') }}'">

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

<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script type="text/javascript">

 

      



        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        let formData = $('#formData');

        const iPreviewFoto = $('#iPreviewFoto');

        const iPreviewFilename = $('#iPreviewFilename');

        const iFoto = document.getElementById('iFoto');



        const judulBuku = $('#iJudulBuku');

        const barcode = $('#iBarcode');

        const berat = $('#iBerat');

        const status = $('#iStatus');

        const judul = $('#iJudul');

        const penerbit = $('#iPenerbit');

        const harga = $('#iHarga');

        const halaman = $('#iHalaman');

        const ukuran = $('#iUkuran');

        const cover = $('#iCover');

        const penulis = $('#iPenulis');

        const isbn = $('#iIsbn');

        const tahun = $('#iTahun');

        const Deskripsi = $('#iDiskripsi');

    



    



        $(document).ready(function () {

            ClassicEditor

            .create(document.querySelector('#iDiskripsi'))

            .catch( error => {

                console.log(error);

            });



            $('#listTable').DataTable({

                responsive: true

            });



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

                 formData.append('type',"edit");

                 formData.append('fileLocation', iPreviewFilename.val());

                  formData.append('id',judulBuku.val());

                  formData.append('barcode',barcode.val());



       

                  formData.append('berat',berat.val());

                  formData.append('status',status.val());

                  formData.append('judul',judul.val());

                  formData.append('penerbit',penerbit.val());

                  formData.append('harga',harga.val());

                  formData.append('halaman',halaman.val());

                  formData.append('ukuran',ukuran.val());

                  formData.append('cover',cover.val());

                  formData.append('penulis',penulis.val());

                  formData.append('isbn',isbn.val());

                  formData.append('tahun',tahun.val());

                  formData.append('deskripsi',Deskripsi.val());

                $.ajax({

                    url: '{{ url('master/data/buku/submit') }}',

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

                                    window.location = '{{ url('master/data/buku/list') }}';

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

