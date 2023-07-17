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
                    <h5 class="mb-0">Child Sub Category List</h5>
                

                    <a href="<?php echo base_url() . "admin/child_sub_category" ?>"><button class="btn btn-primary d-grid float-end">Add product</button></a>
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
                                            <th>Child Sub Category Name</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                      
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        if ($childSubCategoryData) { ?>

                                            <?php foreach ($childSubCategoryData as $childSubCategory) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $childSubCategory['child_sub_category_name']; ?></td>
                                                    <td><?php echo $childSubCategory['category_name'] ?></td>
                                                    <td><?php echo $childSubCategory['sub_category_name'] ?></td>
                                                    <td>
                                                        <a class="" href="<?php echo base_url('') . "admin/child_sub_category/name_edit/" . $childSubCategory['child_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="" href="<?php echo base_url('') . "admin/child_sub_category/delete/" . $childSubCategory['child_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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