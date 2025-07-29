<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->setAutoRoute(true); // Mengaktifkan rute otomatis

 $routes->get('/', 'Home::index');
 $routes->get('home', 'Home::index');
 $routes->get('products', 'Home::products');

//  home product
 $routes->get('product/category/(:num)', 'Home::filterByCategory/$1');
 $routes->get('category/(:num)', 'Home::productByCategory/$1');

//  cart
 $routes->post('/add-to-cart', 'CartController::addToCart');
 $routes->get('/cart', 'CartController::viewCart');
 $routes->post('/cart/update', 'CartController::updateQuantity');
 $routes->get('/cart/remove/(:num)', 'CartController::removeFromCart/$1');


//  Transaction
$routes->get ( '/checkout', 'TransactionController::showCheckout');
$routes->post('/checkout/process', 'TransactionController::processCheckout');
$routes->get('/thank-you', 'TransactionController::thankYou');
$routes->get('/invoice/(:num)', 'TransactionController::invoice/$1');

// Profile
$routes->get('/profile', 'UserController::profile');
$routes->post('/profile/update', 'UserController::updateProfile');

// riwayat transaksi
$routes->get('/my_orders', 'TransactionController::myOrders');
$routes->get('/my_orders/detail/(:num)', 'TransactionController::orderDetail/$1'); // detail transaksi


// single product
 $routes->get('single_product/(:num)', 'Home::single_product/$1');

 $routes->get('contact', 'Home::contact');
 $routes->get('about', 'Home::about');

//  login 
 $routes->get('/login', 'Auth::loginForm');
 $routes->post('/login', 'Auth::login');
 $routes->get('dashboard', 'Dashboard::index');
 $routes->get('/logout', 'Auth::logout');

//  register
$routes->get('/register', 'Auth::registerForm');
$routes->post('/register', 'Auth::register');


//  admin categori
 $routes->get('/categories', 'CategoryController::index');
$routes->get('/categories/add/(:num)', 'CategoryController::create/$1'); // Tambah sub-kategori
$routes->get('/categories/add', 'CategoryController::create'); // Tambah kategori utama
$routes->post('/categories/store', 'CategoryController::store');
$routes->get('/categories/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('/categories/update/(:num)', 'CategoryController::update/$1');
$routes->put('categories/update/(:num)', 'CategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'CategoryController::delete/$1');
$routes->get('/categories/sub/(:num)', 'CategoryController::sub/$1'); // Lihat sub-kategori

// admin sub-category
$routes->get('/sub-categories/(:num)', 'SubCategoryController::index/$1');
$routes->post('/sub-categories/store', 'SubCategoryController::store');
$routes->get('/sub-categories/edit/(:num)', 'SubCategoryController::edit/$1');
$routes->post('/sub-categories/update/(:num)', 'SubCategoryController::update/$1');
$routes->get('/sub-categories/delete/(:num)', 'SubCategoryController::delete/$1');

// admin product
$routes->get('/d_products', 'ProductController::index');
$routes->get('d_products/getSubCategories', 'ProductController::getSubCategories');
$routes->match(['get', 'post'], 'd_products/getSubCategories', 'ProductController::getSubCategories');
$routes->get('/d_products/add', 'ProductController::create');
$routes->post('/d_products/store', 'ProductController::store');
$routes->get('/d_products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/d_products/update/(:num)', 'ProductController::update/$1');
$routes->put('d_products/update/(:num)', 'ProductController::update/$1');
$routes->get('d_products/delete/(:num)', 'ProductController::delete/$1');

// admin transaction
$routes->get('admin/transactions', 'DataTransaction::index');
$routes->get('admin/transactions/edit/(:num)', 'DataTransaction::edit/$1');
$routes->post('admin/transactions/update/(:num)', 'DataTransaction::update/$1');
$routes->get('admin/transactions/invoice/(:num)', 'DataTransaction::invoice/$1');
$routes->post('transaction/sendInvoice/(:num)', 'DataTransaction::sendInvoice/$1');
$routes->get('/invoice/pdf/(:num)', 'DataTransaction::generatePdf/$1');

// admin laporan pemasukan
$routes->get('admin/laporan/pemasukan', 'ReportController::pemasukan');
$routes->get('admin/laporan/print-pdf', 'ReportController::printPdf');



// admin profile
$routes->get('/admin-profile', 'DataAdmin::index');
$routes->post('/admin-profile/update', 'DataAdmin::updateProfile');

// admin edit title
$routes->get('/title', 'TitleController::index');
$routes->get('/title/edit/(:num)', 'TitleController::edit/$1');
$routes->post('/title/update/(:num)', 'TitleController::update/$1');