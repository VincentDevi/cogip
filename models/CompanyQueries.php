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
                
                FROM invoices
                    INNER JOIN companies
                        ON companies.id = invoices.id_company
                    INNER JOIN contacts
                        ON contacts.company_id = invoices.id_company
                WHERE companies.id = :id ;
        ";
    }

    protected function createQuery() {
        return "
                INSERT INTO companies 
                                    (
                                     companies_name,
                                     country, 
                                     tva, 
                                     companies_created_at, 
                                     companies_updated_at, 
                                     companies_phone
                                     ) 
                        VALUES (
                                :name,
                                :country, 
                                :vat, 
                                :created_at, 
                                :updated_at, 
                                :phone
                                ) ;
        ";
    }
}