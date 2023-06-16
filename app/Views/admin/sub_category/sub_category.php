<?= $this->include('admin/layout/front') ?>
<?php
$sub_category_id = isset($subcategoryData) ? $subcategoryData['sub_category_id'] : '';
$category_id = isset($subcategoryData) ? $subcategoryData['category_id'] : '';
$sub_category_name = isset($subcategoryData) ? $subcategoryData['sub_category_name'] : '';
$sub_category_description = isset($subcategoryData) ? $subcategoryData['sub_category_description'] : '';
$sub_category_img = isset($subcategoryData) ? $subcategoryData['sub_category_img'] : '';
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

                <form method="post" id="sub_category_form" action="<?php echo base_url() ?>admin/sub_category/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sub Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Category</label>

                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Please select any Category</option>
                                    <?php foreach ($categoryData as $category) : ?>
                                        <?php if ($category['category_id'] == $category_id) : ?>
                                            <option value="<?= $category['category_id'] ?>" selected="selected"><?= $category['category_name'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Category Name</label>
                                <input type="text" value="<?php echo $sub_category_name; ?>" class="form-control" id="sub_category_name" name="sub_category_name" placeholder="Sub Category Name" />
                                <input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Sub Category Description</label>
                                <textarea id="sub_category_description" name="sub_category_description" class="form-control" placeholder="sub category Description"><?php echo $sub_category_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">sub_category Image</label>
                                <input type="file" class="form-control" value="" id="sub_category_img" name="sub_category_img" placeholder="sub_category Image" />
                                <?php if ($sub_category_img) { ?>
                                    <img src="<?php echo base_url() . $sub_category_img ?>" alt="sub_category_img" class="img-fluid site_setting_img">

                                <?php } ?>
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
<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($sub_category_img ? 'true' : 'false'); ?>;
        
        $("#sub_category_form").validate({
            rules: {
                category_id: {
                    required: true
                },
                sub_category_name: {
                    required: true
                },
                sub_category_description: {
                    required: true
                },
                sub_category_img: {
                    required: function() {
                        return !imageUploaded; // Validation required only if image has not been uploaded
                    }
                }
            },
            messages: {
                category_id: {
                    required: "Category is required!"
                },
                sub_category_name: {
                    required: "Sub Category Name is required!"
                },
                sub_category_description: {
                    required: "Sub Category Description is required!"
                },
                sub_category_img: {
                    required: "Sub Category Image is required!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>