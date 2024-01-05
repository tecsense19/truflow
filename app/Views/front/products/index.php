<?php 
    $currentURL = current_url();
    $explodeUrl = explode('/', $currentURL);
    // echo "<pre>";
    // print_r($explodeUrl[7]);
    // die;
    // Get the total number of segments in the URI
    $totalSegments = count($explodeUrl);

    $segment = [];
    // Loop through all segments and display each one
    for ($i = 0; $i < $totalSegments; $i++) {
        $segment[] = urldecode(str_replace('_', ' ', $explodeUrl[$i]));
    }
    $resultArray = array_slice($segment, 4);
    // echo '<pre>';print_r(array_slice($resultArray, 0, -1));echo '</pre>';
    // echo '<pre>';print_r(str_replace(' ', '_', implode("/",$resultArray)));echo '</pre>';die;

    $breadcrumb = [];
    $currentSegment = '';
    foreach ($segment as $key => $seg) {
        if($key >= 4)
        {
            $currentSegment .=  '/' . str_replace(' ', '_', $seg);
            $breadcrumb[] = anchor(base_url($currentSegment), $seg);
        }
    }
?>
<?= $this->include('front/layout/front'); ?>
<?php
if (isset($variantArr) && count($variantArr)>0) {
    ?><style>
        section.category_product .container {
            max-width: 1140px !important;
        }
    </style> <?php
}
?>
<style>
    section.category_product .container {
        max-width: 86%;
    }

    /* Scrollbar-effect------- */
    #accordian::-webkit-scrollbar {
        width: 5px;
        height: 8px;
    }
    #accordian::-webkit-scrollbar-track {
        border-radius: 10px;
        /* background-color: #e4e4e4; */
    }
    #accordian::-webkit-scrollbar-thumb {
        /* background: #0089ff; */
        border-radius: 10px;
        transition: 0.5s;
    }
    #accordian::-webkit-scrollbar-thumb:hover {
        background: #d5b14c;
        transition: 0.5s;
    }



    /* --------- */
    body {
    /* background: #4EB889; */
    /* font-family: Nunito, arial, verdana; */
    }

    #accordian {
    /* background: #fff; */
    width: 100%;
    padding: 10px;
    /* float: left; */
    height: auto;
    overflow-x: hidden;
    }


    #accordian a {
    
    
    
    }


    i {
    margin-right: 10px;
    }

    #accordian li {
    list-style-type: none;
    }

    .main-name-with-arrow{
        display: flex;
        align-items:center;
        justify-content:space-between;
    }

    #accordian ul li a{
        color: #9c9c9c;
        text-decoration: none;
        font-size: 15px;
        display: block;
        /*  line-height: 34px; */
        padding: 12px 15px;
        transition: all 0.15s;
        position: relative;
        border-radius: 3px;
    }

    .show-dropdown {
        padding-left: 0px
    }

    #accordian>ul.show-dropdown>li.active>div,
    #accordian>ul>li>ul.show-dropdown>li.active>div,
    #accordian>ul>li>ul>li>ul.show-dropdown>li.active>div,
    #accordian>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>div,
    #accordian>ul>li>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>div{
        background-color: #005dab;
        color: white !important;
        box-shadow: 0px 1px 2px rgba(0, 137, 255, 0.2);
        margin-bottom: 5px;
    }

    #accordian>ul.show-dropdown>li.active>div>a,
    #accordian>ul>li>ul.show-dropdown>li.active>div>a,
    #accordian>ul>li>ul>li>ul.show-dropdown>li.active>div>a,
    #accordian>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>div>a,
    #accordian>ul>li>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>div>a{
        color: white !important;
    }

    #accordian>ul>li>ul,
    #accordian>ul>li>ul>li>ul,
    #accordian>ul>li>ul>li>ul>li>ul,
    #accordian>ul>li>ul>li>ul>li>ul>li>ul {
    display: none;
    }


    #accordian>ul>li.active>ul.show-dropdown,
    #accordian>ul>li>ul>li.active>ul.show-dropdown,
    #accordian>ul>li>ul>li>ul>li.active>ul.show-dropdown,
    #accordian>ul>li>ul>li>ul>li>ul>li.active>ul.show-dropdown {
    display: block;
    }

    #accordian>ul>li>ul,
    #accordian>ul>li>ul>li>ul,
    #accordian>ul>li>ul>li>ul>li>ul,
    #accordian>ul>li>ul>li>ul>li>ul>li>ul {
    padding-left: 20px;
    }

    /* detail table css */
    .table-front{
    background: white;
    text-align: center;
    } 

    .space{
    padding: 10px 0px;
    } 

    th, td {
      padding: 10px; /* Add padding here (adjust the value as per your preference) */
    }

    sub {
    color: #005dab;
    font-weight: 700;
    bottom: 0px;
    padding-left: 5px;
    }

    /* #accordian a::after {
        content: "▼";
        position: absolute;
        right: 20px;
        top: 14px;
        font-size: 15px;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
        padding-right: 3px;
        vertical-align: middle;
        font-weight: 900;
        transition: 0.5s;
    } */
    
    /* #accordian li:not(:only-child):after {
        content: "▼";
        position: absolute;
        right: 20px;
        top: 14px;
        font-size: 15px;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
        padding-right: 3px;
        vertical-align: middle;
        font-weight: 900;
        transition: 0.5s;
    } */

    #accordian .active>a:not(:only-child):after {
        transform: rotate(0deg);
    }

    .breadcrumb-list > div {
        font-size: 22px;
    }
    @media only screen and (min-width: 768px) and (max-width: 1024px)
    {
        input.minus {
            width: 75%;
        }
        input.input-text.qty.text.variant-qty {
            text-align: center;
            border-radius: 4px;
            border: 1px solid #737373;
            width: 75%;
            margin-top: 5px;
        }
        input.plus {
            width: 75%;
            margin-top: 5px;
        }
    }
    @media only screen and (min-width: 375px) and (max-width: 667px)
    {
        input.plus {
            width: 75%;
            margin-top: 5px;
        }
        input.input-text.qty.text.variant-qty {
            text-align: center;
            border-radius: 4px;
            border: 1px solid #737373;
            width: 75%;
            margin-top: 5px;
        }

        input.minus {
            width: 75%;
        }
        .add_cart{
            width: 200px;
            display: inline-block;
            background: #005DAB;
            text-align: center;
            padding: 10px 0px;
            color: #fff;
            transition: 0.5s;
            margin: 15px;
        }
    }
</style>
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2 class="breadcrumb-list" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <!-- <div> <a href="<?php echo base_url() ?>shop">  </a> </div> -->
                            <div> <?= implode(' > ', $breadcrumb) ?> </div>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="category_product my-5">
    <div class="container">
        <?php if(isset($variantArr) && empty($variantArr)){ ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xl-3">
                <div class="panel panel-default side-nav side-nav-category" bis_skin_checked="1">
                    <div class="panel-heading" bis_skin_checked="1">
                        <strong>Categories</strong>
                    </div>
                    <div class="panel-body" bis_skin_checked="1">
                        <div id="accordian">
                            <ul class="show-dropdown">
                                <?php if (isset($sidebarData)) { foreach ($sidebarData as $key => $category) { 
                                        $catUrl = base_url() .'shop/' . str_replace(' ', '_', $category['category_name']);
                                    ?>
                                    <li class="<?php if(in_array($category['category_name'], $segment)) { echo 'active'; } ?>">
                                        <div class="main-name-with-arrow">
                                        <a href="<?= $catUrl ?>" class="li-link">
                                            <i class="far fa-clone mr-2"></i>
                                            <?php echo strtoupper($category['category_name']); ?></a>
                                            <!-- <li><a href="javascript:void(0);">Today's tasks</a></li> -->
                                            <i class="fas fa-angle-down dropdown-i mr-2"></i>
                                        </div>
                                        <?php
                                            if(isset($category['sub_category']) && count($category['sub_category']) > 0) {
                                                renderSubCategory($category['sub_category'], $category['category_name'], $segment, [$catUrl]);
                                            }
                                        ?>
                                    </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>

                    
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xl-9">
                <div class="row">
                    <?php
                        if (isset($categoryData) && count($categoryData) > 0) {
                            foreach ($categoryData as $category) { ?>
                                <div class="col-lg-6 col-md-6 col-xl-3">
                                    <a href="<?php echo base_url() . str_replace(' ', '_', implode("/",$resultArray)) .'/'. str_replace(' ', '_', $category['category_name']) ?>">
                                        <div class="product_box">
                                            <div class="product_img">
                                                <?php if (!empty($category['category_img'])) { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url() . $category['category_img'] ?>" alt="image">
                                                <?php } else { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                                <?php } ?>
                                            </div>
                                            <hr>
                                            <div class="product_text text-center">
                                                <h3 class="mt-3"><?php echo $category['category_name']; ?></h3>
                                                <span><?php echo $category['category_description']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                    <?php } } ?>

                    <?php 
                        if (isset($subCategoryData->subCategory)) {
                            foreach ($subCategoryData->subCategory as $subCategory) { 
                                $redirectUrl = $subCategory['isProduct'] ? base_url('') . "product/" . str_replace(' ', '_', $subCategory['sub_category_name'])  : base_url('') . "childsub/category/" . str_replace(' ', '_', $subCategory['sub_category_name']); ?>
                                <div class="col-lg-6 col-md-6 col-xl-3">
                                    <a href="<?php echo base_url() . str_replace(' ', '_', implode("/",$resultArray)) . '/' . str_replace(' ', '_', $subCategory['sub_category_name']) ?>">
                                        <div class="product_box">
                                            <div class="product_img">
                                                <?php if (!empty($subCategory['sub_category_img'])) { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url() . $subCategory['sub_category_img'] ?>" alt="image">
                                                <?php } else { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                                <?php } ?>
                                            </div>
                                            <hr>
                                            <div class="product_text text-center">
                                                <h3 class="mt-3"><?php echo $subCategory['sub_category_name']; ?></h3>
                                                <span><?php echo $subCategory['sub_category_description']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                    <?php } } ?>
                    
                    <?php 
                        if (isset($childCategoryData)) {
                            foreach ($childCategoryData as $subCategory) { 
                                $redirectUrl = $subCategory['isProduct'] ? base_url('') . "product/".str_replace(' ', '_', $subCategory['child_sub_category_name']) : base_url('') . "childsub_sub/category/" . str_replace(' ', '_', $subCategory['child_sub_category_name']); 
                                ?>
                                <div class="col-lg-6 col-md-6 col-xl-3">
                                    <a href="<?php echo base_url() . str_replace(' ', '_', implode("/",$resultArray)) . '/' . str_replace(' ', '_', $subCategory['child_sub_category_name']) ?>">
                                        <div class="product_box">
                                            <div class="product_img">
                                                <?php if (!empty($subCategory['sub_category_img'])) { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url() . $subCategory['sub_category_img'] ?>" alt="image">
                                                <?php } else { ?>
                                                    <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                                <?php } ?>
                                            </div>
                                            <hr>
                                            <div class="product_text text-center">
                                                <h3 class="mt-3"><?php echo $subCategory['child_sub_category_name']; ?></h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                    <?php } } ?>
                    
                    <?php 
                        if (isset($productData)) {
                            foreach ($productData as $product) {
                                /*echo '<pre>';print_r($segment);echo '</pre>';
                                $sagment7 = isset($segment[7]) ? str_replace(' ', '_', $segment[7]) : '';
                                $sagment8 = isset($segment[8]) ? str_replace(' ', '_', $segment[8]) : '';
                                if($segment[6] && $sagment7 == '' && $sagment8 == ''){
                                    $productLink = base_url() . 'shop/' . $segment[6] . '/' .$product['product_name'];
                                }elseif($segment[6] && $sagment7 && $sagment8 == ''){
                                    $productLink = base_url() . 'shop/' .$segment[5] . '/' . $segment[6] . '/' .$sagment7 . '/' . $product['product_name'];
                                }elseif($segment[6] && $sagment7 && $sagment8){  
                                    $productLink = base_url() . 'shop/' . $segment[6] . '/' .$sagment7 . '/' .$sagment8 . '/' . $product['product_name'];
                                }*/
                                $productLink = base_url() . str_replace(' ', '_', implode("/",$resultArray)) . '/' . $product['product_name'];
                                ?>
                                <div class="col-lg-6 col-md-6 col-xl-3">
                                    <div class="product_box">
                                        <div class="product_img">
                                            <?php if (!empty($subCategory['product_img'])) { ?>
                                                <img class="img-fluid card-img-top" src="<?php echo base_url() . $subCategory['product_img'] ?>" alt="image">
                                            <?php } else { ?>
                                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="product_text text-center">
                                            <a href="<?php echo $productLink; ?>" data-catid="<?php echo $product['product_id']; ?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" class="category-link category_data">
                                                <h3><?php echo $product['product_name'] ?><h6><?php echo $product['product_short_description']; ?></h6></h3>
                                                <span><button class="btn btn-primary mt-2 details_btn">Details</button></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                    <?php } } ?>
                </div>
                 </div>
        </div>
        <?php }else{ ?>
        <div class="row">
            <div class="col-lg-12">
                <!-- main product -->
                <form method="post" id="#product_details" enctype='multipart/form-data'>
                    <?php if (!empty($variantArr && $minMaxPrice)) { ?>
                    <section class="product_tab my-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php if (session()->getFlashdata('success')) { ?>
                                        <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
                                    <?php } ?>
                                    <?php if (session()->getFlashdata('error')) { ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mobile_tabs mb-5">
                                        <?php if (!empty($variantArr[0]['product_img'])) { ?>

                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <?php
                                                $productImages = explode(',', $variantArr[0]['product_img']);
                                                foreach ($productImages as $index => $image) {
                                                ?>
                                                    <a class="nav-link<?php if ($index === 0) echo ' active'; ?>" id="v-pills-<?php echo $index; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $index; ?>" role="tab" aria-controls="v-pills-<?php echo $index; ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                                        <img src="<?php echo base_url() . trim($image); ?>" alt="image">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <?php
                                                foreach ($productImages as $index => $image) {
                                                ?>
                                                    <div class="tab-pane fade<?php if ($index === 0) echo ' show active'; ?>" id="v-pills-<?php echo $index; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $index; ?>-tab">
                                                        <img src="<?php echo base_url() . trim($image); ?>" alt="image">
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        <?php } else { ?>
                                            <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="samsung_galaxy">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <h3><?php echo $variantArr[0]['parent'] ?></h3>
                                            </div>
                                        </div>
                                        <h3 class="mt-2"><?php echo "$" . $minMaxPrice->min_price . " - " . "$" . $minMaxPrice->max_price; ?></h3>
                                        <div class="row">
                                            <div class="stock">
                                                <?php if (ceil($averageRating) == 1) { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/1.png" class=" mt-2 ml-3 mr-3" alt="">
                                                <?php   } elseif (ceil($averageRating) == 2) { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/2.png" class=" mt-2 ml-3 mr-3" alt="">

                                                <?Php } elseif (ceil($averageRating) == 3) { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/3.png" class=" mt-2 ml-3 mr-3" alt="">

                                                <?Php } elseif (ceil($averageRating) == 4) { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/4.png" class=" mt-2 ml-3 mr-3" alt="">

                                                <?Php } elseif (ceil($averageRating) == 5) { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/5.png" class=" mt-2 ml-3 mr-3" alt="">

                                                <?Php } else { ?>

                                                    <img src="<?php echo base_url() ?>public/front/images/0.png" class=" mt-2 ml-3 mr-3" alt="">

                                                <?Php } ?>
                                            </div>
                                            <h6 class="rating"><?php echo $rating; ?> : Review </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php } ?>
                    <!-- main product end-->

                    <!-- varient product -->
                    <?php if (isset($variantArr)) { ?>
                    <section class="category_product my-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <div class="row">
                                        <?php if (isset($variantArr)) { ?>
                                                <table class="table-responsive" style="width: 100%;">
                                                <thead>
                                                    <th style="width: 15%;text-align: center;">Part</th>
                                                    <th style="width: 15%;text-align: center;">Description</th>
                                                    <th style="width: 10%;text-align: center;">Quantity</th>
                                                    <th style="width: 15%;text-align: center;">Price</th>
                                                    <th style="width: 8%;text-align: center;"><?= isset($variantArr[0]['product_header1']) ? $variantArr[0]['product_header1'] : "Header 1"; ?></th>
                                                    <th style="width: 8%;text-align: center;"><?= isset($variantArr[0]['product_header2']) ? $variantArr[0]['product_header2'] : "Header 2"; ?></th>
                                                    <th style="width: 10%;text-align: center;"><?= isset($variantArr[0]['product_header3']) ? $variantArr[0]['product_header3'] : "Header 3"; ?></th>
                                                    <th style="width: 10%;text-align: center;"><?= isset($variantArr[0]['product_header4']) ? $variantArr[0]['product_header4'] : "Header 4"; ?></th>
                                                    <th style="width: 10%;text-align: center;">Stock</th>
                                                </thead>
                                                <tbody>
                                            <?php foreach ($variantArr as $variant) { ?>
                                                    <tr style=" box-shadow: 2px 2px 12px -2px rgb(50, 50, 50); border:5px solid white;">
                                                        <td class="table-front"><h5><?php echo $variant['variant_sku']; ?></h5></td>
                                                        <td class="table-front"><h6 class="space"><?php echo $variant['product_short_description']; ?></h6></td>
                                                        <td class="table-front">
                                                            <input class="minus" value="-" type="button" data-id="<?php echo $variant['variant_stock']; ?>" <?php if($variant['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                            <input type="number" class="input-text qty text variant-qty" step="1" min="0" max="" onkeyup="default_value(event, '<?php echo $variant['variant_stock']; ?>')" name="variant_qty[]" value="0" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off" <?php if($variant['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                            <input class="plus" value="+" type="button" data-id="<?php echo $variant['variant_stock']; ?>" <?php if($variant['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                        </td>
                                                        <td class="table-front">
                                                            <h4 style="display: contents;"><?php echo "$" . $variant['variant_price']; ?></h4> <sub> Ex-Gst</sub>
                                                        </td>
                                                        <td class="table-front">
                                                            <?php if(isset($variant['variant_description'])) {?>

                                                                <h6 class="space" style="word-wrap: break-word;"><?php echo $variant['variant_description']; ?></h6>
                                                            <?php } ?>
                                                        </td>

                                                        <td class="table-front">
                                                        <?php if(!empty($variant['variant_description_1'])) {?>

                                                                <h6 class="space" style="word-wrap: break-word;"><?php echo $variant['variant_description_1']; ?></h6>
                                                                <?php } ?>
                                                        </td>

                                                        <td class="table-front">
                                                        <?php if(!empty($variant['variant_description_2'])) {?>

                                                                <h6 class="space" style="word-wrap: break-word;"><?php echo $variant['variant_description_2']; ?></h6>
                                                                <?php } ?>
                                                        </td>

                                                        <td class="table-front">
                                                        <?php if(!empty($variant['variant_description_3'])) {?>

                                                                <h6 class="space" style="word-wrap: break-word;"><?php echo $variant['variant_description_3']; ?></h6>
                                                                <?php } ?>
                                                        </td>
                                                        <td class="table-front">
                                                        <?php if($variant['variant_stock'] > 0){ ?> <h6 class="" style="color: green;">In stock<h6><?php }else{?> <h6 class="" style="color: red;">Out of stock<h6> <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>

                                        <?php } else { ?>
                                            <div class="col-md-12 text-center-t1">
                                                <div class="form-group mt-5 mb-5 data_center text-center">
                                                    <h4>No Item Found</h4>
                                                </div>
                                            </div>
                                            <?php } ?>
                                    </div>
                                    <div class="col-md-12" style="text-align: end;">
                                    <button type="button" onclick="add_cart()" class="btn add_cart cart_hover">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php } ?>
                </form>
                <section class="additionnal">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="additionnal_tab">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User Review</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Additional information</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="product-detail-desc-item">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="glance">
                                                            <h3><?php echo $variantArr[0]['product_name'] ?></h3>
                                                            <p><?php echo $variantArr[0]['product_description'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="glance_img">
                                                            <?php if (isset($variantArr[0]['product_img'])) {
                                                                $imagePaths = explode(',', $variantArr[0]['product_img']);
                                                                $firstImagePath = trim($imagePaths[0]);
                                                            ?>
                                                                <img src="<?php echo base_url() . $firstImagePath ?>" alt="product image" class="img-fluid product_img">
                                                            <?php } else { ?>
                                                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="additionnal_info">
                                                <?php if(isset($variantArr[0]['product_additional_info'])){ ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-10">
                                                        <?php echo $variantArr[0]['product_additional_info'] ?>
                                                    </div>
                                                </div>
                                                <?php }else{ ?>
                                                <div class="col-md-12 text-center-t1">
                                                <div class="form-group mt-5 mb-5 data_center text-center">
                                                    <h4>No Data Found</h4>
                                                </div>
                                            </div>
                                            <?php }?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                                            <div class="additionnal_info">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-10">
                                                        <form method="post" style="width: 100%; display: contents;" action="<?php echo base_url("feedback") ?>">
                                                            <div class="box-body">
                                                                <div class="mb-2">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <h4>Add feedback
                                                                                <hr>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row margin_o">
                                                                        <div class="col-sm-12">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="product_id" value="<?php echo $variantArr[0]['product_id']; ?>" />
                                                                                    <label for="fname">Rating:</label>
                                                                                    <br />
                                                                                    <div class="rating">
                                                                                        <input type="radio" id="star1" name="rating" value="1" required />
                                                                                        <label for="star1" title="text">1 star</label>
                                                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                                                        <label for="star2" title="text">2 stars</label>
                                                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                                                        <label for="star3" title="text">3 stars</label>
                                                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                                                        <label for="star4" title="text">4 stars</label>
                                                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                                                        <label for="star5" title="text">5 stars</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row margin_o">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="fname">Message:</label>
                                                                                <textarea class="form-control" name="message"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row margin_o">
                                                                        <div class="col-md-12">
                                                                            <div class="box-footer">
                                                                                <input type="submit" class="btn btn-primary details_btn1 feedback_btn" value="Submit" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="glance">
                                        <h3>Similer Products</h3>
                                    </div>
                                    <hr class="similer">
                                    <div class="row">
                                        <?php if (isset($sub_cat_data) && !empty($sub_cat_data)) {
                                            ?>
                                            <?php foreach ($sub_cat_data as $product) { ?>

                                                <div class="col-md-6 col-sm-1 col-lg-3">
                                                    <div class="product_box">
                                                        <div class="product_img">
                                                            <?php
                                                            $productImages = explode(',', $product['product_img']);
                                                            $firstImage = trim($productImages[0]);
                                                            ?>
                                                            <?php if (!empty($product['product_img'])) { ?>
                                                                <img class="img-fluid card-img-top" src="<?php echo base_url() . $firstImage ?>" alt="image">
                                                            <?php } else { ?>
                                                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                                            <?php } ?>
                                                        </div>
                                                        <hr>
                                                        <div class="product_text text-center category_data" data-catid="<?php echo $product['product_id'];?>"  data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" >
                                                            <a href="javascript:void(0)" class="category-link">
                                                                <h3 class="mt-3"><?php echo $product['parent'] ?></h3>
                                                                <?php
                                                                /*$childcate = str_replace(' ', '_', $product['child_sub_category_name']);
                                                                $productLink = base_url() . 'shop/' . $product['category_name'] . '/' .$product['sub_category_name'] . '/' .$childcate . '/' . $product['product_name'];*/
                                                                $custom_segment = array_slice($resultArray, 0, -1);
                                                                $productLink = base_url().str_replace(' ', '_', implode("/",$custom_segment)).'/'.$product['product_name'];
                                                                ?>
                                                                <span class="category_data "  data-catid="<?php echo $product['product_id'];?>"  data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>"><a href="<?php echo $productLink; ?>" class="btn btn-primary mt-2 details_btn1">Details</a></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="col-md-12 text-center-t1">
                                                <div class="form-group mt-5 mb-5 data_center text-center">
                                                    <h4>No Item Found</h4>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <p>Can’t find what you are looking for? Please <a href="<?php echo base_url('contact'); ?>"> contact us </a> here</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<?php
    function renderSubCategory(&$subcategories, $catName, $segment, $breadcrumb = []) {
        // echo '<pre>';print_r($segment);echo '</pre>';
        if (!empty($subcategories)) {
            echo '<ul class="show-dropdown">';
            foreach ($subcategories as $subCategory) {
                if (isset($subCategory['sub_category_name'])) 
                {                                        
                    // echo '<pre>';print_r($subCategory['sub_category_name']);echo '</pre>';
                    $currentBreadcrumb = $breadcrumb;
                    $currentBreadcrumb[] = base_url('') .'shop/'. str_replace(' ', '_', $catName) .'/'. str_replace(' ','_', $subCategory['sub_category_name']);

                    /*$active = "";
                    if(strpos(implode('/', $segment), 'Hydraulic/Adaptors') !== false)
                    {
                        $active = strpos(implode('/', $segment), 'Hydraulic/'.$subCategory['sub_category_name']) ? 'active' : '';
                    }
                    else
                    {
                        $active = in_array($subCategory['sub_category_name'], $segment) ? 'active' : '';
                    }*/
                    
                    /*$active = strpos(implode('/', $segment), 'Hydraulic/'.$subCategory['sub_category_name']) ? 'active' : '';*/
                    
                    $active = in_array($subCategory['sub_category_name'], $segment) ? 'active' : '';
                    
                    $catUrl = base_url() . 'shop/' . implode("/",array_map('basename', $currentBreadcrumb));

                    echo '<li class="'.$active.'">';
                    echo '<div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                    if (count($subCategory['child_arr']) > 0) {
                        renderChildCategory($subCategory['child_arr'], '', $segment, $catName, $subCategory['sub_category_name'],$currentBreadcrumb);
                    }
                    if (count($subCategory['product_arr']) > 0) {
                        renderProducts($subCategory['product_arr'], $segment, $catName, $subCategory['sub_category_name'], '');
                    }
                    echo '</li>';
                }
            }
            echo '</ul>';
        }
    }

    function renderChildCategory(&$subcategories, $flag, $segment, $catName, $subcatName, $breadcrumb = []) {
        if($flag == true)
        {
            foreach ($subcategories as $subCategory) {
                $active = in_array($subCategory['child_sub_category_name'], $segment) ? 'active' : '';

                $currentBreadcrumb = $breadcrumb;
                $currentBreadcrumb[] = base_url('') .'shop/'. str_replace(' ', '_', $catName) .'/'. str_replace(' ', '_', $subcatName) . '/'. str_replace(' ', '_', $subCategory['child_sub_category_name']);

                $catUrl = base_url() . 'shop/' . implode("/",array_map('basename', $currentBreadcrumb));

                echo '<li class="'.$active.'">';
                echo '<div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                if (count($subCategory['child_arr']) > 0) {
                    echo '<ul class="show-dropdown">';
                        renderChildCategory($subCategory['child_arr'], 1, $segment, $catName, $subcatName, $currentBreadcrumb);
                    echo '</ul>';
                }
                if (count($subCategory['product_arr']) > 0) {
                    echo '<ul class="show-dropdown">';
                        renderProducts($subCategory['product_arr'], $segment, $catName, $subcatName, $subCategory['child_sub_category_name'],$currentBreadcrumb);
                    echo '</ul>';
                }
                echo '</li>';
            }
            
        }
        else
        {
            echo '<ul class="show-dropdown">';
            foreach ($subcategories as $subCategory) {
                $active = in_array($subCategory['child_sub_category_name'], $segment) ? 'active' : '';
                $currentBreadcrumb = $breadcrumb;
                $currentBreadcrumb[] = base_url('') .'shop/'. str_replace(' ', '_', $catName) .'/'. str_replace(' ', '_', $subcatName) . '/'. str_replace(' ', '_', $subCategory['child_sub_category_name']);
                
                $catUrl = base_url() . 'shop/' . implode("/",array_map('basename', $currentBreadcrumb));

                echo '<li class="'.$active.'"><div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                if (count($subCategory['child_arr']) > 0) {
                    echo '<ul class="show-dropdown">';
                        renderChildCategory($subCategory['child_arr'], 1, $segment, $catName, $subcatName, $currentBreadcrumb);
                    echo '</ul>';
                }
                if (count($subCategory['product_arr']) > 0) {
                    echo '<ul class="show-dropdown">';
                        renderProducts($subCategory['product_arr'], $segment, $catName, $subcatName, $subCategory['child_sub_category_name'], $currentBreadcrumb);
                    echo '</ul>';
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    function renderProducts(&$products,$segment, $catName, $subcatName, $childsubcate,$breadcrumb = [])
    {
        foreach ($products as $product) {
            $currentBreadcrumb = $breadcrumb;
            $currentBreadcrumb[] = base_url('') .'shop/'. str_replace(' ', '_', $catName) .'/'. str_replace(' ', '_', $subcatName) . '/'. str_replace(' ', '_', $childsubcate) . '/' .str_replace(' ', '_', $product['product_name']);

            $active = in_array($product['product_name'], $segment) ? 'active' : '';
            $catUrl = base_url() . 'shop/' . implode("/",array_map('basename', $currentBreadcrumb));

            echo '<li class="'.$active.'"><a href="'. $catUrl .'"><i class="far fa-dot-circle mr-2"></i>'. $product['product_name'] .'</a>';
        }
    }
?>
<?= $this->include('front/layout/footer'); ?>
<script>
$(document).ready(function() {
    $("#accordian div").click(function() {
        var link = $(this);
        var closest_ul = link.closest("ul");
        var parallel_active_links = closest_ul.find(".active");
        var closest_li = link.closest("li");
        var link_status = closest_li.hasClass("active");
        var count = 0;

        closest_ul.find("ul").slideUp(function() {
            if (++count == closest_ul.find("ul").length){
                parallel_active_links.removeClass("active");
                parallel_active_links.children("ul").removeClass("show-dropdown");
                parallel_active_links.children("ul").css("display", "none");
            }
        });

        if (!link_status) {
            closest_li.children("ul").slideDown().addClass("show-dropdown");
            closest_li.parent().parent("li.active").find('ul').find("li.active").removeClass("active");
            link.parent().addClass("active");
        }
    })
});

// --------for-active-class-on-other-page-----------
jQuery(document).ready(function($){
    // Get current path and find target link
    var path = window.location.pathname.split("/").pop();
  
    // Account for home page with empty path
    if ( path == '' ) {
      path = 'index.html';
    }
     
    var target = $('#accordian li a[href="'+path+'"]');
    // Add active class to target link
    target.parents("li").addClass('active');
    target.parents("ul").addClass("show-dropdown");
});
</script>

<script>
    var variantQtyInputs = document.querySelectorAll('.variant-qty');

    // Add event listeners to plus/minus buttons for each variant
    var minusButtons = document.querySelectorAll('.minus');
    var plusButtons = document.querySelectorAll('.plus');

    for (var i = 0; i < minusButtons.length; i++) {
        var minusButton = minusButtons[i];
        var plusButton = plusButtons[i];

        minusButton.addEventListener('click', function() {
            var input = this.nextElementSibling;
            var currentValue = parseInt(input.value);
            if (currentValue > 0) {
                var Id = $(this).data('id');
                if(currentValue == Id){
                    input.value = currentValue - 1;
                }else{
                    input.value = currentValue - 1;
                }
            }
        });

        plusButton.addEventListener('click', function() {
            var input = this.previousElementSibling;
            var currentValue = parseInt(input.value);
            var Id = $(this).data('id');
                if(currentValue >= Id){
                    input.value = currentValue ;
                }
                else
                {
                    input.value = currentValue + 1;
                }
        });
    }

    function add_cart() {
        
            var variantQtys = Array.from(variantQtyInputs).map(function(input) {
                return input.value;
            });

            var hasSelectedQuantity = variantQtys.some(function(qty) {
                return qty !== "" && parseInt(qty) > 0;
            });


            if (!hasSelectedQuantity) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please select a quantity greater than zero for at least one variant.',
                });
                return; // Exit the function to prevent the AJAX request
            }

            var variantIds = <?php echo json_encode(array_column($variantArr, 'variant_id')); ?>;
            var productIds = <?php echo json_encode(array_column($variantArr, 'product_id')); ?>;
            var categoryIds = <?php echo json_encode(array_column($variantArr, 'category_id')); ?>;
            var subCategoryIds = <?php echo json_encode(array_column($variantArr, 'sub_category_id')); ?>;
            var prices = <?php echo json_encode(array_column($variantArr, 'variant_price')); ?>;


            var totalPrices = [];
            for (var i = 0; i < variantQtys.length; i++) {
                var total = parseFloat(variantQtys[i]) * parseFloat(prices[i]);
                totalPrices.push(total.toFixed(2));
            }

            $.ajax({
                url: '<?php echo base_url(); ?>add_cart', // Replace with the server-side script URL
                method: 'POST',
                data: {
                    variant_qty: variantQtys,
                    variant_id: variantIds,
                    product_id: productIds,
                    category_id: categoryIds,
                    sub_category_id: subCategoryIds,
                    prices: prices,
                    total_prices: totalPrices
                },
                success: function(response) {
                    // Handle the response
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data added into cart successfully.',
                    }).then(function() {
                        // Reload the page after the user clicks "OK" on the SweetAlert dialog
                        window.location.href = '<?= base_url("add/cart") ?>'; // Replace with the shopping cart page URL
                    });
                },
                error: function(xhr, status, error) {
                    // Log the error details
                    console.error('Error occurred during AJAX request.');
                }
            });
    }

    function default_value(event, maxVal)
    {
        if(event.target.value >= maxVal){
            event.target.value = maxVal ;
        }

    }

</script>
