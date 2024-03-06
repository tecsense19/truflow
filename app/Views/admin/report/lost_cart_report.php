<?= $this->include('admin/layout/front') ?>
<?php 

$selectedUser1 = isset($selectedUser) ? $selectedUser : '';
$selectedDate1 = isset($selectedDate) ? $selectedDate : '';
?>
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
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
                    <h5 class="mb-0">Lost Cart Info</h5>
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
                                            <th style="width:50px;" class="text-center">#</th>
                                            <th style="width:200px;" class="text-center">UserName</th>
                                            <th>Lost Cart Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($cartData)) {
                                            foreach ($cartData as $order1) {
                                                // echo '<pre>';print_r($order1['full_name']);echo '</pre>';
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td class="text-center"><?php echo !empty($order1['full_name']) ? $order1['full_name'] : "guest"; ?></td>
                                                    <td>
                                                        <?php //echo $order1['full_name'];?>
                                                    
                                                            
                                                                <ul id="myUL">
                                                                        <li><span class="caret">
                                                                            <?php echo count($order1['cart_item']); ?> Products
                                                                        </span>
                                                                                <ul class="nested">
                                                                                <table id="datatable" class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center">Product Image</th>
                                                                                            <th class="text-center">Product Name</th>
                                                                                            <th class="text-center">PART NUMBER</th>
                                                                                            <th class="text-center">Total Amount</th>
                                                                                            <th class="text-center">Product Quantity</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php foreach ($order1['cart_item'] as $products): 
                                                                                    ?>
                                                                                    <?php //echo '<pre>';print_r($products);echo '</pre>'; ?>
                                                                                    <li>
                                                                                    <tr>
                                                                                        <td class="text-center"><img src="<?php echo base_url() ?><?php echo $products['product_img'];?>" alt="" width="50px" height="25px"></td>
                                                                                        <td class="text-center"><?php echo $products['product_name'];?></td>
                                                                                        <td class="text-center"><?php echo $products['variant_sku'];?></td>
                                                                                        <td class="text-center"><?php echo $products['total_amount'];?></td>
                                                                                        <td class="text-center"><?php echo $products['product_quantity'];?></td>
                                                                                        
                                                                                        <!-- <p>PART NUMBER:- <?php echo $products['variant_name'];?></p>
                                                                                        <p>Total Amount:- <?php echo $products['total_amount'];?></p>
                                                                                        <p>Product Quantity:- <?php echo $products['product_quantity'];?></p> -->
                                                                                        <!-- </span> -->
                                                                                    </tr>
                                                                                    </li>
                                                                                    <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>
                                                                                </ul>
                                                                        </li>
                                                                </ul>
                                                            
                                                            <?php $i++; ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            foreach ($guestcartData as $guestcart) {
                                                // echo '<pre>';print_r($order1['full_name']);echo '</pre>';
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td class="text-center"><?php echo !empty($guestcart['full_name']) ? $guestcart['full_name'] : "guest"; ?></td>
                                                    <td>
                                                        <?php //echo $order1['full_name'];?>
                                                    
                                                            
                                                                <ul id="myUL">
                                                                        <li><span class="caret">
                                                                            <?php echo count($guestcart['cart_item']); ?> Products
                                                                        </span>
                                                                                <ul class="nested">
                                                                                <table id="datatable" class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center">Product Image</th>
                                                                                            <th class="text-center">Product Name</th>
                                                                                            <th class="text-center">PART NUMBER</th>
                                                                                            <th class="text-center">Total Amount</th>
                                                                                            <th class="text-center">Product Quantity</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php foreach ($guestcart['cart_item'] as $guestproduct): 
                                                                                    ?>
                                                                                    <?php //echo '<pre>';print_r($products);echo '</pre>'; ?>
                                                                                    <li>
                                                                                    <tr>
                                                                                        <td class="text-center"><img src="<?php echo base_url() ?><?php echo $guestproduct['product_img'];?>" alt="" width="50px" height="25px"></td>
                                                                                        <td class="text-center"><?php echo $guestproduct['product_name'];?></td>
                                                                                        <td class="text-center"><?php echo $guestproduct['variant_sku'];?></td>
                                                                                        <td class="text-center"><?php echo $guestproduct['total_amount'];?></td>
                                                                                        <td class="text-center"><?php echo $guestproduct['product_quantity'];?></td>
                                                                                        
                                                                                        <!-- <p>PART NUMBER:- <?php echo $guestproduct['variant_name'];?></p>
                                                                                        <p>Total Amount:- <?php echo $guestproduct['total_amount'];?></p>
                                                                                        <p>Product Quantity:- <?php echo $guestproduct['product_quantity'];?></p> -->
                                                                                        <!-- </span> -->
                                                                                    </tr>
                                                                                    </li>
                                                                                    <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>
                                                                                </ul>
                                                                        </li>
                                                                </ul>
                                                            
                                                            <?php $i++; ?>
                                                    </td>
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
<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>