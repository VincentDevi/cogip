<?php

namespace App\models;

class InvoiceQueries extends DbManipulation
{
    protected function getQuery() {
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

    /**
     * Returns the query to delete an invoice.
     *
     * @return string
     */
    protected function deleteQuery(): string
    {
        return "
                DELETE FROM invoices 
                WHERE id = :id;
        ";
    }
}