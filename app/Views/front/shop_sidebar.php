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
    h2.breadcrumb-list {
        font-size: 22px;
    }
</style>
<div id="pen-container">
    <?php if (isset($categoryData)) { foreach ($categoryData as $category) { ?>
        <ul class="bullet-list-round panel panel-default" style="background-color: #f5f5f5; margin-bottom: 5px;">
            <li class="">
                <div style="padding: 5px 15px;">
                    <div class="panel-title" style="display: flex;">
                        <div><i class="fa fa-caret-right"></i></div>
                        <div style="padding-left: 10px;"><a href="<?php echo base_url() . 'products'; ?>" style="color: #000000"><?php echo strtoupper($category['category_name']); ?></a></div>
                    </div>
                </div>
                <?php
                    $passLink = "<div>&nbsp; > &nbsp;<a href='". base_url() ."products'>".strtoupper($category['category_name'])."</a></div>";
                    if(isset($category['sub_category']) && count($category['sub_category']) > 0) {
                        renderCategory($category['sub_category'], 30, [$passLink]);
                    }
                ?>
            </li>
        </ul>
    <?php } } ?>
    <?php
        function renderCategory($subcategories, $padding, $breadcrumb = []) {
            if (!empty($subcategories)) {
                echo '<ul class="bullet-list-round" style="background-color: white;">';
                foreach ($subcategories as $subCategory) {
                    if ($subCategory) {
                        echo '<li>';
                        echo '<div style="padding: 5px ' . $padding . 'px;">';
                        echo '<div class="panel-title" style="display: flex;">';
                        echo '<div><i class="fa fa-caret-right" style="width: 10px;"></i></div>';
                        $currentBreadcrumb = $breadcrumb; // Copy current breadcrumb

                        if (isset($subCategory['sub_category_name'])) {

                            // $childCatLink = base_url('') . "childsub/category/" . $subCategory['sub_category_id'];
                            $childCatLink = base_url('') . "childsub/category/" . str_replace(' ', '-', $subCategory['sub_category_name']);

                            $currentBreadcrumb[] = "<div>&nbsp; > &nbsp;<a class='category_data'data-type='sub_cat' data-id=".$subCategory['sub_category_id']."
                            href='javascript:void(0)' data-url=".$childCatLink.">".strtoupper($subCategory['sub_category_name'])."</a></div>";

                            echo '<div style="padding-left: 10px;" class="category_data" data-url="'.$childCatLink.'" data-type="sub_cat" data-id="'. $subCategory['sub_category_id'] .'"><a href="javascript:void(0)" style="color: #000000" class="breadcrumb-link" data-bread="'.implode(' ', $currentBreadcrumb).'">' . strtoupper($subCategory['sub_category_name']) . '</a></div>';
                        } else {
                            $subChildCatLink =
                            $subCategory['isProduct']
                                ?
                                base_url('') . "product/" . str_replace(' ', '-', $subCategory['child_sub_category_name'])
                                :
                                base_url('') . "childsub_sub/category/" . str_replace(' ', '-', $subCategory['child_sub_category_name']);

                               if($subCategory['isProduct']){
                                $currentBreadcrumb[] = "<div>&nbsp; > &nbsp;<a class='category_data' data-url=".$subChildCatLink." data-childid=".$subCategory['child_id']." data-subcatid=". $subCategory['sub_category_id']."  data-type='product' href='javascript:void(0)'>".strtoupper($subCategory['child_sub_category_name'])."</a></div>";
                               }else{
                                $currentBreadcrumb[] = "<div>&nbsp; > &nbsp;<a class='category_data' data-url=".$subChildCatLink." data-childid=".$subCategory['child_id']."  data-type='childsub_sub' href='javascript:void(0)'>".strtoupper($subCategory['child_sub_category_name'])."</a></div>";
                               }


                            $bindHtml = $subCategory['isProduct'] ? 'data-url='.$subChildCatLink.' data-type="product" data-childid='.$subCategory['child_id'].' data-subcatid='. $subCategory['sub_category_id'] : 'data-url='.$subChildCatLink.' data-type="childsub_sub" data-childid='.$subCategory['child_id'];

                            echo '<div style="padding-left: 10px;" class="category_data" '. $bindHtml .'><a href="javascript:void(0)" style="color: #000000" class="breadcrumb-link" data-bread="'.implode(' ', $currentBreadcrumb).'">' . strtoupper($subCategory['child_sub_category_name']) . '</a></div>';
                        }

                        echo '</div>';
                        echo '</div>';

                        if (isset($subCategory['child_arr']) && count($subCategory['child_arr']) > 0) {
                            renderCategory($subCategory['child_arr'], ($padding + 15), $currentBreadcrumb);
                        }

                        if (isset($subCategory['product_arr']) && count($subCategory['product_arr']) > 0) {
                            renderProducts($subCategory['product_arr'], ($padding + 15), $currentBreadcrumb);
                        }

                        echo '</li>';
                    }
                }
                echo '</ul>';

                // Output breadcrumb
                // if (!empty($breadcrumb)) {
                //     echo '<div>Breadcrumb: ' . implode(' > ', $breadcrumb) . '</div>';
                // }
            }
        }

        function renderProducts($products, $padding, $breadcrumb = []) {
            if (!empty($products)) {
                echo '<ul class="bullet-list-round ">';
                foreach ($products as $product) {
                    // $productLink = base_url('') . "product/details/" . $product['product_id'];
                    $productLink = base_url('') . "product/details/" . $product['product_name'];
                    if ($product) {
                        echo '<li>';
                        echo '<div style="padding: 5px ' . $padding . 'px;">';
                        echo '<div class="panel-title" style="display: flex;">';
                        echo '<div style="margin-right: 10px;"><i class="fa fa-circle" style="width: 10px;"></i></div>';
                        $currentBreadcrumb = $breadcrumb; // Copy current breadcrumb
                        $currentBreadcrumb[] = $product['product_name'];

                        echo '<div class="category_data" data-proid="'.$product['product_id'].'" data-url="'. $productLink .'" data-type="single_product"><a href="javascript:void(0)" style="color: #000000;" class="breadcrumb-link" data-bread="'.implode(' ', $breadcrumb).'">' . $product['product_name'] . '</a></div>';
                        echo '</div>';
                        echo '</div>';

                        // Output breadcrumb
                        // if (!empty($currentBreadcrumb)) {
                        //     echo '<div>Breadcrumb: ' . implode(' > ', $currentBreadcrumb) . '</div>';
                        // }

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
        $('ul ul').hide();

        $('.breadcrumb-link').click(function(e) {
            // Prevent the default behavior of the link (following the href)
            e.preventDefault();

            // Get the text content of the clicked link
            var clickedBreadcrumb = $(this).attr('data-bread');

            var redirectUrl = $(this).attr('href');

             // Make an AJAX request to a CodeIgniter 4 controller method
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>breadcrumb/store', // Adjust the URL based on your routes
                data: {
                    breadcrumb: clickedBreadcrumb
                },
                success: function(response) {
                    // Display an alert with the breadcrumb information
                    window.location.href = redirectUrl;
                },
                error: function(error) {
                    console.error('Error storing breadcrumb:', error);
                }
            });
        });
    });
</script>


<script>
$(function() {
    $('.category_data').click(function(e) {
        // Prevent the default behavior of the link (following the href)
        e.preventDefault();
        // // Get the text content of the clicked link
        var parameters = {};
        var redirectUrl = $(this).data('url');
        var type = $(this).data('type');
        var sub_category_id = $(this).data('id');
        var childsubcategory_id = $(this).data('subcatid');
        var child_id = $(this).data('childid');
        var proid = $(this).data('proid');
        // var childsubcategory_id = $(this).data('subcatid');

        if(type == "sub_cat")
        {
            parameters = { sub_category_id : sub_category_id };
        }
        if(type == "product")
        {
            parameters = { sub_category_id : childsubcategory_id, child_id : child_id };
            // alert(parameters);
            // parameters = { child_id: child_id };
        }
        if(type == "childsub_sub")
        {
            // parameters = { childsubcategory_id: childsubcategory_id };
            parameters = { child_id : child_id, childsubcategory_id : child_id };
        }
        if(type == "single_product")
        {
            // parameters = { childsubcategory_id: childsubcategory_id };
            parameters = { product_details_id : proid };
        }

        // Make an AJAX request to a CodeIgniter 4 controller method
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>session/store', // Adjust the URL based on your routes
            data: parameters,
            success: function(response) {
                // Display an alert with the breadcrumb information
                window.location.href = redirectUrl;
            },
            error: function(error) {
                console.error('Error storing breadcrumb:', error);
            }
        });
    });
});

</script>