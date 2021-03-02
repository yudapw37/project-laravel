@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kode Expedisi</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                        <input type="hidden" name="username" value="{{ request()->session()->get('username') }}">
                        
                            <div class="form-group">
                                <label for="iExpedisi">Expedisi</label>
                                <input id="iExpedisi" name="iExpedisi" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="iTotalBerat">Total Berat</label>
                                <input id="iTotalBerat" name="iTotalBerat" type="text" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Total Harga</label>
                                <input id="iTotalHarga" name="iTotalHarga" type="text" class="form-control" autofocus required>
                            </div>
                         
                       
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="row justify-content-end">
                              
                                <div class="col-sm-12 col-lg-2 mt-2 mb-lg-0">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let formData = $('#formData');
        let iJabatan = $('#iJabatan');
        let iJudulBuku = $('#iJudulBuku');

        const iTanggal = $('#iTanggal').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });


        $(document).ready(function () {
            $('#listTable').DataTable({
                responsive: true
            });

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('validasi/data/expedisi/submit') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Tersimpan',
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: function () {
                                    window.location = '{{ url('validasi/data/expedisi') }}';
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Gagal Tersimpan',
                                text: response,
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Tersimpan',
                            text: response,
                        });
                    }
                })
            })
        });
    </script>
@endsection
