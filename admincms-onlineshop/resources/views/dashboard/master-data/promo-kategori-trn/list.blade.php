@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Data Promo - TRN</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                            <div class="row justify-content-end">
                         
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control phone-number" id="fValue">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                                    <button type="button" class="btn btn-warning btn-block" id="btnSearch">Cari</button>
                                </div>
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
                                    <button type="button" id="btnHapus" class="btn btn-danger disabled">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>
                           
                            </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
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
        const btnSearch = $('#btnSearch');
        const btnEdit = $('#btnEdit');
        const btnHapus = $('#btnHapus');
        let dataID;

        $(document).ready(function () {
            let listTable = new Tabulator("#listTable", {
                layout: "fitDataStretch",
                selectable: 1,
                placeholder: 'No Data Available',
                pagination: "remote",
                ajaxFiltering: true,
                ajaxURL: "{{ url('master/data/kategori-promo-trn/list/data') }}",
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    }
                },
                ajaxURLGenerator:function(url, config, params){
                    return url + "?page=" + params.page;
                },
           
                columns: [
                    {formatter:"rownum",align:"center"},
                    {
                        title:"Status",field:"status",width:100,
                        formatter: function (row) {
                            if (row.getData().status === 0) {
                                row.getElement().style.backgroundColor = "rgba(6,255,0,0.51)";
                                return 'ACTIVE';
                            } else {
                                row.getElement().style.backgroundColor = "rgba(225,0,9,0.5)";
                                return 'DISABLE';
                            }
                        }
                    },
                    {title:"Kategori",field:"kategori"}, 
                    {title:"Code Promo",field:"code_promo"}, 
                    {title:"Nama Promo",field:"nama_promo"}, 
                   
                ],
                rowSelectionChanged:function (data,rows) {
                    if (data.length === 1) {
                        btnEdit.removeAttr('disabled');
                        btnHapus.removeAttr('disabled');
                      
                    } else {
                        btnEdit.attr('disabled',true);
                        btnHapus.attr('disabled',true);
                   
                    }
                }
            });

            formFilter.submit(function (e) {
                e.preventDefault();
                let kolom = $('#fKolom');
                let value = $('#fValue');
                listTable.setFilter(kolom.val(),'like',value.val());
            });

            btnSearch.click(function (e) {
                e.preventDefault();
                listTable.clearFilter();
            });

            btnEdit.click(function (e) {
                e.preventDefault();
                let id = listTable.getSelectedData()[0].id;
                window.location = '{{ url('master/data/kategori-promo-trn/edit') }}/'+id;
            });

            btnHapus.click(function (e) {
                e.preventDefault();
                let id = listTable.getSelectedData()[0].id;
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
                            url: '{{ url('master/data/kategori-promo-trn/delete') }}',
                            method: 'post',
                            data: {id: id},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Berhasil menghapus data',
                                        onClose(modalElement) {
                                            listTable.setData();
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

            //   btnDisable.click(function (e) {
            //     e.preventDefault();
            //     let id = listTable.getSelectedData()[0].id;
            //     Swal.fire({
            //         title: 'Nonaktifkan data ini?',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Nonaktifkan Data'
            //     }).then((result) => {
            //         if (result.value) {
            //             $.ajax({
            //                 url: '{{ url('master/data/promo-kategori/disable') }}',
            //                 method: 'post',
            //                 data: {id: id},
            //                 success: function (response) {
                            
            //                     if (response == 'success') {
            //                         Swal.fire({
            //                             icon: 'success',
            //                             title: 'Berhasil',
            //                             text: 'Data Tidak Aktif',
            //                             onClose(modalElement) {
            //                                 listTable.setData();
            //                             }
            //                         });
            //                     } else {
            //                         console.log(response);
            //                         Swal.fire({
            //                             icon: 'warning',
            //                             title: 'Gagal',
            //                             text: 'Gagal, silahkan coba lagi.',
            //                             onClose(modalElement) {
            //                                 listTable.setData();
            //                             }
            //                         });
            //                     }
            //                 },
            //                 error: function (response) {
            //                     console.log(response);
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'System Error',
            //                         text: 'Silahkan hubungi Developer',
            //                     });
            //                 }
            //             });
            //         }
            //     });
            // });
            // btnActivate.click(function (e) {
            //     e.preventDefault();
            //     let id = listTable.getSelectedData()[0].id;
            //     Swal.fire({
            //         title: 'Aktifkan data ini?',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Aktifkan Data'
            //     }).then((result) => {
            //         if (result.value) {
            //             $.ajax({
            //                 url: '{{ url('master/data/promo-kategori/activate') }}',
            //                 method: 'post',
            //                 data: {id: id},
            //                 success: function (response) {
            //                     if (response == 'success') {
            //                         Swal.fire({
            //                             icon: 'success',
            //                             title: 'Berhasil',
            //                             text: 'Data telah aktif',
            //                             onClose(modalElement) {
            //                                 listTable.setData();
            //                             }
            //                         });
            //                     } else {
            //                         console.log(response);
            //                         Swal.fire({
            //                             icon: 'warning',
            //                             title: 'Gagal',
            //                             text: 'Gagal, silahkan coba lagi.',
            //                             onClose(modalElement) {
            //                                 listTable.setData();
            //                             }
            //                         });
            //                     }
            //                 },
            //                 error: function (response) {
            //                     console.log(response);
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'System Error',
            //                         text: 'Silahkan hubungi Developer',
            //                     });
            //                 }
            //             });
            //         }
            //     });
            // });  
        });
    </script>
@endsection
