<?php

namespace App\Views;

use App\Controllers\CompanyController;

class AdminUpdateCompanyView extends Views
{
    public function show($id) {
        $data = (new companyController())->read($id);
        $this->view('dashboard/dashboard_update_company', $data);
    }
}