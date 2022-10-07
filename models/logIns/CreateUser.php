<?php

namespace App\models\logIns;

use App\models\Dbh;
use Rakit\Validation\Validator;

class CreateUser extends Dbh
{
    //Create a new user.
    private function validationRuleCreateUser ():array{
        return [
            "email"=> "required|email",
            "password"=> "required|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$",
            "confirm_password"=> "required|same:password",
            "name"=>"required|alpha",
            "firstname"=>"required|alpha_dash"
        ];
    }

    private function queryCreateUser(){
        return "INSERT". "INTO users"." (last_name, first_name, email, password, created_at, updated_at)"
            ." VALUES (:name, :firstname, :email, :password, :created_at, :updated_at)";
    }
    private function createUserRequest(){
        $result = $this->executeQuery($this->queryCreateUser(),"ok");
    }
    private function createUserValidation(){
        $validator = new Validator();
        $rules = $this->validationRuleCreateUser();
    }
    private function sanitize($input){
        return htmlspecialchars($input);
    }
    private function sanitizeCreateUser($array):array{
       return array_map('sanitize',$array);
    }
}
