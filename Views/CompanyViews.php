<?php

namespace App\Views;

use App\Controllers\CompanyController;
use App\models\companyInformation;
use App\models\DbData;

class CompanyViews extends Views
{
    /**
     * Show the companies view with all companies.
     *
     * @return void
     */
    public function showAll() {
        $data = (new companyController())->read();
        $this->view('companies', $data);
    }

    /**
     * Show the company view with data's about the company.
     *
     * @param $data
     * @return void
     */
    public function show($id) {
        $data = (new companyController())->read($id);
        $this->view('company', $data);
    }
}