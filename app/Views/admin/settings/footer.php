<style>
    h5.mb-0 {
        color: #696CFF;
    }
</style>
<?php
$footer_setting_id = isset($footerData) ? $footerData['id'] : '';
$facebook_url = isset($footerData) ? $footerData['facebook_url'] : '';
$instagram_url = isset($footerData) ? $footerData['instagram_url'] : '';
$linkedin_url = isset($footerData) ? $footerData['linkedin_url'] : '';
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
                <form method="post" id="settings_form" action="<?php echo base_url() ?>admin/footer/settings/save" enctype='multipart/form-data'>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Footer</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Facebook URL</label>
                                <input type="text" class="form-control" value="<?php echo $facebook_url; ?>" id="facebook_url" name="facebook_url" placeholder="Sub Title" />
                                <input type="hidden" class="form-control" value="<?php echo $footer_setting_id; ?>" id="footer_setting_id" name="footer_setting_id" placeholder="Sub Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Instagram URL</label>
                                <input type="text" class="form-control" value="<?php echo $instagram_url; ?>" id="instagram_url" name="instagram_url" placeholder="Sub Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">LinkedIn URL</label>
                                <input type="text" class="form-control" value="<?php echo $linkedin_url; ?>" id="linkedin_url" name="linkedin_url" placeholder="Sub Title" />
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
        
    });
</script>