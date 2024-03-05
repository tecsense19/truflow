<?= $this->include('admin/layout/front') ?>
<?php 

$selectedUser1 = isset($selectedUser) ? $selectedUser : '';
$selectedDate1 = isset($selectedDate) ? $selectedDate : '';
?>
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
                    <h5 class="mb-0">Lost Cart Report</h5>
                </div>
                <div class="card mb-4">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form method="POST" id="myForm" action="<?php echo base_url() . "admin/user_search_data" ?>">
                                    <div class="row">
                                        <!-- Order Status dropdown -->
                                        <!-- <div class="col-md-4 mb-4">
                                            <label class="form-label" for="order_status">User</label>
                                            <select name="user_id" id="user_id" class="form-control" aria-label="Default select example">
                                                <option value="">Please Select User</option>
                                                <?php foreach ($userData as $user) : ?>
                                                    <?php $selected = ($user['user_id'] == $selectedUser1) ? 'selected' : ''; ?>
                                                    <option value="<?php echo $user['user_id']; ?>" <?php echo $selected; ?>><?php echo $user['full_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> -->

                                        <!-- Order Date input -->
                                        <!-- <div class="col-md-4 mb-4">
                                            <label class="form-label" for="order_date">Order Date</label>
                                            <input type="date" class="form-control" value="<?php echo $selectedDate1; ?>" name="order_date" id="order_date" placeholder="date">
                                        </div> -->



                                        <!-- Search button -->
                                        <!-- <div class="col-md-4 mb-4">

                                            <input type="submit" name="search" class="btn btn-primary" value="Search" style="margin-top: 28px;">
                                            <a href='<?php echo site_url("admin/user_report")?>' class="btn btn-secondary" style="margin-top: 28px;">Reset</a>

                                            <a href="#" class="btn btn-info export" style="margin-top: 28px;">Export</a>

                                        </div> -->
                                    </div>
                                </form>
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>UserName</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Part Number</th>
                                            <th>Total amount</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($cartData)) {
                                            foreach ($cartData as $order1) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo !empty($order1['full_name']) ? $order1['full_name'] : "guest"; ?></td>
                                                    <td><img class="" style="width: 25%;" src="<?php echo base_url() ?><?php echo $order1['product_img'];?>" alt=""></td>
                                                    <td><?php echo $order1['product_name']; ?></td>
                                                    <td><?php echo $order1['variant_sku']; ?></td>
                                                    <td><?php echo $order1['total_amount']; ?></td>
                                                    <td><?php echo $order1['product_quantity']; ?></td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No data found.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script>
$(document).ready(function() {
    $('.export').click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('user_id', $('#user_id').val());
        formData.append('order_date', $('#order_date').val());
        $.ajax({
            url: '<?php echo base_url('admin/user_export'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var url = URL.createObjectURL(response);
                var link = document.createElement('a');
                link.href = url;
                link.download = 'User_data.csv';
                link.click();
                URL.revokeObjectURL(url);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>