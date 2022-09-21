<?php

namespace App\models;
use PDO;
class contactInformation extends Dbh
{
    public function getcontactInfo($contact){
        $query= "SELECT contacts_name, phone, email, companies.companies_name"." FROM contacts". "INNER JOIN companies ON companies.id=company_id"
        ."WHERE contacts_name LIKE ".$contact;
        $con = $this->connexion();
        $stmt= $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt= null;
        return $arrAll;
    }
}