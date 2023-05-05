<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> BANNER START <<~~~~~~~~~~~~~~~~~~~~~~~-->
<?php 
$site_value = $sitedata->findall();
// print_r($site_value);
// die()
?>
<section class="banner_main">
    <div class="banner_sub">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <!-- <h4>WELCOME TO,</h4>
                        <h1>truflow hydraulics</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit
                            turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc
                            amet pretium.</p> -->
                            <h4><?php echo $site_value[0]['title'];?></h4>
                        <h1><?php echo $site_value[0]['sub_title'];?></h1>
                        <p><?php echo $site_value[0]['description'];?></p>
                        <button type="button" class="btn">CALL NOW</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner_img">
                        <img src="<?php echo base_url(); ?>/public/front/images/banner-img.png" alt="banner_img"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> BANNER END <<~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT US START <<~~~~~~~~~~~~~~~~~~~~-->
<section class="about_main text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about_sub">
                    <h5>About Us</h5>
                    <h2>truflow hydraulics</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit
                        turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet
                        pretium. Sem vel commodo proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque
                        sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium. Sem vel commodo
                        proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet,</p>
                    <button type="button" class="btn">read more</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT US END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~>> INSTANT OREDRE START <<~~~~~~~~~~~~~~~~~~~-->
<section class="instant_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="order_main">
                    <div class="blue_border">
                        <h4>instant order</h4>
                        <p>Type any Fluid Connectors part number and quantity or log in/register an account to type
                            your own part numbers.</p>
                        <div class="input_fileds">
                            <div class="part_num">
                                <h6>Part Number</h6>
                                <form action="#">
                                    <input type="text" class="form-control" id="usr">
                                    <input type="text" class="form-control" id="usr">
                                    <input type="text" class="form-control" id="usr">
                                    <input type="text" class="form-control" id="usr">
                                </form>
                            </div>
                            <div class="quality">
                                <h6>Quality</h6>
                                <form action="#">
                                    <input type="number" class="form-control" id="usr">
                                    <input type="number" class="form-control" id="usr">
                                    <input type="number" class="form-control" id="usr">
                                    <input type="number" class="form-control" id="usr">
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn">add to cart</button>
                        <button type="button" class="btn">add rows</button>
                    </div>
                </div>
                <div class="order_logo">
                    <img src="<?php echo base_url(); ?>/public/front/images/order_top.png" alt="logo"
                        class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="slider">
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s2.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s3.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s2.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s3.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products"
                                class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~>> INSTANT OREDR END <<~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~>> LOREM BACKGROUND START <<~~~~~~~~~~~~~~~~~~~-->
<div class="lorem_main">
    <div class="lorem_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lorem_heading text-center">
                        <h2>Lorem ipsum dolor sit amet.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                            tortor.Lorem ipsum dolor.</p>
                        <button type="button" class="btn">Contact Us</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~>> LOREM BACKGROUND END <<~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~>> OUR PRODUCTS START <<~~~~~~~~~~~~~~~~~~~~~~-->
<div class="product_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product_title text-center">
                    <h2>OUR PRODUCTS</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center pb-lg-5 pb-xl-5 pb-xxl-5">
            <div class="col-lg-9">
                <div class="products_type">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">POWER UNITS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">PUMPS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">VALUES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">FITTINGS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">CYLINDERS</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="search_drop">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="search">
                </div>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p1.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic Cylinders</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p2.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic power units</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p3.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>hand pumps</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p4.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>line mounts valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p5.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>cetop products</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p6.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Mobile Valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p7.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic Cylinders</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p8.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Cartridge Valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu1" class="container tab-pane fade">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p2.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic power units</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p3.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>hand pumps</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu3" class="container tab-pane fade"><br>
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p4.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>line mounts valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p6.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Mobile Valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p8.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Cartridge Valves</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu4" class="container tab-pane fade"><br>
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p7.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic Cylinders</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu5" class="container tab-pane fade"><br>
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="product_card">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>/public/front/images/p1.png" alt="product-1"
                                    class="img-fluid">
                                <div class="card-body">
                                    <h5>Hydraulic Cylinders</h5>
                                    <button>ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--     </div>   -->
<!--~~~~~~~~~~~~~~~~~~~~>> OUR PRODUCTS END <<~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~>> TESTIMONIALS START <<~~~~~~~~~~~~~~~~~ -->
<section class="testimonial_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial_title text-center">
                    <h2>Client Testimonials</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="owl-carousel-2 owl-carousel owl-theme">
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="test_img">
                                <img src="<?php echo base_url(); ?>/public/front/images/client.png" alt="client"
                                    class="img-fluid">
                            </div>
                            <div class="testi_card text-center">
                                <div class="test_text">
                                    <h5>Jason</h5>
                                    <h6>CEO</h6>
                                </div>
                                <div class="test_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                                    tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit
                                    amet,</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~>> TESTIMONIALS END <<~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~>> PARTNER LOGO START <<~~~~~~~~~~~~~~~-->
<section class="partner_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo_title text-center">
                    <h2>PARTNER LOGO</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p>
                    <!--  <img src="<?php echo base_url(); ?>/public/front/images/pl1.png" alt="partner logo" class="img-fluid">
                        <img src="<?php echo base_url(); ?>/public/front/images/pl2.png" alt="partner logo" class="img-fluid"> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="owl-carousel-3 owl-carousel owl-theme">
                        <div class="item">
                            <div class="logo_img text-md-right">
                                <img src="<?php echo base_url(); ?>/public/front/images/pl1.png" alt="partner logo"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="item">
                            <div class="logo_img text-md-right">
                                <img src="<?php echo base_url(); ?>/public/front/images/pl2.png" alt="partner logo"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="item">
                            <div class="logo_img text-md-right">
                                <img src="<?php echo base_url(); ?>/public/front/images/pl1.png" alt="partner logo"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="item">
                            <div class="logo_img text-md-right">
                                <img src="<?php echo base_url(); ?>/public/front/images/pl2.png" alt="partner logo"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--~~~~~~~~~~~~~~~~~~>> PARTNER LOGO END <<~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>