<style>
    h5.mb-0 {
        color: #696CFF;
    }
</style>
<?php

// Contact
$contact_setting_id = isset($contactData) ? $contactData['setting_id'] : '';
$contact_title = isset($contactData) ? $contactData['title'] : '';
$contact_description = isset($contactData) ? $contactData['description'] : '';
$contact_button_text = isset($contactData) ? $contactData['button_text'] : '';
$contact_button_link = isset($contactData) ? $contactData['button_link'] : '';


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
                            <h5 class="mb-0">Contact</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Contact Title</label>
                                <input type="text" value="<?php echo $contact_title; ?>" class="form-control" id="title" name="contact_title" placeholder="Title" />
                                <input type="hidden" name="contact_setting_id" value="<?php echo $contact_setting_id; ?>">
                                <input type="hidden" name="form_type" value="contact">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Contact Description</label>
                                <textarea id="editor3" name="contact_description"><?php echo $contact_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Contact Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $contact_button_text; ?>" id="sub_title" name="contact_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Contact Button Link</label>
                                <div class="input-group mb-3 link_error">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="contact_button_link"><?php echo base_url(''); ?></span>
                                    </div>
                                    <input type="text" class="form-control" id="contact_button_link" name="contact_button_link" value="<?php echo $contact_button_link; ?>" aria-describedby="basic-addon3">
                                </div>
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