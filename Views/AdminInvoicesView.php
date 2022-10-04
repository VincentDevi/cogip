<?php

namespace App\Views;

use App\Controllers\AdminInvoiceController;

class AdminInvoicesView extends Views
{
    public function show($id) {
        $data = (new AdminInvoiceController())->read($id);
        $this->view('dashboard/dashboard_invoices', $data);
    }
}