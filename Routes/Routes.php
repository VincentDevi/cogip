<?php

namespace App\Routes;


use App\Controllers\DashboardHomeController;
use App\Views\CompanyViews;
use App\Views\ContactViews;
use App\Views\InvoiceView;
use App\Views\NotFoundView;
use Bramus\Router\Router;
use App\Controllers\HomeController;

use App\Test\ValidateUserInputTest;


$router = new Router();

//$router->setBasePath('/');


$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    (new NotFoundView())->show();
});

$router->get('/', function() {
    (new HomeController)->index();
});

$router->get('/companies', function() {
    (new CompanyViews)->showAll();
});

$router->get('/contacts', function() {
    (new ContactViews())->showAll();
});

$router->get('/invoices', function() {
    (new InvoiceView())->showAll();
});

$router->get('/test', function() {
    (new validateUserInputTest());
});

$router->get('/contact/([0-9]+)', function($name) {
    (new ContactViews())->show($name);
});

$router->get('/company/([0-9]+)', function($name) {
    (new CompanyViews())->show($name);
});

$router->put('/create/invoice/reference/price/company', function($reference, $price, $company) {
    //    (new CreateInvoiceController())->index($reference, $price, $company);
});

$router->put('/create/company/name/country/tva/phone', function($name, $country, $tva, $phone) {
    //    (new CreateCompanyController())->index($name, $country, $tva, $phone);
});

$router->put('/create/contact/name/email/phone/companyId', function($name, $email, $phone, $companyId) {
    //    (new CreateContactController())->index($name, $email, $phone, $companyId);
});

$router->get('/dashboard', function() {
//    echo 'invoices';
    (new DashboardHomeController())->index();
});
$router->run();


