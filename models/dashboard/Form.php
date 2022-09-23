<?php

namespace App\models\dashboard;

use App\models\Dbh;

class Form extends Dbh
{
    public function fetchAutocompleteFormData($table):array{
        $query = $this->queryFormAutocomplete($table);
        return $this->fetchInformation($query);
    }
    public function checkIfValueExist($table, $nameToCheck): bool{
        if (! $this->countRowDb($table,$nameToCheck)) {
            $isNotDB = false;
        }else{
            $isNotDB = true;
        }
        return $isNotDB;
    }
    public function createDb($table,$arrayOfInput){
        $con = $this->connexion();
        $stmt = $con->prepare($this->selectCreateQuery($table));
        $stmt->execute($this->createArrayExecute($table,$arrayOfInput));
        $stmt = null;
    }

    private function getTodayDate(): string{
        return date('Y-m-d');
    }

    private function countRowDb($table,$nameToCheck): array{
        $query = "SELECT COUNT(*)"." FROM :table WHERE :tableName LIKE :nameTocheck";
        return $this->fetchInformation($query,[
            "table"=>$table,
            "nameToCheck"=> $nameToCheck
        ]);

    }
    private function queryFormAutocomplete($table): string{
        return "SELECT ".$table."_name"." FROM ".$table;
    }


    private function fectchCompanyName($company_id){
        $query= "SELECT companies_name" ."FROM companies"." WHERE companies.id = ".$company_id;
        $con = $this->connexion();
        $arr = $this->fetchInformation($query);
        return $arr["companies_name"];
    }

    private function selectCreateQuery($table): string{
        if ($table === "companies"){
            $query = "INSERT INTO ".$table." (companies_name, country, tva, companies_created_at, companies_updated_at, companies_phone)"
            ." VALUES (:companies_name, :country, :tva, :created_at, :updated_at, :phone)";
        }elseif ($table === "contacts"){
            $query = "INSERT INTO ".$table." (contacts_name, company_id, email, contacts_phone, contacts_created_at, contacts_updated_at)"
                ." VALUES (:contacts_name, :company_id, :email, :phone,:created_at, :updated_at)";
        }else{
            $query = "INSERT INTO ".$table." (ref, id_company,invoices_created_at, invoices_updated_at, due_date)"
                ." VALUES (:ref, :id_company, :created_at, :updated_at, :due_date)";
        }
        return $query;
    }
    private function createArrayExecute($table,$array): array{
        if( $table === "companies") {
            $arr = [
                "companies_name" => $array["name"],
                "country" => $array["country"],
                "tva" => $array["tva"],
                "created_at" => $array["created_at"],
                "updated_at" => $array["created_at"],
                "phone" => $array["phone"]
            ];
        }elseif ( $table=== "contacts"){
            $arr = [
                "contacts_name" => $array["name"],
                "company_id" => $array["company_id"],
                "email" => $array["email"],
                "created_at" => $array["created_at"],
                "updated_at" => $array["created_at"],
                "phone" => $array["phone"]
                ];
        }
        else{
            $arr = [
                "ref" => $array["ref"],
                "id_company" => $array["id_company"],
                "due_date" => $array["due_date"],
                "created_at" => $array["created_at"],
                "updated_at" => $array["created_at"],
                ];
        }
        return $arr;
    }
}