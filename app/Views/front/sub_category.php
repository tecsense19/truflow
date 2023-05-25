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
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="form-group mt-5 mb-5">
                <h4>Sub Category</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="form-group mt-5 mb-5">
                <div class="row">
                    <!-- contant chnage here -->
                    <?php if (isset($subcategoryData)) { ?>
                        <?php foreach ($subcategoryData as $subcategory) { ?>
                            <div class="col-md-4">
                                <a href="<?php echo base_url('') . "product/" . $subcategory['sub_category_id'] ?>" class="category-link">
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo base_url() . $subcategory['sub_category_img'] ?>" alt="Card 1">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $subcategory['sub_category_name']; ?></h5>
                                            <p class="card-text"><?php echo $subcategory['sub_category_description']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- ---------------  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>