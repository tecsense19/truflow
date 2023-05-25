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
                <h4>Product</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="form-group mt-5 mb-5">
                <div class="row">
                <?php if (isset($productData)) { ?>
                            <?php foreach ($productData as $product) { ?>
                    <div class="col-md-4">
                        <!-- contant chnage here -->
                        
                        <a href="<?php echo base_url('') . "product_details/" . $product['product_id'] ?>" class="category-link">
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo base_url() . $product['product_img'] ?>" alt="Card 1">
                                        <div class="card-body">
                                            <h2 class="card-title"><?php echo $product['product_name']; ?></h2>
                                         
                                            <button class="btn btn-primary mt-2">Details</button>
                                        </div>
                                    </div>
                                </a>
                           
                        <!-- ---------------  -->
                    </div>
                    <?php } ?>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>