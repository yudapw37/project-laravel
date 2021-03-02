@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Extensi</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                        <div class="card-body">
                            <table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Tipe</th>
                                <th>Text</th>
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
                    [ 1, 'asc' ],
                ],
                ajax: {
                    url: '{{ url('menu/profile/tentang-kami/list/data') }}'
                },
                columns: [
             
                    {data: 'type'},
                    {data: 'text'},

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
                window.location = '{{ url('menu/profile/tentang-kami/edit') }}/'+dataID;
            });

           
        });
    </script>
@endsection
