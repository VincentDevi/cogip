<?php

namespace App\Views;

use App\Controllers\AdminController;

class AdminView extends Views
{
    public function show() {
        $data = (new AdminController())->read();

        $data['user'] = CURRENT_USER;

        $this->view('dashboard/dashboard_home', $data);
    }
}