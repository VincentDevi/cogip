<?php

namespace App\models;

use PDO;
use PDOException;

class Dbh
{
    private string $user = "vinz";
    private string $password = "5739";

    protected function connexion()
    {
        try {
            return  new PDO("mysql:host=localhost;dbname=database", $this->user, $this->password);
        }catch (PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }
    }
}