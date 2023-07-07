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
                <h5 class="mb-0">Order Report</h5>
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
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $i =1 ;
                                                if(isset($cartData)){ ?>

                                                 <?php foreach($cartData as $order1){ ?>
                                                    <?php foreach($order1['product_item'] as $order){ ?>

                                                    
                                                            <tr>
                                                            <td><?php echo $i;?></td>
                                                                <td><?php echo $order['full_name']; ?></td>
                                                                <td></td>
                                                                
                                                            </tr>

                                                    <?php }?>
                                                    <?php }?>
                                                    <?php }?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                 
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
