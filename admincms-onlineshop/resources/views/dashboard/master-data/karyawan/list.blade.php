@extends('dashboard.layout')



@section('content')

    <div class="section-body">

        <div class="row">

            <div class="col-12 col-md-6 col-lg-12">

                <div class="card">

           

                    <div class="card-body pt-0 pb-0">

                        <form id="formFilter">

                        <div class="card-body">

                            <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">

                            <thead>

                            <tr>

                            <th>Status</th>

                                <th>Username</th>

                                <th>Nama</th>

                                <th>Jabatan</th>

                                <th>Kode Admin</th>

                            </tr>

                            </thead>

                        </table>

                    </div>

                        </form>

                    </div>

                    <div class="card-body p-0">

                        <div class="thead-dark table-sm table-striped" id="listTable"></div>

                    </div>

                    <div class="card-body p-0">

                    <small class="mt-5 ">*Ketentuan penulisan KodeAdminTrx = Wirehouse : WH00(angka) ex : WH001 | Sales : (2digitusername)00X ex : TR00X</small>

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

                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>

                                    <i class="fas fa-pencil-alt mr-2"></i>Edit

                                </button>

                            </div>

                            <div class="col-sm-12 col-lg-2 mt-2 mt-lg-0">

                                <button type="button" id="btnPass" class="btn btn-block btn-info" disabled>

                                   Ganti Password

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

        const btnPass = $('#btnPass');

        const btnReset = $('#btnReset');

        const btnDisable = $('#btnDisable');

        const btnActivate = $('#btnActivate');



        let dataID;



        $(document).ready(function () {    

            let listTable = $('#listTable').DataTable({

                scrollX: true,

                order: [

                    [ 3, 'asc' ],

                ],

                ajax: {

                    url: '{{ url('master/data/karyawan/list/data') }}'

                },

                columns: [

                    {

                        data: 'status',

                        render: function (data,type,row,meta) {

                        if(data==0)

                        {

                            return 'Aktif'

                        }

                        else if(data==1)

                        {

                            return 'NonAktif'

                        }

                        else

                        {

                            return 'Failed';

                        }

                          

                        }

                    },

                    {data: 'username'},

                    {data: 'nama'},

                    {data: 'jabatan'},

                    {data: 'kodeAdminTrx'},

                ],

            });

            $('#listTable tbody').on('click','tr',function () {

                if ($(this).hasClass('selected')) {

                    $(this).removeClass('selected');

                    btnEdit.attr('disabled',true);

		    btnPass.attr('disabled',true);

                    dataID = null;

                    dataUsername = null;

                } else {

                    listTable.$('tr.selected').removeClass('selected');

                    $(this).addClass('selected');

                    btnEdit.removeAttr('disabled');

		    btnPass.removeAttr('disabled');

                    let data = listTable.row('.selected').data();

                    dataID = data.id;

                    dataUsername =data.username;

                }

            });

   

            btnEdit.click(function (e) {

                e.preventDefault();

              

                window.location = '{{ url('master/data/karyawan/edit') }}/'+dataUsername;

            });


	   btnPass.click(function (e) {

                e.preventDefault();       

                window.location = '{{ url('master/data/karyawan/password') }}/'+dataUsername;

            });




            btnPass.click(function (e) {

                e.preventDefault();

  

                window.location = '{{ url('master/data/karyawan/password') }}/'+dataUsername;

            });



            btnReset.click(function (e) {

                e.preventDefault();

               

                Swal.fire({

                    title: 'Reset password?',

                    text: "Password akan sama seperti username",

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Reset Password'

                }).then((result) => {

                    if (result.value) {

                        $.ajax({

                            url: '{{ url('dashboard/master/user-management/reset-password') }}',

                            method: 'post',

                            data: {username: dataUsername},

                            success: function (response) {

                                if (response === 'success') {

                                    Swal.fire({

                                        icon: 'success',

                                        title: 'Berhasil',

                                        text: 'Password berhasil direset',

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

                                    text: 'Silahkan hubungi Developer',

                                });

                            }

                        });

                    }

                })

            });



            btnDisable.click(function (e) {

                e.preventDefault();

              

                Swal.fire({

                    title: 'Nonaktifkan user ini?',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Nonaktifkan User'

                }).then((result) => {

                    if (result.value) {

                        $.ajax({

                            url: '{{ url('master/data/karyawan/disable') }}',

                            method: 'post',

                            data: {id: dataID},

                            success: function (response) {

                                if (response === 'success') {

                                    Swal.fire({

                                        icon: 'success',

                                        title: 'Berhasil',

                                        text: 'User nonaktif',

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

                                    text: 'Silahkan hubungi Developer',

                                });

                            }

                        });

                    }

                });

            });

            btnActivate.click(function (e) {

                e.preventDefault();

            

                Swal.fire({

                    title: 'Aktifkan user ini?',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Aktifkan User'

                }).then((result) => {

                    if (result.value) {

                        $.ajax({

                            url: '{{ url('master/data/karyawan/activate') }}',

                            method: 'post',

                            data: {id: dataID},

                            success: function (response) {

                                if (response === 'success') {

                                    Swal.fire({

                                        icon: 'success',

                                        title: 'Berhasil',

                                        text: 'User telah aktif',

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

