<?php

namespace App\models;
use Rakit\Validation\ErrorBag;
use Rakit\Validation\Validator;
use PDO;

class DbData extends Dbh
{
    /**
     * Return an array with infos according to the provided table and provided limit.
     * Limit argument will limit the length of the array. E.g.  5 will return an array with 5 elements.
     *
     * @param $table
     * @param int $limit
     * @return array
     */
    public function getData($table, int $limit=0): array{
        $query = $this->getQuery($table, $limit);

        return $this->fetchInformation($query, NULL, $this);
    }

    public function getRowCount(): array{
        return ["companies" => $this->rowCount("companies"),
            "invoices"=> $this->rowCount("invoices"),
            "contacts"=> $this->rowCount("contacts")
        ];
    }
    public function createArray(): array{
        $comp = $this->getData("companies", 5);
        $inv = $this->getData("invoices", 5);
        $cont = $this->getData("contacts", 5);
        $rowCounts = $this->getRowCount();
        return ["companies"  => $comp,
            "invoices"=> $inv,
            "contacts"=> $cont,
            "stats"=> $rowCounts];
    }
    /**
     * Return an array with infos according to the provided table and provided limit.
     * Limit argument will limit the length of the array. E.g.  5 will return an array with 5 elements.
     *
     * @param $table
     * @param $input
     * @return array
     */

    public function getSearchInfos($table, $input): array
    { // replace searchInfo
        $input = $this->validateSearchInput($input);
        $input = $this->sanitizeSearchInput($input);

        $query = $this->getQuery($table, NULL, $input);

        return $this->fetchInformation($query, [
            "search" => $input
        ], $this);
    }

    /**
     * Return the condition to append to a query string according to the provided condition parameter.
     *
     * @param $condition 'contacts'|'invoices'|'companies'
     * @return string
     */
    private function getCondition($condition): string
    {
        if ($condition === "contacts") {
            return " WHERE name LIKE :search";
        } elseif ($condition === "invoices") {
            return " WHERE companies.name LIKE :search";
        } elseif ($condition === "companies") {
            return " WHERE companies.name LIKE :search";
        } else {
            return "";
        }
    }
    private function rowCount($table): string{
        return "SELECT COUNT(*)"." FROM ".$table;
    }

    /**
     * Return the limit to append to the query string according to the provided limit parameter.
     *
     * @param $limit
     * @return string
     */
    private function getLimit($limit,$table): string
    {
        if (is_numeric($limit) && $limit > 0) {
            return " ORDER BY ".$table.".id DESC LIMIT ".$limit;
        } else {
            return "";
        }
    }

    /**
     * Return the query string according to the specified parameters.
     *
     * @param $table
     * @param $limit
     * @param $condition
     * @return string
     */
    private function getQuery($table, $limit, $condition = NULL): string{
        $queryLimit = $this->getLimit($limit,$table);
        $queryCondition = $this->getCondition($condition);

        if ($table ==="contacts"){
            $query = "SELECT contacts.id,contacts.contacts_name, contacts.contacts_phone, contacts.email, contacts.contacts_created_at, companies.companies_name"." FROM ".$table
                ." INNER JOIN companies ON companies.id = contacts.company_id".$queryLimit.$queryCondition.";";
        }
        elseif ($table ==="companies"){
            $query = "SELECT companies.id,companies.companies_name, companies.tva, companies.country, companies.companies_created_at, types.types_name"." FROM ".$table
                ." INNER JOIN types ON types.id = companies.type_id".$queryLimit.$queryCondition.";";
        }
        else{
            $query = "SELECT invoices.id,ref, invoices.due_date, invoices.invoices_created_at, companies.companies_name" . " FROM ".$table
                ." INNER JOIN companies ON companies.id = invoices.id_company".$queryLimit.$queryCondition.";";
        }
        return $query;
    }

    /**
     * Sanitize the given dashboard input.
     *
     * @param $searchInput
     * @return string
     */
    private function sanitizeSearchInput($searchInput): string{
        return htmlspecialchars($searchInput);
    }

    /**
     * Check if the input is valid and return TRUE if it is.
     * Otherwise, return the error.
     *
     * @param $searchInput
     * @return TRUE|ErrorBag
     */
    private function validateSearchInput($searchInput): ErrorBag|bool
    {
        $validator = new Validator;
        $value = ['input' => $searchInput];
        $rule = ['input' => 'require|alpha'];
        $validation = $validator->make($value,$rule);
        $validation->validate();

        return !$validation->fails() ? TRUE : $validation->errors();
    }

}