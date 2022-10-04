<?php

namespace App\Views;

use App\Controllers\AdminCompanyController;

class AdminUpdateCompanyView extends Views
{
    public function show($id) {
        $data = (new AdminCompanyController())->read($id);
        $this->view('dashboard/dashboard_update_company', $data);
    }
}