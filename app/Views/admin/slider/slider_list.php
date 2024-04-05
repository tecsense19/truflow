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
                    <h5 class="mb-0">slider List</h5>
                    <a href="<?php echo base_url() . "admin/slider" ?>"><button class="btn btn-primary d-grid float-end">Add slider</button></a>
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
                                            <th>Link</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if ($sliderData) { ?>

                                            <?php foreach ($sliderData as $slider) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php
                                                        $sliderPaths = explode(',', $slider['slider_path']);
                                                        foreach ($sliderPaths as $sliderPath) {
                                                            echo '<img src="' . base_url('public/front/images/home/' . $sliderPath) . '" alt="Slider Image" width="200" height="150" class="slider_img">';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $slider['slider_link']; ?></td>
                                                    <td>
                                                        <a class="" href="<?php echo base_url('') . "admin/slider/edit/" . $slider['slider_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="" href="<?php echo base_url('') . "admin/slider/delete/" . $slider['slider_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center"><?php echo "No Data"; ?></td>
                                            </tr>
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