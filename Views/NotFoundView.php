<?php

namespace App\Views;

class NotFoundView extends Views
{
    /**
     * Show the 404 not found page.
     *
     * @param $data
     * @return void
     */
    public function show($data = []) {
        $this->view('404', $data);
    }
}