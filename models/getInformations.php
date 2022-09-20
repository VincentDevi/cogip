<?php

namespace App\models;
use Rakit\Validation\Validator;
use App\models\Dbh;
use PDO;

class getInformations extends Dbh
{
    protected function getInfo($table, $limit=null): array{
        $temporaryQuery = $this->defineTable($table);
        $query= $this->defineLimit($temporaryQuery,$limit);

        $arr = $this->makeConnexion($query);
        return $arr;
    }

    protected function searchInfo($table, $keyword){
        $temporaryQuery = $this->defineTable($table);
        $query = $this->defineCondition($temporaryQuery,$table,$keyword);

        $con = $this->connexion();
        $stmt=$con->prepare($query);
        $stmt->execute([
            "search"=>$keyword
        ]);

        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt=null;
        return $arrAll;
    }




    private function makeConnexion($queryDefined): array{
        $con = $this->connexion();
        $stmt=$con->prepare($queryDefined);
        $stmt->execute();

        $arrAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt=null;
        return $arrAll;
    }

    private function defineLimit($queryWithTableDefined,$limit): string
    {
        $query = $queryWithTableDefined;
        if ( $limit != null){
            $query.= " LIMIT ".$limit;
        }
        return $query;
    }


    private function defineCondition($queryWithTableDefined, $table,$keyword): string
    {
        $query = $this->sanitizeSearchInput($queryWithTableDefined);
        $queryIsValidate = $this->validateSearchInput($query);
        if ($queryIsValidate != "ok") {
            return $queryIsValidate;
        }
        else{
            if ($table === "contacts") {
                $query .= " WHERE name LIKE :search";
            } elseif ($table === "invoices") {
                $query .= " WHERE companies.name LIKE :search";
            } else {
                $query .= " WHERE name LIKE :search";
            }
        return $query;
    }
    }


    private function defineTable($table): string{
        $query = "";
        if ($table==="contacts"){
            $query = "SELECT name, phone, mail, created_at, companies.name"." FROM ".$table
                ."INNER JOIN companies ON  id = company_id";
        }
        elseif ($table ==="companies"){
            $query = "SELECT name, tva, country, created_at, types.name"." FROM ".$table
                ."INNER JOIN types id = type_id";
        }
        else{
            $query = "SELECT ref, updated_at, created_at, companies.name" . " FROM ".$table
                ." INNER JOIN companies ON id = id_company";
        }
        return $query;
    }
    private function sanitizeSearchInput($searchInput): string{
        return htmlspecialchars($searchInput);
    }

    private function validateSearchInput($searchInput){
        $validator = new Validator;
        $value = ['input'=> $searchInput];
        $rule = ['input'=> 'require|alpha'];
        $validation = $validator->make($value,$rule);
        $validation->validate();

        if ( $validation->fails()){
            $result = $validation->errors();
        }else{
            $result = "ok";
        }
        return $result;
    }


}