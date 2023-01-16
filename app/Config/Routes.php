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
$routes->setDefaultController('Pages');
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
$routes->get('/', 'Pages::index');

$routes->get('/logout', 'Users::logout');
$routes->match(['get','post'],'/login', 'Users::login');
$routes->match(['get','post'],'/register', 'Users::register');
$routes->match(['get','post'],'/editProfile', 'Users::editProfile');
$routes->match(['get','post'],'/checkCredential', 'Users::userConfirm');
$routes->match(['get','post'],'/changePassword/(:num)', 'Users::resetPassword/$1');
$routes->get('/dashboard', 'Users::dashboard');
$routes->get('/profile', 'Users::profile');
$routes->get('/userList', 'Users::userList/');
$routes->get('/userDetail/(:num)', 'Users::viewUser/$1');

$routes->match(['get','post'],'/companyRegistration', 'Company::addCompany');
$routes->match(['get','post'],'/companyDetail/(:num)', 'Company::editCompany/$1');
$routes->get('/companyDashboard/(:num)', 'Company::viewCompany/$1');
$routes->get('/companyList', 'Company::companyList/');
$routes->get('/acceptCompany/(:num)', 'Company::acceptCompany/$1');
$routes->get('/rejectCompany/(:num)', 'Company::rejectCompany/$1');
$routes->get('/deleteCompany/(:num)', 'Company::deleteCompany/$1');
$routes->get('/companyAnalytics/(:num)', 'Company::companyAnal/$1');

$routes->match(['get','post'],'/staffRegistration/(:num)', 'Staff::addStaff/$1');
$routes->match(['get','post'],'/editStaff/(:num)', 'Staff::editStaff/$1');
$routes->get('/staffDetail/(:num)', 'Staff::viewStaff/$1');
$routes->get('/staffDeactivation/(:num)', 'Staff::deleteStaff/$1');

$routes->match(['get','post'],'/addCategory', 'Category::addCategory');
$routes->match(['get','post'],'/editCategory/(:num)', 'Category::editCategory/$1');
$routes->get('/deleteCategory/(:num)', 'Category::deleteCategory/$1');

$routes->match(['get','post'],'/addService/(:num)', 'Service::addService/$1');
$routes->match(['get','post'],'/editService/(:num)', 'Service::editService/$1');
$routes->get('/serviceList', 'Service::serviceList');
$routes->get('/serviceDetail/(:num)', 'Service::viewService/$1');
$routes->get('/deleteService/(:num)', 'Service::deleteService/$1');

$routes->match(['get','post'],'/addSchedule/(:num)', 'Schedule::addSchedule/$1');
$routes->match(['get','post'],'/editDate/(:num)', 'Schedule::editDate/$1');
$routes->get('/scheduleDetail/(:num)', 'Schedule::viewSchedule/$1');
$routes->get('/deleteSchedule/(:num)', 'Schedule::deleteSchedule/$1');
$routes->get('/timeDetail/(:num)', 'Schedule::viewTime/$1');
$routes->get('/deleteTime/(:num)', 'Schedule::deleteTime/$1');
$routes->match(['get','post'],'/addTime/(:num)', 'Schedule::addTime/$1');
$routes->match(['get','post'],'/editTime/(:num)', 'Schedule::editTime/$1');

$routes->get('/setAppointment/(:num)', 'Apt::addApt/$1');
$routes->get('/setApt/(:num)', 'Apt::setApt/$1');
$routes->get('/aptDetail/(:num)', 'Apt::viewApt/$1');
$routes->get('/cancelApt/(:num)', 'Apt::cancelApt/$1');
$routes->get('/finishApt/(:num)', 'Apt::finishApt/$1');
$routes->get('/monthlyAnalytics/(:num)', 'Apt::aptRecord/$1');

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
