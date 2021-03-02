@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List New Product Home Store</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                        <div class="card-body">
                            <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                            <th>Kode Buku</th>

                            <th>Judul Buku</th>

                            <th>Harga Buku</th>

                            <th>Harga Jadi</th>
                           
                            </tr>
                            </thead>
                        </table>
                    </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <div class="thead-dark table-sm table-striped" id="listTable"></div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
            
                        <div class="row justify-content-end">
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                <button type="button" id="btnHapus" class="btn btn-block btn-danger" disabled>
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                                </div>
                                <!-- <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                                </div> -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        const formFilter = $('#formFilter');
        const btnSearch = $('#btnSearch');
        const btnEdit = $('#btnEdit');
        const btnHapus = $('#btnHapus');
        let dataID;

        $(document).ready(function () {
            // let listTable = new Tabulator("#listTable", {
            //     layout: "fitDataStretch",
            //     selectable: 1,
            //     placeholder: 'No Data Available',
            //     pagination: "remote",
            //     ajaxFiltering: true,
            //     ajaxURL: "{{ url('master/data/new-product/list/data') }}",
            //     ajaxConfig: {
            //         method: "POST",
            //         headers: {
            //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            //         }
            //     },
            //     ajaxURLGenerator:function(url, config, params){
            //         return url + "?page=" + params.page;
            //     },
            //     // groupBy: "kategori",
            //     columns: [
            //         {formatter:"rownum",align:"center"},
            //         {title:"ID Buku",field:"id_buku"},
            //         {title:"Judul Buku ",field:"judul_buku"}, 
            //         {title:"Harga Buku ",field:"harga_buku"},
            //         {title:"Harga Promo ",field:"harga_jadi"}, 
            //     ],
            //     rowSelectionChanged:function (data,rows) {
            //         if (data.length === 1) {
            //             btnEdit.removeAttr('disabled');
            //             btnHapus.removeAttr('disabled');
                      
            //         } else {
            //             btnEdit.attr('disabled',true);
            //             btnHapus.attr('disabled',true);
                   
            //         }
            //     }
            // });

                                let listTable = $('#listTable').DataTable({

                    scrollX: true,

                    order: [

                        [ 3, 'asc' ],

                    ],

                    ajax: {

                        url: '{{ url('master/data/new-product/list/data') }}'

                    },

                    columns: [



                        {data: 'id_buku'},

                        {data: 'judul_buku'},
                        {data: 'harga_buku'},

                        {data: 'harga_jadi'},



                    ],

                    });

                    $('#listTable tbody').on('click','tr',function () {

                    if ($(this).hasClass('selected')) {

                        $(this).removeClass('selected');
                        btnHapus.attr('disabled',true);
                        dataID = null;

                        dataUsername = null;

                    } else {

                        listTable.$('tr.selected').removeClass('selected');

                        $(this).addClass('selected');
                        btnHapus.removeAttr('disabled');



                        let data = listTable.row('.selected').data();

                        dataID = data.id;

                        dataUsername =data.username;

                    }

                    });

        
            btnHapus.click(function (e) {
                e.preventDefault();
               
                Swal.fire({
                    title: 'Hapus Data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('master/data/new-product/hapus') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Berhasil menghapus data',
                                        onClose(modalElement) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal menghapus data, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'System Error',
                                    text: 'Silahkan hubungi Developer',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
