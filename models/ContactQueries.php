<?php

namespace App\models;

class ContactQueries extends DbData
{
    /**
     * Returns the query to find one contact.
     *
     * @return string
     */
    protected function getUniqueQuery(): string
    {
        return "
                SELECT contacts_name AS name, 
                       contacts_firstname AS firstname,
                       contacts_phone AS phone, 
                       email, 
                       companies.companies_name AS company_name, 
                       companies.id AS company_id, 
                       contacts.id AS contact_id
                FROM contacts
                INNER JOIN companies
                ON companies.id=company_id
                WHERE contacts.id = :id ;
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
                INSERT INTO contacts 
                            (
                             contacts_name, 
                             contacts_firstname,
                             company_id, 
                             email, 
                             contacts_phone, 
                             contacts_created_at, 
                             contacts_updates_at
                             ) 
                VALUES (
                        :name,
                        :firstname,
                        :company_id, 
                        :email, 
                        :phone, 
                        :created_at, 
                        :updated_at
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
                UPDATE contacts
                SET contacts_name = :name,
                    contacts_firstname = :firstname, 
                    email = :email, 
                    contacts_phone = :phone, 
                    company_id = :company_id, 
                    contacts_updates_at = :updated_at 
                WHERE id = :contact_id;
        ";
    }

    /**
     * Returns the query to delete a contact.
     *
     * @return string
     */
    protected function deleteQuery(): string
    {
        return "
                DELETE FROM contacts 
                WHERE id = :id;
        ";
    }
}