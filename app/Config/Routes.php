<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Load default conrtoller when have only currency from multilanguage
$routes->get('^(\w{2})$', 'Home::index', ['filter' => 'setlocale']);

//Checkout
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout', 'Checkout::index');
$routes->get('checkout/successcash', 'Checkout::successPaymentCashOnD');
$routes->get('checkout/successbank', 'Checkout::successPaymentBank');
$routes->get('checkout/paypalpayment', 'Checkout::paypalPayment');
$routes->get('checkout/order-error', 'Checkout::orderError');
$routes->get('^(\w{2})$/checkout', 'Checkout::index');
$routes->post('^(\w{2})$/checkout', 'Checkout::index');
$routes->get('^(\w{2})$/checkout/successcash', 'Checkout::successPaymentCashOnD');
$routes->get('^(\w{2})$/checkout/successbank', 'Checkout::successPaymentBank');
$routes->get('^(\w{2})$/checkout/paypalpayment', 'Checkout::paypalPayment');
$routes->get('^(\w{2})$/checkout/order-error', 'Checkout::orderError');

// Ajax called. Functions for managing shopping cart
$routes->post('manageShoppingCart', 'Home::manageShoppingCart');
$routes->post('^(\w{2})$/manageShoppingCart', 'Home::manageShoppingCart');

$routes->post('clearShoppingCart', 'Home::clearShoppingCart');
$routes->post('^(\w{2})$/clearShoppingCart', 'Home::clearShoppingCart');

$routes->get('removeFromCart', 'Home::removeFromCart');
$routes->get('home/removeFromCart', 'Home::removeFromCart');
$routes->get('^(\w{2})$/removeFromCart', 'Home::removeFromCart');
$routes->get('^(\w{2})$/home/removeFromCart', 'Home::removeFromCart');

$routes->post('discountCodeChecker', 'Home::discountCodeChecker');
$routes->post('^(\w{2})$/discountCodeChecker', 'Home::discountCodeChecker');

// Home page pagination
$routes->get('home/(:num)', 'Home::index/$1');

// Load javascript language file
$routes->get('loadlanguage/(:any)', 'Loader::jsFile/$1');

// Load default-gradient css
$routes->get('cssloader/(:any)', 'Loader::cssStyle');

// Template Routes
$routes->get('template/imgs/(:any)', 'Loader::templateCssImage/$1');
$routes->get('templatecss/imgs/(:any)', 'Loader::templateCssImage/$1');
$routes->get('templatecss/(:any)', 'Loader::templateCss/$1');
$routes->get('templatejs/(:any)', 'Loader::templateJs/$1');

// Products URL style
$routes->get('product/([a-z0-9-]+)', 'Product::viewProductBySlug/$1');
$routes->get('^(\w{2})$/product/([a-z0-9-]+)', 'Product::viewProductBySlug/$2');
$routes->get('product/(:any)_(:num)', 'Product::viewProduct/$2');
$routes->get('^(\w{2})$/product/(:any)_(:num)', 'Product::viewProduct/$3');
$routes->get('(:any)_(:num)', 'Product::viewProduct/$2');
$routes->get('^(\w{2})$/(:any)_(:num)', 'Product::viewProduct/$3');
$routes->get('shop-product_(:num)', 'Product::viewProduct/$3');

// Blog URL style and pagination
$routes->get('blog', 'Blog::index');
$routes->get('^(\w{2})$/blog', 'Blog::index');
$routes->get('blog/(:num)', 'Blog::index/$1');
$routes->get('blog/(:any)_(:num)', 'Blog::viewPost/$2');
$routes->get('^(\w{2})$/blog/(:any)_(:num)', 'Blog::viewPost/$3');
$routes->get('blog/(:segment)', 'Blog::viewPostBySlug/$1');
$routes->get('^(\w{2})$/blog/(:segment)', 'Blog::viewPostBySlug/$2');

// Shopping cart page
$routes->get('shopping-cart', 'ShoppingCartPage::index');
$routes->get('^(\w{2})$/shopping-cart', 'ShoppingCartPage::index');

// Shop page (greenlabel template)
$routes->get('shop', 'Home::shop');
$routes->get('^(\w{2})$/shop', 'Home::shop');

// Contacts page
$routes->get('contacts', 'Contacts::index');
$routes->post('contacts', 'Contacts::index');
$routes->get('^(\w{2})$/contacts', 'Contacts::index');
$routes->post('^(\w{2})$/contacts', 'Contacts::index');

// Textual Pages links
$routes->get('page/(:any)', 'Page::index/$1');
$routes->get('^(\w{2})$/page/(:any)', 'Page::index/$2');

// Login Public Users Page
$routes->get('login', 'Users::login');
$routes->get('^(\w{2})$/login', 'Users::login');

// Register Public Users Page
$routes->get('register', 'Users::register');
$routes->get('^(\w{2})$/register', 'Users::register');

// Users Profiles Public Users Page
$routes->get('myaccount', 'Users::myaccount');
$routes->get('myaccount/(:num)', 'Users::myaccount/$1');
$routes->get('^(\w{2})$/myaccount', 'Users::myaccount');
$routes->get('^(\w{2})$/myaccount/(:num)', 'Users::myaccount/$2');

// Logout Profiles Public Users Page
$routes->get('logout', 'Users::logout');
$routes->get('^(\w{2})$/logout', 'Users::logout');

// Sitemap & platform
$routes->get('sitemap.xml', 'Home::sitemap');
$routes->get('kirilkirkov-ecommerce-ci-bs3-platform', 'Home::platform');

// Confirm link
$routes->get('confirm/(:any)', 'Home::confirmLink/$1');

/*
 * Vendor Controllers Routes
 */

if (file_exists(APPPATH . 'Modules/Vendor/Config/Routes.php')) {
    require APPPATH . 'Modules/Vendor/Config/Routes.php';
}

// -------------------------
// Site Multilanguage
// -------------------------
//$routes->add('^(\w{2})$/(.*)', '$1'); // Locale placeholder for multilanguage

/*
|--------------------------------------------------------------------------
| Admin Controllers Routes
|--------------------------------------------------------------------------
*/
if (file_exists(APPPATH . 'Modules/Admin/Config/Routes.php')) {
    require APPPATH . 'Modules/Admin/Config/Routes.php';
}

/*
|--------------------------------------------------------------------------
| REST API Routes
|--------------------------------------------------------------------------
*/
$routes->get('api/products/(:alpha)/get', 'Api\Products::all/$1');
$routes->get('api/product/(:alpha)/(:num)/get', 'Api\Products::one/$1/$2');
$routes->post('api/product/set', 'Api\Products::set');
$routes->delete('api/product/(:alpha)/delete', 'Api\Products::productDel/$1');

// Product slug URLs (must stay below module routes so /admin, /vendor, etc. match first)
$routes->get('([a-z0-9-]+)', 'Product::viewProductBySlug/$1');
$routes->get('^(\w{2})$/([a-z0-9-]+)', 'Product::viewProductBySlug/$2');

// Error & translation settings
$routes->set404Override();
$routes->setTranslateURIDashes(false);
