<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyData;
use App\models\DbData;

class CompanyController extends Controller
{

    public function create($data) {

    }

    public function read($id = NULL) {
        return $id ? (new CompanyData())->getCompanyData($id) : (new DbData())->getData("companies");
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}