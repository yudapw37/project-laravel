@extends('dashboard.layout')



@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kategori</h4>
                    </div>
                    <form id="formData">
                        <input type="hidden" name="type" value="baru">
                        <div class="card-body">
                         
                        <div class="form-group">
                                <label for="iKategoriPromo">Kategori Promo</label>
                                <select style="width: 100%" id="iKategoriPromo" name="kategori" required></select>
                        </div>
                        <div class="form-group">
                                <label for="iPromo">Promo</label>
                                <select style="width: 100%" id="iPromo" name="promo" required></select>
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
        let iPromo= $('#iPromo');
        let iKategoriPromo= $('#iKategoriPromo');

        $(document).ready(function () {

            iPromo.select2({
                ajax: {
                    url: '{{ url('promo') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });

            iKategoriPromo.select2({
                ajax: {
                    url: '{{ url('kategoriPromo') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        }
                    }
                }
            });
            $('#listTable').DataTable({
                responsive: true
            });

         

            formData.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('master/data/kategori-promo-trn/submit') }}',
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
                                    window.location = '{{ url('master/data/kategori-promo-trn') }}';
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
