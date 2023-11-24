<style>
    section.category_product .container {
        max-width: 86%;
    }

    .bullet-list-round {
    padding: 0;
    /* margin: 0 0 24px 12px; */
    line-height: 1.28571em;
    /* margin-left: 14px; */
    list-style: none;
    background-color: white;
    }

    .bullet-list-round li {
    margin-top: 6px;
    margin-bottom: 6px;
    /* background-image: url(https://cdn1.iconfinder.com/data/icons/hawcons/32/698599-icon-86-document-list-16.png); */
    background-size: 13px;
    background-repeat: no-repeat;
    }

    li.folder {
    /* background-image: url(https://cdn1.iconfinder.com/data/icons/hawcons/32/698607-icon-94-folder-16.png); */
    }

    .panel-default>.panel-heading {
        margin: 0px;
    }
</style>
<div id="pen-container">
    <?php if (isset($categoryData)) { foreach ($categoryData as $category) { ?>
        <ul class="bullet-list-round panel panel-default" style="background-color: #f5f5f5; margin-bottom: 5px;">
            <li class="">
                <div style="padding: 5px 15px;">
                    <div class="panel-title" style="display: flex;">
                        <div><i class="fa fa-caret-right"></i></div>
                        <div style="padding-left: 10px;"><a href="<?php echo base_url() . 'shop'; ?>" style="color: #000000"><?php echo strtoupper($category['category_name']); ?></a></div>
                    </div>
                </div>
                <?php if(isset($category['sub_category']) && count($category['sub_category']) > 0) { renderCategory($category['sub_category'], 30); } ?>
            </li>
        </ul>
    <?php } } ?>
    <?php
        function renderCategory($subcategories, $padding) {
            if (!empty($subcategories)) {
                echo '<ul class="bullet-list-round" style="background-color: white;">';
                foreach ($subcategories as $subCategory) {
                    if($subCategory)
                    {
                        echo '<li>';
                        echo '<div style="padding: 5px '.$padding.'px;">';
                        echo '<div class="panel-title" style="display: flex;">';
                        echo '<div><i class="fa fa-caret-right" style="width: 10px;"></i></div>';
                        if(isset($subCategory['sub_category_name']))
                        {
                            $childCatLink = base_url('') . "childsub/category/" . $subCategory['sub_category_id'];
                            echo '<div style="padding-left: 10px;"><a href="'.$childCatLink.'" style="color: #000000">' . strtoupper($subCategory['sub_category_name']) . '</div></a>';
                        }
                        else
                        {
                            $subChildCatLink = $subCategory['isProduct'] ? base_url('') . "product/" . $subCategory['sub_category_id'] .'/'.$subCategory['child_id'] : base_url('') . "childsub_sub/category/" . $subCategory['child_id'];
                            echo '<div style="padding-left: 10px;"><a href="'.$subChildCatLink.'" style="color: #000000">' . strtoupper($subCategory['child_sub_category_name']) . '</div></a>';
                        }
                        echo '</div>';
                        echo '</div>';
                        if(isset($subCategory['child_arr']) && count($subCategory['child_arr']) > 0)
                        {
                            renderCategory($subCategory['child_arr'], ($padding + 15));
                        }
                        if(isset($subCategory['product_arr']) && count($subCategory['product_arr']) > 0)
                        {
                            renderProducts($subCategory['product_arr'], ($padding + 15));
                        }
                        echo '</li>';
                    }
                }
                echo '</ul>';
            }
        }

        function renderProducts($products, $padding) {
            if (!empty($products)) {
                echo '<ul class="bullet-list-round">';
                foreach ($products as $product) {
                    $productLink = base_url('') . "product/details/" . $product['product_id'];
                    if($product)
                    {
                        echo '<li>';
                        echo '<div style="padding: 5px '.$padding.'px;">';
                        echo '<div class="panel-title" style="display: flex;">';
                        echo '<div style="margin-right: 10px;"><i class="fa fa-circle" style="width: 10px;"></i></div>';
                        echo '<div><a href="'.$productLink.'" style="color: #000000;">' . $product['product_name'] . '</a></div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                    }
                }
                echo '</ul>';
            }
        }
        ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Execute this after the site is loaded.
    $(function() {
        $('li > ul').each(function(i) {
            // Find this list's parent list item.
            var parentLi = $(this).parent('li');

            // Style the list item as a folder.
            parentLi.addClass('folder');

            // Temporarily remove the list from the
            // parent list item, wrap the remaining
            // text in an anchor, then reattach it.
            var subUl = $(this).show(); // Initially hide the child ul
            parentLi.wrapInner('<a/>').find('a').click(function() {
                // Close other siblings
                parentLi.siblings().find('ul').hide();
                // Toggle the leaf display.
                subUl.toggle();
                // Add a class to the selected ul for future reference
                subUl.addClass('selected-ul');
                // Remove the class from other ul elements
                parentLi.siblings().find('ul').removeClass('selected-ul');
            });
            parentLi.append(subUl);
        });

        // Hide all lists except the outermost.
        // $('ul ul').hide();
    });
</script>