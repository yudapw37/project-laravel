@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Best Seller</h4>
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
       const btnHapus = $('#btnHapus');
      
 

        let dataID;

        $(document).ready(function () {
                    let listTable = $('#listTable').DataTable({

                    scrollX: true,

                    order: [

                        [ 3, 'asc' ],

                    ],

                    ajax: {

                        url: '{{ url('master/data/best-seller/list/data') }}'

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
                            url: '{{ url('master/data/best-seller/hapus') }}',
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
