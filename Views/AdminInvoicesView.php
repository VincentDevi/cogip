<?php

namespace App\Views;

use App\Controllers\InvoiceController;

class AdminInvoicesView extends Views
{
    public function show($id) {
        $data = (new InvoiceController())->read($id);
        $this->view('dashboard/dashboard_invoices', $data);
    }
}