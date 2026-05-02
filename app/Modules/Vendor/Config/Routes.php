<?php

namespace App\Modules\Config;
use CodeIgniter\Router\RouteCollection;
/*
|--------------------------------------------------------------------------
| Admin Controllers Routes
|--------------------------------------------------------------------------
*/
$routes->group('vendor', ['namespace' => 'App\Modules\Verndor\Controllers'], function($routes) {    
    $routes->get('/', 'Auth::login');
    $routes->get('login', 'Auth::login');
    $routes->get('{locale}/login', 'Auth::login');
    
    $routes->get('register', 'Auth::register');
    $routes->get('{locale}/register', 'Auth::register');
    
    $routes->get('forgotten-password', 'Auth::forgotten');
    $routes->get('{locale}/forgotten-password', 'Auth::forgotten');
    
    $routes->get('me', 'VendorProfile::index');
    $routes->get('{locale}/me', 'VendorProfile::index');
    
    $routes->get('logout', 'VendorProfile::logout');
    $routes->get('{locale}/logout', 'VendorProfile::logout');
    
    $routes->get('products', 'Products::index');
    $routes->get('{locale}/products', 'Products::index');
    
    $routes->get('products/(:num)', 'Products::index/$1');
    $routes->get('{locale}/products/(:num)', 'Products::index/$2');
    
    $routes->get('add/product', 'AddProduct::index');
    $routes->get('{locale}/add/product', 'AddProduct::index');
    
    $routes->get('edit/product/(:num)', 'AddProduct::index/$1');
    $routes->get('{locale}/edit/product/(:num)', 'AddProduct::index/$1');
    
    $routes->get('orders', 'Orders::index');
    $routes->get('{locale}/orders', 'Orders::index');
    
    // Uploading and image actions
    $routes->post('uploadOthersImages', 'AddProduct::do_upload_others_images');
    $routes->get('loadOthersImages', 'AddProduct::loadOthersImages');
    $routes->post('removeSecondaryImage', 'AddProduct::removeSecondaryImage');
    
    $routes->get('delete/product/(:num)', 'Products::deleteProduct/$1');
    $routes->get('{locale}/delete/product/(:num)', 'Products::deleteProduct/$1');
    
    // Vendor public view
    $routes->get('view/(:any)', 'Vendor::index/0/$1');
    $routes->get('{locale}/view/(:any)', 'Vendor::index/0/$2');
    
    $routes->get('view/(:any)/(:num)', 'Vendor::index/$2/$1');
    $routes->get('{locale}/view/(:any)/(:num)', 'Vendor::index/$3/$2');
    
    // Vendor products detailed view
    $routes->get('(:any)/(:any)_(:num)', 'Vendor::viewProduct/$1/$3');
    $routes->get('{locale}/(:any)/(:any)_(:num)', 'Vendor::viewProduct/$2/$4');
    
    // Change order status
    $routes->post('changeOrderStatus', 'Orders::changeOrdersOrderStatus');
});