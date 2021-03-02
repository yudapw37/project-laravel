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
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                <button type="button" id="btnHapus" class="btn btn-block btn-danger" disabled>
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                                </div>
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                <button type="button" id="btnEdit" class="btn btn-block btn-primary" disabled>
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

            formFilter.submit(function (e) {
                e.preventDefault();
                let kolom = $('#fKolom');
                let value = $('#fValue');
                listTable.setFilter(kolom.val(),'like',value.val());
            });

            btnEdit.click(function (e) {
                e.preventDefault();
              
                window.location = '{{ url('umpan-balik/data/review-tokoh/edit') }}/'+dataID;
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
                            url: '{{ url('umpan-balik/data/review-tokoh/delete') }}',
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
