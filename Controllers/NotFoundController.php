<?php

namespace App\Controllers;

use App\Core\Controller;

class NotFoundController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($data = [] )
    {
        $this->view('404', $data);
    }
}