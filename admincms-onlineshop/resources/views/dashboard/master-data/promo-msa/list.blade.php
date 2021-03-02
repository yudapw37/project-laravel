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
                    
                            <th>Kode Promo</th>
                                <th>Nama Promo</th>
                                <th>Beart Total</th>
                                <th>Harga Total</th>
                                <th>Show Store</th>

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
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                                </div>

                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">

                            <button type="button" id="btnShow" class="btn btn-block btn-success" disabled>

                            Show/Tidak

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
        const btnShow = $('#btnShow');
        let dataID;

        $(document).ready(function () {
  
            let listTable = $('#listTable').DataTable({
                scrollX: true,
                order: [
                    [ 3, 'asc' ],
                ],
                ajax: {
                    url: '{{ url('master/data/promo/data-promo') }}'
                },
                columns: [
             
                    {data: 'code_promo'},
                    {data: 'nama_promo'},
                    {data: 'berat_total'},
                   
                    {data: 'harga_jadi'},
                    {
                        data: 'is_del',
                        render: function (data,type,row,meta) {
                        if(data==0)
                        {
                            return 'Y'
                        }
                        else if(data==1)
                        {
                            return 'N'
                        }
                        else
                        {
                            return 'Failed';
                        }
                          
                        }
                    },
                ],
            });
            $('#listTable tbody').on('click','tr',function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    btnEdit.attr('disabled',true);
                    btnShow.attr('disabled',true);
                    dataID = null;
                   
                } else {
                    listTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    btnEdit.removeAttr('disabled');
                    btnShow.removeAttr('disabled');

                    let data = listTable.row('.selected').data();
                    dataID = data.code_promo;
                 
                }
            });

    

            btnEdit.click(function (e) {
                e.preventDefault();
               
                window.location = '{{ url('master/data/promo/edit') }}/'+dataID;
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
                            url: '{{ url('master/data/flash-sale/hapus') }}',
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

            btnShow.click(function (e) {

            var myHeaders = new Headers(); // Currently empty

            console.log(myHeaders.get('page'));

            e.preventDefault();


            $.ajax({

            url: '{{ url('master/data/promo/show') }}/'+dataID,

            method: 'post',

            data: {id: dataID},

            success: function (response) {

                location.reload();

                // $("#listTable" ).ajax.reload();

                // window.location = '{{ url('master/data/buku')}}';

            }

            });



            });

          
           
        });
    </script>
@endsection
