<?= $this->include('admin/layout/front'); 
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
                    <h5 class="mb-0">Product List</h5>
                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                            Import/Export
                        </button>
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Import/Export</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/import_csv'); ?>">
                                                <input type="file" name="csv_file" required>
                                                <button type="submit" class="btn btn-primary">Import CSV</button>
                                            </form>
                                        </div>
                                        <div class="mt-3">

                                            <a href="<?php echo base_url('admin/export_csv'); ?>" class="btn btn-primary">Export CSV</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <a href="<?php echo base_url() . "admin/product" ?>"><button class="btn btn-primary d-grid float-end">Add product</button></a>
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
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Description</th>
                                            <th style="display:none;">Coupon code</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        if ($productData) { ?>

                                            <?php foreach ($productData as $product) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $product['product_name']; ?>&nbsp;&nbsp;<?php // echo $product['parent']; ?></td>
                                                    <td><?php echo $product['category_name'] ?></td>
                                                    <td><?php echo $product['sub_category_name'] ?></td>
                                                    <td class="testo_descrip"><?php echo $product['product_description']; ?></td>
                                                    <td style="display:none;"><?php echo $product['coupon_code']; ?></td>
                                                    <td>
                                                        <?php if (isset($product['product_img'])) {
                                                            $imagePaths = explode(',', $product['product_img']);
                                                            $firstImagePath = trim($imagePaths[0]);
                                                        ?>
                                                            <a data-fancybox="preview" href="<?php echo base_url('') . $firstImagePath; ?>">
                                                                <img src="<?php echo base_url('') . $firstImagePath; ?>" alt="Image" class="" width="100">
                                                            </a>
                                                        <?php } else { ?>
                                                            <img class="" width="100" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                                        <?php } ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <a class="" href="<?php echo base_url('') . "admin/product/edit/" . $product['product_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="delete-product" href="<?php echo base_url('') . "admin/product/delete/" . $product['product_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center"><?php echo "No Data"; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <input type="submit" class="btn btn-primary d-grid"> -->
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script>
    $(document).ready(function() {
        $(".delete-product").on("click", function(e) {
            e.preventDefault();

            var deleteUrl = $(this).attr("href");

            // Show a confirmation dialog
            var confirmDelete = window.confirm("Are you sure you want to delete this product?");

            // If the user confirms, proceed with the deletion
            if (confirmDelete) {
                window.location.href = deleteUrl;
            }
        });
    });
</script>