<?php

namespace App\Views;

use App\Controllers\InvoiceController;

class AdminUpdateInvoiceView extends Views
{
    public function show($id) {
        $data = (new InvoiceController())->read($id);
        $this->view('dashboard/dashboard_update_invoice', $data);
    }
}