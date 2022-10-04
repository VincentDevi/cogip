<?php

namespace App\models;

class CompanyData extends DbData
{

    /**
     * Returns the data's from the company according to the provided ID.
     * If no id is provided, returns all the companies data's.
     *
     * @param $companyId
     * @return array
     */
    public function getCompanyData($companyId = NULL): array
    {
        $limit = 5;

        if ($companyId) {
            $idArray = [
                "id"=> $companyId
            ];
            $invArr = $this->fetchData($this->getQuery("invoices", $limit),$idArray);
            $contArr = $this->fetchData($this->getQuery("contacts", $limit), $idArray);
            $compArr = $this->fetchData($this->getQuery("companies", $limit), $idArray);
            return ["invoices"=>$invArr,
                "contacts"=>$contArr,
                "companies"=>$compArr];
        } else {
            return $this->getData('companies');
        }
    }

    public function getLastCompaniesData($limit) {
        return $this->getData("companies", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('companies');

        return $this->fetchData($query, NULL, $this);
    }

    // todo : refactor to do only one query for all.
    /**
     * Return the Query according to the provided table and limit.
     *
     * @param $table
     * @param $limit
     * @return string|null
     */
    private function getQuery($table, $limit): ?string
    {
        if ( $table === "invoices"){
            return "SELECT ref, due_date, companies.companies_name, invoices_created_at"." FROM ".$table." INNER JOIN companies ON companies.id= id_company"
                ." WHERE companies.id = :id "." LIMIT ".$limit.";";
        }elseif ( $table === "contacts"){
            return "SELECT contacts_name"." FROM ".$table." INNER JOIN companies ON companies.id = company_id"." WHERE companies.id = :id ;";

        }elseif ( $table === "companies"){
            return "SELECT companies_name, tva, country, companies_phone"." FROM ".$table." WHERE companies.id = :id ;";
        }else {
            return NULL;
        }
    }

}