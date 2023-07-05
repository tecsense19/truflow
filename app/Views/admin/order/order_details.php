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

                                <?php if (isset($newCartData1) && !empty($newCartData1)) { ?>
                                    <div class="row">

                                        <table class="table table-bordered" style="width: 100%;">
                                            <thead>


                                                <th style="width: 10%;">Product name</th>
                                                <th style="width: 30%;">Product details</th>
                                                <th style="width: 20%;">Variant</th>
                                                <th style="width: 10%;">Part Number</th>
                                                <th style="width: 10%;">Qty</th>
                                                <th style="width: 10%;">Price</th>
                                                <th style="width: 10%;">Order Status</th>

                                            </thead>
                                            <tbody>
                                                <?php foreach ($newCartData1 as $order) { ?>
                                                    <tr>
                                                        <td style="width: 10%;"><?php echo $order['product_name']; ?></td>
                                                        <td style="width: 30%;"><?php echo $order['product_description']; ?></td>
                                                        <td style="width: 20%;"><?php echo $order['variant_name']; ?></td>
                                                        <td style="width: 10%;"><?php echo $order['variant_sku']; ?></td>
                                                        <td style="width: 10%;"><?php echo $order['product_quantity']; ?></td>
                                                        <td style="width: 10%;"><?php echo $order['product_amount']; ?></td>
                                                        <td style="width: 10%;"><?php echo $order['order_status']; ?></td>
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
                                                    <td><?php foreach ($newCartData1 as $order) {
                                                            $discount = 0; ?>
                                                            <?php if ($order['discount_type'] == "Flat") { ?>
                                                                <?php $discount = $order['product_discount'] . " Rs"; ?>
                                                            <?php } else { ?>
                                                                <?php $discount = $order['product_discount'] . " %"; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php echo $discount; ?>
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Grand Total</td>
                                                    <td><?php foreach ($newCartData1 as $order) {
                                                            $grandTotal = 0; ?>
                                                            <?php $grandTotal = $order['final_total_ammount']; ?>
                                                        <?php } ?>
                                                        <?php echo $grandTotal; ?>
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