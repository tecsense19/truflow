<?= $this->include('front/layout/front'); ?>
<?php
$session = session();

$user_id = $session->get('user_id');
$category_id = '';
$commonValues = '';

if (isset($_GET['coupon_code'])) {
  $_SESSION['coupon_code'] = $_GET['coupon_code'];
}
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

$coupon_code = isset($_SESSION['coupon_code']) ? $_SESSION['coupon_code'] : '';
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
  <form class="mb-0 mt-4" method="post" id="product_form" action="<?php echo base_url() ?>place_order" enctype='multipart/form-data'>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="main_accordion">
            <div id="accordion">

              <div class="login_accordion">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    Have a coupon?
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="<?php echo isset($_SESSION['coupon_code']) ? 'true' : 'false'; ?>" aria-controls="collapseThree">
                      Click here to enter your code
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse <?php echo isset($_SESSION['coupon_code']) ? 'show' : ''; ?>" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body">
                    <form action="#" class="login_form">
                      <div class="checkout-input">
                        <label>Coupon Code :</label>
                        <input type="text" id="couponCode" name="coupon" placeholder="Coupon" value="<?php echo isset($_SESSION['coupon_code']) ? htmlspecialchars($_SESSION['coupon_code']) : ''; ?>">
                      </div>
                      <div id="couponMessage"></div>
                      <button type="button" class="coupon_button">Apply</button>
                    </form>
                  </div>

                </div>
              </div>



            </div>
          </div>
        </div>
        <?php if (isset($userData)) { ?>
          <?php foreach ($userData as $user) { ?>
            <div class="col-lg-7">
              <div class="billing_detail">
                <h3>Billing Details</h3>
                <form action="#" class="checkout_form mt-4">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="checkout-input">
                        <label>First Name <span>*</span></label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-input">
                        <label>Last Name <span>*</span></label>
                        <input type="text" id="form9Example2" name="last_name" value="<?php echo $user['last_name']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Company name (optional)</label>
                        <input type="text" id="company_name" name="company_name" value="<?php echo $user['company_name']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Country / Region </label>
                        <input type="text" id="country" name="country" value="<?php echo $user['country']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Street address</label>
                        <input type="text" id="address_1" name="address_1" value="<?php echo $user['address_1']; ?>" class="form-control input-custom" />
                      </div>

                      <div class="checkout-input">
                        <input type="text" id="address_2" name="address_2" value="<?php echo $user['address_2']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Town / City</label>
                        <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-input">
                        <label>State / County</label>
                        <select>
                          <option>New York US</option>
                          <option>Berlin Germany</option>
                          <option>Paris France</option>
                          <option>Tokiyo Japan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-input">
                        <label>Postcode ZIP</label>
                        <input type="text" id="zipcode" name="zipcode" value="<?php echo $user['zipcode']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Phone <span>*</span></label>
                        <input type="text" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Email address <span>*</span></label>
                        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" class="form-control input-custom" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-option-wrapper">
                        <div class="checkout-option">
                          <input id="create_free_account" type="checkbox">
                          <label for="create_free_account">Create an account?</label>
                        </div>
                        <div class="checkout-option">
                          <input id="ship_to_diff_address" type="checkbox">
                          <label for="ship_to_diff_address">Ship to a different address?</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-input">
                        <label>Order notes (optional)</label>
                        <textarea placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                      </div>
                    </div>

                  </div>
                </form>
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

                  <?php $category_id = $category_id ? $category_id . ',' . $cart['category_id'] : $cart['category_id'];
                  ?>
                  <li class="order_list d-flex justify-content-between align-items-center">
                    <p><?php echo $cart['product_name']; ?> x <?php echo $cart['product_quantity']; ?></p>
                    <div class="data">
                    <span class="category_id_match_<?php echo $cart['category_id'] ?>">
                      <?php
                      $createString = isset($_GET['category_id_match_' . ($key) . '_' . $cart['category_id']]) ? $_GET['category_id_match_' . ($key) . '_' . $cart['category_id']] : '';
                      ?>
                      <?php
                      if ($createString) {
                        echo "$" . $createString;
                      } else {
                        $total_Amount = $cart['product_amount'] * $cart['product_quantity'];
                        $formatted_Amount = number_format($total_Amount, 2, '.', ',');
                        echo "$" . $formatted_Amount;
                      }

                      ?>
                                 
                    </span>
                    <span class="ml-2">
                    <a href="#" onclick="confirmDelete('<?php echo base_url('') . 'delete_check/' . $cart['cart_id']; ?>')">
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

                  <span id="discount">$000.00</span>
                </li>

                <li class="order_list d-flex justify-content-between align-items-center">
                  <p>Total Amount</p>
                  <span id="totalAmount">$000.00</span>
                </li>

                <li class="order_list d-flex justify-content-between align-items-center">
                  <p>Shipping</p>
                  <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                    <span>
                      <input type="radio" id="order_status" name="shipping" value="Free shipping" <?php echo ($shipping == 'true') ? 'checked' : ''; ?> />
                      <label for="free_shipping">Free shipping</label>
                    </span>
                  </div>
                </li>

                <li class="order_total d-flex justify-content-between align-items-center">
                  <h5>Total</h5>

                  <h5 id="total">$000.00</h5>

                </li>
              </ul>


              <div class="payment_item">
                <span>
                  <input type="radio" name="pay_method" value="cash" required>
                  <label for="cash_ond_delivery">Cash on Delivery</label>
                </span>
              </div>

              <div class="checkout-agree">
                <div class="checkout-option">
                  <input id="read_all" type="checkbox">
                  <label for="read_all">I have read and agree to the website.</label>
                </div>
              </div>
              <div class="checkout_btn">

                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>" />

                <input type="hidden" id="order_status" name="order_status" value="Pending" />

                <?php if (isset($discount_type) && $discount_type != '') { ?>
                  <input type="hidden" id="discount_type" name="discount_type" value="<?php echo $discount_type ?>" />
                <?php } else { ?>
                  <input type="hidden" id="discount_type" name="discount_type" value="" />
                <?php } ?>

                <?php if (isset($product_discount) && $product_discount != '') { ?>
                  <input type="hidden" id="product_discount" name="product_discount" value="<?php echo $product_discount ?>" />
                <?php } else { ?>
                  <input type="hidden" id="product_discount" name="product_discount" value="" />
                <?php } ?>

                <?php if (isset($final_total_ammount) && $final_total_ammount != '') { ?>
                  <input type="hidden" id="final_total_ammount" name="final_total_ammount" value="<?php echo $final_total_ammount ?>" />
                <?php } else { ?>
                  <input type="hidden" id="total_db_save" name="final_total_ammount" value="" />
                <?php } ?>

                <button type="submit" class="btn btn-primary btn-rounded" style="background-color: #0062CC ;">Place order</button>
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
        window.location.href = url;
      }
    });
  }
</script>

<script>
  $(document).ready(function() {
    var subtotal = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));
    var formattedSubtotal = "$" + subtotal.toLocaleString(undefined, {
      minimumFractionDigits: 2
    });
    $('#totalAmount').text(formattedSubtotal);
    $('#total').text(formattedSubtotal);

    var total_db_save = formattedSubtotal.replace('$', '');

    $('#total_db_save').val(total_db_save);

    $('.coupon_button').click(function() {
      var couponCode = $('#couponCode').val();

      $.ajax({
        url: '<?php echo base_url(); ?>check_coupon',
        method: 'POST',
        data: {
          coupon: couponCode
        },
        success: function(response) {
          console.log(response);
          if (response.status === 'success') {
            var couponData = response.couponData;
            if (couponData.length > 0) {
              var couponType = couponData[0].coupon_price_type;
              var coupon_type = couponData[0].coupon_type;
              var couponAmount = parseFloat(couponData[0].coupon_price);
              var totalAmount = subtotal;
              var total = subtotal;
              var catId = "<?php echo $category_id; ?>";

              $('#discount_type').val(couponType);
              $('#product_discount').val(couponAmount);
              $('#coupon_code').val(couponCode);

              // alert(catId);

              if (!isNaN(couponAmount)) {
                var discount = 0;

                if (couponType === 'Percentage') {
                  discount = (subtotal * couponAmount) / 100;
                } else if (couponType === 'Flat') {
                  discount = couponAmount;
                }
                if (coupon_type == 'User') {
                  var userIds = '<?php echo $user_id ?>';
                  var array = couponData[0].user_id ? couponData[0].user_id.split(',') : [];
                  if ($.inArray(userIds, array) !== -1) {
                    totalAmount = subtotal - discount;
                    if (totalAmount < 0) {
                      totalAmount = 0;
                    }

                    total = subtotal - discount;
                    if (total < 0) {
                      total = 0;
                    }
                  }
                  var formattedDiscount = "$" + discount.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                  });
                  var formattedTotalAmount = "$" + totalAmount.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                  });

                  $('#discount').text(formattedDiscount);
                  $('#totalAmount').text(formattedTotalAmount);
                  $('#total').text(formattedTotalAmount);


                  var formatedAmmount = formattedTotalAmount.replace('$', '');
                  $('#final_total_ammount').val(formatedAmmount);

                  var formatedAmmount2 = formattedTotalAmount.replace('$', '');
                  $('#total_db_save').val(formatedAmmount2);

                  var forDiscount = formattedDiscount.replace('$', '');
                  $('#discount_d').val(forDiscount);
                  $('#couponMessage').text('Coupon is valid.');


                } else if (coupon_type == 'Global') {
                  totalAmount = subtotal - discount;
                  if (totalAmount < 0) {
                    totalAmount = 0;
                  }

                  total = subtotal - discount;
                  if (total < 0) {
                    total = 0;
                  }
                  var formattedDiscount = "$" + discount.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                  });
                  var formattedTotalAmount = "$" + totalAmount.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                  });

                  $('#discount').text(formattedDiscount);
                  $('#totalAmount').text(formattedTotalAmount);
                  $('#total').text(formattedTotalAmount);

                  var formatedAmmount = formattedTotalAmount.replace('$', '');
                  $('#final_total_ammount').val(formatedAmmount);

                  var formatedAmmount2 = formattedTotalAmount.replace('$', '');
                  $('#total_db_save').val(formatedAmmount2);

                  var forDiscount = formattedDiscount.replace('$', '');
                  $('#discount_d').val(forDiscount);
                  $('#couponMessage').text('Coupon is valid.');

                } else if (coupon_type === 'Category') {
                  var array1 = couponData[0].category_id ? couponData[0].category_id.split(',') : [];
                  var array2 = catId ? catId.split(',') : [];
                  console.log(array1);
                  var commonValues = array1.filter(function(value) {
                    return array2.indexOf(value) !== -1;
                  });
                  $('.category_id_match_' + commonValues[0]).each(function(index, element) {
                    var elementText = $(element).text();
                    var new_category_id = elementText.replace('$', '');
                    new_category_id = new_category_id.replace(/[^0-9.-]+/g, '');
                    var totalAmount = parseFloat(new_category_id) - discount;
                    var formattedAmount = totalAmount.toLocaleString('en-US', {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2
                    });

                    $(element).text('$' + formattedAmount);

                    var subtotal1 = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));

                    $('#subtotal').text(formatAmount(subtotal1 - discount));


                    var new_subtotal = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));
                    var new_discount = parseFloat($('#discount').text().replace(/[^0-9.-]+/g, ''));

                    var formattedAmount1 = formatAmount(new_subtotal);
                    var formattedDiscount1 = formatAmount(new_discount);

                    $('#discount').text(formattedDiscount1);
                    $('#subtotal').text(formattedAmount1);
                    $('#totalAmount').text(formattedAmount1);
                    $('#total').text(formattedAmount1);
                    var formatedAmmount = formattedAmount1.replace('$', '');
                    $('#final_total_ammount').val(formatedAmmount);

                    var formatedAmmount2 = formattedAmount1.replace('$', '');
                    $('#total_db_save').val(formatedAmmount2);

                    var forDiscount1 = formattedDiscount1.replace('$', '');
                    $('#discount_d').val(forDiscount1);
                  });

                  $('#discount').text(formatAmount(discount * $('.category_id_match_' + commonValues[0]).length));

                  $('#couponMessage').text('Coupon is valid.');
                }

                function formatAmount(amount) {
                  return "$" + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                  });
                }


              } else {
                console.log('Invalid couponAmount');
              }
            } else {
              resetDiscountAndTotal();
              $('#couponMessage').text('Coupon is invalid.');
            }

          } else {

            $('#couponMessage').text('Coupon is invalid.');
          }
        },

        error: function(xhr, status, error) {
          alert("An error occurred while checking the coupon code");
        }
      });
    });

    function resetDiscountAndTotal() {
      $('#discount').text('$000.00');
      $('#totalAmount').text(formattedSubtotal);
      $('#total').text(formattedSubtotal);
    }

    $('#couponCode').on('keydown input', function(event) {
      if (event.which === 8 || event.type === 'input' && $(this).val() === '') {
        resetDiscountAndTotal();
        $('#subtotal').text(formattedSubtotal);
        $('#couponMessage').text('');

        var total_db_save1 = formattedSubtotal.replace('$', '');
        $('#total_db_save').val(total_db_save1);

        var total_db_save2 = formattedSubtotal.replace('$', '');
        $('#final_total_ammount').val(total_db_save2);


      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    var finalTotalAmount = "<?php echo isset($final_total_ammount) ? $final_total_ammount ? '$' . $final_total_ammount : '' : ''; ?>";
    if (finalTotalAmount !== '') {
      $('#total').text(finalTotalAmount);

    }
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
