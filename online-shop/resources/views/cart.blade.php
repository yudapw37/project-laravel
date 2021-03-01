@extends('main.mainOther')
@section('title', 'Aqwam')
@section('body')

<!-- <div class="container container-240"> -->
  <div class="checkout">
      <!-- <div class="" style="margin-top:120px;"> -->
            <hr style="width:100%;height:2px;border-width:0;background:#817578;box-shadow:0px 1px 1px #535353">
            <div class="container container-240">
              <img src="{{$getBaseUrl}}img/banner/imgTitle.png" style="position: absolute;margin: -54px 0 0;" alt="">
              <h4 style="color:white;position:absolute;margin: -29px 0 0 77px;font-size: 25px;">Keranjang</h4>
              <div class="shopping-cart" style="margin-top:50px">
                <form id="myForm">
                    <div class="cCartItem" style="">
                      <div id="cartitem">

                      </div>
                    </div>
                    <div class="conCartBtn">
                      <a id='Btnsubmit' href="/search" class="btnNorm btnNorm2 btn-primary"><span class="judulDesktop">Lanjut Belanja</span> <span class="judulMobile">Lanjut Belanja</span></a>
                      <a id='Btnsubmit' href="#" class="btnNorm btnNorm2 btn-primary" onclick="submit({{$cart}})"><span class="judulDesktop">Lanjut Pembayaran</span> <span class="judulMobile">Lanjut Pembayaran</span></a>
                      <!-- <a id='Btnsubmit' href="#" class="btnNorm btnNorm2 btn-gradient" onclick="submit({{$cart}})"><span class="judulDesktop">Lanjut Pembayaran</span> <span class="judulMobile">Lanjut Pembayaran</span></a>
                      <a id='Btnsubmit' href="/search" class="btnNorm btnNorm2 btn-gradient"><span class="judulDesktop">Lanjut Belanja</span> <span class="judulMobile">Lanjut Belanja</span></a> -->
                    </div>
                    <!-- <div class="table-cart-bottom">
                      <div class="cCartBtm">
                        <a id='Btnsubmit' href="#" onclick="submit({{$cart}})" class="btnNorm btnNorm2 btn-gradient"><span class="judulDesktop">Lanjut Pembayaran</span> <span class="judulMobile">Bayar</span></a>
                      </div>
                      <div class="cCartBtm2">
                        <a id='Btnsubmit' href="/search" class="btnNorm btnNorm2 btn-gradient"><span class="judulDesktop">Lanjut Belanja</span> <span class="judulMobile">Belanja</span></a>
                      </div>
                    </div> -->
                </form>
              </div>
            </div>
      <!-- </div> -->
  </div>
<!-- </div> -->

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
                      else{
                            Swal.fire({

                                title: response,
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            })
                      }

                    }});


          }
        const formatter = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 2
        })
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
                                    // cart += '<tr class="item_cart" id="item'+n+'" data-id="'+variable[i].idBuku+'">'+
                                    //         '<td class="product-name flex align-center">'+
                                    //            ' <a href="#" onclick="deletecart(this)" data-id="'+variable[i].idBuku+'" class="btn-del"><i class="ion-ios-close-empty"></i></a>'+
                                    //             '<div class="product-img pProd">'+
                                    //                 '<img src="'+variable[i].urlImage+variable[i].gambar_buku+'" alt="Futurelife">'+
                                    //             '</div>'+
                                    //             '<div class="product-info">'+
                                    //                 '<a href="#" title=""><p id="title'+variable[i].idBuku+'" style="word-break: break-all">'+variable[i].judul_buku+'</p> </a>'+
                                    //             '</div>'+
                                    //         '</td>'+
                                    //
                                    //         '<td class="total-price">'+
                                    //             '<p id="weight'+variable[i].idBuku+'" class="price">'+variable[i].berat+' gram</p>'+
                                    //         '</td>'+
                                    //
                                    //         '<td class="total-price">'+
                                    //             '<p id="price'+variable[i].idBuku+'" class="price">'+variable[i].harga+'</p>'+
                                    //         '</td>'+
                                    //
                                    //         '<td class="bcart-quantity single-product-detail">'+
                                    //             '<div class="single-product-info" style="margin-top:0px">'+
                                    //                 '<div class="e-quantity">'+
                                    //                   '<input id="count'+variable[i].idBuku+'" type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty input-text js-number" size="4">'+
                                    //
                                    //                '</div>'+
                                    //             '</div>'+
                                    //         '</td>'+
                                    //
                                    //     '</tr>'
                              var x = variable[i].judul_buku;
                              var y = ""
                              if (x.length > 20) {
                                y = x.substring(0, 20) + ' ...';
                              }else {
                                y = x;
                              }
                              cart +=  '<div class="row" style="border-bottom: 1px solid #f1f1f1; padding-bottom:15px;margin:0 10px 15px;" id="item'+n+'" data-id="'+variable[i].idBuku+'">'+
                                          '<div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:0px">'+
                                              '<table>'+
                                                "<tr>"+
                                                  '<td>'+
                                                    '<a href="#" onclick="deletecart(this)" style="font-size:28px;color:#bfbfbf;margin-right:30px!important;margin-left: 50px;" data-id="'+variable[i].idBuku+'" class="btn-del hidden-sm hidden-xs">'+
                                                      // '<i style="color: #bb0019!important;font-size: 45px;" class="fa fa-trash"></i>'+
                                                      '<img src="{{$getBaseUrl}}img/delImg.png" style="height:40px" alt="">'+
                                                    '</a>'+
                                                  '</td>'+
                                                  '<td>'+
                                                    '<div style="width:80px">'+
                                                      '<img src="'+variable[i].urlImage+variable[i].gambar_buku+'" style="border-radius: 7px;border: 1px solid #ebebeb;" alt="">'+
                                                    '</div>'+
                                                  '</td>'+
                                                  '<td>'+
                                                    '<div style="display:none"><p id="title'+variable[i].idBuku+'">'+variable[i].judul_buku+'</p> <p id="price'+variable[i].idBuku+'">'+variable[i].harga+'</p> <p id="weight'+variable[i].idBuku+'">'+variable[i].berat+' gram</p></div>'+
                                                    '<div style="font-weight: 500; margin:5px 10px;">'+
                                                      '<a href="detail/'+variable[i].idBuku+'"><p style="word-break: break-all;font-size: 16px;"><span class="judulDesktop">'+variable[i].judul_buku+'</span> <span class="judulMobile">'+y+'</span></p></a>'+
                                                      '<p style="color:#e6222a" class="price">'+formatter.format(variable[i].harga)+'</p><p style="color:#959292;font-size:12px"> ('+variable[i].berat+' gram)</p>'+
                                                    '</div>'+
                                                  '</td>'+
                                                '</tr>'+
                                              '</table>'+
                                            '</div>'+
                                          '<div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom:0px">'+
                                            '<tr>'+
                                              '<td>'+
                                                '<div class="cCntr">'+
                                                    '<a href="#" onclick="deletecart(this)" style="font-size:28px;color:#bfbfbf;margin-right:10px!important" data-id="'+variable[i].idBuku+'" class="btn-del hidden-md hidden-lg">'+
                                                    '<img src="{{$getBaseUrl}}img/delImg.png" style="height:28px" alt="">'+
                                                      // '<i style="color: #bb0019!important" class="fa fa-trash"></i>'+
                                                    '</a>'+
                                                    '<input style="width: 65px; height: 39px; background: 0 0; padding: 0; font-weight: 500; font-size: 16px;border-radius: 10px; border: 2px solid #eaeaea; text-align: center;" id="count'+variable[i].idBuku+'" type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty inqty input-text js-number" size="4">'+
                                                '</div>'+
                                              '</td>'+
                                            '</tr>'+
                                          '</div>'+
                                        '</div>'
                                        n+=1;
                                }
                                // alert(variable);
                                // console.log(n);
                                if(n==1){
                                    Btnsubmit.add("disabled");
                                }else{
                                    Btnsubmit.remove("disabled");
                                }
                                // console.log(cart);
                                document.getElementById("cartitem").innerHTML = cart;
                                cartall =response;

                            }

                        });
        }
</script>
@endsection
