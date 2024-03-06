
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Short Description</th>
            <th>Product Image</th>
            <th>Total Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        // echo '<pre>';print_r($topSellingData);echo '</pre>';die;
        if (count($topSellingData) > 0) {
            foreach ($topSellingData as $topSelling) {
        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $topSelling['product_name'] ?></td>
                    <td><?php echo $topSelling['product_short_description']; ?></td>
                    <td><img class="" style="width: 25%;" src="<?php echo base_url() ?><?php echo $topSelling['product_img'];?>" alt=""></td>
                    <td><?php echo $topSelling['total_quantity']; ?></td>
                </tr>
            <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="text-center">No data found.</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?= $this->include('admin/layout/footer') ?>