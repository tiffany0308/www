<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);
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
$routes->get('/signup', 'Signup::new', ['filter' => 'guest']);
$routes->get('/login', 'Login::new', ['filter' => 'guest']);
$routes->get('/logout', 'Login::delete');
$routes->get('/events/search', 'Events::search');
$routes->get('events/approveEvent/(:num)', 'Events::approveEvent/$1');
$routes->get('events/unapproveEvent/(:num)', 'Events::unapproveEvent/$1');
$routes->get('events/rating/(:num)', 'Events::rating/$1');
$routes->post('events/rate/(:num)', 'Events::rate/$1');
$routes->get('/events/showVolunteerForm/(:num)', 'VolunteerController::showVolunteerForm/$1' );
$routes->post('/events/sendVolunteerEmail/(:num)', 'VolunteerController::sendVolunteerEmail/$1');
$routes->get('/events/showJoinEventForm/(:num)', 'JoinEventController::showJoinEventForm/$1' );
$routes->post('/events/sendJoinEventEmail/(:num)', 'JoinEventController::sendJoinEventEmail/$1');
$routes->get('admin/charts', 'Admin\Charts::index');

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
