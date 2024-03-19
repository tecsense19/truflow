<?php
function displayChildren($children)
{
    
    // if (empty($children)) {
    //     return;
    // }
    // echo '<ul class="nested">';
    // foreach ($children as $child) {
    //     $url_edit = base_url('') . "admin/child_sub_category/name_edit/" . $child->child_id;
    //     $url_delete = base_url('') . "admin/child_sub_category/delete/" . $child->child_id;
    //     echo '<li><span class="caret">' . $child->child_sub_category_name . '&nbsp;&nbsp;&nbsp;<a class="" href="'.$url_edit.'"><i class="bx bx-edit-alt me-1"></i></a><a class="" href="'.$url_delete.'"><i class="bx bx-trash me-1"></i></a>';
    //     displayChildren($child->children);
    //     echo '</span></li>';
    // }
    // echo '</ul>';

    if (empty($children)) {
        return;
    }
    echo '<ul class="nested">';
    foreach ($children as $child) {
        // echo '<pre>';print_r($child);echo '</pre>';
        $url_edit = base_url('') . "admin/child_sub_category/name_edit/" . $child->child_id;
        $url_delete = base_url('') . "admin/child_sub_category/delete/" . $child->child_id;
        // echo '<li><span class="caret">' . $child->child_sub_category_name;
        echo '<li><span class="caret">' . $child->child_sub_category_name . ' (Sort: ' . (isset($child->child_sub_cate_sort) ? $child->child_sub_cate_sort : '0') . ')';
        if ($child->child_sub_category_img) {
            $imagePaths = explode(',', $child->child_sub_category_img);
            foreach ($imagePaths as $imagePath) {
               $image_path =  base_url(trim($imagePath)); 
                echo ' &nbsp;&nbsp;&nbsp;<img src="'.$image_path.'" alt="product_img" 
                style="width: 60px;border: 1px solid #696cff;padding: 4px;border-radius: 3px;"class="img-fluid site_setting_img_product"> ';
            }
        } 

        // Edit link or button
        echo '<a href="'.$url_edit .'"><i class="bx bx-edit-alt me-1"></i></a>';

        // Delete link or button
        echo '<a href="'. $url_delete . '" class="delete-link"><i class="bx bx-trash me-1"></i></a>';
        if (empty($child->children)) {
            // Edit link or button
            // echo '<a href="'.$url_edit .'"><i class="bx bx-edit-alt me-1"></i></a>';

            // Delete link or button
            // echo '<a href="'. $url_delete . '"><i class="bx bx-trash me-1"></i></a>';
        } else {
            // Recursively display the children for the current child
            displayChildren($child->children);
        }
        echo '</span></li>';
    }
    echo '</ul>';
}
?>
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>

<?= $this->include('admin/layout/front') ?>
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

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Child Sub Category List</h5>
                

                    <a href="<?php echo base_url() . "admin/child_sub_category" ?>"><button class="btn btn-primary d-grid float-end">Add Child Category</button></a>
                </div>
                <div class="card mb-4">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Child Sub Category Name</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        if ($subcategoryData) { ?>
                                                <tr>
                                                <td>
                                                     <?php foreach ($categories as $category): ?>
                                                        <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td><h2><?php echo $category['category_name']; ?></h2>
                                                            <?php if (!empty($category['sub_cat'])): ?>
                                                                <ul id="myUL">
                                                                    <?php foreach ($category['sub_cat'] as $subcategory): ?>
                                                                        <li><span class="caret">
                                                                            <?php echo $subcategory['sub_category_name']; ?>
                                                                            
                                                                        </span>
                                                                            
                                                                            <?php if (!empty($subcategory['child_arr'])): ?>
                                                                                <ul class="nested">
                                                                                    <?php foreach ($subcategory['child_arr'] as $childsubcategory): 
                                                                                        ?>
                                                                                        <li><span class="caret">
                                                                                            <?php echo $childsubcategory['child_sub_category_name']; ?> (Sort: <?php echo isset($childsubcategory['child_sub_cate_sort']) ? $childsubcategory['child_sub_cate_sort'] : '0'; ?>)
                                                                                            <?php if ($childsubcategory['child_sub_category_img']) {
                                                                                                $imagePaths = explode(',', $childsubcategory['child_sub_category_img']);
                                                                                                foreach ($imagePaths as $imagePath) {
                                                                                                ?>
                                                                                                &nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(trim($imagePath)); ?>" alt="product_img" 
                                                                                                style="width: 60px;border: 1px solid #696cff;padding: 4px;border-radius: 3px;"class="img-fluid site_setting_img_product"> 
                                                                                                <?php
                                                                                                }
                                                                                            } ?>
                                                                                            <?php // if (empty($childsubcategory['all_childs'])): ?>
                                                                                               
                                                                                                &nbsp;&nbsp;&nbsp;<a class="" href="<?php echo base_url('') . "admin/child_sub_category/name_edit/" . $childsubcategory['child_id'] ?>"><i class="bx bx-edit-alt me-1"></i></a>
                                                                                            <a href="<?php echo base_url('') . "admin/child_sub_category/delete/" . $childsubcategory['child_id'] ?>" class="delete-link"><i class="bx bx-trash me-1"></i></a>
                                                                                            <?php // else; ?>
                                                                                        </span>
                                                                                            <?php if (!empty($childsubcategory['all_childs'])): ?>
                                                                                                <?php displayChildren($childsubcategory['all_childs']); ?>
                                                                                            <?php endif; ?>
                                                                                             </li>
                                                                                    <?php endforeach; ?>
                                                                                </ul>
                                                                            <?php endif; ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    

                                                </tr>
                                            
                                     

                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center"><?php echo "No Data"; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <input type="submit" class="btn btn-primary d-grid"> -->
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}

$('.delete-link').on('click', function(event) {
    event.preventDefault();
    var deleteUrl = $(this).attr('href');
    if (confirm('Are you sure you want to delete this item? Because related all child category also removed.')) {
        window.location.href = deleteUrl;
    }
});
</script>