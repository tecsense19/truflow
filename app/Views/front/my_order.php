<?= $this->include('front/layout/front'); ?>
<style>
          
table.table.card {
  background: #fff;
  border-radius: 15px;
  border-top: 3px solid #394e65;
  margin-bottom: 20px;
}
.mainsetcolor {
    color: #d75176;
}
      </style>  
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>My Order</h2>
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
                <h4>My Order</h4>
            </div>
        </div>
    </div>
    <!-- ----------------------- -->

<section class="section aboutsecond pt-5 pb-3">
  <div class="container">
    <?php if(isset($orderData)){ ?>
        <?php foreach($orderData as $order){ ?>
    <table class="table card">
      <tr class="mainsetcolor">
        <th colspan="1">Order Id: #<?php echo $order['order_id'];?></th>
        <th colspan="1">Order By: <?php echo $order['full_name'];?></th>
        <th colspan="1">Order Date: <?php echo $order['created_at'];?></th>
        <th colspan="1">Payment Status: <?php echo $order['order_status'];?></th>
        <th colspan="1"></th>
        <th colspan="2">Cancel Order: <a href="" class="btn btn-sm btn-danger OrderStatus" data-id="<?php echo $order['order_id']; ?>"><i class="fa fa-close" aria-hidden="true"></i></a></th>
      </tr>
      <tr>
        <th>Product name</th>
        <th>Product details</th>
        <th>Variant</th>
        <th>Part Number</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Order Status</th>
      </tr>
      <tr>
        <td><?php echo $order['product_name'];?></td>
        <td><?php echo $order['product_description'];?></td>
        <td><?php echo $order['variant_name'];?></td>
        <td><?php echo $order['variant_sku'];?></td>
        <td><?php echo $order['product_quantity'];?></td>
        <td><?php echo $order['product_amount'];?></td>
        <td><?php echo $order['order_status'];?></td>
      </tr>
      <tr>
        <td colspan="5">Total</td>
        <td><?php echo $order['total_amount'];?></td>
        <td>
          <form method="post" action="">
            <input type="hidden" value="" name="order_id">
            <p><input type="submit" class="btn" value="Print"></p>
          </form>
        </td>
      </tr>
    </table>
    <?php } ?>
    <?php } ?>
  </div>
</section>

    
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>