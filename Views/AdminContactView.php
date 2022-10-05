<?php

namespace App\Views;

use App\Controllers\CompanyController;
use App\Controllers\ContactController;

class AdminContactView extends Views
{
    public function showEntries() {
        $data = (new ContactController())->read();

        $this->view('dashboard/dashboard_contacts', $data);
    }

    public function showCreateForm() {
        $data['companies'] = (new CompanyController())->read();

        $this->view('dashboard/dashboard_create_contact', $data);
    }

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

    public function showUpdateForm($id) {
        $data['companies'] = (new CompanyController())->read();
        $data['contact'] = (new ContactController())->read($id);

        $this->view('dashboard/dashboard_update_contact', $data);
    }

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
}