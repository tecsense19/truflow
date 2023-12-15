<style>
    h5.mb-0 {
        color: #696CFF;
    }
</style>
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
                            <h5 class="mb-0">Partner</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Partner Title</label>
                                <input type="text" value="<?php echo $partner_title; ?>" class="form-control" id="title" name="partner_title" placeholder="Title" />
                                <input type="hidden" name="partner_setting_id" value="<?php echo $partner_setting_id; ?>">
                                <input type="hidden" name="form_type" value="partner">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Partner Description</label>
                                <textarea id="editor6" name="partner_description"><?php echo $partner_description; ?></textarea>
                            </div>
                            <div class="row" id="partner-rows">
                            <?php if ($partnerImageData) { ?>
                                            <?php foreach ($partnerImageData as $partner) { ?>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="file" class="form-control" value="" id="partner_image_path" name="partner_image_path[]" multiple placeholder="Banner Image" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                <input type="text" value="<?php echo $partner['image_link']; ?>" class="form-control" id="partner_site_link" name="partner_site_link[]" placeholder="Link" />
                                <input type="hidden" value="<?php echo $partner['image_id']; ?>" class="form-control" id="partner_site_link_id" name="partner_site_link_id[]" placeholder="Link" />

                                </div>
                                <div class="col-md-4">
                                     <div class="image-container partner_img">
                                         <img src="<?php echo base_url() . $partner['image_path'] ?>" alt="banner_img" class="site_setting_img">
                                         <a class="remove-image" href="#" style="display: inline;" data-id="<?php echo $partner['image_id']; ?>">&#215;</a>

                                     </div>
                                </div>
                                <?php } ?>
                          <?php } ?>
                            </div>
                            <input type="button" id="add_partner_link_image" class="btn btn-primary d-grid" value="Add more">
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
    $(document).ready(function() {
        var imageCount = <?php echo count($partnerImageData); ?>; // Initialize the image count to the number of existing partner images

// Event handler for the "Add more" button
$('#add_partner_link_image').on('click', function() {
  // Increment the image count for each new partner image and link
  imageCount++;

  // Create HTML for the new partner image and link
  var newImageHTML =
    '<div class="col-md-4">' +
    '<div class="mb-3">' +
    '<input type="file" class="form-control" value="" id="partner_image_path' + imageCount + '" name="partner_image_path[]" multiple placeholder="Banner Image" />' +
    '</div>' +
    '</div>' +
    '<div class="col-md-4">' +
    '<input type="text" value="" class="form-control" id="partner_site_link' + imageCount + '" name="partner_site_link[]" placeholder="Link" />' +
    '</div>' +
    '<div class="col-md-4">' +
    '<div class="image-container partner_img">' +
    '<a class="remove-image_1 remove-image" style="display: block !important;width: fit-content;" id="remove-image_'+imageCount+'" href="#"  data-id="' + imageCount + '">&#215;</a>' +
    '</div>' +
    '</div>';

  // Append the new partner image and link HTML to the existing container
  $('#partner-rows').append(newImageHTML);
});
        // Remove image functionality (assuming you have this already in your code)
        $('#partner-rows').on('click', '.remove-image_1', function(event) {
    event.preventDefault();
    var imageId = $(this).data('id');
    $('#partner_image_path' + imageId).parent().parent().remove();
    $('#partner_site_link' + imageId).parent().remove();
    $('#remove-image_' + imageId).parent().parent().remove();

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
                            location.reload();
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