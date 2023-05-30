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
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="form-group mt-5 mb-5">
                <div class="row">
                    <!-- contant chnage here -->
                    <?php 
                    if(isset($cartData)){
                     ?>   
                    
                    
                  <?php }  ?>
                    <!-- ---------------  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>