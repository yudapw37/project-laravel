@extends('main.main')

@section('title', 'Heppy Property')

@section('body')

<script>


    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    });
    jQuery.ajax({
    url: "{{ url('/store') }}",
    method: 'post',
    data: {
            idkota: idkota,
            idarea: idarea
            },
    success: function(response){
    }
    });

</script>

@endsection
