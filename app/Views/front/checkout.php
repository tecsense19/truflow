<?= $this->include('front/layout/front'); ?>
<?php
$session = session();

$user_id = $session->get('user_id');
$sub_category_id = '';
$commonValues = '';
// $new_coupon_code = $session->get('couponCode_new');
// if (isset($_GET['coupon_code'])) {
//   $_SESSION['coupon_code'] = $_GET['coupon_code'];
// }
if (isset($_GET['discount_type'])) {
  $_SESSION['discount_type'] = $_GET['discount_type'];
}
if (isset($_GET['product_discount'])) {
  $_SESSION['product_discount'] = $_GET['product_discount'];
}
if (isset($_GET['final_total_ammount'])) {
  $_SESSION['final_total_ammount'] = $_GET['final_total_ammount'];
}
if (isset($_GET['discount_d'])) {
  $_SESSION['discount_d'] = $_GET['discount_d'];
}
if (isset($_GET['free_shipping'])) {
  $_SESSION['shipping'] = $_GET['free_shipping'];
}
$company_id = isset($cartData) ? $cartData[0]['company_id'] : '';

//$coupon_code = isset($_SESSION['couponCode_new']) ? $_SESSION['couponCode_new'] : $_GET['coupon_code'];
$discount_type = isset($_SESSION['discount_type']) ? $_SESSION['discount_type'] : '';
$product_discount = isset($_SESSION['product_discount']) ? $_SESSION['product_discount'] : '';
$final_total_ammount = isset($_SESSION['final_total_ammount']) ? $_SESSION['final_total_ammount'] : '';
$shipping = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : '';
$discount = isset($_SESSION['discount_d']) ? $_SESSION['discount_d'] : '';

// You can then use these variables in your HTML or PHP code as needed

?>
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
<section class="checkout_details mt-5">
    <form class="mb-0 mt-4" method="post" id="product_form" action="<?php echo base_url() ?>place_order"
        enctype='multipart/form-data'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                </div>
                <?php if (isset($userData)) { ?>
                <?php foreach ($userData as $user) { ?>
                <div class="col-lg-7">
                    <div class="billing_detail">
                        <h3>Billing Details</h3>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="checkout-input">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="<?php echo $user['first_name']; ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-input">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" id="form9Example2" name="last_name"
                                        value="<?php echo $user['last_name']; ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Company name (optional)</label>
                                    <input type="text" id="company_name" name="company_name"
                                        value="<?php echo $user['company_name']; ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Country / Region </label>
                                    <input type="text" id="country" name="country"
                                        value="<?php echo $user['country']; ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Street address</label>
                                    <input type="text" id="address_1" name="address_1"
                                        value="<?php echo $user['address_1']; ?>" class="form-control input-custom" />
                                </div>

                                <div class="checkout-input">
                                    <input type="text" id="address_2" name="address_2"
                                        value="<?php echo $user['address_2']; ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Town / City</label>
                                    <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Email address <span>*</span></label>
                                    <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-option-wrapper">
                                    <div class="checkout-option">
                                        <input id="ship_to_diff_address" type="checkbox" name="ship_to_diff_address"
                                            value="1">
                                        <label for="ship_to_diff_address">Ship to a different address?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 diff_address">
                                <div class="checkout-input">
                                    <label>Town / City</label>
                                    <input type="text" id="city" name="city" value=""
                                        class="form-control input-custom" />
                                </div>
                                <div class="checkout-input">
                                    <label>Street address</label>
                                    <input type="text" id="address_1" name="address_1" value=""
                                        class="form-control input-custom" />
                                </div>
                                <div class="checkout-input">
                                    <input type="text" id="address_2" name="address_2" value=""
                                        class="form-control input-custom" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Order notes (optional)</label>
                                    <textarea id="notes" name="notes"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <?php } ?>
                <?php } ?>

                <div class="col-lg-5">
                    <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('error')) { ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php } ?>
                    <?php if (isset($cartData)) { ?>
                    <div class="your_order">
                        <h3>Your Order</h3>

                        <ul class="p-0">
                            <li class="order_list d-flex justify-content-between align-items-center">
                                <h5>Product</h5>
                                <h5>Total</h5>

                            </li>

                            <?php foreach ($cartData as $key => $cart) {  ?>

                            <?php $sub_category_id = $sub_category_id ? $sub_category_id . ',' . $cart['sub_category_id'] : $cart['sub_category_id'];
                  ?>
                            <li class="order_list d-flex justify-content-between align-items-center">
                                <p><?php echo $cart['product_name']; ?>&nbsp;<?php // echo $cart['parent']; ?>&nbsp; x
                                    &nbsp;<?php echo $cart['product_quantity']; ?></p>
                                <div class="data">
                                    <span class="sub_category_id_match_<?php echo $cart['sub_category_id'] ?>">
                                        <?php

                          $total_Amount = $cart['product_amount'] * $cart['product_quantity'];
                          $formatted_Amount = number_format($total_Amount, 2, '.', ',');

                          echo "$" . $formatted_Amount;
                          ?>
                                    </span>
                                    <span class="ml-2">
                                        <a href="#"
                                            onclick="confirmDelete('<?php echo base_url('') . 'delete_check/' . $cart['cart_id']; ?>')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </span>
                                </div>

                            </li>
                            <?php } ?>


                            <li class="order_list d-flex justify-content-between align-items-center">
                                <p>Subtotal</p>
                                <?php
                  $grandTotal = 0;
                  foreach ($cartData as $cart) {
                    $grandTotal += $cart['total_amount'];
                  }
                  $formattedTotal = "$" . number_format($grandTotal, 2, '.', ',');
                  ?>
                                <span id="subtotal"><?php echo $formattedTotal; ?></span>
                            </li>

                            <li class="order_list d-flex justify-content-between align-items-center">
                                <p>Discount</p>

                                <span id="discount">$<?php echo $total_auto_discount; ?></span>
                            </li>

                            <li class="order_list d-flex justify-content-between align-items-center">
                                <p>Total Amount</p>
                                <span id="totalAmount">$000.00</span>
                            </li>

                            <!-- <li class="order_list d-flex justify-content-between align-items-center">
                              <p>Shipping</p>
                              <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                                <span>
                                  <input type="radio" id="order_status" name="shipping" value="Free shipping" <?php echo ($shipping == 'true') ? 'checked' : ''; ?> />
                                  <label for="free_shipping">Free shipping</label>
                                </span>
                              </div>
                            </li> -->

                            <li class="order_total d-flex justify-content-between align-items-center">
                                <h5>Total</h5>

                                <h5 id="total">$000.00</h5>

                            </li>
                        </ul>

                        <div class="order_list d-flex justify-content-between align-items-center">
                            <p>Shipping</p>
                            <div class="tp-order-info-list-shipping-item d-flex align-items-end">
                                <span class="mr-2">
                                    <input type="radio" id="pickup" name="shipping_value" value="Pickup" <?php echo ($shipping == 'true') ? 'checked' : ''; ?> required />
                                    <label for="pickup" style="margin-bottom: 0px;">Pickup</label>
                                </span>
                                <span>
                                    <input type="radio" id="client_courier" name="shipping_value" value="Client Courier" <?php echo ($shipping == 'true') ? 'checked' : ''; ?> required />
                                    <label for="client_courier" style="margin-bottom: 0px;">Client Courier</label>
                                </span>
                            </div>
                        </div>

                        <div class="order_list" id="additionalFields" style="display: none;">
                            <div>
                                <label for="accountNumber">Account Number:</label>
                                <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Enter Account Number" >
                            </div>
                            <div class="mt-2">
                                <label for="courier">Courier:</label>
                                <input type="text" class="form-control" id="courier" name="courier" placeholder="Enter Courier" >
                            </div>
                        </div>

                        <!-- <div class="payment_item order_list">
                            <span>
                                <input type="radio" id="cash_ond_delivery" name="pay_method" value="cash" required>
                                <label for="cash_ond_delivery">Cash on Delivery</label>
                            </span>
                        </div> -->

                        <div class="checkout-agree order_list">
                            <div class="checkout-option">
                                <div class="db_data">
                                    <input id="read_all" type="checkbox" required>
                                    <label for="read_all">I have read and agreed to the 
                                        <a href="<?php echo base_url('terms/condition'); ?>"> Terms&Condition </a> of the website.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="checkout_btn">

                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>" />

                            <input type="hidden" id="order_status" name="order_status" value="Pending" />

                            <?php if (isset($discount_type) && $discount_type != '') { ?>
                            <input type="hidden" id="discount_type" name="discount_type"
                                value="<?php echo $discount_type ?>" />
                            <?php } else { ?>
                            <input type="hidden" id="discount_type" name="discount_type" value="" />
                            <?php } ?>

                            <?php if (isset($product_discount) && $product_discount != '') { ?>
                            <input type="hidden" id="product_discount" name="product_discount"
                                value="<?php echo $product_discount ?>" />
                            <?php } else { ?>
                            <input type="hidden" id="product_discount" name="product_discount" value="" />
                            <?php } ?>

                            <?php if (isset($final_total_ammount) && $final_total_ammount != '') { ?>
                            <input type="hidden" id="final_total_ammount" name="final_total_ammount"
                                value="<?php echo $final_total_ammount ?>" />
                            <?php } else { ?>
                            <input type="hidden" id="total_db_save" name="final_total_ammount" value="" />
                            <?php } ?>

                            <button type="submit" class="btn btn-primary btn-rounded proceed_btn" id="destroyButton" style="background-color: #0062CC ;">Place order</button>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </form>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>
<script>
$(document).ready(function() {
    // Initially hide the additional address fields
    $('.diff_address').hide();

    // Handle the checkbox click event
    $('#ship_to_diff_address').on('click', function() {
        if ($(this).is(':checked')) {
            // Show the additional address fields
            $('.diff_address').show();
        } else {
            // Hide the additional address fields
            $('.diff_address').hide();
        }
    });

    $('input[name="shipping_value"]').on('change', function() {
        // Check the selected shipping option
        var selectedShippingOption = $('input[name="shipping_value"]:checked').val();

        // Show or hide additional fields based on the selected shipping option
        if (selectedShippingOption === 'Client Courier') {
            $('#additionalFields').show();
            $('#accountNumber').attr('required', true);
            $('#courier').attr('required', true);
        } else {
            $('#accountNumber').val('');
            $('#courier').val('');
            $('#accountNumber').attr('required', false);
            $('#courier').attr('required', false);
            $('#additionalFields').hide();
        }
    });
});
</script>


<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to remove this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#applyCouponButton').trigger('click');
            window.location.href = url;
        }
    });

}
</script>

<script>
var new_amount = '';
$(document).ready(function() {
    var subtotal = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));

    var auto_discount = '<?php echo $total_auto_discount; ?>';
    subtotal = subtotal - auto_discount;

    var formattedSubtotal = "$" + subtotal.toLocaleString(undefined, {
        minimumFractionDigits: 2
    });


    $('#totalAmount').text(formattedSubtotal);
    $('#total').text(formattedSubtotal);

    function applyCoupon(response) {
        if (response.status === 'success') {
            var couponData = response.couponData;
            if (couponData.length > 0) {
                var couponType = couponData[0].coupon_price_type;
                var couponAmount = parseFloat(couponData[0].coupon_price);
                var coupon_type = couponData[0].coupon_type;
                var totalAmount = subtotal;
                var total = subtotal;
                var catId = "<?php echo $sub_category_id; ?>";
                var company_id = '<?php echo $company_id; ?>';
                var company_id_response = couponData[0].company_id;

                //alert(couponAmount);

                $('#discount_type').val(couponType);
                $('#product_discount').val(couponAmount);

                if (!isNaN(couponAmount)) {
                    var discount = 0;

                    if (couponType === 'Percentage') {
                        discount = (subtotal * couponAmount) / 100;
                    } else if (couponType === 'Flat') {
                        discount = couponAmount;
                    }

                    if (discount > subtotal) {
                        return;
                    }

                    if (company_id_response === company_id) {
                        if (coupon_type == 'Global') {
                            totalAmount = subtotal - discount;
                            if (totalAmount < 0) {
                                totalAmount = 0;
                            }
                            total = subtotal - discount;
                            if (total < 0) {
                                total = 0;
                            }
                            //alert(totalAmount);
                            var formattedDiscount = "$" + discount.toLocaleString(undefined, {
                                minimumFractionDigits: 2
                            });
                            var formattedTotalAmount = "$" + totalAmount.toLocaleString(undefined, {
                                minimumFractionDigits: 2
                            });
                            //alert(formattedTotalAmount);
                            $('#discount').text(formattedDiscount);
                            $('#totalAmount').text(formattedTotalAmount);
                            $('#total').text(formattedTotalAmount);

                            var formatedAmmount = formattedTotalAmount.replace('$', '');
                            $('#final_total_ammount').val(formatedAmmount);

                            var forDiscount = formattedDiscount.replace('$', '');
                            $('#discount_d').val(forDiscount);
                        } else if (coupon_type === 'Sub Category') {

                            var array1 = couponData[0].sub_category_id ? couponData[0].sub_category_id.split(
                                ',') : [];
                            var array2 = catId ? catId.split(',') : [];
                            // console.log(array1);
                            var commonValues = array1.filter(function(value) {
                                return array2.indexOf(value) !== -1;
                            });

                            if (commonValues.length === 0) {
                                //$('#couponMessage').text('Coupon is not valid for your account.');
                                return;
                            }

                            // Apply coupon for matching category IDs
                            $('.sub_category_id_match_' + commonValues[0]).each(function(index, element) {
                                var elementText = $(element).text();
                                var new_sub_category_id = elementText.replace('$', '');
                                new_sub_category_id = new_sub_category_id.replace(/[^0-9.-]+/g, '');
                                var totalAmount = parseFloat(new_sub_category_id) - discount;
                                var formattedAmount = totalAmount.toLocaleString('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                                $(element).text('$' + formattedAmount);
                                var subtotal1 = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g,
                                    ''));
                                $('#subtotal').text(formatAmount(subtotal1 - discount));
                                var new_subtotal = parseFloat($('#subtotal').text().replace(
                                    /[^0-9.-]+/g, ''));
                                var new_discount = parseFloat($('#discount').text().replace(
                                    /[^0-9.-]+/g, ''));
                                var formattedAmount1 = formatAmount(new_subtotal);
                                var formattedDiscount1 = formatAmount(new_discount);
                                new_amount = new_amount ? new_amount + '&sub_category_id_match_' +
                                    index + '_' + commonValues[0] + '=' + formattedAmount :
                                    '&sub_category_id_match_' + index + '_' + commonValues[0] + '=' +
                                    formattedAmount;
                                $('#discount').text(formattedDiscount1);
                                $('#subtotal').text(formattedAmount1);
                                $('#totalAmount').text(formattedAmount1);
                                $('#total').text(formattedAmount1);
                                var formatedAmmount = formattedAmount1.replace('$', '');
                                $('#final_total_ammount').val(formatedAmmount);
                                var forDiscount1 = formattedDiscount1.replace('$', '');
                                $('#discount_d').val(forDiscount1);
                            });

                            $('#discount').text(formatAmount(discount * $('.sub_category_id_match_' +
                                commonValues[0]).length));
                            $('#couponMessage').text('Coupon is valid.');

                        }

                        function formatAmount(amount) {
                            return "$" + amount.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }




                    }
                }
            }
        }
    }
    $.ajax({
        url: '<?php echo base_url(); ?>check_coupon',
        method: 'POST',
        data: {
            coupon: ''
        },
        success: function(response) {
            console.log(response);
            applyCoupon(response);


            $('#subtotal').text(formattedTotalAmount);
            $('#totalAmount').text(formattedTotalAmount);
            $('#total').text(formattedTotalAmount);
        },
        error: function(xhr, status, error) {
            alert("An error occurred while checking the coupon code");
        }
    });


});
</script>
<script>
$(document).ready(function() {
    var discount_d = "<?php echo isset($discount) ? '' . $discount : ''; ?>";
    if (discount_d !== '') {
        $('#discount').text(discount_d);
    }
});
</script>
<script>
$(document).ready(function() {
    var finalTotalAmount =
        "<?php echo isset($final_total_ammount) ? $final_total_ammount ? '$' . $final_total_ammount : '' : ''; ?>";
    if (finalTotalAmount != '') {
        $('#total').text(finalTotalAmount);
    }
});
</script>

<script>
$(document).ready(function() {
    var storedCouponCode = sessionStorage.getItem('couponCode_new');

    if (storedCouponCode != null && storedCouponCode != '') {
        $('#couponCode').val(storedCouponCode);
        $('#applyCouponButton').trigger('click');
    }

});
</script>

<script>
$("#destroyButton").click(function() {

    sessionStorage.setItem('couponCode_new', '');

    storedCouponCode = '';
});
</script>