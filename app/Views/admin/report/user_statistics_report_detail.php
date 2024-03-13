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
                                            <th>Last Logged On</th>
                                            <th>how long were the logged on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($userData)) {
                                            foreach ($userData as $userdat) {

                                                // time calculation
                                                $last_login_time = $userdat['last_login_time'];
                                                $last_logout_time = $userdat['last_logout_time'];   
                                                
                                                $start_datetime = new DateTime($last_login_time);
                                                $end_datetime = new DateTime($last_logout_time);
                                                // Calculate the difference between the two dates
                                                $timeDisplay = '';
                                                if($last_logout_time != ''){
                                                    $interval = $start_datetime->diff($end_datetime);
    
                                                    // Get the difference in seconds
                                                    $seconds_diff = $interval->s;
    
                                                    // Get the difference in minutes
                                                    $minutes_diff = $interval->i;
    
                                                    // Get the difference in hours
                                                    $hours_diff = $interval->h;
    
                                                    // Get the difference in days
                                                    $days_diff = $interval->d;
    
                                                    // Get the difference in months
                                                    $months_diff = $interval->m;
    
                                                    // Get the difference in years
                                                    $years_diff = $interval->y;
             
                                                    
                                                    $timeDisplay .= $years_diff > 0 ? $years_diff > 1 ? $years_diff . ' Years ' : $years_diff . ' Year ' : ' ';
                                                    $timeDisplay .= $months_diff > 0 ? $months_diff > 1 ? $months_diff . ' Months ' : $months_diff . ' Month ' : ' ';
                                                    $timeDisplay .= $days_diff > 0 ? $days_diff > 1 ? $days_diff . ' Days ' : $days_diff . ' Day ' : ' ';
                                                    $timeDisplay .= $hours_diff > 0 ? $hours_diff > 1 ? $hours_diff . ' Hours ' : $hours_diff . ' Hour ' : ' ';
                                                    $timeDisplay .= $minutes_diff > 0 ? $minutes_diff > 1 ? $minutes_diff . ' Minutes ' : $minutes_diff . ' Minute ' : ' ';
                                                    $timeDisplay .= $seconds_diff > 0 ? $seconds_diff > 1 ? $seconds_diff . ' Seconds ' : $seconds_diff . ' Second ' : ' ';
                                                }else{
                                                    $timeDisplay .= 'Active';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $userdat['full_name']; ?></td>
                                                    <td><?php echo $userdat['last_login_time']; ?></td>
                                                    <td><?php echo $timeDisplay; ?></td>
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
