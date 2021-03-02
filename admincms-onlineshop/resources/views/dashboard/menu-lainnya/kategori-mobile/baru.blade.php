@extends('dashboard.layout')

@section('page title','WEB Component Image Slider')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <!-- <div class="row">
                <div class="col-lg text-right">
                <small class="mt-5 ">Ukuran Gambar 1200 x 900 pixel | Format yang diperbolehkan .jpeg atau .jpg.</small>
                    <button class="btn btn-success" id="btnUpload">Upload Gambar</button>
                    
                </div>
                
            </div>
             -->

            <div class="row mt-3">
                <div class="col-lg">

                    <div class="row justify-content-md-center" id="contentArea"></div>

                    <div id="cardComponent" class="card card-success card-outline d-none">
                    
                        <!-- <div class="card-header">
                            <h3 class="card-title">UPLOAD Image</h3>
                            <div class="card-tools">
                                <button type="button" style="border-radius:5px!important;background:red" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: white;"></i>
                                </button>
                            </div>

                        </div> -->
                        
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="section" value="about-us" readonly>

                            <div class="row">
                                <div class="col-lg-12">
                                    <input id="cardUpload_uploadFile" type="file">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/filepond-master/filepond.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendors/filepond-master/filepond.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const editorContainer = document.getElementById('inputText');
        const uploadArea = document.getElementById('cardUpload_uploadFile');

        const btnClose = $('#btnClose');
        const btnUpload = $('#btnUpload');

        const contentArea = $('#contentArea');
        const cardComponent = $('#cardComponent');
        var idX;

 

        function reloadData() {
            var baseUrl ='http://admin.aqwam.biz';
            let domain = '{{ url('/') }}';
            $.ajax({
                url: '{{ url('Menu-lainnya/data/kategori-mobile/list') }}',
                method: 'post',
                success: function (response) {
                    let html = '';
                    let data = JSON.parse(response);
                    data.forEach(function (v,i) {
                        html += '<div class="col-lg-4">' +
                            '<div class="card">' +
                            '<img src="'+baseUrl+'/'+v['filename']+'" class="card-img-top" alt="header" style="width: auto; height: 250px;">' +
                            '<div class="card-footer">' +
                            '<button type="submit" id="btnUpload" class="btn btn-block btn-outline-danger" onclick="changeImage(\''+v['id']+'\')">Change</button>' +
                            '</div></div></div>';
                    });
                    contentArea.html(html);
                }
            })
        }

        function changeImage(id) {
            console.log(id);
                idX=id;

                cardComponent.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: cardComponent.offset().top
                }, 500);
        }

        $(document).ready(function () {
            
        
            reloadData();

            FilePond.create( uploadArea );
            FilePond.setOptions({
                allowImageTransform: true,
                allowImageResize: true,
                imageResizeMode: 'cover',
                imageResizeTargetHeight: 700,
                imageResizeTargetWidth: 1200,
                imageTransformOutputMimeType: 'image/jpeg',
                allowMultiple: true,
                allowDrop: true,
                // instantUpload: false,
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        formData.append('idX',idX);
                        const request = new XMLHttpRequest();
                        request.open('POST','{{ url('Menu-lainnya/data/kategori-mobile/update') }}');
                        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };

                        request.onload = function () {
                            if (request.status >= 200 && request.status < 300) {
                                load(request.responseText);
                                console.log(request.responseText);
                                // reloadData();
                            } else {
                                error('gagal');
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

            
            btnClose.click(function (e) {
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 500, function () {
                    reloadData();
                    cardComponent.addClass('d-none');
                });
            });

        });
    </script>
@endsection
