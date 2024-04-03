<table id="second-datatable" class="table table-bordered mt-4">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Discount Code</th>
            <th class="text-center">Percent Off</th>
            <!-- <th class="text-center">Coupon Price Type</th> -->
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($coupanlist)) {
            foreach ($coupanlist as $coupandata) {
        ?>
                <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-center"><?php echo $coupandata['coupon_code']; ?></td>
                    <td class="text-center"><?php echo $coupandata['coupon_price']; ?></td>
                    <!-- <td class="text-center"><?php echo $coupandata['coupon_price_type']; ?></td> -->
                    <td class="text-center"><a href="javascript:void(0);" class="editcoupan" data-couponid="<?php echo $coupandata['coupon_id']; ?>"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                    <a href="javascript:void(0);" class="deleteuser" onclick="deletecoupan('<?php echo $coupandata['coupon_id']; ?>')" data-couponid="<?php echo $coupandata['coupon_id']; ?>"><i class="bx bx-trash me-1"></i>Delete</a></td>
                </tr>
            <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="text-center">No coupan found.</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?= $this->include('admin/layout/footer') ?>

<script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#second-datatable').DataTable();
        });
</script>

<script>
    $(document).ready(function() {
        $('.editcoupan').click(function () {
            var coupon_id = $(this).data('couponid');
            $('.modal-title').text('Edit Coupan');
            $('.submit-button').text('Update');
            // AJAX request to fetch user data
            $.ajax({
                url: '<?php echo base_url('admin/company/coupan/edit/');?>' + coupon_id,
                type: 'GET',
                success: function (response) {
                    var coupanData = JSON.parse(response);
                    $('#coupon_id').val(coupanData.coupon_id);
                    $('#coupon_code').val(coupanData.coupon_code);
                    $('#coupon_price').val(coupanData.coupon_price);
                    $('#coupon_price_type').val(coupanData.coupon_price_type);
                    $('#from_date').val(coupanData.from_date);
                    $('#to_date').val(coupanData.to_date);
                    $('#companyCouponForm').modal('show');
                }
            });
        });

        
    });

    function closeModal() {
        $('#companyCouponForm').modal('hide');
        $('.modal').find('form')[0].reset();
    }
</script>