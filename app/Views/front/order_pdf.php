<style>
    #result_div {
        padding: 0px 0px 0px;
        min-height: 30vh;
    }

    .h2 {
        font-size: 30px;
        font-weight: 800;
        line-height: 36px;
        color: #333333;
        margin: 0;
        margin: 30px;
    }

    .billing_add {
        font-family: Open Sans, Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
    }

    .bill_font {
        font-weight: 800;
        padding-bottom: 1px;
    }

    td {
        font-family: Open Sans, Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        padding: 5px 10px;

    }

    .notes {
        margin-top: 22px;
    }
    .main_table{
        padding: 5px 5px;
        border: 3px solid #eeeeee;
    }
</style>

<div id="result_div">
    <?php if (isset($ordersByOrderId) && is_array($ordersByOrderId)) { ?>
        <?php foreach ($ordersByOrderId as $orderId => $orderData) { ?>

            <table cellpadding="0" cellspacing="0" width="100%" class="main_table">
               
                <tr>
                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 0px;">
                        <!-- <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.png" width="125" height="120" style="display: block; border: 0px;" /> -->
                        <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.webp" width="125" height="120" style="display: block; border: 0px;" />
                        <br>
                        <h2>
                            Thank You For Your Order!
                        </h2>
                    </td>
                </tr>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td class="billing_add" align="left" valign="top">
                                <p class="bill_font">Billing Address</p>
                                <p>
                                    <?php echo $orderData[0]['full_name']; ?>,<br>
                                    <?php echo $userData['address_1']; ?>,<br>
                                    <?php echo $userData['address_2']; ?>,<br>
                                    <?php echo $userData['city']; ?>.<br>
                                </p>
                        </td>
                        <td class="billing_add" align="right" valign="top">
                                <p class="bill_font">Shipping Address</p>
                                <p>
                                
                            <?php if($orderData[0]['ship_to_diff_address'] == "1"){ ?>
                                <?php echo $shipping['address_1']; ?>,<br>
                                    <?php echo $shipping['address_2']; ?>,<br>
                                    <?php echo $shipping['city']; ?>.<br>
                                <?php }else{?>
                                    <p>Same as Billing Address</p>
                                <?php }?>
                            
                                    
                                </p>
                        </td>
                    </tr>
                </table>
                <?php if($orderData[0]['shipping'] == 'Client Courier') { ?>
                <br>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="left" bgcolor="#eeeeee">
                            <?php echo $orderData[0]['shipping']; ?>
                        </td>

                        <td align="center" bgcolor="#eeeeee" style="display: flex;">
                            <b style="white-space: nowrap">Account Number: </b> <?php echo $orderData[0]['account_number']; ?>
                        </td>

                        <td align="right" bgcolor="#eeeeee" style="display: flex;">
                            <b>Courier: </b> <?php echo $orderData[0]['courier']; ?>
                        </td>

                    </tr>
                </table>
                <?php } ?>
                <br>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="left" bgcolor="#eeeeee">
                            Payment Method:
                            <?php if($orderData[0]['pay_method'] == 'cash') { ?>
                              COD
                            <?php } elseif($orderData[0]['pay_method'] == 'online_payment'){ ?>
                              Online Payment
                            <?php } else { ?>
                              On a account
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <br>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="left" bgcolor="#eeeeee">
                            OrderID #<?php echo $orderId; ?>
                        </td>

                        <td align="right" bgcolor="#eeeeee">
                            Date : <?php echo date('d-m-Y', strtotime($orderData[0]['order_date'])); ?>
                        </td>

                    </tr>
                </table>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-top:10px">


                        <tr>
                          <th align="left">Product</th>
                          <th>Qty</th>
                          <th></th>
                          <th>list price</th>
                          <th></th>
                          <th>Discount</th>
                          <th></th>
                          <th>Net Price Per Unit</th> 
                          <th></th>
                          <!-- <th>Total</th>
                          <th></th>
                          <th>GST</th>
                          <th></th> -->
                          <th>Total ex GST</th>
                        </tr>
                    <?php foreach ($orderData as $order) { 
                        ?>
                        <tr>
                            <td align="left">
                                <!-- <?php //echo $order['product_name']; ?>&nbsp;<?php // echo $order['parent']; ?><br> -->
                                <?php echo $order['variant_sku']; ?>
                            </td>

                            <td><?php echo $order['product_quantity']; ?></td>
                            <td></td>
                            <?php $undiscount = $order['product_amount']; ?>
                            <td><?php echo $undiscount; ?></td>
                            <td></td>
                            <td>
                                <?php
                                $couponModel = model('App\Models\CouponModel');
                                $discount = 000.00;
                                    // $getCoupon = $couponModel->where('coupon_id', $order['coupon_id'])->first();
                                    $getCoupon = $couponModel->where('coupon_code', $order['group_name'])->first();
                                    if(!empty($getCoupon))
                                    {
                                        if ($getCoupon['coupon_price_type'] == 'Percentage') 
                                        {
                                            // $discount += ($order['product_amount'] * $order['product_quantity'] * $getCoupon['coupon_price']) / 100;
                                            $discount = $getCoupon['coupon_price'] .'%';
                                        } else if ($getCoupon['coupon_price_type'] == 'Flat') {
                                            // $discount += $order['product_amount'] * $order['product_quantity'] - $getCoupon['coupon_price'];
                                            $discount = $getCoupon['coupon_price_type'] .'-'. $getCoupon['coupon_price'] ;
                                        }
                                    }
    
                                // echo number_format($discount, 2, '.', ',');
                                echo $discount;
                                ?>
                            </td>
                            <td></td>
                            <?php 
                            $couponModel = model('App\Models\CouponModel');
                            $getCoupon = $couponModel->where('coupon_code', $order['group_name'])->first();
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
                            ?>
                            <td><?php echo number_format($unit_price, 2); ?></td>

                            <?php
                            $grandTotal = 0;
                            $grandTotal += $order['total_amount'];
                            $formatted_gst_Amount =  number_format(($grandTotal*10/100), 2); 
                            $final_total = $grandTotal + $formatted_gst_Amount;
                            ?>
                            <!-- <td>
                                <?php echo $formatted_gst_Amount; ?>
                            </td> -->
                            <td></td>
                            <td><?php echo number_format($grandTotal, 2); ?></td>
                        </tr>
                    <?php } ?>

                </table>
                </td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>
</div>