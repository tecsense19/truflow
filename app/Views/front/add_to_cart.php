<?= $this->include('front/layout/front'); ?>
<?php
$session = session();
$user_id = $session->get('user_id');
$guestsessiondata = $session->get('guestsessiondata');
$sub_category_id = '';
$commonValues = '';
$company_id = '';
if($user_id)
{
  $company_id = isset($cartData) ? $cartData[0]['company_id'] : '';
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
            <h2>Add To Cart</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START <<~~~~~~~~~~~~~~~-->
<section class="product my-5">
  <div class="container">
    <?php if (isset($cartData)) { ?>
      <div class="row">
        <div class="col-lg-8">
          <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
          <?php } ?>
          <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php } ?>
          <div class="product_detail table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Part Number</th>
                  <th scope="col"></th>
                  <th scope="col">Price</th>
                  <th scope="col" class="text-center">Quantity</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php if ($cartData) { ?>
                  <?php foreach ($cartData as $cart) {
                    if(isset($cart['to_date']) && date('Y-m-d')<=$cart['to_date']){
                      $from_date = $cart['from_date'];  //2024-01-01
                      $to_date = $cart['to_date'];  //2024-01-05
                      $currentDate = date('Y-m-d');
                      $coupon_price_type = $cart['coupon_price_type'];
                      $cart_price = $cart['product_amount'];
                      $coupon_price = $cart['coupon_price'];
                      // echo '<pre> variant_price';print_r($cart_price);echo '</pre>';
                      // echo '<pre> coupon_price';print_r($coupon_price);echo '</pre>';
                      // echo '<pre>';print_r($currentDate > $from_date);echo '</pre>';die;
                      if ($currentDate >= $from_date && $currentDate <= $to_date) {
                          if ($coupon_price_type == 'Percentage')
                          {
                              $discount = $cart_price * $coupon_price / 100;
                          }else if ($coupon_price_type == 'Flat') {
                              $discount = $coupon_price;
                          }
                      }
                      $price = $cart['product_amount'] - $discount;
                      $final_price = round($price,2);
                    }else{
                        $final_price = $cart['product_amount'];
                    }
                    ?>
                    <tr>
                      <td class="align-middle">

                        <?php if (isset($cart['product_img'])) {
                          $imagePaths = explode(',', $cart['product_img']);
                          $firstImagePath = trim($imagePaths[0]);
                        ?>
                          <a data-fancybox="preview" href="<?php echo base_url('') . $firstImagePath ?>"><img src="<?php echo base_url('') . $firstImagePath ?>" alt="Image" class="" width="80"></a>
                        <?php } else { ?>
                          <img class="" width="80" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">

                        <?php } ?>



                      </td>

                      <td class="align-middle card_title"><?php echo $cart['variant_sku']; ?><br>
                        <!-- <p><a href="<?php //echo base_url('') . "product/details/" . $cart['product_id'] ?>">Product Name : <?php echo $cart['product_name']; ?>&nbsp;<?php // echo $cart['parent']; ?></a></p> -->
                        <p><a href="<?php echo base_url('') . $cart['product_url']; ?>">Product Name : <?php echo $cart['product_name']; ?>&nbsp;<?php // echo $cart['parent']; ?></a></p>
                      </td>
                      <!-- <td class="align-middle"><?php //echo $cart['product_amount']; ?><sub> Ex-Gst</sub></td> -->
                      <td class="align-middle"><?php echo $final_price; ?><sub> Ex-Gst</sub></td>
                      <td class="align-middle text-center">
                        <form class="wrapper">
                          <div class="cart-box">
                            <?php echo $cart['product_quantity']; ?>
                          </div>
                        </form>
                      </td>
                      <td class="align-middle cart_remove">
                        <a href="javascript:void(0)" onclick="showConfirmation(<?php echo  $cart['cart_id'] ?>)">
                          <i class="fa-solid fa-xmark"></i> Remove
                        </a>
                      </td>
                    </tr>

                  <?php } ?>

              </tbody>
            </table>
            <!-- <div class="d-flex justify-content-between">
              <form class="coupon_form">
                <label>Coupon Code:</label>
                <input type="text" id="couponCode" name="coupon" placeholder="Enter Coupon Code">
                <button type="button" id="applyCouponButton" class="coupon_button">Apply</button>
              </form>
            </div>
            <div id="couponMessage"></div> -->
          </div>
        </div>

        <div class="col-lg-4">
          <div class="subtotal">
            <ul style="padding: 0;">
              <!-- <li class="d-flex justify-content-between sub">
                <h5>Subtotal</h5>
                <h5 id="totalAmount"></h5>
              </li> -->
              <!-- ------------------------------------ -->
              <?php if (isset($cartData)) { ?>
                <div class="your_order">
                  <h3>Your Order</h3>

                  <ul class="p-0">
                    <li class="d-flex justify-content-between sub">
                      <h5>Product</h5>
                      <h5>Total</h5>
                    </li>

                    <?php foreach ($cartData as $cart) {  ?>

                      <?php $sub_category_id = $sub_category_id ? $sub_category_id . ',' . $cart['sub_category_id'] : $cart['sub_category_id'];
                      ?>
                      <li class="d-flex justify-content-between sub">
                        <p><?php echo $cart['product_name']; ?> x <?php echo $cart['product_quantity']; ?></p>
                        <span class="sub_category_id_match_<?php echo $cart['sub_category_id'] ?>">
                          <?php

                          $total_Amount = $cart['product_amount'] * $cart['product_quantity'];
                          $formatted_Amount = number_format($total_Amount, 2, '.', ',');

                          echo "$" . $formatted_Amount;
                          ?><sub> Ex-Gst</sub>
                        </span>
                      </li>
                    <?php } ?>
                    <li class="sub order_total_gst d-flex justify-content-between align-items-center">
                                <p>GST</p>
                                <span id="total_gst">$000.00</span>
                      </li>
                    <li class="d-flex justify-content-between sub">
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

                    <li class="d-none justify-content-between sub">
                      <p>Discount</p>
                      <span id="discount">$<?php echo number_format($total_auto_discount, 2); ?></span>
                    </li>

                    <li class="d-flex justify-content-between sub">
                      <p>Total Amount</p>
                      <span id="totalAmount">$000.00</span>
                    </li>
                    <!-- ------------------------------------ -->
                    <!-- <li class="subtotal_list mt-3">
                      <p>Shipping</p>
                      <div class="shipp_checkbox">
                        <div>
                          <input id="free_shipping" type="radio" name="shipping">
                          <label for="free_shipping">Free shipping</label>
                        </div>
                      </div>
                    </li> -->
                    <li class="d-flex justify-content-between sub">
                      <h5>Final Total</h5>
                      <h5 id="totalAmount">
                        <span id="total">$000.00</span>
                      </h5>
                    </li>
                    <li class="subtotal_list">
                      <input type="hidden" id="coupon_code" name="coupon_code" value="" />
                      <input type="hidden" id="discount_type" name="discount_type" value="" />
                      <input type="hidden" id="product_discount" name="product_discount" value="" />
                      <input type="hidden" id="final_total_ammount" name="final_total_ammount" value="" />
                      <input type="hidden" id="discount_d" name="discount_d" value="" />

                      <a href="#" class="proceed_btn">Proceed to Checkout</a>
                    </li>
                  </ul>
                </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  <?php } else { ?>


    <div class="col-md-12 text-center-t1">
      <div class="form-group mt-5 mb-5 data_center text-center">
        <h4>No Item Found</h4>
      </div>

    </div>
  <?php } ?>
      </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function showConfirmation(id) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be remove this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, remove it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // Continue with the deletion
        var cart_id = id;
        // alert(cart_id);
        $.ajax({
        url: '<?php echo base_url('') . 'delete/';?>' + cart_id,
        method: 'GET',
        success: function(response) {
          window.location.reload();
          // console.log(response);
          // window.location.href = response.target.href;
        },
        error: function(xhr, status, error) {
          alert("An error occurred while delete cart icon");
        }
      });

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

    var gstPercentage = 10;
    var gstAmount = (subtotal * gstPercentage) / 100;

    // Calculate total amount including GST
    var totalAmount = subtotal + gstAmount;

    var formattedSubtotalgst = "$" + totalAmount.toFixed(2);
    var formattedSubtotalgst1 = "$" + gstAmount.toFixed(2);
    $('#total').text(formattedSubtotalgst);
    var formatedAmmount = formattedSubtotalgst.replace('$', '');
    $('#final_total_ammount').val(formatedAmmount);
    $('#total_gst').text(formattedSubtotalgst1);

    $('#totalAmount').text(formattedSubtotal);
    // $('#total').text(formattedSubtotal);

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

                var array1 = couponData[0].sub_category_id ? couponData[0].sub_category_id.split(',') : [];
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
                  var subtotal1 = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));
                  $('#subtotal').text(formatAmount(subtotal1 - discount));
                  var new_subtotal = parseFloat($('#subtotal').text().replace(/[^0-9.-]+/g, ''));
                  var new_discount = parseFloat($('#discount').text().replace(/[^0-9.-]+/g, ''));
                  var formattedAmount1 = formatAmount(new_subtotal);
                  var formattedDiscount1 = formatAmount(new_discount);
                  new_amount = new_amount ? new_amount + '&sub_category_id_match_' + index + '_' + commonValues[0] + '=' + formattedAmount : '&sub_category_id_match_' + index + '_' + commonValues[0] + '=' + formattedAmount;
                  $('#discount').text(formattedDiscount1);
                  $('#subtotal').text(formattedAmount1);
                  $('#totalAmount').text(formattedAmount1);
                  $('#total').text(formattedAmount1);
                  var formatedAmmount = formattedAmount1.replace('$', '');
                  $('#final_total_ammount').val(formatedAmmount);
                  var forDiscount1 = formattedDiscount1.replace('$', '');
                  $('#discount_d').val(forDiscount1);
                });

                $('#discount').text(formatAmount(discount * $('.sub_category_id_match_' + commonValues[0]).length));
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
    var company_id = "<?php echo $company_id; ?>";
    $.ajax({
      url: '<?php echo base_url(); ?>check_coupon',
      method: 'POST',
      data: {
        company_id: company_id
      },
      success: function(response) {
        console.log(response);
        applyCoupon(response);

        //alert(response);
        $('#subtotal').text(formattedTotalAmount);
        $('#totalAmount').text(formattedTotalAmount);
        $('#total').text(formattedTotalAmount);
      },
      error: function(xhr, status, error) {
        alert("An error occurred while checking the coupon code");
      }
    });


  });


  $(".proceed_btn").click(function(e) {
    e.preventDefault();

    // var key = CryptoJS.lib.WordArray.random(128 / 8);
    var key = CryptoJS.enc.Hex.parse('2b7e151628aed2a6abf7158809cf4f3c');

    var discountType = $("#discount_type").val();
    var productDiscount = $("#product_discount").val();
    var finalTotalAmount = $("#final_total_ammount").val();
    var shipping = $("#free_shipping").prop("checked");
    var discount = $("#discount").text();

    var encrypted = CryptoJS.AES.encrypt(finalTotalAmount, key, { mode: CryptoJS.mode.ECB });
    var encryptedfinalTotalAmount = encrypted.toString();

    var url = "<?php echo base_url('checkout/') ?>" + "?discount_type=" + encodeURIComponent(discountType) + "&product_discount=" + encodeURIComponent(productDiscount) + "&final_total_ammount=" + encodeURIComponent(encryptedfinalTotalAmount) + "&free_shipping=" + encodeURIComponent(shipping) + "&discount_d=" + encodeURIComponent(discount) + new_amount;

    window.location.href = url;
  });
</script>