<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START  shop.php <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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
                        <h2 class="breadcrumb-list" style="display: flex; justify-content: center; flex-wrap: wrap;"><div> <a href="<?php echo base_url() ?>shop"> SHOP </a> </div> </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START  shop.php<<~~~~~~~~~~~~~~~-->

<section class="category_product my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default side-nav side-nav-category" bis_skin_checked="1">
                    <div class="panel-heading" bis_skin_checked="1">
                        <strong>Categories</strong>
                    </div>
                    <div class="panel-body" bis_skin_checked="1">
                        <?php echo view('front/shop_sidebar'); ?>
                        <!-- <div class="panel-group" id="accordion" bis_skin_checked="1">
                            <?php if(isset($categoryData)) { ?>
                            <?php foreach ($categoryData as $category) : ?>
                            <div class="panel panel-default" bis_skin_checked="1">
                                <div class="panel-heading" bis_skin_checked="1" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapse<?php echo $category['category_id']; ?>">
                                    <p class="panel-title">
                                        <i class="fa fa-caret-right"></i>&nbsp;<a
                                            href="<?php echo base_url('') . "sub/category/" . $category['category_id'] ?>"><?php echo strtoupper($category['category_name']); ?></a>
                                    </p>
                                </div>
                                <?php if (!empty($category['sub_category'])) : ?>
                                <div id="collapse<?php echo $category['category_id']; ?>"
                                    class="panel-collapse collapse <?php echo ($category['category_id'] == 1) ? 'in' : ''; ?>"
                                    bis_skin_checked="1">
                                    <?php foreach ($category['sub_category'] as $subCategory) : ?>
                                    <div class="panel-heading" bis_skin_checked="1">
                                        <p class="panel-title">
                                            <i class="fa fa-caret-right"></i>&nbsp;<a
                                                href="<?php echo base_url('') . "childsub/category/" . $subCategory['sub_category_id'] ?>"><?php echo strtoupper($subCategory['sub_category_name']); ?></a>
                                        </p>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                            <?php } ?>
                        </div> -->
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="row">


                    <?php if (isset($categoryData)) { ?>
                    <?php foreach ($categoryData as $category) { ?>
                        <a class="category_data" href="javasript:void(0)" data-catid="<?php echo $category['category_id']; ?>" data-url="<?php echo base_url('') . "sub/category/" . $category['category_name'] ?>">
                        <div class="col-lg-3">
                            <div class="product_box">
                                <div class="product_img">
                                    <?php if (!empty($category['category_img'])) { ?>
                                    <img class="img-fluid card-img-top"
                                        src="<?php echo base_url() . $category['category_img'] ?>" alt="image">
                                    <?php } else { ?>
                                    <img class="img-fluid card-img-top"
                                        src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
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

<script>
$(function() {
    $('.category_data').click(function(e) {
        // Prevent the default behavior of the link (following the href)
        e.preventDefault();

        // Get the text content of the clicked link
        var cateId = $(this).attr('data-catid');

        var redirectUrl = $(this).data('url');

            // Make an AJAX request to a CodeIgniter 4 controller method
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>session/store', // Adjust the URL based on your routes
            data: {
                category_id: cateId
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