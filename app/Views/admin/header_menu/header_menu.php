<?= $this->include('admin/layout/front') ?>
<?php
$header_id = isset($headerData) ? $headerData['header_id'] : '';
$header_menu = isset($headerData) ? $headerData['header_menu'] : '';
$header_menu_link = isset($headerData) ? $headerData['menu_link'] : '';
// $header_sub_menu = isset($headerData) ? $headerData['header_sub_menu'] : '';
// $header_sub_menu_link = isset($headerData) ? $headerData['sub_menu_link'] : '';
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

                <form method="post" id="header_form" action="<?php echo base_url() ?>admin/header_menu/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Header Menu</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Menu Name</label>
                                <input type="text" value="<?php echo $header_menu; ?>" class="form-control" id="header_menu" name="header_menu" placeholder="Menu Name" />
                                <input type="hidden" name="header_id" value="<?php echo $header_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Menu Link</label>
                                <div class="input-group mb-3 link_error">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="menu_link"><?php echo base_url(''); ?></span>
                                        <!-- https://truflow.hostedwp.com.au/truflow/ -->
                                    </div>
                                    <input type="text" class="form-control" id="menu_link" name="menu_link" value="<?php echo $header_menu_link; ?>" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Name</label>
                                <input type="text" value="" class="form-control" id="header_sub_menu" name="header_sub_menu" placeholder="Sub Menu Name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Link</label>
                                <input type="text" value="" class="form-control" id="sub_menu_link" name="sub_menu_link" placeholder="Sub Menu Link" />
                            </div> -->

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
        $("#header_form").validate({
            rules: {
                header_menu: {
                    required: true
                },
                menu_link: {
                    required: true
                }
                

            },
            messages: {
                header_menu: {
                    required: "Title is required!"
                },
                menu_link: {
                    required: "Link is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>