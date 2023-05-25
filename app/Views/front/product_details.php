<?= $this->include('front/layout/front'); ?>
<?php $session = session(); ?>

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
<section class="about_inner_page">

    <div class="container">

        <form method="post" id="#product_details" enctype='multipart/form-data'>
            <?php if (!empty($productData && $productDataPrice)) { ?>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about_img">
                            <img src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="about_image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about_content mt-5">
                            <h1><?php echo $productData[0]['product_name'] ?></h1>
                            <h3><?php echo "$" . $productDataPrice[0]['min_price'] . " - " . "$" . $productDataPrice[0]['max_price']; ?></h3>
                            <p><?php echo $productData[0]['product_description'] ?></p>
                            <br>
                            <h4>Variants</h4>
                            <br>
                            <?php $firstProduct = true; ?>

                            <?php foreach ($productData as $product) { ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row p-1">
                                                <div class="col-md-2">
                                                    <input type="number" id="variant_qty" class="input-text qty text" step="1" min="0" max="" name="variant_qty[]" value="" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off">
                                                </div>
                                                <div class="col-md-6">
                                                    <h4><?php echo $product['variant_name']; ?>
                                                    </h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4><?php echo "$" . $product['variant_price']; ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-2"></div>
                                        <div class="col-md-6">
                                            <h6><?php echo $product['variant_sku']; ?></h6>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($session->get('logged_in')) { ?>
                                <button type="button" onclick="add_cart()" class="btn add_cart">Add to cart</button>
                            <?php } else { ?>
                                <a href="<?php echo base_url('login') ?>"> <button type="button" class="btn add_cart">Add to cart</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12 text-center-t1">
                    <div class="form-group mt-5 mb-5 data_center text-center">
                        <h4>No Item Found</h4>
                    </div>

                <?php } ?>
        </form>

    </div>
</section>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->



<script>
    function add_cart() {
        var variantQtys = $('input[name="variant_qty[]"]').map(function() {
            return $(this).val();
        }).get(); // Get an array of variant quantities

        var variantIds = <?php echo json_encode(array_column($productData, 'variant_id')); ?>; // Retrieve an array of variant IDs
        var productIds = <?php echo json_encode(array_column($productData, 'product_id')); ?>; // Retrieve an array of product IDs
        var categoryIds = <?php echo json_encode(array_column($productData, 'category_id')); ?>; // Retrieve an array of category IDs
        var subCategoryIds = <?php echo json_encode(array_column($productData, 'sub_category_id')); ?>; // Retrieve an array of subcategory IDs
        var prices = <?php echo json_encode(array_column($productData, 'variant_price')); ?>; // Retrieve an array of variant prices

        var totalPrices = [];
        for (var i = 0; i < variantQtys.length; i++) {
            var total = parseFloat(variantQtys[i]) * parseFloat(prices[i]);
            totalPrices.push(total.toFixed(2));
        }

        $.ajax({
            url: '<?php echo base_url(); ?>add_cart',
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
                    text: 'Data add into cart successfully.',
                }).then(function() {
                    // Reload the page after the user clicks "OK" on the SweetAlert dialog
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                // Log the error details
                console.error('Error occurred during AJAX request.');
            }
        });
    }
</script>




<?= $this->include('front/layout/footer'); ?>