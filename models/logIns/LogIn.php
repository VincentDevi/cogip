<?php

namespace App\models\logIns;

use App\models\Dbh;
use Rakit\Validation\Validator;

class LogIn extends Dbh
{


    //SQL REQUEST
    public function countUser($array){
        $arr=$this->logInDataRequest($array["email"],$array["password"]);
        return $this->executeCountQuery($this->checkEmailPasswordQuery(),$arr);
    }
    public  function getUserData($array):array{
        $arr=$this->logInDataRequest($array["email"],$array["password"]);
        return $this->fetchData($this->queryUserIdAndName(), $arr);
    }
    //query to execute the getData()
    private function queryUserIdAndName():string{
        return "SELECT users.id, users.last_name, users.first_name "."FROM users"
            ." WHERE users.email = :email AND users.password = :password";
    }
    private function checkEmailPasswordQuery():string{
        return "SELECT count(*) " ."FROM users"." WHERE email = :email AND password = :password";
    }
    // values to execute the getData()
    private function logInDataRequest($email, $password){
        return $this->logInValidation($email,$password);
    }



    // VALIDATION AND SANITATION
    private function sanitizeLogIn($email, $password):array{
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        return ["email"=>$email,
                "password"=>$password];
    }

    private function ruleValidationLogin():array{
        return [
            "email"=>"required|email",
            "password"=>"required|alpha"
        ];
    }
    public function logInValidation ($email, $password){
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