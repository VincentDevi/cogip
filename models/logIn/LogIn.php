<?php

namespace App\models\logIn;

use App\models\Dbh;
use Rakit\Validation\Validator;

class LogIn extends Dbh
{


    //SQL REQUEST
    public function getUser($email, $password){
        $result = $this->fetchData($this->checkEmailPasswordQuery(),$this->logInDataRequest($email,$password));
    }

    //query to execute the getData()
    private function checkEmailPasswordQuery():string{
        return "SELECT count(*) " ."FROM users"."WHERE email = :email AND password = :password";
    }
    // values to execute the getData()
    private function logInDataRequest($email, $password){
        return $this->sanitizeLogIn($email,$password);
    }



    // VALIDATION AND SANITATION
    private function sanitizeLogIn($email, $password):array{
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        return ["email"=>$email,
                "password=>$password"];
    }

    private function ruleValidationLogin():array{
        return [
            "email"=>"required|email",
            "password"=>"required|regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?]*$/"
        ];
    }
    private function logInValidation ($email, $password){
        $validator = new Validator();
        $valuesArray = $this->sanitizeLogIn($email,$password);
        $values =[
                "email"=>$valuesArray["email"],
                "password"=>$valuesArray["password"]
        ];
        $rules = $this->ruleValidationLogin();
        $validation = $validator->make($values,$rules);
        $validation->validate();

        return !$validation->fails() ? $valuesArray : null;
    }


}