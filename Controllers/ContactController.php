<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyData;
use App\models\contactData;
class ContactController extends Controller
{
//    /**
//     * return view
//     *
//     * @param $data
//     * @return void
//     */
//    public function index($contact)
//    {
//        $data = new contactData();
//        $datas = $data->getcontactData($contact);
//        $this->view('contact', $datas);
//    }

    public function create($data) {

    }

    public function read($id = NULL) {
        return (new contactData())->getContactData($id);
    }

    public function update($data, $id) {

    }

    public function delete($id) {

    }
}