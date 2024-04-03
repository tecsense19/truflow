<?= $this->include('admin/layout/front') ?>
<?php 
$slider_id = isset($sliderData) ? $sliderData['slider_id'] : '';
$slider_path = isset($sliderData) ? $sliderData['slider_path'] ? base_url() . 'public/front/images/home/' .$sliderData['slider_path'] : '' : '';
$slider_link = isset($sliderData) ? $sliderData['slider_link'] : '';

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

                <form method="post" id="slider_form" action="<?php echo base_url() ?>admin/slider/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Slider</h5>
                        </div>
                        <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Slider Name</label>
                            <input type="file" class="form-control" id="slider_path" name="slider_path[]" placeholder="Upload Images" multiple <?php if(!$slider_id) { ?> required <?php } ?> />
                            <input type="hidden" name="slider_id" value="<?php echo $slider_id;?>">
                            <?php if(isset($slider_id) && $slider_id) { ?>
                                <img src="<?php echo $slider_path;?>" style="height: 100px; width: 100px;" />
                            <?php } ?>
                        </div>
                        <div class="mb-3" style="display: none;">
                            <label class="form-label" for="basic-default-fullname">Slide URL</label>
                            <input type="text" class="form-control" id="slider_link" name="slider_link" value="<?php echo $slider_link;?>" placeholder="Slide URL" multiple/>
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
        $("#slider_form").validate({
            rules: {
                slider_name: {
                    required: true
                }


            },
            messages: {
                slider_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
