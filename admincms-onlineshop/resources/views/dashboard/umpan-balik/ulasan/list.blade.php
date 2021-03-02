@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Ulasan</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                        <div class="card-body">
                            <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                    
                            <th>Judul Buku</th>
                                <th>Nama Reviewer</th>
                                <th>Komentar</th>
                                <th>Rating</th>
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
                            <div class="col-sm-12 col-lg-3 mt-2 mt-lg-0">
                                <div class="btn-group btn-block mb-3" role="group" aria-label="Basic example">
                                    <button type="button" id="btnDisable" class="btn btn-danger disabled">
                                        <i class="fas fa-times mr-2"></i>Disable
                                    </button>
                                    <button type="button" id="btnActivate" class="btn btn-success disabled">
                                        <i class="fas fa-check mr-2"></i>Activate
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnDelete" class="btn btn-block btn-danger" disabled>
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" hidden>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                            </div>
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
        const btnClearFilter = $('#btnClearFilter');
        const btnEdit = $('#btnEdit');
        const btnDelete = $('#btnDelete');
        const btnDisable = $('#btnDisable');
        const btnActivate = $('#btnActivate');

        let dataID;

        $(document).ready(function () {
            // let listTable = new Tabulator("#listTable", {
            //     layout: "fitDataStretch",
            //     selectable: 1,
            //     placeholder: 'No Data Available',
            //     pagination: "remote",
            //     ajaxFiltering: true,
            //     ajaxURL: "{{ url('umpan-balik/data/review/list/data') }}",
            //     ajaxConfig: {
            //         method: "POST",
            //         headers: {
            //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            //         }
            //     },
            //     ajaxURLGenerator:function(url, config, params){
            //         return url + "?page=" + params.page;
            //     },
            //     columns: [
            //         {formatter:"rownum",align:"center"},
            //         {
            //             title:"Status",field:"status",width:100,
            //             formatter: function (row) {
            //                 if (row.getData().status === 0) {
            //                     row.getElement().style.backgroundColor = "rgba(6,255,0,0.51)";
            //                     return 'aktif';
            //                 } else {
            //                     row.getElement().style.backgroundColor = "rgba(255,0,9,0.5)";
            //                     return 'nonaktif';
            //                 }
            //             }
            //         },
            //         {title:"Judul Buku ",field:"judulBuku"}, 
            //         {title:"Nama Reviewer ",field:"namaReviewer"}, 
            //         {title:"Text ",field:"text"},
            //         {title:"Ratings ",field:"rating"}, 
            //     ],
            //     rowSelectionChanged:function (data,rows) {
            //         if (data.length === 1) {
            //             btnEdit.removeAttr('disabled');
            //             btnDelete.removeAttr('disabled');
            //             if (data[0].status === 1) {
            //                 btnActivate.addClass('disabled');
            //                 btnDisable.removeClass('disabled');
            //             } else {
            //                 btnActivate.removeClass('disabled');
            //                 btnDisable.addClass('disabled');
            //             }
            //         } else {
            //             btnEdit.attr('disabled',true);
            //             btnDelete.attr('disabled',true);
            //             btnDisable.addClass('disabled');
            //             btnActivate.addClass('disabled');
            //         }
            //     }
            // });

            let listTable = $('#listTable').DataTable({
                scrollX: true,
                order: [
                    [ 3, 'asc' ],
                ],
                ajax: {
                    url: '{{ url('umpan-balik/data/review-tokoh/list/data') }}'
                },
                columns: [
             
                    {data: 'judulBuku'},
                    {data: 'namaReviewer'},
                    {data: 'text'},
                    {data:'rating'},
               
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnEdit.attr('disabled',true);
                    btnHapus.attr('disbled',true);
                    dataID = null;
                    dataUsername = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnEdit.removeAttr('disabled');
                    btnHapus.removeAttr('disabled');
                    let data = listTable.row('.selected').data();
                    dataID = data.id;
                    dataUsername =data.username;
                }
            });


    

            // btnEdit.click(function (e) {
            //     e.preventDefault();
               
            //     window.location = '{{ url('dashboard/master/user-management/edit') }}/'+dataID;
            // });

            btnDelete.click(function (e) {
                e.preventDefault();
               
                Swal.fire({
                    title: 'Delete Ulasan?',
                    text: "Apakah ingin menghapus Ulasan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete Ulasan'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('umpan-balik/data/ulasan/delete') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Ulasan berhasil dihapus',
                                        onClose(modalElement) {
                                            listTable.setData();
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal menghapus ulasan, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'System Error',
                                    text: 'Silahkan hubungi Delevoper',
                                });
                            }
                        });
                    }
                })
            });

            btnDisable.click(function (e) {
                e.preventDefault();
               
                Swal.fire({
                    title: 'Nonaktifkan Ulasan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Nonaktifkan Ulasan'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('umpan-balik/data/ulasan/disable') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Ulasan nonaktif',
                                        onClose(modalElement) {
                                            listTable.setData();
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal reset Password, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'System Error',
                                    text: 'Silahkan hubungi Delevoper',
                                });
                            }
                        });
                    }
                });
            });
            btnActivate.click(function (e) {
                e.preventDefault();
               
                Swal.fire({
                    title: 'Aktifkan Ulasan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aktifkan Ulasan'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('umpan-balik/data/ulasan/activate') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Ulasan telah aktif',
                                        onClose(modalElement) {
                                            listTable.setData();
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal silahkan coba lagi.',
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
