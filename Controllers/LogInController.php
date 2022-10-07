<?php

namespace App\Controllers;
use App\Core\Controller;
use App\models\logIns\LogIn;
use App\models\logIns\CreateUser;
class LogInController extends Controller
{
    public function realLogIn($inputs){
        $ok =$this->userResult($inputs);
        if ( $ok !=0){
            $this->setGlobalVariable($inputs);
            $error = [];
        }else{
            $error=["error"=>"Invalid Email or Password"];
        }
        return $error;
    }
    private function userResult ($array) {
        return (new LogIn())->countUser($array);
    }

    private function setGlobalVariable($inputs){
        $array = (new LogIn())->getUserData($inputs);
        $_SESSION["user"] = $array[0]["id"];
        $_SESSION["name"] = $array[0]["last_name"];
        $_SESSION["firstname"] = $array[0]["first_name"];
    }
    public function createUser($inputs){
        return (new CreateUser())->createUserRequest($inputs);
    }
}