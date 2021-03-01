@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')
<div class="container container-240">

            <div class="checkout">
                <!-- <ul class="breadcrumb v3">
                    <li><a href="#">Home</a></li>
                    <li class="active">Cart</li>
                </ul> -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="shopping-cart bd-7">
                        <form id="myForm">
                            <div class="cmt-title text-center abs">
                                <h1 class="page-title v2">Cart</h1>
                            </div>
                            <div style="overflow: auto;max-height:500px!important;margin-bottom:20px;">
                                <table  class="table cart-table" id="carttable">

                                    <tbody id="cartitem">
                                   

                                    </tbody>
                                </table>
                            </div>
                            <div class="table-cart-bottom">
                              <div style="position: absolute;right: 5em;">
                                <a id='Btnsubmit' href="#" onclick="submit({{$cart}})" class="btnNorm btn-gradient">Lanjut Pembayaran</a>

                              </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
</div>

<script>
    var Btnsubmit =document.getElementById('Btnsubmit').classList;
    var cartall ='';
    function deletecart(idv){

        // loadcart();
            var id = $(idv).data("id");
            console.log(id)
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('delcart') }}",
                    method: 'post',
                    data: {
                      id: id,
                    },
                    success: function(response){
                      console.log(response);

                      if(response>=0){
                          location.reload();
                        
                        //   jQuery.ajax({
                        //     url: "{{ url('cartall') }}",
                        //     method: 'get',
                        //     success: function(response){

                        //     }});
                      }
                      

                    }});
          }

    function submit(val){
        // console.log(val);
        // console.log(cartall);
        var listmap = [];
        for (i in cartall){
            var a = document.getElementById("title"+cartall[i].idBuku).innerHTML ;
            var x = document.getElementById("count"+cartall[i].idBuku).value ;
            var y = document.getElementById("price"+cartall[i].idBuku).innerHTML ;
            var z = document.getElementById("weight"+cartall[i].idBuku).innerHTML ;var strZ = z.slice(0,-5)
            var map = {id:cartall[i].idBuku, jumlah:x, harga:y, berat:z, judul:a};

            listmap.push(map);
        }
        console.log(listmap);

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              jQuery.ajax({
                    url: "{{ url('updatecart') }}",
                    method: 'post',
                    data: {
                      listmap: listmap,
                    },
                    success: function(response){
                      console.log(response);
                      if(response=='sukses'){
                           window.location.href = "{{URL::to('checkout')}}";
                      }

                    }});


          }
        window.onload = function () {  getcart();};
        function getcart(){
                $.ajax({

                        url:"{{url('cart')}}/",

                        type:"GET",

                            success:function(response){
                                var cart = ""
                                variable = response;
                                // console.log(response);
                                n=1;
                                for (i in variable) {
                                    cart += '<tr class="item_cart" id="item'+n+'" data-id="'+variable[i].idBuku+'">'+
                                            '<td class="product-name flex align-center">'+
                                               ' <a href="#" onclick="deletecart(this)" data-id="'+variable[i].idBuku+'" class="btn-del"><i class="ion-ios-close-empty"></i></a>'+
                                                '<div class="product-img pProd">'+
                                                    '<img src="img/product/1.jpeg" alt="Futurelife">'+
                                                '</div>'+
                                                '<div class="product-info">'+
                                                    '<a href="#" title=""><p id="title'+variable[i].idBuku+'" style="word-break: break-all">'+variable[i].judul_buku+'</p> </a>'+
                                                '</div>'+
                                            '</td>'+

                                            '<td class="total-price">'+
                                                '<p id="weight'+variable[i].idBuku+'" class="price">'+variable[i].berat+' gram</p>'+
                                            '</td>'+

                                            '<td class="total-price">'+
                                                '<p id="price'+variable[i].idBuku+'" class="price">'+variable[i].harga+'</p>'+
                                            '</td>'+

                                            '<td class="bcart-quantity single-product-detail">'+
                                                '<div class="single-product-info" style="margin-top:0px">'+
                                                    '<div class="e-quantity">'+
                                                      '<input id="count'+variable[i].idBuku+'" type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty input-text js-number" size="4">'+

                                                   '</div>'+
                                                '</div>'+
                                            '</td>'+

                                        '</tr>'
                                        n+=1;
                                }
                                // alert(variable);
                                // console.log(n);
                                if(n==1){
                                    Btnsubmit.add("disabled");
                                }else{
                                    Btnsubmit.remove("disabled");
                                }
                                document.getElementById("cartitem").innerHTML = cart;
                                cartall =response;
                                
                            }

                        });
        }
</script>
@endsection
