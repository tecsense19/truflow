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

  <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
  <?php } ?>
  <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php } ?>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="get-in-touch pr-50">
            <h3>Get in touch</h3>
            <p>Truflow Hydraulic Components Pty Ltd</p>
            <h3> 29 Dowd Street,Perth, Australia 6106.</h3>
            <ul class="contact-detail">
            <a href="tel:+61894512204">
              <li><i class="fa-solid fa-phone"></i> (+61) 08 9451 2204</li>
            </a>
           
              <li><i class="fa-regular fa-clock"></i> Monday – Friday 8:00 to 19:00</li>
              <a href="mailto: sales@truflowhydraulic.com.au">
              <li><i class="fa-regular fa-life-ring"></i> sales@truflowhydraulic.com.au</li>
              </a>
             
            </ul>
            <ul class="social_media">
              <li><a href="#!"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#!"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#!"><i class="fa-brands fa-youtube"></i></a></li>
             
            </ul>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="get-in-touch">
            <h3>Drop us a line:</h3>
            <form method="post" id="category_form" action="<?php echo base_url() ?>contact/save" enctype='multipart/form-data'>
              <div class="row">
                <div class="col-lg-6">
                  <div class="contact-form">
                    <label>Your Name*</label>
                    <input type="text" name="contact_name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="contact-form">
                    <label>Your Email*</label>
                    <input type="text" name="contact_email">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="contact-form">
                    <label>Company name*</label>
                    <input type="text" name="company_name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="contact-form">
                    <label>Phone No*</label>
                    <input type="text" id="contact_phone" name="contact_phone" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="contact-form">
                  <label>Your Message</label>
                  <textarea type="message" name="message" rows="5" cols="6" required></textarea>
                </div>
              </div>

              </div>
              <div class="col-lg-12">
                <div class="contact-form">
                  <button type="submit">Submit</button>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
</div>
</section>
<section id="map_section">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.988746659039!2d115.94960397570115!3d-31.988320524132856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32beb9aef86aa7%3A0x8e39a15961210411!2sTruflow%20Hydraulic%20Components%20Pty%20Ltd!5e0!3m2!1sen!2sin!4v1688376535045!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
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
        message:{
          required: true
        },
        company_name:{
          required: true
        },
        contact_phone:{
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
        message: {
          required: 'Message is required.'
        },
        company_name: {
          required: 'Componey Name is required.'
        },
        contact_phone: {
          required: 'Phone No is required.'
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