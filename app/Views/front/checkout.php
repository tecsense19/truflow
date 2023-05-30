<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>Checkout</h2>
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
                <h4>Checkout</h4>
            </div>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
    <?php } ?>
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php } ?>
    <form class="mb-0 mt-4" method="post" id="product_form" action="<?php echo base_url() ?>place_order" enctype='multipart/form-data'>
        <?php if (isset($cartData)) { ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="form-group mt-5 mb-5">
                        <div class="row">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Part Number</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if ($cartData) { ?>

                                        <?php foreach ($cartData as $cart) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $cart['product_name']; ?></td>
                                                <td><?php echo $cart['variant_sku']; ?></td>
                                                <td>
                                                    <?php if (isset($cart['product_img'])) { ?>
                                                        <a data-fancybox="preview" href="<?php echo base_url('') . $cart['product_img'] ?>"><img src="<?php echo base_url('') . $cart['product_img'] ?>" alt="Image" class="" width="100"></a>
                                                    <?php } else { ?>
                                                        <?php echo "-"; ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $cart['product_quantity']; ?></td>
                                                <td><?php echo $cart['product_amount']; ?></td>
                                                <td><?php echo $cart['total_amount']; ?></td>


                                            </tr>

                                            <?php $i++; ?>
                                        <?php } ?>
                                        <?php
                                        $grandTotal = 0;
                                        foreach ($cartData as $cart) {
                                            $grandTotal += $cart['total_amount'];
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6">Grand Total: </td>
                                            <td><?php echo $grandTotal; ?></td>

                                        </tr>


                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="5" class="text-center"><?php echo "No Data"; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>


                            <!-- ---------------  -->
                        </div>
                    </div>
                </div>
            </div>



            <h2>Billing Address</h2>
            <?php if ($cartData) { ?>
                <?php foreach ($cartData as $cart) { ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="first_name">First name</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo $cart['first_name']; ?>" class="form-control input-custom" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form9Example2">Last name</label>
                                <input type="text" id="form9Example2" name="last_name" value="<?php echo $cart['last_name']; ?>" class="form-control input-custom" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form9Example6">Address</label>
                                <input type="text" id="form9Example6" name="address" value="" class="form-control input-custom" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="user_id">Email</label>
                                <input type="email" id="typeEmail" name="email" value="<?php echo $cart['email']; ?>" class="form-control input-custom" />
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <h2 class="mt-4">Payment Method</h2>

            <div class="row mb-4 mt-2">
                <div class="col">
                    <div class="form-outline">

                        <label class="radio">select payment</label>
                        <input class="radio" type="radio" name="pay_method" value="cash" /> <span>Cash</span>

                    </div>
                </div>
            </div>
            <div class="row mb-4 mt-2 text-center">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $cart['user_id']; ?>" />
                <input type="hidden" id="cart_id" name="cart_id" value="<?php echo $cart['cart_id']; ?>" />
                <input type="hidden" id="category_id" name="category_id" value="<?php echo $cart['category_id']; ?>" />
                <input type="hidden" id="sub_category_id" name="sub_category_id" value="<?php echo $cart['sub_category_id']; ?>" />
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $cart['product_id']; ?>" />
                <input type="hidden" id="variant_id" name="variant_id" value="<?php echo $cart['variant_id']; ?>" />
                <input type="hidden" id="product_quantity" name="product_quantity" value="<?php echo $cart['product_quantity']; ?>" />
                <input type="hidden" id="product_amount" name="product_amount" value="<?php echo $cart['product_amount']; ?>" />
                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $cart['total_amount']; ?>" />


                <button type="submit" class="btn btn-primary btn-rounded" style="background-color: #0062CC ;">Place order</button>
            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center-t1">
                <div class="form-group mt-5 mb-5 data_center text-center">
                    <h4>No Item Found</h4>
                </div>
            </div>
        <?php } ?>

    </form>


</div>
<script>


</script>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>