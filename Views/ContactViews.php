<?php

namespace App\Views;

use App\Controllers\ContactController;

class ContactViews extends Views
{
    /**
     * Shows the contact view with data's about the contact with provided id.
     *
     * @param $data
     * @return void
     */
    public function show($id) {
        $data = (new ContactController())->read($id);
        $this->view('contact', $data);
    }

    /**
     * Shows the contacts view with all contacts.
     *
     * @return void
     */
    public function showAll() {
        $data["contacts"] = (new ContactController())->read();
        $this->view('contacts', $data);
    }
}