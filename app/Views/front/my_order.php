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
          <?php if (isset($ordersByOrderId)) { ?>
              <?php foreach ($ordersByOrderId as $orderId => $orderData) { ?>
             
                  <table class="table card table-responsive">
                      <tr class="mainsetcolor">
                          <th colspan="1">Order Id: #<?php echo $orderId; ?></th>
                          <th colspan="1">Order By: <?php echo $orderData[0]['full_name']; ?></th>
                          <th colspan="1">Order Date: <?php echo date('d-m-Y H:i:s', strtotime($orderData[0]['order_date'])); ?></th>
                          <th colspan="1">Payment Status: <?php echo $orderData[0]['order_status']; ?></th>
                          <th colspan="2"></th>
                          <th colspan="2">Cancel Order: <a href="#" class="btn btn-sm btn-danger OrderStatus" data-id="<?php echo $orderId; ?>"><i class="fa fa-close" aria-hidden="true"></i></a></th>
                      </tr>
                      <tr>
                          <th>Product name</th>
                          <th>Product details</th>
                          <th>Variant</th>
                          <th>Part Number</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>Total Price</th>
                          <th>Order Status</th>
                          <th>Shipping</th>
                      </tr>
                      <?php foreach ($orderData as $order) { ?>
                          <tr>
                              <td><?php echo $order['product_name']; ?>&nbsp;<?php // echo $order['parent']; ?></td>
                              <td><?php echo $order['product_description']; ?></td>
                              <td><?php echo $order['variant_name']; ?></td>
                              <td><?php echo $order['variant_sku']; ?></td>
                              <td><?php echo $order['product_quantity']; ?></td>
                              <td><?php echo number_format($order['product_amount'], 2, '.', ','); ?></td>
                              <td><?php echo number_format($order['total_amount'], 2, '.', ','); ?></td>
                              <td><?php echo $order['order_status']; ?></td>
                              <td><?php echo $order['shipping']; ?></td>
                          </tr>
                      <?php } ?>
                      <tr>

                        <td colspan="4" style="text-align: right;">Discount :
                        <?php
                                  // $discount = 0;
                                  // foreach ($orderData as $dis) {
                                  //     $discount = $dis['product_discount'];
                                  // }

                                  // if($dis['discount_type'] = 'Percentage' ){

                                  //   echo $discount."%";
                                  // }else{
                                  //   echo $discount."Rs";
                                  // }
                                  $couponModel = model('App\Models\CouponModel');
                                  $discount = 000.00;
                                  foreach ($orderData as $dis) {
                                    $getCoupon = $couponModel->where('coupon_id', $dis['coupon_id'])->first();
                                    if(!empty($getCoupon))
                                    {
                                      if ($getCoupon['coupon_price_type'] == 'Percentage') 
                                      {
                                          $discount += ($dis['product_amount'] * $dis['product_quantity'] * $getCoupon['coupon_price']) / 100;
                                      } else if ($getCoupon['coupon_price_type'] == 'Flat') {
                                          $discount += $dis['product_amount'] * $dis['product_quantity'] - $getCoupon['coupon_price'];
                                      }
                                    }
                                  }

                                  echo number_format($discount, 2, '.', ',');
                              ?>


                        </td>
                        <td colspan="2">Grand Total</td>
                          <td>
                              <?php
                                  // $grandTotal = 0;
                                  // foreach ($orderData as $order) {
                                  //     $grandTotal = $order['final_total_ammount'];
                                  // }
                                  // echo $grandTotal;

                                  $grandTotal = 0;
                                  foreach ($orderData as $order) {
                                      $grandTotal += $order['total_amount'];
                                  }
                                  echo number_format($grandTotal, 2, '.', ',');
                              ?>
                          </td>
                          <td></td>
                          <td>
                          <form method="post" action="<?php echo site_url('my_order/pdf'); ?>">
      <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
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
<script>
  $(document).ready(function() {
    $(".OrderStatus").click(function(e) {
      e.preventDefault();
      var order_id = $(this).attr('data-id');

      Swal.fire({
        title: 'Cancel Order',
        text: 'Are you sure you want to cancel this order?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, cancel it!'
      }).then(function(result) {
        if (result.isConfirmed) {

          $.ajax({
            url: "<?php echo base_url('deleteOrder'); ?>",
            data: {
              "order_id": order_id
            },
            type: 'POST',
            success: function(result) {
              Swal.fire({
                title: 'Order Cancelled',
                text: 'The order has been cancelled.',
                icon: 'success'
              }).then(function() {
                location.reload();
              });
            },
            error: function(xhr, status, error) {
              Swal.fire({
                title: 'Error',
                text: 'An error occurred while cancelling the order.',
                icon: 'error'
              });
            }
          });
        }
      });
    });
  });
</script> 