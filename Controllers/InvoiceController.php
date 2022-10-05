<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\InvoiceModel;

class InvoiceController extends Controller
{
    public function create($data) {

    }

    public function read($id = NULL) {
        return (new InvoiceModel())->getInvoiceData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}