<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .mainsetcolor {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="logo">
        <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/TruflowLogoDark.png" alt="Truflow Logo">
    </div>
    <?php if (isset($ordersByOrderId) && is_array($ordersByOrderId)) { ?>
        <?php foreach ($ordersByOrderId as $orderId => $orderData) { ?>
            <table class="table card">
                <tr class="mainsetcolor">
                    <th colspan="1">Order Id: #<?php echo $orderId; ?></th>
                    <th colspan="1">Order By: <?php echo $orderData[0]['full_name']; ?></th>
                    <th colspan="2">Order Date: <?php echo date('d-m-Y H:i:s', strtotime($orderData[0]['order_date'])); ?></th>
                    <th colspan="3">Payment Status: <?php echo $orderData[0]['order_status']; ?></th>
                    
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
                <?php foreach ($orderData as $order) { ?>
                    <tr>
                        <td><?php echo $order['product_name']; ?></td>
                        <td><?php echo $order['product_description']; ?></td>
                        <td><?php echo $order['variant_name']; ?></td>
                        <td><?php echo $order['variant_sku']; ?></td>
                        <td><?php echo $order['product_quantity']; ?></td>
                        <td><?php echo $order['product_amount']; ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5">Total</td>
                    <td>
                        <?php
                            $grandTotal = 0;
                            foreach ($orderData as $order) {
                                $grandTotal += $order['product_amount'];
                            }
                            echo $grandTotal;
                        ?>
                    </td>
                    <td></td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>
</body>
</html>
