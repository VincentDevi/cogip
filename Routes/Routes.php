<?php

namespace App\Routes;


use App\Controllers\DashboardHomeController;
use Bramus\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\NotFoundController;
use App\Controllers\CompaniesController;
use App\Controllers\ContactsController;
use App\Controllers\InvoicesController;
use App\Controllers\CompanyController;
use App\Controllers\ContactController;

use App\models\getDbData;

$router = new Router();

//$router->setBasePath('/');


$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    (new NotFoundController)->index();
});

$router->get('/', function() {
//   echo 'home';
 (new HomeController)->index();
});

$router->get('companies', function() {
    (new CompaniesController)->index();
 //   echo 'companies';
});

$router->get('/contacts', function() {
////    echo 'contacts';
    (new ContactsController())->index();
});

$router->get('/invoices', function() {
//    echo 'invoices';
    (new InvoicesController())->index();
});
//$router->get('/contact', function() {
////    echo 'contacts';
//    (new ContactController())->index();
//});
$router->get('/contact/([0-9]+)', function($name) {
    // get data's from DB here and pass it to index function

    (new ContactController())->index($name);
});
//$router->get('company', function() {
  //  (new CompanyController())->index();
    //   echo 'companies';
//});
$router->get('/company/([0-9]+)', function($name) {
    // get data's from DB here and pass it to index function

        (new CompanyController())->index($name);
});
$router->get('/dashboard', function() {
//    echo 'invoices';
    (new DashboardHomeController())->index();
});
$router->run();


