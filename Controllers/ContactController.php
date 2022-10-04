<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\contactData;

class ContactController extends Controller
{
    public function create($data) {

    }

    public function read($id = NULL) {
        return (new contactData())->getContactData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}