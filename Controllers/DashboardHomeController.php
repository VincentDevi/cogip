<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getDbData;

class DashboardHomeController extends Controller
{
    /**
     * Show the companies view.
     *
     * @return void
     */
    public function index($data = [])
    {


        $this->view('dashboardglobal', $data);
    }

}