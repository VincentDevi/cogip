<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\contactData;
use App\models\ValidateUserInput;

class ContactController extends Controller
{
    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');

        return $validatedData ? (new contactData())->createContact($validatedData) : NULL;
    }

    public function read($id = NULL) {
        return (new contactData())->getContactData($id);
    }

    public function update($data) {

    }

    public function delete($id) {

    }
}