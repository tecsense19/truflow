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
<form method="post" id="#product_details" enctype='multipart/form-data'>
    <?php if (!empty($productData && $productDataPrice)) { ?>
        <section class="product_tab my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mobile_tabs">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><img class="img_tab_view" src="<?php echo base_url() . $productData[0]['product_img'] ?>"></a> -->
                                <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>"></a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>"></a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>"></a>  -->
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><img class="img_tab_view_2" src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="image"></div>
                                <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="image"></div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="image"></div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><img src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="image"></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="samsung_galaxy">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h3><?php echo $productData[0]['product_name'] ?></h3>
                                </div>
                                <div class="col-sm-2">
                                    <?php if (isset($addwishData)) { ?>
                                        <?php if ($addwishData[0]['product_id'] == $productData[0]['product_id']) { ?>
                                            <img src="<?php echo base_url() ?>public/front/images/heartw1.png" class="deletewishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage1(this)" id="imagepreview1">

                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>public/front/images/heartw.png" class="wishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage(this)" id="imagepreview">

                                        <?php } ?>
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>public/front/images/heartw.png" class="wishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage(this)" id="imagepreview">
                                    <?php } ?>
                                </div>
                            </div>
                            <h3><?php echo "$" . $productDataPrice[0]['min_price'] . " - " . "$" . $productDataPrice[0]['max_price']; ?></h3>


                            <ul class="stock">
                                <li>In Stock</li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li>(36 Reviews)</li>
                            </ul>

                            <h4>Variants</h4>
                            <?php $firstProduct = true; ?>
                            <?php foreach ($productData as $product) { ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row p-1">
                                            <div class="col-md-3">
                                                <div class="variant-container">
                                                    <input class="minus" value="-" type="button">
                                                    <input type="number" class="input-text qty text variant-qty" step="1" min="0" max="" name="variant_qty[]" value="0" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off">
                                                    <input class="plus" value="+" type="button">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <h6><?php echo $product['variant_name']; ?>
                                                </h6>
                                                <h4><?php echo $product['variant_sku']; ?></h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4><?php echo "$" . $product['variant_price']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            <?php } ?>
                            <?php if ($session->get('logged_in')) { ?>
                                <button type="button" onclick="add_cart()" class="btn add_cart">Add to cart</button>
                            <?php } else { ?>
                                <a href="<?php echo base_url('login') ?>"> <button type="button" class="btn add_cart">Add to cart</button></a>
                            <?php } ?>
                            <div class="compare">
                                
                                <ul class="social_icon">
                                    <li>Share: </li>
                                    <li><a href="#!"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#!"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#!"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#!"><i class="fa-brands fa-vimeo-v"></i></a></li>
                                </ul>
                                
                            </div>
                            <div class="secure">
                                <p>Guaranteed safe <br> & secure checkout</p>
                                <img src="<?php echo base_url() ?>public/front/images/payment-option-1.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ----------------------------- -->
        <section class="additionnal">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="additionnal_tab">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Additional information</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="product-detail-desc-item">
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="glance">
                        
                        <h3><?php echo $productData[0]['product_name'] ?></h3>
                        <p><?php echo $productData[0]['product_description'] ?></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="glance_img">
                        <img class="img-fluid" src="<?php echo base_url() . $productData[0]['product_img'] ?>" alt="image">
                      </div>
                    </div>
                  </div>
                  </div>
                 
                 
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="additionnal_info">
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                        <table>
                          <tbody>
                            <tr>
                                <td>Standing screen display size</td>
                                <td>Screen display Size 10.4</td>
                            </tr>
                            <tr>
                                <td>Color</td>
                                <td>Gray, Dark gray, Mystic black</td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
</form>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->


<script>
    var variantQtyInputs = document.querySelectorAll('.variant-qty');

    // Add event listeners to plus/minus buttons for each variant
    var minusButtons = document.querySelectorAll('.minus');
    var plusButtons = document.querySelectorAll('.plus');

    for (var i = 0; i < minusButtons.length; i++) {
        var minusButton = minusButtons[i];
        var plusButton = plusButtons[i];

        minusButton.addEventListener('click', function() {
            var input = this.nextElementSibling;
            var currentValue = parseInt(input.value);
            if (currentValue > 0) {
                input.value = currentValue - 1;
            }
        });

        plusButton.addEventListener('click', function() {
            var input = this.previousElementSibling;
            var currentValue = parseInt(input.value);
            input.value = currentValue + 1;
        });
    }

    function add_cart() {
        var variantQtys = Array.from(variantQtyInputs).map(function(input) {
            return input.value;
        });

        var hasSelectedQuantity = variantQtys.some(function(qty) {
            return qty !== "" && parseInt(qty) > 0;
        });

        if (!hasSelectedQuantity) {
            // Display validation message
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please select a quantity greater than zero for at least one variant.',
            });
            return; // Stop further execution of the function
        }

        var variantIds = <?php echo json_encode(array_column($productData, 'variant_id')); ?>;
        var productIds = <?php echo json_encode(array_column($productData, 'product_id')); ?>;
        var categoryIds = <?php echo json_encode(array_column($productData, 'category_id')); ?>;
        var subCategoryIds = <?php echo json_encode(array_column($productData, 'sub_category_id')); ?>;
        var prices = <?php echo json_encode(array_column($productData, 'variant_price')); ?>;


        var totalPrices = [];
        for (var i = 0; i < variantQtys.length; i++) {
            var total = parseFloat(variantQtys[i]) * parseFloat(prices[i]);
            totalPrices.push(total.toFixed(2));
        }

        $.ajax({
            url: '<?php echo base_url(); ?>add_cart', // Replace with the server-side script URL
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
                    text: 'Data added into cart successfully.',
                }).then(function() {
                    // Reload the page after the user clicks "OK" on the SweetAlert dialog
                    window.location.href = '<?= base_url("add_to_cart") ?>'; // Replace with the shopping cart page URL
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