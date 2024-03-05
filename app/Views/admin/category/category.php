<?= $this->include('admin/layout/front') ?>
<?php 
$category_id = isset($categoryData) ? $categoryData['category_id'] : '';
$category_name = isset($categoryData) ? $categoryData['category_name'] : '';
$category_description = isset($categoryData) ? $categoryData['category_description'] : '';
$category_img = isset($categoryData) ? $categoryData['category_img'] : '';
$featured_category = isset($categoryData) ? $categoryData['category_featured'] : '';
$category_sort = isset($categoryData) ? $categoryData['category_sort'] : '';
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

            <form method="post" id="category_form" action="<?php echo base_url() ?>admin/category/save" enctype='multipart/form-data'>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Category</h5>
        </div>
        <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="category_name">Category Name</label>
                <input type="text" value="<?php echo $category_name;?>" class="form-control" id="category_name" name="category_name" placeholder="Full Name" />
                <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
            </div>
        </div>

        <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Featured Category</label>
                    <div class="form-check">
                        <input class="form-check-input" name="featured_category" type="checkbox" value="<?php if($featured_category == 1){?><?php echo $featured_category ?> <?php }else{ ?>0<?php } ?> " <?php if($featured_category == 1){?> checked <?php }else{ ?> unchecked <?php } ?> id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3"></label>
                    </div>
                </div>
            </div>
        </div>

            <div class="mb-3">
                <label class="form-label" for="category_description">Category Description</label>
                <textarea id="category_description" name="category_description" class="form-control" placeholder="Category Description"><?php echo $category_description;?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category_sort">Category Sort</label>
                <input type="number" value="<?php echo $category_sort;?>" class="form-control" id="category_sort" name="category_sort" placeholder="Sort" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="category_img">Category Image</label>
                <input type="file" class="form-control" id="category_img" name="category_img" placeholder="Category Image" />
                <?php if($category_img){?>
                    <img src="<?php echo base_url().$category_img ?>" alt="category_img" class="img-fluid site_setting_img">
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
<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($category_img ? 'true' : 'false'); ?>;
        
        $("#category_form").validate({
            rules: {
                category_name: {
                    required: true
                },
                // category_description: {
                //     required: true
                // },
                // category_img: {
                //     required: function() {
                //         return !imageUploaded; // Validation required only if image has not been uploaded
                //     }
                // }
            },
            messages: {
                category_name: {
                    required: "Full Name is required!"
                },
                // category_description: {
                //     required: "Category Description is required!"
                // },
                // category_img: {
                //     required: "Category Image is required!"
                // }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('#defaultCheck3').click(function() {
                if ($("#defaultCheck3").is(":checked") == true) {
                    $('#defaultCheck3').val('1');
                } else {
                    $('#defaultCheck3').val('0');
                }
            });
    });
</script>