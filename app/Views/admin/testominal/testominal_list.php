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
                <h5 class="mb-0">Testimonial List</h5>
                <a href="<?php echo base_url()."admin/testominal"?>"><button class="btn btn-primary d-grid float-end">Add Testominal</button></a>
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
                                                    <th>Designation</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i =1 ;
                                                if($testimonalData){ ?>

                                                 <?php foreach($testimonalData as $testominal){ ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $testominal['full_name'];?></td>
                                                    <td><?php echo $testominal['designation'];?></td>
                                                    <td class="testo_descrip"><?php echo $testominal['description'];?></td>
                                                    <td>
                                                        <?php if(isset($testominal['testimo_img'])) {?>
                                                            <a data-fancybox="preview" href="<?php echo base_url('').$testominal['testimo_img']?>"><img src="<?php echo base_url('').$testominal['testimo_img']?>" alt="Image" class ="" width="100"></a>
                                                        <?php }else {?>
                                                            <?php echo "-";?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                <a class="" href="<?php echo base_url('')."admin/edit/".$testominal['testimo_id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="" href="<?php echo base_url('')."admin/delete/".$testominal['testimo_id']?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
        $("#testominal_form").validate({
            rules: {
                full_name: {
                    required: true
                }


            },
            messages: {
                full_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>