<?php

namespace App\Views;

class NotFoundView extends Views
{
    public function show($data = []) {
        $this->view('404', $data);
    }
}