@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Data Buku - Kategori</h4>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <form id="formFilter">
                        <div class="card-body">

<table id="listTable" class="table table-striped table-bordered display nowrap" style="width: 100%">

<thead>

<tr>

<th>Kode Buku</th>

    <th>Judul Buku</th>
    
    <th>Barcode</th>

    <th>Type Buku</th>


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
                                <button type="button" id="btnShow" class="btn btn-block btn-primary" disabled>
                                    <i class="fas fa-pencil-alt mr-2"></i>REGUER/PROMO
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
        const btnShow = $('#btnShow');
        const btnHapus = $('#btnHapus');
      
 

        let dataID;

        $(document).ready(function () {
                        let listTable = $('#listTable').DataTable({

                        scrollX: true,

                        order: [

                            [ 3, 'asc' ],

                        ],

                        ajax: {

                            url: '{{ url('master/data/buku-tipe-transaksi/list/data') }}'

                        },

                        columns: [



                            {data: 'id'},

                            {data: 'judul_buku'},
                            {data: 'barcode'},

                            {
                        data: 'jenis_pre_order_buku',
                        render: function (data,type,row,meta) {
                        if(data==0)
                        {
                            return 'REGULER'
                        }
                        else if(data==1)
                        {
                            return 'PRE ORDER'
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

                            btnShow.attr('disabled',true);
                          
                            dataID = null;

                            dataUsername = null;

                        } else {

                            listTable.$('tr.selected').removeClass('selected');

                            $(this).addClass('selected');

                            btnShow.removeAttr('disabled');
                 

                            let data = listTable.row('.selected').data();

                            dataID = data.id;

                            dataUsername =data.username;

                        }

                        });


                        btnShow.click(function (e) {
                                    e.preventDefault();
                                    $.ajax({

                                url: '{{ url('master/data/buku-tipe-transaksi/edit') }}/'+dataID,

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
