<?php 
// $header_id = isset($headerData) ? $headerData['header_id'] : '';
// $header_menu = isset($headerData) ? $headerData['header_menu'] : '';
// $header_sub_menu = isset($headerData) ? $headerData['header_sub_menu'] : '';
$session = session();
$fullName = $session->get('full_name');

?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR START <<~~~~~~~~~~~~~~~~~~~~~ -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>/public/front/images/logo.png" alt="logo" class="img-fluid">
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
                    <a class="nav-link" href="<?php echo base_url().$header['menu_link']; ?>"><?php echo $header['header_menu'];?></a>
                </li>
                <?php } ?>
                        <?php } ?>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">CONTACT US</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li> -->
            </ul>
            <div class="media_icons">
                <a class="button1" href="#">
                    <span><i class="fa-brands fa-facebook-f"></i></span>
                </a>
                <a class="button1 button2" href="#">
                    <span><i class="fa-brands fa-instagram"></i></span>
                </a>
                <div class="header-search-wrapper media_space">
                    <!-- search button -->
                    <span class="search-main">
                        <i class="fa fa-search"></i>
                    </span>
                    <div class="search-form-main clearfix">
                        <form role="search" method="POST" class="search-form" id="Ajax_search">
                        <div class="Ajax_search">
                        <label>
                                <input type="search" class="search-field" placeholder="Search …" value="" id="search" name="search">
                            </label>
                            <input type="button" class="btn btn-primary search_submit" value="search" onclick="searchProduct()">
                        </div>   
                        
                            <div id="search-result"></div>
                        </form>
                    </div>
                </div>
                <!-- search  button end-->
                <div class="heart_top">
                    <a href="#" class="heart"><i class="fa-regular fa-heart media_space"></i></a>
                </div>
                <div class="heart_top2">
                    <a href="<?php echo base_url('add_to_cart')?>" class="cart"><i class="fa-solid fa-cart-shopping media_space"></i></a>
                </div>
                <?php
                if ($session->get('logged_in') && $fullName) { ?>

                    <div class="heart_top5 media_space">
                    <?php echo "Hi, $fullName "; ?>
                    </div>

                    <div class="heart_top4 media_space">
                    <a href="<?php echo base_url('logout')?>" class="login_user">Logout</a>
                </div>
                
                <?php }else {?>
                    
                <div class="heart_top3 media_space">
                <a href="<?php echo base_url('register')?>" class="register_user">Register</a>
                </div>
                <div class="heart_top4 media_space">
                    <a href="<?php echo base_url('login')?>" class="login_user">Login</a>
                </div>
                    
                <?php }?>
            </div>
        </div>
        <!-- container end -->
    </div>
</nav>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

