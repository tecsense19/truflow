<?= $this->include('admin/layout/front') ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Order List</h5>
                    <!-- <a href="<?php echo base_url() . "admin/user" ?>"><button class="btn btn-primary d-grid float-end">Add Order</button></a> -->
                </div>
                <div class="card mb-4">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Product Name</th>
                                            <th>Order Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (isset($cartData)) { ?>

                                            <?php foreach ($cartData as $cart) {  ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $cart['full_name']; ?></td>
                                                    <td><?php echo $cart['email']; ?></td>

                                                    <td>
                                                        <?php echo $cart['product_name']; ?>

                                                    </td>
                                                    <td><?php echo $cart['order_status']; ?></td>
                                                    <td>
                                                    <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#exLargeModal"
                        >
                          Order Details
                        </button>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?php echo $cart['order_id']; ?>">
                                                            Order Status
                                                        </button>
                                                       
                                                        <a href="<?php echo base_url('') . "admin/order/delete/" . $cart['order_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                      

                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center"><?php echo "No Data"; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- ------------ order Model --------------------- -->

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header and body -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Change Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your existing code here -->
                <?php if (isset($statusData)) { ?>
                    <select name="order_status" id="order_status" class="form-control" aria-label="Default select example">
                        <option value="">Please Select Order Status</option>
                        <?php foreach ($statusData as $status) : ?>
                            <option value="<?php echo $status['label'] ?>"><?php echo $status['label'] ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php } ?>

                <!-- Hidden field to store the orderID -->
                <input type="hidden" id="orderIDHiddenField" name="order_id">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveStatus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- -------order details ------------------- -->
<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel4">Order Details</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                           
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                   <h5>Billing Address</h5>
                                 
                                    <?php echo $cartData[0]['address_1'].","?><br>
                                    <?php echo $cartData[0]['address_2'].","?><br>
                                    <?php echo $cartData[0]['city']?>
                                  
                                </div>
                                <div class="mb-3 col-md-6">
                                <h5>Shipping Address</h5>
                                <?php echo  $cartData[0]['product_item'][0]['address_1'].","?><br>
                                    <?php echo  $cartData[0]['product_item'][0]['address_2'].","?><br>
                                    <?php echo  $cartData[0]['product_item'][0]['city']?>
                                </div>
                            </div>
      
                            <table class="table card" style="width: 100%;">
<thead>
<tr class="mainsetcolor">
        <th colspan="2">Order Id: #<?php echo $cartData[0]['product_item'][0]['order_id'];?></th>
        <th colspan="2">Order By: <?php echo $cartData[0]['product_item'][0]['full_name'];?></th>
        <th colspan="4">Order Date: <?php echo $cartData[0]['product_item'][0]['created_at'];?></th>
       
      </tr>
    
        <th style="width: 10%;">Product name</th>
        <th style="width: 30%;">Product details</th>
        <th style="width: 20%;">Variant</th>
        <th style="width: 10%;">Part Number</th>
        <th style="width: 10%;">Qty</th>
        <th style="width: 10%;">Price</th>
        <th style="width: 10%;">Order Status</th>
  
</thead>
<tbody>
   

        <?php foreach($cartData[0]['product_item'] as $order) {  ?>
            <tr>
        <td style="width: 10%;"><?php echo $order['product_name'];?></td>
        <td style="width: 30%;"><?php echo $order['product_description'];?></td>
        <td style="width: 20%;"><?php echo $order['variant_name'];?></td>
        <td style="width: 10%;"><?php echo $order['variant_sku'];?></td>
        <td style="width: 10%;"><?php echo $order['product_quantity'];?></td>
        <td style="width: 10%;"><?php echo $order['product_amount'];?></td>
        <td style="width: 10%;"><?php echo $order['order_status'];?></td>
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
        foreach ($cartData[0]['product_item'] as $order) {
            $totalAmount += $order['total_amount'];
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
        <td><?php foreach($cartData as $order) {  ?>
            <?php if ($order['discount_type'] == "Flat"){?>
            <?php echo $order['product_discount']." "."Rs";?>
            <?php }else{ ?>
                <?php echo $order['product_discount']." "."%";?>
                <?php }?>
            <?php } ?>
        </td>
        <td></td>
            </tr>

            <tr>
            <td></td>
                <td></td>
                <td></td>
                <td></td>
            <td>Grand Total</td>
        <td><?php foreach($cartData as $order) {  ?>
            <?php echo $order['final_total_ammount'];?>
            <?php } ?>
        </td>
        <td></td>
            </tr>


                </tbody>
</table>



                              
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
</div>
</div>
<!-- --------------------------------- -->
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

<script>
    $('button[data-bs-toggle="modal"]').click(function() {
        var orderID = $(this).data('id');
        //console.log(orderID);
        $('#basicModal').data('id', orderID);
        $('#orderIDHiddenField').val(orderID);
    });
</script>


<script>
    $(document).ready(function() {
        $("#user_form").validate({
            rules: {
                label: {
                    required: true
                }


            },
            messages: {
                label: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
<script>
    function saveStatus(selectedValue) {

        var selectedValue = document.getElementById("order_status").value;
        var orderID = document.getElementById("orderIDHiddenField").value;

        //console.log(orderID);

        var url = '<?php echo base_url('admin'); ?>/change_order_status';
        var data = {
            orderId: orderID,
            status: selectedValue
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                // Handle the response from the server, if needed
                console.log(response);
                $('#basicModal').modal('hide'); // Close the modal
                location.reload(); // Reload the page
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.log(error);
            }
        });

    }
</script>