<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\ContactModel;
use App\models\ValidateUserInput;

class ContactController extends Controller
{
    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');
        $validatedData['created_at'] = todayDate();
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new ContactModel())->createContact($validatedData) : NULL;
    }

    public function read($id = NULL) {
        return (new ContactModel())->getContactData($id);
    }

    public function update($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new ContactModel())->updateContact($validatedData) : NULL;
    }

    public function delete($id) {
        return (new ContactModel())->deleteContact($id);
    }
}