@extends('main.main')

@section('title', 'Heppy Property')

@section('body')

<script>

    jQuery.ajax({
      url: "{{ url('dtabout/')}}/"+id,
      method: 'get',
      success: function(response){
      }
    });

    jQuery.ajax({
      url: "{{ url('visimisi/')}}",
      method: 'get',
      success: function(response){
      }
    });


</script>

@endsection
