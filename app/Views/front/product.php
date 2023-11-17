<?= $this->include('front/layout/front');?>
<style>
    section.category_product .container {
    max-width: 86%;
}
</style>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>SHOP</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START <<~~~~~~~~~~~~~~~-->
<section class="category_product my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default side-nav side-nav-category">
                    <div class="panel-heading">
                        <strong>Sub Categories</strong>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <?php foreach ($subcategoryData1 as $index => $subcategory) : ?>
                                <div class="panel panel-default">
                                    
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $index; ?>">

                                        <p class="panel-title">
                                        <i class="fa fa-caret-right"></i>&nbsp;
                                            <a href="<?php echo base_url('') . "sub/category/" . $subcategory['category_id'] ?>"><?php echo strtoupper($subcategory['sub_category_name']); ?></a>
                                        </p>
                                    </div>
                                        <div id="collapse<?php echo $index; ?>" class="panel-collapse collapse">
                                            <?php if (!empty($subcategory['product_array'])) : ?>
                                                <div class="panel-body">
                                                    <?php foreach ($subcategory['product_array'] as $product) : ?>
                                                        <p>
                                                            <i class="fa fa-caret-right"></i>
                                                            <a class="pro_link" href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>">
                                                                <?php echo $product['product_name']; ?>&nbsp;&nbsp;<?php echo $product['parent'] ?>
                                                            </a>
                                                        </p>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <!-- try ul li -->
                                        <?php foreach ($categories as $key => $value) {
                                            foreach ($value['sub_cat'] as $key => $value1) {
                                                if ($value1['sub_category_name'] == $subcategory['sub_category_name']) {
                                                    $found = true; ?>
                                                    <?php if (!empty($value1['child_arr'])) : ?>
                                                       
                                                            <?php foreach ($value1['child_arr'] as $childsubcategory) : ?>
                                                                <!-- <li><span class="caret"> -->
                                                                        <?php //echo $childsubcategory['child_sub_category_name']; ?>
                                                                    </span>
                                                                    <?php if (!empty($childsubcategory['all_childs'])) : ?>
                                                                        <?php //displayChildren($childsubcategory['all_childs']); ?>
                                                                    <?php endif; ?>
                                                                <!-- </li> -->
                                                            <?php endforeach; ?>
                                                    <?php endif; ?>
                                        <?php
                                                    break; // Exit the inner loop
                                                }
                                            }
                                            if ($found) {
                                                break; // Exit the outer loop if the subcategory is found
                                            }
                                        } ?>
                                        <!-- try end -->
                                    
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php if (isset($productData) && !empty($productData)) {  ?>
                        <?php foreach ($productData as $product) { ?>
                            <div class="col-lg-3">
                                <div class="product_box">
                                    <div class="product_img">
                                        <?php
                                        $productImages = explode(',', $product['product_img']);
                                        $firstImage = trim($productImages[0]);
                                        ?>
                                        <?php if (!empty($product['product_img'])) { ?>
                                            <a href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>" class="category-link"><img class="img-fluid card-img-top" src="<?php echo base_url() . $firstImage ?>" alt="image"></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>" class="category-link"><img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image"></a>

                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="product_text text-center">
                                        <a href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>" class="category-link">
                                            <h3><?php echo $product['parent'] ?><h6><?php echo $product['product_short_description']; ?></h6></h3>
                                            
                                            <span><button class="btn btn-primary mt-2 details_btn">Details</button></span>
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
        <!-- <div class="text-center">
            <a href="#!" class="load_more">Load More <i class="fa-solid fa-rotate-right"></i></a>
        </div> -->
    </div>
</section>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>

<script>
   function toggleSubCategory(event, subCategoryId, element) {
    event.preventDefault();

    var subCategoryPanel = element.getAttribute('href');
    var expanded = document.querySelector(subCategoryPanel).classList.contains('in');

    var panels = document.getElementsByClassName('panel-collapse');
    for (var i = 0; i < panels.length; i++) {
        panels[i].classList.remove('in');
    }

    var titleIcon = element.querySelector('i.fa');
    if (!expanded) {
        document.querySelector(subCategoryPanel).classList.add('in');
        titleIcon.classList.remove('fa-caret-right');
        titleIcon.classList.add('fa-caret-down');
    } else {
        titleIcon.classList.remove('fa-caret-down');
        titleIcon.classList.add('fa-caret-right');
    }
}

</script>