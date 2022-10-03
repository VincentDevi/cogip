<?php

namespace App\Views;

use App\Controllers\InvoiceController;

class InvoiceView extends Views
{
    /**
     * Shows the invoices view with all invoices.
     *
     * @return void
     */
    public function showAll() {
        $data = (new InvoiceController())->read();
        $this->view('invoices', $data);
    }
}