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

    #accordian>ul.show-dropdown>li.active>a,
    #accordian>ul>li>ul.show-dropdown>li.active>a,
    #accordian>ul>li>ul>li>ul.show-dropdown>li.active>a,
    #accordian>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>a,
    #accordian>ul>li>ul>li>ul>li>ul>li>ul.show-dropdown>li.active>a{
        background-color: #005dab;
        color: white;
        box-shadow: 0px 1px 2px rgba(0, 137, 255, 0.2);
        margin-bottom: 5px;
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

    #accordian a:not(:only-child):after {
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
    }

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
                                        <a href="<?= $catUrl ?>"><i class="far fa-clone mr-2"></i><?php echo strtoupper($category['category_name']); ?></a>
                                            <!-- <li><a href="javascript:void(0);">Today's tasks</a></li> -->
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
                                        $subCatLink = base_url() . 'shop/' . str_replace(' ', '-', $catName) . '/' . $subCategory['sub_category_name'];
                                        
                                        $active = in_array($subCategory['sub_category_name'], $segment) ? 'active' : '';

                                        echo '<li class="'.$active.'">';
                                        echo '<a href="'. $subCatLink .'"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['sub_category_name']) .'</a>';
                                        if (count($subCategory['child_arr']) > 0) {
                                            renderChildCategory($subCategory['child_arr'], '', $segment);
                                        }
                                        if (count($subCategory['product_arr']) > 0) {
                                            renderProducts($subCategory['product_arr'], $segment);
                                        }
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            }
                        }

                        function renderChildCategory(&$subcategories, $flag, $segment) {
                            if($flag == true)
                            {
                                foreach ($subcategories as $subCategory) {

                                    $active = in_array($subCategory['child_sub_category_name'], $segment) ? 'active' : '';

                                    echo '<li class="'.$active.'">';
                                    echo '<a href="javascript:void(0);"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a>';
                                    if (count($subCategory['child_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderChildCategory($subCategory['child_arr'], 1, $segment);
                                        echo '</ul>';
                                    }
                                    if (count($subCategory['product_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderProducts($subCategory['product_arr'], $segment);
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

                                    // $childLink = base_url() . 'shop/' . $segment[6] . '/' . $segment[7] . '/' . $subCategory['child_sub_category_name'];

                                    echo '<li class="'.$active.'"><a href="javascript:void(0)"><i class="far fa-clone mr-2"></i>'. strtoupper($subCategory['child_sub_category_name']) .'</a>';
                                    if (count($subCategory['child_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderChildCategory($subCategory['child_arr'], 1, $segment);
                                        echo '</ul>';
                                    }
                                    if (count($subCategory['product_arr']) > 0) {
                                        echo '<ul class="show-dropdown">';
                                            renderProducts($subCategory['product_arr'], $segment);
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        }

                        function renderProducts(&$products)
                        {
                            foreach ($products as $product) {
                                echo '<li><a href="javascript:void(0);"><i class="far fa-dot-circle mr-2"></i>'. $product['product_name'] .'</a>';
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
                            foreach ($productData as $product) { ?>
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
                                            <a href="javasript:void(0)" data-catid="<?php echo $product['product_id']; ?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" class="category-link category_data">
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
    </div>
</section>
<?= $this->include('front/layout/footer'); ?>
<script>
$(document).ready(function() {
    $("#accordian a").click(function() {
        var link = $(this);
        var closest_ul = link.closest("ul");
        var parallel_active_links = closest_ul.find(".active")
        var closest_li = link.closest("li");
        var link_status = closest_li.hasClass("active");
        var count = 0;

        closest_ul.find("ul").slideUp(function() {
            if (++count == closest_ul.find("ul").length){
                parallel_active_links.removeClass("active");
                parallel_active_links.children("ul").removeClass("show-dropdown");
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