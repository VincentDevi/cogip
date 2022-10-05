<?php

namespace App\Views;

use App\Controllers\AdminContactController;
use App\Controllers\ContactController;

class AdminContactView extends Views
{
    public function showEntries() {
        $data = (new AdminContactController())->read();
        $this->view('dashboard/dashboard_contacts', $data);
    }

    public function showCreateForm() {
        $this->view('dashboard/dashboard_create_contact');
    }

    public function showCreateSubmit($inputs)
    {
        $created = (new ContactController())->create($inputs);

        if ($created === TRUE) {
            $data['message'] = 'Contact successfully created.';
            $this->view('dashboard/dashboard_contacts', $data);
        }
    }
}