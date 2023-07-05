<?= $this->include('admin/layout/front') ?>
<?php
// echo "<pre>";
// print_r($userData);
// die();

$user_id = isset($userData) ? $userData['user_id'] : '';
$first_name = isset($userData) ? $userData['first_name'] : '';
$last_name = isset($userData) ? $userData['last_name'] : '';
$date_of_birth = isset($userData) ? $userData['date_of_birth'] : '';
$mobile = isset($userData) ? $userData['mobile'] : '';
$email = isset($userData) ? $userData['email'] : '';
$company_name = isset($userData) ? $userData['company_name'] : '';
$address_1 = isset($userData) ? $userData['address_1'] : '';
$address_2 = isset($userData) ? $userData['address_2'] : '';
$city = isset($userData) ? $userData['city'] : '';
$zipcode = isset($userData) ? $userData['zipcode'] : '';
$country = isset($userData) ? $userData['country'] : '';
$phone = isset($userData) ? $userData['phone'] : '';
$fax = isset($userData) ? $userData['fax'] : '';
$password = isset($userData) ? $userData['password'] : '';
// print_r($country);
// die();
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

                <form method="post" id="user_form" action="<?php echo base_url() ?>admin/user/save" enctype='multipart/form-data'>
                    
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">user</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="first_name">First Name :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="First name is required." id="first_name" name="first_name" type="text" value="<?php echo $first_name; ?>" />
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="last_name">Last Name :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Last name is required." id="last_name" name="last_name" type="text" value="<?php echo $last_name; ?>" />
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Date of birth :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="" id="date_of_birth" name="date_of_birth" type="date" value="<?php echo $date_of_birth; ?>" />
                                
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="email">Email :</label>
                                <?php if(empty($email)){?>
                                    <input class="form-control" data-val="true" data-val-required="Email is required." id="email" name="email" type="text" value="" />
                                    <?php }else{?>
                                        
                                    <input class="form-control" data-val="true" readonly id="email" name="email" type="text" value="<?php echo $email; ?>" />
                                    <?php }?>
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="last_name">Company name :</label>
                                    <select name="company_name" id="company_name" data-val="true" data-val-required="Company name is required." class="form-control" aria-label="Default select example">
                                  <option value="">Please select any company</option>
                                  <?php if(isset($companyData)){?>
                                        <?php foreach ($companyData as $company1) : ?>
                                            <option value="<?php echo $company1['company_name'] ?>" <?php echo ($company_name == $company1['company_name']) ? 'selected' : ''; ?>>
                                                <?= $company1['company_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                       <?php }?> 
                                    </select>
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="last_name">Country :</label>
                                
                                    <select name="country" id="country" class="form-control" aria-label="Default select example">
                                  <option value="">Please select any Country</option>
                                  <?php if(isset($countryData)){?>
                                        <?php foreach ($countryData as $country1) : ?>
                                            <option value="<?php echo $country1['label'] ?>" <?php echo ($country == $country1['label']) ? 'selected' : ''; ?>>
                                                <?= $country1['label'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <?php }?> 
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address 1">Street Address 1 :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Street Address 1 is required." id="address_1" name="address_1" type="text" value="<?php echo $address_1; ?>" />
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address 2">Street Address 2 :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Street Address 2 is required." id="address_2" name="address_2" type="text" value="<?php echo $address_2; ?>" />
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="last_name">City :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="City is required." id="city" name="city" type="text" value="<?php echo $city; ?>" />
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="last_name">Zip/Postal code :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Zip/Postal code required." id="zipcode" name="zipcode" type="text" value="<?php echo $zipcode; ?>" />
                                
                            </div>
                            </div>
                            <div class="row">
                            
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="Phone">Phone :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="phone is required." id="phone" name="phone" type="text" value="<?php echo $phone; ?>" />
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="mobile">Mobile No :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Mobile Number is required." id="mobile" name="mobile" type="text" value="<?php echo $mobile; ?>" />
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="Fax">Fax :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="Fax is required." id="fax" name="fax" type="text" value="<?php echo $fax; ?>" />
                                
                            </div>
                            </div>
                            <?php if(empty($password)){ ?>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="password">Password :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="password Number is required." id="password" name="password" type="password" value="" />
                                

                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="password">Confirm Password :</label>
                                
                                    <input class="form-control" data-val="true" data-val-required="password Number is required." id="c_password" name="c_password" type="password" value="" />
                                
                            </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <input class="form-control" data-val="true" id="user_role" name="user_role" type="hidden" value="user" />
                    <input class="form-control" data-val="true" id="user_id" name="user_id" type="hidden" value="<?php echo $user_id; ?>" />
                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

<script>
  $(document).ready(function() {
    $('#user_form').validate({
      rules: {
        first_name: {
          required: true
        },
        last_name: {
          required: true
        },
        address_1: {
          required: true
        },
        city: {
          required: true
        },
        zipcode: {
          required: true
        },

        email: {
          required: true,
          email: true
        },
        mobile: {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10
        },
        password: {
          required: true
        },
        c_password: {
          required: true,
          equalTo: '#password'
        },
        company_name:{
          required: true
        },
        country:{
          required: true
        }
      },
      messages: {
        first_name: {
          required: 'First name is required.'
        },
        last_name: {
          required: 'Last name is required.'
        },
        address_1: {
          required: 'Address 1 is required.'
        },
        city: {
          required: 'City is required.'
        },
        zipcode: {
          required: 'Zipcode is required.'
        },

        email: {
          required: 'Email is required.',
          email: 'Please enter a valid email address.'
        },
        mobile: {
          required: 'Mobile number is required.',
          digits: 'Please enter only digits.',
          minlength: 'Mobile number must be 10 digits long.',
          maxlength: 'Mobile number must be 10 digits long.'
        },
        password: {
          required: 'Password is required.'
        },
        c_password: {
          required: 'Confirm password is required.',
          equalTo: 'Passwords do not match.'
        },
        company_name:{
          required: 'Please select a company'
        },
        country:{
          required: 'Please select a country'
        }
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>