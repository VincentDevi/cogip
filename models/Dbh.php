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


    /**
     * Execute the provided query to the database and return the results.
     * Optional $vars parameter specifies an array of variables to pass to the query.
     *
     * @param $query : E.g. ["search"=>'John']
     * @param null $vars
     * @param getDbData $instance
     * @return array
     */
    public function fetchInformation($query, $vars = NULL): array
    {
        $connexion = $this->connexion();
        $stmt = $connexion->prepare($query);
        $vars ? $stmt->execute($vars) : $stmt->execute();

        $output = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $connexion = NULL;
        $stmt = NULL;

        return $output;
    }

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