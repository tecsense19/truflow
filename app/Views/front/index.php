<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> BANNER START <<~~~~~~~~~~~~~~~~~~~~~~~-->
<?php
$session = session();
$wishlistCount = session('wishlistCount');
$cartCount = session('cartCount');



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

$loginId = $session->get('user_id');
?>
<!-- new page login added -->

<body style="overflow-x: hidden;">


    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="container-fluid p-md-1 row_margine" style="overflow: hidden;">

        <div class="row no-md-gutters justify-content-center mt-md-0 mt-lg-2">
            <div class="<?php echo $loginId ? 'col-lg-12' : 'col-lg-9'; ?> col-md-12 pr-md-2 p-1 p-md-0">
                <a href="<?php echo base_url('shop') ?>">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/front/images/home/newlogin/1.svg" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-8 mt-2 mt-lg-0 form_outer" style="background-color: gainsboro; display: <?php echo $loginId ? 'none' : 'flex'; ?>">

                <div class="row">
                    <div class="col-md-12">
                        <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-primary text-center"><?= session()->getFlashdata('success') ?></div>
                        <?php } ?>
                        <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
                        <?php } ?>
                    </div>
                   <div class="col-md-12">
                   <form id="loginForm" action="<?php echo base_url('check/login') ?>" method="POST">
                        <h2 class="text-center pt-5 pb-3">Sign in</h2>
                        <div class="form-group">
                            <div class="mr-2 ml-2 mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" form-password-toggle mr-2 ml-2 mb-4">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>

                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                </div>

                            </div>
                        </div>
                        <div class="form-group ml-2">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ml-2 mr-2">
                            <div class="">
                                <button class="btn btn-primary d-grid w-100 signin_btn" type="submit">Sign in</button>
                            </div>
                        </div>
                        <div class="form-group ml-2 mr-2 d-flex justify-content-around">
                            <a class="" href="<?php echo base_url('forgot-password') ?>">
                                <small>Forgot your password</small>
                            </a>
                            <a class="" href="<?php echo base_url('register') ?>">
                                <small>Create account</small>
                            </a>
                        </div>
                    </form>
                   </div>
                </div>


            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mt-2 pl-1 pr-1">
                <a href="<?php echo base_url('shop') ?>"><img class="img-fluid"
                        src="<?php echo base_url() ?>public/front/images/home/newlogin/2.jpg" alt=""></a>
            </div>

            <div class="col-md-6 mt-2 pr-1 pl-1">
                <a href="<?php echo base_url('shop') ?>"><img class="img-fluid"
                        src="<?php echo base_url() ?>public/front/images/home/newlogin/3.jpg" alt=""></a>
            </div>

        </div>

        <!-- ended -->

        <!-- <section class="banner_main">
    <div class="banner_sub">
        <div class="container">
            <div class="row">
                <div class="carousel_banner owl-carousel" id="carousel_banner">
                    <?php
                    if (isset($sliderData)) {
                        $imageLinks = [
                            0 => [
                                'upper' => 'product/3',
                                'lower' => 'product/2'
                            ],
                            1 => 'sub/category/1',
                            2 => 'sub/category/1'
                        ];

                        foreach ($sliderData as $index => $val) {
                            $sliderPath = $val['slider_path'];
                            $imagePaths = explode(',', $sliderPath);

                            foreach ($imagePaths as $imageIndex => $imagePath) {
                                $imageUrl = base_url() . 'public/front/images/home/' . $imagePath;

                                // Check if a corresponding link exists for the current image index
                                if (isset($imageLinks[$imageIndex])) {
                                    $imageLink = $imageLinks[$imageIndex];
                                    if ($imageIndex === 0 && is_array($imageLink)) {
                                        // Display multiple links for the first image on hover
                                        $upperLink = $imageLink['upper'];
                                        $lowerLink = $imageLink['lower'];
                                        ?>
                                        <div class="item main_banner_img_new">
                                            <div class="hover-image">
                                                <div class="image">
                                                    <img src="<?php echo $imageUrl; ?>" alt="">
                                                </div>
                                                <div class="hover-content">
                                                    <div class="upper-link">
                                                        <a href="<?php echo $upperLink; ?>"></a>
                                                    </div>
                                                    <div class="lower-link">
                                                        <a href="<?php echo $lowerLink; ?>"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        continue; // Skip the rest of the loop for the first image
                                    }
                                } else {
                                    $imageLink = ''; // Default link if no specific link is set for the image
                                }
                                ?>

                                <div class="item main_banner_img_new">
                                    <?php if (!empty($imageLink)) { ?>
                                        <a href="<?php echo $imageLink; ?>">
                                        <?php } ?>
                                        <img src="<?php echo $imageUrl; ?>" alt="">
                                        <?php if (!empty($imageLink)) { ?>
                                        </a>
                                    <?php } ?>
                                </div>

                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section> -->

        <!-- ------------------- -->
        <!-- <section class="banner_main">
    <div class="banner_sub">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <h4><?php echo $welcome_title; ?></h4>
                        <h1><?php echo $welcome_sub_title; ?></h1>
                        <p><?php echo $welcome_description; ?></p>
                        <a href="<?php echo $welcome_button_link; ?>"><button type="button" class="btn"> <?php echo $welcome_button_text; ?> </button></a>
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
</section> -->

        <!-- ------------------- -->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> BANNER END <<~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT US START <<~~~~~~~~~~~~~~~~~~~~-->
        <!-- <section class="about_main text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about_sub">
                    <h5><?php //echo $about_title; ?></h5>
                    <h2><?php //echo $about_sub_title; ?></h2>
                    <?php //echo $about_description; ?>
                    <a href="<?php //echo $about_button_link; ?>"><button type="button" class="btn about_d"> <?php //echo $about_button_text; ?> </button></a>
                </div>
            </div>
        </div>
    </div>
</section> -->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT US END <<~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--~~~~~~~~~~~~~~~~~~~>> INSTANT OREDRE START <<~~~~~~~~~~~~~~~~~~~-->
        <section class="instant_main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- ------------------------- -->
                        <div class="order_main">
                            <div class="blue_border">
                                <h4>instant order</h4>
                                <p>Type any Fluid Connectors part number and quantity or log in/register an account to
                                    type
                                    your own part numbers.</p>

                                <form id="cart_form" action="<?php echo base_url(); ?>/add_to_cart_new" method="post">
                                    <div class="input_fields">
                                        <!-- Existing rows and fields here -->
                                    </div>
                                    <div class="adjust_button text-center">
                                        <button id="add_to_cart" class="btn" type="submit">Add to Cart</button>
                                        <button type="button" class="btn" id="add_rows">Add Rows</button>
                                    </div>

                                </form>


                            </div>
                        </div>

                        <div class="order_logo">
                            <img src="<?php echo base_url(); ?>/public/front/images/order_top.png" alt="logo"
                                class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="slider">
                            <?php

                    if (isset($allcategoryData)) { ?>
                            <?php foreach ($allcategoryData['category'] as $key => $product) {
                            ?>
                            <div class="slider_content">

                                <div class="slider_con_img">
                                    <?php if (isset($product['category_img'])) {
                                        $imagePaths = explode(',', $product['category_img']);
                                        $firstImagePath = trim($imagePaths[0]);
                                    ?>
                                    <img src="<?php echo base_url() . $firstImagePath ?>" alt="product"
                                        class="img-fluid product_slider_img">
                                    <?php } else { ?>
                                    <img class="product_slider_img"
                                        src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                    <?php } ?>

                                </div>
                                <div class="slider_text">
                                    <!-- <a href="<?php //echo base_url('') . "sub/category/" . $product['category_id'] ?>"> -->
                                    <?php
                                    $url = base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']); 
                                    ?>
                                    <a href="<?php echo $url; ?>">
                                        <h6><?php echo $product['category_name']; ?>&nbsp;&nbsp;</h6>
                                        <h6><?php echo $product['category_description']; ?></h6>
                                    </a>
                                </div>

                            </div>
                            <?php } ?>
                            <?php foreach ($allcategoryData['sub_category'] as $key => $product) {
                            ?>
                            <div class="slider_content">

                                <div class="slider_con_img">
                                    <?php if (isset($product['sub_category_img'])) {
                                        $imagePaths = explode(',', $product['sub_category_img']);
                                        $firstImagePath = trim($imagePaths[0]);
                                    ?>
                                    <img src="<?php echo base_url() . $firstImagePath ?>" alt="product"
                                        class="img-fluid product_slider_img">
                                    <?php } else { ?>
                                    <img class="product_slider_img"
                                        src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                    <?php } ?>

                                </div>
                                <div class="slider_text">
                                    <?php
                                    $url = '';
                                    if(isset($product['category_name'])){
                                        $url = base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']).'/'.str_replace(' ', '_', $product['sub_category_name']); 
                                    }
                                    ?>
                                    <!-- <a href="<?php echo base_url('') . "childsub/category/" . $product['sub_category_id'] ?>"> -->
                                    <a href="<?php echo $url; ?>">
                                        <h6><?php echo $product['sub_category_name']; ?>&nbsp;&nbsp;</h6>
                                        <h6><?php echo $product['sub_category_description']; ?></h6>
                                    </a>
                                </div>

                            </div>
                            <?php } ?>
                            <?php foreach ($allcategoryData['child_sub'] as $key => $product) {
                                // echo '<pre>';print_r($product);echo '</pre>';
                                // echo '<pre>';
                                // print_r($product);
                                // $subChildCatLink = base_url('') . "product/" . $product['sub_category_id'] . '/' . str_replace(' ', '-', $product['child_sub_category_name']);
                                // $subChildCatLink = base_url('') . "product/" . str_replace(' ', '-', $product['child_sub_category_name']);
                                if(isset($product)){
                                    if(isset($product['category_name'])){
                                        if(isset($product['sub_child_name'])){
                                            $url =  base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']).'/'.str_replace(' ', '_', $product['sub_category_name']).'/'.$product['sub_child_name'].'/'.str_replace(' ', '_', $product['child_sub_category_name']);
                                        }else{
                                            $url =  base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']).'/'.str_replace(' ', '_', $product['sub_category_name']).'/'.str_replace(' ', '_', $product['child_sub_category_name']);
                                        }
                                    }
                                }
                              
                            if(isset($product)){
                            ?>
                            <div class="slider_content">

                                <div class="slider_con_img category_data" >
                                    <?php if (isset($product['child_sub_category_img']) && $product['child_sub_category_img'] != '') {
                                        $imagePaths = explode(',', $product['child_sub_category_img']);
                                        $firstImagePath = trim($imagePaths[0]);
                                    ?>
                                        <img src="<?php echo base_url() . $firstImagePath ?>" alt="product" class="img-fluid product_slider_img">
                                    <?php } else { ?>
                                        <img class="product_slider_img" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                    <?php } ?>

                                </div>
                                <!-- <div class="slider_text category_data" data-catid="<?php //echo $product['child_id']; ?>" data-subcatid="<?php //echo $product['sub_category_id']; ?>" data-url="<?php //echo $subChildCatLink; ?>">
                                    <a href="javascript:void(0)">
                                        <h6><?php //echo $product['child_sub_category_name']; ?>&nbsp;&nbsp;<?php //echo $product['category_description']; ?></h6>
                                    </a>
                                </div> -->
                                <div class="slider_text" data-catid="<?php echo $product['child_id']; ?>">
                                    <a href="<?php echo $url; ?>">
                                        <h6><?php echo $product['child_sub_category_name']; ?>&nbsp;&nbsp;<?php //echo $product['category_description']; ?></h6>
                                    </a>
                                </div>
                            </div>
                            <?php } } ?>
                            <?php } ?>

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

                        <div class="col-lg-12 about">
                            <div class="about_sub lorem_heading text-center">
                                <h4 class="about_title"><?php echo $about_title; ?></h4>
                                <h2 class="mt-sm-5"><?php echo $about_sub_title; ?></h2>
                                <p><?php echo $about_description; ?></p>
                                <a href="<?php echo $about_button_link; ?>"><button type="button" class="btn ">
                                        <?php echo $about_button_text; ?> </button></a>
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
                        <div class="product_title text-center mb-4">
                            <h2>FEATURED PRODUCTS</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center pb-lg-5 pb-xl-5 pb-xxl-5">
                    <!-- <div class="col-lg-9">
                <div class="products_type">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">All</a>
                        </li>
                        <?php foreach ($categoryData as $category) : ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu<?= $category['sub_category_id'] ?>">
                                    <?= $category['sub_category_name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div> -->
                    <!-- <div class="col-lg-3">
                <form role="search" method="POST" class="search-form" id="Ajax_search">
                    <div class="search_drop">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" placeholder="search" id="search_1" name="search">
                    </div>
                    <div id="search_1-result"></div>
                </form>
            </div> -->
                </div>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div id="home" class="container tab-pane active">
                        <div class="row">
                            <?php 
                            if (isset($newProductdata)) {
                       // Shuffle the array to get random data
                        shuffle($newProductdata); ?>
                            <?php foreach ($newProductdata as $product) : ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="product_card">
                                    <div class="card">

                                        <?php if ($product['featured_category'] == 1 ) {
                                            $imagePaths = explode(',', $product['product_img']);
                                            $firstImagePath = trim($imagePaths[0]);
                                        ?>
                                        <img src="<?php echo base_url() . $firstImagePath ?>" alt="product image"
                                            class="img-fluid product_img">
                                        <?php } else { ?>
                                        <img class="product_img"
                                            src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                        <?php } ?>

                                        <!-- <div class="card-body category_data" data-productdetailid="<?php echo $product['product_id'];?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>">
                                            <a
                                                href="javascript:void(0)">
                                                <h5><?php //echo $product['product_name']; ?>&nbsp;&nbsp;<?php echo $product['parent'] ?>
                                                </h5>
                                            </a>
                                        </div> -->
                                        <div class="card-body" data-productdetailid="<?php echo $product['product_id'];?>">
                                        <?php
                                        if(isset($product['sub_child_name'])){
                                            $url =  base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']).'/'.str_replace(' ', '_', $product['sub_category_name']).'/'.$product['sub_child_name'].'/'.str_replace(' ', '_', $product['child_sub_category_name']).'/'.$product['product_name'];
                                        }else{
                                            $url =  base_url('').'shop' .'/'.str_replace(' ', '_', $product['category_name']).'/'.str_replace(' ', '_', $product['sub_category_name']).'/'.str_replace(' ', '_', $product['child_sub_category_name']).'/'.$product['product_name'];
                                        } 
                                        ?>
                                            <a href="<?php echo $url; ?>">
                                                <h5><?php echo $product['product_name']; ?>&nbsp;&nbsp;<?php echo $product['parent'] ?>
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php } ?>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>

    <!--~~~~~~~~~~~~~~~~~~~~>> OUR PRODUCTS END <<~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--~~~~~~~~~~~~~~~~~~~~>> TESTIMONIALS START <<~~~~~~~~~~~~~~~~~ -->
    <!-- <section class="testimonial_main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial_title text-center">
                    <h2><?php echo $testominal_title; ?></h2>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="owl-carousel-2 owl-carousel owl-theme">

                        <?php //if ($testimonalData) { ?>
                            <?php //foreach ($testimonalData as $testominal) { ?>
                                <div class="item">
                                    <div class="test_img">
                                        <img src="<?php //echo base_url() . $testominal['testimo_img'] ?>" alt="client" class="img-fluid testominal_img">
                                    </div>
                                    <div class="testi_card text-center">
                                        <div class="test_text">
                                            <h5><?php //echo $testominal['full_name']; ?></h5>
                                            <h6><?php //echo $testominal['designation']; ?></h6>
                                        </div>
                                        <div class="test_icon">
                                            <i class="fa-solid fa-quote-left"></i>
                                        </div>
                                        <?php //echo $testominal['description']; ?>
                                    </div>
                                </div>
                            <?php //} ?>
                        <?php //} ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
    <!--~~~~~~~~~~~~~~~~~~~>> TESTIMONIALS END <<~~~~~~~~~~~~~~~~~-->
    <!--~~~~~~~~~~~~~~~~~~>> PARTNER LOGO START <<~~~~~~~~~~~~~~~-->
    <section class="partner_main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo_title text-center">

                        <h2><?php echo $partner_title; ?></h2>
                        <p><?php echo $partner_description; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="owl-carousel-3 owl-carousel owl-carousel_1 owl-theme">
                            <?php if ($partnerImageData) { ?>
                            <?php foreach ($partnerImageData as $partner) { ?>
                            <div class="item">
                                <div class="logo_img text-md-right">
                                    <a href="<?php echo $partner['image_link']; ?> " target="_blank">
                                        <img src="<?php echo base_url() . $partner['image_path'] ?>" alt="partner logo" class="img-fluid" style="width: 100%">
                                    </a>
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

    <script src="<?php echo base_url() ?>public/front/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>
    <script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email is required!",
                    email: "Please enter valid email address."
                },
                password: {
                    required: "Password is required!"
                }
            }
        });

        $('.alert').delay(3000).fadeOut(300);
    });
    </script>
    <script>
    $(document).ready(function() {
        $('.owl-carousel_1').owlCarousel({
            items: 1, // Number of items to display at a time
            loop: true, // Infinite loop
            autoplay: true, // Autoplay the carousel
            autoplayTimeout: 3000, // Autoplay interval in milliseconds
            autoplayHoverPause: true, // Pause autoplay on hover
            responsive: { // Responsive settings for different screen sizes
                375: {
                    items: 1 //
                },
                768: { // For screens >= 768px
                    items: 3 // Show 2 items at a time
                },
                992: { // For screens >= 992px
                    items: 4 // Show 3 items at a time
                }
            }
        });
    });

    $('.slider_text').click(function (e) {
        // Log or use the left-side content as needed
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>breadcrumb/replace', // Adjust the URL based on your routes
            data: {
                breadcrumb: ''
            },
            success: function(response) {
                // Display an alert with the breadcrumb information
                // window.location.href = redirectUrl;
            },
            error: function(error) {
                console.error('Error storing breadcrumb:', error);
            }
        });
    });

    $(function() {
        $('.category_data').click(function(e) {
            // Prevent the default behavior of the link (following the href)
            e.preventDefault();

            // Get the text content of the clicked link
            var cateId = $(this).attr('data-catid');
            var subcatid = $(this).attr('data-subcatid');
            var productdetailid = $(this).attr('data-productdetailid');
            var redirectUrl = $(this).data('url');

                // Make an AJAX request to a CodeIgniter 4 controller method
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>session/store', // Adjust the URL based on your routes
                data: {
                    child_id: cateId,
                    sub_category_id: subcatid,
                    product_details_id: productdetailid,
                },
                success: function(response) {
                    // Display an alert with the breadcrumb information
                    window.location.href = redirectUrl;
                },
                error: function(error) {
                    console.error('Error storing breadcrumb:', error);
                }
            });
        });
    });
</script>