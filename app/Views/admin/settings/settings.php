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
                                <textarea id="description" name="welcome_description" class="form-control" placeholder="Description"><?php echo $welcome_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $welcome_button_text; ?>" id="sub_title" name="welcome_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Button Link</label>
                                <input type="text" class="form-control" value="<?php echo $welcome_button_link; ?>" id="sub_title" name="welcome_button_link" placeholder="Button Link" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Banner Image</label>
                                <input type="file" class="form-control" value="" id="welcome_image_path" name="welcome_image_path" placeholder="Banner Image" />
                                <?php if($welcome_img_link){?>
                            <img src="<?php echo base_url().$welcome_img_link ?>" alt="banner_img" class="img-fluid site_setting_img">

                            <?php }?>
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
                                <textarea id="description" name="about_description" class="form-control" placeholder="Description"><?php echo $about_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">About Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $about_button_text; ?>" id="sub_title" name="about_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">About Button Link</label>
                                <input type="text" class="form-control" value="<?php echo $about_button_link; ?>" id="sub_title" name="about_button_link" placeholder="Button Link" />
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
                                <textarea id="description" name="contact_description" class="form-control" placeholder="Description"><?php echo $contact_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Contact Button Text</label>
                                <input type="text" class="form-control" value="<?php echo $contact_button_text; ?>" id="sub_title" name="contact_button_text" placeholder="Button Text" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Contact Button Link</label>
                                <input type="text" class="form-control" value="<?php echo $contact_button_link; ?>" id="sub_title" name="contact_button_link" placeholder="Button Link" />
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
                                <textarea id="description" name="product_description" class="form-control" placeholder="Description"><?php echo $product_description; ?></textarea>
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
                                <textarea id="description" name="testominal_description" class="form-control" placeholder="Description"><?php echo $testominal_description; ?></textarea>
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
                                <textarea id="description" name="partner_description" class="form-control" placeholder="Description"><?php echo $partner_description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Partner Image</label>
                                <input type="file" class="form-control" value="" id="partner_image_path" name="partner_image_path[]" multiple placeholder="Banner Image" />
                                <?php 
                                if($partnerImageData){ ?>

                                  <?php  foreach($partnerImageData as $partner){ ?>
                                        <img src="<?php echo base_url().$partner['image_path'] ?>" alt="banner_img" class="img-fluid site_setting_img">
    
                                  <?php  } ?>
                               <?php  } ?>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</script>
<script>
    $(document).ready(function() {
        $("#settings_form").validate({
            rules: {
                title: {
                    required: true
                },
                sub_title: {
                    required: true
                },
                description: {
                    required: true
                },
                title_about: {
                    required: true
                },
                sub_title_about: {
                    required: true
                },
                description_about: {
                    required: true
                },
                contect_title: {
                    required: true
                },
                contact_description: {
                    required: true
                },
                product_title: {
                    required: true
                },
                product_description: {
                    required: true
                },
                testominal_title: {
                    required: true
                },
                testominal_description: {
                    required: true
                },
                partner_title: {
                    required: true
                },
                partner_description: {
                    required: true
                }

            },
            messages: {
                title: {
                    required: "Title is required!"
                },
                sub_title: {
                    required: "Sub Title is required!"

                },
                description: {
                    required: "Description is required!"
                },
                title_about: {
                    required: "Title is required!"
                },
                sub_title_about: {
                    required: "Sub Title is required!"

                },
                description_about: {
                    required: "Description is required!"
                },
                contect_title: {
                    required: "Title is required!"
                },
                contact_description: {
                    required: "Description is required!"
                },
                product_title: {
                    required: "Title is required!"
                },
                product_description: {
                    required: "Description is required!"
                },
                testominal_title: {
                    required: "Title is required!"
                },
                testominal_description: {
                    required: "Description is required!"
                },
                partner_title: {
                    required: "Title is required!"
                },
                partner_description: {
                    required: "Description is required!"
                }

            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>