<?php


$siteid = isset($settings_data) ? $settings_data['siteid'] : '';
 $title = isset($settings_data) ? $settings_data['title'] : '';
 $sub_title = isset($settings_data) ? $settings_data['sub_title'] : '';
 //$discription = isset($settings_data) ? $settings_data['discription'] : '';
//  echo "<pre>";
//  print_r($siteid);
// die();

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
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Settings</h5>
                        <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                        <form method="post" id="settings_form" action="<?php echo base_url() ?>admin/settings_add_edit" enctype='multipart/form-data'>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Title</label>
                                <input type="text" value="<?php echo $title; ?>" class="form-control" id="title" name="title" placeholder="Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Sub Title</label>
                                <input type="text" class="form-control" value="<?php echo $sub_title; ?>" id="sub_title" name="sub_title" placeholder="Sub Title" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Description</label>
                        
                                <?php if(isset($settings_data)){ ?>
                                 
                                   <textarea id="description" name="description" class="form-control" placeholder="Description"><?php echo $settings_data['description'] ?></textarea>
                                    <?php }else{ ?>
                                        <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                                       
                               <?php } ?> 
                                
                            </div>
                            <!-- <button class="btn btn-primary d-grid" type="submit">Submit</button> -->
                            <input type="hidden" name="siteid" id="siteid" value="<?php echo $siteid; ?>">
                            <input type="submit" class="btn btn-primary d-grid">


                        </form>
                    </div>
                </div>
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
                    required: "Password is required!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>