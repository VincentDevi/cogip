<?php

namespace App\models;

class InvoiceData extends DbData
{
    /**
     * Returns the data's from all the invoices.
     *
     * @param $contactId
     * @return array
     */
    public function getInvoiceData($id = NULL): array
    {
        if ($id) {
            $query = $this->getQuery();

            return $this->fetchData($query,["id"=>$id]);
        } else {
            return $this->getData('invoices');
        }
    }

    private function getQuery() {
        return "
                SELECT invoices.id,
                       invoices.ref,
                       companies.companies_name AS company_name,
                       invoices_created_at AS created_at,
                       invoices_updated_at AS updated_at,
                       invoices.due_date 
                FROM invoices
                INNER JOIN companies
                ON companies.id=invoices.id_company
                WHERE invoices.id = :id ;
            ";
    }

    public function getLastInvoicesData($limit) {
        return $this->getData("invoices", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('invoices');

        return $this->fetchData($query, NULL, $this);
    }
}