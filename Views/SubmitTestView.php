<?php

namespace App\Views;

use App\Controllers\InvoiceController;

class SubmitTestView extends Views
{
    public function show() {
        $this->view('test/submit_test');
    }

    public function showReturn($data) {
        $this->view('test/submit_test_return', $data);
    }
}