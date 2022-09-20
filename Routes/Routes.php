<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\NotFoundController;
use App\Controllers\CompaniesController;
use App\Controllers\ContactsController;
use App\Controllers\InvoicesController;

$router = new Router();

//$router->setBasePath('/');


$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    (new NotFoundController())->index();
});

$router->get('/', function() {
    (new HomeController())->index();
});

$router->get('/companies', function() {
    echo 'companies';
});

//$router->get('/contacts', function() {
////    echo 'contacts';
//    (new ContactsController())->index();
//});

//$router->get('/invoices', function() {
//    echo 'invoices';
//    (new InvoicesController())->index();
//});

$router->run();