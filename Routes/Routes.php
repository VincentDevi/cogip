<?php

namespace App\Routes;

use App\models\logIns\CreateUser;
use App\Views\AdminCompaniesView;
use App\Views\AdminContactView;
use App\Views\AdminInvoicesView;
use App\Views\AdminView;
use App\Views\CompanyViews;
use App\Views\ContactView;
use App\Views\CreateUserView;
use App\Views\HomeView;
use App\Views\InvoiceView;
use App\Views\LogInView;
use App\Views\NotFoundView;
use App\Views\SubmitTestView;
use Bramus\Router\Router;

use App\Test\ValidateUserInputTest;


$router = new Router();

//$router->setBasePath('/');

$router->before('GET', '/.*', function() {
    if (!isset($_SESSION['user']) && getUrlLastElement() != "createUser") {
        (new LogInView())->show();
        exit();
    }
});
$router->post('/login/connect', function() {
    (new LogInView())->showConnect($_POST);
});
$router->get('/login/disconnect', function() {
    (new LogInView())->showDisconnect();
});
$router->get('/login/createUser', function() {
    (new CreateUserView())->show();
});
$router->post('/login/createUser/send', function() {
    (new CreateUserView())->showCreate($_POST);
});
$router->post('/login/create', function() {
    (new CreateUserView())->show($_POST);
});
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
    (new ContactView())->showAll();
});

$router->get('/invoices', function() {
    (new InvoiceView())->showAll();
});

$router->get('/test', function() {
    (new validateUserInputTest());
});

$router->get('/contact/([0-9]+)', function($name) {
    (new ContactView())->show($name);
});

$router->get('/company/([0-9]+)', function($name) {
    (new CompanyViews())->show($name);
});

$router->get('/admin', function() {
    (new AdminView())->show();
});



$router->get('/admin/contacts', function() {
    (new AdminContactView())->showAll();
});

$router->get('/admin/contact/create', function() {
    (new AdminContactView())->showCreateForm();
});

$router->post('/admin/contact/create', function() {
    (new AdminContactView())->showCreateSubmit($_POST);
});

$router->get('/admin/contact/update/([0-9]+)', function($id) {
    (new AdminContactView())->showUpdateForm($id);
});

$router->post('/admin/contact/update', function() {
    (new AdminContactView())->showUpdateSubmit($_POST);
});

$router->get('/admin/contact/delete/([0-9]+)', function($id) {
    (new AdminContactView())->deleteEntry($id);
});



$router->get('/admin/companies', function() {
    (new AdminCompaniesView())->showAll();
});

$router->get('/admin/company/create', function() {
    (new AdminCompaniesView())->showCreateForm();
});

$router->post('/admin/company/create', function() {
    (new AdminCompaniesView())->showCreateSubmit($_POST);
});

$router->get('/admin/company/delete/([0-9]+)', function($id) {
    (new AdminCompaniesView())->deleteEntry($id);
});

$router->get('/admin/company/update/([0-9]+)', function($id) {
    (new AdminCompaniesView())->showUpdateForm($id);
});

$router->post('/admin/company/update', function() {
    (new AdminCompaniesView())->showUpdateSubmit($_POST);
});




$router->get('/admin/invoices', function() {
    (new AdminInvoicesView())->showAll();
});

$router->get('/admin/invoice/create', function() {
    (new AdminInvoicesView())->showCreateForm();
});

$router->post('/admin/invoice/create', function() {
    (new AdminInvoicesView())->showCreateSubmit($_POST);
});

$router->get('/admin/invoice/delete/([0-9]+)', function($id) {
    (new AdminInvoicesView())->deleteEntry($id);
});

$router->get('/admin/invoice/update/([0-9]+)', function($id) {
    (new AdminInvoicesView())->showUpdateForm($id);
});

$router->post('/admin/invoice/update', function() {
    (new AdminInvoicesView())->showUpdateSubmit($_POST);
});



$router->get('/submitest', function() {
    (new SubmitTestView())->show();
});

$router->post('/submitest', function() {
    $data = [
        'test2' => $_POST,
    ];
    (new SubmitTestView())->showReturn($data);
});


$router->run();


