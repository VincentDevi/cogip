<?php

namespace App\models;
use App\models\Dbh;
use PDO;
class companyInformation
{
    public function getCompanyInfo($company){
        $query = $this->chooseQuery($company);
        return $this->connexionDb($query);
    }

    private function chooseQuery($company){
        if ( $company === "invoices"){
            $query = "SELECT ref, due_dates, companies.companies_name, invoices_created_at"." FROM ".$company." INNER JOIN companies ON companies.id= id_company"
                ." LIMIT 5";
        }elseif ( $company === "contacts"){
            $query = "SELECT contacts_name"." FROM ".$company." INNER JOIN companies ON companies.id = id"." WHERE company_id = companies.id";

        }else{
            $query = "SELECT companies_name, tva, country, companies_phone"." FROM companies"." WHERE companies.name LIKE ".$company;
        }
        return $query;
    }
    private function connexionDb($query){
        $con = $this->connexion();
        $stmt= $con->prepare($query);
        $stmt->execute();
        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt= null;
        return $arrAll;
    }
}