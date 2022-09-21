<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\companyInformation;
class CompanyController extends Controller
{
    /**
     * Show the company view with data's about the company.
     *
     * @param $data
     * @return void
     */
    public function index($company)
    {
        $data = new companyInformation();
        $datas = $data->getCompanyInfo($company);
        $this->view('company', $datas);
    }
}