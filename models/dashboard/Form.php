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
    public function fetchAutocompleteFormData($table):array{
        $query = $this->queryFormAutocomplete($table);

        return $this->fetchInformation($query);
    }

    /**
     * Return the query for fetchAutocompleteFormData.
     * @param $table
     * @return string
     */
    private function queryFormAutocomplete($table): string{
        return "SELECT ".$table."_name"." FROM ".$table;
    }

    /**
     * check if value name exist in provided table.
     * E.g. : checkIfValueExist(contacts, 'toto'); will check if
     * toto exist in table contacts in contacts_name column.
     *
     * @param $table
     * @param $nameToCheck
     * @return bool
     */
    public function checkIfValueExist($table, $nameToCheck): bool{
        if (! $this->countRowDb($table,$nameToCheck)) {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    /**
     * Possible duplicate of Dbh->fetchInformation() function.
     *
     * @param $table
     * @param $arrayOfInput
     * @return void
     */
    public function createDb($table,$arrayOfInput){
        $con = $this->connexion();
        $stmt = $con->prepare($this->selectCreateQuery($table));
        $stmt->execute($this->createArrayExecute($table,$arrayOfInput));
        $stmt = null;
    }

    /**
     * Return formatted today date.
     *
     * @return string
     */
    private function getTodayDate(): string{
        return date('Y-m-d');
    }

    // todo: to check if that work.
    /**
     * query db for matching names according to given table.
     * Used in checkIfValueExist. So probably need to merge the two functions.
     *
     * E.g. : checkIfValueExist(contacts, 'toto'); will check if
     * toto exist in table contacts in contacts_name column.
     *
     * @param $table
     * @param $nameToCheck
     * @return array
     */
    private function countRowDb($table,$nameToCheck): array{
        $query = "SELECT COUNT(*)"." FROM :table WHERE :tableName LIKE :nameTocheck";
        return $this->fetchInformation($query,[
            "table"=>$table,
            "nameToCheck"=> $nameToCheck
        ]);

    }

    /**
     * Return company's id according to given name.
     *
     * @param $company_id
     * @return mixed
     */
    private function fectchCompanyName($company_id){
        $query= "SELECT companies_name" ."FROM companies"." WHERE companies.id = ".$company_id;
        $arr = $this->fetchInformation($query);
        return $arr["companies_name"];
    }

    /**
     * Return the query to create entry with SQL query according to provided table.
     *
     * @param $table
     * @return string
     */
    private function selectCreateQuery($table): string{
        if ($table === "companies"){
            $query = "INSERT INTO ".$table." (companies_name, country, tva, companies_created_at, companies_updated_at, companies_phone)"
            ." VALUES (:companies_name, :country, :tva, :created_at, :updated_at, :phone)";
        }elseif ($table === "contacts"){
            $query = "INSERT INTO ".$table." (contacts_name, company_id, email, contacts_phone, contacts_created_at, contacts_updated_at)"
                ." VALUES (:contacts_name, :company_id, :email, :phone,:created_at, :updated_at)";
        }elseif ($table === 'invoices'){
            $query = "INSERT INTO ".$table." (ref, id_company,invoices_created_at, invoices_updated_at, due_date)"
                ." VALUES (:ref, :id_company, :created_at, :updated_at, :due_date)";
        }
        return $query;
    }

    /**
     * Return the $vars to pass to fetchInformation method, according to
     * provided table.
     *
     * @param $table
     * @param $array
     * @return array
     */
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
        elseif ( $table=== "invoices") {
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