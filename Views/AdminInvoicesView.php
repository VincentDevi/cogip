<?php

namespace App\Views;

use App\Controllers\InvoiceController;

class AdminInvoicesView extends Views
{
    public function show() {
        $data = (new InvoiceController())->read();
        $this->view('dashboard/dashboard_invoices', $data);
    }
}