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
                
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Category List</h5>
                <a href="<?php echo base_url()."admin/category"?>"><button class="btn btn-primary d-grid float-end">Add Category</button></a>
                </div>
                    <div class="card mb-4">
                            <div class="card">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table id="datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i =1 ;
                                                if($categoryData){ ?>

                                                 <?php foreach($categoryData as $category){ ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $category['category_name'];?></td>
                                                    <td class="testo_descrip"><?php echo $category['category_description'];?></td>
                                                    <td>
                                                        <?php if(isset($category['category_img'])) {?>
                                                            <a data-fancybox="preview" href="<?php echo base_url('').$category['category_img']?>"><img src="<?php echo base_url('').$category['category_img']?>" alt="Image" class ="" width="100"></a>
                                                        <?php }else {?>
                                                            <?php echo "-";?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                <a class="" href="<?php echo base_url('')."admin/category/edit/".$category['category_id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="" href="<?php echo base_url('')."admin/category/delete/".$category['category_id']?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $i++;?>
                                                <?php } ?>

                                               <?php }else{ ?>
                                                <tr><td colspan="6" class="text-center"><?php echo "No Data";?></td></tr>
                                                <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- <input type="submit" class="btn btn-primary d-grid"> -->
                </form>
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
        $("#category_form").validate({
            rules: {
                category_name: {
                    required: true
                }


            },
            messages: {
                category_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>