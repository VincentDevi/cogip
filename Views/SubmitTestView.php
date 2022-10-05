<?php

namespace App\Views;

/**
 * Test class for testing the submitting forms.
 */
class SubmitTestView extends Views
{
    public function show() {
        $this->view('test/submit_test');
    }

    public function showReturn($data) {
        $this->view('test/submit_test_return', $data);
    }
}