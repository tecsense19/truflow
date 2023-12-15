<style>
    h5.mb-0 {
        color: #696CFF;
    }
</style>
<?php


//product
$product_setting_id = isset($productData) ? $productData['setting_id'] : '';
$product_title = isset($productData) ? $productData['title'] : '';
$product_description = isset($productData) ? $productData['description'] : '';

?>

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
                <form method="post" id="settings_form" action="<?php echo base_url() ?>admin/settings/save" enctype='multipart/form-data'>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Product Title</label>
                                <input type="text" value="<?php echo $product_title; ?>" class="form-control" id="title" name="product_title" placeholder="Title" />
                                <input type="hidden" name="product_setting_id" value="<?php echo $product_setting_id; ?>">
                                <input type="hidden" name="form_type" value="product">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product Description</label>
                                <textarea id="editor4" name="product_description"><?php echo $product_description; ?></textarea>
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
        $('#settings_form').validate({
            rules: {
                welcome_title: 'required',
                welcome_sub_title: 'required',
                welcome_description: 'required',
                welcome_button_text: 'required',
                welcome_button_link: 'required',
                about_title: 'required',
                about_sub_title: 'required',
                about_description: 'required',
                about_button_text: 'required',
                about_button_link: 'required',
                contact_title: 'required',
                contact_description: 'required',
                contact_button_text: 'required',
                contact_button_link: 'required',
                product_title: 'required',
                product_description: 'required',
                testominal_title: 'required',
                testominal_description: 'required',
                partner_title: 'required',
                partner_description: 'required',
            },
            messages: {
                // Add custom error messages here if needed
            },
            submitHandler: function(form) {
                // Handle form submission if all fields are valid
                form.submit();
            }
        });


    });

</script>