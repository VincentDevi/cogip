<?php

namespace App\Views;

class AdminInvoicesView extends Views
{
    public function show() {
        $this->view('dashboard/dashboard_invoices');
    }
}