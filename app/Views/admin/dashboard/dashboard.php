<?= $this->include('admin/layout/front') ?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        
            <div class="row">
            <div class="col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                        <i class="bx bxs-user"></i>
                        </div>

                    </div>
                    <span class="fw-semibold d-block mb-1">Total Users</span>
                    <h3 class="card-title mb-2"><?php echo $userCount; ?></h3>

                </div>
            </div>
        </div>
            <div class="col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="<?php echo base_url(); ?>/public/admin/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                        </div>

                    </div>
                    <span class="fw-semibold d-block mb-1">Total Orders</span>
                    <h3 class="card-title mb-2">$<?php echo $orderCount; ?></h3>

                </div>
            </div>
        </div>
        <div class="col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="<?php echo base_url(); ?>/public/admin/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                        </div>

                    </div>
                    <span class="fw-semibold d-block mb-1">Pending Orders</span>
                    <h3 class="card-title mb-2">$<?php echo $orderPanding; ?></h3>

                </div>
            </div>
        </div>
        <div class="col-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="<?php echo base_url(); ?>/public/admin/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                        </div>

                    </div>
                    <span class="fw-semibold d-block mb-1">Complete Orders</span>
                    <h3 class="card-title mb-2">$<?php echo $orderApproved; ?></h3>

                </div>
            </div>
        </div>
            </div>
        

    </div>
    <!-- / Content -->
    <!-- Footer -->

    <!-- / Footer -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>