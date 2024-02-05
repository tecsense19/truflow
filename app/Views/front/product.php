<?= $this->include('front/layout/front');?>
<style>
    section.category_product .container {
    max-width: 86%;
}
</style>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START product.php <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2 class="breadcrumb-list" style="display: flex;justify-content: center;flex-wrap: wrap;text-transform: capitalize;"><div> <a href="<?php echo base_url() ?>shop"> SHOP </a> </div> <?= session('breadcrumb') ?></h2>
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
                        <?php echo view('front/shop_sidebar'); ?>
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
                                            <a href="javasript:void(0)" data-catid="<?php echo $product['product_id']; ?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" class="category-link category_data"><img class="img-fluid card-img-top" src="<?php echo base_url() . $firstImage ?>" alt="image"></a>
                                        <?php } else { ?>
                                            <a href="javasript:void(0)" data-catid="<?php echo $product['product_id']; ?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" class="category-link category_data"><img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image"></a>

                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="product_text text-center">
                                        <a href="javasript:void(0)" data-catid="<?php echo $product['product_id']; ?>" data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" class="category-link category_data">
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
                product_details_id: cateId
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