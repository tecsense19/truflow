<?= $this->include('front/layout/front'); ?>
<?php
$session = session();

$user_id = $session->get('user_id');
$sub_category_id = '';
$commonValues = '';
// echo '<pre>';print_r($_SESSION);echo '</pre>';die;
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
if (isset($_GET['error'])) {
  $_SESSION['error'] = $_GET['error'];
}
use App\Models\CompanyModel;
$usermodel = new CompanyModel();
if($user_id){
    $company_name = isset($cartData) ? $cartData[0]['company_name'] : '';
    $getCompany = $usermodel->where('company_name',$company_name)->first();
    // echo '<pre>';print_r($getCompany['on_a_account']);echo '</pre>';

    $company_id = $getCompany ? $getCompany['company_id'] : '';
    
    // echo '<pre>';print_r($company_id);echo '</pre>';die;
}else{
    $company_id = isset($cartData);
}



//$coupon_code = isset($_SESSION['couponCode_new']) ? $_SESSION['couponCode_new'] : $_GET['coupon_code'];
$discount_type = isset($_SESSION['discount_type']) ? $_SESSION['discount_type'] : '';
$product_discount = isset($_SESSION['product_discount']) ? $_SESSION['product_discount'] : '';

// $key = random_bytes(16);
$key = pack("H*", '2b7e151628aed2a6abf7158809cf4f3c');
$final_total_ammountt = isset($_SESSION['final_total_ammount']) ? $_SESSION['final_total_ammount'] : '';
$amount = urlencode($final_total_ammountt);
// echo '<pre>';print_r($amount);echo '</pre>';die;
$final_total_ammount = openssl_decrypt(base64_decode(urldecode($amount)), 'aes-128-ecb', $key, OPENSSL_RAW_DATA,'');


$shipping = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : '';
$discount = isset($_SESSION['discount_d']) ? $_SESSION['discount_d'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';


// You can then use these variables in your HTML or PHP code as needed
    if (isset($userData)){
         $user_id =  $userData[0]['user_id'];
         $first_name =  $userData[0]['first_name'];
         $last_name =  $userData[0]['last_name'];
         $company_name =  $userData[0]['company_name'];
         $country =  $userData[0]['country'];
         $address_1 =  $userData[0]['address_1'];
         $address_2 =  $userData[0]['address_2'];
         $city =  $userData[0]['city'];
         $mobile =  $userData[0]['mobile'];
         $email =  $userData[0]['email'];
         $mobile =  $userData[0]['mobile'];
    }
?>
<style>
  sub {
    color: #005dab;
    font-weight: 700;
    bottom: 0px;
    padding-left: 5px;
}
</style>
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
                <?php //if (isset($userData)) { ?>
                <?php //foreach ($userData as $user) { ?>
                <div class="col-lg-7">
                    <div class="billing_detail">
                        <h3>Billing Details</h3>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="checkout-input">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="<?php if (isset($userData)){ echo $first_name; } ?>" class="form-control input-custom" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-input">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" id="form9Example2" name="last_name"
                                        value="<?php if (isset($userData)){ echo $last_name; } ?>" class="form-control input-custom" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Company name (optional)</label>
                                    <input type="text" id="company_name" name="company_name"
                                        value="<?php if (isset($userData)){ echo $company_name; } ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Country / Region </label>
                                    <input type="text" id="country" name="country"
                                        value="<?php if (isset($userData)){ echo $country; } ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Street address</label>
                                    <input type="text" id="address_1" name="address_1"
                                        value="<?php if (isset($userData)){ echo $address_1; } ?>" class="form-control input-custom" />
                                </div>

                                <div class="checkout-input">
                                    <input type="text" id="address_2" name="address_2"
                                        value="<?php if (isset($userData)){ echo $address_2; } ?>" class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Town / City</label>
                                    <input type="text" id="city" name="city" value="<?php if (isset($userData)){ echo $city; } ?>"
                                        class="form-control input-custom" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" id="mobile" name="mobile" value="<?php if (isset($userData)){ echo $mobile; } ?>"
                                        class="form-control input-custom" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-input">
                                    <label>Email address <span>*</span></label>
                                    <input type="text" id="email" name="email" value="<?php if (isset($userData)){ echo $email; } ?>"
                                        class="form-control input-custom" required/>
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
                                    <input type="text" id="city" name="city_1" value=""
                                        class="form-control input-custom" />
                                </div>
                                <div class="checkout-input">
                                    <label>Street address</label>
                                    <input type="text" id="address_1" name="address" value=""
                                        class="form-control input-custom" />
                                </div>
                                <div class="checkout-input">
                                    <input type="text" id="address_2" name="address" value=""
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

                <?php //} ?>
                <?php //} ?>

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
                                   <sub> Ex-Gst</sub> </span>
                                    <span class="ml-2">
                                        <a href="#"
                                            onclick="confirmDelete('<?php echo base_url('') . 'delete_check/' . $cart['cart_id']; ?>')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </span>
                                </div>

                            </li>
                            <?php } ?>
                            <li class="order_list order_total_gst d-flex justify-content-between align-items-center">
                                <p>GST</p>
                                <span id="total_gst">$000.00</span>
                            </li>

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

                            <li class="order_list d-none justify-content-between align-items-center d-none">
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
                                <h5>Final Total</h5>

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
                        <?php if(isset($getCompany) && $getCompany['on_a_account'] == 1) { ?>
                        <div class="order_list">
                            <span>
                                <input type="radio" id="on_a_account" name="pay_method" value="onaaccount" required checked>
                                <label for="on_a_account">Account</label>
                            </span>
                        </div>
                        <?php } ?>

                        <?php if(isset($getCompany) && $getCompany['on_a_account'] == 1) { ?>
                        <div class="payment_item order_list">
                            <span>
                                <input type="radio" id="cash_ond_delivery" name="pay_method" value="cash" checked>
                                <label for="cash_ond_delivery">Cash on Delivery</label>
                            </span>
                        </div>
                        <?php }else{
                            ?>
                            <div class="payment_item order_list">
                                <span>
                                    <input type="radio" id="cash_ond_delivery" name="pay_method" value="cash">
                                    <label for="cash_ond_delivery">Cash on Delivery</label>
                                </span>
                            </div>
                            <?php
                        } ?>
                        <div class="payment_item order_list">
                            <span>
                                <input type="radio" id="online_payment_delivery" class="" name="pay_method" value="online_payment">
                                <label for="online_payment_delivery">Credit Card Payment</label>
                            </span>
                        </div>
                        <div class="stripebutton" style="display:none;">
                        </div>

                        <div class="purchase_order_number" style="display:none;">
                            <div>
                                <input type="text" class="form-control" id="purchase_order_number" name="purchase_order_number" placeholder="Purchase Order number" >
                            </div>
                        </div>
                        
                        <?php if(!$user_id){ ?>
                            <input id="guest_account_create" name="guest_account_create" value="guest_account_create" type="hidden" >

                            <div class="order_list">
                            <span>
                            <input id="guest_account" type="checkbox" required>
                                    <label for="guest_account">Continue with guest account
                                    </label>
                            </span>
                        </div>
                        <?php }?>

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

                            <input type="hidden" id="user_id" name="user_id" value="<?php if (isset($userData)){ echo $user_id; } ?>" />

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

<!-- stripe -->
<!-- <script src="https://js.stripe.com/v3/"></script> -->
<script>
    $(document).ready(function() {
        $('input[name="pay_method"]').on('change', function() {
        // Check the selected shipping option
            var selectedShippingOption = $('input[name="pay_method"]:checked').val();
            if (selectedShippingOption === 'online_payment') {
    
                    var logourl = '<?php echo base_url(); ?>public/uploads/Truflow_Logo_Dark.svg'; // Replace with your actual logo URL
                    // var amount = '<?php //echo $final_total_ammount * 100; ?>'; // Replace with your actual amount
                    var subtotal = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));
                    var auto_discount = '<?php echo $total_auto_discount; ?>';
                    subtotal = subtotal - auto_discount;
                    var gstPercentage = 10;
                    var gstAmount = (subtotal * gstPercentage) / 100;
                    var totalAmount = subtotal + gstAmount;
                    totalAmount = totalAmount * 100;
                    totalAmount = Math.round(totalAmount);

                    
                    var addScript =
                    '<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" ' +
                    'data-key="pk_test_CTo5L7fe5ufOYkpIblHELzND00d0OKb0ua" ' +
                    'data-amount="' + totalAmount + '" ' +
                    'data-name="TRUFLOW" ' +
                    'data-description="Widget" ' +
                    'data-image="' + logourl + '" ' +
                    'data-locale="auto" ' +
                    'data-currency="aud"><' + '/script>'; // Corrected script closing tag

                    $('.stripebutton').html(addScript);
            }
            else
            {
                $('.stripebutton').html('');
            }
        });
    });

    /*document.getElementById('submitButton').addEventListener('click', function() {
      var selectedShippingOption = $('input[name="pay_method"]:checked').val();
      console.log(selectedShippingOption);
      if (selectedShippingOption === 'online_payment') {
        document.getElementById('destroyButton').trigger("click");
      }
    });*/
</script>
<script>
    $(document).ready(function() {
        $('input[name="pay_method"]').on('change', function() {
            // Find the iframe by its class
            var stripeCheckoutIframe = document.querySelector('.stripe_checkout_app');
            var selectedShippingOption = $('input[name="pay_method"]:checked').val();
            // Check if the iframe exists before trying to remove it
            if(selectedShippingOption == 'cash' ||selectedShippingOption == 'onaaccount' )
            if (stripeCheckoutIframe) {
                stripeCheckoutIframe.remove();
            } else {
                console.log("Stripe Checkout iframe not found");
            }
        });
        $('#destroyButton').on('click', function() {
            var selectedShippingOption = $('input[name="pay_method"]:checked').val();
            //     if(selectedShippingOption && $('#read_all').is(':checked')){
            if(selectedShippingOption == 'cash' || selectedShippingOption == 'onaaccount'){
                var selectedShippingvalue = $('input[name="shipping_value"]:checked').val();
                var purchaseOrderNumber = $('#purchase_order_number').val().trim();
                if(selectedShippingvalue && $('#read_all').is(':checked') && (selectedShippingOption != 'onaaccount' || purchaseOrderNumber)){
                    $('#product_form').submit();
                }
            }
        });
    });
</script>

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

    var selectedShippingOption = $('input[name="pay_method"]:checked').val();

    // Show or hide additional fields based on the selected shipping option
    if (selectedShippingOption === 'onaaccount') {
        $('.purchase_order_number').show();
        $('#purchase_order_number').attr('required', true);
    } else {
        $('#purchase_order_number').val('');
        $('#purchase_order_number').attr('required', false);
        $('.purchase_order_number').hide();
    }

    $('input[name="pay_method"]').on('change', function() {
        // Check the selected shipping option
        var selectedShippingOption = $('input[name="pay_method"]:checked').val();

        // Show or hide additional fields based on the selected shipping option
        if (selectedShippingOption === 'onaaccount') {
            $('.purchase_order_number').show();
            $('#purchase_order_number').attr('required', true);
        } else {
            $('#purchase_order_number').val('');
            $('#purchase_order_number').attr('required', false);
            $('.purchase_order_number').hide();
        }
    });

    $('input[name="pay_method"]').change(function() {
        // If at least one radio button is selected, remove the 'required' attribute
        if ($('input[name="pay_method"]:checked').length > 0) {
            $('#paymentForm').removeAttr('required');
        } else {
            // If no radio button is selected, add the 'required' attribute
            $('#paymentForm').attr('required', 'required');
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

    var formattedSubtotal = "$" + subtotal.toFixed(2);

    // var formattedSubtotal = "$" + subtotal.toLocaleString(undefined, {
    //     minimumFractionDigits: 2
    // });

    var gstPercentage = 10;
    var gstAmount = (subtotal * gstPercentage) / 100;

    // Calculate total amount including GST
    var totalAmount = subtotal + gstAmount;

    var formattedSubtotalgst = "$" + totalAmount.toFixed(2);
    var formattedSubtotalgst1 = "$" + gstAmount.toFixed(2);
    $('.payment_button').text(formattedSubtotalgst);
    $('#total_gst').text(formattedSubtotalgst1);
    
    $('#totalAmount').text(formattedSubtotalgst);
    $('#total').text(formattedSubtotalgst);

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
                var company_id = '<?php if($user_id){ echo $company_id;} ?>';
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
            // console.log(response);
            applyCoupon(response);

            if(response.status != 'error'){
                $('#subtotal').text(formattedTotalAmount);
                $('#totalAmount').text(formattedTotalAmount);
                $('#total').text(formattedTotalAmount);
            }

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
        // console.log(finalTotalAmount);
    if (finalTotalAmount != '') {
        $('#total').text(finalTotalAmount);
        $('#totalAmount').text(finalTotalAmount);
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

// $("#product_form").submit(function() {
//     var selectedShippingOption = $('input[name="shipping_value"]:checked').val();
//     if(selectedShippingOption && $('#read_all').is(':checked')){
//         $('#destroyButton').prop('disabled', true);
//     }
// });
</script>