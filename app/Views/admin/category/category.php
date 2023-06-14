<?= $this->include('admin/layout/front') ?>
<?php 
$category_id = isset($categoryData) ? $categoryData['category_id'] : '';
$category_name = isset($categoryData) ? $categoryData['category_name'] : '';
$category_description = isset($categoryData) ? $categoryData['category_description'] : '';
$category_img = isset($categoryData) ? $categoryData['category_img'] : '';
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
            <div class="mb-3">
                <label class="form-label" for="category_name">Full Name</label>
                <input type="text" value="<?php echo $category_name;?>" class="form-control" id="category_name" name="category_name" placeholder="Full Name" />
                <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="category_description">Category Description</label>
                <textarea id="category_description" name="category_description" class="form-control" placeholder="Category Description"><?php echo $category_description;?></textarea>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($category_img ? 'true' : 'false'); ?>;
        
        $("#category_form").validate({
            rules: {
                category_name: {
                    required: true
                },
                category_description: {
                    required: true
                },
                category_img: {
                    required: function() {
                        return !imageUploaded; // Validation required only if image has not been uploaded
                    }
                }
            },
            messages: {
                category_name: {
                    required: "Full Name is required!"
                },
                category_description: {
                    required: "Category Description is required!"
                },
                category_img: {
                    required: "Category Image is required!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>