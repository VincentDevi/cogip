<?php

namespace App\Views;

use App\Controllers\CompanyController;

class AdminCompaniesView extends Views
{
    public function show() {
        $data = (new companyController())->read();
        $this->view('dashboard/dashboard_companies', $data);
    }
}