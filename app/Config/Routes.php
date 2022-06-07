<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// $routes->match(['get', 'post'], 'LoginUser', 'AuthController::LoginUser');
$routes->get('Logout', 'AuthController::Logout');
// $routes->match(['get', 'post'], 'createAccount', 'AuthController::createAccount');

$routes->group('', ['filter' => 'auth', 'filter' => 'permissionuser'], function ($routes) {
    $routes->match(['get', 'post'], 'Transfer', 'User\UserController::Transfer');
    $routes->match(['get', 'post'], 'Settings', 'User\UserController::Settings');
    $routes->match(['get', 'post'], 'editUser', 'User\UserController::editUser');
    $routes->post('TransferBank', 'User\UserController::TransferBank');
    $routes->get('viewHistory', 'User\UserController::viewHistory');
    $routes->get('viewHistoryOne/(:num)', 'User\UserController::viewHistoryOne/$1');
    $routes->add('dashboard', 'User\UserController::index');
    $routes->get('HomeUser', 'User\UserController::HomeUser');
    $routes->get('addAccount', 'User\UserController::addAccount');
    $routes->get('ajaxAccount', 'User\UserController::ajaxAccount');
    $routes->add('ownTransfer', 'User\UserController::ownTransfer');
    $routes->add('reportProblem', 'User\UserController::reportProblem');
    $routes->get('messagesUser', 'User\UserController::messagesUser');
    $routes->get('viewMessageUser/(:num)', 'User\UserController::viewMessageUser/$1');
    $routes->get('ajaxSearch', 'User\UserController::ajaxSearch');
    $routes->get('ajaxSearchMessages', 'User\UserController::ajaxSearchMessages');
    $routes->get('GetUserIDAjax', 'User\UserController::GetUserIDAjax');
});

$routes->group('', ['filter' => 'noauth'], function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->match(['get', 'post'], 'LoginUser', 'AuthController::LoginUser');
    $routes->match(['get', 'post'], 'createAccount', 'AuthController::createAccount');
    $routes->match(['get', 'post'], 'recoverPassword', 'AuthController::recoverPassword');
    $routes->get('recoverChangePassword/(:any)/(:any)', 'AuthController::recoverChangePassword/$1/$2');
    $routes->post('doRecoverChangePassword', 'AuthController::doRecoverChangePassword');
    $routes->get('activeAccount/(:any)/(:any)', 'AuthController::activeAccount/$1/$2');
});

$routes->group('', ['filter' => 'auth', 'filter' => 'permissionemployee'], function ($routes) {
    $routes->get('messages', 'Employee\EmployeeController::messages');
    $routes->match(['get', 'post'], 'viewMessage/(:num)', 'Employee\EmployeeController::viewMessage/$1');
});

$routes->group('', ['filter' => 'auth', 'filter' => 'permissionadmin'], function ($routes) {
    $routes->match(['get', 'post'], 'viewGroup', 'Admin\AdminController::index');
    $routes->get('blockUser/(:num)/(:any)', 'Admin\AdminController::blockUser/$1/$2');
    $routes->match(['get', 'post'], 'addEmployee', 'Admin\AdminController::addEmployee');
    $routes->get('getListGroups', 'Admin\AdminController::getListGroups');
});

// $routes->group('User', function ($routes) {
//     $routes->match(['get', 'post'], 'Transfer', 'User\UserController::Transfer', ['filter' => 'auth']);
// });


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
