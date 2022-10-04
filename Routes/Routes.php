<?php

namespace App\Routes;

use App\Controllers\DashboardHomeController;
use App\Views\AdminCompaniesView;
use App\Views\AdminContactsView;
use App\Views\AdminCreateCompanyView;
use App\Views\AdminCreateContactView;
use App\Views\AdminCreateInvoiceView;
use App\Views\AdminInvoicesView;
use App\Views\AdminUpdateCompanyView;
use App\Views\AdminUpdateContactView;
use App\Views\AdminUpdateInvoiceView;
use App\Views\AdminView;
use App\Views\CompanyViews;
use App\Views\ContactViews;
use App\Views\HomeView;
use App\Views\InvoiceView;
use App\Views\NotFoundView;
use Bramus\Router\Router;

use App\Test\ValidateUserInputTest;


$router = new Router();

//$router->setBasePath('/');


$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    (new NotFoundView())->show();
});

$router->get('/', function() {
    (new HomeView())->show();
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

$router->get('/admin', function() {
    (new AdminView())->show();
});

$router->get('/admin/contacts', function() {
    (new AdminContactsView())->show();
});

$router->get('/admin/companies', function() {
    (new AdminCompaniesView())->show();
});

$router->get('/admin/invoices', function() {
    (new AdminInvoicesView())->show();
});

$router->get('/admin/contact/create', function() {
    (new AdminCreateContactView())->show();
});

$router->get('/admin/company/create', function() {
    (new AdminCreateCompanyView())->show();
});

$router->get('/admin/invoice/create', function() {
    (new AdminCreateInvoiceView())->show();
});

$router->get('/admin/contact/update/([0-9]+)', function($id) {
    (new AdminUpdateContactView())->show($id);
});

$router->get('/admin/company/update/([0-9]+)', function($id) {
    (new AdminUpdateCompanyView())->show($id);
});

$router->get('/admin/invoice/update/([0-9]+)', function($id) {
    (new AdminUpdateInvoiceView())->show($id);
});


////////////////////////////////////////////////////////////////
/// ///////////// In progress This not work
$router->put('/create/invoice/reference/price/company', function($reference, $price, $company) {
    //    (new CreateInvoiceController())->index($reference, $price, $company);
});

$router->put('/create/company/name/country/tva/phone', function($name, $country, $tva, $phone) {
    //    (new CreateCompanyController())->index($name, $country, $tva, $phone);
});

$router->put('/create/contact/name/email/phone/companyId', function($name, $email, $phone, $companyId) {
    //    (new CreateContactController())->index($name, $email, $phone, $companyId);
});
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


//$router->get('/dashboard', function() {
////    echo 'invoices';
//    (new DashboardHomeController())->index();
//});

$router->run();


