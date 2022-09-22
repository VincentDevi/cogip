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
        $comp = $data->getInfo("companies", 5);
        $inv = $data->getInfo("invoices", 5);
        $cont = $data->getInfo("contacts", 5);
        $datas= ["companies"  => $comp,
                "invoices"=> $inv,
                "contacts"=> $cont];
        $this->view('welcome', $datas);
    }
}
