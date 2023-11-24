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
                        <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/TruflowLogoDark.png" width="125" height="120" style="display: block; border: 0px;" /><br>
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
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">


                    <?php foreach ($orderData as $order) { ?>
                        <tr>
                            <td align="left">
                                <?php echo $order['product_name']; ?>&nbsp;<?php echo $order['parent']; ?><br>
                                <b>Variant :</b> <?php echo $order['variant_sku']; ?>
                            </td>

                            <td><?php echo $order['product_quantity']; ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo number_format($order['product_amount'], 2, '.', ','); ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo number_format($order['total_amount'], 2, '.', ','); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="left" style="border-top: 3px solid #eeeeee;">
                            Total
                        </td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;">
                            <?php
                            $grandTotal = 0;
                            foreach ($orderData as $order) {
                                $grandTotal += $order['total_amount'];
                            }
                            $formatted_Amount = number_format($grandTotal, 2, '.', ',');
                            echo $formatted_Amount;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="border-top: 3px solid #eeeeee;">
                            Discount
                        </td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;">
                            <?php
                            // $discount = 0;
                            // foreach ($orderData as $dis) {
                            //     $discount = $dis['product_discount'];
                            // }

                            // if ($dis['discount_type'] = 'Percentage') {

                            //     echo $discount . "%";
                            // } else {
                            //     echo $discount . "Rs";
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
                    </tr>
                    <tr>
                        <td align="left" style="border-top: 3px solid #eeeeee;">
                            Grand Total
                        </td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;"></td>
                        <td style="border-top: 3px solid #eeeeee;">
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
                    </tr>


                </table>
                </td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>
</div>