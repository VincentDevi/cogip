<?php

namespace App\models;

use App\models\Dbh;
use PDO;

class getInformations extends Dbh
{
    protected function getInvoices($limit=null){
        if ($limit===null) {
            $query = "SELECT ref, updated_at, created_at, companies.name" . " FROM invoices"
                . " INNER JOIN companies WHERE id = id_company";
        }else{
            $query = "SELECT ref, updated_at, created_at, companies.name" . " FROM invoices"
                . " INNER JOIN companies WHERE id = id_company"
                . " LIMIT " . $limit;
        }
        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $arrAll;
    }
    protected function getContacts($limit=null){
        if ($limit===null) {
            $query = "SELECT name, phone, mail, created_at, companies.name" . " FROM contacts"
                . " INNER JOIN companies WHERE id = company_id";
        }else{
            $query = "SELECT name, phone, mail, created_at, companies.name" . " FROM contacts"
                . " INNER JOIN companies WHERE id = company_id"
                . " LIMIT " . $limit;
        }
        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt= null;
        return$arrAll;
    }
    protected function getCompanies($limit=null){
        if ($limit===null) {
            $query = "SELECT name, tva, country, created_at, types.name" . " FROM companies"
                . " INNER JOIN companies WHERE id = type_id";
        }else{
            $query = "SELECT name, tva, country, created_at, types.name" . " FROM companies"
                . " INNER JOIN companies WHERE id = type_id"
                . " LIMIT " . $limit;
        }
        $con = $this->connexion();
        $stmt = $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $arrAll;
    }
}