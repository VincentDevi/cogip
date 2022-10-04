<?php

namespace App\models\dashboard;

use App\models\Dbh;

/**
 * Methods to handle create forms.
 * todo: implement them to forms controllers that handle invoice, contact, compny creation forms.
 */
class Form extends Dbh
{

    // todo: give better names to theses method's names.

    /**
     * Return an array with all companies.
     * Useful for fill select input in forms.
     *
     * @param $table
     * @return array
     */
    public function fetchDataToAutocompleteAnInput($table):array{
        $query = $this->getAllNamesOfATable($table);

        return $this->fetchInformation($query);
    }

    /**
     * Return the query for fetchAutocompleteFormData.
     * @param $table
     * @return string
     */
    private function getAllNamesOfATable($table): string{
        $tableName = $table."_name";
        return "SELECT ".$tableName." FROM ".$table;
    }



    /**
     * Return formatted today date.
     *
     * @return string
     */
    private function getTodayDate(): string{
        return date('Y-m-d');
    }

    /**
     * Return company's id according to given name.
     *
     * @param $company_id
     * @return mixed
     */
    private function fetchCompanyId($company_id):string{
        $query= "SELECT companies_name" ."FROM companies"." WHERE companies.id = ".$company_id;
        $arr = $this->fetchInformation($query);
        return $arr["companies.id"];
    }

    /**
     * Return the query to create entry with SQL query according to provided table.
     *
     * @param $table
     * @return string
     */
    protected function setUpdateOrCreateQuery($table, $id = null): string{
        if ($id != null) {
            $query = $this->selectUpdateQuery($table, $id);
        }else{
            $query = $this->selectCreateQuery($table);
        }
        return $query;
    }


    private function selectCreateQuery ($table): string{
        $query="";
        switch ($table){
            case "companies":
                $query = "INSERT INTO " . $table ." (companies_name, country, tva, companies_created_at, companies_updated_at, companies_phone)"
                    . " VALUES (:companies_name, :country, :tva, :created_at, :updated_at, :phone)";
                break;
            case "contacts":
                $query = "INSERT INTO " . $table ." (contacts_name, company_id, email, contacts_phone, contacts_created_at, contacts_updated_at)"
                    . " VALUES (:contacts_name, :company_id, :email, :phone,:created_at, :updated_at)";
                break;
            case  "invoices":
                $query = "INSERT INTO " . $table ." (ref, id_company,invoices_created_at, invoices_updated_at, due_date)"
                    . " VALUES (:ref, :company_id, :created_at, :updated_at, :due_date)";
                break;
        }
        return $query;
    }


    private function selectUpdateQuery ($table,$id): string {
        $query="";
        $idName = $id."id";
        switch ($table){
            case "companies":
                $query = "UPDATE " .$table. " SET companies_name = :companies_name, country = :country, tva = :tva, companies_updated_at = :updated_at, companies_phone = :phone"
                    ." WHERE ".$idName." = ".$id;
                break;
            case "contacts":
                $query = "UPDATE ".$table ." SET contacts_name = :contacts_name, company_id = : company_id, email = :email, contacts_phone = :phone, contacts_updated_at = updated_at"
                    ." WHERE ".$idName." = ".$id;
                break;
            case "invoices":
                $query = "UPDATE ".$table ." SET ref = :ref, id_company = :company_id, invoices_updated_at = :updated_at, due_date = :due_date"
                    ." WHERE ".$idName." = ".$id;
                break;
        }
        return $query;

    }
    /**
     * Return the $vars to pass to createDbData method, according to
     * provided table.
     *
     * @param $table
     * @param $array
     * @return array
     */
        protected function createArrayExecute($table,$array, $id=null): array{

            $arr = $this->selectArrayToBeExecuted($table,$array);

            if ($id == null){
                $arr["created_at"] = $this->getTodayDate();
            }
            return $arr;
        }

        private function selectArrayToBeExecuted ($table,$array):array{
            $arr=[];
            switch ($table){
                case "contacts":
                    $arr = [
                        "contacts_name" => $array["name"],
                        "email" => $array["email"],
                        "phone"=> $array["phone"],
                        "updated_at"=> $this->getTodayDate(),
                        "company_id"=> $this->fetchCompanyId($array["company_name"])
                    ];
                    break;
                case "invoices":
                    $arr=[
                        "ref"=>$array["ref"],
                        "due_date"=>$array["due_date"],
                        "updated_at"=>$this->getTodayDate(),
                        "company_id"=>$this->fetchCompanyId($array["company_name"])
                    ];
                    break;
                case "companies":
                    $arr = [
                        "company_name"=>$array["name"],
                        "country"=>$array["country"],
                        "tva"=>$array["tva"],
                        "phone"=>$array["phone"],
                        "updated_at"=>$this->getTodayDate()
                    ];
                    break;
            }
            return $arr;
        }
}