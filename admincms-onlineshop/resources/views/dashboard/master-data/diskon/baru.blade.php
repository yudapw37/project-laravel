@extends('dashboard.layout')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Master Diskon</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                        <div class="form-group">
                                <label for="iTipe">Tipe </label>
                                <select class="form-control" id="iTipe" name="tipe">
                                    <option value="0">Customer</option>
                                    <option value="1">Reseller</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="iDiskon">Diskon</label>
                                <input id="iDiskon" name="diskon" type="text" class="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                                <label for="iMinimalNominal">Minimal Nominal</label>
                                <input id="iMinimalNominal" name="minimalNominal" type="text" class="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                                <label for="iMaximalNominal">Maximal Nominal</label>
                                <input id="iMaximalNominal" name="maximalNominal" type="text" class="form-control" autofocus required>
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
        let iDiskon= $('#iDiskon');

        $(document).ready(function () {
         

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('dashboard/master/diskon/submit') }}',
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
                                    window.location = '{{ url('dashboard/master/diskon') }}';
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
