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
            <h2>My Orders</h2>
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
        <h4>My Orders</h4>
      </div>
    </div>
  </div>
  <!-- ----------------------- -->

  <section class="section aboutsecond pt-5 pb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
        <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>
        </div>
      </div>
          <?php if (isset($ordersByOrderId)) { ?>
              <?php foreach ($ordersByOrderId as $orderId => $orderData) { 
                ?>

                  <table class="table card table-responsive">
                      <tr class="mainsetcolor">
                          <th colspan="1" style="white-space: nowrap;">Order Id: <br>#<?php echo $orderId; ?></th>
                          <!-- <th colspan="1" style="white-space: nowrap;">Order By: <br><?php //echo $orderData[0]['full_name']; ?></th> -->
                          <th colspan="3">Order Date: <br><?php echo date('d-m-Y H:i:s', strtotime($orderData[0]['order_date'])); ?></th>
                          <th colspan="2" style="white-space: nowrap;">Payment Status: <br><?php echo $orderData[0]['payment_status']; ?></th>
                          <th colspan="2" style="white-space: nowrap;">
                            Payment Type: <br>
                            <?php if($orderData[0]['pay_method'] == 'cash') { ?>
                              COD
                            <?php } elseif($orderData[0]['pay_method'] == 'online_payment'){ ?>
                              Online Payment
                            <?php } else { ?>
                              On a account
                            <?php } ?>
                          </th>
                          <!-- <th colspan="1"></th> -->
                          <th colspan="4" style="text-align: end;">Cancel Order: <a href="#" class="btn btn-sm btn-danger OrderStatus" data-id="<?php echo $orderId; ?>"><i class="fa fa-close" aria-hidden="true"></i></a></th>
                      </tr>
                      <tr>
                          <th>Part Number</th>
                          <th colspan="5">Description (Variant)</th>
                          <th>List Price p/unit</th>
                          <th>Discount</th>
                          <th>Net Price P/Unit</th>
                          <th>GST</th>
                          <th>Total</th>
                          <th colspan="3">Status</th>
                      </tr>
                      <?php foreach ($orderData as $order) { 
                        // echo '<pre>';print_r($order);echo '</pre>';
                        ?>
                          <tr>
                              <td><?php echo $order['variant_sku']; ?></td>
                              <!-- <td colspan="5"><?php //echo $order['product_short_description']; ?></td> -->
                              <td colspan="5"><?php echo $order['variant_name']; ?></td>
                              <td colspan =""><?php echo number_format($order['product_amount'], 2, '.', ','); ?></td>
                              <?php
                              $couponModel = model('App\Models\CouponModel');
                              $getCoupon = $couponModel->where('coupon_code', $order['group_name'])->first();
                              $order_created_at = $order['created_at'];
                              $datetime = new DateTime($order_created_at);
                              $order_date = $datetime->format('Y-m-d');
                              ?>
                              <td><?php 
                              if($getCoupon){
                                if ($order_date >= $getCoupon['from_date'] && $order_date <= $getCoupon['to_date']) {
                                  if($getCoupon['coupon_price_type'] == 'Flat'){
                                    echo $getCoupon['coupon_price_type'] .'-'. $getCoupon['coupon_price'] ; 
                                  }elseif($getCoupon['coupon_price_type'] == 'Percentage'){
                                    echo $getCoupon['coupon_price'] .'%'; 
                                  }else{
                                    echo '-'; 
                                  }
                                }else{
                                  echo '-'; 
                                }
                              }
                              ?></td>
                              <?php 
                                $discount = 0;
                                $order_created_at = $order['created_at'];
                                $datetime = new DateTime($order_created_at);
                                $order_date = $datetime->format('Y-m-d');
                                if($getCoupon){
                                    if ($order_date >= $getCoupon['from_date'] && $order_date <= $getCoupon['to_date']) {
                                      if($getCoupon['coupon_price_type'] == 'Flat'){
                                        $discount = $getCoupon['coupon_price']; 
                                      }elseif($getCoupon['coupon_price_type'] == 'Percentage'){
                                        $discount = $order['product_amount'] * $getCoupon['coupon_price'] / 100; 
                                      }else{
                                        $discount = 0;
                                      }
                                  }else{
                                    $discount = 0;
                                  }
                                }
                              if($discount){
                                $unit_price = $order['product_amount'] - $discount;
                              }else{
                                $unit_price = $order['product_amount'];
                              }
                              $grandTotal = 0;
                              $grandTotal += $order['total_amount'];
                              // $formatted_gst_Amount =  number_format(($grandTotal*10/100), 2, '.', ','); 
                              $formatted_gst_Amount =  number_format(($grandTotal*10/100), 2);
                              $final_total = $grandTotal + $formatted_gst_Amount;
                              ?>
                              <td colspan =""><?php echo number_format($unit_price, 2); ?></td>
                              <td ><?php echo $formatted_gst_Amount; ?></td>
                              <!-- <td><?php // echo number_format($grandTotal, 2, '.', ',') + $formatted_gst_Amount; ?></td> -->
                              <td><?php echo number_format($final_total, 2); ?></td>
                              <td ><?php echo $order['order_status']; ?></td>
                          </tr>
                      <?php } ?>
                      <!--  -->
                      <!-- <tr>
                        <td colspan ="7" style="text-align: right;">GST</td>
                        <td colspan ="4">
                        <?php /*
                              $grandTotal = 0;
                              foreach ($orderData as $order) {
                                  $grandTotal += $order['total_amount'];
                              }
                              echo number_format(($grandTotal*10/100), 2, '.', ',');
                          */?>
                        </td>
                      </tr> -->
                      <!--  -->
                      <tr>
                        <td>
                          <div>
                              <?php if(isset($orderData[0]['shipping']) && $orderData[0]['shipping'] == 'Client Courier') { ?>
                                  <div><b style="white-space: nowrap">Account Number: </b><br><?php echo $orderData[0]['account_number']; ?></div>
                              <?php } ?>
                          </div>
                        </td>
                        <td>
                          <div>
                              <?php if(isset($orderData[0]['shipping']) && $orderData[0]['shipping'] == 'Client Courier') { ?>
                                  <div><b>Courier: </b><br><?php echo $orderData[0]['courier']; ?></div>
                              <?php } ?>
                          </div>
                        </td>
                        <td colspan="3" style="text-align: right;">
                            Discount:
                        </td>
                        <td><?php
                                  $couponModel = model('App\Models\CouponModel');
                                  $discount = 000.00;
                                  foreach ($orderData as $dis) {
                                    // $getCoupon = $couponModel->where('coupon_id', $dis['coupon_id'])->first();
                                    $getCoupon = $couponModel->where('coupon_code', $dis['group_name'])->first();
                                    if(!empty($getCoupon))
                                    {
                                      if ($getCoupon['coupon_price_type'] == 'Percentage')
                                      {
                                          $discount += ($dis['product_amount'] * $dis['product_quantity'] * $getCoupon['coupon_price']) / 100;
                                      } else if ($getCoupon['coupon_price_type'] == 'Flat') {
                                          // $discount += $dis['product_amount'] * $dis['product_quantity'] - $getCoupon['coupon_price'];
                                          $discount += $getCoupon['coupon_price'];
                                      }
                                    }
                                  }
                                  echo number_format($discount, 2, '.', ',');
                              ?>
                          </td>
                        <td colspan="4" style="text-align: right;">Grand Total</td>
                          <td>
                              <?php
                                  $grandTotal = 0;
                                  foreach ($orderData as $order) {
                                      $grandTotal = $order['final_total_ammount'];
                                  }
                                  echo $grandTotal;

                              ?>
                          </td>
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
        // text: 'Are you sure you want to cancel this order?',
        text: 'Your order is being processed, please call the office on (+61) 08 9451 2204',
        icon: 'warning',
        showCancelButton: true,
        showConfirmButton: false,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        // confirmButtonText: 'Yes, cancel it!'
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