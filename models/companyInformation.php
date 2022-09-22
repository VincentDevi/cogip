<?php

namespace App\models;
use PDO;
class companyInformation extends Dbh
{

    public function getCompanyInfo($company): array
    {
        $invArr = $this->fetchInformation($this->getQuery("invoices", $company));
        $contArr = $this->fetchInformation($this->getQuery("contacts", $company));
        $compArr = $this->fetchInformation($this->getQuery("companies", $company));
        $arrAll = ["invoices"=>$invArr,
                "contacts"=>$contArr,
                "companies"=>$compArr];
        return $arrAll;
    }
    private function getQuery($table, $company): string
    {
        if ( $table === "invoices"){
            $query = "SELECT ref, due_date, companies.companies_name, invoices_created_at"." FROM ".$table." INNER JOIN companies ON companies.id= id_company"
                ." WHERE companies_name LIKE "."'".$company."'"." LIMIT 5".";";
        }elseif ( $table === "contacts"){
            $query = "SELECT contacts_name"." FROM ".$table." INNER JOIN companies ON companies.id = company_id"." WHERE companies_name LIKE "."'".$company."'".";";

        }else{
            $query = "SELECT companies_name, tva, country, companies_phone"." FROM ".$table." WHERE companies_name LIKE "."'".$company."'".";";
        }
        return $query;
    }
//    private function connexionDb($query){
//        $con = $this->connexion();
//        $stmt= $con->prepare($query);
//        $stmt->execute();
//        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $stmt= null;
//        $con = null;
//        return $arrAll;
//    }
}