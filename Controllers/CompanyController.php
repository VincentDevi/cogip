<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\companyInformation;
use App\models\DbData;

class CompanyController extends Controller
{

    public function create($data) {

    }

    public function read($id = NULL) {
        return $id ? (new companyInformation())->getCompanyInfo($id) : (new DbData())->getData("companies");
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}