<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/shop', 'Home::shop');
$routes->get('/sub_category/(:num)', 'Home::sub_category/$1');
$routes->get('/product/(:num)', 'Home::product/$1');
$routes->get('/product_details/(:num)', 'Home::product_details/$1');
$routes->post('/searchData', 'Home::searchData');
$routes->get('/add_to_cart', 'Home::add_to_cart');
$routes->post('/add_cart', 'Home::add_cart');
$routes->get("delete/(:num)", "Home::cartDelete/$1");
$routes->post('/add_to_cart_new', 'Home::add_to_cart_new');
$routes->post('/searchData1', 'Home::searchData1');
$routes->get('/wish_list', 'Home::wish_list');
$routes->post('/add_wishlist', 'Home::add_wishlist');
$routes->post('/deleteWishList', 'Home::deleteWishList');
$routes->get("deleteWishList_data/(:num)", "Home::deleteWishList_data/$1");


//register user
$routes->get('/register', 'UserController::register');
$routes->post("register/save", "UserController::registerSave");

//login user
$routes->get('/login', 'UserController::login');
$routes->post("check/login", "UserController::checkLogin");
$routes->get("logout", "UserController::logout");

//order placed
$routes->get("checkout/", "OrderController::checkout");



$routes->group("admin", ["namespace" => "App\Controllers\Admin"], function($routes){
    // URL - /admin
    $routes->get("/", "Home::index");
    $routes->post("check/login", "Home::checkLogin");
    $routes->get("dashboard", "Home::dashboard", ['filter' => 'auth']);
    $routes->get("logout", "Home::logout");

    // add header part dynamic menu

    $routes->get("header_menu_list", "headerMenuController::index");
    $routes->get("header_menu", "headerMenuController::header_menu");
    $routes->post("header_menu/save", "headerMenuController::header_menuSave");
    $routes->get("header_menu/edit/(:num)", "headerMenuController::header_menuEdit/$1");
    $routes->get("header_menu/delete/(:num)", "headerMenuController::header_menuDelete/$1");


    //settings

    $routes->get("settings", "SettingsController::settings");
    $routes->post("settings/save", "SettingsController::settingsSave");

    //Testominal

    $routes->get("testominal_list", "TestominalController::index");
    $routes->get("testominal", "TestominalController::testominal");
    $routes->post("testominal/save", "TestominalController::testominalSave");
    $routes->get("edit/(:num)", "TestominalController::testominalEdit/$1");
    $routes->get("delete/(:num)", "TestominalController::testominalDelete/$1");

    //Category

    $routes->get("category_list", "CategoryController::index");
    $routes->get("category", "CategoryController::category");
    $routes->post("category/save", "CategoryController::categorySave");
    $routes->get("category/edit/(:num)", "CategoryController::categoryEdit/$1");
    $routes->get("category/delete/(:num)", "CategoryController::categoryDelete/$1");

    //Sub Category

    $routes->get("sub_category_list", "SubCategoryController::index");
    $routes->get("sub_category", "SubCategoryController::sub_category");
    $routes->post("sub_category/save", "SubCategoryController::sub_categorySave");
    $routes->get("sub_category/edit/(:num)", "SubCategoryController::sub_categoryEdit/$1");
    $routes->get("sub_category/delete/(:num)", "SubCategoryController::sub_categoryDelete/$1");


   //Product

    $routes->get("product_list", "ProductController::index");
    $routes->get("product", "ProductController::product");
    $routes->post("product/save", "ProductController::productSave");
    $routes->get("product/edit/(:num)", "ProductController::productEdit/$1");
    $routes->get("product/delete/(:num)", "ProductController::productDelete/$1");
    $routes->post('get_subcategories/(:num)', 'ProductController::getSubcategories/$1');
    $routes->get("variant/delete/(:num)", "ProductController::variantDelete/$1");



});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
