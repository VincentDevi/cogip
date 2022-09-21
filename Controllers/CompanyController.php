<?php

namespace App\Controllers;

use App\Core\Controller;

class CompanyController extends Controller
{
    /**
     * Show the company view with data's about the company.
     *
     * @param $data
     * @return void
     */
    public function index($data = [] )
    {
        $this->view('company', $data);
    }
}