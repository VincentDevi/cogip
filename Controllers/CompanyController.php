<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\companyInformation;
use App\models\DbData;

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

    public function create($data) {

    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }

    public function showAll() {
        $data = (new DbData())->getData("companies");

        $this->view('companies', $data);
    }

    public function show($companyId) {
        $data = (new companyInformation())->getCompanyInfo($companyId);

        $this->view('company', $data);
    }
}