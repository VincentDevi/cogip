<?php

namespace App\Views;

use App\Controllers\ContactController;

class AdminUpdateContactView extends Views
{
    public function show($id) {
        $data = (new ContactController())->read($id);
        $this->view('dashboard/dashboard_update_contact', $data);
    }
}