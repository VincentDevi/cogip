<?php

namespace App\Views;

use App\Controllers\AdminInvoiceController;

class AdminUpdateInvoiceView extends Views
{
    public function show($id) {
        $data = (new AdminInvoiceController())->read($id);
        $this->view('dashboard/dashboard_update_invoice', $data);
    }
}