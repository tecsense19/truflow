<?= $this->include('front/layout/front'); ?>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>User Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START <<~~~~~~~~~~~~~~~-->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <div class="form-group mt-5 mb-5">
        <h4>User Profile</h4>
      </div>
    </div>

  </div>
  <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
  <?php } ?>
  <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php } ?>

  <form method="post" id="category_form" action="<?php echo base_url('edit_user_profile')?>" enctype='multipart/form-data'>
   <?php if(isset($userData)){ ?>
    <h4>Your Personal Details</h4>
    <hr>
    <div class="form-group row">
                <label class="col-md-2 control-label">Gender :</label>
                <div class="col-md-9">
                    <input id="gender-male" name="gender" type="radio" value="male" <?php if ($userData['gender'] === 'male') {
                                                                                            echo 'checked';
                                                                                        } ?> />
                    <label class="col-md-2 control-label" for="gender-male">Male</label>
                    <input id="gender-female" name="gender" type="radio" value="female" <?php if ($userData['gender'] === 'female') {
                                                                                                echo 'checked';
                                                                                            } ?> />
                    <label class="col-md-2 control-label" for="gender-female">Female</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 control-label" for="first_name">First Name :</label>
                <div class="col-md-8">
                    <input class="form-control" data-val="true" data-val-required="First name is required." id="first_name" name="first_name" type="text" value="<?= $userData['first_name'] ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 control-label" for="last_name">Last Name :</label>
                <div class="col-md-8">
                    <input class="form-control" data-val="true" data-val-required="Last name is required." id="last_name" name="last_name" type="text" value="<?= $userData['last_name'] ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 control-label">Date of birth :</label>
                <div class="col-md-8">
                    <input class="form-control" data-val="true" data-val-required="" id="date_of_birth" name="date_of_birth" type="date" value="<?= $userData['date_of_birth'] ?>" />
                </div>
            </div>

    <div class="form-group row">
      <label class="col-md-2 control-label" for="email">Email :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Email is required." id="email" name="email" type="text" value="<?= $userData['email'] ?>" />
      </div>
    </div>

    <h4>Company Details</h4>
    <hr>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="last_name">Company name :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Company name is required." id="company_name" name="company_name" type="text" value="<?= $userData['company_name'] ?>" />
      </div>
    </div>
    <h4>Your Billing Address</h4>
    <hr>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="address 1">Street Address 1 :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Street Address 1 is required." id="address_1" name="address_1" type="text" value="<?= $userData['address_1'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="address 2">Street Address 2 :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Street Address 2 is required." id="address_2" name="address_2" type="text" value="<?= $userData['address_2'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="last_name">City :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="City is required." id="city" name="city" type="text" value="<?= $userData['city'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="last_name">Zip/Postal code :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Zip/Postal code required." id="zipcode" name="zipcode" type="text" value="<?= $userData['zipcode'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="last_name">Country :</label>
      <div class="col-md-8">
      <select name="country" id="country" class="form-control" aria-label="Default select example">
            <option value="">Please select any Country</option>
            <?php foreach ($countryData as $country) : ?>
                <option value="<?php echo $country['label'] ?>" <?php echo ($userData['country'] == $country['label']) ? 'selected' : ''; ?>>
                    <?= $country['label'] ?>
                </option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
    <h4>Your Contact Information</h4>
    <hr>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="Phone">Phone :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="phone is required." id="phone" name="phone" type="text" value="<?= $userData['phone'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="mobile">Mobile No :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Mobile Number is required." id="mobile" name="mobile" type="text" value="<?= $userData['mobile'] ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 control-label" for="Fax">Fax :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Fax is required." id="fax" name="fax" type="text" value="<?= $userData['fax'] ?>" />
      </div>
    </div>
    

    <div class="form-group row">
      <label class="col-md-2 control-label" for=""></label>
      <div class="col-md-8">
        <div class="g-recaptcha" data-sitekey="your_site_key"></div>
      </div>
    </div>

    <div class="text-center mb-5">
    <input type="hidden" name="user_id" value="<?php echo $userData['user_id'];?>">
      <input class="form-control" data-val="true" id="user_role" name="user_role" type="hidden" value="user" />
      <input type="submit" id="register-button" class="btn btn-default" value="Update Profile" name="register-button" />
    </div>
    <?php }?>
  </form>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->


<?= $this->include('front/layout/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

<script>
  $(document).ready(function() {
    $('#category_form').validate({
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
        }
        
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>