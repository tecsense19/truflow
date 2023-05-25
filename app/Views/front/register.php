<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>Registration</h2>
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
                <h4>Your Personal Details</h4>
            </div>
        </div>

    </div>
    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
    <?php } ?>
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php } ?>

    <form method="post" id="category_form" action="<?php echo base_url() ?>register/save" enctype='multipart/form-data'>
        <div class="form-group row">
            <label class="col-md-2 control-label">Gender :</label>
            <div class="col-md-9">
                <input id="gender-male" name="gender" type="radio" value="male" />
                <label class="col-md-2 control-label" for="gender-male">Male</label>
                <input id="gender-female" name="gender" type="radio" value="female" />
                <label class="col-md-2 control-label" for="gender-female">Female</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="first_name">First Name :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="First name is required." id="first_name" name="first_name" type="text" value="" />
            </div>


        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="last_name">Last Name :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="Last name is required." id="last_name" name="last_name" type="text" value="" />
            </div>


        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label">Date of birth :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="" id="date_of_birth" name="date_of_birth" type="date" value="" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 control-label" for="email">Email :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="Email is required." id="email" name="email" type="text" value="" />
            </div>


        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="mobile">Mobile No :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="Mobile Number is required." id="mobile" name="mobile" type="text" value="" />
            </div>

        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="password">Password :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="password Number is required." id="password" name="password" type="password" value="" />
            </div>

        </div>
        <div class="form-group row">
            <label class="col-md-2 control-label" for="password">Confirm Password :</label>
            <div class="col-md-8">
                <input class="form-control" data-val="true" data-val-required="password Number is required." id="c_password" name="c_password" type="password" value="" />
            </div>

        </div>

        <div class="text-center mb-5">
        <input class="form-control" data-val="true"  id="user_role" name="user_role" type="hidden" value="user" />
            <input type="submit" id="register-button" class="btn btn-default" value="Register" name="register-button" />
        </div>
    </form>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->


<?= $this->include('front/layout/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

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
      date_of_birth: {
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
      }
    },
    messages: {
      first_name: {
        required: 'First name is required.'
      },
      last_name: {
        required: 'Last name is required.'
      },
      date_of_birth: {
        required: 'Date of birth is required.'
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
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>

