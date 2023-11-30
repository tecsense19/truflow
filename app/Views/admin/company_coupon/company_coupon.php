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
$sub_category_id = isset($couponData) ? $couponData['sub_category_id'] : '';
$company_id = isset($couponData) ? $couponData['company_id'] : '';

$selectedCompany = $company_id ? explode(',', $company_id) : [];
// echo "<pre1>";
// print_r($couponData);
// echo "<pre>";
// print_r($productData);


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

                <form method="post" id="coupon_form" action="<?php echo base_url() ?>admin/company_coupon/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Group</h5>
                        </div>
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Coupon Code</label>
                                    <input type="text" value="<?php //echo $coupon_code; ?>" class="form-control" id="coupon_code" name="coupon_code" placeholder="code" />
                                </div>
                            </div> -->
                            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">

                            <div class="row">

                            <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Group Code</label>
                                    <input type="text" value="<?php echo $coupon_code; ?>" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="basic-default-fullname">Coupon Amount</label>
                                    <input type="text" value="<?php echo $coupon_price; ?>" class="form-control" id="coupon_price" name="coupon_price" placeholder="price / percentage" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="defaultSelect" class="form-label">Discount Type</label>
                                    <select id="coupon_price_type" name="coupon_price_type" class="form-select required" required>
                                        <option value="">Default select</option>
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
                                <label for="defaultSelect" class="form-label">Company</label>
                                <!-- <select id="company_id" name="company_id[]" class="form-select" multiple required>
                                  <option value="">Please select any company</option>
                                  <?php if (isset($companyData)) {  ?>
                                        <?php foreach ($companyData as $company1) : ?>
                                            <?php
                                                $selected = '';
                                                if (isset($companyData) && in_array($company1['company_id'], $companyData)) {
                                                    $selected = 'selected';
                                                }
                                        ?>
                                            <option value="<?php echo $company1['company_id'] ?>" <?php echo ($company_id == $company1['company_id']) ? 'selected' : ''; ?>>
                                                <?= $company1['company_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <?php }?>
                                    </select> -->
                            <div id="subcategoryDropdown">
                                <select id="sub_category_id" name="company_id[]" class="form-select" multiple required>
                                    <?php if (isset($companyData)) { ?>
                                        <?php foreach ($companyData as $subcategory) : ?>
                                            <?php
                                        
                                            $selected = '';
                                            if (isset($companyData) && in_array($subcategory['company_name'], $selectedCompany)) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?php echo $subcategory['company_name']; ?>" <?php echo $selected; ?>><?php echo $subcategory['company_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            </head>


                        </div>
                    </div>
                    <input type="hidden" name="company_coupon" value=1>
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

        $('#sub_category_id').select2({
            width: '100%'
        }); // Initialize Select2 for the "Category" dropdown
    });
</script>
<script>
    function updateForm() {
        var couponType = document.getElementById("coupon_type").value;
        var subcategoryDropdown = document.getElementById("subcategoryDropdown");

        if (couponType === "User") {
            
            subcategoryDropdown.style.display = "none";
        } else if (couponType === "Sub Category") {
            
            subcategoryDropdown.style.display = "block";
        } else {
           
            subcategoryDropdown.style.display = "none";
        }
    }

    // Call the updateForm() function initially to show the selected dropdown values
    updateForm();
</script>

<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

<script>
    $(document).ready(function() {
        $("#coupon_form").validate({
            rules: {
                coupon_code: {
                    required: true
                },
                coupon_price: {
                    required: true,
                    number: true
                },
                coupon_price_type: {
                    required: true
                },
                from_date: {
                    required: true
                },
                to_date: {
                    required: true
                },
                user_id: {
                    required: {
                        depends: function(element) {
                            return $("#coupon_type").val() === "User";
                        }
                    }
                },
                sub_category_id: {
                    required: {
                        depends: function(element) {
                            return $("#coupon_type").val() === "Category";
                        }
                    }
                }
            },
            messages: {
                coupon_code: {
                    required: "Group code is required."
                },
                coupon_price: {
                    required: "Group amount is required.",
                    number: "Please enter a valid number for the group amount."
                },
                coupon_price_type: {
                    required: "Type of discount is required."
                },
                from_date: {
                    required: "From date is required."
                },
                to_date: {
                    required: "To date is required."
                },
                user_id: {
                    required: "User is required for User type group!"
                },
                sub_category_id: {
                    required: "Category is required for Category type group!"
                }
            },
            // Submit handler...
        });
    });
</script>