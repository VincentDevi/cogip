<?php

namespace App\models;
use App\models\Dbh;
use PDO;
class contactInformation
{
    public function connexionDb($contact){
        $query= "SELECT contacts_name, phone, email, companies.companies_name"." FROM contacts". "INNER JOIN companies ON companies.id=company_id";
        $con = $this->connexion();
        $stmt= $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt= null;
        return $arrAll;
    }
}