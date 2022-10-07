<?php

namespace App\models\logIns;

use App\models\Dbh;
use Rakit\Validation\Validator;

class CreateUser extends Dbh
{
    //Create a new user.
    public function createUserRequest($input):array{
        if ($this->checkEmail($input["email"]) !=0 ){
            $error = "Email already taken";
            $road = "/login/createUser";
        }else{
            $test = $this->createUserValidation($input);
            if ( $test !=  null ){
                $ok = $this->valuesToExecute($test);
                $this->executeQuery($this->queryCreateUser(),$ok);
                $error = "user successfully created";
                $road = "/login/login";
            }else{
                $error = "Invalid inputs";
                $road = "/login/createUser";
            }
        }
        return ["road"=>$road,
            "error"=>$error];
    }
    private function checkEmail($email){
        $arr= ["email"=>$email];
        return $this->executeCountQuery($this->checkEmailQuery(),$arr);
}
    private function checkEmailQuery():string{
        return "SELECT count(*) " ."FROM users"." WHERE email = :email";
    }
    private function validationRuleCreateUser ():array{
        return [
            "email"=> "required|email",
            "password"=> "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
            "confirm_password"=> "required|same:password",
            "last_name"=>"required|alpha",
            "first_name"=>"required|alpha_dash"
        ];
    }

    private function queryCreateUser():string{
        return "INSERT". " INTO users"." (last_name, first_name, email, password, role_id, created_at, updated_at)"
            ." VALUES (:last_name, :first_name, :email, :password, :role_id, :created_at, :updated_at)";
    }

    private function createUserValidation($inputs){
        $validator = new Validator();
        $rules = $this->validationRuleCreateUser();
        $values = sanitize($inputs);

        $validation = $validator->make($values,$rules);
        $validation->validate();
        return !$validation->fails() ? $values : null;
    }
    private function valuesToExecute($input){
        $input["created_at"]=todayDate();
        $input["updated_at"]=todayDate();
        $input["role_id"]= 1;
        unset($input["confirm_password"]);
        return $input;
    }
}
