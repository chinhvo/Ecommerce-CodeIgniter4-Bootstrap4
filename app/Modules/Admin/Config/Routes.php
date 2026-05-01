<?php

namespace App\Modules\Config;

use CodeIgniter\Router\RouteCollection;
/*
|--------------------------------------------------------------------------
| Admin Controllers Routes
|--------------------------------------------------------------------------
*/

$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], function ($routes) {
	// HOME / LOGIN
	$routes->get('', 'Home\Login::index');
	$routes->get('home', 'Home\Home::index');
	$routes->get('login', 'Home\Login::index');
	$routes->post('login', 'Home\Login::index');

	// ECOMMERCE GROUP
	$routes->add('publish', 'Ecommerce\Publish::index');
	$routes->add('publish/(:num)', 'Ecommerce\Publish::index/$1');
	$routes->post('removeSecondaryImage', 'Ecommerce\Publish::removeSecondaryImage');
	$routes->get('products', 'Ecommerce\Products::index');
	$routes->get('products/(:num)', 'Ecommerce\Products::index/$1');
	$routes->post('productStatusChange', 'Ecommerce\Products::productStatusChange');
	$routes->add('shopcategories', 'Ecommerce\ShopCategories::index');
	$routes->get('shopcategories/(:num)', 'Ecommerce\ShopCategories::index/$1');
	$routes->post('shopcategories/(:num)', 'Ecommerce\ShopCategories::index/$1');
	$routes->post('editshopcategorie', 'Ecommerce\ShopCategories::editShopCategorie');
	$routes->add('orders', 'Ecommerce\Orders::index');
	$routes->get('orders/(:num)', 'Ecommerce\Orders::index/$1');
	$routes->post('changeOrdersOrderStatus', 'Ecommerce\Orders::changeOrdersOrderStatus');
	$routes->get('orders/delete/(:num)', 'Ecommerce\Orders::deleteOrder/$1');
	$routes->get('brands', 'Ecommerce\Brands::index');
	$routes->post('changePosition', 'Ecommerce\ShopCategories::changePosition');
	$routes->add('discounts', 'Ecommerce\Discounts::index');
	$routes->get('discounts/(:num)', 'Ecommerce\Discounts::index/$1');

	// BLOG GROUP
	$routes->add('blogpublish', 'Blog\BlogPublish::index');
	$routes->add('blogpublish/(:num)', 'Blog\BlogPublish::index/$1');
	$routes->get('blog', 'Blog\Blog::index');
	$routes->get('blog/(:num)', 'Blog\Blog::index/$1');

	// SETTINGS GROUP
	$routes->add('settings', 'Settings\Settings::index');
	$routes->add('styling', 'Settings\Styling::index');
	$routes->add('templates', 'Settings\Templates::index');
	$routes->add('titles', 'Settings\Titles::index');
	$routes->add('pages', 'Settings\Pages::index');
	$routes->add('emails', 'Settings\Emails::index');
	$routes->add('emails/(:num)', 'Settings\Emails::index/$1');
	$routes->get('emails/delete/(:num)', 'Settings\Emails::index/$1');
	$routes->add('contact-messages', 'Settings\ContactMessages::index');
	$routes->add('contact-messages/(:num)', 'Settings\ContactMessages::index/$1');
	$routes->add('history', 'Settings\History::index');
	$routes->add('history/(:num)', 'Settings\History::index/$1');

	// ADVANCED SETTINGS
	$routes->add('languages', 'AdvancedSettings\Languages::index');
	$routes->add('filemanager', 'AdvancedSettings\Filemanager::index');
	$routes->add('adminusers', 'AdvancedSettings\AdminUsers::index');
	$routes->add('adminusers/edit/(:num)', 'AdvancedSettings\AdminUsers::index/$1'); // optional style
	$routes->add('adminusers/save', 'AdvancedSettings\AdminUsers::save'); // optional style
	$routes->add('adminusers/delete/(:num)', 'AdvancedSettings\AdminUsers::delete/$1'); // optional style

	// TEXTUAL PAGES
	$routes->get('pageedit/(:any)', 'Textual_pages\TextualPages::pageEdit/$1');
	$routes->post('changePageStatus', 'Textual_pages\TextualPages::changePageStatus');

	// LOGOUT
	$routes->get('logout', 'Home\Home::logout');

	// Admin pass change ajax
	$routes->post('changePass', 'Home\Home::changePass');
	$routes->post('uploadOthersImages', 'Ecommerce\Publish::do_upload_others_images');
	$routes->get('loadOthersImages', 'Ecommerce\Publish::loadOthersImages');

	// SLIDERS
	$routes->get('sliders', 'Settings\Sliders::index');
	$routes->get('sliders/(:num)', 'Settings\Sliders::index/$1');
	$routes->post('sliders/save', 'Settings\Sliders::save');
	$routes->get('sliders/delete/(:num)', 'Settings\Sliders::delete/$1');

	// SHOWROOMS
	$routes->get('showrooms', 'Settings\Showrooms::index');
	$routes->get('showrooms/(:num)', 'Settings\Showrooms::index/$1');
	$routes->post('showrooms/save', 'Settings\Showrooms::save');
	$routes->add('showrooms/delete/(:num)', 'Settings\Showrooms::delete/$1');

	// VENDORS
	$routes->get('listvendors', 'Vendors\Listvendors::index');
});
