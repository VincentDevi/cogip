<?php

namespace App\Views;

use App\Controllers\AdminContactController;

class AdminContactsView extends Views
{
    public function show() {
        $data = (new AdminContactController())->read();
        $this->view('dashboard/dashboard_contacts', $data);
    }
}