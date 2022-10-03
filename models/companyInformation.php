<?php

namespace App\models;
use PDO;
class companyInformation extends Dbh
{

    public function getCompanyInfo($companyId): array
    {
        $idArray = [
            "id"=> $companyId
        ];
        $invArr = $this->fetchData($this->getQuery("invoices"),$idArray);
        $contArr = $this->fetchData($this->getQuery("contacts"), $idArray);
        $compArr = $this->fetchData($this->getQuery("companies"), $idArray);
        $arrAll = ["invoices"=>$invArr,
                "contacts"=>$contArr,
                "companies"=>$compArr];
        return $arrAll;
    }
    private function getQuery($table): string
    {
        $limit = 5;
        if ( $table === "invoices"){
            $query = "SELECT ref, due_date, companies.companies_name, invoices_created_at"." FROM ".$table." INNER JOIN companies ON companies.id= id_company"
                ." WHERE companies.id = :id "." LIMIT ".$limit.";";
        }elseif ( $table === "contacts"){
            $query = "SELECT contacts_name"." FROM ".$table." INNER JOIN companies ON companies.id = company_id"." WHERE companies.id = :id ;";

        }else{
            $query = "SELECT companies_name, tva, country, companies_phone"." FROM ".$table." WHERE companies.id = :id ;";
        }
        return $query;
    }

}