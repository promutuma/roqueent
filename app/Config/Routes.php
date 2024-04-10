<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// auth files/routes
$routes->get('/', 'Home::index', ['filter' => 'noauth']);
$routes->get('html/pages/auths/auth-login-v2.html', 'Home::index', ['filter' => 'noauth']);
$routes->get('html/user-session-close.html', 'Home::logout');
$routes->post('html/user-access-login.html', 'Home::login', ['filter' => 'noauth']);
$routes->post('/html/pages/auths/auth-request-password-reset-v2.html', 'Home::resetPasscode', ['filter' => 'noauth']);
$routes->post('html/pages/auths/user-update-password-v2.html', 'Home::setPasscode', ['filter' => 'noauth']);
$routes->get('/html/pages/auths/auth-check-password-reset-v2.html/(:any)', 'Home::changePasscode/$1', ['filter' => 'noauth']);

//home routes
$routes->get('html/index.html', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/html/user-profile-regular.html', 'Dashboard::myAccount', ['filter' => 'auth']);
$routes->get('/html/user-profile-notification.html', 'Dashboard::myAccountNotification', ['filter' => 'auth']);
$routes->get('/html/user-profile-setting.html', 'Dashboard::myAccountSettings', ['filter' => 'auth']);
$routes->get('/html/user-profile-activity.html', 'Dashboard::myAccountActivity', ['filter' => 'auth']);
$routes->get('/html/user-profile-social.html', 'Dashboard::myAccountSocial', ['filter' => 'auth']);

//users routes
$routes->get('html/user-list-regular.html', 'User::index', ['filter' => 'auth']);
$routes->post('/html/user-add-user.html', 'User::addUser', ['filter' => 'auth']);


//product
$routes->get('/html/product-list.html', 'Product::index', ['filter' => 'auth']);
$routes->post('/html/product-add.html', 'Product::addProduct', ['filter' => 'auth']);
$routes->post(' html/product-update.html', 'Product::updateProduct', ['filter' => 'auth']);
$routes->post('/html/category-add.html', 'Product::addCategory', ['filter' => 'auth']);
$routes->post('/html/product-add-stock.html', 'Product::addStock', ['filter' => 'auth']);
$routes->get('/html/product-find.html/(:any)', 'Product::findProduct/$1', ['filter' => 'auth']);
$routes->get('/html/product-delete.html/(:any)', 'Product::deleteProduct/$1', ['filter' => 'auth']);

//Sales
$routes->get('/html/sales-list.html', 'Sales::index', ['filter' => 'auth']);
$routes->get('/html/sales-new.html', 'Sales::newSale', ['filter' => 'auth']);
$routes->get('/html/sales-new.html/(:any)', 'Sales::sale/$1', ['filter' => 'auth']);
$routes->get('/html/sales-add-item.html/(:any)', 'Sales::addSaleItem/$1', ['filter' => 'auth']);
$routes->get('/html/item-get-item.html/(:any)', 'Sales::getItem/$1', ['filter' => 'auth']);
$routes->get('/html/item-sale-id-remove.html/(:any)', 'Sales::removeItem/$1', ['filter' => 'auth']);
$routes->get('/html/sales-get-payment.html/(:any)', 'Sales::getPayment/$1', ['filter' => 'auth']);
$routes->post('/html/sales-add-item-cart.html', 'Sales::addCart', ['filter' => 'auth']);
$routes->post('/html/sales-quantity-change.html', 'Sales::quantityChange', ['filter' => 'auth']);
$routes->post('/html/sales-add-payment.html', 'Sales::addPayment', ['filter' => 'auth']);
$routes->post('/html/sale-save-new-order.html', 'Sales::saveNewSale', ['filter' => 'auth']);


//Expense
$routes->get('/html/expense-list.html', 'Expense::index', ['filter' => 'auth']);
$routes->get('/html/expense-get-item.html/(:any)/(:any)', 'Expense::expenseGet/$1/$2', ['filter' => 'auth']);
$routes->get('/html/expense-remove-item.html/(:any)', 'Expense::removeExpense/$1', ['filter' => 'auth']);
$routes->post('/html/expense-add-item.html', 'Expense::addExpense', ['filter' => 'auth']);
$routes->post('/html/expense-edit-item.html', 'Expense::editExpense', ['filter' => 'auth']);
