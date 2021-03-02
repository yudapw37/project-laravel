@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Syncronise Propinsi</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                            <div class="row justify-content-end">
                         
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
                                    <button type="button" class="btn btn-warning btn-block" id="iSyncronise" ><i class="fas fa-sync-alt mr-2"></i>Syncronise Prov</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <div class="thead-dark table-sm table-striped" id="listTable"></div>
                    

                        <div  class="d-flex justify-content-center d-none mt-5">
                        <div id="loading" class="spinner-border d-none text-danger"  style="width: 7rem; height: 7rem;" role="status">
                            <span class="sr-only">Loading...</span> 
                        </div>
                        
                        </div>
                        <div  class="d-flex justify-content-center d-none">
                        <p class="d-none text-danger mt-3 mb-3"  id="textload">Load Data </p>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
            
                        <div class="row justify-content-end">
                               
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>
                                    <i class="fas fa-sync-alt mr-2"></i>Syncronise City
                                 
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
        const iSyncronise = $('#iSyncronise');
        const btnSearch = $('#btnSearch');
        const btnEdit = $('#btnEdit');
        const btnHapus = $('#btnHapus');
        let dataID;
        let lst = $('#listTable');
        let loading = $('#loading');
        let textload = $('#textload');

        $(document).ready(function () {

            let listTable = new Tabulator("#listTable", {
            layout: "fitDataStretch",
                selectable: 1,
                placeholder: 'No Data Available',
                pagination: "remote",
                ajaxFiltering: true,
                ajaxURL: "{{ url('MD-synchronize/list/data') }}",
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    }
                },
                ajaxURLGenerator:function(url, config, params){
                    return url + "?page=" + params.page;
                },
                groupBy: "province",
                columns: [
                    {formatter:"rownum",align:"center"},                   
                    {title:"ID ",field:"city_id"}, 
                    {title:"Provinsi ",field:"kota"}, 
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



            iSyncronise.click(function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Syncrone Data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                }).then((result) => {
                    if (result.value) {
                        loading.removeClass('d-none');
                        lst.addClass('d-none');
                        textload.removeClass('d-none');


                        $.ajax({
                    
                            url:  '{{ url('MD-synchronize/submit') }}',
                            method: 'get',
                      
                            success: function (response) {
                                if (response === 'success') {
                                    loading.addClass('d-none');
                                    lst.removeClass('d-none');
                                    textload.addClass('d-none');
                                    let timerInterval
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Berhasil syncrone data',
                                        onClose(modalElement) {
                                            listTable.setData();
                                            console.log(listTable.setData());
                                        }
                                    });
                                } else {
                                    console.log(response);
                                    loading.addClass('d-none');
                                    lst.removeClass('d-none');
                                    textload.addClass('d-none');
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal syncrone data, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                loading.addClass('d-none');
                                lst.removeClass('d-none');
                                textload.addClass('d-none');
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

            btnEdit.click(function (e) {
                e.preventDefault();
                let id = listTable.getSelectedData()[0].id;
                Swal.fire({
                    title: 'Syncrone Data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                }).then((result) => {
                    if (result.value) {
                        loading.removeClass('d-none');
                        lst.addClass('d-none');
                        textload.removeClass('d-none');
                        $.ajax({
                            url: '{{ url('MD-synchronizee/syncrone') }}',
                            method: 'post',
                            data: {id: id},
                            success: function (response) {
                                if (response === 'success') {
                                    loading.addClass('d-none');
                                    lst.removeClass('d-none');
                                    textload.addClass('d-none');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Berhasil syncrone data',
                                        onClose(modalElement) {
                                            listTable.setData();
                                        }
                                    });
                                } else {
                                console.log(response);
                                loading.addClass('d-none');
                                lst.removeClass('d-none');
                                textload.addClass('d-none');
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal',
                                        text: 'Gagal syncrone data, silahkan coba lagi.',
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(response);
                                loading.addClass('d-none');
                                lst.removeClass('d-none');
                                textload.addClass('d-none');
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
