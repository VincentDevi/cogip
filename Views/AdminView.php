<?php

namespace App\Views;

class AdminView extends Views
{
    public function show() {
        $this->view('dashboard/dashboard_home');
    }
}