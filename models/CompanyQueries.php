<?php

namespace App\models;

class CompanyQueries extends DbManipulation
{
    protected function getAllQuery(): string
    {
        return "
                SELECT
                    invoices.ref AS invoice_ref,
                    invoices.due_date AS invoice_due_date,
                    invoices.invoices_created_at AS invoice_created_at,
                    invoices.id AS invoice_id,
                    
                    contacts.contacts_name AS contact_name,
                    contacts.contacts_firstname AS contact_firstname,
                    contacts.id AS contact_id,
                
                    companies.companies_name AS company_name,
                    companies.tva AS company_vat,
                    companies.country AS company_country,
                    companies.companies_phone AS company_phone,
                    companies.id AS company_id
                
                FROM companies
                         LEFT JOIN invoices
                                    ON invoices.id_company = :id
                         LEFT JOIN contacts
                                    ON contacts.company_id = :id
                WHERE companies.id = :id ;
        ";
    }

    protected function createQuery() {
        return "
                INSERT INTO companies 
                                    (
                                     companies_name,
                                     country, 
                                     type_id, 
                                     tva, 
                                     companies_created_at, 
                                     companies_updated_at, 
                                     companies_phone
                                     ) 
                        VALUES (
                                :name,
                                :country, 
                                :type,
                                :vat, 
                                :created_at, 
                                :updated_at, 
                                :phone
                                ) ;
        ";
    }

    /**
     * Returns the query to update a contact.
     *
     * @return string
     */
    protected function updateQuery(): string
    {
        return "
                UPDATE companies
                SET companies_name = :name,
                    country = :country, 
                    type_id = :type, 
                    companies_phone = :phone, 
                    tva = :vat, 
                    companies_updated_at = :updated_at 
                WHERE id = :company_id;
        ";
    }

    /**
     * Returns the query to delete a company.
     *
     * @return string
     */
    protected function deleteQuery(): string
    {
        return "
                DELETE FROM companies 
                WHERE id = :id;
        ";
    }
}