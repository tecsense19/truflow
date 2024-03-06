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
                    <h5 class="mb-0">Top Selling Items</h5>
                </div>
                <div class="card mb-4">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                    <div class="row">
                                        <!-- Order Status dropdown -->
                                        <div class="col-md-4 mb-4">
                                            <label class="form-label" for="order_status">User Name</label>
                                            <select name="search_username" id="search" class="form-control" aria-label="Default select example">
                                                <option value="">Please Select User</option>
                                                <?php foreach ($userData as $user) : ?>
                                                <option value="<?php echo $user['user_id']; ?>"><?php echo $user['first_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="DataList">
                                    
                                </div>
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
    $( document ).ready(function() 
    {
        profileList();
    });

    function profileList()
    {
        var search = $('#search').val();
        console.log(search);
        $.ajax({
            type:'get',
            headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
            url: '<?php echo base_url('admin/top_selling_product'); ?>',
            data: { search: search},
            success:function(data)
            {
                $('.DataList').html(data);
            }
        });
    }

    $('body').on('change', '#search', function (e) 
    {
        profileList();
    });
</script>