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
        $segment[] = urldecode(str_replace('-', ' ', $explodeUrl[$i]));
    }

    $breadcrumb = [];
    $currentSegment = '';
    foreach ($segment as $key => $seg) {
        if($key > 4)
        {
            $currentSegment .= $key != 5 ? '/' . str_replace(' ', '-', $seg) : str_replace(' ', '-', $seg);
            $breadcrumb[] = anchor(base_url($currentSegment), $seg);
        }
    }
?>
<?= $this->include('front/layout/front'); ?>
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
    height: 100vh;
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
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default side-nav side-nav-category" bis_skin_checked="1">
                    <div class="panel-heading" bis_skin_checked="1">
                        <strong>Categories</strong>
                    </div>
                    <div class="panel-body" bis_skin_checked="1">
                        <div id="accordian">
                            <ul class="show-dropdown">
                                <?php if (isset($sidebarData)) { foreach ($sidebarData as $key => $category) { 
                                        $catUrl = base_url() . 'shop/' . str_replace(' ', '-', $category['category_name']);
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
                                                renderSubCategory($category['sub_category'], $category['category_name'], $segment);
                                            }
                                        ?>
                                    </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>

                    <?php
                        function renderSubCategory(&$subcategories, $catName, $segment) {
                            if (!empty($subcategories)) {
                                echo '<ul class="show-dropdown">';
                                foreach ($subcategories as $subCategory) {
                                    if (isset($subCategory['sub_category_name'])) 
                                    {                                        
                                        $active = in_array($subCategory['sub_category_name'], $segment) ? 'active' : '';

                                        $catUrl = base_url() . 'shop/' . str_replace(' ', '-', $catName) . '/' . str_replace(' ', '-', $subCategory['sub_category_name']);

                                        echo '<li class="'.$active.'">';
                                        echo '<div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                                        if (count($subCategory['child_arr']) > 0) {
                                            renderChildCategory($subCategory['child_arr'], '', $segment, $catName, $subCategory['sub_category_name']);
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

                        function renderChildCategory(&$subcategories, $flag, $segment, $catName, $subcatName) {
                            // echo '<pre>';print_r($subcatName);echo '</pre>';
                            if($flag == true)
                            {
                                foreach ($subcategories as $subCategory) {
                                    $active = in_array($subCategory['child_sub_category_name'], $segment) ? 'active' : '';

                                    $catUrl = base_url() . 'shop/' . str_replace(' ', '-', $catName) . '/' . str_replace(' ', '-', $subcatName) . '/' . str_replace(' ', '-', $subCategory['child_sub_category_name']);

                                    echo '<li class="'.$active.'">';
                                    echo '<div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                                    if (count($subCategory['child_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderChildCategory($subCategory['child_arr'], 1, $segment, $catName, $subcatName);
                                        echo '</ul>';
                                    }
                                    if (count($subCategory['product_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderProducts($subCategory['product_arr'], $segment, $catName, $subcatName, $subCategory['child_sub_category_name']);
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                }
                                
                            }
                            else
                            {
                                echo '<ul class="show-dropdown">';
                                foreach ($subcategories as $subCategory) {
                                    // echo '<pre>';print_r($subCategory);echo '</pre>';
                                    $active = in_array($subCategory['child_sub_category_name'], $segment) ? 'active' : '';
                                    
                                    $catUrl = base_url() . 'shop/' . str_replace(' ', '-', $catName) . '/' . str_replace(' ', '-', $subcatName) . '/' . str_replace(' ', '-', $subCategory['child_sub_category_name']);

                                    echo '<li class="'.$active.'"><div class="main-name-with-arrow"><a href="'. $catUrl .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a><i class="fas fa-angle-down dropdown-i mr-2"></i></div>';
                                    if (count($subCategory['child_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderChildCategory($subCategory['child_arr'], 1, $segment, $catName, $subcatName);
                                        echo '</ul>';
                                    }
                                    if (count($subCategory['product_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderProducts($subCategory['product_arr'], $segment, $catName, $subcatName, $subCategory['child_sub_category_name']);
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        }

                        function renderProducts(&$products,$segment, $catName, $subcatName, $childsubcate)
                        {
                            foreach ($products as $product) {
                                $active = in_array($product['product_name'], $segment) ? 'active' : '';

                                $catUrl = base_url() . 'shop/' . str_replace(' ', '-', $catName) . '/' . str_replace(' ', '-', $subcatName) . '/' . str_replace(' ', '-', $childsubcate) . '/' . str_replace(' ', '-', $product['product_name']);

                                echo '<li class="'.$active.'"><a href="'. $catUrl .'"><i class="far fa-dot-circle mr-2"></i>'. $product['product_name'] .'</a>';
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php 
                        if (isset($categoryData) && count($categoryData) > 0) {
                            foreach ($categoryData as $category) { ?>
                                <div class="col-lg-3">
                                    <a href="<?php echo base_url() . "shop/" . str_replace(' ', '-', $category['category_name']) ?>">
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
                                $redirectUrl = $subCategory['isProduct'] ? base_url('') . "product/" . str_replace(' ', '-', $subCategory['sub_category_name'])  : base_url('') . "childsub/category/" . str_replace(' ', '-', $subCategory['sub_category_name']); ?>
                                <div class="col-lg-3">
                                    <a href="<?php echo base_url() . "shop/" . str_replace(' ', '-', $subCategoryData->category_name) . '/' . str_replace(' ', '-', $subCategory['sub_category_name']) ?>">
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
                                $redirectUrl = $subCategory['isProduct'] ? base_url('') . "product/".str_replace(' ', '-', $subCategory['child_sub_category_name']) : base_url('') . "childsub_sub/category/" . str_replace(' ', '-', $subCategory['child_sub_category_name']); ?>
                                <div class="col-lg-3">
                                    <a href="<?php echo base_url() . "shop/" . str_replace(' ', '-', $catName) . '/' . str_replace(' ', '-', $subCatName) . '/' . str_replace(' ', '-', $subCategory['child_sub_category_name']) ?>">
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
                                // echo '<pre>';print_r($segment);echo '</pre>';
                                $sagment7 = str_replace(' ', '-', $segment[7]);
                                $sagment8 = str_replace(' ', '-', $segment[8]);
                                $productLink = base_url() . 'shop/' . $segment[6] . '/' .$sagment7 . '/' .$sagment8 . '/' . $product['product_name'];
                                ?>
                                <div class="col-lg-3">
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
                    
                    <?php 
                        if (isset($variantArr)) {
                            foreach ($variantArr as $variant) { 
                    ?>
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
                                            <?php if (!empty($variant['product_img'])) { ?>
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <?php
                                                    $productImages = explode(',', $variant['product_img']);
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
                                                    <h3><?php echo $variant['parent'] ?></h3>
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="glance">
                                                        <p><?php echo $variant['product_description'] ?></p>
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php } } ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
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