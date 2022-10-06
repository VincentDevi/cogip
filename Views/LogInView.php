<?php

namespace App\Views;

use App\Core\Controller;
use App\Controllers\LogInController;
use App\models\logIns\LogIn;

class LogInView extends Views
{
    public function show(){
        $this->view('login/login');
    }
    public function showConnect($inputs){
        $array = (new LogIn())->logInValidation($inputs["email"],$inputs["password"]);
        $datas = new LogInController();
        $data = $datas->realLogIn($array);
        // need to check if the middelware will still redirect to LogIn
        // if we are not logged in, even if we send to the home here.
        $this->view('welcome');
    }
    public function showDisconnect(){
        session_destroy();
        $this->view('login/login');
    }
}