<?= $this->include('admin/layout/front') ?>
<?php 
$company_id = isset($companyData) ? $companyData['company_id'] : '';
$company_name = isset($companyData) ? $companyData['company_name'] : '';
$on_a_account = isset($companyData) ? $companyData['on_a_account'] : '';

?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
<style>
    div#datatable_wrapper{
        margin-top: 20px;
    }

</style>
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

                <form method="post" id="company_form" action="<?php echo base_url() ?>admin/company/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Company</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Company Name</label>
                                <input type="text" value="<?php echo $company_name;?>" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required/>
                                <input type="hidden" name="company_id" value="<?php echo $company_id;?>">
                            </div>
                            <div class="mb-3 col-md-6">
                                    <label class="form-label" for="on_a_account">Account :</label>
                                    <input data-val="true" data-val-required="Fax is required." id="on_a_account"
                                        name="on_a_account" type="checkbox" value="<?php echo $on_a_account; ?>"
                                        <?php if($on_a_account) { echo 'checked'; } ?> onchange="checkStatus(this)"/>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
            </form>
        </div>
        <div class="row mt-4">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Company User</h5>

                        <button type="button" class="btn btn-primary d-grid float-end userForm" data-toggle="modal" data-target="#form">
                            Add Company User
                        </button>

                        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title userFormTitle" id="exampleModalLabel">Create User</h5>
                                        <a  class="close" onclick="closeUserModal()" data-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form id="company_user_add">
                                            <div class="row">
                                                <div class="form-group mb-2 col-md-6">
                                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="">
                                                    <label for="firstname">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" value="" aria-describedby="emailHelp" placeholder="First Name">
                                                    <input type="hidden" name="company_name" value="<?php echo $company_name;?>">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Last Name">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="email">Country :</label>
                                                    <select name="country" id="country" data-val="true"
                                                        class="js-example-basic-single form-control" aria-label="Default select example">
                                                        <option value="">Please select any Country</option>
                                                        <?php if(isset($countryData)){ ?>
                                                        <?php foreach ($countryData as $country1) : ?>
                                                        <option value="<?php echo $country1['label'] ?>">
                                                            <?= $country1['label'] ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Date of birth :</label>
                                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="" placeholder="Email">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Street Address 1 :</label>
                                                    <input type="text" class="form-control" name="address_1" id="address_1" value="" placeholder="Street Address 1">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Street Address 2 :</label>
                                                    <input type="text" class="form-control" name="address_2" id="address_2" value="" placeholder="Street Address 2">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> City :</label>
                                                    <input type="text" class="form-control" name="city" id="city" value="" placeholder="City">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Zip/Postal code :</label>
                                                    <input type="text" class="form-control" name="zipcode" id="zipcode" value="" placeholder="Zipcode">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Phone :</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Phone">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Mobile No :</label>
                                                    <input type="text" class="form-control" name="mobile" id="mobile" value="" placeholder="Mobile">
                                                </div>
                                                <div class="form-group mb-2 col-md-6">
                                                    <label for="form-label"> Fax :</label>
                                                    <input type="text" class="form-control" name="fax" id="fax" value="" placeholder="Fax">
                                                </div>
                                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary submit-button">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    <div class="card-body userList">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Group Discount</h5>

                        <button type="button" class="btn btn-primary d-grid float-end couponForm" data-toggle="modal" data-target="#companyCouponForm">
                            Add Group Discount
                        </button>

                        <div class="modal fade" id="companyCouponForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title couponFormTitle" id="exampleModalLabel">Create Discount</h5>
                                        <a class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <form id="company_coupan_add">
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="firstname">Discount Code</label>
                                                <input type="hidden" class="form-control" name="coupon_id" id="coupon_id" value="">
                                                <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="" aria-describedby="emailHelp" placeholder="Discount Code">
                                                <input type="hidden" name="company_id" value="<?php echo $company_name;?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="last_name">Percentage Off</label>
                                                <input type="text" class="form-control" name="coupon_price" id="coupon_price" value="" placeholder="Percentage">
                                            </div>
                                            <!-- <div class="form-group mb-2">
                                                <label for="coupon_price_type">Discount Type</label>
                                                <select id="coupon_price_type" name="coupon_price_type" class="form-select required">
                                                    <option value="">Default select</option>
                                                    <option value="Flat">Flat</option>
                                                    <option value="Percentage">Percentage</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group mb-2">
                                                <label for="from_date">From Date</label>
                                                <input type="date" class="form-control" name="from_date" id="from_date" value="">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="last_name">To Date</label>
                                                <input type="date" class="form-control" name="to_date" id="to_date" value="">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary submit-button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body coupanList">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>



<script>
        // Compnay Coupan add
        // $('#company_coupan_add').submit(function(e){
        //     e.preventDefault();
        //     var formData = new FormData();
            
        //     $.ajax({
        //         url: '<?php echo base_url('admin/company/coupan/save'); ?>', // Your controller method's URL
        //         type: 'POST',
        //         data: $(this).serialize(),
        //         success: function(response){
        //             $('.modal').hide();
        //             // $('.modal').modal('hide');
        //             $('.modal-backdrop').hide();
        //             $('.modal').find('form')[0].reset();
        //             $('.modal').modal('hide');
        //             // Handle response
        //             if(response.status === 'success'){
        //                 Swal.fire({
        //                     title: 'Success',
        //                     text: response.message,
        //                     icon: 'success',
        //                     onClose: function(){
        //                         $('#popupModal').hide(); // Close the modal
        //                     }
        //                 });
        //                 companycoupanList();
        //             } else {
        //                 Swal.fire({
        //                     title: 'Error',
        //                     text: 'Error occurred while inserting data!',
        //                     icon: 'error'
        //                 });
        //             }
        //         }
        //     });
        // });

        $(document).ready(function () {

            $('#form').on('show.bs.modal', function (e) {
                $('#company_user_add')[0].reset(); // Reset the form
            });
            $('#companyCouponForm').on('show.bs.modal', function (e) {
                $('#company_coupan_add')[0].reset(); // Reset the form
            });
            $('.couponForm').on('click', function (e) {
                $('.couponFormTitle').text('Create Discount'); // Reset the form
            });
            $('.userForm').on('click', function (e) {
                $('.userFormTitle').text('Create User'); // Reset the form
            });

            $('#company_coupan_add').validate({
                rules: {
                    coupon_code: {
                        required: true
                    },
                    coupon_price: {
                        required: true
                    },
                    coupon_price_type: {
                        required: true,
                    },
                    from_date: {
                        required: true,
                    },
                    to_date: {
                        required: true,
                    },
                },
                messages: {
                    coupon_code: {
                        required: "Discount code is required!"
                    },
                    coupon_price: {
                        required: "Percentage off is required!"
                    },
                    coupon_price_type: {
                        required: "Discount type is required!",
                    },
                    from_date: {
                        required: "From Date is required!",
                    },
                    to_date: {
                        required: "To Date is required!",
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: '<?php echo base_url('admin/company/coupan/save'); ?>', // Your controller method's URL
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response){
                            $('.modal').hide();
                            // $('.modal').modal('hide');
                            $('.modal-backdrop').hide();
                            $('.modal').find('form')[0].reset();
                            $('.modal').modal('hide');
                            // Handle response
                            if(response.status === 'success'){
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    onClose: function(){
                                        $('#popupModal').hide(); // Close the modal
                                    }
                                });
                                $('#company_coupan_add')[0].reset();
                                companycoupanList();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error occurred while inserting data!',
                                    icon: 'error'
                                });
                                $('#company_coupan_add')[0].reset();
                            }
                        }
                    });
                }
            });

            $('#company_user_add').validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    first_name: {
                        required: "First Name is required!"
                    },
                    last_name: {
                        required: "Last Name is required!"
                    },
                    email: {
                        required: "Email is required!",
                        email: "Please enter a valid email address."
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: '<?php echo base_url('admin/company/user/save'); ?>',
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function (response) {
                            $('.modal').hide();
                            $('.modal-backdrop').hide();
                            $('.modal').find('form')[0].reset();
                            $('.modal').modal('hide');
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    onClose: function () {
                                        $('#popupModal').hide();
                                    }
                                });
                                $('#company_user_add')[0].reset();
                                companyuserList();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error occurred while inserting data!',
                                    icon: 'error'
                                });
                                $('#company_user_add')[0].reset();
                            }
                        }
                    });
                }
            });
        });

        
            
</script>

<script>
    $(document).ready(function() {
        $("#company_form").validate({
            rules: {
                company_name: {
                    required: true
                }


            },
            messages: {
                company_name: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });

    function checkStatus(checkbox) {
        if (checkbox.checked) {
            $('#on_a_account').val('1')
        } else {
            $('#on_a_account').val('0')
        }
    }
</script>

<script>
    $( document ).ready(function() 
    {
        companyuserList();
        companycoupanList();
    });

    // Company user list
    function companyuserList()
    {
        var company_id = <?php echo $company_id; ?>;
        $.ajax({
            type:'get',
            headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
            url: '<?php echo base_url('admin/company_user_list'); ?>',
            data: { company_id: company_id},
            success:function(data)
            {
                $('.userList').html(data);
            }
        });
    }

    // Company coupan list
    function companycoupanList()
    {
        var company_id = <?php echo $company_id; ?>;
        $.ajax({
            type:'get',
            headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
            url: '<?php echo base_url('admin/company_coupan_list'); ?>',
            data: { company_id: company_id},
            success:function(data)
            {
                $('.coupanList').html(data);
            }
        });
    }


    // delete user
    function deleteuser(user_id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this user.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#696cff',
            cancelButtonText: 'No',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
                    url:'<?php echo base_url('admin/company_user_delete'); ?>',
                    data: { user_id: user_id },
                    success:function(response)
                    {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#696cff',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                companyuserList();
                            }
                        });
                    }
                });
            }
        });
    }

    // delete Coupancode
    function deletecoupan(coupon_id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this coupon.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#696cff',
            cancelButtonText: 'No',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    headers: {'X-CSRF-TOKEN': jQuery('input[name=_token]').val()},
                    url:'<?php echo base_url('admin/company_coupan_delete'); ?>',
                    data: { coupon_id: coupon_id },
                    success:function(response)
                    {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#696cff',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                companycoupanList();
                            }
                        });
                    }
                });
            }
        });
    }
</script>