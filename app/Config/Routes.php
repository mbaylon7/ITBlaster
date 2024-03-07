<?php

namespace Config;
use \App\Controllers\ContactController as Contact;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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

// Landing page routes
$routes->group('', array('filter' => 'noAuth'), static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->match(['get', 'post'], '/register', 'RegisterController::index');
    $routes->get('/signin', 'LoginController::index');
    $routes->match(['get', 'post'], 'LoginController/loginAuth', 'LoginController::loginAuth');
    $routes->post('/contact/send', array(Contact::class, 'send'));
    $routes->post('/contact/test', array(Contact::class, 'test'));
    $routes->get('/services', 'Home::itServices');
    $routes->get('/skills', 'Home::itAllSkills');
    $routes->match(['get','post'], '/forgot', 'LoginController::forgotPassword');
    $routes->match(['get','post'], 'reset-password/(:any)', 'LoginController::resetPassword/$1');
    $routes->match(['get','post'], 'register/activate/(:any)', 'RegisterController::activate/$1');
});
// Profile routes
$routes->group('', ['filter' => 'authGuard'], static function($routes) {

    $routes->group('admin', static function($routes) {
        $routes->get('/', 'AdminController::index');
        $routes->get('all-user', 'AdminController::allUsers');
        $routes->get('project-index', 'AdminController::projectIndex');
        $routes->get('all-projects', 'AdminController::allProjects');
        $routes->get('view-project/project=(:any)', 'AdminController::viewProject/$1');
        $routes->get('it-list/', 'AdminController::itProfessionalIndex');
        $routes->get('client-list/', 'AdminController::clientIndex');
        $routes->get('profile=(:any)', 'AdminController::itProfile/$1');
        $routes->post('search-personel', 'AdminController::search');
        $routes->post('search-client', 'AdminController::clientSearch');
    });

    $routes->group('it', static function($routes) {
        $routes->get('/', 'ProfileController::index');
        $routes->get('files', 'ProfileController::fetchAllFilesById');
        $routes->get('educations', 'ProfileController::fetchAllEducationById');
        $routes->get('skills', 'ProfileController::fetchAllSkillsById');
        $routes->get('experiences', 'ProfileController::fetchAllWorkExpById');
        $routes->get('completion-indicator', 'ProfileController::profileCompletionIndicator');
        $routes->post('add-skills', 'ProfileController::insertItSkills');
        $routes->post('remove-files', 'ProfileController::removeItFiles');
        $routes->post('remove-works', 'ProfileController::removeItWorkExperience');
        $routes->post('remove-educations', 'ProfileController::removeItEducationalBackGround');
        $routes->post('remove-skills', 'ProfileController::removeItSkills');
        $routes->post('update-it-introduction', 'ProfileController::updateIntroduction');
        $routes->post('update-profile', 'ProfileController::updateProfile');
        $routes->post('upload-profile', 'ProfileController::UploadProfile');
        $routes->post('upload-resume', 'ProfileController::UploadCV');
        $routes->post('remove-profile', 'ProfileController::removeProfile');
        $routes->post('educationalbackground', 'ProfileController::store_educational_background');
        $routes->post('workexperience', 'ProfileController::store_work_experience');
    });

    $routes->group('client', static function($routes) {
        $routes->get('/', 'ProfileController::client_profile_page');
        $routes->get('files', 'ClientController::fetchAllFilesById');
        $routes->get('products', 'ClientController::fetchAllProductServicesById');
        $routes->get('contacts', 'ClientController::fetchAllContactsById');
        $routes->post('add-files', 'ClientController::uploadMultipleFiles');
        $routes->post('add-products-services', 'ClientController::insertProductServices');
        $routes->post('add-contact', 'ClientController::insertContact');
        $routes->post('update-client', 'ClientController::updateClientProfile');
        $routes->post('update-introduction', 'ClientController::updateIntroduction');
        $routes->post('remove-files', 'ClientController::removeClientFile');
        $routes->post('remove-product', 'ClientController::removeClientProduct');
        $routes->post('remove-contact', 'ClientController::removeClientContact');
        $routes->post('upload-profile', 'ClientController::UploadProfile');
        $routes->post('remove-profile', 'ClientController::removeProfile');
    });

    $routes->group('project', static function($routes) {
        $routes->get('/', 'ProjectController::index');
        $routes->get('view-project/project=(:any)', 'ProjectController::viewProject/$1');
        $routes->get('view-profile/id=(:num)', 'ProjectController::viewApplicantProfile/$1');
        $routes->get('all-project', 'ProjectController::getAllData');
        $routes->get('ticket-tab-details=(:any)', 'ProjectController::ticketTabDetails/$1/$2');
        $routes->get('project-tickets=(:any)', 'ProjectController::getAllProjectTicket/$1/$2');
        $routes->post('manage-status', 'ProjectController::manageProjectStatus');
        $routes->post('assign-personel', 'ProjectController::assignPersonel');
        $routes->post('assign-developer', 'ProjectController::assignDevelopers');  
        $routes->post('hire-developer', 'ProjectController::hireDeveloper');  
        $routes->post('add-project', 'ProjectController::createProject');
        $routes->post('update-project', 'ProjectController::updateProject');
        $routes->post('remove-assigned', 'ProjectController::removeAssignedPersonel');
        
    }); 

    $routes->group('ticket', static function($routes) {
        $routes->get('/', 'TicketController::index');
        $routes->get('ticket-details/(:num)', 'ProjectController::viewTicketDetails/$1');
        $routes->get('project-ticket-details/(:num)', 'ProjectController::projectDetails/$1');
        $routes->get('get-sub-tickets/(:num)', 'TicketController::getTicketSubTasks/$1');
        $routes->get('get-ticket-history/(:any)', 'TicketController::getTicketHistory/$1');
        $routes->post('add-ticket', 'ProjectController::createTicket');
        $routes->post('add-ticket-comment', 'TicketController::addComment');
        $routes->post('attached-files-ticket', 'ProjectController::attachedFiles');
        $routes->post('manage-ticket', 'TicketController::manageTicket');
        $routes->post('apply', 'TicketController::applyEntry');
        $routes->post('approved-ticket', 'TicketController::approvedTicket');
        $routes->post('create-assign-project', 'TicketController::createAssignProject');
        $routes->post('update-ticket', 'TicketController::updateTicket');
        $routes->post('batch-approve-tickets', 'TicketController::approveAllTickets');
        $routes->get('show-project', 'TicketController::showProject');
        $routes->get('filter-open-tickets', 'TicketController::filterOpenTicketsByDev');
        $routes->get('all-open-tickets', 'TicketController::allOpenTickets');
        $routes->get('all-projects-pm', 'TicketController::listAllProjects');
        $routes->post('show-hide-project/(:any)', 'TicketController::hideShowProject/$1');
        $routes->post('upload-tickets', 'ProjectController::uploadTickets');
        $routes->get('update-multiple-ticket-status', 'TicketController::updateMultipleTicketStatus');
    });

    $routes->group('system', static function($routes) {
        $routes->get('/', 'SystemController::index');
    });
});

$routes->get('/logout', 'ProfileController::logout', array('filter' => 'authGuard'));
$routes->match(['get', 'post'], 'file/upload', 'FileUploadController::uploadMultiple');


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
