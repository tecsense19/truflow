        <!--~~~~~~~~~~~~~~~~~>> FOOTER START <<~~~~~~~~~~~~~~~~~~-->
        <footer>
            <div class="footer_sub">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-5">
                            <div class="footer_logo">
                                <img src="<?php echo base_url(); ?>/public/front/images/logo.png" alt="logo" class="img-fluid">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consequat nunc amet elit viverra
                                    purus a. Neque </p>
                                <div class="footer_icon">
                                    <a class="button1" href="#">
                                        <span><i class="fa-brands fa-facebook-f"></i></span>
                                    </a>
                                    <a class="button1 button2" href="#">
                                        <span><i class="fa-brands fa-instagram"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="quick_link">
                                <h5>QUICKLINKS</h5>
                                <ul>
                                    <li>
                                        <a href="">Home</a>
                                    </li>
                                    <li>
                                        <a href="">About Us</a>
                                    </li>
                                    <li>
                                        <a href="">Our Products</a>
                                    </li>
                                    <li>
                                        <a href="">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4">
                            <div class="footer_contact">
                                <h5>CONTACT US</h5>
                                <div class="number">
                                    <a href="#">
                                        <i class="fa-solid fa-phone"></i>
                                        <span>(+61) 894 512 204</span>
                                    </a>
                                </div>
                                <div class="number">
                                    <a href="#">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span>sales@truflowwhydraulic.com.au</span>
                                    </a>
                                </div>
                                <div class="number">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Truflow Hydraulic Components Pty Ltd 29 Dowd Street,Perth, Australia 6106.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer_line"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="all_rights">
                                <p>© 2022 Truflow Inc. All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="privacy text-right">
                                <p>Terms of Use | Privacy Policy | Disclaimer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--~~~~~~~~~~~~~~~~~>> FOOTER  END <<~~~~~~~~~~~~~~~~~~-->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/js/all.min.js" integrity="sha512-Cvxz1E4gCrYKQfz6Ne+VoDiiLrbFBvc6BPh4iyKo2/ICdIodfgc5Q9cBjRivfQNUXBCEnQWcEInSXsvlNHY/ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo base_url(); ?>/public/front/js/owl.carousel.js"></script>
        <script src="<?php echo base_url(); ?>/public/front/js/swiper-bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/front/js/custome.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $(".alert").delay(2000).slideUp(300);
            });
        </script>

        <script>
            function searchProduct() {
                var searchValue = $('#search').val(); // Get the search input value

                $.ajax({
                    url: '<?php echo base_url(); ?>/searchData', // Replace with the correct URL to your PHP endpoint
                    method: 'POST', // Adjust the HTTP method if necessary
                    data: {
                        search: searchValue
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.error == "Not found") {
                            var html = '';
                            // Display "No record found" message
                            html += '<p>No record found</p>';
                            $('#search-result').html(html);
                           // $('#search-result').html('<p>No record found</p>');
                        } else {
                            var html = '';

                            html += '<p class="part_no">' + "Part Number" + '</p>';
                            for (var i = 0; i < data.length; i++) {
                                var variant = data[i];

                                // var variantName = variant.variant_name;
                                // var price = variant.variant_price;
                                var variant_sku = variant.variant_sku;
                                var product_id = variant.product_id;

                                // Modify the code to add the product ID as a data attribute and bind it to the div

                                html += '<div class="variant" onclick="redirectToDataPage(\'' + product_id + '\')">';
                                html += '<p>' + variant_sku + '</p>';
                                html += '</div>';
                            }

                            $('#search-result').html(html);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Log the error details
                        console.error('Error occurred during AJAX request.');
                        console.log('Status:', status);
                        console.log('Error:', error);

                        // Display the error message
                        $('#search-result').html('<p>Error occurred: ' + error + '</p>');
                    }
                });
            }

            function redirectToDataPage(productId) {
                var dataPageUrl = '<?php echo base_url(); ?>/product_details/' + productId;
                window.location.href = dataPageUrl;
            }

            $(document).ready(function() {
                $('#search').on('keyup', function(event) {
                    searchProduct();
                });
            });
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

                            console.log(response);

                        },
                        error: function(xhr, status, error) {

                            console.error(error);
                        }
                    });
                });
            });
        </script>

        </body>

        </html>