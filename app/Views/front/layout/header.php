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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>about">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">OUR PRODUCTS</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">CONTACT US</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
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
                        <form role="search" method="get" class="search-form" action="sitename.com/">
                            <label>
                                <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                            </label>
                            <input type="submit" class="search-submit" value="Search">
                        </form>
                    </div>
                </div>
                <!-- search  button end-->
                <div class="heart_top">
                    <a href="#" class="heart"><i class="fa-regular fa-heart media_space"></i></a>
                </div>
                <div class="heart_top2">
                    <a href="#" class="cart"><i class="fa-solid fa-cart-shopping media_space"></i></a>
                </div>
            </div>
        </div>
        <!-- container end -->
    </div>
</nav>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR END <<~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->