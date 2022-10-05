<?php

namespace App\Controllers;
use App\Core\Controller;
use App\models\logIn\LogIn;
class LogInController extends Controller
{
    public function userResult ($email, $password) {
        $data = $this->getUser($email,$password);
    }
}