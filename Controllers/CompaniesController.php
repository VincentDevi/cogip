<?php

namespace App\Controllers;

use App\Core\Controller;

class CompaniesController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($data = [] )
    {
        $this->view('companies', $data);
    }
}