<?= $this->include('admin/layout/front') ?>


<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Order Details</h5>
                </div>
                <div class="card mb-4">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <div class="row">
                                    
                                    <div class="mb-3 col-md-6">
                                        <h5>Shipping Address</h5>
                                        <?php echo isset($shippingData) ? $shippingData['address_1'] : '' . "," ?><br>
                                        <?php echo isset($shippingData) ? $shippingData['address_2'] : '' . "," ?><br>
                                        <?php echo isset($shippingData) ? $shippingData['city'] : '' ?>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h5>Billing Address</h5>
                                        <?php echo isset($shippingData) ? $shippingData['address_1'] : '' . "," ?><br>
                                        <?php echo isset($shippingData) ? $shippingData['address_2'] : '' . "," ?><br>
                                        <?php echo isset($shippingData) ? $shippingData['city'] : '' ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <h5>Payment method</h5>
                                        <?php echo $newCartData1[0]['pay_method'] == 'cash' ? 'COD' : 'On a account'; ?><br>
                                    </div>
                                    <?php if($newCartData1[0]['shipping'] == 'Client Courier') { ?>
                                        <div class="mb-3 col-md-6">
                                            <div><?php echo $newCartData1[0]['shipping']; ?></div>
                                            <div><b>Account Number: </b><?php echo $newCartData1[0]['account_number']; ?></div>
                                            <div><b>Courier: </b><?php echo $newCartData1[0]['courier']; ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if (isset($newCartData1) && !empty($newCartData1)) { ?>
                                    <div class="row">

                                        <table class="table table-bordered" style="width: 100%;">
                                            <thead>


                                                <th>Product name</th>
                                                <th>Product details</th>
                                                <th>Variant</th>
                                                <th>Part Number</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Order Status</th>
                                                <th>Shipping</th>

                                            </thead>
                                            <tbody>
                                                <?php foreach ($newCartData1 as $order) { ?>
                                                    <tr>
                                                        <td><?php echo $order['product_name']; ?></td>
                                                        <td><?php echo $order['product_description']; ?></td>
                                                        <td><?php echo $order['variant_name']; ?></td>
                                                        <td><?php echo $order['variant_sku']; ?></td>
                                                        <td><?php echo $order['product_quantity']; ?></td>
                                                        <td><?php echo $order['product_amount']; ?></td>
                                                        <td><?php echo $order['order_status']; ?></td>
                                                        <td>
                                                            <div><?php echo $order['shipping']; ?></div>
                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td>Total</td>
                                                    <td>
                                                        <?php
                                                        $totalAmount = 0;
                                                        foreach ($newCartData1 as $order_c) {

                                                            $totalAmount += $order_c['total_amount'];
                                                        }
                                                        echo $totalAmount;
                                                        ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Discount</td>
                                                    <td>
                                                        <!-- <?php foreach ($newCartData1 as $order) {
                                                            $discount = 0; ?>
                                                            <?php if ($order['discount_type'] == "Flat") { ?>
                                                                <?php $discount = $order['product_discount'] . " Rs"; ?>
                                                            <?php } else { ?>
                                                                <?php $discount = $order['product_discount'] . " %"; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php echo $discount; ?> -->
                                                        <?php 
                                                            $couponModel = model('App\Models\CouponModel');
                                                            $discount = 0.00;
                                                            foreach ($newCartData1 as $dis) {
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
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Grand Total</td>
                                                    <td>
                                                        <!-- <?php foreach ($newCartData1 as $order) {
                                                            $grandTotal = 0; ?>
                                                            <?php $grandTotal = $order['final_total_ammount']; ?>
                                                        <?php } ?>
                                                        <?php echo $grandTotal; ?> -->
                                                        <?php 
                                                            $grandTotal = 0;
                                                            foreach ($newCartData1 as $order) {
                                                                $grandTotal += $order['total_amount'];
                                                            }
                                                            echo number_format($grandTotal, 2, '.', ',');
                                                        ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <input type="submit" class="btn btn-primary d-grid"> -->
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>