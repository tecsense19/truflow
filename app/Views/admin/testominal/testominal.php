<?= $this->include('admin/layout/front') ?>
<?php 
$testimo_id = isset($testimonalData) ? $testimonalData['testimo_id'] : '';
$full_name = isset($testimonalData) ? $testimonalData['full_name'] : '';
$designation = isset($testimonalData) ? $testimonalData['designation'] : '';
$description = isset($testimonalData) ? $testimonalData['description'] : '';
$testimo_img = isset($testimonalData) ? $testimonalData['testimo_img'] : '';
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

            <form method="post" id="testominal_form" action="<?php echo base_url() ?>admin/testominal/save" enctype='multipart/form-data'>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Testimonial</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Full Name</label>
                <input type="text" value="<?php echo $full_name;?>" class="form-control" id="full_name" name="full_name" placeholder="Full Name" />
                <input type="hidden" name="testimo_id" value="<?php echo $testimo_id;?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Designation</label>
                <input type="text" class="form-control" value="<?php echo $designation;?>" id="designation" name="designation" placeholder="Designation" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-default-message">Description</label>
                <textarea id="editor9" name="description"><?php echo $description;?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Testimonial Image</label>
                <input type="file" class="form-control" value="" id="testimo_img" name="testimo_img" placeholder="Testimonial Image" />
                <?php if($testimo_img){?>
                    <img src="<?php echo base_url().$testimo_img ?>" alt="testimo_img" class="img-fluid site_setting_img">
                <?php }?>
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
</script>
<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($testimo_img ? 'true' : 'false'); ?>;
        
        $("#testominal_form").validate({
            rules: {
                full_name: {
                    required: true
                },
                designation: {
                    required: true
                },
                description: {
                    required: true
                },
                testimo_img: {
                    required: function() {
                        return !imageUploaded; // Validation required only if image has not been uploaded
                    }
                }
            },
            messages: {
                full_name: {
                    required: "Full Name is required!"
                },
                designation: {
                    required: "Designation is required!"
                },
                description: {
                    required: "Description is required!"
                },
                testimo_img: {
                    required: "Testimonial Image is required!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>