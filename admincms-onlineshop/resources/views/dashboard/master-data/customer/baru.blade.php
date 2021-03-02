@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Data Customer</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                        <div class="card-body">
                            <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                            <th>Status</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telephone</th>
                                <th>Diskon</th>
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
                                    <button type="button" id="btnCustomer" class="btn btn-danger disabled">
                                        <i class="fas fa-user mr-2"></i>Customer
                                    </button>
                                    <button type="button" id="btnReseller" class="btn btn-success disabled">
                                        <i class="fas fa-users mr-2"></i>Reseller
                                    </button>
                                </div>
                            </div>
                           
                            <!-- <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">
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
        const btnClearFilter = $('#btnClearFilter');
        const btnEdit = $('#btnEdit');
        const btnDelete = $('#btnDelete');
        const btnCustomer = $('#btnCustomer');
        const btnReseller = $('#btnReseller');

        let dataID;

        $(document).ready(function () {

            let listTable = $('#listTable').DataTable({
                scrollX: true,
                order: [
                    [ 3, 'asc' ],
                ],
                ajax: {
                    url: '{{ url('MD-customer/list/data') }}'
                },
                columns: [
                    {
                        data: 'jenis_reseller',
                        render: function (data,type,row,meta) {
                        if(data==0)
                        {
                            return 'Customer'
                        }
                        else if(data==1)
                        {
                            return 'Reseller'
                        }
                        else
                        {
                            return 'Failed';
                        }
                          
                        }
                    },
                    {data: 'nama'},
                    {data: 'alamat'},
                    {data: 'telephone'},
                    {data: 'diskon'},
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnEdit.attr('disabled',true);

                    dataID = null;
                    dataUsername = null;
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnEdit.removeAttr('disabled');

                    let data = listTable.row('.selected').data();
                    dataID = data.id;
                    dataUsername =data.username;
                }
            });

            btnEdit.click(function (e) {
                e.preventDefault();
               
                window.location = '{{ url('MD-customer/edit') }}/'+dataID;
            });

         

            btnCustomer.click(function (e) {
                e.preventDefault();
       
                Swal.fire({
                    title: 'Tipe Customer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Customer'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('MD-customer/customer') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Customer',
                                        onClose: function () {
                                            window.location.reload();
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
            btnReseller.click(function (e) {
                e.preventDefault();
            
                Swal.fire({
                    title: 'Tipe Reseller',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Reseller'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('MD-customer/reseller') }}',
                            method: 'post',
                            data: {id: dataID},
                            success: function (response) {
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Reseller',
                                        onClose: function () {
                                            window.location.reload();
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
