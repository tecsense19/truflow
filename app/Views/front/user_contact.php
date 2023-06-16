<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
  <div class="about_overlay">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about_heading">
            <h2>Contact Us</h2>
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
        <h4>Contact Us</h4>
      </div>
    </div>

  </div>
  <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
  <?php } ?>
  <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php } ?>

  <form method="post" id="category_form" action="<?php echo base_url() ?>contact/save" enctype='multipart/form-data'>
    
   
    <div class="form-group row">
      <label class="col-md-2 control-label" for="contact_name">Name :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Name is required." id="contact_name" name="contact_name" type="text" value="" />
      </div>
    </div>
  

    <div class="form-group row">
      <label class="col-md-2 control-label" for="email">Email :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Email is required." id="contact_email" name="contact_email" type="text" value="" />
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-2 control-label" for="last_name">Company name :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Company name is required." id="company_name" name="company_name" type="text" value="" />
      </div>
    </div>
    
    <div class="form-group row">
      <label class="col-md-2 control-label" for="mobile">Phone No :</label>
      <div class="col-md-8">
        <input class="form-control" data-val="true" data-val-required="Phone Number is required." id="contact_phone" name="contact_phone" type="text" value="" onkeypress="return isNumber(event)"/>
      </div>
    </div>
   

    <div class="form-group row">
      <label class="col-md-2 control-label" for=""></label>
      <div class="col-md-8">
        <div class="g-recaptcha" data-sitekey="your_site_key"></div>
      </div>
    </div>

    <div class="text-center mb-5">
      <input type="submit" id="register-button" class="btn btn-default submit_form" value="Register" name="register-button" />
    </div>
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
        contact_name: {
          required: true
        },

        contact_email: {
          required: true,
          email: true
        }
       
      },
      messages: {
        contact_name: {
          required: 'First name is required.'
        },
        
        contact_email: {
          required: 'Email is required.',
          email: 'Please enter a valid email address.'
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