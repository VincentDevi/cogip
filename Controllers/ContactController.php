<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\getInformations;

class ContactController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($datas=[] )
    {

        $this->view('contact', $datas);
    }
}