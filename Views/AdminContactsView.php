<?php

namespace App\Views;

use App\Controllers\ContactController;

class AdminContactsView extends Views
{
    public function show() {
        $data = (new ContactController())->read();
        $this->view('dashboard/dashboard_contacts', $data);
    }
}