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
$routes->setDefaultController('NavigationController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
    return view('404');
});
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
$routes->get('/', 'NavigationController');

/*
 *  ------------------------------------------------------------------
 *  FRONT END NAVIGATION 
 *  ------------------------------------------------------------------
 */

$routes->get('login', 'NavigationController::login');


/*
 *  ------------------------------------------------------------------
 *  BACK END NAVIGATION 
 *  ------------------------------------------------------------------
 */

$routes->get('portal/auction-dashboard', 'Portal\NavigationController::auctionDashboard');
$routes->get('portal/auction-bidders', 'Portal\NavigationController::auctionBidders');
$routes->get('portal/auction-items', 'Portal\NavigationController::auctionItems');
$routes->get('portal/auction-winners', 'Portal\NavigationController::auctionWinners');


/*
 *  ------------------------------------------------------------------
 *  BACK END FUNCTIONS 
 *  ------------------------------------------------------------------
 */

$routes->get('portal/load-bidders', 'Portal\BidderController::loadBidders');
$routes->post('portal/add-bidder', 'Portal\BidderController::addBidder');
$routes->get('portal/select-bidder', 'Portal\BidderController::selectBidder');
$routes->post('portal/edit-bidder', 'Portal\BidderController::editBidder');
$routes->post('portal/remove-bidder', 'Portal\BidderController::removeBidder');


$routes->get('portal/load-items', 'Portal\BidderController::loadBidders');
$routes->get('portal/add-item', 'Portal\BidderController::addBidder');
$routes->get('portal/select-item', 'Portal\BidderController::selectBidder');
$routes->get('portal/edit-item', 'Portal\BidderController::editBidder');
$routes->get('portal/remove-item', 'Portal\BidderController::removeBidder');


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
