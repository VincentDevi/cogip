<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyModel;
use App\models\InvoiceModel;
use App\models\ValidateUserInput;

class InvoiceController extends Controller
{
    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'invoice');

        if ($validatedData) {
            $validatedData['created_at'] = todayDate();
            $validatedData['updated_at'] = todayDate();

            return (new InvoiceModel())->createEntry($validatedData);
        } else {
            return NULL;
        }
    }

    public function read($id = NULL) {
        return (new InvoiceModel())->getInvoiceData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {
        return (new InvoiceModel())->deleteEntry($id);
    }
}