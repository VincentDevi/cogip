<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getDbData;

class ContactsController extends Controller
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
        $datas = $data->getInfo("contacts");
        $this->view('contacts', $datas);
    }
}