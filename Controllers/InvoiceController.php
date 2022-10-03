<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\InvoiceData;

class InvoiceController extends Controller
{
    public function create($data) {

    }

    public function read() {
        return (new InvoiceData())->getInvoiceData();
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}