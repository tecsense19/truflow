<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>Wish List</h2>
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
                <h4>Wish List</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>


        <?php if (isset($cartData)) { ?>

            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Part Number</th>
                        <th>Image</th>
                       
                        <th>Amount</th>
                        
                        <th>Actions</th>
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
                               
                                <td><?php echo $cart['variant_price']; ?></td>
                               
                                <td>
                                    <a class="" href="<?php echo base_url('') . "deleteWishList_data/" . $cart['wishid'] ?>"><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>

                            <?php $i++; ?>
                        <?php } ?>
                       
                       


                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-center"><?php echo "No Data"; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        <?php } else { ?>
          
          
        <div class="col-md-12 text-center-t1">
            <div class="form-group mt-5 mb-5 data_center text-center">
                <h4>No Item Found</h4>
            </div>
       
    </div>
        <?php } ?>


    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>