<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getDbData;

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
        $data = new getDbData();
        $datas = $data->createArray();
        $this->view('welcome', $datas);
    }
}
