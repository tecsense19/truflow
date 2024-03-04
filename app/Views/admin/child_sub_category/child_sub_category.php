<?= $this->include('admin/layout/front') ?>
<?php
$child_id = isset($childData) ? $childData['child_id'] : '';
$category_id = isset($childData) ? $childData['category_id'] : '';
$sub_category_id = isset($childData) ? $childData['sub_category_id'] : '';
$sub_chid_id = isset($childData) ? $childData['sub_chid_id'] : '';
$child_sub_category_featured = isset($childData) ? $childData['child_sub_category_featured'] : '';
$child_sub_cate_sort = isset($childData) ? $childData['child_sub_cate_sort'] : '';


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

                <form method="post" id="product_form" action="<?php echo base_url() ?>admin/child_sub_category/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Child Sub Category</h5>
                        </div>
                        <div class="card-body">
                        <div class="row">
                         <div class="col-md-6">
                            <!-- Category dropdown -->
                            <!-- Category dropdown -->
                            <div class="mb-3">
                                <label for="category-select" class="form-label">Category</label>
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

                            <div class="col-md-6">
                                 <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Featured Category</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="child_sub_category_featured" type="checkbox" value="<?php if($child_sub_category_featured == 1){?><?php echo $child_sub_category_featured ?> <?php }else{ ?>0<?php } ?> " <?php if($child_sub_category_featured == 1){?> checked <?php }else{ ?> unchecked <?php } ?> id="defaultCheck3" />
                                    <label class="form-check-label" for="defaultCheck3"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                            <!-- Subcategory dropdown -->
                            <div class="mb-3" id="subcategory-field" style="display: none;">
                                <label for="subcategory-select" class="form-label">Subcategory</label>
                                <select id="subcategory-select" name="sub_category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Please select a subcategory</option>
                                </select>
                            </div>

                            <div class="all_child_drop_down">

                            </div>
                            <div class="mb-3" id="child-subcategory-input" style="display: none;">
                                <label for="child-subcategory-input" class="form-label">Child Subcategory Name</label>
                                <input type="text" class="form-control" id="child-subcategory-input" name="child_sub_category_name">
                            </div>

                            <div class="mb-3" id="child-subcategory-input_img" style="display: none;">
                                <label class="form-label" for="basic-default-company">Child Subcategory Product Image</label>
                                <input type="file" class="form-control" value="" id="child-subcategory-input_img" name="child_product_img[]" multiple placeholder="child Product Image" required/>
                                <?php //if ($product_img) {
                               // $imagePaths = explode(',', $product_img);

                               // foreach ($imagePaths as $imagePath) {
                                ?>
                                <!-- <img src="<?php //echo base_url(trim($imagePath)); ?>" alt="product_img" class="img-fluid site_setting_img_product"> -->
                                <?php
                                //}
                            //} ?> 
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="child_sub_cate_sort">Child Sub Category Sort</label>
                                <input type="number" value="<?php echo $child_sub_cate_sort;?>" class="form-control" id="child_sub_cate_sort" name="child_sub_cate_sort" placeholder="Sort" />
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
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>



<script>
    $(document).ready(function() {
        var category_id = '<?php echo $category_id; ?>';
        var sub_category_id = '';
        var child_sub_category_id = '';
        var child_id = '';
        var sub_chid_id = '<?php echo $sub_chid_id; ?>';


        $('#category-select').change(function() {
            category_id = $(this).val();
            sub_category_id = '';
            loadSubcategories(category_id, sub_category_id);
        });


        $('#subcategory-select').change(function() {
            sub_category_id = $(this).val();
            loadChildSubcategories(sub_category_id);
        });


        $('#child-subcategory-select').change(function() {

            if ($(this).val() !== '') {
                $('#child-subcategory-input').show();
            } else {
                $('#child-subcategory-input').hide();
            }
            if ($(this).val() !== '') {
                $('#child-subcategory-input_img').show();
            } else {
                $('#child-subcategory-input_img').hide();
            }
        });


        if (category_id !== '') {
            loadSubcategories(category_id, sub_category_id);
        }



        if (sub_category_id !== '') {
            loadChildSubcategories(sub_category_id);
        }


        if (child_id !== '') {
            $('#child-subcategory-field').show();
            if (sub_chid_id !== '') {
                $('#child-subcategory-input').show();
                $('#child-subcategory-input_img').show();
                
            }
        }
        $('#defaultCheck3').click(function() {
                if ($("#defaultCheck3").is(":checked") == true) {
                    $('#defaultCheck3').val('1');
                } else {
                    $('#defaultCheck3').val('0');
                }
            });
    });

    function loadSubcategories(category_id, sub_category_id) {
        if (category_id) {
            $.ajax({
                url: '<?php echo base_url() ?>admin/getSubcategories/' + category_id,
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    $('#subcategory-select').html('<option value="">Please select a subcategory</option>');


                    $.each(data, function(key, value) {
                        var option = '<option value="' + value.sub_category_id + '"';
                        if (value.sub_category_id == sub_category_id) {
                            option += ' selected';
                        }
                        option += '>' + value.sub_category_name + '</option>';
                        $('#subcategory-select').append(option);
                    });


                    $('#subcategory-field').show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        } else {

            $('#subcategory-field').hide();
            $('#child-subcategory-field').hide();
            $('#child-subcategory-input').hide();
            $('#child-subcategory-input_img').hide();
            
        }
    }

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
                        $('#child-subcategory-input_img').hide();
                        $('.all_child_drop_down').html('');

                        var option = '';
                        $.each(data, function(key, value) {
                            option += '<option value="' + value.child_id + '"';
                            if (value.child_id == child_id) {
                                option += ' selected';
                            }
                            option += '>' + value.child_sub_category_name + '</option>';
                            $('#child-subcategory-select').append(option);
                        });

                        var createNewDropDwon = '<div class="mb-3"><label for="exampleFormControlSelect1" class="form-label">Childcategory</label><select class="form-select" aria-label="Default select example" name="child_id" onchange="getAllChildSubCategory(event)"><option value="">Select Child</option>'+option+'</select></div>';

                        $('.all_child_drop_down').append(createNewDropDwon);

                    }
                    else
                    {
                          $('#child-subcategory-input').show();
                          $('#child-subcategory-input_img').show();
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
            $('#child-subcategory-input_img').hide();
        }
    }

    function getAllChildSubCategory(event) 
    {
        var selectElement = event.target.value;
        
        $.ajax({
                url: '<?php echo base_url() ?>admin/getChildSubId/' + selectElement,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.length != 0)
                    {
                        $('#child-subcategory-input').hide();
                        $('#child-subcategory-input_img').hide();

                        var option = '';
                        $.each(data, function(key, value) {
                            option += '<option value="' + value.child_id + '"';
                            if (value.child_id == selectElement) {
                                option += ' selected';
                            }
                            option += '>' + value.child_sub_category_name + '</option>';
                            $('#child-subcategory-select').append(option);
                        });

                        var createNewDropDwon = '<select class="form-select" aria-label="Default select example" name="child_id" onchange="getAllChildSubCategory(event)"><option value="">Select Child</option>'+option+'</select>';

                        $('.all_child_drop_down').append(createNewDropDwon);

                    }
                    else
                    {
                          $('#child-subcategory-input').show();
                          $('#child-subcategory-input_img').show();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
    }   

</script>