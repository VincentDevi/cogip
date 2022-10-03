<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\DbData;

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
        $data = new DbData();
        $datas = $data->getData("contacts");
        $this->view('contacts', $datas);
    }
}