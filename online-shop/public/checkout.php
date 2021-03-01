<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "include/head.php" ?>
</head>

<body>
    <!-- push menu-->
    <?php include "include/nav.php" ?>
    <!-- end push menu-->
    <div class="wrappage">
        <?php include "include/headerGlobal.php" ?>
        <!-- /header -->
        <!--content-->
        <div class="main-content space1">
            <div class="container container-240">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
                <div class="co-coupon">
                    <div class="row">
                        <div class="checkout-login col-xs-12 col-sm-6">
                            <div class="box-toggle box-login">
                                <img src="img/co-login.png" alt="">Returning customer?
                                <a class="show-login js-showlogin"> Click here to login</a>
                            </div>
                            <form method="post" class="myaccount form-customer form-login js-openlogin">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                                <div class="form-group ">
                                    <label for="exampleInputEmail1">Username or email address *</label>
                                    <input type="email" class="form-control form-account form-account" id="exampleInputEmail1">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleInputPassword1">Password *</label>
                                    <input type="password" class="form-control form-account form-account" id="exampleInputPassword1">
                                </div>
                                <div class="form-check ">
                                    <button type="submit" class="btn btn-submit btn-gradient">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class=" col-xs-12 col-sm-6 checkout-cp ">
                            <div class="box-toggle box-coupon ">
                                <img src="img/co-coupon.png" alt="">Have a coupon?
                                <a class="show-login js-showcp"> Click here to enter your code</a>
                            </div>
                            <form class="form_coupon form-cp js-opencp" action="#" method="post">
                                <input type="email" value="" placeholder="Coupon code" name="EMAIL" id="mail" class="newsletter-input form-control">
                                <div class="input-icon">
                                    <img src="img/coupon-icon.png" alt="">
                                </div>
                                <button id="subscribe" class="button_mini btn" type="submit">
                                    Apply coupon
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <form name="checkout" method="post" class="co">
                    <div class="cart-box-container-ver2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="co-left bd-7">
                                    <div class="cmt-title text-center abs">
                                        <h1 class="page-title v1">Detail Customer</h1>
                                    </div>
                                    <div class="row form-customer">
                                        <div class="form-group col-md-6">
                                            <label for="inputfname_2" class=" control-label">Nama Depan <span class="f-red">*</span></label>
                                            <input type="text" id="inputfname_2" class="form-control form-account">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputlname" class=" control-label">Nama Belakang <span class="f-red">*</span></label>
                                            <input type="text" id="inputlname" class="form-control form-account">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputcompany" class=" control-label">Alamat</label>
                                            <input type="text" id="inputcompany" class="form-control form-account">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputstreet" class=" control-label">Kab/Kota<span class="f-red">*</span></label>
                                            <input type="text" id="inputstreet" class="form-control form-account">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputpostcode" class=" control-label">Propinsi</label>
                                            <input type="text" id="inputpostcode" class="form-control form-account">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputfState" class=" control-label">No Telphone<span class="f-red">*</span></label>
                                            <input type="text" id="inputfState" class="form-control form-account">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputemail" class=" control-label">Email<span class="f-red">*</span></label>
                                            <input type="text" id="inputemail" class="form-control form-account">
                                        </div>
                                        <div class="form-check col-md-12">
                                            <label class="form-check-label ver2">
                                                <input type="checkbox" class="form-check-input">
                                                <span>Create an account?</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="co-left bd-7">
                                    <div class="cmt-title text-center abs">
                                        <h1 class="page-title v5">Notes</h1>
                                    </div>
                                    <div class="row form-customer v2">

                                        <div class="form-group col-md-12">
                                            <label for="inputfState" class=" control-label">Order Notes</label>
                                            <textarea name="message" rows="8" id="message" class="form-control form-note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End contact-form -->
                            <div class="col-md-4">
                                <div class="cart-total bd-7">
                                    <div class="cmt-title text-center abs">
                                        <h1 class="page-title v3">Total Order</h1>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="co-pd">
                                            <p class="co-title">
                                                Product<span>Total</span>
                                            </p>
                                            <ul class="co-pd-list">
                                                <li class="clearfix">
                                                    <div class="co-name">
                                                        Buku Satu x 1 <br>
                                                        Buku Dua  x 1
                                                    </div>
                                                    <div class="co-price">
                                                       Rp.120.000 <br>
                                                       Rp.100.000
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <table class="shop_table">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td>Rp.220.000</td>
                                                </tr>
                                                <tr class="cart-shipping v2">

                                                <tr class="order-total v2">
                                                    <th>Total</th>
                                                    <td>Rp.220.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <ul class="payment">
                                        <li>
                                            <input type="radio" name="gender" value="Direct" id="radio3" >
                                            <label for="radio3">Direct bank transfer</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="gender" value="Check" id="radio4">
                                            <label for="radio4">Pembayaran 2</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="gender" value="Cash" id="radio5">
                                            <label for="radio5">Pembayaran 3</label>
                                        </li>

                                    </ul>


                                    <div class="cart-total-bottom v2">
                                        <a href="#" class="btn-gradient btn-checkout btn-co-order">Order Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="e-category">
            <div class="container container-240">
                <div class="title-icon t-column mg-50">
                    <div class="t-inside">
                        <img src="img/real.png" alt="">
                    </div>
                    <h1>You May Like</h1>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Featured Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Top Rated Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h1 class="cate-title">Top Selling Products</h1>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/1.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 1 </a></h3>
                                <div class="product-price v2"><span>Rp. 88.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/2.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 2 </a></h3>
                                <div class="product-price v2"><span>Rp. 77.000</span></div>
                            </div>
                        </div>
                        <div class="cate-item">
                            <div class="product-img">
                                <a href="#"><img src="img/product/3.jpeg" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#">Judul Buku 3 </a></h3>
                                <div class="product-price v2"><span>Rp. 66.000</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="feature">
            <div class="container container-240">
                <div class="feature-inside">
                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/truck.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Pengiriman Seluruh Indonesia</h3>
                            <p>Kita mengirimkan barang ke seuruh penjuru Indonesia</p>
                        </div>
                    </div>

                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/credit-card.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Pembayaran Aman</h3>
                            <p>Pembayaran dilakukan dengan sangat aman.</p>
                        </div>
                    </div>

                    <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/safety.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>Belanja Dengan Aman</h3>
                            <p>Proteksi dari membeli sampai dengan pengiriman.</p>
                        </div>
                    </div>

                    <!-- <div class="feature-block text-center">
                        <div class="feature-block-img"><img src="img/feature/telephone.png" alt="" class="img-reponsive"></div>
                        <div class="feature-info">
                            <h3>24/7 Help Center</h3>
                            <p></p>
                        </div>
                    </div> -->
            </div>
            </div>
        </div>
        <!-- / end content -->
    <?php include_once "include/foot.php"; ?>
    </div>

    <!-- <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>

    <script src="js/main.js"></script> -->
</body>

</html>
