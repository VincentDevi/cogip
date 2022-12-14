<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyModel;
use App\models\ValidateUserInput;

class CompanyController extends Controller
{

    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'company');

        if ($validatedData) {
            $validatedData['created_at'] = todayDate();
            $validatedData['updated_at'] = todayDate();

            return (new CompanyModel())->createEntry($validatedData);
        } else {
            return NULL;
        }
    }

    public function read($id = NULL) {
        return (new CompanyModel())->getCompanyData($id);
    }

    public function update($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'company');

        if ($validatedData) {
            $validatedData['updated_at'] = todayDate();

            return (new CompanyModel())->updateEntry($validatedData);
        } else {
            return NULL;
        }
    }

    public function delete($id) {
        return (new CompanyModel())->deleteEntry($id);
    }
}