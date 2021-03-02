@extends('main.main')

@section('title', 'Heppy Property')

@section('body')


<script>

jQuery.ajax({
      url: "{{ url('dtstore/')}}/"+id,
      method: 'get',
      success: function(response){
      }
    });


</script>

@endsection
