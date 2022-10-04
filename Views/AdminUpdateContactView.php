<?php

namespace App\Views;

use App\Controllers\AdminContactController;

class AdminUpdateContactView extends Views
{
    public function show($id) {
        $data = (new AdminContactController())->read($id);
        $this->view('dashboard/dashboard_update_contact', $data);
    }
}