<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getInformations;
class CompaniesController extends Controller
{
    /**
     * return view
     *
     *
     * @return void
     */
    public function index()
    {
        $data = new getInformations();
        $datas = $data->getInfo("companies");
        $this->view('companies', $datas);
    }
}