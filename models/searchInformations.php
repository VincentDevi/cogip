<?php

namespace App\models;
use App\models\Dbh;
use PDO;
class searchInformations extends Dbh
{
    protected function seearchCompany($keyWord){
        $query = "SELECT name, tva, country, created_at, types.name" . " FROM companies"
                . " INNER JOIN companies WHERE id = type_id"
                ."WHERE name LIKE $keyWord" ;

        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $arrAll;
    }
    protected function seearchInvoices($keyWord){
        $query = "SELECT ref, updated_at, created_at, companies.name" . " FROM invoices"
            . " INNER JOIN companies WHERE id = id_company"
            ."WHERE name LIKE $keyWord" ;

        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $arrAll;
    }
    protected function seearchContacts($keyWord){
        $query = "SELECT name, phone, mail, created_at, companies.name" . " FROM contacts"
            . " INNER JOIN companies WHERE id = company_id"
            ."WHERE name LIKE $keyWord" ;

        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $arrAll;
    }
}