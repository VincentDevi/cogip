<?php

namespace App\models;

class InvoiceQueries extends DbManipulation
{
    protected function getQuery() {
        return "
                SELECT invoices.id,
                       invoices.ref,
                       companies.companies_name AS company_name,
                       id_company AS company_id,
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
     * Returns the query to create a new contact.
     *
     * @return string
     */
    protected function createQuery(): string
    {
        return "
                INSERT INTO invoices 
                            (
                             ref, 
                             id_company,
                             invoices_created_at, 
                             invoices_updated_at, 
                             due_date
                             ) 
                VALUES (
                        :reference,
                        :company_id,
                        :created_at, 
                        :updated_at, 
                        :due_date
                        ) ;
            ";
    }

    /**
     * Returns the query to update an invoice.
     *
     * @return string
     */
    protected function updateQuery(): string
    {
        return "
                UPDATE invoices
                SET ref = :reference,
                    id_company = :company_id, 
                    invoices_updated_at = :updated_at, 
                    due_date = :due_date
                WHERE id = :invoice_id;
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