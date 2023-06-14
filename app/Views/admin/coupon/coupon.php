<?= $this->include('admin/layout/front') ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<?php
$coupon_id = isset($couponData) ? $couponData['coupon_id'] : '';
$coupon_code = isset($couponData) ? $couponData['coupon_code'] : '';
$coupon_price = isset($couponData) ? $couponData['coupon_price'] : '';
$coupon_price_type = isset($couponData) ? $couponData['coupon_price_type'] : '';
$coupon_type = isset($couponData) ? $couponData['coupon_type'] : '';
$from_date = isset($couponData) ? $couponData['from_date'] : '';
$to_date = isset($couponData) ? $couponData['to_date'] : '';
$user_id = isset($couponData) ? $couponData['user_id'] : '';
$category_id = isset($couponData) ? $couponData['category_id'] : '';



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

                <form method="post" id="coupon_form" action="<?php echo base_url() ?>admin/coupon/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">coupon</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Coupon Code</label>
                                    <input type="text" value="<?php echo $coupon_code; ?>" class="form-control" id="coupon_code" name="coupon_code" placeholder="code" />
                                    <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Coupon Amount</label>
                                    <input type="text" value="<?php echo $coupon_price; ?>" class="form-control" id="coupon_price" name="coupon_price" placeholder="price / percentage" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="defaultSelect" class="form-label">Type Of Discount</label>
                                    <select id="coupon_price_type" name="coupon_price_type" class="form-select">
                                        <option>Default select</option>
                                        <option value="Flat" <?php if ($coupon_price_type == 'Flat') echo ' selected="selected"'; ?>>Flat</option>
                                        <option value="Percentage" <?php if ($coupon_price_type == 'Percentage') echo ' selected="selected"'; ?>>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">From Date</label>
                                    <input class="form-control" type="date" value="<?php echo $from_date; ?>" id="from_date" name="from_date" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">To Date</label>
                                    <input class="form-control" type="date" value="<?php echo $to_date; ?>" id="to_date" name="to_date" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Type Of Discount</label>
                                    <select id="coupon_type" name="coupon_type" class="form-select" onchange="updateForm()">
                                        <option>Default select</option>
                                        <option value="Global" <?php if ($coupon_type == 'Global') echo ' selected="selected"'; ?>>Global</option>
                                        <option value="User" <?php if ($coupon_type == 'User') echo ' selected="selected"'; ?>>User</option>
                                        <option value="Category" <?php if ($coupon_type == 'Category') echo ' selected="selected"'; ?>>Category</option>
                                    </select>
                                </div>
                            </div>

                            <div id="userDropdown" <?php echo ($coupon_type !== 'User') ? 'style="display: none;"' : ''; ?>>
                                <select id="user_id" name="user_id[]" multiple="multiple" class="form-select user-dropdown">
                                    <?php if (isset($userdata)) { ?>
                                        <?php foreach ($userdata as $user) : ?>
                                            <?php
                                            $selected = '';
                                            if (isset($selectedUserIds) && in_array($user['user_id'], $selectedUserIds)) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?php echo $user['user_id']; ?>" <?php echo $selected; ?>><?php echo $user['full_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div id="categoryDropdown" <?php echo ($coupon_type !== 'Category') ? 'style="display: none;"' : ''; ?>>
                                <select id="category_id" name="category_id[]" class="form-select" multiple>
                                    <?php if (isset($categoryData)) { ?>
                                        <?php foreach ($categoryData as $category) : ?>
                                            <?php
                                            $selected = '';
                                            if (isset($selectedCategoryIds) && in_array($category['category_id'], $selectedCategoryIds)) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?php echo $category['category_id']; ?>" <?php echo $selected; ?>><?php echo $category['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            </head>


                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#user_id').select2({
            width: '100%' // Set the width of the user dropdown to 100%
        });

        $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function(event) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('disabled', true);
        });

        $('#category_id').select2({
            width: '100%'
        }); // Initialize Select2 for the "Category" dropdown
    });
</script>
<script>
    function updateForm() {
        var couponType = document.getElementById("coupon_type").value;
        var userDropdown = document.getElementById("userDropdown");
        var categoryDropdown = document.getElementById("categoryDropdown");

        if (couponType === "User") {
            userDropdown.style.display = "block";
            categoryDropdown.style.display = "none";
        } else if (couponType === "Category") {
            userDropdown.style.display = "none";
            categoryDropdown.style.display = "block";
        } else {
            userDropdown.style.display = "none";
            categoryDropdown.style.display = "none";
        }
    }

    // Call the updateForm() function initially to show the selected dropdown values
    updateForm();
</script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</script>
<script>
    $(document).ready(function() {
        $("#coupon_form").validate({
            rules: {
                coupon_code: {
                    required: true
                }


            },
            messages: {
                coupon_code: {
                    required: "Title is required!"
                }


            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>