<?php

namespace App\Views;

use App\Controllers\CompanyController;
use App\Controllers\ContactController;

class AdminContactView extends Views
{
    /**
     * Show the dashboard view with all contacts.
     *
     * @param null $incomingData
     * @return void
     */
    public function showAll($incomingData = null): void
    {
        $data = (new ContactController())->read();

        if ($incomingData) $data = array_merge($data, $incomingData);

        $this->view('dashboard/dashboard_contacts', $data);
    }

    /**
     * Show the view with form to create a new contact.
     * Send the companies data's to allow the possibility to create
     * a select input with companies.
     *
     * @return void
     */
    public function showCreateForm(): void
    {
        $data['companies'] = (new CompanyController())->read();

        $this->view('dashboard/dashboard_create_contact', $data);
    }

    /**
     * Submit the create form by calling tha appropriate controller.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard crete contact page with a fail message in sent data's.
     *
     * @param $inputs
     * @return void
     */
    public function showCreateSubmit($inputs): void
    {
        $created = (new ContactController())->create($inputs);

        if ($created === TRUE) {
            $data['message'] = CONTACT_CREATION_SUCCESS_MESSAGE;

            $this->showAll($data);
        } else {
            $data['message'] = CONTACT_CREATION_ERROR_MESSAGE;

            $this->view('dashboard/dashboard_create_contact', $data);
        }
    }

    /**
     * Show the view with form to update the contact with provided id.
     * Send the companies data's to allow the possibility to create
     * a select input with companies.
     * Send the contact data to allow the possibility to prefill the form.
     *
     * @param $id
     * @return void
     */
    public function showUpdateForm($id): void
    {
        $data['companies'] = (new CompanyController())->read();
        $data['contact'] = (new ContactController())->read($id);

        $this->view('dashboard/dashboard_update_contact', $data);
    }

    /**
     * Submit the update form by calling tha appropriate controller.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard crete contact page with a fail message in sent data's.
     * If no success and id is not provided : redirect to all contacts page.
     *
     * @param $inputs
     * @return void
     */
    public function showUpdateSubmit($inputs): void
    {
        $created = (new ContactController())->update($inputs);

        if ($created === TRUE && array_key_exists("contact_id", $inputs)) {
            $data['message'] = CONTACT_UPDATE_SUCCESS_MESSAGE;

            $this->showAll($data);
        } elseif ($created !== TRUE && array_key_exists("contact_id", $inputs)) {
            $data['message'] = CONTACT_UPDATE_ERROR_MESSAGE;

            // todo: make message appear when redirect.
            redirect(getRoot().'/admin/contact/update/'.$inputs['contact_id']);
        } elseif ($created !== TRUE && !(array_key_exists("contact_id", $inputs))) {
            $data['message'] = CONTACT_UPDATE_ERROR_MESSAGE;

            $this->showAll($data);
        }
    }

    /**
     * Delete the contact that have the provided id.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard contacts page with a fail message in sent data's.
     * @param $id
     * @return void
     */
    public function deleteEntry($id): void
    {
        $deleted = (new ContactController())->delete($id);

        // todo : solve this : if entry does no exist SQL return no problem, when we try to delete non existent data, we should retrieve an error.
        if ($deleted === TRUE) {
            $data['message'] = CONTACT_DELETE_SUCCESS_MESSAGE;

            $this->showAll($data);
        } else {
            $data['message'] = CONTACT_DELETE_ERROR_MESSAGE;

            $this->showAll($data);
        }
    }
}