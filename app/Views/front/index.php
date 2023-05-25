<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> BANNER START <<~~~~~~~~~~~~~~~~~~~~~~~-->
<?php


$welcome_setting_id = isset($welcomeData) ? $welcomeData['setting_id'] : '';
$welcome_title = isset($welcomeData) ? $welcomeData['title'] : '';
$welcome_sub_title = isset($welcomeData) ? $welcomeData['sub_title'] : '';
$welcome_description = isset($welcomeData) ? $welcomeData['description'] : '';
$welcome_button_text = isset($welcomeData) ? $welcomeData['button_text'] : '';
$welcome_button_link = isset($welcomeData) ? $welcomeData['button_link'] : '';

//image
$welcome_img_link = isset($imageData) ? $imageData['image_path'] : '';

// About
$about_setting_id = isset($aboutData) ? $aboutData['setting_id'] : '';
$about_title = isset($aboutData) ? $aboutData['title'] : '';
$about_sub_title = isset($aboutData) ? $aboutData['sub_title'] : '';
$about_description = isset($aboutData) ? $aboutData['description'] : '';
$about_button_text = isset($aboutData) ? $aboutData['button_text'] : '';
$about_button_link = isset($aboutData) ? $aboutData['button_link'] : '';

// Contact
$contact_setting_id = isset($contactData) ? $contactData['setting_id'] : '';
$contact_title = isset($contactData) ? $contactData['title'] : '';
$contact_description = isset($contactData) ? $contactData['description'] : '';
$contact_button_text = isset($contactData) ? $contactData['button_text'] : '';
$contact_button_link = isset($contactData) ? $contactData['button_link'] : '';

//product
$product_setting_id = isset($productData) ? $productData['setting_id'] : '';
$product_title = isset($productData) ? $productData['title'] : '';
$product_description = isset($productData) ? $productData['description'] : '';

//testominal
$testominal_setting_id = isset($testominalData) ? $testominalData['setting_id'] : '';
$testominal_title = isset($testominalData) ? $testominalData['title'] : '';
$testominal_description = isset($testominalData) ? $testominalData['description'] : '';

//partner
$partner_setting_id = isset($partnerData) ? $partnerData['setting_id'] : '';
$partner_title = isset($partnerData) ? $partnerData['title'] : '';
$partner_description = isset($partnerData) ? $partnerData['description'] : '';
?>
<section class="banner_main">
    <div class="banner_sub">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <h4><?php echo $welcome_title; ?></h4>
                        <h1><?php echo $welcome_sub_title; ?></h1>
                        <p><?php echo $welcome_description; ?></p>
                        <a href="<?php echo $welcome_button_link; ?>" target="_blank"><button type="button" class="btn"> <?php echo $welcome_button_text; ?> </button></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner_img">
                        <?php if ($welcome_img_link) { ?>
                            <img src="<?php echo base_url() . $welcome_img_link ?>" alt="banner_img" class="img-fluid">

                        <?php } ?>
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
                    <h5><?php echo $about_title; ?></h5>
                    <h2><?php echo $about_sub_title; ?></h2>
                    <p><?php echo $about_description; ?></p>
                    <a href="<?php echo $about_button_link; ?>" target="_blank"><button type="button" class="btn"> <?php echo $about_button_text; ?> </button></a>
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
                    <img src="<?php echo base_url(); ?>/public/front/images/order_top.png" alt="logo" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="slider">
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s2.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s3.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s2.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s3.png" alt="products" class="img-fluid">
                        </div>
                        <div class="slider_text">
                            <h6>Pshy8546L</h6>
                            <button type="button" class="btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="slider_content">
                        <div class="slider_con_img">
                            <img src="<?php echo base_url(); ?>/public/front/images/s1.png" alt="products" class="img-fluid">
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
                        <!-- <h2>Lorem ipsum dolor sit amet.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi
                            tortor.Lorem ipsum dolor.</p> -->
                        <h2><?php echo $contact_title; ?></h2>
                        <p><?php echo $contact_description; ?></p>
                        <a href="<?php echo $contact_button_link; ?>" target="_blank"><button type="button" class="btn"> <?php echo $contact_button_text; ?> </button></a>
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
                    <!-- <h2>OUR PRODUCTS</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p> -->
                    <h2><?php echo $product_title; ?></h2>
                    <p><?php echo $product_description; ?></p>
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p1.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p2.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p3.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p4.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p5.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p6.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p7.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p8.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p2.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p3.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p4.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p6.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p8.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p7.png" alt="product-1" class="img-fluid">
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
                                <img src="<?php echo base_url(); ?>/public/front/images/p1.png" alt="product-1" class="img-fluid">
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
                    <!-- <h2>Client Testimonials</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p> -->
                    <h2><?php echo $testominal_title; ?></h2>
                    <p><?php echo $testominal_description; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="owl-carousel-2 owl-carousel owl-theme">

                        <?php if ($testimonalData) { ?>
                            <?php foreach ($testimonalData as $testominal) { ?>
                                <div class="item">
                                    <div class="test_img">
                                        <img src="<?php echo base_url() . $testominal['testimo_img'] ?>" alt="client" class="img-fluid">
                                    </div>
                                    <div class="testi_card text-center">
                                        <div class="test_text">
                                            <h5><?php echo $testominal['full_name']; ?></h5>
                                            <h6><?php echo $testominal['designation']; ?></h6>
                                        </div>
                                        <div class="test_icon">
                                            <i class="fa-solid fa-quote-left"></i>
                                        </div>
                                        <p><?php echo $testominal['description']; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>

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
                    <!-- <h2>PARTNER LOGO</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem
                        ipsum dolor sit amet, consectetur adipiscing.</p> -->
                    <h2><?php echo $partner_title; ?></h2>
                    <p><?php echo $partner_description; ?></p>
                    <!--  <img src="<?php echo base_url(); ?>/public/front/images/pl1.png" alt="partner logo" class="img-fluid">
                        <img src="<?php echo base_url(); ?>/public/front/images/pl2.png" alt="partner logo" class="img-fluid"> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="owl-carousel-3 owl-carousel owl-theme">
                        <?php if ($partnerImageData) { ?>
                            <?php foreach ($partnerImageData as $partner) { ?>
                                <div class="item">
                                    <div class="logo_img text-md-right">
                                        <img src="<?php echo base_url() . $partner['image_path'] ?>" alt="partner logo" class="img-fluid">
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--~~~~~~~~~~~~~~~~~~>> PARTNER LOGO END <<~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>