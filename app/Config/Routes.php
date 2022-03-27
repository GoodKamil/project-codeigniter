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

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->match(['get', 'post'], 'Transfer', 'User\UserController::Transfer');
    $routes->add('dashboard', 'User\UserController::index');
});

$routes->group('', ['filter' => 'noauth'], function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->match(['get', 'post'], 'LoginUser', 'AuthController::LoginUser');
    $routes->match(['get', 'post'], 'createAccount', 'AuthController::createAccount');
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
