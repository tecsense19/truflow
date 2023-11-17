<?= $this->include('front/layout/front'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP START <<~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about_page">
    <div class="about_overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_heading">
                        <h2>SHOP</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> SHOP INNER PAGE START <<~~~~~~~~~~~~~~~-->
<section class="category_product my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default side-nav side-nav-category" bis_skin_checked="1">
                    <div class="panel-heading" bis_skin_checked="1">
                        <strong>Child Sub Categories</strong>
                    </div>
                    <div class="panel-body" bis_skin_checked="1">
                        <div class="panel-group" id="accordion" bis_skin_checked="1">
                            <?php foreach ($ChildSubCategorydata as $index => $childsubcategory) : 
                            
                                ?>
                                <div class="panel panel-default" bis_skin_checked="1">
                                    <div class="panel-heading" bis_skin_checked="1" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $childsubcategory['sub_category_id']; ?>" onclick="toggleSubCategory(event, <?php echo $childsubcategory['sub_category_id']; ?>)">
                                        <p class="panel-title">
                                            <?php if ($index === 0) : ?>
                                                <i class="fa fa-caret-down"></i>
                                            <?php else : ?>
                                                <i class="fa fa-caret-right"></i>
                                            <?php endif; ?>
                                            <a href="<?php echo base_url('') . "product/" . $childsubcategory['sub_category_id'] ?>"><?php echo strtoupper($childsubcategory['child_sub_category_name']); ?></a>
                                        </p>
                                    </div>
                                    <div id="collapse<?php echo $childsubcategory['sub_category_id']; ?>" class="panel-collapse collapse <?php if ($index === 0) echo 'in'; ?>" bis_skin_checked="1">
                                        <?php if (!empty($childsubcategory['product_array'])) : ?>
                                            <div class="panel-body">
                                                <?php foreach ($childsubcategory['product_array'] as $product) : ?>
                                                    <p>
                                                        <i class="fa fa-caret-right"></i>



                                                        <a class="pro_link" href="<?php echo base_url('') . "product/details/" . $product['product_id'] ?>">
                                                            <?php echo $product['product_name']; ?>&nbsp;&nbsp;<?php echo $product['parent'] ?>
                                                        </a>

                                                    </p>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-lg-9">
                <div class="row">

                    <?php if (isset($ChildSubCategorydata)) { ?>
                        <?php foreach ($ChildSubCategorydata as $childsubcategory) { ?>
                            <div class="col-lg-4">
                                <div class="product_box">
                                    <div class="product_img">
                                        <?php if (!empty($childsubcategory['sub_category_img'])) { ?>

                                            <img class="img-fluid card-img-top" src="<?php echo base_url() . $childsubcategory['sub_category_img'] ?>" alt="image">
                                        <?php } else { ?>
                                            <img class="img-fluid card-img-top" src="<?php echo base_url(); ?>/public/uploads/no_img.png" alt="image">
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="product_text text-center">

                                        <a href="<?php echo base_url('') . "product/" . $childsubcategory['child_id'] ?>" class="category-link">
                                            <h3 class="mt-3"><?php echo $childsubcategory['child_sub_category_name']; ?></h3>
                                        </a>
                                        <span><?php //echo $subcategory['sub_category_description']; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-md-12 text-center-t1">
                            <div class="form-group mt-5 mb-5 data_center text-center">
                                <h4>No Item Found</h4>
                            </div>

                        <?php } ?>
                        </div>
                </div>
            </div>
        </div>
        <!-- <div class="text-center">
            <a href="#!" class="load_more">Load More <i class="fa-solid fa-rotate-right"></i></a>
        </div> -->
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~>> ABOUT PAGE END <<~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?= $this->include('front/layout/footer'); ?>

<script>
    function toggleSubCategory(event, subCategoryId) {
        event.preventDefault();

        var subCategoryPanel = document.getElementById('collapse' + subCategoryId);
        var expanded = subCategoryPanel.classList.contains('in');

        var panels = document.getElementsByClassName('panel-collapse');
        for (var i = 0; i < panels.length; i++) {
            panels[i].classList.remove('in');
        }

        var titleIcon = subCategoryPanel.previousElementSibling.querySelector('i.fa');
        if (!expanded) {
            subCategoryPanel.classList.add('in');
            titleIcon.classList.remove('fa-caret-right');
            titleIcon.classList.add('fa-caret-down');
        } else {
            titleIcon.classList.remove('fa-caret-down');
            titleIcon.classList.add('fa-caret-right');
        }
    }
</script>