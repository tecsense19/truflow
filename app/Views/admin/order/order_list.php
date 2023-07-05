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


                                                    <td><?php echo $cart['order_status']; ?></td>
                                                    <td>
                                                     
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?php echo $cart['order_id']; ?>">
                                                            Order Status
                                                        </button>
                                                        
                                                        <a class="" href="<?php echo base_url('') . "admin/order/order_details/" . $cart['order_id'] ?>"><i class="fa fa-eye me-1"></i> Order Details</a>

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