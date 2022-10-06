<?php

namespace App\models\logIns;

class CreateUser
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
}