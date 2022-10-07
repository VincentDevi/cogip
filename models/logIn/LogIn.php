<?php

namespace App\models\logIn;

use App\models\Dbh;

class LogIn extends Dbh
{
    public function logIn($password, $email){
    $_SESSION=$email;
    }

    private function validationLogin():array{
        return [
          "email"=>"required|email",
          "password"=>"required|regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?]*$/"
        ];
    }
    private function validationRuleCreateUser ():array{
        return [
            "email"=> "required|email",
            "password"=> "required|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$",
            "confirm_password"=> "required|same:password"
        ];
    }

    private function checkEmailPasswordQuery($emailForm, $passwordForm):string{
        return "SELECT count(*) " ."FROM users"."WHERE email = ".$emailForm." AND password = ".$passwordForm;
    }
    private function readLogin($email, $password){
        return $this->fetchData($this->checkEmailPasswordQuery($email,$password));
    }



}