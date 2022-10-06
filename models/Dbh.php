<?php

namespace App\models;

use PDO;
use PDOException;
use App\models\dashboard\Form;

require_once 'dbSettings.php';

/**
 * Connect to database.
 */
class Dbh
{

    // todo : refactor name to fetchData
    /**
     * Execute the provided query to the database and return the results.
     * Optional $vars parameter specifies an array of variables to pass to the query.
     *
     * @param $query : E.g. ["search"=>'John']
     * @param null $vars
     * @param DbData $instance
     * @return array
     */
    public function fetchData($query, $vars = NULL): array
    {
        $connexion = $this->connexion();
        $stmt = $connexion->prepare($query);
        $vars ? $stmt->execute($vars) : $stmt->execute();

        // todo : use fetch when need unique row.
        $output = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $connexion = NULL;
        $stmt = NULL;

        return $output;
    }

    /**
     * Possible duplicate of Dbh->fetchInformation() function.
     *
     * @param $table
     * @param $arrayOfInput
     * @return bool
     */
    public function executeQuery($query, $data){
        $connexion = $this->connexion();
        $stmt = $connexion->prepare($query);
        $stmt->execute($data);

        $connexion = NULL;
        $stmt = null;

        // todo : return null if something went wrong.
        return TRUE;
    }
    public function executeCountQuery($query, $data){
        $connexion = $this->connexion();
        $stmt = $connexion->prepare($query);
        $stmt->execute($data);
        $result = $stmt->fetchColumn();
        $connexion = NULL;
        $stmt = null;


        return $result;
    }

    /**
     * Return the PDO Connexion object.
     *
     * @return PDO|void
     */
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