@extends('dashboard.layout')

@section('page title','WEB Component Our Team - Edit Data')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <input type="hidden" value="{{$dataMst->id}}" name="id" id="iID">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="uploadGambar"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <img class="card-img-top" src="{{ url($dataMst->gambar_buku) }}"  alt="IMAGE">
                                                <div class="card-body" style="background-image: linear-gradient(to right, #ffe200,whitesmoke)">
                                                    <strong>DEFAULT</strong>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($dataTrn as $i)
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <img class="card-img-top"  src="{{ url($i->gambar) }}" alt="IMAGE">
                                                    <div class="card-body">
                                                        <button class="btn btn-block btn-sm btn-danger" >
                                                            <i class="fas fa-times mr-2"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                   

                                    <div class="form-group">
                                        <label for="iNamaRumah">Judul Buku</label>
                                        <input class="form-control" id="iNamaRumah" value="{{$dataMst->judul_buku}}" readonly>
                                    </div>

                  

                                
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2">
                                    <a href="{{ url('master/data/buku/list') }}" class="btn btn-outline-danger btn-block">
                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/filepond-master/filepond.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/filepond-master/filepond-plugin-image-preview.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendors/filepond-master/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('vendors/filepond-master/filepond-plugin-image-crop.js') }}"></script>
    <script src="{{ asset('vendors/filepond-master/filepond-plugin-image-resize.js') }}"></script>
    <script src="{{ asset('vendors/filepond-master/filepond-plugin-image-transform.js') }}"></script>
    <script src="{{ asset('vendors/filepond-master/filepond.min.js') }}"></script>

    <script>
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };

        const iID = document.getElementById('iID');
       
        const iNamaRumah = document.getElementById('iNamaRumah');
      
        const iDetail = document.getElementById('iDetail');
        const iHarga = document.getElementById('iHarga');

  
        
        const btnUpload = document.getElementById('btnUpload');

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageCrop,
            FilePondPluginImageTransform,
        );
        FilePond.setOptions({
            allowImageTransform: true,
            allowImageResize: true,
            imageResizeMode: 'cover',
            imageResizeTargetHeight: 2000,
            imageResizeTargetWidth: 2000,
            imageTransformOutputMimeType: 'image/jpeg',
            allowImagePreview: true,
            imagePreviewMinHeight: 190,
            imagePreviewMaxHeight: 200,
            allowMultiple: true,
            allowDrop: true,
            instantUpload: true,
            iconProcess: '<svg></svg>',
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    formData.append('id',iID.value);

                    const request = new XMLHttpRequest();
                    request.open('POST','{{ url('master/data/buku/submitCollection') }}');
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };

                    request.onload = function () {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                            console.log(request.responseText);
                  if (response === 'success') {
                        window.location.reload();
                    }
                        } else {
                            error('gagal');
                            console.log(request.responseText);

                        }
                    };

                    request.send(formData);

                    return {
                        abort: () => {
                            request.abort();

                            abort();
                        }
                    }
                }
            }
        });
        const DOMuploadGambar = document.getElementById('uploadGambar');
        const uploadGambar = FilePond.create( DOMuploadGambar );

        function deleteImage(id) {
            $.ajax({
                url: '{{ url('master/data/buku/hapus') }}',
                method: 'post',
                data: { id: id },
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        window.location.reload();
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function (event) {
        })
    </script>
@endsection
