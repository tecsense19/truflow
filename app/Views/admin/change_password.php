<style>
    h5.mb-0 {
        color: #696CFF;
    }
</style>
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
                <form method="post" id="settings_form" action="<?php echo base_url() ?>admin/change/password/save" enctype='multipart/form-data'>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Old PAssword</label>
                                <input type="password" class="form-control" value="" id="old_password" name="old_password" placeholder="Old Password" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">New Password</label>
                                <input type="password" class="form-control" value="" id="new_password" name="new_password" placeholder="New Password" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Confirm Password</label>
                                <input type="password" class="form-control" value="" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
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
                old_password: {
                    required: true  // Old password is required
                },
                new_password: {
                    required: true, // New password is required
                },
                confirm_password: {
                    required: true, // Confirm password is required
                    equalTo: '#new_password'  // Ensure that confirm password matches new password
                }
            },
            messages: {
                old_password: {
                    required: 'Please enter your old password' // Custom error message for old password
                },
                new_password: {
                    required: 'Please enter a new password', // Custom error message for new password
                },
                confirm_password: {
                    required: 'Please confirm your new password', // Custom error message for confirm password
                    equalTo: 'Passwords do not match' // Custom error message for mismatching passwords
                }
            },
            submitHandler: function(form) {
                // Handle form submission if all fields are valid
                form.submit();
            }
        });

    });
</script>