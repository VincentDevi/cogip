<?php

namespace App\models;
use PDO;
class contactInformation extends Dbh
{
    public function getcontactInfo($contactId){
        $query = "SELECT contacts_name, contacts_phone, email, companies.companies_name"." FROM contacts". " INNER JOIN companies ON companies.id=company_id"
        ." WHERE contacts.id = :id ";

        return $this->fetchData($query,["id"=>$contactId]);

    }
}