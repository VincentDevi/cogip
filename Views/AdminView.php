<?php

namespace App\Views;

use App\Controllers\HomeController;

class AdminView extends Views
{
    /**
     * Show the dashboard with the last entries from contacts, companies and invoices.
     *
     * @return void
     */
    public function show() {
        $data = (new HomeController())->read();

        $data['user'] = CURRENT_USER;

        $this->view('dashboard/dashboard_home', $data);
    }
}