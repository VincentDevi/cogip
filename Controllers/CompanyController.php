<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyModel;
use App\models\ValidateUserInput;

class CompanyController extends Controller
{

    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'company');
        $validatedData['created_at'] = todayDate();
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new CompanyModel())->createEntry($validatedData) : NULL;
    }

    public function read($id = NULL) {
        return (new CompanyModel())->getCompanyData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}