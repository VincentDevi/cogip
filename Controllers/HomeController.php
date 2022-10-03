<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\DbData;

class HomeController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index()
    {
        $data = new DbData();
        $datas = $data->createArray();
        $this->view('welcome', $datas);
    }
}
