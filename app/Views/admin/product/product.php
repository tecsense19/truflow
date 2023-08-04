<?= $this->include('admin/layout/front') ?>
<style>
/* The container */
.container_featured {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container_featured input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container_featured:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container_featured input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container_featured input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container_featured .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<?php
$product_id = isset($productData) ? $productData['product_id'] : '';
$category_id = isset($productData) ? $productData['category_id'] : '';
$sub_category_id = isset($productData) ? $productData['sub_category_id'] : '';
$product_name = isset($productData) ? $productData['product_name'] : '';
$product_description = isset($productData) ? $productData['product_description'] : '';
$product_short_description = isset($productData) ? $productData['product_short_description'] : '';
$product_img = isset($productData) ? $productData['product_img'] : '';
$featured_product = isset($productData) ? $productData['featured_category'] : '';
$product_additional_info = isset($productData) ? $productData['product_additional_info'] : '';
$product_child_id = isset($productData) ? $productData['child_id'] : '';

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
                            <div class="row">
                                <div class="col-md-4">
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
                            </div>
                         
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Featured Category</label>
                                    <div class="form-check">
                                        <input class="form-check-input" name="featured_category" type="checkbox" value="<?php if($featured_product == 1){?><?php echo $featured_product ?> <?php }else{ ?>0<?php } ?> " <?php if($featured_product == 1){?> checked <?php }else{ ?> unchecked <?php } ?> id="defaultCheck3" />
                                        <label class="form-check-label" for="defaultCheck3"></label>
                                    </div>
                                </div>
                            </div>

                          
                                       
                                        <!-- Subcategory dropdown -->
                                    </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Subcategory</label>
                                <select id="subcategory-select" name="sub_category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Please select a subcategory</option>
                                </select>
                            </div>

                              <!-- Child Subcategory dropdown -->
                              <div class="all_child_drop_down">

                              </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Product Name</label>
                                <input type="text" value="<?php echo $product_name; ?>" class="form-control" id="product_name" name="product_name" placeholder="Product Name" />
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product Description</label>
                                <textarea id="editor7" name="product_description" class="form-control" placeholder="Product Description"><?php echo $product_description; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product short Description</label>
                                <textarea id="editor7" name="product_short_description" class="form-control" placeholder="Product Short Description"><?php echo $product_short_description; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Product Image</label>
                                <input type="file" class="form-control" value="" id="product_img" name="product_img[]" multiple placeholder="Product Image" />
                                <?php if ($product_img) {
                                $imagePaths = explode(',', $product_img);

                                foreach ($imagePaths as $imagePath) {
                                ?>
                                <img src="<?php echo base_url(trim($imagePath)); ?>" alt="product_img" class="img-fluid site_setting_img_product">
                                <a class="remove-image" href="#" style="display: inline;" data-image="<?php echo $imagePath;?>" data-id="<?php echo $product_id; ?>">&#215;</a>
                                <?php
                                }
                                } ?> 
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Product Additional Information</label>
                                <textarea id="editor8" name="product_additional_info"  placeholder="Product Additional Information"><?php echo $product_additional_info; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- add headers -->

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Product Header</h5>
                        </div>
                        <div class="row card-body">
                        <div class="col-md-3">
                                <label for="product_header"></label>
                                <input type="text" name="product_header1" class="form-control" value="<?php echo $productData['product_header1']; ?>" placeholder="Product Header 1" />
                            </div>
                            <div class="col-md-3">
                                <label for="product_header"></label>
                                <input type="text" name="product_header2" class="form-control" value="<?php echo $productData['product_header2']; ?>" placeholder="Product Header 2" />
                            </div>
                            <div class="col-md-3">
                                <label for="product_header"></label>
                                <input type="text" name="product_header3" class="form-control" value="<?php echo $productData['product_header3']; ?>" placeholder="Product Header 3" />
                            </div>
                            <div class="col-md-3">
                                <label for="product_header"></label>
                                <input type="text" name="product_header4" class="form-control" value="<?php echo $productData['product_header4']; ?>" placeholder="Product Header 4" />
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
                                            <!-- <th>Variant Header</th> -->
                                            <th>Variant Description</th>
                                            <th></th>
                                            <th>Part Number</th>
                                            <th>Variant Stock</th>
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
                                                    <!-- <td><input type="text" name="variant_header[]" class="form-control" value="<?php //echo $variant['variant_header']; ?>" placeholder="Variant Header" /></td> -->
                                                    <td><input type="text" name="variant_description[]" class="form-control" value="<?php echo $variant['variant_description']; ?>" placeholder="Variant Description" /></td>
                                                    <td><input type="text" name="variant_sku[]" class="form-control" value="<?php echo $variant['variant_sku']; ?>" placeholder="Part Number" /></td>
                                                    <td><input type="text" name="parent[]" class="form-control" value="<?php echo $variant['parent']; ?>" placeholder="parent" /></td>    
                                                    <td><input type="text" name="variant_stock[]" class="form-control" value="<?php echo $variant['variant_stock']; ?>" placeholder="Variant Stock" /></td>                                                    
                                                    <td><a class="btn btn-danger" href="<?php echo base_url('') . "admin/variant/delete/" . $variant['variant_id'] ?>">Remove</a></td>
                                                </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <!-- <td><input type="text" name="variant_header1[]" class="form-control" value="<?php //echo $variant['variant_header_1']; ?>" placeholder="Variant Header 1" /></td> -->
                                                <td><input type="text" name="variant_description1[]" class="form-control" value="<?php echo $variant['variant_description_1']; ?>" placeholder="Variant Description 1" /></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <!-- <td><input type="text" name="variant_header2[]" class="form-control" value="<?php //echo $variant['variant_header_2']; ?>" placeholder="Variant Header 2" /></td> -->
                                                <td><input type="text" name="variant_description2[]" class="form-control" value="<?php echo $variant['variant_description_2']; ?>" placeholder="Variant Description 2" /></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <!-- <td><input type="text" name="variant_header3[]" class="form-control" value="<?php //echo $variant['variant_header_3']; ?>" placeholder="Variant Header 3" /></td> -->
                                                <td><input type="text" name="variant_description3[]" class="form-control" value="<?php echo $variant['variant_description_3']; ?>" placeholder="Variant Description 3" /></td>
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
                    <input type="hidden" name="lastchild_id" id="lastchild_id" value="">
                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>

<script>
    $(document).ready(function() {
        var imageUploaded = <?php echo ($product_img ? 'true' : 'false'); ?>;
        var addVariantClicked = false;

        var productId = "<?php echo $product_id; ?>";
    if (productId !== '') {
        addVariantClicked = true; // Set addVariantClicked to true for editing mode
    }

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
                "product_img[]": {
                    required: function() {
                        return !imageUploaded;
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
                },
                "parent[]": {
                    required: true
                },
                "variant_description[]": {
                    required: true
                },
                "variant_header[]": {
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
                "product_img[]": {
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
                },
                "parent[]": {
                    required: "parent is required!"
                },
                "variant_description[]": {
                    required: "Variant Description is required!"
                },
                "variant_header[]": {
                    required: "Variant Description is required!"
                }
                
            },
            submitHandler: function(form) {
                if (addVariantClicked) {
                    form.submit();
                } else {
                    alert("Add Variant button is required!");
                }
            }
        });

        $("#add-btn").click(function() {
            addVariantClicked = true;
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

        $('#subcategory-select').change(function() {
            sub_category_id = $(this).val();
            loadChildSubcategories(sub_category_id);
        });
            sub_category_id = '<?php echo $sub_category_id;?>';
            loadChildSubcategories(sub_category_id);
    
        function loadChildSubcategories(sub_category_id) {
        var child_id = '';
        if (sub_category_id) {
            $.ajax({
                url: '<?php echo base_url() ?>admin/getChildSubcategories/' + sub_category_id,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.length != 0)
                    {
                        $('#child-subcategory-input').hide();
                        $('.all_child_drop_down').html('');

                        var option = '';
                        $.each(data, function(key, value) {
                            var child_id = '<?php echo $product_child_id;?>';
                            option += '<option value="' + value.child_id + '"';
                            if (value.child_id == child_id) {
                                option += ' selected';
                            }
                            option += '>' + value.child_sub_category_name + '</option>';
                            $('#child-subcategory-select').append(option);
                        });

                        var createNewDropDwon = '<div class="mb-3"><label for="exampleFormControlSelect1" class="form-label">Childcategory</label><select class="form-select" aria-label="Default select example" name="child_id" onchange="getAllChildSubCategory(event)"><option value="<?php echo $product_child_id;?>">Select Child</option>'+option+'</select></div>';
                        $('#lastchild_id').val('<?php echo $product_child_id;?>');
                        $('.all_child_drop_down').append(createNewDropDwon);

                    }
                    else
                    {
                          $('#child-subcategory-input').show();
                    }

                    // $('#child-subcategory-select').html('<option value="">Please select a child subcategory</option>');


                    // $.each(data, function(key, value) {
                    //     var option = '<option value="' + value.child_id + '"';
                    //     if (value.child_id == child_id) {
                    //         option += ' selected';
                    //     }
                    //     option += '>' + value.child_sub_category_name + '</option>';
                    //     $('#child-subcategory-select').append(option);
                    // });


                    // $('#child-subcategory-field').show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        } else {

            $('#child-subcategory-field').hide();
            $('#child-subcategory-input').hide();
        }
    }

    function getAllChildSubCategory(event) 
    {
        var selectElement = event.target.value;

   
        $('#lastchild_id').val(selectElement);
        
        $.ajax({
                url: '<?php echo base_url() ?>admin/getChildSubId/' + selectElement,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.length != 0)
                    {
                        $('#child-subcategory-input').hide();

                        var option = '';
                        $.each(data, function(key, value) {
                            option += '<option value="' + value.child_id + '"';
                            if (value.child_id == selectElement) {
                                option += ' selected';
                            }
                            option += '>' + value.child_sub_category_name + '</option>';
                            $('#child-subcategory-select').append(option);
                        });

                        var createNewDropDwon = '<div class="mb-3"><select class="form-select" aria-label="Default select example" name="child_id" onchange="getAllChildSubCategory(event)"><option value="<?php echo $product_child_id;?>">Select Child</option>'+option+'</select></div>';

                        $('.all_child_drop_down').append(createNewDropDwon);

                    }
                    else
                    {
                          $('#child-subcategory-input').show();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
    }   
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

    row_counter = 0;
    row_counter1 = 0;

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
        var parent = $('<td><input type="text" name="parent[]" class="form-control" placeholder="Part Number" /></td>');
        var variant_stock = $('<td><input type="text" name="variant_stock[]" class="form-control" placeholder="Variant Stock" /></td>');
        var variant_description = $('<td><input type="text" name="variant_description[]" class="form-control" placeholder="Variant Description" /></td>');
        // var variant_header = $('<td><input type="text" name="variant_header[]" class="form-control" placeholder="Variant Header" /></td>');
        var inputRow1 = $('<tr class="input-row_'+ (row_counter1 + 0) +'_'+row_counter+'" data-id="'+ (row_counter1 + 0) +'"></tr>');
        var inputRow2 = $('<tr class="input-row_'+ (row_counter1 + 1) +'_'+ row_counter +'" data-id="'+ (row_counter1 + 1) +'"></tr>');
        var inputRow3= $('<tr class="input-row_'+ (row_counter1 + 2) +'_'+ row_counter +'" data-id="'+ (row_counter1 + 2) +'"></tr>');
        var blankh1 = $('<td></td>');
        var blankd1 = $('<td></td>');
        var blankh2 = $('<td></td>');
        var blankd2 = $('<td></td>');
        var blankh3 = $('<td></td>');
        var blankd3 = $('<td></td>');
        // var variant_header_1 = $('<td><input type="text" name="variant_header1[]" class="form-control" placeholder="Variant Header" /></td>');
        var variant_description_1 = $('<td><input type="text" name="variant_description1[]" class="form-control" placeholder="Variant Description" /></td>');
        // var variant_header_2 = $('<td><input type="text" name="variant_header2[]" class="form-control" placeholder="Variant Header" /></td>');
        var variant_description_2 = $('<td><input type="text" name="variant_description2[]" class="form-control" placeholder="Variant Description" /></td>');
        // var variant_header_3 = $('<td><input type="text" name="variant_header3[]" class="form-control" placeholder="Variant Header" /></td>');
        var variant_description_3 = $('<td><input type="text" name="variant_description3[]" class="form-control" placeholder="Variant Description" /></td>');
        var removeButton = $('<td><button class="btn btn-danger remove-btn" data-id="'+ (row_counter) +'">Remove</button></td>');

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
        // inputRow.append(variant_header);
        inputRow.append(variant_description);
        inputRow.append(variant_sku);
        inputRow.append(parent);
        inputRow.append(variant_stock);
        inputRow.append(removeButton);
        inputRow1.append(blankh1);
        inputRow1.append(blankd1);
        // inputRow1.append(variant_header_1);
        inputRow1.append(variant_description_1);
        inputRow2.append(blankh2);
        inputRow2.append(blankd2);
        // inputRow2.append(variant_header_2);
        inputRow2.append(variant_description_2);
        inputRow3.append(blankh3);
        inputRow3.append(blankd3);
        // inputRow3.append(variant_header_3);
        inputRow3.append(variant_description_3);
        $('#input-container tbody').append(inputRow);
        $('#input-container tbody').append(inputRow1);
        $('#input-container tbody').append(inputRow2);
        $('#input-container tbody').append(inputRow3);

        // Update variantSkuValues array with the new SKU value
        variantSkuValues.push('');
        row_counter++;
    });

//     $(document).on('click', '.add_head_des', function(e) {
  
//     alert(parentIndex);

//     var inputRow = $('<tr class="input-row[' + parentIndex + '] sub-child-row"></tr>');
//     var blank = $('<td></td>');
//     var blank2 = $('<td></td>');
//     var variant_header = $('<td><input type="text" name="variant_header[' + parentIndex + '][' + childIndex + ']" class="form-control" placeholder="Variant Header" /></td>');
//     var variant_description = $('<td><input type="text" name="variant_description[' + parentIndex + '][' + childIndex + ']" class="form-control" placeholder="Variant Description" /></td>');
//     var removeButton = $('<td><button class="btn btn-danger remove-btn">Remove</button></td>');

//     inputRow.append(blank);
//     inputRow.append(blank2);
//     inputRow.append(variant_header);
//     inputRow.append(variant_description);
//     inputRow.append(removeButton);

//     // Find the parent row with the specified data-id and append the sub-child row
//     $('.input-row').after(inputRow);
//     parentIndex++;
//     childIndex++;
// });
        // Remove field
        $(document).on('click', '.remove-btn', function() {

            var Id = $(this).data('id');
            $('.input-row_0_'+ Id +'').remove();
            $('.input-row_1_'+ Id +'').remove();
            $('.input-row_2_'+ Id +'').remove();
            $(this).closest('.input-row').remove();

        });

        $('#defaultCheck3').click(function() {
                if ($("#defaultCheck3").is(":checked") == true) {
                    $('#defaultCheck3').val('1');
                } else {
                    $('#defaultCheck3').val('0');
                }
            });
    });

    $('.remove-image').click(function(e) {
      
            e.preventDefault();
            var container = $(this).closest('.image-container');
            //var imageId = container.find('.image-id').val(); delete_partner_img
            var imageId = $(this).data('id');
            var image_path = $(this).data('image');
           
            Swal.fire({
                title: 'Are you sure?',
                text: 'You Want To Delete This.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('admin/product/product-delete') ?>',
                        type: 'POST',
                        data: {
                            image_id: imageId,
                            image_path: image_path
                        },
                        success: function(response) {
                            window.location.reload(true);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        });


    // const checkbox = document.getElementById("defaultCheck3");

    // checkbox.addEventListener("change", function() {
     
    //     // If the checkbox is checked, set the value to 1; otherwise, set it to 0.
    //     const value = this.checked ? 1 : 0;
    //     console.log("Checkbox value:", value);
    //     alert(value);
    //     this.setAttribute("value", value);
    //     // You can use the 'value' variable in any way you want in your code.
    // });

  

</script>


</script>