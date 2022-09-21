<?php

namespace App\models;

use PDO;
use PDOException;

require_once 'dbSettings.php';

/**
 * Connect to database.
 */
class Dbh
{


    protected function connexion()
    {
        try {
            return  new PDO("mysql:host=".HOST.";dbname=".DATABASE.";port=".PORT, USER, PASSWORD);
        }catch (PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }
    }
}