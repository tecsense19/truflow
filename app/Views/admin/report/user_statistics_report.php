<?= $this->include('admin/layout/front') ?>
<?php 

$selectedUser1 = isset($selectedUser) ? $selectedUser : '';
$selectedDate1 = isset($selectedDate) ? $selectedDate : '';
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

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">User Statistics Report</h5>
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
                                            <th>UserName</th>
                                            <th>Action</th>
                                            <!-- <th>Last Logged On</th>
                                            <th>how long were the logged on</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($userData)) {
                                            foreach ($userData as $userdat) {
                                                // if($userdat['last_login_time']){
                                                //     $date_time = date('d-m-Y H:i:s', strtotime($userdat['last_login_time']));
                                                // }else{
                                                //     $date_time = '-';
                                                // }

                                                // // time calculation
                                                // $last_login_time = $userdat['last_login_time'];
                                                // $last_logout_time = $userdat['last_logout_time'];

                                                // // Convert login and logout times to DateTime objects
                                                // $login_time = new \DateTime($last_login_time);
                                                // $logout_time = new \DateTime($last_logout_time);

                                                // // Calculate the difference between login and logout times
                                                // $time_diff = $login_time->diff($logout_time);

                                                // $total_minutes = $time_diff->h * 60 + $time_diff->i;
                                                // $hours = floor($total_minutes / 60);
                                                // $minutes = $total_minutes % 60;
                                                // if ($total_minutes >= 60) {
                                                //     $minutes = $hours. ' hours';
                                                // } else {
                                                //     $minutes = $total_minutes. ' Minute';
                                                // }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $userdat['full_name']; ?></td>
                                                    <td><a href="<?php echo base_url('')."admin/user_statistics_report_detail/".$userdat['user_id']?>">View Report</a></td>
                                                    <!--  -->
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No data found.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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
<script>
$(document).ready(function() {
    $('.export').click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('user_id', $('#user_id').val());
        formData.append('order_date', $('#order_date').val());
        $.ajax({
            url: '<?php echo base_url('admin/user_export'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var url = URL.createObjectURL(response);
                var link = document.createElement('a');
                link.href = url;
                link.download = 'User_data.csv';
                link.click();
                URL.revokeObjectURL(url);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>
