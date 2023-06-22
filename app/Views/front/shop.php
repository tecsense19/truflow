<?= $this->include('front/layout/front'); ?>
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
            <?php if (isset($categoryData)) {?>
                <?php foreach ($categoryData as $category) { ?>
                    <div class="col-lg-4">
                        <div class="product_box">
                            <div class="product_img">
                                <img class="img-fluid card-img-top" src="<?php echo base_url() . $category['category_img'] ?>" alt="image">
                            </div>
                            <div class="product_text text-center">
                                <a href="<?php echo base_url('') . "sub_category/" . $category['category_id'] ?>">
                                    <h3 class="mt-3"><?php echo $category['category_name']; ?></h3>
                                </a>
                                <span><?php echo $category['category_description']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-12 text-center-t1">
                    <div class="form-group mt-5 mb-5 data_center text-center">
                        <h4>No Item Found</h4>
                    </div>

                <?php } ?>
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