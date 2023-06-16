
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?php echo base_url('admin'); ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
            
                  
                <img src="<?php echo base_url(); ?>/public/uploads/TruflowLogoDark.png" alt="logo" width="60px" class="img-fluid">
               
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Truflow-Hydarulics</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        
        <li class="menu-item">
            <a href="<?php echo base_url('admin'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/user'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div data-i18n="Basic">User</div>
            </a>
        </li>
     
        <li class="menu-item">
            <a href="<?php echo base_url('admin/category_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-category"></i>
                <div data-i18n="Basic">Category</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/sub_category_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-category-alt"></i>
                <div data-i18n="Basic">Sub Category</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/product_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Product</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/order_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cart"></i>
                <div data-i18n="Basic">Order</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/country_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Basic">Country</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo base_url('admin/coupon_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-discount"></i>
                <div data-i18n="Basic">coupon</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Form Elements">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo base_url('admin/settings'); ?>" class="menu-link">
                        <div data-i18n="Basic Inputs">Front Site Settings</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('admin/header_menu_list'); ?>" class="menu-link">
                        <div data-i18n="Basic Inputs">Header Menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('admin/testominal_list'); ?>" class="menu-link">
                        <div data-i18n="Input groups">Testimonial</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="<?php echo base_url('admin/contactus_list'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">User Contect Us</div>
            </a>
        </li>


    </ul>
</aside>

<!-- / Menu -->
<!-- Layout container -->
<div class="layout-page">
