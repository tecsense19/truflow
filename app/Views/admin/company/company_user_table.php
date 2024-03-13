<table id="first-datatable" class="table table-bordered mt-4">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">User Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($userlist)) {
            foreach ($userlist as $user) {
        ?>
                <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-center"><?php echo $user['full_name']; ?></td>
                    <td class="text-center"><?php echo $user['email']; ?></td>
                    <!-- <a class="" href=""><i class="bx bx-trash me-1"></i> Delete</a> -->
                    <td class="text-center"><a href="javascript:void(0);" class="edituser" data-userId="<?php echo $user['user_id']; ?>"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                    <a href="javascript:void(0);" class="deleteuser" onclick="deleteuser('<?php echo $user['user_id']; ?>')" data-userId="<?php echo $user['user_id']; ?>"><i class="bx bx-trash me-1"></i>Delete</a></td>
                </tr>
            <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="text-center">No user found.</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?= $this->include('admin/layout/footer') ?>

<script>
        $(document).ready(function() {
            $('#first-datatable').DataTable();
        });
</script>

<script>
    $(document).ready(function() {
        $('.edituser').click(function () {
            var userId = $(this).data('userid');
            $('.modal-title').text('Edit User');
            $('.submit-button').text('Update');
            // AJAX request to fetch user data
            $.ajax({
                url: '<?php echo base_url('admin/company/user/edit/');?>' + userId,
                type: 'GET',
                success: function (response) {
                    var userData = JSON.parse(response);
                    $('#user_id').val(userData.user_id);
                    $('#first_name').val(userData.first_name);
                    $('#last_name').val(userData.last_name);
                    $('#email').val(userData.email);
                    $('#country').val(userData.country);
                    $('#date_of_birth').val(userData.date_of_birth);
                    $('#address_1').val(userData.address_1);
                    $('#address_2').val(userData.address_2);
                    $('#city').val(userData.city);
                    $('#zipcode').val(userData.zipcode);
                    $('#phone').val(userData.phone);
                    $('#mobile').val(userData.mobile);
                    $('#fax').val(userData.fax);
                    $('#form').modal('show');
                }
            });
        });

        
    });

    function closeUserModal() {
        $('#form').modal('hide');
        $('.modal').find('form')[0].reset();
    }

</script>