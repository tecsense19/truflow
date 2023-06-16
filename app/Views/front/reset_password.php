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

    <?php if (isset($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
                <?= $error ?><br>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <?= form_open('reset-password/' . $token); ?>
        <div>
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <div>
            <button type="submit">Reset Password</button>
        </div>
    <?= form_close(); ?>
    </div>
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


                email: {
                    required: true,
                    email: true
                }


            },
            messages: {

                email: {
                    required: 'Email is required.',
                    email: 'Please enter a valid email address.'
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>