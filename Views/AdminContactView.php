<?php

namespace App\Views;

use App\Controllers\CompanyController;
use App\Controllers\ContactController;

class AdminContactView extends Views
{
    /**
     * Show the dashboard view with all contacts.
     *
     * @return void
     */
    public function showAll() {
        $data = (new ContactController())->read();

        $this->view('dashboard/dashboard_contacts', $data);
    }

    /**
     * Show the view with form to create a new contact.
     * Send the companies data's to allow the possibility to create
     * a select input with companies.
     *
     * @return void
     */
    public function showCreateForm() {
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
    public function showCreateSubmit($inputs)
    {
        $created = (new ContactController())->create($inputs);

        if ($created === TRUE) {
            $data['message'] = 'Contact successfully created.';

            $this->view('dashboard/dashboard_contacts', $data);
        } else {
            $data['message'] = 'Something went wrong.';

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
    public function showUpdateForm($id) {
        $data['companies'] = (new CompanyController())->read();
        $data['contact'] = (new ContactController())->read($id);

        $this->view('dashboard/dashboard_update_contact', $data);
    }

    /**
     * Submit the update form by calling tha appropriate controller.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard crete contact page with a fail message in sent data's.
     *
     * @param $inputs
     * @return void
     */
    public function showUpdateSubmit($inputs)
    {
        $created = (new ContactController())->update($inputs);

        if ($created === TRUE) {
            $data['message'] = 'Contact successfully updated.';

            $this->view('dashboard/dashboard_contacts', $data);
        } else {
            $data['message'] = 'Something went wrong.';

            $this->view('dashboard/dashboard_update_contact', $data);
        }
    }

    /**
     * Delete the contact that have the provided id.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard contacts page with a fail message in sent data's.
     * @param $id
     * @return void
     */
    public function deleteEntry($id) {
        $deleted = (new ContactController())->delete($id);

        // todo : solve this : if entry does no exist SQL return no problem, when we try to delete unexistant data, we should retrieve an error.
        if ($deleted === TRUE) {
            $data['message'] = 'Contact successfully deleted.';

            $this->view('dashboard/dashboard_contacts', $data);
        } else {
            $data['message'] = 'Something went wrong.';

            $this->view('dashboard/dashboard_contacts', $data);
        }
    }
}