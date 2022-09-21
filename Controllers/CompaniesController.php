<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getDbData;

class CompaniesController extends Controller
{
    /**
     * Show the companies view.
     *
     * @return void
     */
    public function index()
    {
        $data = new getDbData();
        $datas = $data->getInfo("companies");

        $this->view('companies', $datas);
    }
}