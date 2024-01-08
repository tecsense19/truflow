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
<style>
    #loginForm{
	width: 335px;
    margin: auto;
}
.form_outer{
background-color: gainsboro !important;
display: flex;
align-items: center;
justify-content: center;
width: 100%;
}
.row_margine{
	margin-top: 122px;
}

@media only screen
and (min-width: 769px)
and (max-width: 1024px)
{
    .Ajax_search{
        width:275px;
    }
}


@media only screen
and (min-width: 0px)
and (max-width: 767px)
{
.adjust_button{
	display: flex !important;
	justify-content: center !important;
}
button#add_to_cart{
margin-left: unset;
}
button#add_rows {
margin-left: unset;
}

.row_margine{
margin-top: 172px;
}
.Ajax_search{
width:180px;
margin-bottom: 6px;
}
.row.container-fluid{
display: contents;
}
.row.mobile_view{
display: contents;
}
.input_fileds{
margin-left: -8px;
}
.partner_main .owl-carousel .owl-item img{
width: unset;
}
.row.all_right {
/* display: inline-block; */
display: flex;
}

.dropdown.show {
    margin-right: 0px !important;
}

.all_rights {
    text-align: center;
}

p.footer_text {
 text-align: center;
}
.footer_contact {
    text-align: center;
}

}

@media only screen and (max-width: 991px){
    .navbar-toggler[aria-expanded="true"] span:first-child{

transform: rotate(-45deg);
    position: relative;
    top: 7.5px;

}
.navbar-toggler[aria-expanded="true"] span:nth-child(2) {
    opacity: 0;
}
.navbar-toggler span {
    display: block;
    width: 25px;
    height: 3px;
    background: #fff;
    margin: auto;
    margin-bottom: 4px;
    transition: all 400ms linear;
    cursor: pointer;
}

.navbar-toggler[aria-expanded="true"] span:last-child {
    transform: rotate(45deg);
    bottom: 6px;
    position: relative;
}
}

@media only screen
and (min-width: 320px)
and (max-width: 374px)
{
.Ajax_search {
width: 287px;
margin-bottom: 6px;
}

.all_rights {
    text-align: center;
}

p.footer_text {
 text-align: center;
}
.footer_contact {
    text-align: center;
}
}

@media only screen
and (min-width: 992px)
and (max-width: 1248px)
{
    nav.navbar.navbar-expand-lg.fixed-top{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    justify-content: flex-end;
    }
}

@media only screen
and (min-width: 766px)
and (max-width: 1023px)
{
.row.container-fluid{
	display: flex;
	justify-content: flex-end;
}
/* .row.mobile_view{
	display: contents;
} */
.dropdown.show {
    margin-right: 0px !important;
}
.partner_main .owl-carousel .owl-item img{
width: unset;
}
.col-lg-12.about{
margin-top: unset;
}
.row.all_right {
display: flex;
flex-wrap: nowrap;

/* display: contents; */
}
.img.img-fluid{
margin-left: -14px;
margin-bottom: 2px;
}
.button.navbar-toggler{
margin-right: -10px;
}
.Ajax_search {
display: flex;
padding: 0px 0px 0px 0px;
background: #F3F3F3;
border: 0;
width: 250px;
}
.dropdown, .dropup {
position: relative;
padding-right: 25px;
}

.media_icons {
display: flex;
align-items: center;
padding-right: 50px;
}
.dropdown.show {
    margin-right: 0px !important;
}
#loginForm{
    width: unset !important;
}
.quality input {
    margin: 15px 15px 15px 0;

}
.dropdown-menu1{
    width: 92%;
    max-height: 200px;
    overflow-y: auto;
}

input[type="text"] {
    border: 1px solid black;
}
textarea{
    border: 1px solid black;
}
.input_fields .input_fileds_row.input_fileds:nth-child(1) .delete-icon {
    position: relative;
    top: 41px;
    right: -12px;
}
}

/* Center the items within the carousel container */
.owl-carousel_1 {
text-align: center;
}

/* Optional: Add some spacing between the carousel items (if needed) */
.owl-carousel_1 .item {
margin: 0 10px;
}

/* Custom styles for the custom close button icon */
.navbar-toggler.active .navbar-toggler-icon {
display: none;
}

/* Create a custom close button icon using the :before pseudo-element */
.navbar-toggler.active:before {
content: '\2716'; /* Unicode character for the cross icon (✖) */
font-size: 1.5rem; /* Adjust the font size as needed */
color: #333; /* Adjust the color as needed */
margin-right: 10px; /* Adjust spacing as needed */
}

/* Show the default Bootstrap toggler icon when the menu is open */
.navbar-toggler.active.collapsed:before {
display: none;
}
/* .dropdown.show {
    margin-right: 20px;
} */

h2.breadcrumb-list > div > a {
    color: white;
}
</style>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~>> NAVBAR START <<~~~~~~~~~~~~~~~~~~~~~ -->
<nav class="navbar navbar-expand-lg fixed-top">
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <!-- <img src="<?php //echo base_url(); ?>public/uploads/Truflow_Light_Small.svg" alt="logo" class="img-fluid"> -->
                    <img src="<?php echo base_url(); ?>public/uploads/Truflow_Logo_Light.svg" style="width:125px" alt="logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
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
                <div class="search-form-main clearfix" style="margin-right: 12px;">
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
                    <!-- <a href="<?php echo base_url('wishlist') ?>" class="heart">
                        <i class="fa-regular fa-heart media_space" data-toggle="tooltip" data-placement="top" title="wish list"></i></a>

                    <?php // if (isset($wishlistCount) && $wishlistCount > 0) { ?>
                        <span class="wishlist_products_counter_number"><?php // echo $wishlistCount; ?></span>
                    <?php // } else { ?>
                        <span class="wishlist_products_counter_number">0</span>
                    <?php // } ?> -->
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

            <div class="dropdown show" style="margin-right: 20px;">
                <?php if ($session->get('logged_in') && $fullName) { ?>
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Hi, $fullName "; ?>
                    </a>
                <?php } else { ?>
                    <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                <?php } ?>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                    <?php if ($session->get('logged_in') && $fullName) { ?>
                        <a class="dropdown-item" href="<?php echo base_url('userProfile/') . $user_id ?>"><?php echo "Hi, $fullName "; ?></a>
                        <a class="dropdown-item" href="<?php echo base_url('order/') . $user_id ?>">My Orders</a>
                        <a class="dropdown-item" href="<?php echo base_url('add/cart/')?>">My Cart</a>
                        <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Logout</a>

                    <?php } else { ?>

                        <a class="dropdown-item" href="<?php echo base_url('') ?>">Login</a>
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