<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\ContactData;
use App\models\ValidateUserInput;

class ContactController extends Controller
{
    public function create($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');
        $validatedData['created_at'] = todayDate();
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new ContactData())->createContact($validatedData) : NULL;
    }

    public function read($id = NULL) {
        return (new ContactData())->getContactData($id);
    }

    public function update($data) {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new ContactData())->updateContact($validatedData) : NULL;
    }

    public function delete($id) {
        return (new ContactData())->deleteContact($id);
    }
}