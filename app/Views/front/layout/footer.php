<!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
<?php 
$session = session();
?>
<footer>
    <div class="footer_sub">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center text-md-left col-lg-5">
                    <div class="footer_logo">
                        <!-- <a href="<?php //echo base_url(); ?>"><img src="<?php //echo base_url(); ?>public/uploads/Truflow_Light_Small.svg" alt="logo" class="img-fluid"></a> -->
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/uploads/Truflow_Logo_Light.svg" alt="logo" class="img-fluid" style="width:125px"></a>
                        <p> </p>
                        <div class="footer_icon">
                            <a class="button1" href="<?php echo $session->get('facebook_url'); ?>">
                                <span><i class="fa-brands fa-facebook-f"></i></span>
                            </a>
                            <a class="button1" href="<?php echo $session->get('instagram_url'); ?>">
                                <span><i class="fa-brands fa-instagram"></i></span>
                            </a>
                            <a class="button1 button2" href="<?php echo $session->get('linkedin_url'); ?>">
                                <span><i class="fa-brands fa-linkedin"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center text-md-left col-lg-3">
                    <div class="quick_link">
                        <h5>QUICKLINKS</h5>
                        <ul>
                            <li>
                                <a href="<?php echo base_url(); ?>">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('about'); ?>">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('products'); ?>">Products</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('contact'); ?>">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="footer_contact">
                        <h5>CONTACT US</h5>
                        <div class="number" style="display: flex;">
                            <i class="fa-solid fa-phone"></i>
                            <span class="rr"><a href="tel:+61894512204">08 9451 2204</a></span>
                        </div>
                        <div class="number" style="display: flex;">
                            <i class="fa-solid fa-envelope"></i>
                            <span><a href="mailto: sales@truflowhydraulic.com.au" class="rr"> sales@truflowhydraulic.com.au</a></span>
                        </div>
                        <div class="number" style="display: flex;">
                            <i class="fa-solid fa-location-dot" style="margin-left: 3px;"></i>
                            <span style="text-align: left;">Truflow Hydraulic Hose & Fittings Components Pty Ltd 29 Dowd Street,Perth, Australia 6106.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_line"></div>
                </div>
            </div>
            <div class="row all_right">
                <div class="col-lg-6">
                    <div class="all_rights">
                        <p>© 2023 Truflow Hydraulic Hose & Fittings Inc. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="privacy text-right">
                        <p class="footer_text"><a href="<?php echo base_url('terms/condition'); ?>" class="rr">Terms of Use</a> |<a href="<?php echo base_url('privacypolicy'); ?>" class="rr"> Privacy Policy</a><!-- | <a href="<?php echo base_url('disclaimer'); ?>" class="rr">Disclaimer</a> --></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--~~~~~~~~~~~~~~~~~>> FOOTER  END <<~~~~~~~~~~~~~~~~~~-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> -->
<script src="<?php echo base_url() ?>public/front/js/jquery-3.6.0.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> -->
<script src="<?php echo base_url(); ?>/public/front/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/public/front/js/all.min.js" ></script>
<script src="<?php echo base_url(); ?>/public/front/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>/public/front/js/swiper-bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/public/front/js/custome.js"></script>
<script src="<?php echo base_url(); ?>/public/front/js/sweetalert2@11.js"></script>

<script>
    $(document).ready(function() {
        $(".alert").delay(2000).slideUp(300);

        var url = window.location.href;
        var segments = url.split('/');
        var lastSegment = segments.pop() || segments.pop();

        $.ajax({
            url: '<?php echo base_url(); ?>get_meta',
            method: 'POST',
            data: {
                current_page: lastSegment == 'truflow' ? '' : lastSegment
            },
            success: function(response) {
                // var data = JSON.parse(response);
                console.log(response)
                $('head').append(response)
            }
        });
    });
</script>
<!-- //header search------------ -->
<script>
    function searchProduct() {
        var searchValue = $('#search').val();
        if (event.keyCode === 13) {
            var secondVariant = $('#search-result .variant').eq(1);
            var secondProductId = secondVariant.data('product-id');
            var variantsku = secondVariant.data('variant-name');

            if(typeof secondProductId !== 'undefined'){
                var dataPageUrl = '<?php echo base_url(); ?>product/details/' + variantsku;
                var cateId = secondProductId;

                var redirectUrl = '<?php echo base_url(); ?>product/details/' + variantsku;
                    // Make an AJAX request to a CodeIgniter 4 controller method
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>session/store', // Adjust the URL based on your routes
                    data: {
                        product_details_id: cateId
                    },
                    success: function(response) {
                        // Display an alert with the breadcrumb information
                        window.location.href = redirectUrl;
                    },
                    error: function(error) {
                        console.error('Error storing breadcrumb:', error);
                    }
                });
                window.location.href = dataPageUrl;
            }else{
                var dataPageUrl = '<?php echo base_url(); ?>shop';
                window.location.href = dataPageUrl;
            }

        }
        if (searchValue.trim().length >= 2) {
            $.ajax({
                url: '<?php echo base_url(); ?>searchData',
                method: 'POST',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.error == "Not found") {
                        // var html = '';
                        // html += '<p>No record found</p>';
                        // $('#search-result').html(html);
                        // $("#search-result").css("height", "30px");
                    } else {
                        var html = '';
                        html += '<p class="part_no">' + "Part Number" + '</p>';
                        for (var i = 0; i < data.length; i++) {
                            var variant = data[i];
                            // console.log(variant);
                            var variant_sku = variant.variant_sku;
                            var product_name = variant.product_name;
                                product_name = product_name.replace(/ /g, '_');
                            var category_name = variant.category_name;
                                category_name = category_name.replace(/ /g, '_');
                            var sub_category_name = variant.sub_category_name;
                                sub_category_name = sub_category_name.replace(/ /g, '_');
                            var sub_child_name = variant.sub_child_name;
                                sub_child_name = sub_child_name.replace(/ /g, '_');
                            var child_sub_category_name = variant.child_sub_category_name;
                                child_sub_category_name = child_sub_category_name.replace(/ /g, '_');
                            var product_id = variant.product_id;

                            var variant_url;
                            if (sub_child_name !== '') {
                                variant_url = 'products/' + category_name + '/' + sub_category_name + '/' + sub_child_name + '/' + child_sub_category_name + '/' + product_name;
                            } else {
                                variant_url = 'products/' + category_name + '/' + sub_category_name + '/' + child_sub_category_name + '/' + product_name;
                            }
                            console.log(variant_url);

                            html += '<div class="variant" data-variant-name="' + variant_sku + '" data-product-id="' + product_id + '"  data-variant-url="' + variant_url + '">';
                            // html += '<div class="variant" data-variant-name="' + variant_sku + '" data-product-id="' + product_id + '">';
                            html += '<p>' + variant_sku + '</p>';
                            html += '</div>';
                        }



                        $('#search-result').html(html);
                    }

                },
                error: function(xhr, status, error) {
                    // console.error('Error occurred during AJAX request.');
                    // console.log('Status:', status);
                    // console.log('Error:', error);
                    $('#search-result').html('<p>Error occurred: ' + error + '</p>');
                }
            });
        } else {
            $('#search-result').html('<p>No record found</p>');
            $("#search-result").css("height", "30px");
        }
    }

    // function redirectToDataPage(productId) {
    //     var dataPageUrl = '<?php echo base_url(); ?>product/details/' + productId;
    //     window.location.href = dataPageUrl;
    // }
    $(document).ready(function() {
        $('#search').on('keyup', function(event) {
            if (event.target.value.trim().length >= 2) {
                searchProduct();
                $("#search-result").css("height", "150px");
            } else {
                $('#search-result').html('No record found');
                $("#search-result").css("height", "30px");

                if (event.keyCode === 13) {
                alert('please enter value.');
                var dataPageUrl = '<?php echo base_url(); ?>shop';
                window.location.href = dataPageUrl;
            }
        }

            if (event.target.value.trim().length > 0) { // Check if the input field is not empty

            }

        });
        $(document).on('click', '.variant', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var variantsku = $(this).data('variant-name');
                var varianturl = $(this).data('variant-url');
                // Prevent the default behavior of the link (following the href)

                // Get the text content of the clicked link
                var cateId = productId;

                // var redirectUrl = '<?php // echo base_url(); ?>product/details/' + variantsku;
                var redirectUrl = '<?php echo base_url(); ?>' + varianturl;
                    // Make an AJAX request to a CodeIgniter 4 controller method
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>session/store', // Adjust the URL based on your routes
                    data: {
                        product_details_id: cateId
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
    // });
</script>

<script>
    $(document).ready(function() {
        $('#product_details').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo base_url('add_cart') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    //console.log(response);
                },
                error: function(xhr, status, error) {
                    //console.error(error);
                }
            });
        });



    });
</script>
<!-- // add row and validation and add to cart precess -->
<script>
    $(document).ready(function() {
        var initialRows = 4;
        var maxRows = 10;
        // Add initial rows
        for (var i = 0; i < initialRows; i++) {
            addRow();
        }
        // Add more rows when clicking the button
        $('#add_rows').click(function() {
            addRow();
        });

        $(document).on('click', '.delete-icon', function() {
            var row = $(this).closest('.input_fileds_row');
            var searchInput = row.find('.search_data_field');
            var qualityInput = row.find('.quality_input');
            searchInput.val('');
            qualityInput.val('');
            $(this).hide();
        });

        $(document).on('input', '.search_data_field, .quality_input', function() {
            var row = $(this).closest('.input_fileds_row');
            var deleteIcon = row.find('.delete-icon');
            if ($(this).val().trim() !== '') {
                deleteIcon.show();
            } else {
                deleteIcon.hide();
            }
        });

        function addRow() {
            var numRows = $('.input_fields .input_fileds_row').length;
            if (numRows < maxRows) {
                var newRow =
                    '<div class="input_fileds_row input_fileds">' +
                    '<div class="part_num">' +
                    (numRows === 0 ? '<h6>Part Number</h6>' : '') +
                    '<div class="dropdown1">' +
                    '<div class="dropdown-menu1">' +
                    // Add dropdown content and styling here
                    '</div>' +
                    '<input type="search" class="form-control search_data_field" name="search[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="quality">' +
                    (numRows === 0 ? '<h6>Quantity</h6>' : '') +
                    '<input type="number" class="form-control quality_input input-text qty text" inputmode="numeric" autocomplete="off" step="1" min="0" max="" name="quality[]">' +
                    '</div>' +
                    '<div class="delete-icon" style="display: none;">' +
                    '<i class="fa fa-trash"></i>' +
                    '</div>' +
                    '</div>';

                $('.input_fields').append(newRow);


                var dropdown = $('.input_fields .input_fileds_row:last-child .dropdown1');
                dropdown.css('position', 'relative');

                var dropdownMenu = dropdown.find('.dropdown-menu1');
                dropdownMenu.css({
                    'position': 'absolute',
                    'top': '100%',
                    'left': 0,
                    'z-index': 9999,
                    'background-color': '#fff',

                });

                dropdownMenu.on('mouseenter', 'li', function() {
                    $(this).css('background-color', '#aaa');
                });

                dropdownMenu.on('mouseleave', 'li', function() {
                    $(this).css('background-color', '#e3e5eb');
                });

                // Check the number of search results
                var searchResults = dropdownMenu.find('li');
                var numResults = searchResults.length;
                var maxResultsThreshold = 3;

                if (numResults > maxResultsThreshold) {
                    dropdownMenu.css({
                        'max-height': '200px',
                        'overflow-y': 'scroll',
                    });
                }
            }
        }

        $('#cart_form').submit(function(e) {
            e.preventDefault();

            var isLoggedIn = checkUserLoginStatus();
            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please Login',
                    text: 'Please log in before adding items to the cart.',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.href = '<?php echo base_url('login') ?>'; // Replace 'login.html' with the appropriate login page URL
                    }
                });
                return;
            }

            var filledRows = $('.input_fileds_row').filter(function() {
                var searchInput = $(this).find('.search_data_field');
                var qualityInput = $(this).find('.quality_input');
                return searchInput.val().trim() !== '' || qualityInput.val().trim() !== '';
            });

            if (filledRows.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill in at least one row.',
                });
                return;
            }

            var isValid = true;
            filledRows.each(function() {
                var searchInput = $(this).find('.search_data_field');
                var qualityInput = $(this).find('.quality_input');

                if (searchInput.val().trim() === '' || qualityInput.val().trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill in all the required fields for the filled rows.',
                    });
                    isValid = false;
                    return false;
                }

                if (parseInt(qualityInput.val()) == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please enter a quantity greater than 0.',
                    });
                    isValid = false;
                    return false;
                }
            });
            if (!isValid) {
                return;
            }

            var formData1 = $(this).serializeArray();
            // Send data using AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData1,
                success: function(response) {

                    if (response == 'Not found') {
                        // Display error message if data is not found

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Data added to cart successfully.',
                        }).then(function() {
                            // Redirect to the cart page
                            window.location.href = '<?= base_url("add/cart") ?>';
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                },
            });
        });

        function checkUserLoginStatus() {
            var isLoggedIn = <?php
                                $session = session();
                                echo $session->get('user_id') ? 'true' : 'false'; ?>;
            return isLoggedIn;
        }
    });
</script>

<!-- //search function based on input box-------- -->
<script>
    $(document).ready(function() {
        // Search data on keyup and input
        $(document).on('keyup input', '.search_data_field', function() {
            var searchText = $(this).val();
            // Check if search text has at least three characters
            if (searchText.trim().length >= 1) {
                searchData(searchText, $(this));
                $('#add_to_cart').attr('disabled', true);
            } else {
                // Clear the search results if the search text is less than three characters
                var dropdownMenu1 = $(this).siblings('.dropdown-menu1');
                dropdownMenu1.html('').hide();
                $('#add_to_cart').attr('disabled', false);
            }
        });
        // Hide search response on backspace key press
        $(document).on('keydown', '.search_data_field', function(event) {
            if (event.which == 8) {
                var dropdownMenu1 = $(this).siblings('.dropdown-menu1');
                dropdownMenu1.html('').hide();
            }
        });
        // Handle click on response item
        $(document).on('click', '.response-item1', function() {
            var selectedValue = $(this).text();
            var inputElement = $(this).closest('.dropdown1').find('.search_data_field');
            inputElement.val(selectedValue);
            $(this).closest('.dropdown-menu1').html('').hide();
        });

        function searchData(searchText, inputElement) {
            var dropdownMenu1 = inputElement.siblings('.dropdown-menu1');
            $.ajax({
                url: '<?php echo base_url(); ?>searchData',
                method: 'POST',
                data: {
                    search: searchText
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.length > 0) {
                        var html = '<ul class="response-list1">';
                        for (var i = 0; i < data.length; i++) {
                            var variant = data[i];
                            var variant_sku = variant.variant_sku;
                            var product_id = variant.product_id;
                            html += '<li class="response-item1">' + variant_sku + '</li>';
                        }
                        html += '</ul>';
                        dropdownMenu1.html(html).show();
                        $('#add_to_cart').attr('disabled', false);
                    } else {
                        searchSimilarData(searchText, dropdownMenu1);
                    }
                },
                error: function(xhr, status, error) {
                    // console.error('Error occurred during AJAX request.');
                    // console.log('Status:', status);
                    // console.log('Error:', error);
                    dropdownMenu1.html('<p>' + error + '</p>').show();
                }
            });
        }

        function searchSimilarData(searchText, dropdownMenu1) {
            $.ajax({
                url: '<?php echo base_url(); ?>searchSimilarData',
                method: 'POST',
                data: {
                    search: searchText
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.length > 0) {
                        var html = '<ul class="response-list1">';
                        for (var i = 0; i < data.length; i++) {
                            var variant = data[i];
                            var variant_sku = variant.variant_sku;
                            var product_id = variant.product_id;
                            html += '<li class="response-item1">' + variant_sku + '</li>';
                        }
                        html += '</ul>';
                        dropdownMenu1.html(html).show();
                        $('#add_to_cart').attr('disabled', false);
                    } else {
                        dropdownMenu1.html('No record found').show();
                       $('#add_to_cart').attr('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    // console.error('Error occurred during AJAX request.');
                    // console.log('Status:', status);
                    // console.log('Error:', error);
                    dropdownMenu1.html('<p>' + error + '</p>').show();
                }
            });
        }
    });
</script>

<!-- product search -->

<script>
    function searchProduct1() {
        var searchValue = $('#search_1').val();
        if (searchValue.trim().length >= 2) {
            $.ajax({
                url: '<?php echo base_url(); ?>searchData1',
                method: 'POST',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.error == "Not found") {
                        var html = '';
                        html += '<p>No record found</p>';
                        $("#search_1-result").css("height", "30px");
                        $('#search_1-result').html(html);
                    } else {
                        var html = '';
                        html += '<p class="part_no">' + "Part Number" + '</p>';
                        for (var i = 0; i < data.length; i++) {
                            var variant = data[i];
                            var variant_sku = variant.variant_sku;
                            var product_id = variant.product_id;
                            html += '<div class="variant" data-product-id="' + product_id + '">';
                            html += '<p>' + variant_sku + '</p>';
                            html += '</div>';
                        }
                        $('#search_1-result').html(html);
                    }
                },
                error: function(xhr, status, error) {
                    // console.error('Error occurred during AJAX request.');
                    // console.log('Status:', status);
                    // console.log('Error:', error);
                    $('#search_1-result').html('<p>Error occurred: ' + error + '</p>');
                }
            });
        } else {
            $('#search_1-result').html('<p>No record found</p>');
            $("#search_1-result").css("height", "30px");
        }
    }

    $(document).ready(function() {
        $('#search_1').on('keyup', function(event) {
            if (event.target.value.trim().length >= 2) {
                searchProduct1();
                $("#search_1-result").css("height", "150px");
                $("#search_1-result").css("padding", "8px");

            } else {
                $('#search_1-result').html('No record found');
                $("#search_1-result").css("height", "30px");
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        // Listen for keyup event on the search input
        $('#search_1').on('keyup', function() {
            var searchValue = $(this).val();

            // Show or hide the search result div based on the search input value
            if (searchValue.trim() !== '') {
                $('#search_1-result').show();
            } else {
                $('#search_1-result').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".wishlistsubmit").click(function(e) {
            e.preventDefault();
            var product_id = $(this).attr('data-product_id');
            //alert(product_id);
            $.ajax({
                url: "<?php echo base_url('add_wishlist'); ?>",
                data: {
                    "product_id": product_id
                },
                type: 'POST',
                success: function(result) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Add to Wish List',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function() {
                        location.reload();
                    });
                }
            });
        });
    });
</script>

<script>
    function changeImage(img) {
        $("imagepreview").src = img.src = "<?php echo base_url(); ?>public/front/images/heartw1.png";

    }
</script>

<script>
    $(document).ready(function() {
        $(".deletewishlistsubmit").click(function(e) {
            e.preventDefault();
            var product_id = $(this).attr('data-product_id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't UnWishlist This!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, UnWishlist it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    // User clicked the confirm button, proceed with deletion
                    $.ajax({
                        url: "<?php echo base_url('deleteWishList'); ?>",
                        data: {
                            "product_id": product_id
                        },
                        type: 'POST',
                        success: function(result) {
                            Swal.fire(
                                'Deleted!',
                                'The record has been deleted.',
                                'success'
                            ).then(function() {
                                location.reload();
                            });
                        }
                    });
                } else {
                    location.reload();
                }
            });
        });
    });
</script>
<script>
    function changeImage1(img) {
        $("imagepreview1").src = img.src = "<?php echo base_url(); ?>public/front/images/heartw.png";

    }
</script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(document).ready(function() {
        $('#custom-toggler').click(function() {
            $(this).toggleClass('active'); // Add or remove 'active' class on click
        });
    });

    $('.breadcrumb-list a').click(function (e) {
        // Prevent the default behavior of the link (e.g., navigation)
        // e.preventDefault();

        // Get the index of the clicked anchor tag
        var clickedIndex = $(this).parent().index();

        // Get all preceding div elements
        var precedingDivs = $('.breadcrumb-list div:lt(' + (clickedIndex + 1) + ')');

        // Create a container element to hold the HTML content
        var container = $('<div>');

        // Iterate through each preceding div and append its HTML content to the container
        precedingDivs.each(function(index) {
            // Exclude the first div (index 0) containing "SHOP"
            if (index > 0) {
                container.append($(this).prop('outerHTML'));
            }
        });

        // Log or use the left-side content as needed
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>breadcrumb/replace', // Adjust the URL based on your routes
            data: {
                breadcrumb: container.html().trim()
            },
            success: function(response) {
                // Display an alert with the breadcrumb information
                // window.location.href = redirectUrl;
            },
            error: function(error) {
                console.error('Error storing breadcrumb:', error);
            }
        });
    });

</script>

</body>

</html>