<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\ContactModel;
use App\models\ValidateUserInput;

class ContactController extends Controller
{
    /**
     * Verify the data's validity and create a new contact.
     * If provided data's valid : return the data's.
     * Otherwise, return NULL.
     * Add the actual date to updated at and created at before run the query.
     *
     * @param $data
     * @return bool|null
     */
    public function create($data): ?bool
    {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');
        $validatedData['created_at'] = todayDate();
        $validatedData['updated_at'] = todayDate();

        return $validatedData ? (new ContactModel())->createContact($validatedData) : NULL;
    }

    /**
     * Returns a contact's data or data's of all contacts in database.
     * If id is provided, return the data's of the contact with specified id.
     * Otherwise, returns all the contact's data's.
     * Add the actual date to updated at before run the query.
     *
     * @param $id
     * @return array
     */
    public function read($id = NULL): array
    {
        return (new ContactModel())->getContactData($id);
    }

    /**
     * Verify the data's validity and update a contact with provided data's.
     * If provided data's valid : return the data's.
     * Otherwise, return NULL.
     * The id of the contact must be passed in provided data's.
     * @param $data
     * @return bool|null
     */
    public function update($data): ?bool
    {
        $validatedData = (new ValidateUserInput())->validate($data, 'contact');


        if ($validatedData) {
            $validatedData['updated_at'] = todayDate();
            return (new ContactModel())->updateContact($validatedData);
        } else {
            return NULL;
        }
    }

    /**
     * Delete the contact that have the provided id.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return (new ContactModel())->deleteContact($id);
    }
}