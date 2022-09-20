<?php

namespace App\Controllers;

use App\Core\Controller;

class ContactController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($data = [] )
    {
        $this->view('contact', $data);
    }
}