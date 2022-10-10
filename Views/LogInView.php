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
        $datas = new LogInController();
        $data = $datas->realLogIn($inputs);
        if ($data ==[]){
            redirect(getRoot());
        }else{
            $this->view('login/login',$data);

        }
    }
    public function showDisconnect(){
        session_destroy();
        $this->view('login/login');
    }
}