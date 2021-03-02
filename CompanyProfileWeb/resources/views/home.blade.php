@extends('main.main')

@section('title', 'Heppy Property')

@section('body')

        <section class="welcome_one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="block-title text-left">
                            <p style="color:#ffa600!important" >Welcome to HAPY PROPERY</p>
                            <h3>HEPY PROPERTY ITU APA SIH?</h3>
                            <div class="leaf">
                                <img src="assets/images/resources/leaf.png" alt="">
                            </div>
                        </div>
                        <div class="growing_box">
                            <div class="growing_icon_box">
                                <span class="far fa-kiss-wink-heart"></span>
                            </div>
                            <div class="growing_text">
                                <p>Salam sayang salam cinta dari HAPPY PROPERTY :*</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="welcome_text">
                            <p>HEPY PROPERY merupakan sebuah perusahaan yang bergerak di bidang property. kita sudah berdiri sejak tahun 1945! sudah dapat dipastikan kita sangat ahli dibidang ini. jadi jangan takut untuk berbisnis dengan kita. kita sudah memiliki beberapa cabang diseluruh dunia juga, jadi kalian tidak akan kesusahan untuk mencari kita. </p>
                        </div>
                        <!-- <div class="welcome_video_box"
                            style="background-image:url(assets/images/resources/welcome_video_bg.jpg)">
                            <a href="https://www.youtube.com/watch?v=i9E_Blai8vk"
                                class="welcome_video_btn video-popup"><i class="fa fa-play"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <section class="service_three d-none">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_three_single wow fadeInLeft" data-wow-delay="300ms">
                            <div class="service_three_image">
                                <img src="assets/images/service/service-3--img-1.jpg" alt="">
                            </div>
                            <div class="service_three_content">
                                <h2><a href="product.html">Fresh vegetables</a></h2>
                                <p>There are many variations of passages of available, but the majority have suffered.
                                </p>
                                <div class="service_three_read_more">
                                    <a href="product.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_three_single wow fadeInLeft" data-wow-delay="600ms">
                            <div class="service_three_image">
                                <img src="assets/images/service/service-3--img-2.jpg" alt="">
                            </div>
                            <div class="service_three_content">
                                <h2><a href="product.html">Agriculture products</a></h2>
                                <p>There are many variations of passages of available, but the majority have suffered.
                                </p>
                                <div class="service_three_read_more">
                                    <a href="product.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_three_single wow fadeInLeft" data-wow-delay="900ms">
                            <div class="service_three_image">
                                <img src="assets/images/service/service-3--img-3.jpg" alt="">
                            </div>
                            <div class="service_three_content">
                                <h2><a href="product.html">ORGANIC Products</a></h2>
                                <p>There are many variations of passages of available, but the majority have suffered.
                                </p>
                                <div class="service_three_read_more">
                                    <a href="product.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_three_single wow fadeInLeft" data-wow-delay="1200ms">
                            <div class="service_three_image">
                                <img src="assets/images/service/service-3--img-4.jpg" alt="">
                            </div>
                            <div class="service_three_content">
                                <h2><a href="#">Dairy products</a></h2>
                                <p>There are many variations of passages of available, but the majority have suffered.
                                </p>
                                <div class="service_three_read_more">
                                    <a href="product.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="recent_project_three">
            <div class="container-fullwidth">
                <div class="block-title text-center">
                    <p>explore projects</p>
                    <h3>HOT SALE</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="recent_project_three_carousel owl-theme owl-carousel">
                    <!--Item-->
                    <div class="project_three_single wow fadeInUp" data-wow-delay="200ms">
                        <div class="project_three_image">
                            <img src="assets/images/project/project-3-img-1.jpg" alt="">
                            <div class="project_three_content">
                                <h2>Property 1</h2>
                            </div>
                            <div class="project_three_hover_box">
                                <h2>Property 1</h2>
                                <p>Berikut merupakan teks protperty nomor 1<br>yang berlokasikan di lokasi 1.</p>
                                <div class="project_three_btn">
                                    <a href="projects_detail.html" class="thm-btn project_three_btn_hover">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Item-->
                    <div class="project_three_single wow fadeInUp" data-wow-delay="400ms">
                        <div class="project_three_image">
                            <img src="assets/images/project/project-3-img-1.jpg" alt="">
                            <div class="project_three_content">
                                <h2>Property 2</h2>
                            </div>
                            <div class="project_three_hover_box">
                                <h2>Property 2</h2>
                                <p>Berikut merupakan teks protperty nomor 1<br>yang berlokasikan di lokasi 2.</p>
                                <div class="project_three_btn">
                                    <a href="projects_detail.html" class="thm-btn project_three_btn_hover">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Item-->
                    <div class="project_three_single wow fadeInUp" data-wow-delay="600ms">
                        <div class="project_three_image">
                            <img src="assets/images/project/project-3-img-1.jpg" alt="">
                            <div class="project_three_content">
                                <h2>Property 3</h2>
                            </div>
                            <div class="project_three_hover_box">
                                <h2>Property 3</h2>
                                <p>Berikut merupakan teks protperty nomor 1<br>yang berlokasikan di lokasi 3.</p>
                                <div class="project_three_btn">
                                    <a href="projects_detail.html" class="thm-btn project_three_btn_hover">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Item-->
                    <div class="project_three_single wow fadeInUp" data-wow-delay="800ms">
                        <div class="project_three_image">
                            <img src="assets/images/project/project-3-img-1.jpg" alt="">
                            <div class="project_three_content">
                                <h2>Property 4</h2>
                            </div>
                            <div class="project_three_hover_box">
                                <h2>Property 4</h2>
                                <p>Berikut merupakan teks protperty nomor 1<br>yang berlokasikan di lokasi 4.</p>
                                <div class="project_three_btn">
                                    <a href="projects_detail.html" class="thm-btn project_three_btn_hover">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="work_one">
            <div class="container">
                <!-- <div class="block-title text-center">
                    <p>how it works</p>
                    <h3>follow 4 easy steps</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="work_one_single wow fadeInLeft" data-wow-delay="300ms">
                            <div class="work_one_icon_box">
                                <span class="far fa-thumbs-up"></span>
                                <div class="work_one_count_box">
                                    <h5>01</h5>
                                </div>
                            </div>
                            <div class="work_one_content">
                                <h2>Great Property</h2>
                                <p>Kami hanya menjual dan menyewakan property dengan kondisi terbaik dilokasi strategis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="work_one_single wow fadeInLeft" data-wow-delay="600ms">
                            <div class="work_one_icon_box">
                                <span class="icon-customer-service"></span>
                                <div class="work_one_count_box">
                                    <h5>02</h5>
                                </div>
                            </div>
                            <div class="work_one_content">
                                <h2>Professional services</h2>
                                <p>Kami senantiasa memberikan pelayanan terbaik dan friendly bagi kebutuhan akan properti Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="work_one_single last_box wow fadeInLeft" data-wow-delay="900ms">
                            <div class="work_one_icon_box">
                                <span class="fas fa-clipboard-check"></span>
                                <div class="work_one_count_box">
                                    <h5>03</h5>
                                </div>
                            </div>
                            <div class="work_one_content">
                              <h2>Best Deals</h2>
                              <p>Kami memberikan penawaran terbaik untuk semua jenis properti yang kami jual dan kami sewakan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="quote_one">
            <div class="quote_one_bg" style="background-image: url(assets/images/resources/quote_1-bg.png)"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="quote_one_content">
                            <h3>What is the cost of lies? It's not that we'll mistake them for the truth. The real danger is that if we hear enough lies, then we no longer recognize the truth at all.
                              What can we do then? What else is left but to abandon even the hope of truth and content ourselves instead with stories? In these stories, it doesn't matter who the heroes are.
                              All we want to know is: "Who is to blame?"</h3>
                            <p>Valery Legasov</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="why_choose_one d-none">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="why_choose_one_left_content">
                            <div class="block-title text-left">
                                <p>Why Choose us</p>
                                <h3>Better agriculture for<br>better future</h3>
                                <div class="leaf">
                                    <img src="assets/images/resources/leaf.png" alt="">
                                </div>
                            </div>
                            <ul class="why_choose_list list-unstyled">
                                <li>
                                    <div class="choose_count">
                                        <h2>01</h2>
                                    </div>
                                    <div class="choose_text">
                                        <p>Solution for small and large businesses voluptatem<br>accusantium doloremque
                                            laudantium</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="choose_count">
                                        <h2>02</h2>
                                    </div>
                                    <div class="choose_text">
                                        <p>Solution for small and large businesses voluptatem<br>accusantium doloremque
                                            laudantium</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="choose_count">
                                        <h2>03</h2>
                                    </div>
                                    <div class="choose_text">
                                        <p>Solution for small and large businesses voluptatem<br>accusantium doloremque
                                            laudantium</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="why_choose_btn">
                                <a href="about.html" class="thm-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="why_choose_image_top">
                            <div class="why_choose_image"
                                style="background-image: url(assets/images/resources/why_choose1_img-1.jpg)">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="team_one">
            <div class="container">
                <div class="block-title text-center">
                    <p>our team members</p>
                    <h3>meet out agent</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInUp">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-1.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">David James</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInDown">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-2.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Jessica Brown</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInUp">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-3.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Kevin Martin</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInDown">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-4.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Sarah Albert</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="brand-one brand-three d-none">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="brand-one-carousel owl-carousel">
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-1.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-2.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-3.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-4.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-5.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-1.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-2.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-3.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-4.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-5.png" alt="brand"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="what_makes" style="background-image: url(assets/images/resources/what-makes-bg.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="what_makes_content">
                            <p>What Makes Us Special?</p>
                            <h2>Unbeatable organic and<br>agriculture Services</h2>
                            <div class="what_makes_btn">
                                <a href="why_choose_us.html" class="thm-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="blog_two d-none">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="block-title">
                            <p>our team members</p>
                            <h3>meet the farmers</h3>
                            <div class="leaf">
                                <img src="assets/images/resources/leaf.png" alt="">
                            </div>
                        </div>
                        <div class="all_posts_btn">
                            <a href="news.html" class="thm-btn">View All Posts</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <div class="blog_two_single wow fadeInLeft" data-wow-delay="300ms">
                            <div class="blog_two_image">
                                <img src="assets/images/blog/blog-2-img-1.jpg" alt="">
                                <div class="blog_two_date_box">
                                    <p>30 Oct, 2019</p>
                                </div>
                            </div>
                            <div class="blog-two_content">
                                <ul class="list-unstyled blog-two_meta">
                                    <li><a href="news_detail.html"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="news_detail.html"><i class="far fa-comments"></i> 2 Comments</a></li>
                                </ul>
                                <h3><a href="news_detail.html" class="blog_two_title">Agriculture Miracle you<br>Don't
                                        Know About</a></h3>
                                <div class="blog_two_text">
                                    <p>There are lorem ipsum is simply free text available in the market to use it many
                                        variations of ipsum the majority suffered.</p>
                                </div>
                                <div class="blog_two_read_more_btn">
                                    <a href="news_detail.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4  col-lg-6">
                        <div class="blog_two_single wow fadeInLeft" data-wow-delay="600ms">
                            <div class="blog_two_image">
                                <img src="assets/images/blog/blog-2-img-2.jpg" alt="">
                                <div class="blog_two_date_box">
                                    <p>30 Oct, 2019</p>
                                </div>
                            </div>
                            <div class="blog-two_content">
                                <ul class="list-unstyled blog-two_meta">
                                    <li><a href="news_detail.html"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="news_detail.html"><i class="far fa-comments"></i> 2 Comments</a></li>
                                </ul>
                                <h3><a href="news_detail.html" class="blog_two_title">Winter Wheat Harvest
                                        Gathering<br>Momentum</a></h3>
                                <div class="blog_two_text">
                                    <p>There are lorem ipsum is simply free text available in the market to use it many
                                        variations of ipsum the majority suffered.</p>
                                </div>
                                <div class="blog_two_read_more_btn">
                                    <a href="news_detail.html"><i class="fa fa-angle-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="blog_two_right wow fadeInRight" data-wow-delay="300ms">
                            <div class="blog_three_single">
                                <ul class="list-unstyled blog-three_meta">
                                    <li><a href="news_detail.html"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="news_detail.html"><i class="far fa-comments"></i> 2 Comments</a></li>
                                </ul>
                                <h3><a href="news_detail.html" class="blog_three_title">Amount of Freak Bread or Other
                                        Fruits</a></h3>
                            </div>
                            <div class="blog_three_single">
                                <ul class="list-unstyled blog-three_meta">
                                    <li><a href="news_detail.html"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="news_detail.html"><i class="far fa-comments"></i> 2 Comments</a></li>
                                </ul>
                                <h3><a href="news_detail.html" class="blog_three_title">Learn 10 Best Tips for New
                                        Formers</a></h3>
                            </div>
                            <div class="blog_three_single blgo_three_last">
                                <ul class="list-unstyled blog-three_meta">
                                    <li><a href="news_detail.html"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="news_detail.html"><i class="far fa-comments"></i> 2 Comments</a></li>
                                </ul>
                                <h3><a href="news_detail.html" class="blog_three_title">Winter Wheat Harvest Gathering
                                        Momentum</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="cta_three pt-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cta_three_content wow fadeInUp" data-wow-delay="300ms">
                            <div class="cta_three_text">
                                <h2>We provide high-quality products</h2>
                            </div>
                            <div class="cta_three_btn">
                                <a href="service.html" class="thm-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script>

        // jQuery.ajax({
        // url: "{{ url('slide/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });

        // $.ajaxSetup({
        // headers: {
        //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //         }
        // });
        // jQuery.ajax({
        // url: "{{ url('store/') }}",
        // method: 'post',
        // data: {
        //         idkota: idkota,
        //         idarea: idarea
        //         },
        // success: function(response){
        // }
        // });

        // jQuery.ajax({
        // url: "{{ url('about/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });

        // jQuery.ajax({
        // url: "{{ url('agen/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });   

        // jQuery.ajax({
        // url: "{{ url('visimisi/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });

        // jQuery.ajax({
        // url: "{{ url('kota/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });

        // jQuery.ajax({
        // url: "{{ url('tipe/') }}",
        // method: 'get',
        // success: function(response){
        // }
        // });


                    //===get===
                    // jQuery.ajax({
                    //   url: "{{ url('/countorder') }}",
                    //   method: 'get',
                    //   success: function(response){
                    //   }
                    // });

                    //===post===
                    // $.ajaxSetup({
                    //   headers: {
                    //       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    //         }
                    //    });
                    //    jQuery.ajax({
                    //         url: "{{ url('/editpass') }}",
                    //         method: 'post',
                    //         data: {
                    //            oldpass: inptPassLama,
                    //            newpass: inptPassBaru,
                    //            confirmpass: inptPassConfirm
                    //           },
                    //          success: function(response){
                    //         }
                    //    });

    </script>

@endsection
