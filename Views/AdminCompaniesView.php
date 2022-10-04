<?php

namespace App\Views;

use App\Controllers\AdminCompanyController;

class AdminCompaniesView extends Views
{
    public function show() {
        $data = (new AdminCompanyController())->read();
        $this->view('dashboard/dashboard_companies', $data);
    }
}