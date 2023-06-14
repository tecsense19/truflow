<?= $this->include('admin/layout/front') ?>
<?php
$product_id = isset($productData) ? $productData['product_id'] : '';
$category_id = isset($productData) ? $productData['category_id'] : '';
$sub_category_id = isset($productData) ? $productData['sub_category_id'] : '';
$product_name = isset($productData) ? $productData['product_name'] : '';
$product_description = isset($productData) ? $productData['product_description'] : '';
// $product_price = isset($productData) ? $productData['product_price'] : '';
$product_img = isset($productData) ? $productData['product_img'] : '';
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

                <form method="post" id="product_form" action="<?php echo base_url() ?>admin/product/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Category</label>
                                <select id="category-select" name="category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Please select a category</option>
                                    <?php foreach ($categoryData as $category) : ?>
                                        <?php if ($category['category_id'] == $category_id) : ?>
                                            <option value="<?= $category['category_id'] ?>" selected="selected"><?= $category['category_name'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subcategory dropdown -->
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Subcategory</label>
                                <select id="subcategory-select" name="sub_category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Please select a subcategory</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Product Name</label>
                                <input type="text" value="<?php echo $product_name; ?>" class="form-control" id="product_name" name="product_name" placeholder="Product Name" />
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product Description</label>
                                <textarea id="product_description" name="product_description" class="form-control" placeholder="Product Description"><?php echo $product_description; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Product Image</label>
                                <input type="file" class="form-control" value="" id="product_img" name="product_img" placeholder="Product Image" />
                                <?php if ($product_img) { ?>
                                    <img src="<?php echo base_url() . $product_img ?>" alt="product_img" class="img-fluid site_setting_img">
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- add variant -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Variant</h5>
                        </div>
                        <div class="card-body">
                            <button id="add-btn" class="btn btn-primary">Add Variant</button>
                            <div id="input-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Variant Name</th>
                                            <th>Variant Price</th>
                                            <th>Part Number</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($variantData)) {
                                            foreach ($variantData as $variant) {
                                        ?>
                                                <tr>
                                                    <td><input type="text" name="variant_name[]" class="form-control" value="<?php echo $variant['variant_name']; ?>" placeholder="Variant Name" /></td>
                                                    <input type="hidden" name="variant_id[]" class="form-control" value="<?php echo $variant['variant_id']; ?>" />
                                                    <td><input type="text" name="variant_price[]" class="form-control" value="<?php echo $variant['variant_price']; ?>" placeholder="Variant Price" /></td>
                                                    <td><input type="text" name="variant_sku[]" class="form-control" value="<?php echo $variant['variant_sku']; ?>" placeholder="Part Number" /></td>
                                                    <td><a class="btn btn-danger" href="<?php echo base_url('') . "admin/variant/delete/" . $variant['variant_id'] ?>">Remove</a></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($product_img ? 'true' : 'false'); ?>;

        $("#product_form").validate({
            rules: {
                category_id: {
                    required: true
                },
                sub_category_id: {
                    required: true
                },
                product_name: {
                    required: true
                },
                product_description: {
                    required: true
                },
                product_img: {
                    required: function() {
                        return !imageUploaded; // Validation required only if image has not been uploaded
                    }
                },
                "variant_name[]": {
                    required: true
                },
                "variant_price[]": {
                    required: true
                },
                "variant_sku[]": {
                    required: true
                }
            },
            messages: {
                category_id: {
                    required: "Category is required!"
                },
                sub_category_id: {
                    required: "Subcategory is required!"
                },
                product_name: {
                    required: "Product Name is required!"
                },
                product_description: {
                    required: "Product Description is required!"
                },
                product_img: {
                    required: "Product Image is required!"
                },
                "variant_name[]": {
                    required: "Variant Name is required!"
                },
                "variant_price[]": {
                    required: "Variant Price is required!"
                },
                "variant_sku[]": {
                    required: "Part Number is required!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        var catId = '<?php echo $category_id; ?>';
        cateChange(catId)
        // Load subcategories when category is selected
        $('#category-select').change(function() {
            var category_id = $(this).val();
            cateChange(category_id)
        });
    });

    function cateChange(catId) {
        if (catId) {
            $.ajax({
                url: '<?php echo base_url() ?>admin/get_subcategories/' + catId,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    // Clear previous options
                    $('#subcategory-select').html('<option value="">Please select a subcategory</option>');

                    // Add new options
                    $.each(data, function(key, value) {

                        console.log(value);
                        var subCatId = '<?php echo $sub_category_id; ?>';
                        var option = '<option value="' + value.sub_category_id + '"';
                        if (value.sub_category_id == subCatId) {
                            option += ' selected';
                        }
                        option += '>' + value.sub_category_name + '</option>';
                        $('#subcategory-select').append(option);
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        } else {
            $('#subcategory-select').html('<option value="">Please select a subcategory</option>');
        }
    }
</script>

<script>
    $(document).ready(function() {
        // Add field
        $('#add-btn').click(function(e) {
            event.preventDefault();
            $('#input-container').show();

            var variantSkuValues = []; // Array to store variant SKU values

            // Retrieve existing variant SKU values
            $('.input-row').each(function() {
                var skuValue = $(this).find('input[name="variant_sku[]"]').val();
                variantSkuValues.push(skuValue);
            });

            var inputRow = $('<tr class="input-row"></tr>');
            var variant_name = $('<td><input type="text" name="variant_name[]" class="form-control" placeholder="Variant Name" /></td>');
            var variant_price = $('<td><input type="text" name="variant_price[]" class="form-control" placeholder="Variant Price" /></td>');
            var variant_sku = $('<td><input type="text" name="variant_sku[]" class="form-control" placeholder="Part Number" /></td>');
            var removeButton = $('<td><button class="btn btn-danger remove-btn">Remove</button></td>');

            // Validate variant SKU value
            variant_sku.find('input').blur(function() {
                var newSkuValue = $(this).val();
                if (variantSkuValues.includes(newSkuValue)) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').remove();
                    $(this).after('<div class="invalid-feedback">Part Number must be unique.Do not enter Duplicate value.</div>');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').remove();
                }
            });

            // Validate variant price value
            variant_price.find('input').blur(function() {
                var priceValue = $(this).val();
                if (!$.isNumeric(priceValue)) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').remove();
                    $(this).after('<div class="invalid-feedback">Variant Price must be a numeric value.</div>');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').remove();
                }
            });

            inputRow.append(variant_name);
            inputRow.append(variant_price);
            inputRow.append(variant_sku);
            inputRow.append(removeButton);
            $('#input-container tbody').append(inputRow);

            // Update variantSkuValues array with the new SKU value
            variantSkuValues.push('');
        });

        // Remove field
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.input-row').remove();
        });
    });
</script>