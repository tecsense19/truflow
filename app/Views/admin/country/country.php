<?= $this->include('admin/layout/front') ?>
<?php 
$country_id = isset($countryData) ? $countryData['country_id'] : '';
$country_name = isset($countryData) ? $countryData['label'] : '';

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

                <form method="post" id="country_form" action="<?php echo base_url() ?>admin/country/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Country</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Country Name</label>
                                <input type="text" value="<?php echo $country_name;?>" class="form-control" id="label" name="label" placeholder="Full Name" required/>
                                <input type="hidden" name="country_id" value="<?php echo $country_id;?>">
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
        $("#country_form").validate({
            rules: {
                country_name: {
                    required: true
                }


            },
            messages: {
                country_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
