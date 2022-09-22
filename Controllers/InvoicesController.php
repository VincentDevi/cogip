<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getDbData;

class InvoicesController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index( )
    {
        $data = new getDbData();
        $datas = $data->getInfo("invoices");
        $this->view('invoices', $datas);
    }
}