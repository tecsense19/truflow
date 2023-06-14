<?= $this->include('front/layout/front'); ?>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>Login</h2>
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
      <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
  <?php } ?>
  <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php } ?>
      </div>
    </div>

    </div>

    
    <div class="login_form_box">
    
    <form id="loginForm" action="<?php echo base_url('check/login') ?>" method="POST">
        <div class="form-group">
            <div class="">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class=" form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="#">
                        <small>Forgot Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </div>
        <div class="form-group">
        <div class="">
            <a href="<?php echo base_url('register')?>" class="btn btn-primary d-grid w-100">Register</a>
        </div>
        </div>
    </form>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->


<?= $this->include('front/layout/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email is required!",
                    email: "Please enter valid email address."
                },
                password: {
                    required: "Password is required!"
                }
            }
        });

        $('.alert').delay(3000).fadeOut(300);
    });
</script>