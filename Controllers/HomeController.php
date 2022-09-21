<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($data = ['name' => 'Jean-Christian'])
    {
        $this->view('welcome', $data);
    }
}
