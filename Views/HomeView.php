<?php

namespace App\Views;

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;

class HomeView extends Views
{
    /**
     * Shows the home page.
     *
     * @return void
     */
    public function show() {
        $data = (new HomeController())->read();
        $this->view('welcome', $data);
    }
}