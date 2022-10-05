<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyModel;

class CompanyController extends Controller
{

    public function create($data) {

    }

    public function read($id = NULL) {
        return (new CompanyModel())->getCompanyData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}