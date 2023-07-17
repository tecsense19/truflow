<?= $this->include('admin/layout/front') ?>
<?php

$child_id = isset($childData) ? $childData['child_id'] : '';
$category_id = isset($childData) ? $childData['category_id'] : '';
$sub_category_id = isset($childData) ? $childData['sub_category_id'] : '';
$sub_chid_id = isset($childData) ? $childData['sub_chid_id'] : '';



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

                <form method="post" id="product_form" action="<?php echo base_url() ?>admin/child_sub_category/save_name" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Child Sub Category</h5>
                        </div>
                        <div class="card-body">

                            <!-- Category dropdown -->
                            <div class="mb-3" id="child-subcategory-input">
                                <label for="child-subcategory-input" class="form-label">Child Subcategory Name</label>
                                <input type="hidden" name="change" value="edited">
                                <input type="hidden" name="child_id" value="<?php echo $childData['child_id'] ?>">
                                <input type="hidden" name="category_id" value="<?php echo $childData['category_id'] ?>">
                                <input type="hidden" name="sub_category_id" value="<?php echo $childData['sub_category_id'] ?>">
                                <input type="text" class="form-control" value="<?php echo $childData['child_sub_category_name'] ?>" id="child-subcategory-input" name="child_sub_category_name">
                            </div>
                        </div>
                    </div>


                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

