<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\createDbData;
use App\models\getDbData;

class DashboardHomeController extends Controller
{
    /**
     * Show the companies view.
     *
     * @return void
     */
    public function index()
    {
        $data = new getDbData();
        $datas = $data->createArray();

        $this->view('dashboardglobal',$datas);
    }
}