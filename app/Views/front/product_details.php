<?= $this->include('front/layout/front'); ?>
<?php $session = session();
$wishlistCount = session('wishlistCount');
?>

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
    <?php if (!empty($productData && $productDataPrice)) {  ?>
        <section class="product_tab my-5">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <?php if (session()->getFlashdata('success')) { ?>
                            <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
                        <?php } ?>
                        <?php if (session()->getFlashdata('error')) { ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mobile_tabs">
                            <?php if (!empty($productData[0]['product_img'])) { ?>

                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <?php
                                    $productImages = explode(',', $productData[0]['product_img']);
                                    foreach ($productImages as $index => $image) {
                                    ?>
                                        <a class="nav-link<?php if ($index === 0) echo ' active'; ?>" id="v-pills-<?php echo $index; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $index; ?>" role="tab" aria-controls="v-pills-<?php echo $index; ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                            <img src="<?php echo base_url() . trim($image); ?>" alt="image">
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <?php
                                    foreach ($productImages as $index => $image) {
                                    ?>
                                        <div class="tab-pane fade<?php if ($index === 0) echo ' show active'; ?>" id="v-pills-<?php echo $index; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $index; ?>-tab">
                                            <img src="<?php echo base_url() . trim($image); ?>" alt="image">
                                        </div>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>

                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                            <?php } ?>


                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="samsung_galaxy">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h3><?php echo $productData[0]['product_name'] ?>&nbsp;&nbsp;<?php echo $productData[0]['parent'] ?></h3>
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
                            <h3 class="mt-2"><?php echo "$" . $productDataPrice[0]['min_price'] . " - " . "$" . $productDataPrice[0]['max_price']; ?></h3>

                            <div class="row">
                                <div class="stock">
                                    <?php if (ceil($averageRating) == 1) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/1.png" class=" mt-2 mr-3" alt="">
                                    <?php   } elseif (ceil($averageRating) == 2) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/2.png" class=" mt-2 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 3) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/3.png" class=" mt-2 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 4) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/4.png" class=" mt-2 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 5) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/5.png" class=" mt-2 mr-3" alt="">

                                    <?Php } else { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/0.png" class=" mt-2 mr-3" alt="">

                                    <?Php } ?>
                                </div>

                                <h6 class="rating"><?php echo $rating; ?> : Review </h6>
                            </div>
                            <br>

                            <h4>Variants</h4>
                            <?php $firstProduct = true; ?>
                            <?php foreach ($productData as $product) { ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row p-1">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <div class="variant-container">
                                                    <input class="minus" value="-" type="button">
                                                    <input type="number" class="input-text qty text variant-qty" step="1" min="0" max="" name="variant_qty[]" value="0" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off">
                                                    <input class="plus" value="+" type="button">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <h4><?php echo $product['variant_sku']; ?></h4>
                                                <h6><?php echo $product['variant_name']; ?></h6>
                                            </div>
                                            <div class="col-md-2">
                                                <h4><?php echo "$" . $product['variant_price']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            <?php } ?>
                            <button type="button" onclick="add_cart()" class="btn add_cart cart_hover">Add to cart</button>
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
</form>
<!-- ----------------------------- -->
<section class="additionnal">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="additionnal_tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">User Review</a>
                        </li>
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
                                            <?php if (isset($productData[0]['product_img'])) {
                                                $imagePaths = explode(',', $productData[0]['product_img']);
                                                $firstImagePath = trim($imagePaths[0]);
                                            ?>
                                                <img src="<?php echo base_url() . $firstImagePath ?>" alt="product image" class="img-fluid product_img">
                                            <?php } else { ?>
                                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="additionnal_info">
                                <?php if(isset($productData[0]['product_additional_info'])){ ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <?php echo $productData[0]['product_additional_info'] ?>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="col-md-12 text-center-t1">
                                <div class="form-group mt-5 mb-5 data_center text-center">
                                    <h4>No Data Found</h4>
                                </div>
                            </div>
                            <?php }?>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <div class="additionnal_info">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <form method="post" style="width: 100%; display: contents;" action="<?php echo base_url("feedback") ?>">
                                            <div class="box-body">
                                                <div class="mb-2">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4>Add feedback
                                                                <hr>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_o">
                                                        <div class="col-sm-12">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="product_id" value="<?php echo $productData[0]['product_id']; ?>" />
                                                                    <label for="fname">Rating:</label>
                                                                    <br />
                                                                    <div class="rating">
                                                                        <input type="radio" id="star1" name="rating" value="1" required />
                                                                        <label for="star1" title="text">1 star</label>
                                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                                        <label for="star2" title="text">2 stars</label>
                                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                                        <label for="star3" title="text">3 stars</label>
                                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                                        <label for="star4" title="text">4 stars</label>
                                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                                        <label for="star5" title="text">5 stars</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_o">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="fname">Message:</label>
                                                                <textarea class="form-control" name="message"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row margin_o">
                                                        <div class="col-md-12">
                                                            <div class="box-footer">
                                                                <input type="submit" class="btn btn-primary details_btn1 feedback_btn" value="Submit" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>





                    <div class="glance">
                        <h3>Similer Products</h3>
                    </div>
                    <hr class="similer">
                    <div class="row">
                        <?php if (isset($sub_cat_data) && !empty($sub_cat_data)) {  ?>
                            <?php foreach ($sub_cat_data as $product) { ?>
                                <div class="col-md-3">
                                    <div class="product_box">
                                        <div class="product_img">
                                            <?php
                                            $productImages = explode(',', $product['product_img']);
                                            $firstImage = trim($productImages[0]);
                                            ?>
                                            <?php if (!empty($product['product_img'])) { ?>
                                                <img class="img-fluid card-img-top" src="<?php echo base_url() . $firstImage ?>" alt="image">
                                            <?php } else { ?>
                                                <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="product_text text-center">
                                            <a href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>" class="category-link">
                                                <h3 class="mt-3"><?php echo $product['product_name']; ?>&nbsp;&nbsp;<?php echo $product['parent'] ?></h3>
                                                <span><a href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>" class="btn btn-primary mt-2 details_btn1">Details</a></span>
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
        </div>
        <div class="row mb-5">
            <p>Can’t find what you are looking for? Please <a href="<?php echo base_url('contact'); ?>"> contact us </a> here</p>
        </div>
    </div>
</section>
<?php } ?>

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
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please select a quantity greater than zero for at least one variant.',
            });
            return; // Exit the function to prevent the AJAX request
        }
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            window.location.href = '<?php echo base_url(); ?>login'; // Replace with the login page URL
            return; // Exit the function to prevent the AJAX request
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
                    window.location.href = '<?= base_url("add/cart") ?>'; // Replace with the shopping cart page URL
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