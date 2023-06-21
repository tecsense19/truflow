<?= $this->include('front/layout/front'); ?>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>Forgot Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START <<~~~~~~~~~~~~~~~-->
<div class="container">

    <div class="login_form_box">
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('reset_password/' . $token) ?>" method="post">
        
        

        <div class="form-group">
            <div class="">
                <label for="email" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
                
            </div>
        </div>
        <div class="form-group">
            <div class="">
            <label for="email" class="form-label">Confirm New Password</label>
             <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
                
            </div>
        </div>
        


        <button type="submit" class="btn btn-primary d-grid w-100 signin_btn">Reset Password</button>
    </form>
    </div>
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


                password: {
                    required: true
                    
                },
                confirm_password: {
                    required: true
                    
                }


            },
            messages: {

                password: {
                    required: 'Password is required.'
                   
                },
                confirm_password: {
                    required: 'Password is required.'
                   
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>