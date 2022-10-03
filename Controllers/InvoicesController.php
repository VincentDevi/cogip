<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\DbData;

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
        $data = new DbData();
        $datas = $data->getData("invoices");
        $this->view('invoices', $datas);
    }
}