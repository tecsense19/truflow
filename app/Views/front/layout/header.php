<?php
// $header_id = isset($headerData) ? $headerData['header_id'] : '';
// $header_menu = isset($headerData) ? $headerData['header_menu'] : '';
// $header_sub_menu = isset($headerData) ? $headerData['header_sub_menu'] : '';
$session = session();
$fullName = $session->get('full_name');
$user_id = $session->get('user_id');
$wishlistCount = session('wishlistCount');
$cartCount = session('cartCount');
?>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR START <<~~~~~~~~~~~~~~~~~~~~~ -->
<nav class="navbar navbar-expand-lg fixed-top">
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>/public/uploads/Truflow_Light_Small.png" alt="logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <?php if (isset($headerData)) { ?>
                            <?php foreach ($headerData as $header) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() . $header['menu_link']; ?>"><?php echo $header['header_menu']; ?></a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="search-form-main clearfix">
                    <form role="search" method="POST" class="search-form" id="Ajax_search">
                        <div class="Ajax_search">
                            <div class="input-group">
                                <input type="search" class="search-field form-control" placeholder="Search …" value="" id="search" name="search">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="search-result"></div>
                    </form>
                </div>
        
        
                <div class="row mobile_view">
                <div class="media_icons">
                <div class="heart_top">
                    <a href="<?php echo base_url('wishlist') ?>" class="heart">
                        <i class="fa-regular fa-heart media_space" data-toggle="tooltip" data-placement="top" title="wish list"></i></a>

                    <?php if (isset($wishlistCount) && $wishlistCount > 0) { ?>
                        <span class="wishlist_products_counter_number"><?php echo $wishlistCount; ?></span>
                    <?php } else { ?>
                        <span class="wishlist_products_counter_number">0</span>
                    <?php } ?>
                </div>
                <div class="heart_top">
                    <a href="<?php echo base_url('add/cart') ?>" class="cart"> <i class="fa-solid fa-cart-shopping media_space" data-toggle="tooltip" data-placement="top" title="Add to Cart"></i>

                        <?php if (isset($cartCount) && $cartCount > 0) { ?>
                            <span class="add_to_cart_counter_number"><?php echo $cartCount; ?></span>
                        <?php } else { ?>
                            <span class="add_to_cart_counter_number">0</span>
                        <?php } ?>
                    </a>
                </div>
            </div>
        
                <div class="dropdown show">
                <?php if ($session->get('logged_in') && $fullName) { ?>
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Hi, $fullName "; ?>
                    </a>
                <?php } else { ?>
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                <?php } ?>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                    <?php if ($session->get('logged_in') && $fullName) { ?>
                        <a class="dropdown-item" href="<?php echo base_url('userProfile/') . $user_id ?>"><?php echo "Hi, $fullName "; ?></a>
                        <a class="dropdown-item" href="<?php echo base_url('order/') . $user_id ?>">My Order</a>
                        <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Logout</a>

                    <?php } else { ?>

                        <a class="dropdown-item" href="<?php echo base_url('login') ?>">Login</a>
                        <a class="dropdown-item" href="<?php echo base_url('register') ?>">Register</a>

                    <?php } ?>

                </div>
            </div>
        </div>

        
        <!-- </div>
        </div>
       
        </div> -->
        </nav>
        <!-- container end -->
  
    




<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->