<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<style>
    section.category_product .container {
    max-width: 86%;
}
</style>
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
                <div class="panel panel-default side-nav side-nav-category" bis_skin_checked="1">
                    <div class="panel-heading" bis_skin_checked="1">
                        <strong>Categories</strong>
                    </div>
                    <div class="panel-body" bis_skin_checked="1">
                        <div class="panel-group" id="accordion" bis_skin_checked="1">
                            <?php if(isset($categoryData)) { ?>
                            <?php foreach ($categoryData as $category) : ?>
                                <div class="panel panel-default" bis_skin_checked="1">
                                    <div class="panel-heading" bis_skin_checked="1" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $category['category_id']; ?>">
                                        <p class="panel-title">
                                            <i class="fa fa-caret-right"></i>&nbsp;<a href=""><?php echo strtoupper($category['category_name']); ?></a>
                                        </p>
                                    </div>
                                    <?php if (!empty($category['sub_category'])) : ?>
                                        <div id="collapse<?php echo $category['category_id']; ?>" class="panel-collapse collapse <?php echo ($category['category_id'] == 1) ? 'in' : ''; ?>" bis_skin_checked="1">
                                            <?php foreach ($category['sub_category'] as $subCategory) : ?>
                                                <div class="panel-heading" bis_skin_checked="1">
                                                    <p class="panel-title">
                                                        <i class="fa fa-caret-right"></i>&nbsp;<a href="<?php echo base_url('') . "childsub/category/" . $subCategory['sub_category_id'] ?>"><?php echo strtoupper($subCategory['sub_category_name']); ?></a>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="row">


                    <?php if (isset($categoryData)) { ?>
                        <?php foreach ($categoryData as $category) { ?>
                            <div class="col-lg-3">
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
                                        <a href="<?php echo base_url('') . "sub/category/" . $category['category_id'] ?>">
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