<?php

namespace App\Views;

use App\Controllers\AdminInvoiceController;

class AdminInvoicesView extends Views
{
    public function show() {
        $data = (new AdminInvoiceController())->read();
        $this->view('dashboard/dashboard_invoices', $data);
    }
}