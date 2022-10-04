<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\createDbData;
use App\models\DbData;

class DashboardHomeController extends Controller
{
    /**
     * Show the companies view.
     *
     * @return void
     */
    public function index()
    {
        $data = new DbData();
        $datas = $data->createArray();

        $datas['user'] = CURRENT_USER;

        $this->view('dashboardglobal',$datas);
    }
}