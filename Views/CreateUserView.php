<?php

namespace App\Views;

use App\Controllers\LogInController;
use App\models\logIns\CreateUser;

class CreateUserView extends Views
{
    public function show($data=[]){
        //does something
        $this->view('login/createUser');

    }
    public function showCreate($input){
        //do something
        $data =  (new LogInController())->createUser($input);
        $arr = ["message"=>$data["error"]];
        $this->view($data["road"],$arr);
    }
}