<?php
$welcome_setting_id = isset($welcomeData) ? $welcomeData['setting_id'] : '';
$welcome_title = isset($welcomeData) ? $welcomeData['title'] : '';
$welcome_sub_title = isset($welcomeData) ? $welcomeData['sub_title'] : '';
$welcome_description = isset($welcomeData) ? $welcomeData['description'] : '';
$welcome_button_text = isset($welcomeData) ? $welcomeData['button_text'] : '';
$welcome_button_link = isset($welcomeData) ? $welcomeData['button_link'] : '';
//image
$welcome_img_link = isset($imageData) ? $imageData['image_path'] : '';

// About
$about_setting_id = isset($aboutData) ? $aboutData['setting_id'] : '';
$about_title = isset($aboutData) ? $aboutData['title'] : '';
$about_sub_title = isset($aboutData) ? $aboutData['sub_title'] : '';
$about_description = isset($aboutData) ? $aboutData['description'] : '';
$about_button_text = isset($aboutData) ? $aboutData['button_text'] : '';
$about_button_link = isset($aboutData) ? $aboutData['button_link'] : '';

// Contact
$contact_setting_id = isset($contactData) ? $contactData['setting_id'] : '';
$contact_title = isset($contactData) ? $contactData['title'] : '';
$contact_description = isset($contactData) ? $contactData['description'] : '';
$contact_button_text = isset($contactData) ? $contactData['button_text'] : '';
$contact_button_link = isset($contactData) ? $contactData['button_link'] : '';

//product
$product_setting_id = isset($productData) ? $productData['setting_id'] : '';
$product_title = isset($productData) ? $productData['title'] : '';
$product_description = isset($productData) ? $productData['description'] : '';

//testominal
$testominal_setting_id = isset($testominalData) ? $testominalData['setting_id'] : '';
$testominal_title = isset($testominalData) ? $testominalData['title'] : '';
$testominal_description = isset($testominalData) ? $testominalData['description'] : '';

//partner
$partner_setting_id = isset($partnerData) ? $partnerData['setting_id'] : '';
$partner_title = isset($partnerData) ? $partnerData['title'] : '';
$partner_description = isset($partnerData) ? $partnerData['description'] : '';


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
                            <h5 class="mb-0">Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Title</label>
                                <input type="text" value="<?php echo $welcome_title; ?>" class="form-control" id="title" name="welcome_title" placeholder="Title" />
                                <input type="hidden" name="welcome_setting_id" value="<?php echo $welcome_setting_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Sub Title</label>
                                <input type="text" class="form-control" value="<?php echo $welcome_sub_title; ?>" id="sub_title" name="welcome_sub_title" placeholder="Sub Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Description</label>
                                <textarea id="editor1" name="welcome_description"><?php echo $welcome_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $welcome_button_text; ?>" id="sub_title" name="welcome_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Button Link</label>
                                <div class="input-group mb-3 link_error">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="welcome_button_link"><?php echo base_url(''); ?></span>
                                    </div>
                                    <input type="text" class="form-control" id="welcome_button_link" name="welcome_button_link" value="<?php echo $welcome_button_link; ?>" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Banner Image</label>
                                <input type="file" class="form-control" value="" id="welcome_image_path" name="welcome_image_path" placeholder="Banner Image" />
                                <?php if ($welcome_img_link) { ?>
                                    <img src="<?php echo base_url() . $welcome_img_link ?>" alt="banner_img" class="img-fluid site_setting_img">
                                    <a class="remove-image" href="#" style="display: inline;" data-id="<?php echo $imageData['image_id']; ?>">&#215;</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">About Us</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">About Title</label>
                                <input type="text" value="<?php echo $about_title; ?>" class="form-control" id="title" name="about_title" placeholder="Title" />
                                <input type="hidden" name="about_setting_id" value="<?php echo $about_setting_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">About Sub Title</label>
                                <input type="text" class="form-control" value="<?php echo $about_sub_title; ?>" id="sub_title" name="about_sub_title" placeholder="Sub Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">About Description</label>
                                <textarea id="editor2" name="about_description"><?php echo $about_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">About Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $about_button_text; ?>" id="sub_title" name="about_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">About Button Link</label>
                                <div class="input-group mb-3 link_error">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="about_button_link"><?php echo base_url(''); ?></span>
                                    </div>
                                    <input type="text" class="form-control" id="about_button_link" name="about_button_link" value="<?php echo $about_button_link; ?>" aria-describedby="basic-addon3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Contact</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Contact Title</label>
                                <input type="text" value="<?php echo $contact_title; ?>" class="form-control" id="title" name="contact_title" placeholder="Title" />
                                <input type="hidden" name="contact_setting_id" value="<?php echo $contact_setting_id; ?>">
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
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Product Title</label>
                                <input type="text" value="<?php echo $product_title; ?>" class="form-control" id="title" name="product_title" placeholder="Title" />
                                <input type="hidden" name="product_setting_id" value="<?php echo $product_setting_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product Description</label>
                                <textarea id="editor4" name="product_description"><?php echo $product_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Testominal</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Testominal Title</label>
                                <input type="text" value="<?php echo $testominal_title; ?>" class="form-control" id="title" name="testominal_title" placeholder="Title" />
                                <input type="hidden" name="testominal_setting_id" value="<?php echo $testominal_setting_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Testominal Description</label>
                                <textarea id="editor5" name="testominal_description"><?php echo $testominal_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Partner</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Partner Title</label>
                                <input type="text" value="<?php echo $partner_title; ?>" class="form-control" id="title" name="partner_title" placeholder="Title" />
                                <input type="hidden" name="partner_setting_id" value="<?php echo $partner_setting_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Partner Description</label>
                                <textarea id="editor6" name="partner_description"><?php echo $partner_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" value="" id="partner_image_path" name="partner_image_path[]" multiple placeholder="Banner Image" />
                                <?php if ($partnerImageData) { ?>
                                    <?php foreach ($partnerImageData as $partner) { ?>
                                        <div class="image-container partner_img">
                                            <img src="<?php echo base_url() . $partner['image_path'] ?>" alt="banner_img" class="site_setting_img">
                                            <a class="remove-image" href="#" style="display: inline;" data-id="<?php echo $partner['image_id']; ?>">&#215;</a>
                                        </div>
                                    <?php } ?>
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
<script>
    $(document).ready(function() {
        $('.remove-image').click(function(e) {
            e.preventDefault();
            var container = $(this).closest('.image-container');
            //var imageId = container.find('.image-id').val();
            var imageId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You Want To Delete This.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('admin/delete_partner_img') ?>',
                        type: 'POST',
                        data: {
                            image_id: imageId
                        },
                        success: function(response) {
                            container.remove();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    });
</script>