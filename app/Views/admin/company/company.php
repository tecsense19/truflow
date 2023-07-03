<?= $this->include('admin/layout/front') ?>
<?php 
$company_id = isset($companyData) ? $companyData['company_id'] : '';
$company_name = isset($companyData) ? $companyData['company_name'] : '';

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

                <form method="post" id="company_form" action="<?php echo base_url() ?>admin/company/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">company</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Company Name</label>
                                <input type="text" value="<?php echo $company_name;?>" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required/>
                                <input type="hidden" name="company_id" value="<?php echo $company_id;?>">
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
        $("#company_form").validate({
            rules: {
                company_name: {
                    required: true
                }


            },
            messages: {
                company_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>