<?= $this->include('front/layout/front'); ?>
<?php $session = session();
$wishlistCount = session('wishlistCount');
?>
<style>
    .product_box{
    padding: 20px;
    text-align: center;
}
.variant-container{
    display: flex;
    justify-content: space-around;
    padding: 10px 0px;
}
.space{
    padding: 10px 0px;
}
.grid_50{
    display: grid;
    word-break: break-all;
    grid-template-columns: 50% 50%;
    padding: 0px 0px;
}
.table-front{
    background: white;
    text-align: center;

}

th, td {
      padding: 10px; /* Add padding here (adjust the value as per your preference) */
    }

@media only screen
and (min-width: 768px)
and (max-width: 1024px)
{
    a.btn.btn-primary.mt-2.details_btn1 {
        background: #005dab;
        text-align: center;
        border: 0px;
        border-radius: 4px;
        width: 100px;
    }
    input.plus {
    width: 75%;
    margin-top: 5px;
}
input.input-text.qty.text.variant-qty {
    text-align: center;
    border-radius: 4px;
    border: 1px solid #737373;
    width: 75%;
    margin-top: 5px;
}

input.minus {
    width: 75%;
}
}
@media only screen
and (min-width: 375px)
and (max-width: 667px)
{
.add_cart{
    width: 200px;
    display: inline-block;
    background: #005DAB;
    text-align: center;
    padding: 10px 0px;
    color: #fff;
    transition: 0.5s;
    margin: 15px;
}

input.plus {
    width: 75%;
    margin-top: 5px;
}
input.input-text.qty.text.variant-qty {
    text-align: center;
    border-radius: 4px;
    border: 1px solid #737373;
    width: 75%;
    margin-top: 5px;
}

input.minus {
    width: 75%;
}

}
</style>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START product_details <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2 class="breadcrumb-list" style="display: flex; justify-content: center; flex-wrap: wrap;"><div> <a href="<?php echo base_url() ?>shop"> SHOP </a> </div> <?= session('breadcrumb') ?></h2>
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
                        <div class="mobile_tabs mb-5">
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
                                    <h3><?php echo $productData[0]['parent'] ?></h3>
                                </div>
                                <!-- <div class="col-sm-2">
                                    <?php if (isset($addwishData)) { ?>


                                        <?php if ($addwishData[0]['product_id'] == $productData[0]['product_id']) { ?>
                                            <img src="<?php echo base_url() ?>public/front/images/heartw1.png" class="deletewishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage1(this)" id="imagepreview1">

                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>public/front/images/heartw.png" class="wishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage(this)" id="imagepreview">

                                        <?php } ?>
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>public/front/images/heartw.png" class="wishlistsubmit mb-2" alt="" data-product_id="<?php echo $productData[0]['product_id']; ?>" onclick="changeImage(this)" id="imagepreview">
                                    <?php } ?>
                                </div> -->
                            </div>
                            <h3 class="mt-2"><?php echo "$" . $productDataPrice[0]['min_price'] . " - " . "$" . $productDataPrice[0]['max_price']; ?></h3>

                            <div class="row">
                                <div class="stock">
                                    <?php if (ceil($averageRating) == 1) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/1.png" class=" mt-2 ml-3 mr-3" alt="">
                                    <?php   } elseif (ceil($averageRating) == 2) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/2.png" class=" mt-2 ml-3 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 3) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/3.png" class=" mt-2 ml-3 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 4) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/4.png" class=" mt-2 ml-3 mr-3" alt="">

                                    <?Php } elseif (ceil($averageRating) == 5) { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/5.png" class=" mt-2 ml-3 mr-3" alt="">

                                    <?Php } else { ?>

                                        <img src="<?php echo base_url() ?>public/front/images/0.png" class=" mt-2 ml-3 mr-3" alt="">

                                    <?Php } ?>
                                </div>

                                <h6 class="rating"><?php echo $rating; ?> : Review </h6>
                            <!-- <div>
                                <h6 class="rating ml-4" style="color: green;"><?php //echo $productData[0]['']; ?> In stock</h6>
                            </div> -->

                            </div>

                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="glance">
                                            <!-- <h3><?php //echo $productData[0]['product_name'] ?></h3> -->
                                            <p><?php echo $productData[0]['product_description'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="glance_img">
                                            <?php if (isset($productData[0]['product_img'])) {
                                                $imagePaths = explode(',', $productData[0]['product_img']);
                                                $firstImagePath = trim($imagePaths[0]);
                                            ?>
                                                <!-- <img src="<?php //echo base_url() . $firstImagePath ?>" alt="product image" class="img-fluid product_img"> -->
                                            <?php } else { ?>
                                                <!-- <img class="img-fluid card-img-top" src="<?php //echo base_url(); ?>/public/uploads/no_img.png" alt="image"> -->

                                            <?php } ?>
                                        </div>


                            <!-- <button type="button" onclick="add_cart()" class="btn add_cart cart_hover">Add to cart</button>
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
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- <h4>Variants</h4>
                            <?php $firstProduct = true; ?>
                            <?php foreach ($productData as $product) { ?>

                                <div class="row">
                                    <div class="col-md-4">
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
                            </div> -->



            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="category_product my-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 table-responsive">
                <div class="row">

                    <?php if (isset($productData)) { ?>
                            <table class="table-responsive" style="width: 100%;">
                            <thead>
                                <th style="width: 15%;text-align: center;">Part</th>
                                <th style="width: 15%;text-align: center;">Description</th>
                                <th style="width: 10%;text-align: center;">Quantity</th>
                                <th style="width: 10%;text-align: center;">Price</th>
                                <th style="width: 10%;text-align: center;"><?= isset($productData[0]['product_header1']) ? $productData[0]['product_header1'] : "Header 1"; ?></th>
                                <th style="width: 10%;text-align: center;"><?= isset($productData[0]['product_header2']) ? $productData[0]['product_header2'] : "Header 2"; ?></th>
                                <th style="width: 10%;text-align: center;"><?= isset($productData[0]['product_header3']) ? $productData[0]['product_header3'] : "Header 3"; ?></th>
                                <th style="width: 10%;text-align: center;"><?= isset($productData[0]['product_header4']) ? $productData[0]['product_header4'] : "Header 4"; ?></th>
                                <th style="width: 10%;text-align: center;">Stock</th>
                            </thead>
                            <tbody>
                        <?php foreach ($productData as $product) { ?>
                                <tr style=" box-shadow: 2px 2px 12px -2px rgb(50, 50, 50); border:5px solid white;">
                                    <td class="table-front"><h5><?php echo $product['variant_sku']; ?></h5></td>
                                    <td class="table-front"><h6 class="space"><?php echo $product['product_short_description']; ?></h6></td>
                                    <td class="table-front">
                                        <input class="minus" value="-" type="button" data-id="<?php echo $product['variant_stock']; ?>" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                        <input type="number" class="input-text qty text variant-qty" step="1" min="0" max="" onkeyup="default_value(event, '<?php echo $product['variant_stock']; ?>')" name="variant_qty[]" value="0" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                        <input class="plus" value="+" type="button" data-id="<?php echo $product['variant_stock']; ?>" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                    </td>
                                    <td class="table-front">
                                        <h4 style="display: contents;"><?php echo "$" . $product['variant_price']; ?>
                                    </td>
                                    <td class="table-front">
                                        <?php if(isset($product['variant_description'])) {?>

                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description']; ?></h6>
                                        <?php } ?>
                                    </td>

                                    <td class="table-front">
                                    <?php if(!empty($product['variant_description_1'])) {?>

                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_1']; ?></h6>
                                            <?php } ?>
                                    </td>

                                    <td class="table-front">
                                    <?php if(!empty($product['variant_description_2'])) {?>

                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_2']; ?></h6>
                                            <?php } ?>
                                    </td>

                                    <td class="table-front">
                                    <?php if(!empty($product['variant_description_3'])) {?>

                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_3']; ?></h6>
                                            <?php } ?>
                                    </td>
                                    <td class="table-front">
                                    <?php if($product['variant_stock'] > 0){ ?> <h6 class="" style="color: green;">In stock<h6><?php }else{?> <h6 class="" style="color: red;">Out of stock<h6> <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <!-- <div class="col-lg-3">
                                <div class="product_box p-20">


                                            <div class="mr-3 ">
                                                <h4 ><?php echo $product['variant_sku']; ?></h4>
                                                <h6 class="space"><?php echo $product['variant_name']; ?></h6>

                                            </div>
                                            <div class="variant-container mr-3">
                                                    <input class="minus" value="-" type="button" data-id="<?php echo $product['variant_stock']; ?>" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                    <input type="number" class="input-text qty text variant-qty" step="1" min="0" max="" onkeyup="default_value(event, '<?php echo $product['variant_stock']; ?>')" name="variant_qty[]" value="0" title="Qty" size="4" placeholder="0" inputmode="numeric" autocomplete="off" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                    <input class="plus" value="+" type="button" data-id="<?php echo $product['variant_stock']; ?>" <?php if($product['variant_stock'] > 0){ ?> <?php }else{?> disabled <?php } ?>>
                                                    <h4 style="display: contents;"><?php echo "$" . $product['variant_price']; ?>
                                            </div>
                                            <?php if(isset($product['variant_header'])) {?>
                                           <div class="variant-container mr-3 text-left grid_50">
                                           <h6 class="space"><?php echo $product['variant_header']; ?></h6>
                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description']; ?></h6>
                                           </div>

                                           <?php } ?> <?php if(!empty($product['variant_header_1'])) {?>
                                           <div class="variant-container mr-3 text-left grid_50">
                                           <h6 class="space"><?php echo $product['variant_header_1']; ?></h6>
                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_1']; ?></h6>
                                           </div>

                                           <?php } ?> <?php if(!empty($product['variant_header_2'])) {?>
                                           <div class="variant-container mr-3 text-left grid_50">
                                           <h6 class="space"><?php echo $product['variant_header_2']; ?></h6>
                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_2']; ?></h6>
                                           </div>

                                           <?php } ?> <?php if(!empty($product['variant_header_3'])) {?>
                                           <div class="variant-container mr-3 text-left grid_50">
                                           <h6 class="space"><?php echo $product['variant_header_3']; ?></h6>
                                            <h6 class="space" style="word-wrap: break-word;"><?php echo $product['variant_description_3']; ?></h6>
                                           </div>
                                           <?php } ?>


                                    <hr>
                                    <?php if($product['variant_stock'] > 0){ ?> <h6 class="" style="color: green;">In stock<h6><?php }else{?> <h6 class="" style="color: red;">Out of stock<h6> <?php } ?>
                                </div>


                            </div> -->


                    <?php } else { ?>
                        <div class="col-md-12 text-center-t1">
                            <div class="form-group mt-5 mb-5 data_center text-center">
                                <h4>No Item Found</h4>
                            </div>

                        <?php } ?>
                        </div>
                </div>
                <div class="col-md-12" style="text-align: end;">
                <button type="button" onclick="add_cart()" class="btn add_cart cart_hover">Add to cart</button>
                </div>

            </div>
        </div>

        <!-- <div class="text-center">
            <a href="#!" class="load_more">Load More <i class="fa-solid fa-rotate-right"></i></a>
        </div> -->
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
                            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User Review</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Additional information</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
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


                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
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
                                        <div class="product_text text-center category_data" data-catid="<?php echo $product['product_id'];?>"  data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>" >
                                            <a href="javascript:void(0)" class="category-link">
                                                <h3 class="mt-3"><?php echo $product['parent'] ?></h3>
                                                <span class="category_data "  data-catid="<?php echo $product['product_id'];?>"  data-url="<?php echo base_url('') . "product/details/" . $product['product_name'] ?>"><a href="javascript:void(0)" class="btn btn-primary mt-2 details_btn1">Details</a></span>
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
                var Id = $(this).data('id');
                if(currentValue == Id){
                    input.value = currentValue - 1;
                }else{
                    input.value = currentValue - 1;
                }
            }
        });

        plusButton.addEventListener('click', function() {
            var input = this.previousElementSibling;
            var currentValue = parseInt(input.value);
            var Id = $(this).data('id');
                if(currentValue >= Id){
                    input.value = currentValue ;
                }
                else
                {
                    input.value = currentValue + 1;
                }
        });
    }

    function add_cart() {
        var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please log in before adding items to the cart.',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Reload the page after the user clicks "OK" on the SweetAlert dialog
                    window.location.href = '<?php echo base_url(); ?>login'; // Replace with the login page URL
                    return; // Exit the function to prevent the AJAX request
                }
            });
        }
        else
        {
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
    }

    function default_value(event, maxVal)
    {
        if(event.target.value >= maxVal){
            event.target.value = maxVal ;
        }

    }



</script>

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