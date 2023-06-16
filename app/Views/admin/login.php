<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?php echo base_url(); ?>/public/admin/assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
            />
        <title>Trueflow</title>
        <meta name="description" content="" />
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/public/uploads/Truflow-Favicon.png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/vendor/fonts/boxicons.css" />
        <!-- Core CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/css/demo.css" />
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/admin/assets/vendor/css/pages/page-auth.css" />
        <!-- Helpers -->
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/js/helpers.js"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="<?php echo base_url(); ?>/public/admin/assets/js/config.js"></script>
    </head>
    <body>
        <!-- Content -->
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <a href="index.html" class="app-brand-link gap-2">
                                    <span>
                                    <img src="<?php echo base_url(); ?>/public/uploads/TruflowLogoDark.png" alt="logo" width="100px" class="img-fluid">
                                    </span>
                                    
                                </a>
                            </div>
                            <!-- /Logo -->
                            <?php if(session()->getFlashdata('error')):?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif;?>
                            <h4 class="mb-2">Welcome to Truflow-Hydarulics</h4>
                            <p class="mb-4">Please sign-in to your account</p>
                            <form id="loginForm" class="mb-3" action="<?php echo base_url() ?>admin/check/login" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <!-- <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                        <a href="auth-forgot-password-basic.html">
                                        <small>Forgot Password?</small>
                                        </a>
                                    </div> -->
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <label for="password" class="error hidden"></label>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                </div>
                            </form>
                            <!-- <p class="text-center">
                                <span>New on our platform?</span>
                                <a href="auth-register-basic.html">
                                <span>Create an account</span>
                                </a>
                            </p> -->
                        </div>
                    </div>
                    <!-- /Register -->
                </div>
            </div>
        </div>
        <!-- / Content -->
       
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/popper/popper.js"></script>
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/js/menu.js"></script>
        <!-- endbuild -->
        <!-- Vendors JS -->
        <!-- Main JS -->
        <script src="<?php echo base_url(); ?>/public/admin/assets/js/main.js"></script>
        <!-- Page JS -->
        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
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
    </body>
</html>