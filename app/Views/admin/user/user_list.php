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
                <h5 class="mb-0">User List</h5>
                <!-- <a href="<?php echo base_url()."admin/user"?>"><button class="btn btn-primary d-grid float-end">Add User</button></a> -->
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
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i =1 ;
                                                if(isset($userData)){ ?>

                                                 <?php foreach($userData as $user){ ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $user['full_name'];?></td>
                                                    <td><?php echo $user['email'];?></td>
                                                    <td><?php echo $user['gender'];?></td>
                                                    <td>
                                                <!-- <a class="" href="<?php echo base_url('')."admin/user/edit/".$user['user_id']?>"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                                                <a class="" href="<?php echo base_url('')."admin/user/delete/".$user['user_id']?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                <!-- <a class="" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="" href="#"><i class="bx bx-trash me-1"></i> Delete</a> -->
                                                    </td>
                                                </tr>
                                                <?php $i++;?>
                                                <?php } ?>

                                               <?php }else{ ?>
                                                <tr><td colspan="4" class="text-center"><?php echo "No Data";?></td></tr>
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
