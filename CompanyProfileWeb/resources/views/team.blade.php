@extends('main.main')

@section('title', 'Heppy Property')

@section('body')


<script>

    jQuery.ajax({
    url: "{{ url('/agen') }}",
    method: 'get',
    success: function(response){
    }
    });
    jQuery.ajax({
      url: "{{ url('dtagen/')}}/"+id,
      method: 'get',
      success: function(response){
      }
    });


</script>

@endsection
