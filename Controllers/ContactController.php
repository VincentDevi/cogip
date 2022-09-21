<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\contactInformation;
class ContactController extends Controller
{
    /**
     * return view
     *
     * @param $data
     * @return void
     */
    public function index($contact)
    {
        $data = new contactInformation();
        $datas = $data->getcontactInfo($contact);
        $this->view('contact', $datas);
    }
}