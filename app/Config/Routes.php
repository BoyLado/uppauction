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
$routes->get('forgot-password', 'NavigationController::forgotPassword');
$routes->get('change-password/(:num)/(:any)', 'NavigationController::changePassword/$1/$2');

$routes->get('contact-us', 'NavigationController::contactUs');

$routes->get('pre-registration-confirmation/(:any)', 'NavigationController::preRegistrationConfirmation/$1');

/*
 * --------------------------------------------------------------------
 * FRONT END FUNCTIONS
 * --------------------------------------------------------------------
 */
$routes->post('bidder-login', 'IndexController::login');
$routes->post('bidder-forgot-password', 'IndexController::forgotPassword');
$routes->post('bidder-change-password', 'IndexController::changePassword');
$routes->post('bidder-sign-up', 'IndexController::signUp');
$routes->get('bidder-logout', 'IndexController::logout');

////////////////////////////////////////////////////////////////////
//////////////////////// PRE REGISTRATION //////////////////////////
////////////////////////////////////////////////////////////////////

$routes->get('load-auction-dates', 'PreRegistrationController::loadAuctionDates');
$routes->post('pre-registration-with-season-pass', 'PreRegistrationController::preRegistrationWithSeasonPass');
$routes->post('pre-registration-without-season-pass', 'PreRegistrationController::preRegistrationWithoutSeasonPass');
$routes->get('confirm-pre-registration/(:any)/(:any)', 'PreRegistrationController::confirmPreRegistration/$1/$2');

/*
 *  ------------------------------------------------------------------
 *  BACK END NAVIGATION 
 *  ------------------------------------------------------------------
 */

$routes->get('portal/auction-dashboard', 'Portal\NavigationController::auctionDashboard');
$routes->get('portal/auction-bidders', 'Portal\NavigationController::auctionBidders');
$routes->get('portal/auction-items', 'Portal\NavigationController::auctionItems');
$routes->get('portal/auction-winners', 'Portal\NavigationController::auctionWinners');
$routes->get('portal/auction-payments', 'Portal\NavigationController::auctionPayments');
$routes->get('portal/auction-calendar', 'Portal\NavigationController::auctionCalendar');
$routes->get('portal/registered-bidders', 'Portal\NavigationController::registeredBidders');

//////////////////////////// MY ACCOUNT ////////////////////////////////
$routes->get('my-account', 'Portal\NavigationController::myAccount');


/*
 *  ------------------------------------------------------------------
 *  BACK END FUNCTIONS 
 *  ------------------------------------------------------------------
 */
////////////////////////////////////////////////////////////////////
//////////////////////// BIDDERS ///////////////////////////////////
////////////////////////////////////////////////////////////////////

$routes->get('portal/load-bidders', 'Portal\BidderController::loadBidders');
$routes->post('portal/add-bidder', 'Portal\BidderController::addBidder');
$routes->get('portal/select-bidder', 'Portal\BidderController::selectBidder');
$routes->post('portal/edit-bidder', 'Portal\BidderController::editBidder');
$routes->post('portal/remove-bidder', 'Portal\BidderController::removeBidder');
$routes->post('portal/check-upload-file', 'Portal\BidderController::checkUploadFile');
$routes->post('portal/upload-season-pass', 'Portal\BidderController::uploadSeasonPass');
$routes->get('portal/download-conflicts/(:any)', 'Portal\BidderController::downloadConflicts/$1');

////////////////////////////////////////////////////////////////////
//////////////////////// ITEMS /////////////////////////////////////
////////////////////////////////////////////////////////////////////

$routes->get('portal/load-winning-items', 'Portal\ItemController::loadWinningItems');
$routes->post('portal/add-item', 'Portal\ItemController::addItem');
$routes->get('portal/select-item', 'Portal\ItemController::selectItem');
$routes->post('portal/edit-item', 'Portal\ItemController::editItem');
$routes->post('portal/remove-item', 'Portal\ItemController::removeItem');

$routes->get('portal/load-list-payments', 'Portal\ItemController::listPayments');

////////////////////////////////////////////////////////////////////
//////////////////////// WINNERS /////////////////////////////////////
////////////////////////////////////////////////////////////////////

$routes->get('portal/load-winners', 'Portal\WinnerController::loadWinners');
$routes->get('portal/load-winner-items', 'Portal\WinnerController::loadWinnerItems');

////////////////////////////////////////////////////////////////////
//////////////////////// PAYMENTS //////////////////////////////////
////////////////////////////////////////////////////////////////////
$routes->get('portal/load-payments', 'Portal\PaymentController::loadPayments');
$routes->get('portal/load-payment-details', 'Portal\PaymentController::loadPaymentDetails');
$routes->post('portal/load-create-payment', 'Portal\PaymentController::createPayment');


////////////////////////////////////////////////////////////////////
//////////////////////// CALENDAR //////////////////////////////////
////////////////////////////////////////////////////////////////////
$routes->get('portal/load-auctions', 'Portal\AuctionController::loadAuctions');
$routes->post('portal/add-auction', 'Portal\AuctionController::addAuction');
$routes->get('portal/select-auction', 'Portal\AuctionController::selectAuction');
$routes->post('portal/edit-auction', 'Portal\AuctionController::editAuction');
$routes->post('portal/remove-auction', 'Portal\AuctionController::removeAuction');


////////////////////////////////////////////////////////////////////
//////////////////////// REGISTERED BIDDERS ////////////////////////
////////////////////////////////////////////////////////////////////

$routes->get('portal/load-registered-bidders', 'Portal\BidderController::loadRegisteredBidders');
$routes->get('portal/load-bidder-details', 'Portal\BidderController::loadBidderDetails');



/////////////////////////////////////////////////////////////////////
//////////////////////////// MY ACCOUNT /////////////////////////////
/////////////////////////////////////////////////////////////////////

$routes->get('load-my-account', 'Portal\MyAccountController::loadMyAccount');
$routes->post('change-my-account-picture', 'Portal\MyAccountController::changeMyAccountPicture');
$routes->get('load-my-account-details', 'Portal\MyAccountController::loadMyAccountDetails');
$routes->post('edit-my-account-details', 'Portal\MyAccountController::editMyAccountDetails');
$routes->post('edit-my-account-password', 'Portal\MyAccountController::editMyAccountPassword');


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
