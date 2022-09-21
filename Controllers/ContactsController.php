<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getInformations;

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
        $data = new getInformations();
        $datas = $data->getInfo("contacts");
        $this->view('contacts', $datas);
    }
}