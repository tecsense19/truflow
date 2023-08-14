
<?= $this->include('front/layout/front'); ?>

<style>
    .row_margine{
        margin-top: 122px;
    }
</style>
<body style="overflow-x: hidden;">
    

  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
  <div class="container-fluid p-md-1 row_margine">

  <div class="row no-gutters justify-content-center ">
    <div class="col-lg-9 col-md-12 pr-2">
      <img class="img-fluid" src="<?php echo base_url() ?>public/front/images/home/newlogin/1.jpg" alt="">
    </div>
    <div class="col-lg-3 col-md-8 mt-3 mt-lg-0" style="background-color: gainsboro;">
            <form id="loginForm" action="<?php echo base_url('check/login') ?>" method="POST">
            <h2 class="text-center pt-5 pb-3">Sign in</h2>
                <div class="form-group">
                    <div class="mr-2 ml-2 mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                    </div>
                </div>
                <div class="form-group">
                    <div class=" form-password-toggle mr-2 ml-2 mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                           
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>
                        
                    </div>
                </div>
                <div class="form-group ml-2">
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" />
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                    </div>
                </div>
                <div class="form-group ml-2 mr-2">
                    <div class="">
                        <button class="btn btn-primary d-grid w-100 signin_btn" type="submit">Sign in</button>
                    </div>
                </div>
                <div class="form-group ml-2 mr-2 d-flex justify-content-around">
                <a class="" href="<?php echo base_url('forgot-password') ?>">
                                <small>Forgot your password</small>
                            </a>
                            <a class="" href="<?php echo base_url('register') ?>">
                                <small>Create account</small>
                            </a>
                </div>
            </form>
      </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mt-4 pl-3">
        <img class="img-fluid" src="<?php echo base_url() ?>public/front/images/home/newlogin/2.jpg" alt="">
        </div>

        <div class="col-md-6 mt-4 pr-3">
        <img class="img-fluid" src="<?php echo base_url() ?>public/front/images/home/newlogin/3.jpg" alt="">
        </div>

    </div>
  

<?= $this->include('front/layout/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>
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