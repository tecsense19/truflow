                </div>
                <!-- / Layout page -->
                </div>
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
                </div>
                <!-- / Layout wrapper -->
               
                <!-- Core JS -->
                <!-- build:js assets/vendor/js/core.js -->
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/jquery/jquery.js"></script>
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/popper/popper.js"></script>
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/js/bootstrap.js"></script>
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/js/menu.js"></script>
                <!-- endbuild -->
                <!-- Vendors JS -->
                <script src="<?php echo base_url(); ?>/public/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
                <!-- Main JS -->
                <script src="<?php echo base_url(); ?>/public/admin/assets/js/main.js"></script>
                <!-- Page JS -->
                <script src="<?php echo base_url(); ?>/public/admin/assets/js/dashboards-analytics.js"></script>
                <!-- Place this tag in your head or just before your close body tag. -->
                <script async defer src="https://buttons.github.io/buttons.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- other css/js -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
                 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
               


                <script>
                    $('.alert').delay(3000).fadeOut(300);
                </script>
                <script>
                    $('[data-fancybox="preview"]').fancybox({
                        thumbs: {
                            autoStart: true
                        }
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#datatable').DataTable();
                    });
                </script>
               
                <script>
                    $(document).ready(function() {
                        // Add active class to the current page menu item
                        var currentUrl = window.location.href;

                        $('.menu-link').each(function() {
                            var menuItemUrl = $(this).attr('href');
                            if (menuItemUrl && currentUrl.includes(menuItemUrl) && menuItemUrl !== '<?php echo base_url('admin'); ?>') {
                                $(this).closest('.menu-item').addClass('active');

                                // Open parent submenu if applicable
                                var submenu = $(this).closest('.menu-sub');
                                if (submenu.length > 0) {
                                    submenu.slideDown();
                                    submenu.closest('.menu-item').addClass('active');
                                }
                            }
                        });

                        // Toggle submenu when clicking on a menu item
                        $('.menu-toggle').click(function(e) {
                            e.preventDefault();
                            $(this).closest('.menu-item').toggleClass('active');
                            $(this).siblings('.menu-sub').slideToggle();
                        });
                    });
                </script>
                <script>
                    function toggleSidebar() {
                        const layoutMenu = document.getElementById('layout-menu');
                        layoutMenu.classList.toggle('collapsed');
                    }
                </script>
               

                </body>

                </html>