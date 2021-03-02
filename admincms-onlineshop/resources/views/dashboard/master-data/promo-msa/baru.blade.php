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
                        <h4>Tambah Data Promo - MSA</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                        <div class="row">
                                <div style="max-width:370px" class="col-lg-6">
                                   
                                    <img  src= "{{ asset('assets/img/avatar/avatar-1.png') }}" class="img-fluid" id="iPreviewFoto">
                                </div>
                             
                                <div class="col-lg">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iFoto" name="foto">
                                        <label class="custom-file-label" for="iFoto" id="iPreviewFilename">Pilih Foto</label>
                                    </div>
                                    <!-- <small class="mt-5">Ukuran maksimal 500kb.</small> -->
                                    <small class="mt-5">Ukuran Gambar 350 x 350 pixel | Format yang diperbolehkan .jpeg atau .jpg.</small>
                                </div>
                                <div class="form-group">
                                <label for="iNamaPromo">Nama Promo</label>
                                <input id="iNamaPromo" name="namaPromo" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iHargaJadi">Harga Jadi</label>
                                <input id="iHargaJadi" name="iHargaJadi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iTanggal">Tanggal</label>
                                <input type="text" class="form-control" id="iTanggal" name="tanggal" >
                            </div>
                     
                            </div>
                            </div>
                            <h3> <label  for="iHargaBuku">Input Data Buku</label></h3>  
                   
                   <div class="form-group">
                       <label for="iBuku">Cari Buku</label>
                       <select style="width: 100%" id="iBuku" name="buku"></select>
                   </div>   
                   <div class="form-group">
                   <div class="w-100">
                                    <button type="button" class="float-right btn btn-primary" onclick='tambahBuku()'><i class="fas fa-plus mr-2"></i>Tambahkan</button>
                                </div>
                   </div>
                            </div>
                   
            
                     
                        
                        
                        
                        
                                       <hr>
                            <h3> <label class="m-4" for="iHargaBuku">List Data Buku</label></h3>  
                            <div class="form-group">
                            <div class="card-body">
                            <table id="listTable2" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                    
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Berat</th>
                                <th>Harga</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            </table>
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
        let iNamaPromo = $('#iNamaPromo');
        let iHargaJadi = $('#iHargaJadi');
        var idBuku;
        const iPreviewFoto = $('#iPreviewFoto');
        const iPreviewFilename = $('#iPreviewFilename');
        const iFoto = document.getElementById('iFoto');
        let iBuku= $('#iBuku');
        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });



        $(document).ready(function () {
         
            iBuku.select2({
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
            iBuku.change(function(){
                idBuku = $(this).val();
                
            })

            // list 2
            let listTable2 = $('#listTable2').DataTable({
                scrollX: true,
                order: [
                    [ 3, 'asc' ],
                ],
                ajax: {
                    url: '{{ url('master/data/promo/list-outstanding') }}'
                },
                columns: [
                    {data: 'code_buku'},
                    {data: 'judul_buku'},
                    {data: 'berat'},
                    {data: 'harga'},
                    {
                        data: 'id',
                        render: function (data,type,row,meta) {
                      
                            return   '<center><button type="button"  class="btn btn-danger mx-2" onclick="deleteBuku()"><i class="fas fa-trash mr-2"></i>Hapus</button></center>'
                
                          
                        }
                    },
               
                ],
            });
            $('#listTable2 tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
         

                    dataID = null;
                    dataUsername = null;
                } else {
                    listTable2.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
    

                    let data = listTable2.row('.selected').data();
                    dataID = data.id;
            
                }
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




            iBuku.select2({
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

            formData.submit(function (e) {
                e.preventDefault();
                let formData = new FormData();
                 formData.append('foto',iFoto.files[0]);
                 formData.append('type',"baru");
                 formData.append('namaPromo', iNamaPromo.val());
        
                 formData.append('hargaJadi',iHargaJadi.val());
                 formData.append('tanggal',iTanggal.val());
              
                $.ajax({
                    url: '{{ url('master/data/promo/submit') }}',
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
        });
        function tambahBuku() {
             
                $.ajax({
                    url: '{{ url('master/data/promo/add') }}',
                    method: 'post',
                    data: {id:idBuku},
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location = '{{ url('master/data/promo') }}';
                                }
                            });
                        } 
                        else if(response == 'false')
                        {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Buku sudah ada di list',
                                text: response,
                            });
                        }
                        else {
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
            };
            function deleteBuku() {
             
             $.ajax({
                 url: '{{ url('master/data/promo/delete') }}',
                 method: 'post',
                 data: {id:dataID},
                 success: function (response) {
                     if (response === 'success') {
                         Swal.fire({
                             icon: 'success',
                             title: 'Data Tersimpan',
                             showConfirmButton: false,
                             timer: 1000,
                             onClose: function () {
                                 window.location = '{{ url('master/data/promo') }}';
                             }
                         });
                     } 
                     else if(response == 'false')
                     {
                         console.log(response);
                         Swal.fire({
                             icon: 'warning',
                             title: 'Data Buku sudah ada di list',
                             text: response,
                         });
                     }
                     else {
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
         };
    </script>
@endsection
